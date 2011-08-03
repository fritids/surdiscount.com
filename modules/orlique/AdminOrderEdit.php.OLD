<?php
include_once(PS_ADMIN_DIR . '/tabs/AdminOrders.php');

class AdminOrderEdit extends AdminOrders
{
	public function __construct()
	{
		global $cookie, $_LANGADM, $currentIndex;
		
	    $this->module = 'orlique';
	 	$this->edit   = true;
	 	$this->delete = true;

		$langFile = _PS_MODULE_DIR_ . $this->module . '/' . Language::getIsoById(intval($cookie->id_lang)) . '.php';
		
		if(file_exists($langFile))
		{
			require_once $langFile;
			foreach($_MODULE as $key => $value)
				if(strtolower(substr(strip_tags($key), 0, 5)) == 'admin')
					$_LANGADM[str_replace('_', '', strip_tags($key))] = $value;
		}
		
		$filters = Tools::getValue('exFilter', false);
		
		parent::__construct();
		
		if ($filters && sizeof($filters))
		{
			$emptyElements = array_keys($filters, '');
				foreach ($emptyElements as $key)
					unset($filters[$key]);
			
			if (sizeof($filters))
			{
				$this->_where.= '
				AND EXISTS
					(
						SELECT
							`id_order`
						FROM `' . _DB_PREFIX_ . 'order_detail`
						WHERE
							`id_order` = a.`id_order`';
				foreach ($filters as $filterName => $filterValue)
				{
					$this->_where.= ' AND (`' . trim(pSQL($filterName)) . '` LIKE "' . trim(pSQL($filterValue))  . '%" OR `' . trim(pSQL($filterName)) . '` = "' . trim(pSQL($filterValue))  . '")';
				}
				
				$this->_where.= ')';
			}
		}
		
		$this->l('Add new');
		$this->l('Display');
		$this->l('Page');
		$this->l('result(s)');
		$this->l('Reset');
		$this->l('Filter');
		$this->l('ID');
		$this->l('New');
		$this->l('Customer');
		$this->l('Total');
		$this->l('Payment');
		$this->l('Status');
		$this->l('Date');
		$this->l('PDF');
		$this->l('Actions');
		$this->l('View');
		$this->l('Edit');
		$this->l('Delete');
		$this->l('Delete selection');
	}
	
	protected function l($string, $class = 'AdminTab', $addslashes = FALSE, $htmlentities = TRUE)
	{
		return parent::l($string, strtolower(get_class($this)), $addslashes, $htmlentities);
	}
	
	private function updateOrderHistory($ordersList, $newOrderStatus)
	{
	    if ( ! is_array($ordersList) || ! Validate::isUnsignedId($newOrderStatus))
	        $this->_errors[] = Tools::displayError('Wrong parameters passed.');
	    else
	    {
	        global $cookie;
	        
	        // The faster way would be just to update one table, but that way 
	        // no letters will be sent to customers, so we're going to have to 
	        // loop through objects.
	        foreach ($ordersList as $orderId)
	        {
	            if (Validate::isLoadedObject($order = new Order(intval($orderId))))
	            {
					$history = new OrderHistory();
					$history->id_order = $orderId;
					$history->changeIdOrderState(intval($newOrderStatus), intval($orderId));
					$history->id_employee = intval($cookie->id_employee);
					$carrier = new Carrier(intval($order->id_carrier), intval($order->id_lang));
					$templateVars = array('{followup}' => ($history->id_order_state == _PS_OS_SHIPPING_ AND $order->shipping_number) ? str_replace('@', $order->shipping_number, $carrier->url) : '');
					if ( ! $history->addWithemail(true, $templateVars))
                        $this->_errors[] = Tools::displayError('an error occurred while changing status or was unable to send e-mail to the customer');
	            }
	        }
	    }
	}
	
	private static function roundPrice($price, $precision)
	{
		if (method_exists('Tools', 'ps_round'))
			return Tools::ps_round($price, $precision);
		else
			return number_format($price, $precision, '.', '');
	}
	
	public function postProcess()
	{
	    if (Tools::getIsset('submitStateChange' . $this->table))
	    {
	        if ($this->tabAccess['edit'] === '1')
	        {
	            if (isset($_POST[$this->table . 'Box']))
	                $this->updateOrderHistory($_POST[$this->table . 'Box'], Tools::getValue('id_order_state', false));
	        }
            else
                $this->_errors[] = Tools::displayError('You do not have permission to edit here.');
	    }
		elseif (Tools::getIsset('deleteorder'))
		{
	        if ($this->tabAccess['delete'] === '1')
	        {
				$orderId = intval(Tools::getValue('id_order'));
	            $cartId  = intval(Db::getInstance()->getValue('SELECT `id_cart` FROM `' . _DB_PREFIX_ . 'orders` WHERE `id_order` = ' . $orderId));
				$return  = intval(Db::getInstance()->getValue('SELECT `id_order_return` FROM `' . _DB_PREFIX_ . 'order_return` WHERE `id_order` = ' . $orderId));
				$slip    = intval(Db::getInstance()->getValue('SELECT `id_order_slip` FROM `' . _DB_PREFIX_ . 'order_slip` WHERE `id_order` = ' . $orderId));
				
				if ($cartId != 0)
				{
					$customizations = Db::getInstance()->ExecuteS('
						SELECT `id_customization` FROM `' . _DB_PREFIX_ . 'customization` WHERE `id_cart` = ' . $cartId
					);
					
					if ($customizations && sizeof($customizations))
						foreach ($customizations as $customization)
							Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'customized_data` WHERE `id_customization` = ' . $customization['id_customization']);
					
					$tables = array('cart', 'cart_discount', 'cart_product', 'customization');
					
					foreach ($tables as $table)
						Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . $table . '` WHERE `id_cart` = ' . $cartId);
				}
				
				if ($return != 0)
				{
					Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'order_return` WHERE `id_order` = ' . $orderId);
					Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'order_return_detail` WHERE `id_order_return` = ' . $return);
				}
				
