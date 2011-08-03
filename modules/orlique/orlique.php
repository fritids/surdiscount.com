<?php
/*
 * Orlique
 *
 * An Order Manager for Prestashop
 *
 * @package		Silbersaiten
 * @author		George June <j.june@silbersaiten.de>
 * @copyright	Copyright (c) 2010, Silbersaiten GbR
 * @license		End User License Agreement (EULA)
 * @link		http://silbersaiten.de
 * @since		Version 1.0.3
 */
@ini_set('display_errors', 'off');

class Orlique extends Module
{
    private $_html = '';
    private $_postErrors = array();
    
    public function __construct()
    {
        $this->name    = 'orlique';
        $this->tab     = 'Silbersaiten';
        $this->version = '1.0.3';
        
        parent::__construct();
        
        $this->displayName = $this->l('Orlique');
        $this->description = $this->l('Silbersaiten Order Manager');
    }
	
	public function install()
	{
		if ( ! parent::install())
			return false;
		
		return $this->installModuleTab('AdminOrderEdit', 'Order Manager');
	}
	
	public function uninstall()
	{
		$sql = '
		SELECT `id_tab` FROM `' . _DB_PREFIX_ . 'tab` WHERE `module` = "' . pSQL($this->name) . '"';
		
		$result = Db::getInstance()->ExecuteS($sql);
		
		if ($result && sizeof($result))
		{
			foreach ($result as $tabData)
			{
				$tab = new Tab($tabData['id_tab']);
				
				if (Validate::isLoadedObject($tab))
					$tab->delete();
			}
		}
		
		return parent::uninstall();
	}
	
	static public function jsonEncode($json)
	{
		if (function_exists('json_encode'))
			return json_encode($json);
		elseif (method_exists('Tools', 'jsonEncode'))
			return Tools::jsonEncode($json);
		else
		{
			if (is_null($json)) return 'null';
			if ($json === false) return 'false';
			if ($json === true) return 'true';
			if (is_scalar($json))
			{
				if (is_float($json))
				{
					// Always use "." for floats.
					return (float)(str_replace(",", ".", strval($json)));
				}

				if (is_string($json))
				{
					static $jsonReplaces = array(array("\\", "/", "\n", "\t", "\r", "\b", "\f", '"'), array('\\\\', '\\/', '\\n', '\\t', '\\r', '\\b', '\\f', '\"'));
					return '"' . str_replace($jsonReplaces[0], $jsonReplaces[1], $json) . '"';
				}
				else
					return $json;
			}
			
			$isList = true;
			
			for ($i = 0, reset($json); $i < count($json); $i++, next($json))
			{
				if (key($json) !== $i)
				{
					$isList = false;
					break;
				}
			}
			
			$result = array();
			
			if ($isList)
			{
				foreach ($json as $v) $result[] = self::jsonEncode($v);
				return '[' . join(',', $result) . ']';
			}
			else
			{
				foreach ($json as $k => $v) $result[] = self::jsonEncode($k).':'.self::jsonEncode($v);
				return '{' . join(',', $result) . '}';
			}
		}
	}
    
    private function copyLogo($class)
    {
        return @copy(dirname(__FILE__) . '/logo.gif', _PS_IMG_DIR_ . 't/' . $class . '.gif');
    }
    
    private function installModuleTab($class, $name)
    {
		$sql = '
		SELECT `id_tab` FROM `' . _DB_PREFIX_ . 'tab` WHERE `class_name` = "AdminOrders"';
		
		$tabParent = intval(Db::getInstance()->getValue($sql));
		
        if ( ! is_array($name))
            $name = self::getMultilangField($name);
            
        if (self::fileExistsInModulesDir('logo.gif') && is_writeable(_PS_IMG_DIR_ . 't/'))
            $this->copyLogo($class);
                
        $tab = new Tab();
        $tab->name       = $name;
        $tab->class_name = $class;
        $tab->module     = $this->name;
        $tab->id_parent  = $tabParent;
        
        return $tab->save();
    }
    
    private static function fileExistsInModulesDir($file)
    {
        return file_exists(dirname(__FILE__) . '/' . $file);
    }
	
    public static function checkEmployee($id, $passwd)
    {
        return Employee::checkPassword($id, $passwd);
    }

    private static function getMultilangField($field)
    {
        $languages = Language::getLanguages();
        $res = array();
        
        foreach ($languages AS $lang)
            $res[$lang['id_lang']] = $field;
            
        return $res;
    }
    
	public function ajaxProductList($idLang, $query)
    {
        if ( ! $query || $query == '' || strlen($query) < 1)
	        die();
			
		$sql = '
        SELECT  p.`id_product`,
                p.`reference` ,
               pl.`name`
        FROM `' . _DB_PREFIX_ . 'product` p
            LEFT JOIN `' . _DB_PREFIX_ . 'product_lang` pl
            ON  (
                    pl.id_product = p.id_product
                )
        WHERE (pl.name LIKE "%' . pSQL($query) . '%" OR  p.reference LIKE "%' . pSQL($query) . '%")
        AND pl.id_lang = ' . intval($idLang);

        $products = Db::getInstance()->ExecuteS($sql);
		
        if ($products && sizeof($products))
	        foreach ($products as $product)
		        echo $product['name'] . ( ! empty($product['reference']) ? ' (' . $product['reference'] . ')' : '') . '|' . intval($product['id_product']) . "\n";
    }
	
