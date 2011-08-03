<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class HomePromo extends Module
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'homepromo';
		$this->tab = 'Tools';
		$this->version = '0.9';

		parent::__construct();
		
		$this->displayName = $this->l('Promo Products on the homepage');
		$this->description = $this->l('Displays Promo Products in the middle of your homepage');
	}

	function install()
	{
		if (!Configuration::updateValue('HOME_PROMO_NBR', 8) OR !parent::install() OR !$this->registerHook('home'))
			return false;
		return true;
	}

	public function getContent()
	{
		$output = '<h2>'.$this->displayName.'</h2>';
		if (Tools::isSubmit('submitHomePromo'))
		{
			$nbr = intval(Tools::getValue('nbr'));
			if (!$nbr OR $nbr <= 0 OR !Validate::isInt($nbr))
				$errors[] = $this->l('Invalid number of product');
			else
				Configuration::updateValue('HOME_PROMO_NBR', intval($nbr));
			if (isset($errors) AND sizeof($errors))
				$output .= $this->displayError(implode('<br />', $errors));
			else
				$output .= $this->displayConfirmation($this->l('Settings updated'));
		}
		return $output.$this->displayForm();
	}

	public function displayForm()
	{
		$output = '
		<form action="'.$_SERVER['REQUEST_URI'].'" method="post">
			<fieldset><legend><img src="'.$this->_path.'logo.gif" alt="" title="" />'.$this->l('Settings').'</legend>
				<p>'.$this->l('In order to add products to your homepage, just add them to the "home" category.').'</p><br />
				<label>'.$this->l('Number of product displayed').'</label>
				<div class="margin-form">
					<input type="text" size="5" name="nbr" value="'.Tools::getValue('nbr', intval(Configuration::get('HOME_PROMO_NBR'))).'" />
					<p class="clear">'.$this->l('The number of products displayed on homepage (default: 10)').'</p>
					
				</div>
				<center><input type="submit" name="submitHomePromo" value="'.$this->l('Save').'" class="button" /></center>
			</fieldset>
		</form>';
		return $output;
	}

	function hookHome($params)
	{
		global $smarty;

		$nbProducts = intval(Configuration::get('HOME_PROMO_NBR'));
		
		$smarty->assign(array(
			'homeSize' => Image::getSize('home'),
			'products' => Product::getPricesDrop(intval($params['cookie']->id_lang), 0, ($nbProducts ? $nbProducts : 10), false, 'price', 'ASC'),
			'nbProducts' => $nbProducts));
		
		return $this->display(__FILE__, 'homepromo.tpl');
	}
}