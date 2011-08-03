<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 18:03:00
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/./product-sort.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5291800784e3971343b9785-29555120%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6651e9cd128319e3d3d136f57bd84b7c568241a' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/./product-sort.tpl',
      1 => 1303302990,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5291800784e3971343b9785-29555120',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?><?php if (isset($_smarty_tpl->getVariable('orderby',null,true,false)->value)&&isset($_smarty_tpl->getVariable('orderway',null,true,false)->value)){?>
	<!-- Sort products -->
	<?php if (intval($_GET['id_category'])){?>
		<?php $_smarty_tpl->tpl_vars['request'] = new Smarty_variable($_smarty_tpl->getVariable('link')->value->getPaginationLink('category',$_smarty_tpl->getVariable('category')->value,false,true), null, null);?>
	<?php }elseif(intval($_GET['id_manufacturer'])){?>
		<?php $_smarty_tpl->tpl_vars['request'] = new Smarty_variable($_smarty_tpl->getVariable('link')->value->getPaginationLink('manufacturer',$_smarty_tpl->getVariable('manufacturer')->value,false,true), null, null);?>
	<?php }elseif(intval($_GET['id_supplier'])){?>
		<?php $_smarty_tpl->tpl_vars['request'] = new Smarty_variable($_smarty_tpl->getVariable('link')->value->getPaginationLink('supplier',$_smarty_tpl->getVariable('supplier')->value,false,true), null, null);?>
	<?php }else{ ?>
		<?php $_smarty_tpl->tpl_vars['request'] = new Smarty_variable($_smarty_tpl->getVariable('link')->value->getPaginationLink(false,false,false,true), null, null);?>
	<?php }?>

	<form id="productsSortForm" action="<?php echo $_smarty_tpl->getVariable('request')->value;?>
">
		<?php if ($_smarty_tpl->getVariable('manufacturers')->value){?>
			<p class="select">
				<select id="selectManuFilter" name="filter_manufacturer">
					<option value="0" selected="selected"><?php echo smartyTranslate(array('s'=>'--'),$_smarty_tpl);?>
</option>
	
					<?php  $_smarty_tpl->tpl_vars['manufacturer'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manufacturers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['manufacturer']->key => $_smarty_tpl->tpl_vars['manufacturer']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['id'];?>
" <?php if ($_smarty_tpl->getVariable('filter_manufacturer')->value==$_smarty_tpl->tpl_vars['manufacturer']->value['id']){?>selected="selected"<?php }?>><?php echo $_smarty_tpl->tpl_vars['manufacturer']->value['name'];?>
</option>
					<?php }} ?>
				</select>
				<label for="selectManuFilter"><?php echo smartyTranslate(array('s'=>'Manufacturer'),$_smarty_tpl);?>
</label>
			</p>
		<?php }?>

		<p class="select">
			<select id="selectPrductSort" onchange="document.location.href = $(this).val();">
				<option value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->addSortDetails($_smarty_tpl->getVariable('request')->value,$_smarty_tpl->getVariable('orderbydefault')->value,$_smarty_tpl->getVariable('orderwaydefault')->value),'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('orderby')->value==$_smarty_tpl->getVariable('orderbydefault')->value){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'--'),$_smarty_tpl);?>
</option>

				<?php if (!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
					<option value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->addSortDetails($_smarty_tpl->getVariable('request')->value,'price','asc'),'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('orderby')->value=='price'&&$_smarty_tpl->getVariable('orderway')->value=='asc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Price: lowest first'),$_smarty_tpl);?>
</option>
					<option value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->addSortDetails($_smarty_tpl->getVariable('request')->value,'price','desc'),'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('orderby')->value=='price'&&$_smarty_tpl->getVariable('orderway')->value=='desc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Price: highest first'),$_smarty_tpl);?>
</option>
				<?php }?>

				<option value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->addSortDetails($_smarty_tpl->getVariable('request')->value,'name','asc'),'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('orderby')->value=='name'&&$_smarty_tpl->getVariable('orderway')->value=='asc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Product Name: A to Z'),$_smarty_tpl);?>
</option>
				<option value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->addSortDetails($_smarty_tpl->getVariable('request')->value,'name','desc'),'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('orderby')->value=='name'&&$_smarty_tpl->getVariable('orderway')->value=='desc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'Product Name: Z to A'),$_smarty_tpl);?>
</option>

				<?php if (!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
					<option value="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('link')->value->addSortDetails($_smarty_tpl->getVariable('request')->value,'quantity','desc'),'htmlall','UTF-8');?>
" <?php if ($_smarty_tpl->getVariable('orderby')->value=='quantity'&&$_smarty_tpl->getVariable('orderway')->value=='desc'){?>selected="selected"<?php }?>><?php echo smartyTranslate(array('s'=>'In-stock first'),$_smarty_tpl);?>
</option>
				<?php }?>
			</select>
			<label for="selectPrductSort"><?php echo smartyTranslate(array('s'=>'Sort by'),$_smarty_tpl);?>
</label>
		</p>

		<div class="clear"></div>
	</form>

	
	<script type="text/javascript">
		$('form#productsSortForm p select').live('change', function(){
			var filter_manufacturer = $('#selectManuFilter').val();
			var filter_sort = $('#selectPrductSort').val().split(':');
			
			var request = '<?php echo $_smarty_tpl->getVariable('request')->value;?>
';
			request = request.split('?');
			
			var url = request[0]+'?orderby='+filter_sort[0]+'&orderway='+filter_sort[1]+'&filter_manufacturer='+filter_manufacturer;
			
			document.location.href = url;
		});
	</script>
	
	<!-- /Sort products -->
<?php }?>
