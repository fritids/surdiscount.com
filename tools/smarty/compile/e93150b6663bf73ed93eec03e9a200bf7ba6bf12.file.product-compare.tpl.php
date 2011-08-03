<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 18:05:15
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/./product-compare.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14149480104e3971bb1dd304-61490184%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'e93150b6663bf73ed93eec03e9a200bf7ba6bf12' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/./product-compare.tpl',
      1 => 1302688641,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14149480104e3971bb1dd304-61490184',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>


<?php if ($_smarty_tpl->getVariable('comparator_max_item')->value){?>
<script type="text/javascript">
// <![CDATA[
	var min_item = '<?php echo smartyTranslate(array('s'=>'Please select at least one product.','js'=>1),$_smarty_tpl);?>
';
	var max_item = "<?php echo smartyTranslate(array('s'=>'You cannot add more than','js'=>1),$_smarty_tpl);?>
 <?php echo $_smarty_tpl->getVariable('comparator_max_item')->value;?>
 <?php echo smartyTranslate(array('s'=>'product(s) in the product comparator','js'=>1),$_smarty_tpl);?>
";
//]]>
</script>
	<form method="get" action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('products-comparison.php');?>
" onsubmit="return checkBeforeComparison();">
		<p>
		<input type="submit" class="button" value="<?php echo smartyTranslate(array('s'=>'Compare'),$_smarty_tpl);?>
" style="float:right" />
		<input type="hidden" name="compare_product_list" class="compare_product_list" value="" />
		</p>
	</form>
<?php }?>

