<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:29
         compiled from "/homepages/13/d194332323/htdocs/www/modules/blockcart/blockcart.tpl" */ ?>
<?php /*%%SmartyHeaderCode:5265617024e396fade22384-18230962%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f54f7fbbc2143d1af3dc01eb82dcd269ff1543cf' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/blockcart/blockcart.tpl',
      1 => 1300888851,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '5265617024e396fade22384-18230962',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?>

<?php if ($_smarty_tpl->getVariable('ajax_allowed')->value){?>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
js/jquery/ifxtransfer.js"></script>
	<script type="text/javascript">
	var CUSTOMIZE_TEXTFIELD = <?php echo $_smarty_tpl->getVariable('CUSTOMIZE_TEXTFIELD')->value;?>
;
	var customizationIdMessage = '<?php echo smartyTranslate(array('s'=>'Customization #','mod'=>'blockcart','js'=>1),$_smarty_tpl);?>
';
	var removingLinkText = '<?php echo smartyTranslate(array('s'=>'remove this product from my cart','mod'=>'blockcart','js'=>1),$_smarty_tpl);?>
';
	</script>
	<?php if (!$_smarty_tpl->getVariable('order_page')->value){?>
		<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
modules/blockcart/ajax-cart.js"></script>
	<?php }?>
<?php }?>

<!-- MODULE Block cart -->
<div id="cart_block" class="block exclusive">
	<h4>
		<a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
order.php"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl);?>
</a>
		<?php if ($_smarty_tpl->getVariable('ajax_allowed')->value){?>
		<span id="block_cart_expand" <?php if ($_smarty_tpl->getVariable('colapseExpandStatus')->value=='expanded'){?>class="hidden"<?php }?>>&nbsp;</span>
		<span id="block_cart_collapse" <?php if ($_smarty_tpl->getVariable('colapseExpandStatus')->value=='collapsed'||!isset($_smarty_tpl->getVariable('colapseExpandStatus',null,true,false)->value)){?>class="hidden"<?php }?>>&nbsp;</span>
		<?php }?>
	</h4>
	<div class="block_content">
	<!-- block summary -->
	<div id="cart_block_summary" class="<?php if ($_smarty_tpl->getVariable('colapseExpandStatus')->value=='expanded'||!$_smarty_tpl->getVariable('ajax_allowed')->value){?>collapsed<?php }else{ ?>expanded<?php }?>">
		<?php if ($_smarty_tpl->getVariable('cart_qties')->value>0){?><span class="ajax_cart_quantity"><?php echo $_smarty_tpl->getVariable('cart_qties')->value;?>
</span><?php }?>
		<span class="ajax_cart_product_txt_s<?php if ($_smarty_tpl->getVariable('cart_qties')->value<2){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'products','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
		<span class="ajax_cart_product_txt<?php if ($_smarty_tpl->getVariable('cart_qties')->value!=1){?> hidden<?php }?>"><?php echo smartyTranslate(array('s'=>'product','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
		<?php if ($_smarty_tpl->getVariable('cart_qties')->value>0){?><span class="ajax_cart_total"><?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(false)),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(true)),$_smarty_tpl);?>
<?php }?></span><?php }?>
		<?php if ($_smarty_tpl->getVariable('cart_qties')->value==0){?><span class="ajax_cart_no_product"><?php if ($_smarty_tpl->getVariable('cart_qties')->value==0){?><?php echo smartyTranslate(array('s'=>'(empty)','mod'=>'blockcart'),$_smarty_tpl);?>
<?php }?></span><?php }?>
	</div>
	<!-- block list of products -->
	<div id="cart_block_list" class="<?php if ($_smarty_tpl->getVariable('colapseExpandStatus')->value=='expanded'||!$_smarty_tpl->getVariable('ajax_allowed')->value){?>expanded<?php }else{ ?>collapsed<?php }?>">
	<?php if ($_smarty_tpl->getVariable('products')->value){?>
		<span class="top"><?php echo $_smarty_tpl->getVariable('nb_total_products')->value;?>
x Article<?php if ($_smarty_tpl->getVariable('nb_total_products')->value>1){?>s<?php }?></span>
	<?php }?>
		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
order.php"><p <?php if ($_smarty_tpl->getVariable('products')->value){?>class="hidden"<?php }?> id="cart_block_no_products"><?php echo smartyTranslate(array('s'=>'No products','mod'=>'blockcart'),$_smarty_tpl);?>
</p></a>
		
		<?php if (count($_smarty_tpl->getVariable('discounts')->value)>0){?><table id="vouchers">
			<tbody>
			<?php  $_smarty_tpl->tpl_vars['discount'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('discounts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['discount']->key => $_smarty_tpl->tpl_vars['discount']->value){
?>
				<tr id="bloc_cart_voucher_<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
">
					<td class="name" title="<?php echo $_smarty_tpl->tpl_vars['discount']->value['description'];?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate((($_smarty_tpl->tpl_vars['discount']->value['name']).(' : ')).($_smarty_tpl->tpl_vars['discount']->value['description']),18,'...'),'htmlall','UTF-8');?>
</td>
					<td class="price">-<?php if ($_smarty_tpl->tpl_vars['discount']->value['value_real']!='!'){?><?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_tax_exc']),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['discount']->value['value_real']),$_smarty_tpl);?>
<?php }?><?php }?></td>
					<td class="delete"><a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
order.php?deleteDiscount=<?php echo $_smarty_tpl->tpl_vars['discount']->value['id_discount'];?>
" title="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" width="11" height="13" class="icon" /></a></td>
				</tr>
			<?php }} ?>
			</tbody>
		</table>
		<?php }?>
		
		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
order.php">
		<p id="cart-prices">
			<span><?php echo smartyTranslate(array('s'=>'Shipping','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
			<span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost"><?php echo $_smarty_tpl->getVariable('shipping_cost')->value;?>
</span>
			<br/>
			<?php if ($_smarty_tpl->getVariable('show_wrapping')->value){?>
				<span><?php echo smartyTranslate(array('s'=>'Wrapping','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
				<span id="cart_block_wrapping_cost" class="price cart_block_wrapping_cost"><?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(false,6)),$_smarty_tpl);?>
<?php }else{ ?><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('cart')->value->getOrderTotal(true,6)),$_smarty_tpl);?>
<?php }?></span>
				<br/>
			<?php }?>
			<span><?php echo smartyTranslate(array('s'=>'Total','mod'=>'blockcart'),$_smarty_tpl);?>
</span>
			<span id="cart_block_total" class="price ajax_block_cart_total"><?php echo $_smarty_tpl->getVariable('total')->value;?>
</span>
		</p>
		</a>
		<a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
order.php">
		<?php if ($_smarty_tpl->getVariable('priceDisplay')->value==2){?>
			<p id="cart-price-precisions">
				<?php echo smartyTranslate(array('s'=>'Prices are tax included','mod'=>'blockcart'),$_smarty_tpl);?>

			</p>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?>
			<p id="cart-price-precisions">
				<?php echo smartyTranslate(array('s'=>'Prices are tax excluded','mod'=>'blockcart'),$_smarty_tpl);?>

			</p>
		<?php }?>
		</a>
		<p id="cart-buttons">
			<a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
order.php" class="button_small" title="<?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Cart','mod'=>'blockcart'),$_smarty_tpl);?>
</a>
			<a href="<?php echo $_smarty_tpl->getVariable('base_dir_ssl')->value;?>
order.php?step=1" id="button_order_cart" class="exclusive" title="<?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
"><?php echo smartyTranslate(array('s'=>'Check out','mod'=>'blockcart'),$_smarty_tpl);?>
</a>
		</p>
	</div>
	</div>
</div>
<!-- /MODULE Block cart -->
