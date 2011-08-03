<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:28
         compiled from "/homepages/13/d194332323/htdocs/www/modules/blockinfos/blockinfos.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7299270354e396facf155f7-67385031%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'ad17ab065bb7bcfbfe0776174b1b4d0c41699f4f' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/blockinfos/blockinfos.tpl',
      1 => 1303836057,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7299270354e396facf155f7-67385031',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?><!-- Block informations module -->
<div id="informations_block_left" class="block">
	<h4><?php echo smartyTranslate(array('s'=>'Information','mod'=>'blockinfos'),$_smarty_tpl);?>
</h4>
	<ul class="block_content">
		<?php  $_smarty_tpl->tpl_vars['cmslink'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('cmslinks')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['cmslink']->key => $_smarty_tpl->tpl_vars['cmslink']->value){
?>
			<li><a href="<?php echo $_smarty_tpl->tpl_vars['cmslink']->value['link'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'],'html','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['cmslink']->value['meta_title'],'html','UTF-8');?>
</a></li>
		<?php }} ?>
		
		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
contact/" title="Contact">contact</a>
	</ul>
</div>
<!-- /Block informations module -->
