<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:28
         compiled from "/homepages/13/d194332323/htdocs/www/modules/feeder/feederHeader.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3732864094e396fac98e517-24062875%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd6943bc6adeed2feb636e62f113df7287951cb19' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/feeder/feederHeader.tpl',
      1 => 1300209584,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3732864094e396fac98e517-24062875',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?>

<link rel="alternate" type="application/rss+xml" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_title')->value,'html','UTF-8');?>
" href="<?php echo $_smarty_tpl->getVariable('feedUrl')->value;?>
" />