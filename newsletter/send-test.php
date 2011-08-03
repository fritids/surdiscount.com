<?php

require(dirname(__FILE__).'/../config/config.inc.php');

$message = file_get_contents( 'juin-2011/index.html' );

$configuration = Configuration::getMultiple(array('PS_SHOP_EMAIL', 'PS_SHOP_NAME'));

$customers[] = array(
	'id_customer' => -1,
	'email' => 'parweb@gmail.com',
	'firstname' => 'Chris',
	'lastname' => 'LE GUICHOUX'
);
/*
$customers[] = array(
	'id_customer' => -2,
	'email' => 'anthony@surdiscount.com',
	'firstname' => 'Anthony',
	'lastname' => 'LE FUR'
);
*/
/*
$customers[] = array(
	'id_customer' => -3,
	'email' => 'jordan@surdiscount.com',
	'firstname' => 'Jordan',
	'lastname' => 'MENS'
);
*/

$start = 0;
$end = 10;

file_put_contents( 'logs', file_get_contents( 'logs' )."\n".'[test] - ['.date('r').'] - $start: '.$start.' - $end: '.$end );

foreach ( $customers as $item ) {
	$to = $item['email']; $to_name = $item['lastname'].' '.$item['firstname'];
	$from = $configuration['PS_SHOP_EMAIL']; $from_name = Configuration::get('PS_SHOP_NAME');

	$subject = $item['firstname'].' '.$item['lastname'].' c\'est déjà la rentrée chez Surdiscount.com en plus les frais de ports sont gratuit !';
	$subject = 'Test '.rand( 0, 1000 ).': '.$subject;
	
	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	
	// En-têtes additionnels
	$headers .= 'From: '.$from_name.' <'.$from.'>' . "\r\n";
	
	$body = str_replace( '#|num|#', $item['id_customer'], $message );
	
	// Envoi
	mail($to, '['.Configuration::get('PS_SHOP_NAME').'] '.$subject, $body, $headers);
}

?>

<meta http-equiv="refresh" content="30" />