	public function ajaxCustomerList($query)
    {
        if ( ! $query || $query == '' || strlen($query) < 1)
	        die();
			
		$sql = '
		SELECT `id_customer`                                  ,
			`firstname`                                       ,
			`lastname`                                        ,
			`email`
		FROM `' . _DB_PREFIX_ . 'customer`
		WHERE (
				`firstname` LIKE "%' . pSQL($query) . '%"
			OR  `lastname`  LIKE "%' . pSQL($query) . '%"
			OR  CONCAT(`firstname`, " ", `lastname`) LIKE "%' . pSQL($query) . '%"
			OR  `email`     LIKE "%' . pSQL($query) . '%"
			)';

        $customers = Db::getInstance()->ExecuteS($sql);
		
        if ($customers && sizeof($customers))
	        foreach ($customers as $customer)
		        printf("%s %s (%s) | %d\n", $customer['firstname'], $customer['lastname'], $customer['email'], (int)$customer['id_customer']);
    }
	
    private static function checkId($ids)
    {
        if ( ! is_array($ids))
            return Validate::isUnsignedId($ids);
            
        foreach ($ids as $id)
            if ( ! Validate::isUnsignedId($id))
                return false;
                
        return true;
    }
	
	private static function updateTable($table, $identifier, $id, $data)
	{
		return Db::getInstance()->AutoExecute(_DB_PREFIX_ . $table, $data, 'UPDATE', $identifier . ' = ' . $id);
	}
	
	private static function insertIntoTable($table, $data)
	{
		$result = Db::getInstance()->AutoExecute(_DB_PREFIX_ . $table, $data, 'INSERT');

		if ($result && $id = Db::getInstance()->Insert_ID())
			return $id;

		return false;
	}
	
	private static function roundPrice($price, $precision)
	{
		if (method_exists('Tools', 'ps_round'))
			return Tools::ps_round($price, $precision);
		else
			return number_format($price, $precision, '.', '');
	}
	
	
	private static function getCurrentOrderDetails($orderObj)
	{
		if ( ! Validate::isLoadedObject($orderObj))
			return false;
		
		$products = $orderObj->getProductsDetail();
		
		if ( ! $products || ! sizeof($products))
			return false;
		
		$result = array();
		
		foreach ($products as $product)
		{
			array_push($result, $product['id_order_detail']);
		}
		
		return $result;
	}

	
	private static function getAmountAlreadyInOrder($idOrderDetail, $productId, $combinationId = null)
	{
		$sql = '
		SELECT `product_quantity`
		FROM `' . _DB_PREFIX_ . 'order_detail`
		WHERE `id_order_detail`    = ' . (int)$idOrderDetail . '
		AND `product_id`           = ' . (int)$productId .
		((isset($combinationId) && Validate::isUnsignedInt($combinationId)) ? ' AND `product_attribute_id` = ' . (int)$combinationId : '');

		$result = Db::getInstance()->getValue($sql);
		
		return (int)$result;
	}
	
	
	public static function orderDetailIsDeletable($orderDetailId)
	{
		$sql = '
		SELECT `id_order`
		FROM `' . _DB_PREFIX_ . 'order_detail`
		WHERE `id_order_detail` = ' . (int)$orderDetailId;
		
		if ( ! $orderId = Db::getInstance()->getValue($sql))
			return false;
		
		$sql = '
		SELECT COUNT(*) AS `nb`
		FROM `' . _DB_PREFIX_ . 'order_detail`
		WHERE `id_order` = ' . (int)$orderId;
		
		return Db::getInstance()->getValue($sql) > 1;
	}
	
	public static function purgeOrder($orderId)
	{
		$sql = '
		DELETE FROM `' . _DB_PREFIX_ . 'order_detail` WHERE `id_order` = ' . (int)$orderId;

		Db::getInstance()->Execute($sql);
		
		if (Validate::isLoadedObject($order = new Order($orderId)))
		{
			$order->total_products = $order->total_products_wt = $order->total_paid = $order->total_paid_real = 0;
			
			return $order->update();
		}
		
		return false;
	}
	
