<?php

require(dirname(__FILE__).'/config/config.inc.php');

$history = new OrderHistory();
$history->id_order = 4681;
$history->id_order_state = 6;
$history->id_employee= 1;
$history->addWithemail();