<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class CrossSelling extends Module
{
	function __construct()
	{
		$this->name = 'crossselling';
		$this->tab = 'Products';
		$this->version = 0.1;

		parent::__construct();
		
		$this->displayName = $this->l('Cross selling');
		$this->description = $this->l('Customers who bought this product also bought...');
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
		
		$orders = Db::getInstance()->ExecuteS('
		SELECT o.id_order
		FROM '._DB_PREFIX_.'orders o
		LEFT JOIN '._DB_PREFIX_.'order_detail od ON (od.id_order = o.id_order)
		WHERE o.valid = 1 AND od.product_id = '.intval($params['product']->id));

		if ( count( $orders ) ) {
			$list = '';
			foreach ($orders AS $order)
				$list .= intval($order['id_order']).',';
			$list = rtrim($list, ',');
		
			$orderProducts = Db::getInstance()->ExecuteS('
			SELECT DISTINCT od.product_id, pl.name, pl.link_rewrite, p.reference, i.id_image, cl.`link_rewrite` AS category, p.ean13
			FROM '._DB_PREFIX_.'order_detail od
			LEFT JOIN '._DB_PREFIX_.'product p ON (p.id_product = od.product_id)
			LEFT JOIN '._DB_PREFIX_.'product_lang pl ON (pl.id_product = od.product_id)
			LEFT JOIN '._DB_PREFIX_.'category_lang cl ON (cl.id_category = p.id_category_default)
			LEFT JOIN '._DB_PREFIX_.'image i ON (i.id_product = od.product_id)
			WHERE od.id_order IN ('.$list.') AND cl.id_lang = '.intval($cookie->id_lang).' AND pl.id_lang = '.intval($cookie->id_lang).' AND od.product_id != '.intval($params['product']->id).' AND i.cover = 1 AND p.active = 1
			ORDER BY RAND()
			LIMIT 10');
			
			foreach ($orderProducts AS &$orderProduct) {
				$orderProduct['image'] = $link->getImageLink($orderProduct['link_rewrite'], intval($orderProduct['product_id']).'-'.$orderProduct['id_image'], 'crosselling');
				$orderProduct['link'] = $link->getProductLink(intval($orderProduct['product_id']), $orderProduct['link_rewrite'], $orderProduct['category'], $orderProduct['ean13']);
				$orderProduct['price_without_reduction'] = 	Product::getPriceStatic((int)$orderProduct['product_id'], true, ((isset($orderProduct['id_product_attribute']) AND !empty($orderProduct['id_product_attribute'])) ? (int)($orderProduct['id_product_attribute']) : NULL), 6, NULL, false, false);
				$orderProduct['price'] = 					Product::getPriceStatic((int)$orderProduct['product_id'], true, ((isset($orderProduct['id_product_attribute']) AND !empty($orderProduct['id_product_attribute'])) ? (int)($orderProduct['id_product_attribute']) : 	NULL), 6);
			}

			$smarty->assign(array(
				'orderProducts' => $orderProducts,
				'middlePosition_crossselling' => round(sizeof($orderProducts) / 2, 0)
			));
		}
		else {
			$Category = new Category( intval( $params['product']->id_category_default ), intval( $cookie->id_lang ) );
			$orderProducts = $Category->getProducts( intval( $cookie->id_lang ), NULL, NULL, NULL, NULL, false, true, true, 10);

			foreach ($orderProducts AS $i => $orderProduct) {
				$orderProducts[$i]['image'] = $link->getImageLink($orderProduct['link_rewrite'], $orderProduct['id_image'], 'crosselling');
				$orderProducts[$i]['link'] = $link->getProductLink(intval($orderProduct['id_product']), $orderProduct['link_rewrite'], $orderProduct['category'], $orderProduct['ean13']);
			}

			$smarty->assign(array(
				'samecat' => 'on',
				'orderProducts' => $orderProducts,
				'middlePosition_crossselling' => round(sizeof($orderProducts) / 2, 0)
			));
		}
		
		
		return $this->display(__FILE__, 'crossselling.tpl');
	}
}