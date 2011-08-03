<?php

class CategoryController2 extends Category2ControllerCore {
	public function displayHeader()
	{
		parent::displayHeader();
		$this->productFilter();
	}

	public function process () {
		parent::process();
		
		$filter_manufacturer = Tools::getValue('filter_manufacturer');

		$products = $this->category->getProductsFromManufacturer($filter_manufacturer, (int)(self::$cookie->id_lang), (int)($this->p), (int)($this->n), $this->orderBy, $this->orderWay);
		$nbProducts = $this->category->getProductsFromManufacturer($filter_manufacturer, NULL, NULL, NULL, $this->orderBy, $this->orderWay, true);	

		self::$smarty->assign(array(
			'products' => $products,
			'nbProducts' => $nbProducts,
			'listingSize' => Image::getSize('listing'),
			'subCatSize' => Image::getSize('subcat')
		));
	}
}