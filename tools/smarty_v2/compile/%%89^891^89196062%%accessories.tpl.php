<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl', 7, false),array('function', 'math', '/homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl', 13, false),array('modifier', 'count', '/homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl', 13, false),array('modifier', 'htmlspecialchars', '/homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl', 16, false),array('modifier', 'truncate', '/homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl', 20, false),array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl', 20, false),array('modifier', 'intval', '/homepages/13/d194332323/htdocs/beta/modules/accessories/accessories.tpl', 23, false),)), $this); ?>
<?php $this->assign('nbView', '3'); ?>

<?php if (count ( $this->_tpl_vars['products'] ) > 0): ?>
	<script type="text/javascript">var middleAcc = <?php echo $this->_tpl_vars['middlePosition_accessorie']; ?>
;</script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
modules/accessorie/js/accessorie.js"></script>
	
	<h2><?php echo smartyTranslate(array('s' => 'Accessories of the current product','mod' => 'accessories'), $this);?>
</h2>

	<div id="accessorie<?php if (count ( $this->_tpl_vars['products'] ) > $this->_tpl_vars['nbView']): ?>_noscroll<?php endif; ?>">
		<?php if (count ( $this->_tpl_vars['products'] ) > $this->_tpl_vars['nbView']): ?><a id="accessorie_scroll_left" class="active" title="<?php echo smartyTranslate(array('s' => 'Previous','mod' => 'accessorie'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Previous','mod' => 'accessorie'), $this);?>
</a><?php endif; ?>
		
		<div id="accessorie_list"<?php if (count ( $this->_tpl_vars['products'] ) <= $this->_tpl_vars['nbView']): ?> style="width: inherit;"<?php endif; ?>>
			<ul <?php if (count ( $this->_tpl_vars['products'] ) > $this->_tpl_vars['nbView']): ?>style="width: <?php echo smarty_function_math(array('equation' => "((710 / nbView) * nbImages)+1000",'width' => 710,'nbView' => $this->_tpl_vars['nbView'],'nbImages' => count($this->_tpl_vars['products'])), $this);?>
px"<?php endif; ?>>
				<?php $_from = $this->_tpl_vars['products']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['product'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['product']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['product']):
        $this->_foreach['product']['iteration']++;
?>
					<li <?php if (count ( $this->_tpl_vars['products'] ) <= $this->_tpl_vars['nbView']): ?>style="width: <?php echo smarty_function_math(array('equation' => "( width - ( margin * 2 * nbImages ) ) / nbImages",'width' => 790,'margin' => 11,'nbImages' => count($this->_tpl_vars['products'])), $this);?>
px"<?php endif; ?>>
						<a href="<?php echo $this->_tpl_vars['product']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
							<img src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']['link_rewrite'],$this->_tpl_vars['product']['id_image'],'crosselling'); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" />
						</a><br/>
						<a href="<?php echo $this->_tpl_vars['product']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
							<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, '...') : smarty_modifier_truncate($_tmp, 30, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

						</a>
						
						<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_product'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cart.php?add&amp;id_product=<?php echo ((is_array($_tmp=$this->_tpl_vars['product']['id_product'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
&amp;token=<?php echo $this->_tpl_vars['static_token']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Ajouter au panier'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Add to cart'), $this);?>
</a>
					</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	
		<?php if (count ( $this->_tpl_vars['products'] ) > $this->_tpl_vars['nbView']): ?><a id="accessorie_scroll_right" class="active" title="<?php echo smartyTranslate(array('s' => 'Next','mod' => 'accessorie'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Next','mod' => 'accessorie'), $this);?>
</a><?php endif; ?>
	</div>
	<div class="clear"></div>
<?php endif; ?>