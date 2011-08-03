<?php

$link = mysql_connect( _DB_SERVER_, _DB_USER_, _DB_PASSWD_ ) or die( "Impossible de ce connecter à la base de donnée" );
mysql_select_db( _DB_NAME_, $link );

$myCLE = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_PASSPHRASE\'' ) );
$myTPE = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_TPENUM\'' ) );
$mySITECODE = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_SITECODE\'' ) );
$myHMAC = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_CTLHMAC\'' ) );
$myURLnok = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_URLRETOURKO\'' ) );
$myURLok = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_URLRETOUROK\'' ) );
$myURLretour = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_URLRETOUR\'' ) );
$myBANKServeur = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_BANKSERVER\'' ) );

if ( !empty( $myCLE['value'] ) ) {
	$myCLE = $myCLE['value'];
}

if ( !empty( $myTPE['value'] ) ) {
	$myTPE = $myTPE['value'];
}

if ( !empty( $mySITECODE['value'] ) ) {
	$mySITECODE = $mySITECODE['value'];
}

if ( !empty( $myHMAC['value'] ) ) {
	$myHMAC = $myHMAC['value'];
}

if ( !empty( $myURLnok['value'] ) ) {
	$myURLnok = $myURLnok['value'];
}

if ( !empty( $myURLok['value'] ) ) {
	$myURLok = $myURLok['value'];
}

if ( !empty( $myURLretour['value'] ) ) {
	$myURLretour = $myURLretour['value'];
}

if ( !empty( $myBANKServeur['value'] ) ) {
	$myBANKServeur = $myBANKServeur['value'];
}

if ( strpos( $myBANKServeur, '/test/' ) === false ) {
	$myDIR = "/telepaiement/";
}
else {
	$myDIR = "/test/";
}

$server = str_replace( 'https://', '', $server );
$server = str_replace( '/paiement.cgi', '', $server );
$server = str_replace( '/test', '', $server );
$server = str_replace( '/telepaiement', '', $server );

$reqMethod = $HTTP_SERVER_VARS["REQUEST_METHOD"];
if ( ( $reqMethod == "GET" ) or ( $reqMethod == "POST" ) ) {
    $wbruteVars = '_'.$reqMethod;
    $getInfosOrder = $$wbruteVars;
}

if ( !empty( $getInfosOrder['TPE'] ) ) {
	$getTPE = $getInfosOrder['TPE'];
}

if ( !empty( $getInfosOrder['date'] ) ) {
	$getDATE = $getInfosOrder['date'];
}

if ( !empty( $getInfosOrder['montant'] ) ) {
	$getMONTANT = $getInfosOrder['montant'];
}

if ( !empty( $getInfosOrder['reference'] ) ) {
	$getREF = $getInfosOrder['reference'];
}

if ( !empty( $getInfosOrder['MAC'] ) ) {
	$getMAC = $getInfosOrder['MAC'];
}

if ( !empty( $getInfosOrder['texte-libre'] ) ) {
	$getTEXTElibre = $getInfosOrder['texte-libre'];
}

if ( !empty( $getInfosOrder['code-retour'] ) ) {
	$codeRETOUR = $getInfosOrder['code-retour'];
}

if ( !empty( $getInfosOrder['retourPLUS'] ) ) {
	$getRETOURplus = $getInfosOrder['retourPLUS'];
}