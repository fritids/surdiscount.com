<?php
/*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Open Software License (OSL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/osl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 1.4 $
*  @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*/

ControllerFactory::includeController('ParentOrderController');

class OrderOpcControllerCore extends ParentOrderController
{
	public $isLogged;
	
	public function preProcess()
	{
		parent::preProcess();
		if ($this->nbProducts)
			self::$smarty->assign('virtual_cart', false);
		$this->isLogged = (bool)((int)(self::$cookie->id_customer) AND Customer::customerIdExistsStatic((int)(self::$cookie->id_customer)));
		
		if (self::$cart->nbProducts())
		{
			if (Tools::isSubmit('ajax'))
			{
				if (Tools::isSubmit('method'))
				{
					switch (Tools::getValue('method'))
					{
						case 'updateMessage':
							if (Tools::isSubmit('message'))
							{
								$txtMessage = urldecode(Tools::getValue('message'));
								$this->_updateMessage($txtMessage);
						    	if (sizeof($this->errors))
									die('{"hasError" : true, "errors" : ["'.implode('\',\'', $this->errors).'"]}');
								die(true);
							}
							break;
						case 'updateCarrierAndGetPayments':
							if (Tools::isSubmit('id_carrier') AND Tools::isSubmit('recyclable') AND Tools::isSubmit('gift') AND Tools::isSubmit('gift_message'))
							{
								if ($this->_processCarrier())
								{
									$return = array(
										'summary' => self::$cart->getSummaryDetails(),
										'HOOK_TOP_PAYMENT' => Module::hookExec('paymentTop'),
										'HOOK_PAYMENT' => self::_getPaymentMethods()
									);
									die(Tools::jsonEncode($return));
								}
								else
									$this->errors[] = Tools::displayError('Error occurred updating cart.');
								if (sizeof($this->errors))
									die('{"hasError" : true, "errors" : ["'.implode('\',\'', $this->errors).'"]}');
								exit;
							}
							break;
						case 'updateTOSStatusAndGetPayments':
							if (Tools::isSubmit('checked'))
							{
								self::$cookie->checkedTOS = (int)(Tools::getValue('checked'));
								die(Tools::jsonEncode(array(
									'HOOK_TOP_PAYMENT' => Module::hookExec('paymentTop'),
									'HOOK_PAYMENT' => self::_getPaymentMethods()
								)));
							}
							break;
						case 'getCarrierList':
							die(Tools::jsonEncode(self::_getCarrierList()));
							break;
						case 'editCustomer':
							if (!$this->isLogged)
								exit;
							$customer = new Customer((int)self::$cookie->id_customer);
							if (Tools::getValue('years'))
								$customer->birthday = (int)Tools::getValue('years').'-'.(int)Tools::getValue('months').'-'.(int)Tools::getValue('days');
							$_POST['lastname'] = $_POST['customer_lastname'];
							$_POST['firstname'] = $_POST['customer_firstname'];
							$this->errors = $customer->validateControler();
							$customer->newsletter = (int)Tools::isSubmit('newsletter');
							$customer->optin = (int)Tools::isSubmit('optin');
							$return = array(
								'hasError' => !empty($this->errors), 
								'errors' => $this->errors,
								'id_customer' => (int)self::$cookie->id_customer,
								'token' => Tools::getToken(false)
							);
							if (!sizeof($this->errors))
								$return['isSaved'] = (bool)$customer->update();
							else
								$return['isSaved'] = false;
							die(Tools::jsonEncode($return));
							break;
						case 'getAddressBlockAndCarriersAndPayments':
							if (self::$cookie->isLogged())
							{
								if (file_exists(_PS_MODULE_DIR_.'blockuserinfo/blockuserinfo.php'))
								{
									include_once(_PS_MODULE_DIR_.'blockuserinfo/blockuserinfo.php');
									$blockUserInfo = new BlockUserInfo();
								}
								self::$smarty->assign('isVirtualCart', self::$cart->isVirtualCart());
								$this->_assignAddress();
								// Wrapping fees
								$wrapping_fees = (float)(Configuration::get('PS_GIFT_WRAPPING_PRICE'));
								$wrapping_fees_tax = new Tax((int)(Configuration::get('PS_GIFT_WRAPPING_TAX')));
								$wrapping_fees_tax_inc = $wrapping_fees * (1 + (((float)($wrapping_fees_tax->rate) / 100)));
								$return = array(
									'order_opc_adress' => self::$smarty->fetch(_PS_THEME_DIR_.'order-address.tpl'),
									'block_user_info' => (isset($blockUserInfo) ? $blockUserInfo->hookTop(array()) : ''),
									'carrier_list' => self::_getCarrierList(),
									'HOOK_TOP_PAYMENT' => Module::hookExec('paymentTop'),
									'HOOK_PAYMENT' => self::_getPaymentMethods(),
									'gift_price' => Tools::displayPrice(Tools::convertPrice(Product::getTaxCalculationMethod() == 1 ? $wrapping_fees : $wrapping_fees_tax_inc, new Currency((int)(self::$cookie->id_currency))))
								);
								die(Tools::jsonEncode($return));
							}
							die(Tools::displayError());
							break;
						case 'makeFreeOrder':
							/* Bypass payment step if total is 0 */
							if (($id_order = $this->_checkFreeOrder()) AND $id_order)
							{
								$email = self::$cookie->email;
								if (self::$cookie->is_guest)
									self::$cookie->logout(); // If guest we clear the cookie for security reason
								die('freeorder:'.$id_order.':'.$email);
							}
							exit;
							break;
						case 'updateAddressesSelected':
							$id_address_delivery = (int)(Tools::getValue('id_address_delivery'));
							$id_address_invoice = (int)(Tools::getValue('id_address_invoice'));
							$address_delivery = new Address((int)(Tools::getValue('id_address_delivery')));
							$address_invoice = ((int)(Tools::getValue('id_address_delivery')) == (int)(Tools::getValue('id_address_invoice')) ? $address_delivery : new Address((int)(Tools::getValue('id_address_invoice'))));
							
							if (!Address::isCountryActiveById((int)(Tools::getValue('id_address_delivery'))))
								$this->errors[] = Tools::displayError('This address is not in a valid area.');
							elseif (!Validate::isLoadedObject($address_delivery) OR !Validate::isLoadedObject($address_invoice) OR $address_invoice->deleted OR $address_delivery->deleted)
								$this->errors[] = Tools::displayError('This address is invalid.');
							else
							{
								self::$cart->id_address_delivery = (int)(Tools::getValue('id_address_delivery'));
								self::$cart->id_address_invoice = Tools::isSubmit('same') ? self::$cart->id_address_delivery : (int)(Tools::getValue('id_address_invoice'));
								if (!self::$cart->update())
									$this->errors[] = Tools::displayError('An error occurred while updating your cart.');
								if (!sizeof($this->errors))
								{
									if (self::$cookie->id_customer)
									{
										$customer = new Customer((int)(self::$cookie->id_customer));
										$groups = $customer->getGroups();
									}
									else
										$groups = array(1);
									$result = self::_getCarrierList();
									// Wrapping fees
									$wrapping_fees = (float)(Configuration::get('PS_GIFT_WRAPPING_PRICE'));
									$wrapping_fees_tax = new Tax((int)(Configuration::get('PS_GIFT_WRAPPING_TAX')));
									$wrapping_fees_tax_inc = $wrapping_fees * (1 + (((float)($wrapping_fees_tax->rate) / 100)));
									$result = array_merge($result, array(
										'summary' => self::$cart->getSummaryDetails(),
										'HOOK_TOP_PAYMENT' => Module::hookExec('paymentTop'),
										'HOOK_PAYMENT' => self::_getPaymentMethods(),
										'gift_price' => Tools::displayPrice(Tools::convertPrice(Product::getTaxCalculationMethod() == 0 ? $wrapping_fees : $wrapping_fees_tax_inc, new Currency((int)(self::$cookie->id_currency))))
									));
									die(Tools::jsonEncode($result));
								}
							}
							if (sizeof($this->errors))
								die('{"hasError" : true, "errors" : ["'.implode('\',\'', $this->errors).'"]}');
							break;
						default:
							exit;
					}
				}
				exit;
			}
		}
		elseif (Tools::isSubmit('ajax'))
			exit;
	}
	
