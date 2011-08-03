<?php

class Category extends CategoryCore {
	public function getManufacturers ( $recursif = false ) {
		global $cookie;
		
		$manufacturer = array();
		$manufacturers = array();
		
		$products = $this->getProducts( $cookie->id_lang, 0, 1000 );

		if ( $products ) {
			foreach ( $products as $i => $product ) {
				if ( (int)$product['id_manufacturer'] ) {
					$manufacturer[$product['id_manufacturer']] = $product['manufacturer_name'];
				}
			}
		}
		
		foreach ( $manufacturer as $id => $name ) {
			if ( $product['id_manufacturer'] ) {
				$manufacturers[] = array(
					'id' => $id,
					'name' => $name
				);
			}
		}

		if ( $recursif ) {
			$sub_cat = (array)$this->getChildrenWs();
			
			foreach ( $sub_cat as $item ) {
				$Sub = new self( $item['id'] );
				$marques = $Sub->getManufacturers( true );

				if ( count( $marques ) ) {
					$manufacturers = array_merge( $manufacturers, $marques );
				}
			}
		}

		return $manufacturers;
	}

	public function getProductsFromManufacturer ( $id_manufacturer, $id_lang, $p, $n, $orderBy = NULL, $orderWay = NULL, $getTotal = false ) {
		if ( $getTotal ) {
			$p = 0;
			$n = 10000;
			$getTotal = false;
		}

		$products = $this->getProducts( $id_lang, $p, $n, $orderBy, $orderWay, $getTotal );

		$filter_products = array();
		if ( $products ) {
			foreach ( $products as $product ) {
				if ( $product['id_manufacturer'] == $id_manufacturer || $id_manufacturer == 0 ) {
					$filter_products[] = $product;
				}
			}
		}
		
		if ( $n == 10000 ) {
			$filter_products = count( $filter_products );
		}

		return $filter_products;
	}
	
	public function getProductsWsRecurcive () {
		$products = array();
		$children = $this->getChildrenWs();
		
		$current_products = $this->getProductsWs();

		if ( count( $current_products ) ) {
			$products = $current_products;
		}

		if ( count( $children ) ) {
			foreach ( $children as $item ) {
				$Cat = new Category( $item['id'] );
				$products = array_merge( $products, $Cat->getProductsWsRecurcive() );
			}
		}
		
		return $products;
	}
	
	static public function getParents ( $id_category ) {
		$parents = array();
		$parents[] = $id_category;

		$id_parent = Db::getInstance()->ExecuteS('SELECT id_parent FROM '._DB_PREFIX_.'category WHERE id_category = '.$id_category.'');
		$id_parent = $id_parent[0]['id_parent'];

		if ( $id_parent > 1 ) {
			$parents[] = $id_parent;
			
			$parents = array_merge( $parents, self::getParents( $id_parent ) );
		}

		return array_unique( $parents );
	}
	
	public function getTags () {
		global $cookie;

		$products = (array)$this->getProductsWsRecurcive();

		$tags = array();
		foreach ( $products as $item ) {
			$new_tags = (array)Tag::getProductTags2( $item['id'], $cookie->id_lang );

			if ( count( $new_tags ) ) {
				$tags = array_merge( $tags, $new_tags );
			}
		}

		return $tags;
	}
	
	public function getProductsRecursif ( $id_lang, $p, $n, $orderBy = NULL, $orderWay = NULL, $getTotal = false, $active = true, $random = false, $randomNumberProducts = 1, $checkAccess = true ) {
		$products = $this->getProducts( $id_lang, $p, $n, $orderBy, $orderWay, $getTotal, $active, $random, $randomNumberProducts, $checkAccess );

		$children = (array)self::getChildren( $this->id, $id_lang );

		foreach ( $children as $child ) {
			$subCategory = new Category( $child['id_category'] );
			$sub_products = $subCategory->getProductsRecursif( $id_lang, $p, $n, $orderBy, $orderWay, $getTotal, $active, $random, $randomNumberProducts, $checkAccess );

			if ( $getTotal ) {
				$products = $products + $sub_products;
			}
			else {
				if ( is_array( $products ) && is_array( $sub_products ) ) {
					$products = array_merge( $products, $sub_products );
				}
				else if ( !is_array( $products ) && is_array( $sub_products ) ) {
					$products = $sub_products;
				}
			}
		}
		
		return $products;
	}
		
	public function getChildrenWsFromCategory ( $id ) {
		$Category = new self( $id );

		return $Category->getChildrenWs();
	}

	static public function getRandomProductFromCategory ( $id, $isPromo = true ) {
		global $cookie;

		$children = Category::getChildrenWsFromCategory( $id );

		shuffle( $children );
		$new_Category = new self( $children[0]['id'] );

		$product = $new_Category->getProductsRecursif( $cookie->id_lang, 0, 1, NULL, NULL, false, true, true );
		$product = $product[0];
		
		/*if ( $product['price_without_reduction'] == '' || $product['quantity'] == 0 ) {
			$product = Category::getRandomProductFromCategory( $id, $isPromo );
		}*/
		
		return $product;
	}
}