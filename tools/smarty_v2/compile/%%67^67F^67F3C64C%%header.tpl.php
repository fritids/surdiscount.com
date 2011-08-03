<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/modules/ganalytics/header.tpl */ ?>
<script type="text/javascript">
var _gaq = _gaq || [];
_gaq.push(['_setAccount', '<?php echo $this->_tpl_vars['ganalytics_id']; ?>
']);
_gaq.push(['_trackPageview', '<?php echo $this->_tpl_vars['pageTrack']; ?>
']);
<?php if ($this->_tpl_vars['isOrder'] == true): ?>		  _gaq.push(['_addTrans',
    '<?php echo $this->_tpl_vars['trans']['id']; ?>
',			    '<?php echo $this->_tpl_vars['trans']['store']; ?>
',		    '<?php echo $this->_tpl_vars['trans']['total']; ?>
',		    '<?php echo $this->_tpl_vars['trans']['tax']; ?>
',			    '<?php echo $this->_tpl_vars['trans']['shipping']; ?>
',	    '<?php echo $this->_tpl_vars['trans']['city']; ?>
',		    '<?php echo $this->_tpl_vars['trans']['state']; ?>
',		    '<?php echo $this->_tpl_vars['trans']['country']; ?>
'		  ]);

	<?php $_from = $this->_tpl_vars['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
		_gaq.push(['_addItem',
		'<?php echo $this->_tpl_vars['item']['OrderId']; ?>
',				'<?php echo $this->_tpl_vars['item']['SKU']; ?>
',					'<?php echo $this->_tpl_vars['item']['Product']; ?>
',				'<?php echo $this->_tpl_vars['item']['Category']; ?>
',				'<?php echo $this->_tpl_vars['item']['Price']; ?>
',				'<?php echo $this->_tpl_vars['item']['Quantity']; ?>
'				]);
	<?php endforeach; endif; unset($_from); ?>
	<?php echo '
  _gaq.push([\'_trackTrans\']);	
'; ?>

<?php endif; ?>
<?php echo '
(function() {
	var ga = document.createElement(\'script\'); ga.type = \'text/javascript\'; ga.async = true;
	ga.src = (\'https:\' == document.location.protocol ? \'https://ssl\' : \'http://www\') + \'.google-analytics.com/ga.js\';
	var s = document.getElementsByTagName(\'script\')[0]; s.parentNode.insertBefore(ga, s);
})(); '; ?>

</script>