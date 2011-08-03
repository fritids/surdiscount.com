<?php

/***************************************************************************************
* Warning !! CMCIC_Config contains the key, you have to protect this file with all     *   
* the mechanism available in your development environment.                             *
* You may for instance put this file in another directory and/or change its name       *
***************************************************************************************/

include( dirname(__FILE__).'/../../config/config.inc.php' );

$link = mysql_connect( _DB_SERVER_, _DB_USER_, _DB_PASSWD_ ) or die( 'Impossible de ce connecter à la base de donnée' );
mysql_select_db( _DB_NAME_, $link );

$myCLE = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_PASSPHRASE\'' ) );
$myTPE = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_TPENUM\'' ) );
$mySITECODE = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_SITECODE\'' ) );
$myHMAC = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_CTLHMAC\'' ) );
$myURLnok = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_URLRETOURKO\'' ) );
$myURLok = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_URLRETOUROK\'' ) );
$myURLretour = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_URLRETOUR\'' ) );
$myBANKServeur = mysql_fetch_array( mysql_query( 'SELECT value FROM `'._DB_PREFIX_.'configuration` WHERE `name` = \'EI_BANKSERVER\'' ) );

if ( strpos( $myBANKServeur, '/test/' ) === false ) {
	$myDIR = '/telepaiement/';
}
else {
	$myDIR = '/test/';
}

define ( 'CMCIC_CLE', $myCLE['value'] );
define ( 'CMCIC_TPE', $myTPE['value'] );
define ( 'CMCIC_VERSION', '3.0' );
define ( 'CMCIC_SERVEUR', 'https://paiement.creditmutuel.fr'.$myDIR );
define ( 'CMCIC_CODESOCIETE', $mySITECODE['value'] );
define ( 'CMCIC_URLOK', $myURLok['value'] );
define ( 'CMCIC_URLKO', $myURLnok['value'] );