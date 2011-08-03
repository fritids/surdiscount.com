<?php

class ManufacturerController extends ManufacturerControllerCore {
	public function process () {
		parent::process();

		self::$smarty->assign(array(
			'listingSize' => Image::getSize('listing'),
			'subCatSize' => Image::getSize('subcat')
		));
	}
}