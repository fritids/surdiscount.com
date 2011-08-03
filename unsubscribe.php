<?php

require(dirname(__FILE__).'/config/config.inc.php');

$id_customer = $_GET['num'];

$id_customer = substr( $id_customer, 0, -4);
$id_customer = substr( $id_customer, 4, 1000000000);

Db::getInstance()->ExecuteS("UPDATE `presta_customer` SET newsletter = '0' WHERE id_customer = $id_customer");

header( 'location: http://www.surdiscount.com/' );