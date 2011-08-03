<?php
require_once (dirname(__FILE__) . '/../../../config/config.inc.php');
require_once (dirname(__FILE__) . '/../orlique.php');

function paramStrDecode($string)
{
    $prepared = array();
    
    $tmp1 = explode('&', $string);
    
    if (sizeof($tmp1))
    {
        foreach ($tmp1 as $value)
        {
            $value = explode('=', $value);
            
            if (substr($value[0], strlen($value[0]) - 2) === '[]')
                $prepared[substr($value[0], 0, -2)][] = $value[1];
            else
                $prepared[$value[0]] = $value[1];
        }
    }
    
    return $prepared;
}

if (Employee::checkPassword(Tools::getValue('iem'), Tools::getValue('iemp')))
{
    if (class_exists('Cookie'))
        $cookie = new Cookie('psOrderEdit');
    
    $id_lang         = Tools::getValue('id_lang');
    $cookie->id_lang = $id_lang;
    Tools::setCookieLanguage();
    
    $editorInstance  = new Orlique();
    
    if (Tools::getIsset('q'))
    {
        $query = Tools::getValue('q', false);
        
        if (Tools::getValue('type') == 1)
            $editorInstance->ajaxProductList($id_lang, $query);
        else
            $editorInstance->ajaxCustomerList($query);
    }
    elseif (Tools::getIsset('customerCreate'))
    {
        $editorInstance->displayCustomerCreationForm($id_lang);
    }
    elseif (Tools::getIsset('customerCreateSave'))
    {
        die($editorInstance->saveCustomer($_POST));
    }
    elseif (Tools::getIsset('getfull'))
    {
        $productId = Tools::getValue('getfull', false);
        $editorInstance->ajaxFullProductInfo($id_lang, $productId);
    }
    elseif (Tools::getIsset('getcustomer'))
    {
        $customerId = Tools::getValue('getcustomer', false);
        $editorInstance->ajaxFullCustomerInfo($id_lang, $customerId, Tools::getValue('iem', false));
    }
    elseif (Tools::getIsset('order_update'))
    {
        die($editorInstance->updateOrder($_POST));
    }
    elseif (Tools::getIsset('addProduct'))
    {
        $product     = Tools::getValue('addProduct');
        $combination = Tools::getValue('id_combination', null);
        $orderId     = Tools::getValue('oid', null);
        $index       = Tools::getValue('index', 0);
        $currency    = Tools::getValue('currency');
        
        $editorInstance->addProductToOrder($orderId, $index, $product, $id_lang, $currency, $combination);
    }
    elseif (Tools::getIsset('deleteOrderId'))
    {
        $orderDetail = intval(Tools::getValue('deleteOrderId'));
        
        if (Orlique::orderDetailIsDeletable($orderDetail))
        {
            $detailObj   = new OrderDetail($orderDetail);
            
            if (Validate::isLoadedObject($detailObj))
            {
                $productId       = $detailObj->product_id;
                $attribute       = isset($detailObj->product_attribute_id) && $detailObj->product_attribute_id != 0 ? $detailObj->product_attribute_id : null;
                $quantity        = $detailObj->product_quantity;
                
                Product::updateQuantity(array(
                        'id_product'           => $productId,
                        'id_product_attribute' => $attribute,
                        'quantity'             => intval($quantity) * -1,
                    )
                );
                
                $detailObj->delete();
            }
        }
    }
    elseif (Tools::getIsset('calculateShipping'))
    {
        die($editorInstance->getShippingPrice($_POST));
    }
    elseif (Tools::getIsset('getCurrency'))
    {
        die(Orlique::getCurrencyDetails(Tools::getValue('getCurrency')));
    }
} 
else 
{
    die('Please log in first');    
}
?>