	public function setMedia()
	{
		parent::setMedia();
		
		// Adding CSS style sheet
		Tools::addCSS(_THEME_CSS_DIR_.'order-opc.css');
		// Adding JS files
		Tools::addJS(_THEME_JS_DIR_.'order-opc.js');
		Tools::addJs(_PS_JS_DIR_.'jquery/jquery.scrollTo-1.4.2-min.js');
		Tools::addJS(_THEME_JS_DIR_.'tools/statesManagement.js');
	}
	
	public function process()
	{
		// SHOPPING CART
		$this->_assignSummaryInformations();
		// WRAPPING AND TOS
		$this->_assignWrappingAndTOS();

		$selectedCountry = (int)(Configuration::get('PS_COUNTRY_DEFAULT'));
		$countries = Country::getCountries((int)(self::$cookie->id_lang), true);
		self::$smarty->assign(array(
			'isLogged' => $this->isLogged,
			'isGuest' => isset(self::$cookie->is_guest) ? self::$cookie->is_guest : 0,
			'countries' => $countries,
			'sl_country' => isset($selectedCountry) ? $selectedCountry : 0,
			'PS_GUEST_CHECKOUT_ENABLED' => Configuration::get('PS_GUEST_CHECKOUT_ENABLED'),
			'errorCarrier' => Tools::displayError('You must choose a carrier before', false),
			'errorTOS' => Tools::displayError('You must accept terms of service before', false),
			'isPaymentStep' => (bool)(isset($_GET['isPaymentStep']) AND $_GET['isPaymentStep'])
		));
		$years = Tools::dateYears();
		$months = Tools::dateMonths();
		$days = Tools::dateDays();
		self::$smarty->assign(array(
			'years' => $years,
			'months' => $months,
			'days' => $days,
		));
		
		/* Load guest informations */
		if ($this->isLogged AND self::$cookie->is_guest)
			self::$smarty->assign('guestInformations', $this->_getGuestInformations());
		
		if ($this->isLogged)
			$this->_assignAddress(); // ADDRESS
		// CARRIER
		$this->_assignCarrier();
		// PAYMENT
		$this->_assignPayment();
		Tools::safePostVars();
	}
	