	public function getShippingPrice($data)
	{
		$carrierId           = (int)($data['carrier']);
		$orderId             = (isset($data['orderId'])  && (int)$data['orderId'] > 0) ? (int)$data['orderId'] : null;
		$orderExists         = isset($orderId);
		$id_address_delivery = $id_address_invoice = $id_customer = false;
		$shippingCost        = 0;
		$errors              = array();
		
		if ( ! $orderExists)
		{
			if ( ! isset($data['delivery']) || ! Validate::isUnsignedInt($data['delivery'])
			|| ( ! isset($data['invoice'])  || ! Validate::isUnsignedInt($data['invoice']))
			|| ( ! isset($data['customer']) || ! Validate::isUnsignedInt($data['customer'])))
			{
				$errors[] = $this->l('You need to assign this order to a customer and select addresses first');
			}
			else
			{
				$id_address_delivery = (int)$data['delivery'];
				$id_address_invoice  = (int)$data['invoice'];
				$id_customer         = (int)$data['customer'];
			}
		}
		else
		{
			if (Validate::isLoadedObject($order = new Order($orderId)))
			{
				$id_address_delivery = $order->id_address_delivery;
				$id_address_invoice  = $order->id_address_invoice;
				$id_customer         = $order->id_customer;
			}
		}
		
		if ( ! $id_address_invoice || ! $id_address_delivery || ! $id_customer)
			$errors[] = $this->l('An error occured: can\'t get delivery address/customer ID');
		
		if (! sizeof($errors))
		{
			if (Validate::isUnsignedId($carrierId) && Validate::isLoadedObject($carrier = new Carrier($carrierId)))
			{
				$id_zone          = Address::getZoneById((int)($id_address_delivery));
				$shippingMethod   = Configuration::Get('PS_SHIPPING_METHOD');
				$dicounts         = floatval($data['discounts']);
				$wrapping         = floatval($data['wrapping']);
				$totalProducts    = 0;
				$totalProducts_wt = 0;
				$totalWeight      = 0;
				$orderTotal       = 0;
				
				if (isset($data['product']) && sizeof($data['product']))
				{
					$productInfo = array();
					
					foreach ($data['product'] as $productIndex => $product)
					{
						foreach ($product as $productId => $productData)
						{
							$quantity    = Validate::isInt($productData['quantity']) ? (int)$productData['quantity'] : 1;
							$price       = Validate::isPrice($productData['price']) ? self::roundPrice($productData['price'], 6) : 0;
							$price_wt    = Validate::isPrice($productData['price_wt']) ? self::roundPrice($productData['price_wt'], 6) : 0;
							$weight      = floatval($productData['weight']);
							
							$totalProducts    += $price * $quantity;
							$totalProducts_wt += $price_wt * $quantity;
							$totalWeight      += $weight * $quantity;
						}
					}
					
					$orderTotal = $totalProducts_wt + $wrapping - $dicounts;

					if ( ! Carrier::checkCarrierZone($carrierId, $id_zone))
					{
						$errors[] = $this->l('This carrier can not deliver to this address');
					}
					else
					{
						if (intval($shippingMethod))
						{
							$shippingCost = $carrier->getDeliveryPriceByWeight($totalWeight, $id_zone);
						}
						else
						{
							$shippingCost = $carrier->getDeliveryPriceByPrice($orderTotal, $id_zone);
						}
					}
				}
			}
			else
			{
				$errors[] = $this->l('Could not find selected carrier');
			}
		}
		
		if (sizeof ($errors))
		{
			return self::jsonEncode(array('errors' => $errors));
		}
		else
		{
			return self::jsonEncode(array(
				'message'		 => $this->l('Shipping price calculated successfully'),
				'shipping_price' => $shippingCost
			));
		}
	}
	
	
	public static function deleteProductFromOrder($idOrderDetail, $restoreQuties = true)
	{
		$detailObj = new OrderDetail($idOrderDetail);
		
		if (Validate::isLoadedObject($detailObj))
		{
			$productId = $detailObj->product_id;
			$attribute = isset($detailObj->product_attribute_id) && $detailObj->product_attribute_id != 0 ? $detailObj->product_attribute_id : null;
			$quantity  = $detailObj->product_quantity;
			
			if ($restoreQuties)
			{
				Product::updateQuantity(array(
						'id_product'           => $productId,
						'id_product_attribute' => $attribute,
						'quantity'             => intval($quantity) * -1,
					),
					$detailObj->id_order
				);
			}
			
			$detailObj->delete();
		}
	}
	
	
	public static function updateQtyInCart($cart, $products, $delete = false)
	{
		if ($delete)
		{
			$cartProducts = $cart->getProducts();
			
			if (sizeof($cartProducts))
			{				
				foreach ($cartProducts as $product)
				{
					$cart->deleteProduct($product['id_product'], (isset($product['id_product_attribute']) && $product['id_product_attribute'] != 0) ? $product['id_product_attribute'] : null);
				}
			}
		}
		
		foreach ($products as $orderDetail)
		{
			$productId       = $orderDetail['product_id'];
			$attribute       = $orderDetail['product_attribute_id'] != 0 ? $orderDetail['product_attribute_id'] : null;
			$wantedQuantity  = $orderDetail['product_quantity'];
			$cart->updateQty($wantedQuantity, $productId, $attribute);
		}
	}
	
	
	public function updateOrder($data)
	{
		$errors      = array();
		$productErrors = array();
		$payment     = Module::getInstanceById((int)$data['payment']);
		$orderId     = (isset($data['orderId'])  && (int)$data['orderId'] > 0) ? (int)$data['orderId'] : null;
		$currency    = new Currency((isset($data['currency']) && Validate::isUnsignedInt($data['currency'])) ? (int)$data['currency'] : Configuration::get('PS_CURRENCY_DEFAULT'));
		$status      = (isset($data['status']) && Validate::isUnsignedInt($data['status'])) ? (int)$data['status'] : null;
		$orderExists = isset($orderId);
		$idLang      = Configuration::get('PS_LANG_DEFAULT');
		$allowOutOfStock = (bool)intval(Configuration::get('PS_ORDER_OUT_OF_STOCK'));
		$manageStock     = (bool)intval(Configuration::get('PS_STOCK_MANAGEMENT'));
		
		if ( ! isset($status))
			$errors[] = $this->l('Invalid order status');
			
		if ( ! Validate::isLoadedObject($payment))
			$errors[] = $this->l('Invalid payment module');
		
		$orderInfo = array(
			'total_discounts'   => floatval($data['discounts']),
			'total_products'    => 0,
			'total_products_wt' => 0,
			'total_paid'        => 0,
			'total_paid_real'   => 0,
			'total_shipping'    => floatval($data['total_shipping']),
			'total_wrapping'    => floatval($data['wrapping']),
			'id_carrier'		=> intval($data['carrier']),
			'id_currency'       => $currency->id,
			'conversion_rate'   => floatval($currency->conversion_rate)
		);
		
		if ( ! $orderExists)
		{
			if ( ! isset($data['delivery']) || ! Validate::isUnsignedInt($data['delivery'])
			|| ( ! isset($data['invoice'])  || ! Validate::isUnsignedInt($data['invoice']))
			|| ( ! isset($data['customer']) || ! Validate::isUnsignedInt($data['customer'])))
			{
				$errors[] = $this->l('Please select a customer and assign shipping and invoice addresses');
			}
			else
			{
				$orderInfo['id_address_delivery'] = (int)$data['delivery'];
				$orderInfo['id_address_invoice']  = (int)$data['invoice'];
				$orderInfo['id_customer']         = (int)$data['customer'];
				$orderInfo['id_currency']         = $currency->id;
				$orderInfo['id_lang']             = $idLang;
			}
		}

		$orderInfo['module']  = $payment->name;
		
		if (isset($data['product']) && sizeof($data['product']))
		{
			$productInfo = array();
			foreach ($data['product'] as $productIndex => $product)
			{
				foreach ($product as $productId => $productData)
				{
					$skip        = false;
					$price       = Validate::isPrice($productData['price']) ? self::roundPrice($productData['price'], 6) : 0;
					$price_wt    = Validate::isPrice($productData['price_wt']) ? self::roundPrice($productData['price_wt'], 6) : 0;
					$tax_rate    = Validate::isFloat($productData['tax_rate']) ? self::roundPrice($productData['tax_rate'], 6) : 0;
					$quantity    = Validate::isInt($productData['quantity']) ? (int)$productData['quantity'] : 1;
					$attribute   = (int)$productData['product_attribute'];
					$orderDetail = isset($productData['order_detail']) ? (int)$productData['order_detail'] : null;

					$availableQuantity = Product::getQuantity($productId, $attribute != 0 ? $attribute : null);
					$availableQuantity = $availableQuantity < 0 ? 0 : $availableQuantity;
					$orderQuantity     = 0;
					
					if ($orderDetail)
						$orderQuantity = self::getAmountAlreadyInOrder($orderDetail, $productId, $attribute != 0 ? $attribute : null);
					
					$wantedQuantity = $quantity - $orderQuantity;
					
					if ($wantedQuantity > $availableQuantity && ! $allowOutOfStock)
					{
						$productErrors[] = $this->l('Not enough quantity in stock for product') . ' "' . $productData['name'] . '"';
						$quantity = $availableQuantity > 0 ? $availableQuantity : 0;
						$skip = true;
					}

					if ( ! $skip)
					{
						$productInfo[] = array(
							'index' 			   => (int)$productData['index'],
							'product_id'	       => (int)$productId,
							'product_attribute_id' => (int)$productData['product_attribute'],
							'product_price'        => $price,
							'id_order_detail'      => $orderDetail,
							'product_name'         => $productData['name'],
							'product_reference'	   => $productData['reference'],
							'wanted_quantity'	   => $wantedQuantity,
							'product_price'        => $price,
							'product_weight'	   => floatval($productData['weight']),
							'product_quantity'     => $quantity,
							'tax_rate'             => $tax_rate
						);
							
						$orderInfo['total_products']    += $price    * $quantity;
						$orderInfo['total_paid']        += $price_wt * $quantity;
						$orderInfo['total_products_wt'] += $price_wt * $quantity;
					}
				}
			}
				
			$orderInfo['total_paid']      = $orderInfo['total_paid'] + $orderInfo['total_shipping'] + $orderInfo['total_wrapping'] - $orderInfo['total_discounts'];
			$orderInfo['total_paid_real'] = $orderInfo['total_paid'];

			if ( ! sizeof($errors))
			{
				$order = new Order($orderId);
				
				if (isset($orderId))
				{
					$orderProducts = self::getCurrentOrderDetails($order);
					$orliqueProducts = array();
					
					foreach ($productInfo as $orliqueOrdered)
						if (isset($orliqueOrdered['id_order_detail']))
							array_push($orliqueProducts, $orliqueOrdered['id_order_detail']);

					$obsoleteProducts = (array_diff($orderProducts, $orliqueProducts));
					
					if (sizeof($obsoleteProducts))
						foreach ($obsoleteProducts as $idOrderDetail)
							self::deleteProductFromOrder($idOrderDetail);
				}
				
				foreach ($orderInfo as $field => $value)
					if (property_exists($order, $field))
						$order->{$field} = $value;
						

				// If it's a new order, we need to create a cart for it
				if ( ! $orderExists)
				{
					$cart = new Cart();
					
					foreach ($orderInfo as $field => $value)
						if (property_exists($cart, $field))
							$cart->{$field} = $value;

					if ($cart->add())
						self::updateQtyInCart($cart, $productInfo);
					else
						$errors[] = $this->l('Unable to create a cart for this new order');
				}
				else
				{
					$cart = new Cart($order->id_cart);

					if (Validate::isLoadedObject($cart))
						self::updateQtyInCart($cart, $productInfo, true);
				}
				
				if (isset($cart))
					$order->id_cart = $cart->id;
					
				$orderErrors = $order->validateControler();
				
				$order->payment = $payment->displayName;
				
				if (sizeof($orderErrors) || ! $order->save())
				{
					$errors = array_merge($errors, $orderErrors);
					$errors[] = $this->l('Unable to save order');
				}
				else
				{
					$orderId = $order->id;
					$newOrderDetails = array();

					foreach ($productInfo as $orderDetail)
					{
						$id              = isset($orderDetail['id_order_detail']) ? (int)$orderDetail['id_order_detail'] : null;
						$index           = intval($orderDetail['index']);
						$productId       = $orderDetail['product_id'];
						$attribute       = $orderDetail['product_attribute_id'] != 0 ? $orderDetail['product_attribute_id'] : null;
						$wantedQuantity  = $orderDetail['wanted_quantity'];
						
						unset($orderDetail['id_order_detail'], $orderDetail['index'], $orderDetail['wanted_quantity']);
						$orderDetail['id_order'] = $orderId;
						
						$detailObj = new OrderDetail($id);

						foreach ($orderDetail as $field => $value)
							$detailObj->{$field} = $value;
						
						$orderDetailErrors = $detailObj->validateControler();
						
						if ( ! sizeof($orderDetailErrors) && $detailObj->save())
						{
							if ( ! isset($id))
								$newOrderDetails[$index] = array(
									'order_detail' => $detailObj->id,
									'product'      => $detailObj->product_id
								);
							
							Product::updateQuantity(array(
									'id_product'           => $productId,
									'id_product_attribute' => $attribute,
									'cart_quantity'        => $wantedQuantity
								)
							);
						}
						else
							$errors = array_merge($errors, $orderDetailErrors);
					}
					
					if (sizeof($errors) || sizeof($productErrors))
					{
						if ( ! $orderExists)
						{
							$history = $order->getHistory(Configuration::get('PS_LANG_DEFAULT'));
							
							if ($history && sizeof($history))
							{
								foreach ($history as $orderHistory)
								{
									$historyObj = new OrderHistory($orderHistory['id_order_history']);
									
									if (Validate::isLoadedObject($historyObj))
										$historyObj->delete();
								}
							}
							
							if (isset($cart) && Validate::isLoadedObject($cart))
								$cart->delete();
								
							$order->delete();
						}
						
						return self::jsonEncode(array('errors' => array_merge($errors, $productErrors)));
					}
					else
					{
						if ( ! $orderExists)
							$this->insertIntoTable('order_history',
								array(
									'id_employee'    => (int)$data['iem'],
									'id_order'       => (int)$orderId,
									'id_order_state' => (int)$status,
									'date_add'       => date('Y-m-d h:i:s')
								)
							);
						
						$orderHistory = new OrderHistory();
						$orderHistory->id_order = $order->id;
						$orderHistory->id_employee = (int)$data['iem'];
						$orderHistory->changeIdOrderState((int)$status, $order->id);
						
						$orderHistory->add();
						
						return self::jsonEncode(
							array(
								'message' => $orderExists ? $this->l('Order has been successfully updated') : $this->l('New order has been created successfully'),
								'order'   => $orderId,
								'details' => $newOrderDetails
							)
						);
					}
				}
			}
		}
		else
		{
			if ($orderExists)
				self::purgeOrder($orderId);
				
			$errors[] = $this->l('Please select at least one product');
		}
		
		return self::jsonEncode(array('errors' => $errors));
	}
	
