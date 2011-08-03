<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class Accessories extends Module
{
	function __construct()
	{
		$this->name = 'accessories';
		$this->tab = 'Products';
		$this->version = 0.1;

		parent::__construct();
		
		$this->displayName = $this->l('Accessoires');
		$this->description = $this->l('Accessoires autour d\'un produit');
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
		global $smarty, $link;

		$accessories = $params['product']->getAccessories( $params['cookie']->id_lang );

		if ( (int)$accessories ) {
			foreach ( $accessories AS $i => $accessorie ) {
				$accessories[$i]['image'] = $link->getImageLink($accessorie['link_rewrite'], $accessorie['id_image'], 'crosselling');
				$accessories[$i]['link'] = $link->getProductLink(intval($accessorie['id_product']), $accessorie['link_rewrite'], $accessorie['category'], $accessorie['ean13']);
			}
		}
		else {
			$accessories = array();
		}

		$smarty->assign(array(
			'products' => $accessories,
			'middlePosition_accessorie' => round(sizeof($accessories) / 2, 0)
		));
	
		return $this->display(__FILE__, 'accessories.tpl');
	}
}