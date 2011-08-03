<?php

class Search extends SearchCore {
	public static function searchTag($id_lang, $tag, $count = false, $pageNumber = 0, $pageSize = 10, $orderBy = false, $orderWay = false)
	{
	 	global $link;

		if (!is_numeric($pageNumber) OR !is_numeric($pageSize) OR !Validate::isBool($count) OR !Validate::isValidSearch($tag)
		OR $orderBy AND !$orderWay OR ($orderBy AND !Validate::isOrderBy($orderBy))	OR ($orderWay AND !Validate::isOrderBy($orderWay)))
			die(Tools::displayError());

		if ($pageNumber < 1) $pageNumber = 1;
		if ($pageSize < 1) $pageSize = 10;
		
		$join_category = '';
		$where_category = '';
		if ( (int)Tools::getValue('id_category') ) {
			$join_category = 'LEFT JOIN `'._DB_PREFIX_.'category_product` cpt ON (p.`id_product` = cpt.`id_product`)';
			$where_category = 'AND cpt.`id_category` = '.Tools::getValue('id_category');
		}

		if ( $count ) {
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->getRow('
			SELECT COUNT(pt.`id_product`) nb
			FROM `'._DB_PREFIX_.'product` p
			LEFT JOIN `'._DB_PREFIX_.'product_tag` pt ON (p.`id_product` = pt.`id_product`)
			LEFT JOIN `'._DB_PREFIX_.'tag` t ON (pt.`id_tag` = t.`id_tag` AND t.`id_lang` = '.(int)$id_lang.')
			'.$join_category.'
			WHERE p.`active` = 1
			'.$where_category.'
			AND REPLACE(t.`name`, " ", "") LIKE \'%'.pSQL($tag).'%\'');
			return isset($result['nb']) ? $result['nb'] : 0;
		}
		
		$sql = '
		SELECT p.*, pl.`description_short`, pl.`link_rewrite`, pl.`name`, tax.`rate`, i.`id_image`, il.`legend`, m.`name` manufacturer_name, 1 position,
			DATEDIFF(p.`date_add`, DATE_SUB(NOW(), INTERVAL '.(Validate::isUnsignedInt(Configuration::get('PS_NB_DAYS_NEW_PRODUCT')) ? Configuration::get('PS_NB_DAYS_NEW_PRODUCT') : 20).' DAY)) > 0 new
		FROM `'._DB_PREFIX_.'product` p
		INNER JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)$id_lang.')
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product` AND i.`cover` = 1)
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)$id_lang.')
		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
		                                           AND tr.`id_country` = '.(int)Country::getDefaultCountryId().'
		                                       	   AND tr.`id_state` = 0)
		LEFT JOIN `'._DB_PREFIX_.'tax` tax ON (tax.`id_tax` = tr.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON (m.`id_manufacturer` = p.`id_manufacturer`)
		LEFT JOIN `'._DB_PREFIX_.'product_tag` pt ON (p.`id_product` = pt.`id_product`)
		LEFT JOIN `'._DB_PREFIX_.'tag` t ON (pt.`id_tag` = t.`id_tag` AND t.`id_lang` = '.(int)$id_lang.')
		'.$join_category.'
		WHERE p.`active` = 1
		'.$where_category.'
		AND REPLACE(t.`name`, " ", "") LIKE \'%'.pSQL($tag).'%\'
		ORDER BY position DESC'.($orderBy ? ', '.$orderBy : '').($orderWay ? ' '.$orderWay : '').'
		LIMIT '.(int)(($pageNumber - 1) * $pageSize).','.(int)$pageSize;

		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS( $sql );
		if (!$result) return false;

		return Product::getProductsProperties($id_lang, $result);
	}
}