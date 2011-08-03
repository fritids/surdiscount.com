<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart.tpl', 10, false),array('function', 'convertPrice', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart.tpl', 33, false),array('modifier', 'count', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart.tpl', 43, false),array('modifier', 'cat', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart.tpl', 47, false),array('modifier', 'truncate', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart.tpl', 47, false),array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart.tpl', 47, false),)), $this); ?>

<?php if ($this->_tpl_vars['ajax_allowed']): ?>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
js/jquery/ifxtransfer.js"></script>
	<script type="text/javascript">
	var CUSTOMIZE_TEXTFIELD = <?php echo $this->_tpl_vars['CUSTOMIZE_TEXTFIELD']; ?>
;
	var customizationIdMessage = '<?php echo smartyTranslate(array('s' => 'Customization #','mod' => 'blockcart','js' => 1), $this);?>
';
	var removingLinkText = '<?php echo smartyTranslate(array('s' => 'remove this product from my cart','mod' => 'blockcart','js' => 1), $this);?>
';
	</script>
	<?php if (! $this->_tpl_vars['order_page']): ?>
		<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
modules/blockcart/ajax-cart.js"></script>
	<?php endif; ?>
<?php endif; ?>

<!-- MODULE Block cart -->
<div id="cart_block" class="block exclusive">
	<h4>
		<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php"><?php echo smartyTranslate(array('s' => 'Cart','mod' => 'blockcart'), $this);?>
</a>
		<?php if ($this->_tpl_vars['ajax_allowed']): ?>
		<span id="block_cart_expand" <?php if ($this->_tpl_vars['colapseExpandStatus'] == 'expanded'): ?>class="hidden"<?php endif; ?>>&nbsp;</span>
		<span id="block_cart_collapse" <?php if ($this->_tpl_vars['colapseExpandStatus'] == 'collapsed' || ! isset ( $this->_tpl_vars['colapseExpandStatus'] )): ?>class="hidden"<?php endif; ?>>&nbsp;</span>
		<?php endif; ?>
	</h4>
	<div class="block_content">
	<!-- block summary -->
	<div id="cart_block_summary" class="<?php if ($this->_tpl_vars['colapseExpandStatus'] == 'expanded' || ! $this->_tpl_vars['ajax_allowed']): ?>collapsed<?php else: ?>expanded<?php endif; ?>">
		<?php if ($this->_tpl_vars['cart_qties'] > 0): ?><span class="ajax_cart_quantity"><?php echo $this->_tpl_vars['cart_qties']; ?>
</span><?php endif; ?>
		<span class="ajax_cart_product_txt_s<?php if ($this->_tpl_vars['cart_qties'] < 2): ?> hidden<?php endif; ?>"><?php echo smartyTranslate(array('s' => 'products','mod' => 'blockcart'), $this);?>
</span>
		<span class="ajax_cart_product_txt<?php if ($this->_tpl_vars['cart_qties'] != 1): ?> hidden<?php endif; ?>"><?php echo smartyTranslate(array('s' => 'product','mod' => 'blockcart'), $this);?>
</span>
		<?php if ($this->_tpl_vars['cart_qties'] > 0): ?><span class="ajax_cart_total"><?php if ($this->_tpl_vars['priceDisplay'] == 1): ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['cart']->getOrderTotal(false)), $this);?>
<?php else: ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['cart']->getOrderTotal(true)), $this);?>
<?php endif; ?></span><?php endif; ?>
		<?php if ($this->_tpl_vars['cart_qties'] == 0): ?><span class="ajax_cart_no_product"><?php if ($this->_tpl_vars['cart_qties'] == 0): ?><?php echo smartyTranslate(array('s' => '(empty)','mod' => 'blockcart'), $this);?>
<?php endif; ?></span><?php endif; ?>
	</div>
	<!-- block list of products -->
	<div id="cart_block_list" class="<?php if ($this->_tpl_vars['colapseExpandStatus'] == 'expanded' || ! $this->_tpl_vars['ajax_allowed']): ?>expanded<?php else: ?>collapsed<?php endif; ?>">
	<?php if ($this->_tpl_vars['products']): ?>
		<span class="top"><?php echo $this->_tpl_vars['nb_total_products']; ?>
