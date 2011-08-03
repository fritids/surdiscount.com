<?php

include( dirname(__FILE__).'/../../config/config.inc.php' );
include( dirname(__FILE__).'/../../header.php' );
include( './euroinformation.php' );

include( './get_infos.php' );
	
if ( ( $getTPE == $myTPE ) AND ( ( strtolower ( $codeRETOUR ) == "payetest" ) OR ( strtolower ( $codeRETOUR ) == "paiement" ) ) ) {
	$state = 'OK';
	
	$EI = new EuroInformation();
	$MONTANT = str_replace( 'EUR', '', $getMONTANT );
	
	$EI->validateOrder( $getREF, 11, $MONTANT, 'Carte de Credit', NULL, $currency->id );
}
elseif ( strtolower ( $codeRETOUR ) == "annulation" ) {
	$state = 'NO';
}

mail( 'parweb@gmail.com', 'Commande surdiscount.com', "$state : $codeRETOUR - $getDATE # $getREF # $getMONTANT\n" );

$fic = fopen( "request.dat", "a" );
fputs( $fic, "$state : $codeRETOUR - $getDATE # $getREF # $getMONTANT\n" );
fclose( $fic );

echo "$myTPE*$getDATE*$getMONTANT*$getREF*Commande*3.0*$codeRETOUR**************";