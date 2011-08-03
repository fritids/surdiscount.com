<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl', 8, false),array('function', 'math', '/homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl', 17, false),array('modifier', 'count', '/homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl', 17, false),array('modifier', 'htmlspecialchars', '/homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl', 20, false),array('modifier', 'truncate', '/homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl', 24, false),array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl', 24, false),array('modifier', 'intval', '/homepages/13/d194332323/htdocs/beta/modules/crossselling/crossselling.tpl', 27, false),)), $this); ?>
<?php $this->assign('nbView', '3'); ?>

<?php if (count ( $this->_tpl_vars['orderProducts'] ) > 0): ?>
	<script type="text/javascript">var middle = <?php echo $this->_tpl_vars['middlePosition_crossselling']; ?>
;</script>
	<script type="text/javascript" src="<?php echo $this->_tpl_vars['content_dir']; ?>
modules/crossselling/js/crossselling.js"></script>
	
	<?php if ($this->_tpl_vars['samecat'] == 'on'): ?>
		<h2><?php echo smartyTranslate(array('s' => 'Product of the category:','mod' => 'crossselling'), $this);?>
</h2>
	<?php else: ?>
		<h2><?php echo smartyTranslate(array('s' => 'Customers who bought this product also bought:','mod' => 'crossselling'), $this);?>
</h2>
	<?php endif; ?>

	<div id="<?php if (count ( $this->_tpl_vars['orderProducts'] ) > $this->_tpl_vars['nbView']): ?>crossselling<?php else: ?>crossselling_noscroll<?php endif; ?>">
		<?php if (count ( $this->_tpl_vars['orderProducts'] ) > $this->_tpl_vars['nbView']): ?><a id="crossselling_scroll_left" class="active" title="<?php echo smartyTranslate(array('s' => 'Previous','mod' => 'crossselling'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Previous','mod' => 'crossselling'), $this);?>
</a><?php endif; ?>
		
		<div id="crossselling_list"<?php if (count ( $this->_tpl_vars['orderProducts'] ) <= $this->_tpl_vars['nbView']): ?> style="width: inherit;"<?php endif; ?>>
			<ul <?php if (count ( $this->_tpl_vars['orderProducts'] ) > $this->_tpl_vars['nbView']): ?>style="width: <?php echo smarty_function_math(array('equation' => "((width / nbView) * nbImages)+1000",'width' => 710,'nbView' => $this->_tpl_vars['nbView'],'nbImages' => count($this->_tpl_vars['orderProducts'])), $this);?>
px"<?php endif; ?>>
				<?php $_from = $this->_tpl_vars['orderProducts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['orderProduct'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['orderProduct']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['orderProduct']):
        $this->_foreach['orderProduct']['iteration']++;
?>
					<li <?php if (count ( $this->_tpl_vars['orderProducts'] ) <= $this->_tpl_vars['nbView']): ?>style="width: <?php echo smarty_function_math(array('equation' => "( width - ( margin * 2 * nbImages ) ) / nbImages",'width' => 790,'margin' => 11,'nbImages' => count($this->_tpl_vars['orderProducts'])), $this);?>
px"<?php endif; ?>>
						<a href="<?php echo $this->_tpl_vars['orderProduct']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
							<img src="<?php echo $this->_tpl_vars['orderProduct']['image']; ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" />
						</a><br/>
						<a href="<?php echo $this->_tpl_vars['orderProduct']['link']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
							<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['orderProduct']['name'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 30, '...') : smarty_modifier_truncate($_tmp, 30, '...')))) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>

						</a>
						
						<a class="button ajax_add_to_cart_button exclusive" rel="ajax_id_product_<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['product_id'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" href="<?php echo $this->_tpl_vars['base_dir']; ?>
cart.php?add&amp;id_product=<?php echo ((is_array($_tmp=$this->_tpl_vars['orderProduct']['product_id'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
&amp;token=<?php echo $this->_tpl_vars['static_token']; ?>
" title="<?php echo smartyTranslate(array('s' => 'Ajouter au panier'), $this);?>
"><?php echo smartyTranslate(array('s' => 'Add to cart'), $this);?>
</a>
					</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	
		<?php if (count ( $this->_tpl_vars['orderProducts'] ) > $this->_tpl_vars['nbView']): ?><a id="crossselling_scroll_right" class="active" title="<?php echo smartyTranslate(array('s' => 'Next','mod' => 'crossselling'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Next','mod' => 'crossselling'), $this);?>
</a><?php endif; ?>
	</div>
	<div class="clear"></div>
<?php endif; ?>