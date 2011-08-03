<?php

*************************************************************************/

header('Pragma: no-cache');
header('Content-type: text/plain');

// TPE Settings
// Warning !! CMCIC_Config contains the key, you have to protect this file with all the mechanism available in your development environment.
// You may for instance put this file in another directory and/or change its name. If so, don't forget to adapt the include path below.
require_once('CMCIC_Config.php');

// --- PHP implementation of RFC2104 hmac sha1 ---
require_once('CMCIC_Tpe.inc.php');

include( './euroinformation.php' );

// Begin Main : Retrieve Variables posted by CMCIC Payment Server 
$CMCIC_bruteVars = getMethode();

// TPE init variables
$oTpe = new CMCIC_Tpe();
$oHmac = new CMCIC_Hmac($oTpe);

// Message Authentication
$cgi2_fields = sprintf(
	CMCIC_CGI2_FIELDS,
	$oTpe->sNumero,
	$CMCIC_bruteVars['date'],
	$CMCIC_bruteVars['montant'],
	$CMCIC_bruteVars['reference'],
	$CMCIC_bruteVars['texte-libre'],
	$oTpe->sVersion,
	$CMCIC_bruteVars['code-retour'],
	$CMCIC_bruteVars['cvx'],
	$CMCIC_bruteVars['vld'],
	$CMCIC_bruteVars['brand'],
	$CMCIC_bruteVars['status3ds'],
	$CMCIC_bruteVars['numauto'],
	$CMCIC_bruteVars['motifrefus'],
	$CMCIC_bruteVars['originecb'],
	$CMCIC_bruteVars['bincb'],
	$CMCIC_bruteVars['hpancb'],
	$CMCIC_bruteVars['ipclient'],
	$CMCIC_bruteVars['originetr'],
	$CMCIC_bruteVars['veres'],
	$CMCIC_bruteVars['pares']
);

$plop  = var_export( $CMCIC_bruteVars, true );
mail( 'parweb@gmail.com', 'variable CMCIC_bruteVars', $plop );

//mail( 'parweb@gmail.com', 'computeHmac', $oHmac->computeHmac( $cgi2_fields ) );
//mail( 'parweb@gmail.com', 'strtolower', strtolower( $CMCIC_bruteVars['MAC'] ) );

//if ( $oHmac->computeHmac( $cgi2_fields ) == strtolower( $CMCIC_bruteVars['MAC'] ) ) {
	switch($CMCIC_bruteVars['code-retour']) {
		case 'Annulation' :
			// Payment has been refused
			// put your code here (email sending / Database update)
			// Attention : an autorization may still be delivered for this payment
			
			mail( 'parweb@gmail.com', 'Annulation', 'Annulation' );
		break;

		case 'payetest':
			// Payment has been accepeted on the test server
			// put your code here (email sending / Database update)
			
			$EI = new EuroInformation;
			$getMONTANT = str_replace( 'EUR', '', $CMCIC_bruteVars['montant'] );
			
			$EI->validateOrder( $CMCIC_bruteVars['reference'], 11, $getMONTANT, 'Carte de Credit', NULL, 1 );
			
			mail( 'parweb@gmail.com', 'payetest', 'payetest' );
		break;

		case 'paiement':
			// Payment has been accepted on the productive server
			// put your code here (email sending / Database update)

			$EI = new EuroInformation;
			$getMONTANT = str_replace( 'EUR', '', $CMCIC_bruteVars['montant'] );

			$EI->validateOrder( $CMCIC_bruteVars['reference'], 11, $getMONTANT, 'Carte de Credit', NULL, 1 );
			
			mail( 'parweb@gmail.com', 'paiement', 'paiement' );
		break;


		/*** ONLY FOR MULTIPART PAYMENT ***/
		case 'paiement_pf2':
		case 'paiement_pf3':
		case 'paiement_pf4':
			// Payment has been accepted on the productive server for the part #N
			// return code is like paiement_pf[#N]
			// put your code here (email sending / Database update)
			// You have the amount of the payment part in $CMCIC_bruteVars['montantech']
			
			mail( 'parweb@gmail.com', 'paiement_pf', 'paiement_pf' );
		break;

		case 'Annulation_pf2':
		case 'Annulation_pf3':
		case 'Annulation_pf4':
			// Payment has been refused on the productive server for the part #N
			// return code is like Annulation_pf[#N]
			// put your code here (email sending / Database update)
			// You have the amount of the payment part in $CMCIC_bruteVars['montantech']
			
			mail( 'parweb@gmail.com', 'Annulation_pf', 'Annulation_pf' );
		break;
	}

	$receipt = CMCIC_CGI2_MACOK;
/*}
else {
	// your code if the HMAC doesn't match
	$receipt = CMCIC_CGI2_MACNOTOK.$cgi2_fields;
}*/

$fic = fopen( 'request.dat', 'a' );
fputs( $fic, "$CMCIC_bruteVars[code-retour] - $getDATE # $getREF # $getMONTANT\n" );
fclose( $fic );

//-----------------------------------------------------------------------------
// Send receipt to CMCIC server
//-----------------------------------------------------------------------------
printf( CMCIC_CGI2_RECEIPT, $receipt );

// Copyright (c) 2009 Euro-Information ( mailto:centrecom@e-i.com )
// All rights reserved. ---