				if ($slip != 0)
				{
					Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'order_slip` WHERE `id_order` = ' . $orderId);
					Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . 'order_slip_detail` WHERE `id_order_slip` = ' . $slip);
				}
				
				$tables = array('order_detail', 'order_discount', 'order_history');
				
				foreach ($tables as $table)
					Db::getInstance()->Execute('DELETE FROM `' . _DB_PREFIX_ . $table . '` WHERE `id_order` = ' . $orderId);
	        }
		}
	    
	    parent::postProcess();
	}
	
	public function display()
	{
		global $cookie;

		if (isset($_GET['view' . $this->table]))
			$this->viewDetails();
		elseif (isset($_GET['update' . $this->table]) || isset($_GET['add' . $this->table]))
		{
		    $this->displayForm();
		}
		else
		{
			$this->getList(intval($cookie->id_lang), !Tools::getValue($this->table.'Orderby') ? 'date_add' : NULL, !Tools::getValue($this->table.'Orderway') ? 'DESC' : NULL);
			$currency = new Currency(intval(Configuration::get('PS_CURRENCY_DEFAULT')));
			$this->displayList();
			echo '<h2 class="space" style="text-align:right; margin-right:44px;">'.$this->l('Total:').' '.Tools::displayPrice($this->getTotal(), $currency).'</h2>';
		}
	}
	
	public function displayForm($isMainTab = true)
	{
	    global $cookie;
		
		if (Tools::getIsset($this->identifier))
			$order = $this->loadObject();
			
		$defaultCurrency = Configuration::get('PS_CURRENCY_DEFAULT');
			
		$order         = (isset($order) && Validate::isLoadedObject($order)) ? $order : null;
		$discounts     = isset($order) ? floatval($order->total_discounts) : 0;
		$wrapping      = isset($order) ? floatval($order->total_wrapping) : 0;
		$shipping      = isset($order) ? floatval($order->total_shipping) : 0;
		$status        = isset($order) ? $order->getCurrentState() : null;
		$orderCurrency = isset($order) ? $order->id_currency : $defaultCurrency;
			
	    $language      = new Language(intval($cookie->id_lang));
	    $link          = new Link();
		$currency      = new Currency($defaultCurrency);
	    
	    echo '
	    <link rel="stylesheet" href="' . _MODULE_DIR_ . $this->module . '/css/style.css" />
		<script type="text/javascript">
            var ajaxPath = "' . _MODULE_DIR_ . $this->module . '/xhr/ajax.php";
            var id_lang  = ' . intval($cookie->id_lang) . ';
            var iem      = ' . intval($cookie->id_employee) . ';
            var iemp     = "' . $cookie->passwd . '";
            var labelNoComb = "' . $this->l('This product does not have combinations') . '";
			var currencySign   = "' . $currency->sign . '";
			var currencyRate   = '  . $currency->conversion_rate . ';
			var currencyFormat = "' . $currency->format . '";
			var currencyBlank  = '  . $currency->blank . ';
        </script>
		<script type="text/javascript" src="../modules/' . $this->module . '/js/jquery1.5.js"></script>
		<script type="text/javascript" src="../modules/' . $this->module . '/js/editor.js"></script>
		<link rel="stylesheet" type="text/css" href="' . __PS_BASE_URI__ . 'css/jquery.autocomplete.css" />
		<link rel="stylesheet" type="text/css" href="' . _MODULE_DIR_ . $this->module . '/css/style.css" />
		<script type="text/javascript" src="' . __PS_BASE_URI__ . 'js/jquery/jquery.autocomplete.js"></script>
		<img src="../modules/' . $this->module . '/images/logo.jpg" id="orliqueLogo" />
	    <div id="orderEditorContainer">
			<div id="halfBoxWrapper">
				<div id="hafBoxContainer">';
			
		if ( ! isset($order))
			$this->displayCustomerSelection();
		$this->displayStatusInfo($status, $language->id);
		$this->displayAddress($order, $link, $language, true);
		$this->displayAddress($order, $link, $language);
		$this->displayCurrencyInfo($orderCurrency);
		$this->displayDiscountInfo($discounts, $currency);
		$this->displayWrappingInfo($wrapping, $currency);
		$this->displayShippingInfo($order, $language->id, $currency, $shipping);
		$this->displayOrderTotals($order, $currency);
	    $this->displayProductSelection();
		$this->displayOrderedProducts($order, $currency);

	    echo '
				</div>
			</div>
	    </div>';
	}
	
	private static function createFieldset($contents, $id = false, $class = false, $legend = false, $icon = false)
	{
		$output = '
		<fieldset' . ($id ? ' id="' . $id . '"' : '') . ($class ? ' class="' . $class . '"' : '') . '>
			<legend>
				' . ($icon ? '<img src="' . $icon . '" /> ' : '') . ($legend ? $legend : '') .  '
			</legend>'
			. ($contents ? $contents : '') .
		'</fieldset>';
		
		return $output;
	}
	
	private static function createDropDown($values, $valueId, $valueName, $selectedValue = null, $id = false, $name = false, $class = false)
	{
		$output = '
		<select' . ($id ? ' id="' . $id . '"' : '') . ($class ? ' class="' . $class . '"' : '') . ($name ? ' name="' . $name . '"' : '') . '>';
		
		foreach ($values as $value)
			$output.= '
				<option value="' . $value[$valueId] . '"' . ($value[$valueId] == $selectedValue ? ' selected="selected"' : '') . '>' . $value[$valueName] . '</option>';
		
		$output.= '
		</select>';
		
		return $output;
	}
	
	private static function getModuleIdByName($name)
	{
		$sql = 'SELECT `id_module` FROM `' . _DB_PREFIX_ . 'module` WHERE `name` = "' . pSQL($name) . '"';
		
		$result = Db::getInstance()->getRow($sql);
		
		return isset($result['id_module']) ? (int)$result['id_module'] : null;
	}
	
    private function displayCustomerSelection()
    {
        global $cookie;
		
		$content = '
		<div id="ajax_create_customer">
			<a href="" id="customerCreate"><img src="../modules/' . $this->module . '/images/add.png" /> ' . $this->l('Create new customer') . '</a>
		</div>
		<div id="ajax_choose_customer" style="padding:6px; padding-top:2px; width:600px;">
			<p class="clear">' . $this->l('Please enter customer\'s name or email') . '</p>
			<input type="text" size="60" value="" id="customer_autocomplete_input" />
		</div>
		<script type="text/javascript">
			urlToCall = null;
			/* function autocomplete */
			$(function() {
				$(\'#customer_autocomplete_input\')
					.autocomplete(\'../modules/' . $this->module . '/xhr/ajax.php\', {
						minChars: 1,
						autoFill: true,
						max:20,
						matchContains: true,
						mustMatch:true,
						scroll:false,
						cacheLength:0,
						formatItem: function(item) {
							return item[1]+\' - \'+item[0];
						}
					}).result(requestCustomerInfo);
				$(\'#customer_autocomplete_input\').setOptions({
					extraParams: {type: 0, id_lang: id_lang, iem: iem, iemp: iemp}
				});
			});
		</script>
		<div id="customer">
		</div>';

		echo self::createFieldset($content, 'customerSelector', 'full', $this->l('Select customer'), '../modules/' . $this->module . '/images/customers.png');
    }
	
    private function displayProductSelection()
    {
        global $cookie;

        $content = '
		<div id="ajax_choose_product" style="padding:6px; padding-top:2px; width:600px;">
			<p class="clear">' . $this->l('Type in a name or a reference of the product you would like to add to this order') . '</p>
			<input type="text" size="60" value="" id="product_autocomplete_input" />
		</div>
		<script type="text/javascript">
			urlToCall = null;
			/* function autocomplete */
			$(function() {
				$(\'#product_autocomplete_input\')
					.autocomplete(\'../modules/' . $this->module . '/xhr/ajax.php\', {
						minChars: 1,
						autoFill: true,
						max:20,
						matchContains: true,
						mustMatch:true,
						scroll:false,
						cacheLength:0,
						formatItem: function(item) {
							return item[1]+\' - \'+item[0];
						}
					}).result(requestProductInfo);
				$(\'#product_autocomplete_input\').setOptions({
					extraParams: {type: 1, id_lang : id_lang, iem: iem, iemp: iemp}
				});
			});
		</script>
		<div id="productToAdd">
		</div>';
		
		echo self::createFieldset($content, 'productSelector', 'full', $this->l('Add products to order'), '../modules/' . $this->module . '/images/products.png');
    }
	
	
	private function displayStatusInfo($currentState, $language)
	{
		$orderStates = OrderState::getOrderStates($language);
		$dropDown    = self::createDropDown($orderStates, 'id_order_state', 'name', $currentState, 'orderStatus');
		
		echo self::createFieldset($dropDown, 'orderStates', 'full', $this->l('Status'), '../modules/' . $this->module . '/images/status.png');
	}
	
	
	private function displayCurrencyInfo($currentCurrency)
	{
		$currencies = Currency::getCurrencies(false);
		$dropDown   = self::createDropDown($currencies, 'id_currency', 'name', $currentCurrency, 'orderCurrency');
		
		echo self::createFieldset($dropDown, 'orderCurrencies', 'halfBox', $this->l('Order Currency'), '../modules/' . $this->module . '/images/currency.png');
	}
	
	
	private function displayAddress($order, $link, $language, $delivery = false)
	{
	    global $cookie;
		
		$fieldsetId    = 'address' . ($delivery ? 'delivery' : 'invoice');
		$fieldsetLabel = $delivery ? $this->l('Shipping address') : $this->l('Invoice address');
		$fieldsetIcon  = '../modules/' . $this->module . '/images/' . ($delivery ? 'shipping' : 'invoice') . '.png';
		
		$content = '
		<div class="addressContainer">';

		if (isset($order))
			$content.= $this->displayAddressInfo($order, $link, $language, $delivery);
		
		$content.= '
		</div>';
		
		echo self::createFieldset($content, $fieldsetId, 'halfBox', $fieldsetLabel, $fieldsetIcon);
	}

	
	private function displayAddressInfo($order, $link, $language, $delivery = false)
	{
	    global $cookie; 

		$address = new Address(intval($delivery ? $order->id_address_delivery : $order->id_address_invoice), $language->id);
		if (Validate::isLoadedObject($address) AND $address->id_state)
			$state = new State(intval($address->id_state));
		
		$output = '
		<div style="float: right">
			<a href="'.$link->getUrlWith('tab', 'AdminAddresses').'&id_address=' . $address->id . '&addaddress&realedit=1&id_order=' . $order->id . ($order->id_address_invoice == $order->id_address_delivery ? '&address_type=' . ($delivery ? '1' : '2') : '').'&token='.Tools::getAdminToken('AdminAddresses'.intval(Tab::getIdFromClassName('AdminAddresses')).intval($cookie->id_employee)).'&back='.urlencode($_SERVER['REQUEST_URI']).'"><img src="../img/admin/edit.gif" /></a>
			<a href="http://maps.google.com/maps?f=q&hl=' . $language->iso_code . '&geocode=&q=' . $address->address1.' '.$address->postcode.' '.$address->city.($address->id_state ? ' '.$state->name: '').'"><img src="../img/admin/google.gif" alt="" class="middle" /></a>
		</div>
		' . (!empty($address->company) ? $address->company.'<br />' : '') .$address->firstname . ' ' . $address->lastname . '<br />
		' . $address->address1.'<br />'. (!empty($address->address2) ? $address->address2.'<br />' : '') . '
		' . $address->postcode.' '.$address->city.'<br />
		' . $address->country.($address->id_state ? ' - '.$state->name : '') . '<br />
		' . ( ! empty($address->phone) ? $address->phone.'<br />' : '') . '
		' . ( ! empty($address->phone_mobile) ? $address->phone_mobile.'<br />' : '') . '
		' . ( ! empty($address->other) ? '<hr />' . $address->other . '<br />' : '');
		
		return $output;
	}
	
	
	private function displayShippingInfo($order, $idLang, $currency, $shippingPrice)
	{
		$carriers     = Carrier::getCarriers($idLang);
		$orderCarrier = isset($order) ? $order->id_carrier : null;
		$dropDown     = self::createDropDown($carriers, 'id_carrier', 'name', $orderCarrier, 'carrierNew');
		
		$output = '
		<label>' . $this->l('Carrier:') . '</label>
		<div class="formMargin">'
		. $dropDown . '
		<input type="button" class="button" id="autoCalculate" value="' . $this->l('Calculate automatically') . '" />
		</div>
		
		<label>' . $this->l('Shipping Price:') . '</label>
		<div class="formMargin" id="shippingPriceContainer">
			<p class="editable">
				<span class="customValue"></span>
				<span class="publicView">
					' . Tools::displayPrice($shippingPrice, $currency, false, false) . '
				</span>
				<span class="realValue">
					<input type="text" size="10" class="priceFormat" id="total_shipping" name="total_shipping" value="' . $shippingPrice . '" />
				</span>
			</p>
		</div>';
		
		echo self::createFieldset($output, 'orderCarriers', 'halfBox', $this->l('Shipping Information'), '../modules/' . $this->module . '/images/shipping.png');
	}
	
	
	private function displayDiscountInfo($discount, $currency)
	{
		$output = '
		<label>' . $this->l('Current discount:') . '</label>
		<div class="formMargin">
			<p class="editable">
				<span class="customValue"></span>
				<span class="publicView">
					' . Tools::displayPrice($discount, $currency, false, false) . '
				</span>
				<span class="realValue">
					<input type="text" size="10" class="priceFormat" id="total_discount" name="total_discount" value="' . $discount . '" />
					<input type="radio" name="discountType" id="discountType_val" value="1" checked="checked" />
					<label class="t" for="discountType_val">' . $this->l('Value') . '</label>
					<input type="radio" name="discountType" id="discountType_per" value="0" />
					<label class="t" for="discountType_per">' . $this->l('Percent') . '</label>
				</span>
			</p>
		</div>';
		
		echo self::createFieldset($output, 'orderDiscounts', 'halfBox', $this->l('Discount'), '../modules/' . $this->module . '/images/currency.png');
	}
	
	
	private function displayWrappingInfo($wrapping, $currency)
	{
		$output = '
			<label>' . $this->l('Current price:') . '</label>
			<div class="formMargin">
				<p class="editable">
					<span class="customValue"></span>
					<span class="publicView">
						' . Tools::displayPrice($wrapping, $currency, false, false) . '
					</span>
					<span class="realValue">
						<input type="text" size="10" id="total_wrapping" class="priceFormat" name="total_wrapping" value="' . $wrapping . '" />
					</span>
				</p>
			</div>';
		
		echo self::createFieldset($output, 'orderWrapping', 'halfBox', $this->l('Wrapping'), '../modules/' . $this->module . '/images/wrapping.png');
	}

	
	private function displayOrderTotals($order, $currency)
	{
		$paymentModId = isset($order) ? self::getModuleIdByName($order->module) : null;
		$paymentName  = isset($order) ? $order->payment : null;
		$discounts    = isset($order) ? $order->total_discounts : 0;
		$wrapping     = isset($order) ? $order->total_wrapping : 0;
		$shipping     = isset($order) ? $order->total_shipping : 0;
		$totalPaid    = isset($order) ? $order->total_paid : 0;
		$totalPaidR   = isset($order) ? $order->total_paid_real : 0;
		
		$paymentModules = array();
		$modules = Module::getModulesOnDisk();
		
		foreach ($modules AS $module)
			if (($module->tab == 'Payment' || $module->tab == 'payments_gateways') && isset($module->id))
				$paymentModules[] = (array)$module;
				
		$dropDown = self::createDropDown($paymentModules, 'id', 'displayName', $paymentModId, 'paymentModule');
			
		$totalProducts = isset($order) ? $order->getTotalProductsWithTaxes() : 0;

		$output = '';
		
		if (isset($paymentName))
			$output.= '
			<label>' . $this->l('Payment:') . ' </label>
			<div class="formMargin">
				' . $paymentName . '
			</div>';
			
		$output = '
			<label>' . $this->l('Payment Method:') . ' </label>
			<div class="formMargin">
				'	. $dropDown . '
			</div>
			<div class="formMargin">
				<table class="table" width="300px;" cellspacing="0" cellpadding="0">
					<tr>
						<td width="150px;">
							' . $this->l('Products') . '
						</td>
						<td align="right" id="orderTotalProducts">
							<span class="customValue orderDetails">' . Tools::displayPrice($totalProducts, $currency, false, false) . '</span>
							<input type="hidden" id="orderTotalProductsF" value="' . $totalProducts . '" />
						</td>
					</tr>
					<tr>
						<td>
							' . $this->l('Discounts') . '
						</td>
						<td align="right" id="orderTotalDiscounts">
							<span class="customValue orderDetails">' . Tools::displayPrice($discounts, $currency, false, false) . '</span>
						</td>
					</tr>
					<tr>
						<td>
							' . $this->l('Wrapping') . '
						</td>
						<td align="right" id="orderWrappingPrice">
							<span class="customValue orderDetails">' . Tools::displayPrice($wrapping, $currency, false, false) . '</span>
						</td>
					</tr>
					<tr>
						<td>
							' . $this->l('Shipping') . '
						</td>
						<td align="right" id="orderShippingPrice">
							<span class="customValue orderDetails">' . Tools::displayPrice($shipping, $currency, false, false) . '</span>
						</td>
					</tr>
					<tr style="font-size: 20px">
						<td>' . $this->l('Total') . '</td>
						<td align="right" id="orderTotalPrice">
							<span class="customValue orderDetails">' . Tools::displayPrice($totalPaid, $currency, false, false) . ($totalPaid != $totalPaidR ? '<br /><font color="red">(' . $this->l('Paid:') . ' ' . Tools::displayPrice($totalPaidR, $currency, false, false).')</font>' : '') . '</span>
							<input type="hidden" id="orderTotalPriceF" value="' . $totalPaid . '" />
						</td>
					</tr>
				</table>
			</div>';
		
		echo self::createFieldset($output, 'orderTotalsWrapper', 'halfBox', $this->l('Order details'), '../modules/' . $this->module . '/images/view.png');
	}
	
	
	private function displayOrderedProducts($order, $currency)
	{
		global $currentIndex, $cookie;
		
		$discounts  = isset($order) ? $order->getDiscounts() : 0;
		$products   = isset($order) ? $order->getProducts() : array();
		$orderId    = isset($order) ? (int)$order->id : false;
		$weightUnit = Configuration::get('PS_WEIGHT_UNIT');
		
		$result = '
        <script type="text/javascript">
            var ajaxPath       = "' . _MODULE_DIR_ . $this->module . '/xhr/ajax.php";
            var id_lang        = '  . intval($cookie->id_lang) . ';
            var iem            = '  . intval($cookie->id_employee) . ';
            var iemp           = "' . $cookie->passwd . '";
            var labelNoComb    = "' . $this->l('This product does not have combinations') . '";
			var weightUnit     = "' . $weightUnit . '";
			var weightUnit     = "' . $weightUnit . '";
			var deleteRowLabel = "' . $this->l('Delete this row') . '";
        </script>
		<form method="post" id="orderForm" action="' . _MODULE_DIR_ . $this->module . '/xhr/ajax.php">
			<input type="hidden" id="orderId" name="orderId" value="' . $orderId . '" />
			<fieldset class="full" id="orderedProductsWrapper">
				<legend>
					<img src="../modules/' . $this->module . '/images/add_to_order.png" alt="' . $this->l('Products') . '" />' . $this->l('Products') . '
				</legend>
				<div style="overflow: hidden;">
					<table class="table" cellspacing="0" cellpadding="0" id="orderContents">
						<thead>
							<tr>
								<th>' . $this->l('Image') . '</th>
								<th width="220">' . $this->l('Product') . '</th>
								<th>' . $this->l('Reference') . '</th>
								<th>' . $this->l('Quantity') . '</th>
								<th>' . $this->l('Weight') . '</th>
								<th>' . $this->l('Price (tax excl.)') . '</th>
								<th>' . $this->l('Tax rate') . '</th>
								<th>' . $this->l('Price (tax incl.)') . '</th>
								<th>' . $this->l('Total (tax incl.)') . '</th>
								<th></th>
							</tr>
						</thead>
						<tbody>';
						$tokenCatalog = Tools::getAdminToken('AdminCatalog'.intval(Tab::getIdFromClassName('AdminCatalog')).intval($cookie->id_employee));
					
						foreach ($products as $k => $product)
						{
							$image = array();
							
							if (isset($product['product_attribute_id']) && intval($product['product_attribute_id']))
								$image = Db::getInstance()->getRow('
									SELECT id_image
									FROM '._DB_PREFIX_.'product_attribute_image
									WHERE id_product_attribute = '.intval($product['product_attribute_id'])
								);
							
							if ( ! isset($image['id_image']) || ! $image['id_image'])
								$image = Db::getInstance()->getRow('
									SELECT id_image
									FROM ' . _DB_PREFIX_ . 'image
									WHERE id_product = '.intval($product['product_id']).'
									AND cover        = 1'
								);
						
							if (isset($image['id_image']))
							{
								$target = '../img/tmp/product_mini_' . intval($product['product_id']) . (isset($product['product_attribute_id']) ? '_' . intval($product['product_attribute_id']) : '') . '.jpg';
								if (file_exists($target))
									$products[$k]['image_size'] = getimagesize($target);
							}
						
							$result.= '
							<tr id="od_' . $product['id_order_detail'] . '"' . ((isset($image['id_image']) && isset($products[$k]['image_size'])) ? ' height="' . ($products[$k]['image_size'][1] + 7) . '"' : '') . '>
								<td align="center">
									' . (isset($image['id_image']) ? cacheImage(_PS_IMG_DIR_ . 'p/' . intval($product['product_id']) . '-' . intval($image['id_image']) . '.jpg','product_mini_' . intval($product['product_id']) . (isset($product['product_attribute_id']) ? '_' . intval($product['product_attribute_id']) : '') . '.jpg', 45, 'jpg') : '--') . '
									<input type="hidden" class="indexProduct" name="product[' . $k . '][' . $product['product_id'] . '][index]" value="' . $k . '" />
									<input type="hidden" class="orderDetailId" name="product[' . $k . '][' . $product['product_id'] . '][order_detail]" value="' . $product['id_order_detail'] . '" />
									<input type="hidden" name="product[' . $k . '][' . $product['product_id'] . '][product_attribute]" value="' . $product['product_attribute_id'] . '" />
								</td>
								<td class="editable productName">
									<span class="customValue"></span>
									<span class="publicView">
										' . str_replace(array("\r\n", "\n", "\r"), '<br />', $product['product_name']) . '
									</span>
									<span class="realValue">
										<textarea name="product[' . $k . '][' . $product['product_id'] . '][name]">' . str_replace('<br />', "\n", $product['product_name']) . '</textarea>
									</span>
								</td>
								<td class="editable productReference">
									<span class="customValue"></span>
									<span class="publicView">
										' . ($product['product_reference'] != '' ? $product['product_reference'] : 'N/A') . '
									</span>
									<span class="realValue">
										<input type="text" size="20" name="product[' . $k . '][' . $product['product_id'] . '][reference]" value="' . $product['product_reference'] . '" />
									</span>
								</td>
								<td class="editable productQuantity">
									<span class="customValue"></span>
									<span class="publicView">
										' . (intval($product['product_quantity'])) . '
									</span>
									<span class="realValue">
										<input type="text" size="3" class="orderPQuantity" name="product[' . $k . '][' . $product['product_id'] . '][quantity]" value="' . $product['product_quantity'] . '" />
									</span>
								</td>
								<td class="editable productWeight">
									<span class="customValue"></span>
									<span class="publicView">
										' . (floatval($product['product_weight'])) . $weightUnit . '
									</span>
									<span class="realValue">
										<input type="text" size="3" class="weightFormat" name="product[' . $k . '][' . $product['product_id'] . '][weight]" value="' . floatval($product['product_weight']) . '" />
									</span>
								</td>
								<td class="editable">
									<span class="customValue"></span>
									<span class="publicView">
										' . Tools::displayPrice($product['product_price'], $currency, false, false) . '
									</span>
									<span class="realValue">
										<input type="text" size="6" class="orderPPrice cpOnKeyUp priceFormat" name="product[' . $k . '][' . $product['product_id'] . '][price]" value="' . $product['product_price'] . '" />
									</span>
								</td>
								<td class="editable productTax">
									<span class="customValue"></span>
									<span class="publicView">
										' . $product['tax_rate'] . '
									</span>
									<span class="realValue">
										<input type="text" class="cpOnKeyUp percentageFormat" size="6" name="product[' . $k . '][' . $product['product_id'] . '][tax_rate]" value="' . $product['tax_rate'] . '" />
									</span>
								</td>
								<td class="editable">
									<span class="customValue"></span>
									<span class="publicView">
										' . Tools::displayPrice($product['product_price_wt'], $currency, false, false) . '
									</span>
									<span class="realValue">
										<input type="text" class="orderPPriceWt cpOnKeyUp priceFormat" size="6" name="product[' . $k . '][' . $product['product_id'] . '][price_wt]" value="' . $product['product_price_wt'] . '" />
									</span>
								</td>
								<td class="productsTotalPrice">
									' . Tools::displayPrice($product['product_price_wt'] * intval($product['product_quantity']), $currency, false, false) . '
								</td>
								<td align="center">
									<span class="control deleteProduct"></span>
								</td>
							</tr>';
						}
			$result.= '
					</tbody>
					</table>
				</div>
				<input type="hidden" name="submitOrderChange" value="1" />
				<input style="margin-top: 1em;" type="submit" class="button" value="' . $this->l('Save order') . '" />
			</fieldset>
		</form>';
		
		echo $result;

	}

	
	public function displayList()
	{
		global $currentIndex;
		
		echo '
		<link rel="stylesheet" href="' . _MODULE_DIR_ . $this->module . '/css/style.css" />
		<img src="../modules/' . $this->module . '/images/logo.jpg" id="orliqueLogo" />';

		if ($this->edit AND (!isset($this->noAdd) OR !$this->noAdd))
			echo '<br /><a href="'.$currentIndex.'&add'.$this->table.'&token='.$this->token.'"><img src="../img/admin/add.gif" border="0" /> '.$this->l('Add new Order').'</a><br /><br />';
		/* Append when we get a syntax error in SQL query */
		if ($this->_list === false)
		{
			$this->displayWarning($this->l('Bad SQL query'));
			return false;
		}

		/* Display list header (filtering, pagination and column names) */
		$this->displayListHeader();
		if (!sizeof($this->_list))
			echo '<tr><td class="center" colspan="'.(sizeof($this->fieldsDisplay) + 2).'">'.$this->l('No items found').'</td></tr>';

		/* Show the content of the table */
		$this->displayListContent();

		/* Close list table and submit button */
		$this->displayListFooter();
	}
	
	
	public function displayListFooter($token = NULL)
	{
	    global $cookie;
	    
	    $orderStates = OrderState::getOrderStates(intval($cookie->id_lang));
		echo '
					</table>
						<p>';
		echo self::createDropDown($orderStates, 'id_order_state', 'name', false, false, 'id_order_state');
		echo '
							<input type="submit" class="button" name="submitStateChange'.$this->table.'" value="'.$this->l('Change Status').'" />
							<input type="submit" class="button" name="submitDel'.$this->table.'" value="'.$this->l('Delete selection').'" onclick="return confirm(\''.$this->l('Delete selected items?', __CLASS__, TRUE, FALSE).'\');" />';
		echo '
						</p>
					</td>
				</tr>
			</table>
			<input type="hidden" name="token" value="'.($token ? $token : $this->token).'" />
		</form>';
		if (isset($this->_includeTab) AND sizeof($this->_includeTab))
			echo '<br /><br />';
	}
	
	public function displayListHeader($token = null)
	{
		global $currentIndex;
		
		parent::displayListHeader($this->token);
		
		$filters = Tools::getValue('exFilter');
		
		echo '
		<tr class="advancedFilter">
			<td colspan="10">
				<table class="table" cellspacing="0" cellpadding="0" width="100%">
					<tr>
						<th colspan="2">
							' . $this->l('Advanced Order Search') . '
						</th>
					</tr>
					<tr class="filterRow">
						<td class="filterDesc">' . $this->l('Product reference:') . '</td>
						<td class="filterInput">
							<input type="text" name="exFilter[product_reference]" value="' . (isset($filters['product_reference']) ? $filters['product_reference'] : '') . '" />
						</td>
					</tr>
					<tr class="filterRow">
						<td class="filterDesc">' . $this->l('Supplier reference:') . '</td>
						<td class="filterInput">
							<input type="text" name="exFilter[product_supplier_reference]" value="' . (isset($filters['product_supplier_reference']) ? $filters['supplier_reference'] : '') . '" />
							<i>' . $this->l('This will only work for orders placed as usual, through FO') . '</i>
						</td>
					</tr>
					<tr class="filterRow">
						<td class="filterDesc">' . $this->l('Product name:') . '</td>
						<td class="filterInput">
							<input type="text" name="exFilter[product_name]" value="' . (isset($filters['product_name']) ? $filters['product_name'] : '') . '" />
						</td>
					</tr>
				</table>
			</td>
		</tr>';
	}
	
	private function getTotal()
	{
		global $cookie;
		
		$total = 0;
		foreach($this->_list AS $item)
			if ($item['id_currency'] == Configuration::get('PS_CURRENCY_DEFAULT'))
				$total += floatval($item['total_paid']);
			else
			{
				$currency = new Currency(intval($item['id_currency']));
				$total += self::roundPrice(floatval($item['total_paid']) / floatval($currency->conversion_rate), 2);
			}
		return $total;
	}
}
?>