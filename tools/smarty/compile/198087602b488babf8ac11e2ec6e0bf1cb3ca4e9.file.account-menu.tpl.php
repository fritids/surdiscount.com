<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 18:02:59
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/./account-menu.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3830231694e397133975498-29642407%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '198087602b488babf8ac11e2ec6e0bf1cb3ca4e9' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/./account-menu.tpl',
      1 => 1300809178,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3830231694e397133975498-29642407',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<div id="account-menu">
	<div class="item orders"><a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
history.php"><?php echo smartyTranslate(array('s'=>'Orders'),$_smarty_tpl);?>
</a></div>
	<div class="item slips"><a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
order-slip.php"><?php echo smartyTranslate(array('s'=>'slips'),$_smarty_tpl);?>
</a></div>
	<div class="item addresses"><a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
addresses.php"><?php echo smartyTranslate(array('s'=>'Addresses'),$_smarty_tpl);?>
</a></div>
	<div class="item information"><a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
identity.php"><?php echo smartyTranslate(array('s'=>'Information'),$_smarty_tpl);?>
</a></div>
	<div class="item vouchers"><a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
discount.php"><?php echo smartyTranslate(array('s'=>'Vouchers'),$_smarty_tpl);?>
</a></div>
	
	<div class="clear"></div>
</div>