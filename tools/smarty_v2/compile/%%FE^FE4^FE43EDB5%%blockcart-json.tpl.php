<?php /* Smarty version 2.6.20, created on 2011-03-23 15:05:06
         compiled from /homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart-json.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'html_entity_decode', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart-json.tpl', 3, false),array('modifier', 'addslashes', '/homepages/13/d194332323/htdocs/beta/modules/blockcart/blockcart-json.tpl', 13, false),)), $this); ?>
{
	"discounts": [],
	"shippingCost": "<?php echo ((is_array($_tmp=$this->_tpl_vars['shipping_cost'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
",
	"wrappingCost": "<?php echo ((is_array($_tmp=$this->_tpl_vars['wrapping_cost'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
",
	"nbTotalProducts": "<?php echo $this->_tpl_vars['nb_total_products']; ?>
",
	"total": "<?php echo ((is_array($_tmp=$this->_tpl_vars['total'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
",
	"productTotal": "<?php echo ((is_array($_tmp=$this->_tpl_vars['product_total'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
",

	<?php if (isset ( $this->_tpl_vars['errors'] ) && $this->_tpl_vars['errors']): ?>
		"hasError" : true,
		errors : {
			<?php $_from = $this->_tpl_vars['errors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['errors'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['errors']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['error']):
        $this->_foreach['errors']['iteration']++;
?>
				"<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['error'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)))) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, 'UTF-8') : html_entity_decode($_tmp, 2, 'UTF-8')); ?>
"
				<?php if (! ($this->_foreach['errors']['iteration'] == $this->_foreach['errors']['total'])): ?>,<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
		}
	<?php else: ?>
		"hasError" : false
	<?php endif; ?>
}