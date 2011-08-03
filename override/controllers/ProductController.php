<?php

class ProductController extends ProductControllerCore {
	public function process () {
		self::$smarty->assign( 'last_tag', self::$cookie->last_tag );
		
		$image_manufacturer = (!file_exists(_PS_MANU_IMG_DIR_.'/'.$this->product->id_manufacturer.'-manuProduct.jpg')) ? '' : $this->product->id_manufacturer;
		
		self::$smarty->assign(array(
			'last_tag' => self::$cookie->last_tag,
			'manuProductSize' => Image::getSize('manuProduct'),
			'image_manufacturer' => $image_manufacturer,
			'HOOK_PRODUCT_TAB_TOP' =>  Module::hookExec('productTabTop')
		));
		
		parent::process();
	}
}