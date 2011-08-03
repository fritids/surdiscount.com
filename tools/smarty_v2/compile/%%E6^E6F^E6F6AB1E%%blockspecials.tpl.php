<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/modules/blockspecials/blockspecials.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homepages/13/d194332323/htdocs/beta/modules/blockspecials/blockspecials.tpl', 29, false),array('function', 'displayWtPrice', '/homepages/13/d194332323/htdocs/beta/modules/blockspecials/blockspecials.tpl', 40, false),array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/modules/blockspecials/blockspecials.tpl', 35, false),array('modifier', 'date_format', '/homepages/13/d194332323/htdocs/beta/modules/blockspecials/blockspecials.tpl', 43, false),)), $this); ?>

<!-- MODULE Block specials -->
<div id="special_block_right" class="block products_block exclusive blockspecials">
	<h4><a href="<?php echo $this->_tpl_vars['link']->getPageLink('prices-drop.php'); ?>
" title="<?php echo smartyTranslate(array('s' => 'Specials','mod' => 'blockspecials'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Specials','mod' => 'blockspecials'), $this);?>
</a></h4>
	<div class="block_content">

<?php if ($this->_tpl_vars['special']): ?>
		<ul class="products">
			<li class="product_image">
				<a href="<?php echo $this->_tpl_vars['special']['link']; ?>
"><img src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['special']['link_rewrite'],$this->_tpl_vars['special']['id_image'],'medium'); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['special']['legend'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" height="<?php echo $this->_tpl_vars['mediumSize']['height']; ?>
" width="<?php echo $this->_tpl_vars['mediumSize']['width']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['special']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" /></a>
			</li>
			<li>

				<h5><a href="<?php echo $this->_tpl_vars['special']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['special']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['special']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
</a></h5>
				<span class="price-discount"><?php if (! $this->_tpl_vars['priceDisplay']): ?><?php echo Product::displayWtPrice(array('p' => $this->_tpl_vars['special']['price_without_reduction']), $this);?>
<?php else: ?><?php echo Product::displayWtPrice(array('p' => $this->_tpl_vars['priceWithoutReduction_tax_excl']), $this);?>
<?php endif; ?></span>
    			<?php if ($this->_tpl_vars['special']['specific_prices']): ?>
        			<?php $this->assign('specific_prices', $this->_tpl_vars['special']['specific_prices']); ?>
        			<?php if ($this->_tpl_vars['specific_prices']['reduction_type'] == 'percentage' && ( $this->_tpl_vars['specific_prices']['from'] == $this->_tpl_vars['specific_prices']['to'] || ( ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) <= $this->_tpl_vars['specific_prices']['to'] && ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) >= $this->_tpl_vars['specific_prices']['from'] ) )): ?>
	        			<span class="reduction">(-<?php echo $this->_tpl_vars['specific_prices']['reduction']; ?>
%)</span>
	            	<?php endif; ?>
	            <?php endif; ?>
				<span class="price"><?php if (! $this->_tpl_vars['priceDisplay']): ?><?php echo Product::displayWtPrice(array('p' => $this->_tpl_vars['special']['price']), $this);?>
<?php else: ?><?php echo Product::displayWtPrice(array('p' => $this->_tpl_vars['special']['price_tax_exc']), $this);?>
<?php endif; ?></span>
			</li>
		</ul>
		<p>
			<a href="<?php echo $this->_tpl_vars['link']->getPageLink('prices-drop.php'); ?>
" title="<?php echo smartyTranslate(array('s' => 'All specials','mod' => 'blockspecials'), $this);?>
" class="button_large"><?php echo smartyTranslate(array('s' => 'All specials','mod' => 'blockspecials'), $this);?>
</a>
		</p>
<?php else: ?>
		<p><?php echo smartyTranslate(array('s' => 'No specials at this time','mod' => 'blockspecials'), $this);?>
</p>
<?php endif; ?>
	</div>
</div>
<!-- /MODULE Block specials -->