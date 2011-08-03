<?php

class SearchController extends SearchControllerCore {
	public function process () {
		self::$smarty->assign(array(
			'listingSize' => Image::getSize('listing')
		));
	}
}