	public function addProductToOrder($orderId, $index, $product, $idLang, $currencyId, $combination = null)
	{
		require_once(dirname(__FILE__) . '/../../images.inc.php');
		
		if ( ! self::checkCurrency($currencyId))
			$currencyId = (int)Configuration::get('PS_CURRENCY_DEFAULT');
		
		$currency   = new Currency($currencyId);
		$weightUnit = Configuration::get('PS_WEIGHT_UNIT'); 
		$product    = new Product($product, true, $idLang);
		
		$cart = new Cart();
		$cart->id_currency = $currency->id;
		$cart->id_lang = $idLang;
		$cart->id_address_delivery = 0;
		$cart->id_address_invoice = 0;
		$cart->id_carrier = null;
		
		$price       = Tools::convertPrice(floatval(Product::getPriceStatic($product->id, false, $combination)), $currency);
		$taxedPrice  = Tools::convertPrice(floatval(Product::getPriceStatic($product->id, true, $combination)), $currency);
		$productName = $product->name;
		$productReference = $product->reference;
		
		if (isset($combination) && Validate::isUnsignedInt($combination))
		{
			$productName.= ' - ';
			$combinations = $product->getAttributeCombinaisons($idLang);

			foreach ($combinations as $tmpComb)
				if ($tmpComb['id_product_attribute'] == $combination)
				{
					$productReference = $tmpComb['reference'];
					$productName.= '<br />' . $tmpComb['group_name'] . ': ' . $tmpComb['attribute_name'] . ', ';
				}
			
			$productName = rtrim($productName, ', ');
		}

		$fields = array(
			'id_order'             => intval($orderId),
			'product_id'           => intval($product->id),
			'product_attribute_id' => $combination,
			'product_name'         => $productName,
			'product_quantity'     => 1,
			'product_price'        => $price,
			'tax_rate'             => floatval($product->tax_rate)
		);

		$image = array();
		
		if (isset($combination) && intval($combination))
			$image = Db::getInstance()->getRow('
				SELECT id_image
				FROM ' . _DB_PREFIX_ . 'product_attribute_image
				WHERE id_product_attribute = ' . intval($combination)
			);
		
		if ( ! isset($image['id_image']) || ! $image['id_image'])
			$image = Db::getInstance()->getRow('
				SELECT id_image
				FROM ' . _DB_PREFIX_ . 'image
				WHERE id_product = ' . $product->id . '
				AND cover        = 1'
			);
	
		if (isset($image['id_image']))
		{
			$target = '../img/tmp/product_mini_' . $product->id . (isset($combination) ? '_' . intval($combination) : '') . '.jpg';
			if (file_exists($target))
				$size = getimagesize($target);
		}

		$output = '
			<tr' . ((isset($image['id_image']) && isset($size)) ? ' height="' . ($size[1] + 7) . '"' : '') . '>
				<td align="center">
					' . (isset($image['id_image']) ? cacheImage(_PS_IMG_DIR_ . 'p/' . $product->id . '-' . intval($image['id_image']) . '.jpg','product_mini_' . $product->id . (isset($combination) ? '_' . intval($combination) : '') . '.jpg', 45, 'jpg') : '--') . '
					<input type="hidden" class="indexProduct" name="product[' . $index . '][' . $product->id . '][index]" value="' . $index . '" />
					<input type="hidden" name="product[' . $index . '][' . $product->id . '][product_attribute]" value="' . $combination . '" />
				</td>
				<td class="editable productName">
					<span class="customValue"></span>
					<span class="publicView">
						' . str_replace(array("\r\n", "\n", "\r"), '<br />', $productName) . '
					</span>
					<span class="realValue">
						<textarea name="product[' . $index . '][' . $product->id . '][name]">' . str_replace('<br />', "\n", $productName) . '</textarea>
					</span>
				</td>
				<td class="editable productReference">
					<span class="customValue"></span>
					<span class="publicView">
						' . ($productReference != '' ? $productReference : 'N/A') . '
					</span>
					<span class="realValue">
						<input type="text" size="20" name="product[' . $index . '][' . $product->id . '][reference]" value="' . $productReference . '" />
					</span>
				</td>
				<td class="editable productQuantity">
					<span class="customValue"></span>
					<span class="publicView">
						1
					</span>
					<span class="realValue">
						<input type="text" size="3" class="orderPQuantity" name="product[' . $index . '][' . $product->id . '][quantity]" value="1" />
					</span>
				</td>
				<td class="editable productWeight">
					<span class="customValue"></span>
					<span class="publicView">
						' . (intval($product->weight)) . $weightUnit . '
					</span>
					<span class="realValue">
						<input type="text" class="weightFormat" size="3" name="product[' . $index . '][' . $product->id . '][weight]" value="' . $product->weight . '" />
					</span>
				</td>
				<td class="editable">
					<span class="customValue"></span>
					<span class="publicView">
						' . Tools::displayPrice($price, $currency, false, false) . '
					</span>
					<span class="realValue">
						<input type="text" size="6" class="orderPPrice cpOnKeyUp priceFormat" name="product[' . $index . '][' . $product->id . '][price]" value="' . $price . '" />
					</span>
				</td>
				<td class="editable">
					<span class="customValue productTax"></span>
					<span class="publicView">
						' . $product->tax_rate . '
					</span>
					<span class="realValue">
						<input type="text" class="cpOnKeyUp percentageFormat" size="6" name="product[' . $index . '][' . $product->id . '][tax_rate]" value="' . $product->tax_rate . '" />
					</span>
				</td>
				<td class="editable">
					<span class="customValue"></span>
					<span class="publicView">
						' . Tools::displayPrice($taxedPrice, $currency, false, false) . '
					</span>
					<span class="realValue">
						<input type="text" class="orderPPriceWt cpOnKeyUp priceFormat" size="6" name="product[' . $index . '][' . $product->id . '][price_wt]" value="' . $taxedPrice . '" />
					</span>
				</td>
				<td class="productsTotalPrice">
					' . Tools::displayPrice($taxedPrice, $currency, false, false) . '
				</td>
				<td align="center">
					<span class="control deleteProduct"></span>
				</td>
			</tr>';
		
		
		die($output);
	}
    
