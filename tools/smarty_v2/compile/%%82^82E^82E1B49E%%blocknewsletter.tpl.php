<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/modules/blocknewsletter/blocknewsletter.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homepages/13/d194332323/htdocs/beta/modules/blocknewsletter/blocknewsletter.tpl', 30, false),)), $this); ?>

<!-- Block Newsletter module-->

<div id="newsletter_block_left" class="block">
	<h4><?php echo smartyTranslate(array('s' => 'Newsletter','mod' => 'blocknewsletter'), $this);?>
</h4>
	<div class="block_content">
	<?php if (isset ( $this->_tpl_vars['msg'] ) && $this->_tpl_vars['msg']): ?>
		<p class="<?php if ($this->_tpl_vars['nw_error']): ?>warning_inline<?php else: ?>success_inline<?php endif; ?>"><?php echo $this->_tpl_vars['msg']; ?>
</p>
	<?php endif; ?>
		<form action="<?php echo $this->_tpl_vars['link']->getPageLink('index.php'); ?>
" method="post">
			<p><input type="text" name="email" size="18" value="<?php if (isset ( $this->_tpl_vars['value'] ) && $this->_tpl_vars['value']): ?><?php echo $this->_tpl_vars['value']; ?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'your e-mail','mod' => 'blocknewsletter'), $this);?>
<?php endif; ?>" onfocus="javascript:if(this.value=='<?php echo smartyTranslate(array('s' => 'your e-mail','mod' => 'blocknewsletter'), $this);?>
')this.value='';" onblur="javascript:if(this.value=='')this.value='<?php echo smartyTranslate(array('s' => 'your e-mail','mod' => 'blocknewsletter'), $this);?>
';" /></p>
			<p>
				<select name="action">
					<option value="0"<?php if (isset ( $this->_tpl_vars['action'] ) && $this->_tpl_vars['action'] == 0): ?> selected="selected"<?php endif; ?>><?php echo smartyTranslate(array('s' => 'Subscribe','mod' => 'blocknewsletter'), $this);?>
</option>
					<option value="1"<?php if (isset ( $this->_tpl_vars['action'] ) && $this->_tpl_vars['action'] == 1): ?> selected="selected"<?php endif; ?>><?php echo smartyTranslate(array('s' => 'Unsubscribe','mod' => 'blocknewsletter'), $this);?>
</option>
				</select>
				<input type="submit" value="ok" class="button_mini" name="submitNewsletter" />
			</p>
		</form>
	</div>
</div>

<!-- /Block Newsletter module-->