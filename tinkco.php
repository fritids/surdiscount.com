<?php

$ink = array();

$url = 'http://www.tinkco.com/fr/AccesMarque/ListeImp.asp';

$html = file_get_contents( $url );

preg_match_all( '|(<([\w]+)[^>]*>)(.*?)(<\/\\2>)|', $html, $out, PREG_SET_ORDER );

$start = true;
foreach ( $out as $i => $item ) {
	if ( ereg( 'Tous les mod', $item[3] ) ) {
		$start = false;
	}

	if ( $item[2] == 'option' && $start ) {
		preg_match( '|="(.*?)" >(.*?)<|', $item[0], $manu );
		
		//print_r( $manu );
		
		$ink[$manu[1]] = array(
			'name' => $manu[2]
		);
	}
}

foreach ( $ink as $manu_id => &$manu ) {
	$url_manu = 'http://www.tinkco.com/fr/AccesMarque/ListeImp.asp?Marque='.$manu_id;
	
	$html_manu = file_get_contents( $url_manu );
	
	preg_match_all( '|(<([\w]+)[^>]*>)(.*?)(<\/\\2>)|', $html_manu, $out_manu, PREG_SET_ORDER );
	
	$start = false;
	$j = 0;
	foreach ( $out_manu as $i => $item_manu ) {
		if ( ereg( 'Tous les mod', $item_manu[3] ) ) {
			$start = true;
		}
	
		if ( $item_manu[2] == 'option' && $start && !ereg( 'Tous les mod', $item_manu[3] ) ) {
			preg_match( '|="(.*?)">(.*?)<|', $item_manu[0], $mode );
			$manu['modeles'][$j] = array(
				'id' => $mode[1],
				'name' => $mode[2]
			);
			
			$url_mode = 'http://www.tinkco.com/fr/AccesMarque/ListeImp.asp?Marque='.$manu_id.'&Modele='.$mode[1];
			
			$html_mode = file_get_contents( $url_mode );
			
			preg_match_all( '|<span class="modele">(.*?)</span>|', $html_mode, $out_mode, PREG_SET_ORDER );

			foreach ( $out_mode as $k => $item_ref ) {
				$manu['modeles'][$j]['references'][] = $item_ref[1];
			}
			
			$j++;
		}
	}
}

echo '<pre>';
	print_r( $ink );
echo '</pre>';exit;