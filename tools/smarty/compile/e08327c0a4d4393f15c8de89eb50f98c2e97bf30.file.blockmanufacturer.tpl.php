<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:28
         compiled from "/homepages/13/d194332323/htdocs/www/modules/blockmanufacturer/blockmanufacturer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18994881574e396facd1dff1-87486329%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e08327c0a4d4393f15c8de89eb50f98c2e97bf30' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/blockmanufacturer/blockmanufacturer.tpl',
      1 => 1302101929,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18994881574e396facd1dff1-87486329',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?>

<!-- Block manufacturers module -->
<div id="manufacturers_block_left" class="block blockmanufacturer">
	<h4><?php if ($_smarty_tpl->getVariable('display_link_manufacturer')->value){?><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('manufacturer.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Manufacturers','mod'=>'blockmanufacturer'),$_smarty_tpl);?>
"><?php }?><?php echo smartyTranslate(array('s'=>'Manufacturers','mod'=>'blockmanufacturer'),$_smarty_tpl);?>
<?php if ($_smarty_tpl->getVariable('display_link_manufacturer')->value){?></a><?php }?></h4>
	<div class="block_content">
<?php if ($_smarty_tpl->getVariable('manufacturers')->value){?>
	<?php if ($_smarty_tpl->getVariable('text_list')->value){?>
	<ul class="bullet">
	<?php  $_smarty_tpl->tpl_vars['manufacturer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manufacturers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['manufacturer']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['manufacturer']->iteration=0;
 $_smarty_tpl->tpl_vars['manufacturer']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['manufacturer_list']['iteration']=0;
if ($_smarty_tpl->tpl_vars['manufacturer']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->key => $_smarty_tpl->tpl_vars['manufacturer']->value){
 $_smarty_tpl->tpl_vars['manufacturer']->iteration++;
 $_smarty_tpl->tpl_vars['manufacturer']->index++;
 $_smarty_tpl->tpl_vars['manufacturer']->first = $_smarty_tpl->tpl_vars['manufacturer']->index === 0;
 $_smarty_tpl->tpl_vars['manufacturer']->last = $_smarty_tpl->tpl_vars['manufacturer']->iteration === $_smarty_tpl->tpl_vars['manufacturer']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['manufacturer_list']['first'] = $_smarty_tpl->tpl_vars['manufacturer']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['manufacturer_list']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['manufacturer_list']['last'] = $_smarty_tpl->tpl_vars['manufacturer']->last;
?>
		<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['manufacturer_list']['iteration']<=$_smarty_tpl->getVariable('text_list_nb')->value&&$_smarty_tpl->tpl_vars['manufacturer']->value['nb_products']>0){?>
			<li class="<?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['manufacturer_list']['last']){?>last_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['manufacturer_list']['first']){?>first_item<?php }else{ ?>item<?php }?>"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']);?>
" title="<?php echo smartyTranslate(array('s'=>'More about','mod'=>'blockmanufacturer'),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['name'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['manufacturer']->value['name'],'htmlall','UTF-8');?>
</a></li>
		<?php }?>
	<?php }} ?>
	</ul>
	<?php }?>
	<?php if ($_smarty_tpl->getVariable('form_list')->value){?>
		<form action="<?php echo $_SERVER['SCRIPT_NAME'];?>
" method="get">
			<p>
				<select id="manufacturer_list" onchange="autoUrl('manufacturer_list', '');">
					<option value="0"><?php echo smartyTranslate(array('s'=>'All manufacturers','mod'=>'blockmanufacturer'),$_smarty_tpl);?>
</option>
				<?php  $_smarty_tpl->tpl_vars['manufacturer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manufacturers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->key => $_smarty_tpl->tpl_vars['manufacturer']->value){
?>
					<option value="<?php echo $_smarty_tpl->getVariable('link')->value->getmanufacturerLink($_smarty_tpl->tpl_vars['manufacturer']->value['id_manufacturer'],$_smarty_tpl->tpl_vars['manufacturer']->value['link_rewrite']);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['manufacturer']->value['name'],'htmlall','UTF-8');?>
</option>
				<?php }} ?>
				</select>
			</p>
		</form>
	<?php }?>
<?php }else{ ?>
	<p><?php echo smartyTranslate(array('s'=>'No manufacturer','mod'=>'blockmanufacturer'),$_smarty_tpl);?>
</p>
<?php }?>
	</div>
</div>
<!-- /Block manufacturers module -->
