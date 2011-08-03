<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:29
         compiled from "/homepages/13/d194332323/htdocs/www/modules/blockstore/blockstore.tpl" */ ?>
<?php /*%%SmartyHeaderCode:2575900334e396fad048c84-69468038%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '46fbed113e5c73892fcf59941590385fb0462b95' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/blockstore/blockstore.tpl',
      1 => 1302799889,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '2575900334e396fad048c84-69468038',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<!-- Block stores module -->
<div id="stores_block_left" class="block">
	<h4><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('stores.php');?>
" title="<?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockstore'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Our stores','mod'=>'blockstore'),$_smarty_tpl);?>
</a></h4>
	<div class="block_content blockstore">
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('stores')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
			<p>
				<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('store.php');?>
?id_store=<?php echo $_smarty_tpl->tpl_vars['item']->value['id_store'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['city'];?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_store_dir')->value;?>
<?php echo $_smarty_tpl->tpl_vars['item']->value['id_store'];?>
-blockStore.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['city'];?>
" width="<?php echo $_smarty_tpl->getVariable('blockStore')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('blockStore')->value['height'];?>
" /></a><br />
				<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('store.php');?>
?id_store=<?php echo $_smarty_tpl->tpl_vars['item']->value['id_store'];?>
" title="<?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['city'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
 - <?php echo $_smarty_tpl->tpl_vars['item']->value['city'];?>
</a>
			</p>
		<?php }} ?>
	</div>
</div>
<!-- /Block stores module -->
