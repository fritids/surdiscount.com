<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class SameManufacturer extends Module
{
	function __construct()
	{
		$this->name = 'samemanufacturer';
		$this->tab = 'Products';
		$this->version = 0.1;

		parent::__construct();
		
		$this->displayName = $this->l('Same Manufacturer');
		$this->description = $this->l('Product in the same manufacturer');
	}

	function install()
	{
		if (parent::install() == false OR !$this->registerHook('productFooter'))
			return false;
		return true;
	}

	/**
	* Returns module content for left column
	*/
	function hookProductFooter($params)
	{
		global $smarty, $cookie, $link;
		
		$id_manufacturer = $params['product']->id_manufacturer;

		if ( $id_manufacturer ) {
			$orderProducts = Manufacturer::getProducts( $id_manufacturer, $cookie->id_lang, 0, 12 );
	
			if ( count( $orderProducts ) ) {
				foreach ( $orderProducts AS $i => $orderProduct ) {
					$orderProducts[$i]['image'] = $link->getImageLink($orderProduct['link_rewrite'], $orderProduct['id_image'], 'crosselling');
					$orderProducts[$i]['link'] = $link->getProductLink(intval($orderProduct['id_product']), $orderProduct['link_rewrite'], $orderProduct['category'], $orderProduct['ean13']);
					
					if ( $orderProduct['id_product'] == $params['product']->id ) {
						unset( $orderProducts[$i] );
					}
				}

				$smarty->assign(array(
					'orderProducts' => $orderProducts,
					'manufacturer_name' => $params['product']->manufacturer_name,
					'middlePosition_samemanufacturer' => round(sizeof($orderProducts) / 2, 0)
				));
				
				
				return $this->display(__FILE__, 'samemanufacturer.tpl');
			}
		}
	}
}