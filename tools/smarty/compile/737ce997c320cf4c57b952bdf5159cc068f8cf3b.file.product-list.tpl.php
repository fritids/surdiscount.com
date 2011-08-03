<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 18:03:00
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/./product-list.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16812686404e39713460fcc3-35543566%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '737ce997c320cf4c57b952bdf5159cc068f8cf3b' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/./product-list.tpl',
      1 => 1311955733,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16812686404e39713460fcc3-35543566',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.date_format.php';
?>

<?php if (isset($_smarty_tpl->getVariable('products',null,true,false)->value)){?>
	<!-- Products list -->
	<ul id="product_list" class="clear">
	<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']=-1;
if ($_smarty_tpl->tpl_vars['product']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['index']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['products']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
		<li class="ajax_block_product <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['last']){?>last_item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['products']['index']%2){?>alternate_item<?php }else{ ?>item<?php }?> clearfix">
			<div class="center_block">
				<a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['link'],'htmlall','UTF-8');?>
" class="product_img_link" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
"><img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'listing');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['legend'],'htmlall','UTF-8');?>
" width="<?php echo $_smarty_tpl->getVariable('listingSize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('listingSize')->value['height'];?>
" /></a>
				<h3><?php if ($_smarty_tpl->tpl_vars['product']->value['new']==1){?><span class="new"><?php echo smartyTranslate(array('s'=>'new'),$_smarty_tpl);?>
</span><?php }?><a href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['link'],'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],50,'...'),'htmlall','UTF-8');?>
</a></h3>
				<a class="button ajax_add_to_cart_button exclusive" href="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['link'],'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'htmlall','UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Voir details'),$_smarty_tpl);?>
</a>
			</div>
			<div class="right_block">
				<!--
				<?php if ($_smarty_tpl->tpl_vars['product']->value['on_sale']){?>
					<span class="on_sale"><?php echo smartyTranslate(array('s'=>'On sale!'),$_smarty_tpl);?>
</span>
				<?php }elseif(($_smarty_tpl->tpl_vars['product']->value['reduction_price']!=0||$_smarty_tpl->tpl_vars['product']->value['reduction_percent']!=0)&&($_smarty_tpl->tpl_vars['product']->value['reduction_from']==$_smarty_tpl->tpl_vars['product']->value['reduction_to']||(smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')<=$_smarty_tpl->tpl_vars['product']->value['reduction_to']&&smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')>=$_smarty_tpl->tpl_vars['product']->value['reduction_from']))){?>
					<span class="discount"><?php echo smartyTranslate(array('s'=>'Price lowered!'),$_smarty_tpl);?>
</span>
				<?php }?>
				-->

				<div class="block_prices">
					<span class="price">
						<span class="in">
							<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>

						</span>

						<?php if ($_smarty_tpl->tpl_vars['product']->value['price_without_reduction']!=$_smarty_tpl->tpl_vars['product']->value['price']){?>
							<span class="in barre">
								<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price_without_reduction']),$_smarty_tpl);?>

							</span>
						<?php }?>

						<span class="before"></span>
					</span>

					<span class="availability"><?php if (($_smarty_tpl->tpl_vars['product']->value['allow_oosp']||$_smarty_tpl->tpl_vars['product']->value['quantity']>0)){?><?php echo smartyTranslate(array('s'=>'Available'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Out of stock'),$_smarty_tpl);?>
<?php }?></span>
				</div>
			</div>
		</li>
	<?php }} ?>
	</ul>
	<!-- /Products list -->
<?php }?>