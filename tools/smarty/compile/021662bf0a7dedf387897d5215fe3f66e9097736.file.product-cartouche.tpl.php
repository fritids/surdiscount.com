<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:29
         compiled from "/homepages/13/d194332323/htdocs/www/modules/cartouche/product-cartouche.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5107633524e396fad33fca4-89733400%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '021662bf0a7dedf387897d5215fe3f66e9097736' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/cartouche/product-cartouche.tpl',
      1 => 1312386931,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5107633524e396fad33fca4-89733400',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?><h2><?php echo smartyTranslate(array('s'=>'Cartouche compatible avec les modeles suivant:'),$_smarty_tpl);?>
</h2>

<div class="compatible">
	<ul>
		<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['key'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('tags')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
 $_smarty_tpl->tpl_vars['key']->value = $_smarty_tpl->tpl_vars['item']->key;
?>
			<li>
				<h3><?php echo $_smarty_tpl->tpl_vars['key']->value;?>
</h3>
				<ul class="bullet left">
					<?php  $_smarty_tpl->tpl_vars['subitem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['item']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['subitem']->key => $_smarty_tpl->tpl_vars['subitem']->value){
?>
						<li<?php if ($_smarty_tpl->tpl_vars['subitem']->value['name_clean']==$_smarty_tpl->getVariable('last_tag')->value&&$_smarty_tpl->getVariable('last_tag')->value!=''){?> class="last_tag"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('search.php');?>
?tag=<?php echo urlencode($_smarty_tpl->tpl_vars['subitem']->value['name_clean']);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['subitem']->value['name_clean'],'htmlall','UTF-8');?>
</a></li>
					<?php }} ?>

					<div class="clear"></div>
				</ul>
			</li>
		<?php }} ?>

		<div class="clear"></div>
		
		<div id=""><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getCategoryLink($_smarty_tpl->getVariable('id_category_cartouches')->value);?>
"><?php echo smartyTranslate(array('s'=>'Votre modele n\'est pas present ?'),$_smarty_tpl);?>
</a></div>
	</ul>
</div>