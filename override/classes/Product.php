<?php

class Product extends ProductCore {

	/** @var string etiquette */
	public		$etiquette;

	public function getFields () {
		parent::validateFields();

		if (isset($this->id))
			$fields['id_product'] = (int)($this->id);

		$fields['etiquette'] = pSQL($this->etiquette);
		$fields['id_tax_rules_group'] = (int)($this->id_tax_rules_group);
		$fields['id_manufacturer'] = (int)($this->id_manufacturer);
		$fields['id_supplier'] = (int)($this->id_supplier);
		$fields['id_category_default'] = (int)($this->id_category_default);
		$fields['id_color_default'] = (int)($this->id_color_default);
		$fields['quantity'] = (int)($this->quantity);
		$fields['minimal_quantity'] = (int)($this->minimal_quantity);
		$fields['price'] = (float)($this->price);
		$fields['additional_shipping_cost'] = (float)($this->additional_shipping_cost);
		$fields['wholesale_price'] = (float)($this->wholesale_price);
		$fields['on_sale'] = (int)($this->on_sale);
		$fields['online_only'] = (int)($this->online_only);
		$fields['ecotax'] = (float)($this->ecotax);
		$fields['unity'] = pSQL($this->unity);
    	$fields['unit_price_ratio'] = (float)($this->unit_price > 0 ? $this->price / $this->unit_price : 0);
		$fields['ean13'] = pSQL($this->ean13);
		$fields['upc'] = pSQL($this->upc);
		$fields['reference'] = pSQL($this->reference);
		$fields['supplier_reference'] = pSQL($this->supplier_reference);
		$fields['location'] = pSQL($this->location);
		$fields['width'] = (float)($this->width);
		$fields['height'] = (float)($this->height);
		$fields['depth'] = (float)($this->depth);
		$fields['weight'] = (float)($this->weight);
		$fields['out_of_stock'] = pSQL($this->out_of_stock);
		$fields['quantity_discount'] = (int)($this->quantity_discount);
		$fields['customizable'] = (int)($this->customizable);
		$fields['uploadable_files'] = (int)($this->uploadable_files);
		$fields['text_fields'] = (int)($this->text_fields);
		$fields['active'] = (int)($this->active);
		$fields['available_for_order'] = (int)($this->available_for_order);
		$fields['condition'] = pSQL($this->condition);
		$fields['show_price'] = (int)($this->show_price);
		$fields['indexed'] = 0; // Reset indexation every times
		$fields['cache_is_pack'] = (int)($this->cache_is_pack);
		$fields['cache_has_attachments'] = (int)($this->cache_has_attachments);
		$fields['cache_default_attribute'] = (int)($this->cache_default_attribute);
		$fields['date_add'] = pSQL($this->date_add);
		$fields['date_upd'] = pSQL($this->date_upd);

		return $fields;
	}

	public function getPourcentOfReduction ( $precision = 0 ) {
		$old_price = Tools::convertPrice( $this->getPriceWithoutReduct() );
		$final_price = Tools::convertPrice( $this->getPrice( ) );
		
		$reduction = 100 - ( $final_price / $old_price * 100 );
		
		return round( $reduction, $precision );
	}

	public function getCoverOfThis()
	{
		$cover = self::getCover( $this->id );

		return $this->id.'-'.$cover['id_image'];
	}
	
	static public function searchProductByReferenceForInk ( $reference, $id_lang, $id_category = null ) {
		/*$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
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
		WHERE p.`active` = 1
		AND t.`supplier_reference` LIKE \'%'.pSQL($reference).'%\'
		ORDER BY pl.`name` ASC';
		*/
		
		$result = Db::getInstance()->ExecuteS('
		SELECT p.*, pl.`name`, pl.`link_rewrite`, i.`id_image`,
		il.`legend`, m.`name` AS manufacturer_name, tl.`name` AS tax_name
		FROM `'._DB_PREFIX_.'category_product` cp
		LEFT JOIN `'._DB_PREFIX_.'product` p ON p.`id_product` = cp.`id_product`
		LEFT JOIN `'._DB_PREFIX_.'product_lang` pl ON (p.`id_product` = pl.`id_product` AND pl.`id_lang` = '.(int)($id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'tax_rule` tr ON (p.`id_tax_rules_group` = tr.`id_tax_rules_group`
		   AND tr.`id_country` = '.(int)Country::getDefaultCountryId().'
		   AND tr.`id_state` = 0)
	    LEFT JOIN `'._DB_PREFIX_.'tax` t ON (t.`id_tax` = tr.`id_tax`)
		LEFT JOIN `'._DB_PREFIX_.'tax_lang` tl ON (t.`id_tax` = tl.`id_tax` AND tl.`id_lang` = '.(int)($id_lang).')
		LEFT JOIN `'._DB_PREFIX_.'manufacturer` m ON m.`id_manufacturer` = p.`id_manufacturer`
		LEFT JOIN `'._DB_PREFIX_.'image` i ON (i.`id_product` = p.`id_product`) AND i.`cover` = 1
		LEFT JOIN `'._DB_PREFIX_.'image_lang` il ON (i.`id_image` = il.`id_image` AND il.`id_lang` = '.(int)($id_lang).')
		WHERE p.`supplier_reference` LIKE \'%'.pSQL($reference).'%\'
		GROUP BY `id_product`
		ORDER BY pl.`name` ASC');
	
		if (!$result)
			return false;

		$resultsArray = array();
		foreach ($result AS $k => $row)
		{
			$parents = array();
			if ( $id_category != null ) {
				$parents = Category::getParents( $row['id_category_default'] );
			}
			
			if ( in_array( $id_category, $parents ) || $id_category == null ) {
				$resultsArray[] = $row;
			}
		}
		return $resultsArray;
	}
}