<?php

require(dirname(__FILE__).'/../config/config.inc.php');

$message = file_get_contents( 'juin-2011/index.html' );

$start = (int)file_get_contents( 'last' );
$end = $start + 10;

file_put_contents( 'logs', file_get_contents( 'logs' )."\n".'['.date('r').'] - $start: '.$start.' - $end: '.$end );

$configuration = Configuration::getMultiple(array('PS_SHOP_EMAIL', 'PS_SHOP_NAME'));

$customers = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
SELECT `id_customer`, `email`, `firstname`, `lastname`
FROM `'._DB_PREFIX_.'customer`
WHERE newsletter = 1
ORDER BY `id_customer` ASC LIMIT '.$start.', '.$end);

/*
$customers[] = array(
	'email' => 'parweb@gmail.com',
	'firstname' => 'Chris',
	'lastname' => 'LE GUICHOUX'
);
*/

foreach ( $customers as $item ) {
	$to = $item['email']; $to_name = $item['lastname'].' '.$item['firstname'];
	$from = $configuration['PS_SHOP_EMAIL']; $from_name = Configuration::get('PS_SHOP_NAME');

	$subject = $item['firstname'].' '.$item['lastname'].' c\'est bientôt la rentrée  !';
	
	// Pour envoyer un mail HTML, l'en-tête Content-type doit être défini
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";
	
	// En-têtes additionnels
	$headers .= 'From: '.$from_name.' <'.$from.'>' . "\r\n";
	
	$body = str_replace( '#|num|#', $item['id_customer'], $message );
	
	// Envoi
	mail($to, '['.Configuration::get('PS_SHOP_NAME').'] '.$subject, $body, $headers);
}

file_put_contents( 'last', $end );

?>

<meta http-equiv="refresh" content="30" />