    public function ajaxFullProductInfo($idLang, $productId)
    {
        if ( ! self::checkId(array($idLang, $productId)))
            die();
        
        $product  = new Product($productId, true, $idLang);
		$currency = new Currency(Configuration::get('PS_CURRENCY_DEFAULT'));
		
		if ( ! Validate::isLoadedObject($product))
			return '<h4 class="error">' . $this->l('Invalid product selected') . '</h4>';
			
		$result = '<h2>' . $product->name . ( ! Tools::isEmpty($product->reference) ? ' (' . $product->reference . ')' : '') . '</h2>';

		$result.= '
		<dl class="productShortInfo">
			<dt>' . $this->l('Quantity:') . '</dt>
			<dd>' . intval($product->quantity) . '</dd>
			<dt>' . $this->l('Price:') . '</dt>
			<dd>' . Tools::displayPrice(Tools::convertPrice($product->price, $currency), $currency) . '</dd>
		</dl>';
	  
        $combinations = $product->getAttributeCombinaisons($idLang);
		
		$groups = array();
		if (is_array($combinations))
		{
			foreach ($combinations AS $k => $combination)
			{
				$combArray[$combination['id_product_attribute']]['price']              = $combination['price'];
				$combArray[$combination['id_product_attribute']]['weight']             = $combination['weight'];
				$combArray[$combination['id_product_attribute']]['reference']          = $combination['reference'];
				$combArray[$combination['id_product_attribute']]['quantity']           = $combination['quantity'];
				$combArray[$combination['id_product_attribute']]['default_on']         = $combination['default_on'];
				$combArray[$combination['id_product_attribute']]['attributes'][]       = array($combination['group_name'], $combination['attribute_name'], $combination['id_attribute']);
				
				if ($combination['is_color_group'])
					$groups[$combination['id_attribute_group']] = $combination['group_name'];
			}
		}
		$irow = 0;
		if (isset($combArray))
		{
			$result.= '
			<table class="table" cellspacing="0" cellpadding="0" style="width: 100%;">
				<tr>
					<th>' . $this->l('Combination') . '</th>
					<th class="center">' . $this->l('Quantity') . '</th>
					<th class="center">' . $this->l('Price') . '</th>
					<th class="center">' . $this->l('Weight') . '</th>
					<th class="left">' . $this->l('Reference') . '</th>
					<th class="right" width="16">' . $this->l('Add') . '</th>
				</tr>';
				
			foreach ($combArray as $id_product_attribute => $product_attribute)
			{
				$list = '';
				
				foreach ($product_attribute['attributes'] as $attribute)
					$list .= addslashes(htmlspecialchars($attribute[0])).' - '.addslashes(htmlspecialchars($attribute[1])).', ';
				
				$list = rtrim($list, ', ');

				$result.= '
				<tr' . ($irow++ % 2 ? ' class="alt_row"' : '') . ($product_attribute['default_on'] ? ' style="background-color:#D1EAEF"' : '') . '>
					<td>' . stripslashes($list) . '</td>
					<td class="center">' . $product_attribute['quantity'] . '</td>
					<td class="center">' . Tools::displayPrice(Tools::convertPrice($product_attribute['price'], $currency), $currency) . '</td>
					<td class="center">' . $product_attribute['weight'] . Configuration::get('PS_WEIGHT_UNIT') . '</td>
					<td class="left">' . $product_attribute['reference'] . '</td>
					<td class="right" width="16">
						<span class="control addProduct" id="combo_' . $product->id . '_' . $id_product_attribute . '"></span>
					</td>
				</tr>';
			}
	    }
		else
		{
			$result.= '
			<span class="control addProduct withLabel" id="product_' . $product->id . '">' . $this->l('Add to order') . '</span>';
		}
		
		die($result);
		
    }
	
