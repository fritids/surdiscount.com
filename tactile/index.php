<?php

define( 'DS', DIRECTORY_SEPARATOR );

define( 'ROOT', dirname( __FILE__ ).DS );
define( 'CONTROLER', ROOT.'controler'.DS );
define( 'TPL', ROOT.'tpl'.DS );
define( 'LAYOUT', TPL.'layout'.DS );
define( 'CSS', ROOT.'css'.DS );
define( 'IMG', CSS.'images'.DS );
define( 'JS', ROOT.'js'.DS );

define( '_ROOT', '' );
define( '_CONTROLER', _ROOT.'controler/' );
define( '_TPL', _ROOT.'tpl/' );
define( '_LAYOUT', _TPL.'layout/' );
define( '_CSS', _ROOT.'css/' );
define( '_IMG', _CSS.'images'.DS );
define( '_JS', _ROOT.'js/' );

$name_page = ( isset( $_GET['page'] ) ) ? $_GET['page'] : 'home';
$file_page = TPL.$name_page.'.php';

$file_controler = CONTROLER.$name_page.'.php';

include( LAYOUT.'main.php' );