x Article<?php if ($this->_tpl_vars['nb_total_products'] > 1): ?>s<?php endif; ?></span>
	<?php endif; ?>
		<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
order.php"><p <?php if ($this->_tpl_vars['products']): ?>class="hidden"<?php endif; ?> id="cart_block_no_products"><?php echo smartyTranslate(array('s' => 'No products','mod' => 'blockcart'), $this);?>
</p></a>
		
		<?php if (count($this->_tpl_vars['discounts']) > 0): ?><table id="vouchers">
			<tbody>
			<?php $_from = $this->_tpl_vars['discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['discount']):
?>
				<tr id="bloc_cart_voucher_<?php echo $this->_tpl_vars['discount']['id_discount']; ?>
">
					<td class="name" title="<?php echo $this->_tpl_vars['discount']['description']; ?>
"><?php echo ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['discount']['name'])) ? $this->_run_mod_handler('cat', true, $_tmp, ' : ') : smarty_modifier_cat($_tmp, ' : ')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['discount']['description']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['discount']['description'])))) ? $this->_run_mod_handler('truncate', true, $_tmp, 18, '...') : smarty_modifier_truncate($_tmp, 18, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</td>
					<td class="price">-<?php if ($this->_tpl_vars['discount']['value_real'] != '!'): ?><?php if ($this->_tpl_vars['priceDisplay'] == 1): ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['discount']['value_tax_exc']), $this);?>
<?php else: ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['discount']['value_real']), $this);?>
<?php endif; ?><?php endif; ?></td>
					<td class="delete"><a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php?deleteDiscount=<?php echo $this->_tpl_vars['discount']['id_discount']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Delete'), $this);?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s' => 'Delete'), $this);?>
" width="11" height="13" class="icon" /></a></td>
				</tr>
			<?php endforeach; endif; unset($_from); ?>
			</tbody>
		</table>
		<?php endif; ?>
		
		<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
order.php">
		<p id="cart-prices">
			<span><?php echo smartyTranslate(array('s' => 'Shipping','mod' => 'blockcart'), $this);?>
</span>
			<span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost"><?php echo $this->_tpl_vars['shipping_cost']; ?>
</span>
			<br/>
			<?php if ($this->_tpl_vars['show_wrapping']): ?>
				<span><?php echo smartyTranslate(array('s' => 'Wrapping','mod' => 'blockcart'), $this);?>
</span>
				<span id="cart_block_wrapping_cost" class="price cart_block_wrapping_cost"><?php if ($this->_tpl_vars['priceDisplay'] == 1): ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['cart']->getOrderTotal(false,6)), $this);?>
<?php else: ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['cart']->getOrderTotal(true,6)), $this);?>
<?php endif; ?></span>
				<br/>
			<?php endif; ?>
			<span><?php echo smartyTranslate(array('s' => 'Total','mod' => 'blockcart'), $this);?>
</span>
			<span id="cart_block_total" class="price ajax_block_cart_total"><?php echo $this->_tpl_vars['total']; ?>
</span>
		</p>
		</a>
		<a href="<?php echo $this->_tpl_vars['base_dir']; ?>
order.php">
		<?php if ($this->_tpl_vars['priceDisplay'] == 2): ?>
			<p id="cart-price-precisions">
				<?php echo smartyTranslate(array('s' => 'Prices are tax included','mod' => 'blockcart'), $this);?>

			</p>
		<?php endif; ?>
		<?php if ($this->_tpl_vars['priceDisplay'] == 1): ?>
			<p id="cart-price-precisions">
				<?php echo smartyTranslate(array('s' => 'Prices are tax excluded','mod' => 'blockcart'), $this);?>

			</p>
		<?php endif; ?>
		</a>
		<p id="cart-buttons">
			<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php" class="button_small" title="<?php echo smartyTranslate(array('s' => 'Cart','mod' => 'blockcart'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Cart','mod' => 'blockcart'), $this);?>
</a>
			<a href="<?php echo $this->_tpl_vars['base_dir_ssl']; ?>
order.php?step=1" id="button_order_cart" class="exclusive" title="<?php echo smartyTranslate(array('s' => 'Check out','mod' => 'blockcart'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Check out','mod' => 'blockcart'), $this);?>
</a>
		</p>
	</div>
	</div>
</div>
<!-- /MODULE Block cart -->