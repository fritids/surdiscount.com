<?php

if (!defined('_CAN_LOAD_FILES_'))
	exit;

class BlockTelephone extends Module
{
	private $_html = '';
	private $_postErrors = array();

	function __construct()
	{
		$this->name = 'blocktelephone';
		$this->tab = 'Blocks';
		$this->version = '0.9';

		parent::__construct();
		
		$this->displayName = $this->l('telephone block');
		$this->description = $this->l('Displays informations for contact the compagny');
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
		return $this->display(__FILE__, 'blocktelephone.tpl');
	}
}
