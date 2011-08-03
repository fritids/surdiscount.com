<?php

require_once(dirname(__FILE__).'/config/config.inc.php');

// recup les products
$list = Db::getInstance()->ExecuteS( 'SELECT presta_product.id_product, presta_product.id_manufacturer
FROM presta_product
ORDER BY presta_product.id_product ASC' );

// maj meta title
foreach ( $list as $result ) {
	$result['manufacturer'] = Db::getInstance()->ExecuteS( "SELECT presta_manufacturer.name as manufacturer
	FROM presta_manufacturer
	WHERE presta_manufacturer.id_manufacturer = ".$result['id_manufacturer'] );
	
	$result['manufacturer'] = $result['manufacturer'][0]['manufacturer'];

	// construit le fabricant si ya
	$manu = ( !empty( $result['manufacturer'] ) ) ? ', '.$result['manufacturer'] : '';
	
	$description = Db::getInstance()->ExecuteS( "SELECT presta_product_lang.*
	FROM presta_product_lang
	WHERE presta_product_lang.id_lang = 2 AND presta_product_lang.id_product  = ".$result['id_product'] );
	
	$description = $description[0];
	
	$description['name'] = addslashes( strip_tags( $description['name'] ) );
	$description['description'] = addslashes( strip_tags( $description['description'] ) );
	
	$tags = Db::getInstance()->ExecuteS( "SELECT presta_tag.*
	FROM presta_tag, presta_product_tag
	WHERE presta_tag.id_tag  = presta_product_tag.id_tag
	AND presta_tag.id_lang = 2
	AND presta_product_tag.id_product = ".$result['id_product'] );

	// construit la description
	$desc = strip_tags( str_replace( array( '><', ">\n<", '<p>', '</p>', '-' ), array( '> <', ' ', ' ', ' ', ' ' ), $description['description'] ) );
	$desc = trim( preg_replace('/\s\s+/', ' ', $desc) );
	
	$desc = ( count( $tags ) ) ? $desc : $desc;

	$_tags = null;

	if ( count( $tags ) ) {
		foreach ( $tags as $item ) {
			$_tags = $item['name'].', '.$_tags;
		}

		//$desc = $_tags.$desc;
	}

	// construit les mot clés
	$keywords = explode( ' ', str_replace( array( ', ', ' - ' ), array( ' ', ' ' ), $description['name'].$manu.", ".$desc ) );
	$keywords = array_unique( $keywords );

$sql = "UPDATE presta_product_lang
SET
	meta_title = '".$description['name'].$manu." – Hard Discount Papeterie, Fournitures de bureau, Fin de série, Destockage et divers... Surdiscount.com',
	meta_description = '$_tags$desc',
	meta_keywords = '".$_tags.join( ', ', $keywords )."'
WHERE
	presta_product_lang.id_lang = 2 AND
	presta_product_lang.id_product = ".$result['id_product'];
	
	//echo $result['id_product'].'<br />';
	//echo "<b>\$sql :</b> $sql<br />";
	
	Db::getInstance()->ExecuteS( $sql );
}