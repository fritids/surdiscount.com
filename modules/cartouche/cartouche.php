<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class Cartouche extends Module
{
	const CATEGORY_CARTOUCHE_ID = 102;

 	public function __construct()
 	{
 	 	$this->name = 'cartouche';
		$this->tab = 'Blocks';
		$this->version = '0.1';

	 	parent::__construct();

 	 	$this->displayName = $this->l('Cartouche');
 	 	$this->description = $this->l('Adds a block for find cartouches easily');

		
 	}
 	
 	public function install() {
		Db::getInstance()->Execute('
			INSERT INTO '._DB_PREFIX_.'hook (name, title, description, position, live_edit ) value ("categoryTop", "Le haut de la liste des categorie", "Le haut de la liste des categorie", 1, 1 );
		');
		Db::getInstance()->Execute('
			INSERT INTO '._DB_PREFIX_.'hook (name, title, description, position, live_edit ) value ("productTabTop", "Le haut des onglets de la fiche produit", "Le haut des onglets de la fiche produit", 1, 1 );
		');

 		return ( parent::install() AND $this->registerHook('categoryTop') AND $this->registerHook('header')  AND $this->registerHook('productTabTop') );
 	}
 	
 	public function uninstall() {
 	 	return parent::uninstall();
 	}

	public function getContent()
	{
		return '';
	}

	public function _displayForm()
	{
		$output = '';

		return $output;
	}
 
 	function hookHeader($params)
 	{
 		Tools::addCSS(($this->_path).'cartouche.css', 'all');
 		Tools::addJS(($this->_path).'cartouche.js');
 	}
 
 	function hookProductTabTop($params)
 	{
 		global $smarty;

		$Product = new Product( Tools::getValue('id_product') );

		if ( in_array( self::CATEGORY_CARTOUCHE_ID, Category::getParents( $Product->id_category_default ) ) ) {
			$tags = Tag::getProductTags2( $Product->id, $params['cookie']->id_lang );
			$tags = Tag::formatTagCartouche( $tags );
	
	 		$smarty->assign(array(
		 		'tags' => $tags,
		 		'id_category_cartouches' => self::CATEGORY_CARTOUCHE_ID
	 		));
	
	 		return $this->display(__FILE__, 'product-cartouche.tpl');
		}
 	}

	function hookCategoryTop( $params )
	{
		global $smarty;
		
		$parents = Category::getParents( Tools::getValue('id_category') );

		if ( in_array( self::CATEGORY_CARTOUCHE_ID, $parents ) ) {
			$types = Category::getChildren( self::CATEGORY_CARTOUCHE_ID, $params['cookie']->id_lang );

			$type_id = $parents[0];
			$manufacturer_id = 0;
			
			if ( count( $parents ) > 2 ) {
				$type_id = $parents[1];
				$manufacturer_id = $parents[0];
			}

			$smarty->assign(array(
				'types' => $types,
				'manufacturers' => $manufacturers,
				'series' => $series,
				'references' => $references,
				'type_id' => $type_id,
				'manufacturer_id' => $manufacturer_id,
				'id_category_cartouches' => self::CATEGORY_CARTOUCHE_ID
			));
			
			
			return $this->display(__FILE__, 'cartouche.tpl');
		}
	}
		
	function ajaxProductList ( $type, $params = array() ) {
		global $smarty, $cookie;

		switch ( $type ) {
			case 'fromRef':
				$products = Product::searchProductByReferenceForInk( $params['q'], $cookie->id_lang, $params['id_category_cartouche'] );
echo '<pre>'.__FILE__.' ( '.__LINE__.' ) ';
	print_r( $products );
echo '</pre>';exit;
				$smarty->assign(array(
					'products' => $products,
					'nbProducts' => count( $products )
				));
				
				$smarty->display(__FILE__, 'list-products-ajax.tpl');
			break;

			default:
				//code
			break;
		}
	}
}

?>
