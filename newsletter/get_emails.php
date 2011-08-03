<?php

require(dirname(__FILE__).'/../config/config.inc.php');

$customers = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
SELECT `email`
FROM `'._DB_PREFIX_.'customer`
ORDER BY `id_customer` ASC');

foreach ( $customers as $item ) {
	echo $item['email']."\n";
}