	public function displayHeader()
	{
		if (Tools::getValue('ajax') != 'true')
			parent::displayHeader();
	}
	
	public function displayContent()
	{
		parent::displayContent();
		
		self::$smarty->display(_PS_THEME_DIR_.'errors.tpl');
		self::$smarty->display(_PS_THEME_DIR_.'order-opc.tpl');
	}
	
	public function displayFooter()
	{
		if (Tools::getValue('ajax') != 'true')
			parent::displayFooter();
	}
	
	protected function _getGuestInformations()
	{
		$customer = new Customer((int)(self::$cookie->id_customer));
		$address_delivery = new Address((int)self::$cart->id_address_delivery);

		if ($customer->birthday)
			$birthday = explode('-', $customer->birthday);
		else
			$birthday = array('0', '0', '0');

		return array(
			'id_customer' => (int)(self::$cookie->id_customer),
			'email' => Tools::htmlentitiesUTF8($customer->email),
			'customer_lastname' => Tools::htmlentitiesUTF8($customer->lastname),
			'customer_firstname' => Tools::htmlentitiesUTF8($customer->firstname),
			'newsletter' => (int)$customer->newsletter,
			'optin' => (int)$customer->optin,
			'id_address_delivery' => (int)self::$cart->id_address_delivery,
			'company' => Tools::htmlentitiesUTF8($address_delivery->company),
			'lastname' => Tools::htmlentitiesUTF8($address_delivery->lastname),
			'firstname' => Tools::htmlentitiesUTF8($address_delivery->firstname),
			'vat_number' => Tools::htmlentitiesUTF8($address_delivery->vat_number),
			'dni' => Tools::htmlentitiesUTF8($address_delivery->dni),
			'address1' => Tools::htmlentitiesUTF8($address_delivery->address1),
			'postcode' => Tools::htmlentitiesUTF8($address_delivery->postcode),
			'city' => Tools::htmlentitiesUTF8($address_delivery->city),
			'phone' => Tools::htmlentitiesUTF8($address_delivery->phone),
			'phone_mobile' => Tools::htmlentitiesUTF8($address_delivery->phone_mobile),
			'id_country' => (int)($address_delivery->id_country),
			'id_state' => (int)($address_delivery->id_state),
			'id_gender' => (int)$customer->id_gender,
			'sl_year' => $birthday[0],
			'sl_month' => $birthday[1],
			'sl_day' => $birthday[2]
		);
	}
	
