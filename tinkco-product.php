<?php

$compatibles = array();

$id = urlencode( $_GET['id'] );

$url = 'http://www.tinkco.com/fr/QuickAccess/Produit.asp?IDREF='.$id;

$html = file_get_contents( $url );

$remplacements = array(
	'+' => 'plus',
	'#' => '',
	'@' => '',
	'!' => ''
);

preg_match_all( '|<fieldset class="encadre">(.*?)<div class="descriptif">|s', $html, $desc, PREG_SET_ORDER );
preg_match_all( '|<dl class="dl_liste">(.*?)</dl>|s', $desc[0][1], $series, PREG_SET_ORDER );

foreach ( $series as $i => $series ) {
	preg_match_all( '|Modele=(.*?)">(.*?)</a>|s', $series[1], $model, PREG_SET_ORDER );

	$compatibles[$i] = array(
		'id' => $model[0][1],
		'name' => htmlentities( $model[0][2] )
	);

	preg_match_all( '|<dd(.*?)>(.*?)Imprimante=(.*?)">(.*?)</a> </dd>|s', $series[1], $references, PREG_SET_ORDER );
	
	foreach ( $references as $j => $reference ) {
		$reference[4] = str_replace( array_keys( $remplacements ), array_values( $remplacements ), $reference[4] );
	
		$compatibles[$i]['references'][$j] = array(
			'id' => $reference[3],
			'name' => htmlentities( $reference[4] )
		);
	}
}

//print_r($compatibles);exit;
die( json_encode( $compatibles ) );