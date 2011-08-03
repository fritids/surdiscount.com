<?php

class StoreController extends StoreControllerCore {
	public function preProcess () {
		$Store = new Store( Tools::getValue( 'id_store' ) );
	
		self::$smarty->assign( array(
			'Store' => $Store,
			'days' => array( 'lundi', 'mardi', 'mecredi', 'jeudi', 'vendredi', 'samedi', 'dimanche' ),
			'storeSize' => Image::getSize('store')
		));
	}
	
	public function displayContent()
	{
		self::$smarty->display(_PS_THEME_DIR_.'store.tpl');
	}
}