	protected function _assignCarrier()
	{
		$carriers = Carrier::getCarriersForOrder(Country::getIdZone((int)Configuration::get('PS_COUNTRY_DEFAULT')));
		if ($this->isLogged)
		{
			$address_delivery = new Address((int)(self::$cart->id_address_delivery));
			if (!Address::isCountryActiveById((int)(self::$cart->id_address_delivery)))
				unset($address_delivery);
			elseif (!Validate::isLoadedObject($address_delivery) OR $address_delivery->deleted)
				unset($address_delivery);
		}
		self::$smarty->assign(array(
			'checked' => $this->_setDefaultCarrierSelection($carriers),
			'carriers' => $carriers,
			'default_carrier' => (int)(Configuration::get('PS_CARRIER_DEFAULT')),
			'HOOK_EXTRACARRIER' => (isset($address_delivery) ? Module::hookExec('extraCarrier', array('address' => $address_delivery)) : NULL),
			'HOOK_BEFORECARRIER' => Module::hookExec('beforeCarrier', array('carriers' => $carriers))
		));
	}
	
	protected function _assignPayment()
	{
		self::$smarty->assign(array(
		    'HOOK_TOP_PAYMENT' => ($this->isLogged ? Module::hookExec('paymentTop') : ''),
			'HOOK_PAYMENT' => self::_getPaymentMethods()
		));
	}
	
