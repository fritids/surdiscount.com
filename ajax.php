<?php

require(dirname(__FILE__).'/config/config.inc.php');

$cookie = new Cookie('ps', substr($_SERVER['SCRIPT_NAME'], strlen(__PS_BASE_URI__), -strlen($currentFileName['0'])));


if ( $_POST['close'] == 'coupon' && !empty( $_POST['close'] ) ) {
	global $cookie;
	
	$cookie->once = true;
}