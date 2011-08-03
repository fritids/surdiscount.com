<?php

include(dirname(__FILE__).'/../../config/config.inc.php');
include(dirname(__FILE__).'/../../init.php');

$type_id = Tools::getValue('select_type');
$manufacturer_id = Tools::getValue('select_manufacturer');
$serie_name = Tools::getValue('select_serie');
$tag_id = Tools::getValue('select_reference');
$q = Tools::getValue('q');
$id_category_cartouche = Tools::getValue('id_category_cartouche');

if ( Tools::getValue('searchRefInk') ) {
	$products = Product::searchProductByReferenceForInk( $q, $cookie->id_lang, $id_category_cartouche );

	$smarty->assign( array(
		'products' => $products
	));

	$smarty->display( _PS_THEME_DIR_.'products.tpl' );
	die();
}

if ( Tools::getValue('searchRefInk________2________') ) {
	echo 'string';exit;
	$Cartouche->ajaxProductList( 'fromRef', array(
		'id_category_cartouche' => $id_category_cartouche,
		'q' => $q
	));
	die();
}

$category_id = ( (int)$manufacturer_id > 0 ) ? $manufacturer_id : $type_id;

if ( $type_id ) {
	$manufacturers = Category::getChildren( $type_id, $cookie->id_lang );
	
	ob_start();
		$_GET['id_category'] = $category_id;
		ControllerFactory::getController('Category2Controller')->run();
	$search = ob_get_contents();
	ob_clean();
}

if ( Tools::getValue('getManufacturers') ) {
	die( json_encode( array( 'list' => $manufacturers, 'search' => $search ) ) );
}

if ( Tools::getValue('getSeries') || Tools::getValue('getReferences') ) {
	$Category = new Category( $category_id );
	$references = (array)$Category->getTags();

	$references = Tag::formatTagCartouche( $references );

	if ( Tools::getValue('getSeries') ) {
		$series = array();
		foreach ( $references as $name => $item ) {
			$series[] = $name;
		}

		die( json_encode( array( 'list' => $series, 'search' => $search ) ) );
	}

	if ( !empty( $serie_name ) ) {
		$refs = array();
		foreach ( $references[$serie_name] as $i => $item ) {
			//echo 'if ( !ereg( \'^'.$serie_name.'\', '.$item['name'].' ) ) {';
			$refs[] = array(
				'id' => $item['id'],
				'name' => $item['name'],
				'name_clean' => str_replace( ' ', '', $item['name'] )
			);
		}

		ob_start();
			$_GET['tag'] = $serie_name;
			$_GET['id_category'] = $category_id;
			ControllerFactory::getController('SearchController')->run();
		$search = ob_get_contents();
		ob_clean();

		die( json_encode( array( 'list' => $refs, 'search' => $search ) ) );
	}
}