	protected function _getPaymentMethods()
	{
		if (!$this->isLogged)
			return '<p class="warning">'.Tools::displayError('Please sign in to see payment methods').'</p>';
		if (self::$cart->OrderExists())
			return '<p class="warning">'.Tools::displayError('Error: this order is already validated').'</p>';
		if (!self::$cart->id_customer OR !Customer::customerIdExistsStatic(self::$cart->id_customer) OR Customer::isBanned(self::$cart->id_customer))
			return '<p class="warning">'.Tools::displayError('Error: no customer').'</p>';
		$address_delivery = new Address(self::$cart->id_address_delivery);
		$address_invoice = (self::$cart->id_address_delivery == self::$cart->id_address_invoice ? $address_delivery : new Address(self::$cart->id_address_invoice));
		if (!self::$cart->id_address_delivery OR !self::$cart->id_address_invoice OR !Validate::isLoadedObject($address_delivery) OR !Validate::isLoadedObject($address_invoice) OR $address_invoice->deleted OR $address_delivery->deleted)
			return '<p class="warning">'.Tools::displayError('Error: please choose an address').'</p>';
		if (!self::$cart->id_carrier AND !self::$cart->isVirtualCart())
			return '<p class="warning">'.Tools::displayError('Error: please choose a carrier').'</p>';
		elseif (self::$cart->id_carrier != 0)
		{
			$carrier = new Carrier((int)(self::$cart->id_carrier));
			if (!Validate::isLoadedObject($carrier) OR $carrier->deleted OR !$carrier->active)
				return '<p class="warning">'.Tools::displayError('Error: the carrier is invalid').'</p>';
		}
		if (!self::$cart->id_currency)
			return '<p class="warning">'.Tools::displayError('Error: no currency has been selected').'</p>';
		if (!self::$cookie->checkedTOS AND Configuration::get('PS_CONDITIONS'))
			return '<p class="warning">'.Tools::displayError('Please accept Terms of Service').'</p>';
		
		/* If some products have disappear */
		if (!self::$cart->checkQuantities())
			return '<p class="warning">'.Tools::displayError('An item in your cart is no longer available, you cannot proceed with your order.').'</p>';
		
		/* Check minimal amount */
		$currency = Currency::getCurrency((int)self::$cart->id_currency);
		
		$orderTotal = self::$cart->getOrderTotal();
		$minimalPurchase = Tools::convertPrice((float)Configuration::get('PS_PURCHASE_MINIMUM'), $currency);
		if ($orderTotal < $minimalPurchase)
			return '<p class="warning">'.Tools::displayError('A minimum purchase total of').' '.Tools::displayPrice($minimalPurchase, $currency).
			' '.Tools::displayError('is required in order to validate your order.').'</p>';
		
		/* Bypass payment step if total is 0 */
		if (self::$cart->getOrderTotal() <= 0)
			return '<p class="center"><input type="button" class="exclusive_large" name="confirmOrder" id="confirmOrder" value="'.Tools::displayError('I confirm my order').'" onclick="confirmFreeOrder();" /></p>';
		
		$return = Module::hookExecPayment();
		if (!$return)
			return '<p class="warning">'.Tools::displayError('No payment method is available').'</p>';
		return $return;
	}
	
	protected function _getCarrierList()
	{
		$address_delivery = new Address(self::$cart->id_address_delivery);
		if (self::$cookie->id_customer)
		{
			$customer = new Customer((int)(self::$cookie->id_customer));
			$groups = $customer->getGroups();
		}
		else
			$groups = array(1);
		if (!Address::isCountryActiveById((int)(self::$cart->id_address_delivery)))
			$this->errors[] = Tools::displayError('This address is not in a valid area.');
		elseif (!Validate::isLoadedObject($address_delivery) OR $address_delivery->deleted)
			$this->errors[] = Tools::displayError('This address is invalid.');
		else
		{
			$carriers = Carrier::getCarriersForOrder((int)Address::getZoneById((int)($address_delivery->id)), $groups);
			$result = array(
				'checked' => $this->_setDefaultCarrierSelection($carriers),
				'carriers' => $carriers,
				'HOOK_BEFORECARRIER' => Module::hookExec('beforeCarrier', array('carriers' => $carriers)),
				'HOOK_EXTRACARRIER' => Module::hookExec('extraCarrier', array('address' => $address_delivery))
			);
			return $result;
		}
		if (sizeof($this->errors))
			return array(
				'hasError' => true,
				'errors' => $this->errors
			);
	}
	
	protected function _setDefaultCarrierSelection($carriers)
	{
		if (sizeof($carriers))
		{
			$defaultCarrierIsPresent = false;
			if (self::$cart->id_carrier != 0)
				foreach ($carriers AS $carrier)
					if ($carrier['id_carrier'] == self::$cart->id_carrier)
					{
						$defaultCarrierIsPresent = true;
						self::$cart->id_carrier = $carrier['id_carrier'];
					}
			if (!$defaultCarrierIsPresent)
				foreach ($carriers AS $carrier)
					if ($carrier['id_carrier'] == Configuration::get('PS_CARRIER_DEFAULT'))
					{
						$defaultCarrierIsPresent = true;
						self::$cart->id_carrier = $carrier['id_carrier'];
					}
			if (!$defaultCarrierIsPresent)
				self::$cart->id_carrier = $carriers[0]['id_carrier'];
		}
		else
			self::$cart->id_carrier = 0;
		if (self::$cart->update())
			return self::$cart->id_carrier;
		return 0;
	}
}

