<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class BlockViewed extends Module
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'blockviewed';
		$this->tab = 'Blocks';
		$this->version = 0.9;

		parent::__construct();

		$this->displayName = $this->l('Viewed products block');
		$this->description = $this->l('Adds a block displaying last-viewed products');
	}

	function install()
	{
		if (!parent::install()
			OR !$this->registerHook('leftColumn')
			OR !Configuration::updateValue('PRODUCTS_VIEWED_NBR', 2))
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitBlockViewed'))
		{
			if (!$productNbr = Tools::getValue('productNbr') OR empty($productNbr))
				$output .= '<div class="alert error">'.$this->l('You must fill in the \'Products displayed\' field').'</div>';
			elseif (intval($productNbr) == 0)
				$output .= '<div class="alert error">'.$this->l('Invalid number.').'</div>';
			else
			{
				Configuration::updateValue('PRODUCTS_VIEWED_NBR', intval($productNbr));
				$output .= '<div class="conf confirm"><img src="../img/admin/ok.gif" alt="'.$this->l('Confirmation').'" />'.$this->l('Settings updated').'</div>';
			}
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		$output = '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<label>'.$this->l('Products displayed').'</label>
				<div class="margin-form">
					<input type="text" name="productNbr" value="'.Configuration::get('PRODUCTS_VIEWED_NBR').'" />
					<p class="clear">'.$this->l('Define the number of products displayed in this block').'</p>
				</div>
				<center><input type="submit" name="submitBlockViewed" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
		return $output;
	}

	function hookRightColumn($params)
	{
		global $link, $smarty, $cookie;

		$id_product = intval(Tools::getValue('id_product'));
		$productsViewed = (isset($params['cookie']->viewed) AND !empty($params['cookie']->viewed)) ? array_slice(explode(',', $params['cookie']->viewed), 0, Configuration::get('PRODUCTS_VIEWED_NBR')) : array();

		$productsViewedObj = array();
		foreach ($productsViewed AS $productViewed) {
			$productsViewedObj[] = new Product( intval($productViewed), true, intval($params['cookie']->id_lang) );
		}

		if (!sizeof($productsViewedObj))
			return ;

		$smarty->assign(array(
			'productsViewedObj' => $productsViewedObj,
			'mediumSize' => Image::getSize('medium')));

		return $this->display(__FILE__, 'blockviewed.tpl');
	}

	function hookLeftColumn($params)
	{
		return $this->hookRightColumn($params);
	}

}
