<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:29
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/./breadcrumb.tpl" */ ?>
<?php /*%%SmartyHeaderCode:732257394e396fadbad686-36790412%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f02e48914c03d02864bfb1eed2e46ab06e881bc3' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/./breadcrumb.tpl',
      1 => 1303394589,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '732257394e396fadbad686-36790412',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Breadcrumb -->
<?php if (isset(Smarty::$_smarty_vars['capture']['path'])){?><?php $_smarty_tpl->tpl_vars['path'] = new Smarty_variable(Smarty::$_smarty_vars['capture']['path'], null, null);?><?php }?>
<div class="breadcrumb">
	<ul>
		<li itemscope itemtype="http://data-vocabulary.org/Breadcrumb"><a itemprop="url" href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smartyTranslate(array('s'=>'return to'),$_smarty_tpl);?>
 <?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
"><span itemprop="title"><?php echo smartyTranslate(array('s'=>'Home'),$_smarty_tpl);?>
</span></a></li><?php if (isset($_smarty_tpl->getVariable('path',null,true,false)->value)&&$_smarty_tpl->getVariable('path')->value){?><?php echo $_smarty_tpl->getVariable('path')->value;?>
<?php }?>
		<div class="clear"></div>
	</ul>
</div>
<!-- /Breadcrumb -->