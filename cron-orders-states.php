<?php

require_once(dirname(__FILE__).'/config/config.inc.php');

include 'cron-products-metas.php';

function cron () {
	$orders_prepa = (array)Order::getOrderIdsByStatus(3);
	$orders_waits = (array)Order::getOrderIdsByStatus(4);
	
	$orders = array_unique( array_merge( $orders_prepa, $orders_waits ) );
	
	foreach ( $orders as $i => $item ) {
		$Order = new Order( $item );
		$Order->suivi();
	}
	
	mail( 'parweb@gmail.com', 'cron OK: '.__FILE__, 'cron OK: '.__FILE__."\n\t".$i.' commande(s) traitée(s)' );
}

cron();