	public function displayCustomerCreationForm($idLang)
	{
		$groups = Group::getGroups((int)$idLang);
		$countries = Country::getCountries((int)$idLang, true);
		
		$output = '
		<form method="post" id="newCustomerWrapper" style="display: none;">

				<label for="lastname">
					' . $this->l('Customer Lastname') . '
				</label>
				<div class="margin-form">
					<input type="text" name="lastname" size="20" class="customerNw" />
				</div>
				
				<label for="firstname">
					' . $this->l('Customer Firstname') . '
				</label>
				<div class="margin-form">
					<input type="text" name="firstname" size="20" class="customerNw" />
				</div>
				
				<label for="email">
					' . $this->l('Email') . '
				</label>
				<div class="margin-form">
					<input type="text" name="email" size="20" class="customerNw" />
				</div>';
		
		if ($groups && sizeof($groups))
		{
			$output.= '
				<label for="id_default_group">
					' . $this->l('Default Group') . '
				</label>
				<div class="margin-form">
					<select name="id_default_group" class="customerNw">';
				
			foreach ($groups as $group)
			{
				$output.= '
						<option value="' . $group['id_group'] . '">' . $group['name'] . '</option>';
			}
			
			$output.= '
					</select>
				</div>
				
				<label for="groupBox">
					' . $this->l('Groups') . '
				</label>
				<div class="margin-form">
					<table class="table" cellspacing="0" cellpadding="0" style="width: 29em;">
						<tr>
							<th>
								<input type="checkbox" name="checkme" class="noborder" onclick="checkDelBoxes(this.form, \'groupBox[]\', this.checked)" />
							</th>
							<th width="30">
								' . $this->l('ID') . '
							</th>
							<th>
								' . $this->l('Name') . '
							</th>
						</tr>';
				
			foreach ($groups as $group)
			{
				$output.= '
						<tr>
							<td>
								<input type="checkbox" name="groupBox[]" class="groupBox" id="groupBox_' . $group['id_group'] . '" value="' . $group['id_group'] . '">
							</td>
							<td>
								' . $group['id_group'] . '
							</td>
							<td>
								' . $group['name'] . '
							</td>
						</tr>';
			}
			
			$output.= '
					</table>
				</div>';
		}
			
		$output.= '
			<div id="addrWrapper">
				<div class="duplicatedRow">
					<label>' . $this->l('Company') . '</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][company]" />
					</div>
					
