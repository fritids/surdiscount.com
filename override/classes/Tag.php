<?php

class Tag extends TagCore {
	static public function findTag( $id_lang, $query = '', $id_manufacturer = '', $nb = 10 ) {
		$groups = FrontController::getCurrentCustomerGroups();
		$sqlGroups = (count($groups) ? 'IN ('.implode(',', $groups).')' : '= 1');
		
		$query = trim( $query );
		
		$words = explode( ' ', $query );
		
		// l'espace compte comme un séparateur
		// $search = "AND t.name REGEXP '".join( $words, '|' )."'";
		
		// l'espace est compte comme la suite du mot
		$search = "AND t.name LIKE '%$query%'";
		
		$manufacturer = "AND p.id_manufacturer = $id_manufacturer";
		
		$sql = 'SELECT t.name, COUNT(pt.id_tag) AS times
		FROM `'._DB_PREFIX_.'product_tag` pt
		LEFT JOIN `'._DB_PREFIX_.'tag` t ON (t.id_tag = pt.id_tag)
		LEFT JOIN `'._DB_PREFIX_.'product` p ON (p.id_product = pt.id_product)
		WHERE t.`id_lang` = '.(int)($id_lang).'
		AND p.`active` = 1
		AND p.`id_product` IN (
			SELECT cp.`id_product`
			FROM `'._DB_PREFIX_.'category_group` cg
			LEFT JOIN `'._DB_PREFIX_.'category_product` cp ON (cp.`id_category` = cg.`id_category`)
			WHERE cg.`id_group` '.$sqlGroups.'
		)
		'.( ( !empty( $query ) ) ? $search : "" ).'
		'.( ( (int)$id_manufacturer > 0 ) ? $manufacturer : "" ).'
		GROUP BY t.id_tag
		ORDER BY times DESC
		LIMIT 0, '.(int)($nb);
		
		$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS( $sql );
		
		if ( !count( $result ) && !(int)$id_manufacturer ) {
			$sql = 'SELECT t.name
			FROM `'._DB_PREFIX_.'tag` t
			WHERE 1
			'.( ( !empty( $query ) ) ? $search : "" ).'
			LIMIT 0, '.(int)($nb);
		
			$result = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS( $sql );
		}

		return $result;
	}

	public function getManufacturerTags () {
		
	}
	
	static public function getProductTags2 ( $id_product, $id_lang = null) {
	 	if (!$tmp = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
		SELECT t.*
		FROM '._DB_PREFIX_.'tag t 
		LEFT JOIN '._DB_PREFIX_.'product_tag pt ON (pt.id_tag = t.id_tag) 
		WHERE pt.`id_product`='.(int)($id_product).'
		ORDER BY t.name ASC'))
	 		return false;
	 	$result = array();
	 	
	 	foreach ($tmp AS $tag) {
	 		if ( $tag['id_tag'] && !empty( $tag['name'] ) ) {	 			
	 			$result[$tag['id_lang']][] = array(
	 				'id' => $tag['id_tag'],
	 				'name' => $tag['name']
	 			);
	 		}
	 	}

		if ( $id_lang ) {
			$result = $result[$id_lang];
		}

	 	return $result;
	}
	
	static public function formatTagCartouche ( $data = array() ) {
		/*
		$Category = new Category( 102 );
		$tags = $Category->getTags();

		foreach ( $tags as $item ) {
			if ( $item['id'] ) {
				$new_tag = str_replace( ' ', '', $item['name'] );
			
				Db::getInstance()->Execute('
					UPDATE `presta_tag` SET `name` = "'.$new_tag.'" WHERE `id_tag` ='.$item['id'].' LIMIT 1;
				');
			}
		}
		*/
		
		$voyelles = array('a', 'e', 'i', 'o', 'u', 'y');

		$new_data = array();
		foreach ( (array)$data as $item ) {
			$nb = strlen( $item['name'] );
			
			$item['name_clean'] = str_replace( ' ', '', $item['name'] );
			
			$hasSpace = false;
			$tmp_word = '';
			for ( $i = 0; $i < $nb; $i++ ) {
				if (
					!$hasSpace
					&& $i
					&& (
						( strtoupper( $item['name'][$i] ) == $item['name'][$i] && strtolower( $item['name'][$i-1] ) == $item['name'][$i-1] )
						//|| ( !in_array( $item['name'][$i], $voyelles ) && !in_array( $item['name'][$i-1], $voyelles ) && $item['name'][$i] != $item['name'][$i-1] )
					)
				) {
					$tmp_name = ' '.$item['name'][$i];
				}
				else {
					$tmp_name = $item['name'][$i];
				}

				$tmp_word .= $tmp_name;

				if ( is_string( $item['name'][$i] ) && is_numeric( $item['name'][$i+1] ) && !$hasSpace ) {
					$tmp_word .= '  ';
					
					$hasSpace = true;
				}
			}
			
			$item['name'] = $tmp_word;
			
			$new_data[current( explode( '  ', $tmp_word ) )][] = $item;
		}
		
		return $new_data;
	}
}