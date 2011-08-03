<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 18:02:49
         compiled from "/homepages/13/d194332323/htdocs/www/modules/homebest/homebest.tpl" */ ?>
<?php /*%%SmartyHeaderCode:14478460754e397129ddb6e0-96645509%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'f6cd77197b005099f37890c714cbecaba80e0736' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/homebest/homebest.tpl',
      1 => 1303490424,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '14478460754e397129ddb6e0-96645509',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?><!-- MODULE Home Best Products -->
<div id="best-products_block_center" class="block products_block">
	<h4><span class="left"></span><span class="middle"><?php echo smartyTranslate(array('s'=>'Meilleures ventes','mod'=>'homebest'),$_smarty_tpl);?>
</span><span class="right"></span></h4>
	<?php if (isset($_smarty_tpl->getVariable('best_sellers',null,true,false)->value)&&$_smarty_tpl->getVariable('best_sellers')->value){?>
		<div class="block_content">
			<?php $_smarty_tpl->tpl_vars['liHeight'] = new Smarty_variable(203, null, null);?>
			<?php $_smarty_tpl->tpl_vars['nbItemsPerLine'] = new Smarty_variable(3, null, null);?>
			<?php $_smarty_tpl->tpl_vars['nbLi'] = new Smarty_variable(count($_smarty_tpl->getVariable('best_sellers')->value), null, null);?>
			<?php $_smarty_tpl->tpl_vars['nbLines'] = new Smarty_variable($_smarty_tpl->getVariable('nbLi')->value/ceil($_smarty_tpl->getVariable('nbItemsPerLine')->value), null, null);?>
			<?php $_smarty_tpl->tpl_vars['ulHeight'] = new Smarty_variable($_smarty_tpl->getVariable('nbLines')->value*$_smarty_tpl->getVariable('liHeight')->value, null, null);?>

			<ul>
				<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('best_sellers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['product']->total= $_smarty_tpl->_count($_from);
 $_smarty_tpl->tpl_vars['product']->iteration=0;
 $_smarty_tpl->tpl_vars['product']->index=-1;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['homeBestProducts']['total'] = $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['homeBestProducts']['iteration']=0;
if ($_smarty_tpl->tpl_vars['product']->total > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
 $_smarty_tpl->tpl_vars['product']->iteration++;
 $_smarty_tpl->tpl_vars['product']->index++;
 $_smarty_tpl->tpl_vars['product']->first = $_smarty_tpl->tpl_vars['product']->index === 0;
 $_smarty_tpl->tpl_vars['product']->last = $_smarty_tpl->tpl_vars['product']->iteration === $_smarty_tpl->tpl_vars['product']->total;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['homeBestProducts']['first'] = $_smarty_tpl->tpl_vars['product']->first;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['homeBestProducts']['iteration']++;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['homeBestProducts']['last'] = $_smarty_tpl->tpl_vars['product']->last;
?>
					<li class="ajax_block_product <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['homeBestProducts']['first']){?>first_item<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['homeBestProducts']['last']){?>last_item<?php }else{ ?>item<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['homeBestProducts']['iteration']%$_smarty_tpl->getVariable('nbItemsPerLine')->value==0){?>last_item_of_line<?php }elseif($_smarty_tpl->getVariable('smarty')->value['foreach']['homeBestProducts']['iteration']%$_smarty_tpl->getVariable('nbItemsPerLine')->value==1){?>clear<?php }?> <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['homeBestProducts']['iteration']>($_smarty_tpl->getVariable('smarty')->value['foreach']['homeBestProducts']['total']-($_smarty_tpl->getVariable('smarty')->value['foreach']['homeBestProducts']['total']%$_smarty_tpl->getVariable('nbItemsPerLine')->value))){?>last_line<?php }?>">
						<!-- image -->
						<a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8');?>
" class="product_image"><img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'home');?>
" height="<?php echo $_smarty_tpl->getVariable('homeSize')->value['height'];?>
" width="<?php echo $_smarty_tpl->getVariable('homeSize')->value['width'];?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8');?>
" /></a>

						<!-- prix + add to cart -->
						<div class="action">
							<p class="price">
								<span class="left"></span>
								<span class="middle"><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['product']->value['price']),$_smarty_tpl);?>
</span>
								<span class="right">
									<?php if (($_smarty_tpl->tpl_vars['product']->value['quantity']>0||$_smarty_tpl->tpl_vars['product']->value['allow_oosp'])&&$_smarty_tpl->tpl_vars['product']->value['customizable']!=2){?>
										<a class="exclusive ajax_add_to_cart_button" rel="ajax_id_product_<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
" href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
cart.php?qty=1&amp;id_product=<?php echo $_smarty_tpl->tpl_vars['product']->value['id_product'];?>
&amp;token=<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
&amp;add" title="<?php echo smartyTranslate(array('s'=>'Add to cart','mod'=>'homebest'),$_smarty_tpl);?>
"></a>
									<?php }?>
								</span>
								<span class="clear"></span>
							</p>
						</div>

						<!-- titre -->
						<div class="title"><a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8');?>
" class="product_image"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],40,'...'),'html','UTF-8');?>
</a></div>
						<!-- add to cart -->
						<a class="button ajax_add_to_cart_button exclusive" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['product']->value['name'],'html','UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Voir details'),$_smarty_tpl);?>
</a>
					</li>
				<?php }} ?>

				<div class="clear"></div>
			</ul>
		</div>
	<?php }else{ ?>
		<p><?php echo smartyTranslate(array('s'=>'No best products','mod'=>'homebest'),$_smarty_tpl);?>
</p>
	<?php }?>
</div>
<!-- /MODULE Home Best Products -->