					<label>' . $this->l('VAT number') . '</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][vat_number]" />
					</div>
					
					<label for="address1">' . $this->l('Address') . '</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][address1]" />
					</div>
					
					<label for="address2">' . $this->l('Address') . ' (2):</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][address2]" />
					</div>
					
					<label for="postcode">' . $this->l('Postcode/ Zip Code') . '</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][postcode]" />
					</div>
					
					<label for="city">' . $this->l('City') . '</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][city]" />
					</div>';
			
		if ($countries && sizeof($countries))
		{
			$output.= '
					<label for="id_country">' . $this->l('Country') . '</label>
					<div class="margin-form">
						<select name="addressNw[0][id_country]">';
				
			foreach ($countries as $country)
			{
				$output.= '
						<option value="' . $country['id_country'] . '">' . $country['name'] . '</option>';	
			}
			
			$output.= '
						</select>
					</div>';
		}
			
		$output.= '
					<label for="phone">' . $this->l('Home phone') . '</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][phone]" />
					</div>
					<label>' . $this->l('Mobile phone') . '</label>
					<div class="margin-form">
						<input type="text" size="33" name="addressNw[0][phone_mobile]" />
					</div>
					<label>' . $this->l('Other') . '</label>
					<div class="margin-form">
						<textarea name="addressNw[0][other]" cols="36" rows="4"></textarea>
					</div>
				</div>
				<a href="#" class="duplicator">' . $this->l('Add another address') . '</a>
			</div>
			<div class="margin-form">
				<input type="submit" value="' . $this->l('Save') . '" name="submitAddCustomer" class="button" />
			</div>
		</form>';
		
		die($output);
	}
	
	public function saveCustomer($data)
	{
		$errors = array();
		$customer = new Customer();
		$addreses = array();
		
		$customerInfo  = $data['customer'];
		$addressesInfo = $data['addresses'];
		$groups        = $data['groups'];
		
		$customer->passwd = Tools::passwdGen(8);
		$customer->is_guest = false;
		
		foreach ($customerInfo as $property => $value)
			if (property_exists($customer, $property))
				$customer->{$property} = $value;
		
		foreach ($addressesInfo as $address)
		{
			$addressObj = new Address();
			
			foreach ($address as $property => $value)
				if (property_exists($addressObj, $property))
					$addressObj->{$property} = $value;
			
			$addressObj->firstname = $customer->firstname;
			$addressObj->lastname = $customer->lastname;
			$addressObj->id_customer = 1;
			$addressObj->alias = $this->l('My address');

			$addreses[] = $addressObj;
		}
				
		if (Customer::customerExists($customer->email))
			$errors[] = $this->l('Someone has already registered with this e-mail address');
			
		if ( ! is_array($groups) || sizeof($groups) == 0)
			$errors[] = $this->l('Customer must be in at least one group');
			
		if (property_exists($customer, 'id_default_group') && ! in_array($customer->id_default_group, $groups))
			$errors[] = $this->l('Default customer group must be selected in group box');
			
		foreach ($addreses as $address)
			$errors = array_unique(array_merge($errors, $address->validateControler()));

		$errors = array_unique(array_merge($errors, $customer->validateControler()));
		
		if (sizeof($errors) || ! $customer->add())
		{
			$errors[] = $this->l('Unable to add a new customer');
			return self::jsonEncode(array('errors' => $errors));
		}
		
		if (is_array($groups) && sizeof($groups) > 0)
			$customer->addGroups($groups);

		foreach ($addreses as $address)
		{
			$address->id_customer = $customer->id;
			
			if ( ! $address->add())
				$errors[] = $this->l('Unable to add an address');
		}
		
		if (sizeof($errors))
			return self::jsonEncode(array('errors' => $errors));
		
		return self::jsonEncode(
			array(
				'success' => true,
				'customerID' => $customer->id,
				'message' => $this->l('New customer has been successfully created')
			)
		);
	}
	
	public static function getCurrencyDetails($currencyId)
	{
		if ( ! self::checkCurrency($currencyId))
			$currencyId = (int)Configuration::get('PS_CURRENCY_DEFAULT');
			
		$currency = new Currency($currencyId);
		
		$currencyInfo = array(
			'currencySign'   => $currency->sign,
			'currencyRate'   => $currency->conversion_rate,
			'currencyFormat' => $currency->format,
			'currencyBlank'  => $currency->blank
		);
		
		return self::jsonEncode($currencyInfo);
	}
	
	private static function checkCurrency($currencyId)
	{
		return (Validate::isUnsignedInt($currencyId) && Currency::getCurrency((int)$currencyId));
	}
	
    public function ajaxFullCustomerInfo($idLang, $customerId, $employeeId)
    {
        if ( ! self::checkId(array($idLang, $customerId)))
            die();
			
		$customer = new Customer($customerId);
		
		if ( ! Validate::isLoadedObject($customer))
			return '<h4>' . $this->l('Unknown customer selected') . '</h4>';
			
		$addresses = $customer->getAddresses($idLang);
		
		if ( ! sizeof($addresses))
			return '<h4>' . $this->l('This customer doesn\'t have any address assigned, please do that first') . '</h4>';
		
		$output = '';
		$iso = Language::getIsoById($idLang);

		foreach ($addresses as $address)
			$output.= $this->displayAddress($address, $iso, $employeeId);
		
		die($output);
    }
	
	private function displayAddress($address, $iso, $employeeId)
	{
		global $currentIndex;
		
		$link = new Link();
		
		return '
		<div class="addressItem">
			<div class="address">
			<input type="hidden" class="id_address"  value="' . $address['id_address'] . '" />
			<input type="hidden" class="id_customer" value="' . $address['id_customer'] . '" />
			<div style="float: right">
				<a target="_blank" href="' . $currentIndex . 'index.php?tab=AdminAddresses&id_address=' . $address['id_address'] . '&updateaddress&token='.Tools::getAdminToken('AdminAddresses'.intval(Tab::getIdFromClassName('AdminAddresses')).intval($employeeId)).'"><img src="../img/admin/edit.gif" /></a>
				<a href="http://maps.google.com/maps?f=q&hl=' . $iso . '&geocode=&q=' . $address['address1'] . ' ' . $address['postcode'] . ' ' . $address['city'] . ( ! Tools::isEmpty($address['state']) ? ' ' . $address['state'] : '') . '"><img src="../img/admin/google.gif" alt="" class="middle" /></a>
			</div>
			' . (!empty($address['company']) ? $address['company'] . '<br />' : '') . $address['firstname'] . ' ' . $address['lastname'] . '<br />
			' . $address['address1'] . '<br />'. ( ! empty($address['address2']) ? $address['address2'] . '<br />' : '') . '
			' . $address['postcode'] . ' ' . $address['city'] . '<br />
			' . $address['country'] . ($address['id_state'] ? ' - ' . $state['name'] : '') . '<br />
			' . (!empty($address['phone']) ? $address['phone'] . '<br />' : '') . '
			' . (!empty($address['phone_mobile']) ? $address['phone_mobile'] . '<br />' : '') . '
			' . (!empty($address['other']) ? '<hr />' . $address['other'] . '<br />' : '') . '
			</div>
			<hr />
			<span class="control addAddress shipping">
				<img src="../img/admin/delivery.gif" />
				' . $this->l('Set as shipping address') . '
			</span>
			<span class="control addAddress invoice">
				<img src="../img/admin/invoice.gif" />
				' . $this->l('Set as invoice address') . '
			</span>
		</div>';
	}
}
?>