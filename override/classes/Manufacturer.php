<?php

class Manufacturer extends ManufacturerCore {
	public function getTags () {
		global $cookie;

		$products = (array)$this->getProductsLite( $cookie->id_lang );

		$tags = array();
		foreach ( $products as $item ) {
			$new_tags = (array)Tag::getProductTags2( $item['id_product'], $cookie->id_lang );

			if ( count( $new_tags ) ) {
				$tags = array_merge( $tags, $new_tags );
			}
		}

		return $tags;
	}
	
	public function getProductsLite($id_lang)
	{
		return Db::getInstance()->ExecuteS('
		SELECT p.`id_product`, p.`id_manufacturer `, pl.`name`
		FROM `'._DB_PREFIX_.'product` p
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)($id_lang).')
		WHERE p.`id_manufacturer` = '.(int)($this->id));
	}
}