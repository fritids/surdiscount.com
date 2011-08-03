<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:28
         compiled from "/homepages/13/d194332323/htdocs/www/modules/blockcart/blockcart-json.tpl" */ ?>
<?php /*%%SmartyHeaderCode:19238443094e396fac958f31-99478370%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd02bfc367455a50295bab8d488d577cfa7514738' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/blockcart/blockcart-json.tpl',
      1 => 1300875809,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '19238443094e396fac958f31-99478370',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
{
	"discounts": [],
	"shippingCost": "<?php echo html_entity_decode($_smarty_tpl->getVariable('shipping_cost')->value,2,'UTF-8');?>
",
	"wrappingCost": "<?php echo html_entity_decode($_smarty_tpl->getVariable('wrapping_cost')->value,2,'UTF-8');?>
",
	"nbTotalProducts": "<?php echo $_smarty_tpl->getVariable('nb_total_products')->value;?>
",
	"total": "<?php echo html_entity_decode($_smarty_tpl->getVariable('total')->value,2,'UTF-8');?>
",
	"productTotal": "<?php echo html_entity_decode($_smarty_tpl->getVariable('product_total')->value,2,'UTF-8');?>
",

	<?php if (isset($_smarty_tpl->getVariable('errors',null,true,false)->value)&&$_smarty_tpl->getVariable('errors')->value){?>
		"hasError" : true,
		errors : {
			<?php  $_smarty_tpl->tpl_vars['error'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['k'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('errors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['error']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['error']->iteration=0;
if ($_smarty_tpl->tpl_vars['error']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['error']->key => $_smarty_tpl->tpl_vars['error']->value){
 $_smarty_tpl->tpl_vars['k']->value = $_smarty_tpl->tpl_vars['error']->key;
 $_smarty_tpl->tpl_vars['error']->iteration++;
 $_smarty_tpl->tpl_vars['error']->last = $_smarty_tpl->tpl_vars['error']->iteration === $_smarty_tpl->tpl_vars['error']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['errors']['last'] = $_smarty_tpl->tpl_vars['error']->last;
?>
				"<?php echo html_entity_decode(addslashes($_smarty_tpl->tpl_vars['error']->value),2,'UTF-8');?>
"
				<?php if (!$_smarty_tpl->getVariable('smarty')->value['foreach']['errors']['last']){?>,<?php }?>
			<?php }} ?>
		}
	<?php }else{ ?>
		"hasError" : false
	<?php }?>
}