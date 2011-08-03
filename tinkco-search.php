<?php

$search = urlencode( $_GET['s'] );

$url = 'http://www.tinkco.com/fr/QuickAccess/default.asp?q='.$search;

$html = file_get_contents( $url );

preg_match_all( '|IDREF=(.*?)><img src(.*?)alt="(.*?)" class="photo"(.*?)<span class="url">((.*?)IDREF=(.*?))</span>|s', $html, $out, PREG_SET_ORDER );

$choise = array();
foreach ( $out as $item ) {
	$choise[] = array(
		'id' => $item[7],
		'link' => $item[5],
		'text' => htmlentities( $item[3] )
	);
}

die( json_encode( $choise ) );