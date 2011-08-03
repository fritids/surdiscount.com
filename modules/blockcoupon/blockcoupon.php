<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class BlockCoupon extends Module
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'blockcoupon';
		$this->tab = 'Blocks';
		$this->version = '0.9';

		parent::__construct();
		
		$this->displayName = $this->l('coupon block');
		$this->description = $this->l('Displays a global coupon');
	}

	function install()
	{
		if (!parent::install())
			return false;
		if (!$this->registerHook('rightColumn'))
			return false;
		return true;
	}

	function hookRightColumn($params)
	{
		return $this->display(__FILE__, 'blockcoupon.tpl');
	}
}
