<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/modules/blockmanufacturer/blockmanufacturer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'l', '/homepages/13/d194332323/htdocs/beta/modules/blockmanufacturer/blockmanufacturer.tpl', 29, false),array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/modules/blockmanufacturer/blockmanufacturer.tpl', 36, false),)), $this); ?>

<!-- Block manufacturers module -->
<div id="manufacturers_block_left" class="block blockmanufacturer">
	<h4><?php if ($this->_tpl_vars['display_link_manufacturer']): ?><a href="<?php echo $this->_tpl_vars['link']->getPageLink('manufacturer.php'); ?>
" title="<?php echo smartyTranslate(array('s' => 'Manufacturers','mod' => 'blockmanufacturer'), $this);?>
"><?php endif; ?><?php echo smartyTranslate(array('s' => 'Manufacturers','mod' => 'blockmanufacturer'), $this);?>
<?php if ($this->_tpl_vars['display_link_manufacturer']): ?></a><?php endif; ?></h4>
	<div class="block_content">
<?php if ($this->_tpl_vars['manufacturers']): ?>
	<?php if ($this->_tpl_vars['text_list']): ?>
	<ul class="bullet">
	<?php $_from = $this->_tpl_vars['manufacturers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['manufacturer_list'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['manufacturer_list']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['manufacturer']):
        $this->_foreach['manufacturer_list']['iteration']++;
?>
		<?php if ($this->_foreach['manufacturer_list']['iteration'] <= $this->_tpl_vars['text_list_nb']): ?>
		<li class="<?php if (($this->_foreach['manufacturer_list']['iteration'] == $this->_foreach['manufacturer_list']['total'])): ?>last_item<?php elseif (($this->_foreach['manufacturer_list']['iteration'] <= 1)): ?>first_item<?php else: ?>item<?php endif; ?>"><a href="<?php echo $this->_tpl_vars['link']->getmanufacturerLink($this->_tpl_vars['manufacturer']['id_manufacturer'],$this->_tpl_vars['manufacturer']['link_rewrite']); ?>
" title="<?php echo smartyTranslate(array('s' => 'More about','mod' => 'blockmanufacturer'), $this);?>
 <?php echo $this->_tpl_vars['manufacturer']['name']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['manufacturer']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a></li>
		<?php endif; ?>
	<?php endforeach; endif; unset($_from); ?>
	</ul>
	<?php endif; ?>
	<?php if ($this->_tpl_vars['form_list']): ?>
		<form action="<?php echo $_SERVER['SCRIPT_NAME']; ?>
" method="get">
			<p>
				<select id="manufacturer_list" onchange="autoUrl('manufacturer_list', '');">
					<option value="0"><?php echo smartyTranslate(array('s' => 'All manufacturers','mod' => 'blockmanufacturer'), $this);?>
</option>
				<?php $_from = $this->_tpl_vars['manufacturers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['manufacturer']):
?>
					<option value="<?php echo $this->_tpl_vars['link']->getmanufacturerLink($this->_tpl_vars['manufacturer']['id_manufacturer'],$this->_tpl_vars['manufacturer']['link_rewrite']); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['manufacturer']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</option>
				<?php endforeach; endif; unset($_from); ?>
				</select>
			</p>
		</form>
	<?php endif; ?>
<?php else: ?>
	<p><?php echo smartyTranslate(array('s' => 'No manufacturer','mod' => 'blockmanufacturer'), $this);?>
</p>
<?php endif; ?>
	</div>
</div>
<!-- /Block manufacturers module -->