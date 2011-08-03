<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:05
         compiled from /homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl', 3, false),array('function', 'convertPrice', '/homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl', 19, false),array('modifier', 'count', '/homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl', 8, false),array('modifier', 'ceil', '/homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl', 9, false),array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl', 14, false),array('modifier', 'truncate', '/homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl', 29, false),array('modifier', 'intval', '/homepages/13/d194332323/htdocs/beta/modules/homepromo/homepromo.tpl', 31, false),)), $this); ?>
<!-- MODULE Home Promo Products -->
<div id="promo-products_block_center" class="block products_block">
	<h4><span class="left"></span><span class="middle"><?php echo smartyTranslate(array('s' => 'Promotions','mod' => 'homepromo'), $this);?>
</span><span class="right"></span></h4>
	<?php if (isset ( $this->_tpl_vars['products'] ) && $this->_tpl_vars['products']): ?>
		<div class="block_content">
			<?php $this->assign('liHeight', 203); ?>
			<?php $this->assign('nbItemsPerLine', 6); ?>
			<?php $this->assign('nbLi', count($this->_tpl_vars['products'])); ?>
			<?php $this->assign('nbLines', ((is_array($_tmp=$this->_tpl_vars['nbLi']/$this->_tpl_vars['nbItemsPerLine'])) ? $this->_run_mod_handler('ceil', true, $_tmp) : ceil($_tmp))); ?>
			<?php $this->assign('ulHeight', $this->_tpl_vars['nbLines']*$this->_tpl_vars['liHeight']); ?>
			<ul>
			<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['homePromoProducts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['homePromoProducts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['homePromoProducts']['iteration']++;
?>
				<li class="ajax_block_product <?php if (($this->_foreach['homePromoProducts']['iteration'] <= 1)): ?>first_item<?php elseif (($this->_foreach['homePromoProducts']['iteration'] == $this->_foreach['homePromoProducts']['total'])): ?>last_item<?php else: ?>item<?php endif; ?> <?php if ($this->_foreach['homePromoProducts']['iteration']%$this->_tpl_vars['nbItemsPerLine'] == 0): ?>last_item_of_line<?php elseif ($this->_foreach['homePromoProducts']['iteration']%$this->_tpl_vars['nbItemsPerLine'] == 1): ?>clear<?php endif; ?> <?php if ($this->_foreach['homePromoProducts']['iteration'] > ( $this->_foreach['homePromoProducts']['total'] - ( $this->_foreach['homePromoProducts']['total'] % $this->_tpl_vars['nbItemsPerLine'] ) )): ?>last_line<?php endif; ?>">
					<a href="<?php echo $this->_tpl_vars['product']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" class="product_image"><img src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']['link_rewrite'],$this->_tpl_vars['product']['id_image'],'home'); ?>
" height="<?php echo $this->_tpl_vars['homeSize']['height']; ?>
" width="<?php echo $this->_tpl_vars['homeSize']['width']; ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" /></a>

					<div class="action">
						<p class="price">
							<span class="left"></span>
							<span class="middle"><?php if (! $this->_tpl_vars['priceDisplay']): ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']['price']), $this);?>
<?php else: ?><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']['price_tax_exc']), $this);?>
<?php endif; ?></span>
							<span class="right">
								<?php if (( $this->_tpl_vars['product']['quantity'] > 0 || $this->_tpl_vars['product']['allow_oosp'] ) && $this->_tpl_vars['product']['customizable'] != 2): ?>
									<a class="exclusive ajax_add_to_cart_button" rel="ajax_id_product_<?php echo $this->_tpl_vars['product']['id_product']; ?>
" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cart.php?qty=1&amp;id_product=<?php echo $this->_tpl_vars['product']['id_product']; ?>
&amp;token=<?php echo $this->_tpl_vars['static_token']; ?>
&amp;add" title="<?php echo smartyTranslate(array('s' => 'Add to cart','mod' => 'homebest'), $this);?>
"></a>
								<?php endif; ?>
							</span>
							<span class="clear"></span>
						</p>
					</div>

					<div class="title"><a href="<?php echo $this->_tpl_vars['product']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" class="product_image"><?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 60, '...') : smarty_modifier_truncate($_tmp, 60, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
</a></div>

					<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_product'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cart.php?add&amp;id_product=<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_product'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
&amp;token=<?php echo $this->_tpl_vars['static_token']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Ajouter au panier'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Add to cart'), $this);?>
</a>
				</li>
			<?php endforeach; endif; unset($_from); ?>
				<div class="clear"></div>
			</ul>
		</div>
	<?php else: ?>
		<p><?php echo smartyTranslate(array('s' => 'No promo products','mod' => 'homepromo'), $this);?>
</p>
	<?php endif; ?>
</div>
<!-- /MODULE Home Promo Products -->