<?php

require(dirname(__FILE__).'/../config/config.inc.php');

$customers = Db::getInstance(_PS_USE_SQL_SLAVE_)->ExecuteS('
SELECT `id_customer`, `email`, `firstname`, `lastname`, `newsletter`, `optin`
FROM `'._DB_PREFIX_.'customer`
WHERE newsletter = 1
ORDER BY `id_customer` ASC');

$json = json_encode( $customers );

file_put_contents( 'users.json', $json );