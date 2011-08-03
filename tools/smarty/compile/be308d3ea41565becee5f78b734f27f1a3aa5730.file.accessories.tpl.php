<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:29
         compiled from "/homepages/13/d194332323/htdocs/www/modules/accessories/accessories.tpl" */ ?>
<?php /*%%SmartyHeaderCode:16475845344e396fad40fda2-24881715%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'be308d3ea41565becee5f78b734f27f1a3aa5730' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/accessories/accessories.tpl',
      1 => 1311955769,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '16475845344e396fad40fda2-24881715',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_math')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/function.math.php';
if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?><?php $_smarty_tpl->tpl_vars['nbView'] = new Smarty_variable('3', null, null);?>

<?php if (count($_smarty_tpl->getVariable('products')->value)>0){?>
	<script type="text/javascript">var middleAcc = <?php echo $_smarty_tpl->getVariable('middlePosition_accessorie')->value;?>
;</script>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
modules/accessorie/js/accessorie.js"></script>
	
	<h2><?php echo smartyTranslate(array('s'=>'Accessories of the current product','mod'=>'accessories'),$_smarty_tpl);?>
</h2>

	<div id="accessorie<?php if (count($_smarty_tpl->getVariable('products')->value)>$_smarty_tpl->getVariable('nbView')->value){?>_noscroll<?php }?>">
		<?php if (count($_smarty_tpl->getVariable('products')->value)>$_smarty_tpl->getVariable('nbView')->value){?><a id="accessorie_scroll_left" class="active" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'accessorie'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Previous','mod'=>'accessorie'),$_smarty_tpl);?>
</a><?php }?>
		
		<div id="accessorie_list"<?php if (count($_smarty_tpl->getVariable('products')->value)<=$_smarty_tpl->getVariable('nbView')->value){?> style="width: inherit;"<?php }?>>
			<ul <?php if (count($_smarty_tpl->getVariable('products')->value)>$_smarty_tpl->getVariable('nbView')->value){?>style="width: <?php echo smarty_function_math(array('equation'=>"((710 / nbView) * nbImages)+1000",'width'=>710,'nbView'=>$_smarty_tpl->getVariable('nbView')->value,'nbImages'=>count($_smarty_tpl->getVariable('products')->value)),$_smarty_tpl);?>
px"<?php }?>>
				<?php  $_smarty_tpl->tpl_vars['product'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('products')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['product']->key => $_smarty_tpl->tpl_vars['product']->value){
?>
					<li <?php if (count($_smarty_tpl->getVariable('products')->value)<=$_smarty_tpl->getVariable('nbView')->value){?>style="width: <?php echo smarty_function_math(array('equation'=>"( width - ( margin * 2 * nbImages ) ) / nbImages",'width'=>790,'margin'=>11,'nbImages'=>count($_smarty_tpl->getVariable('products')->value)),$_smarty_tpl);?>
px"<?php }?>>
						<a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name']);?>
">
							<img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->tpl_vars['product']->value['link_rewrite'],$_smarty_tpl->tpl_vars['product']->value['id_image'],'crosselling');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name']);?>
" />
						</a><br/>
						<a href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name']);?>
">
							<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['product']->value['name'],30,'...'),'htmlall','UTF-8');?>

						</a>
						
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
						</div>
						
						<a class="button ajax_add_to_cart_button exclusive" href="<?php echo $_smarty_tpl->tpl_vars['product']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['product']->value['name']);?>
"><?php echo smartyTranslate(array('s'=>'Voir details'),$_smarty_tpl);?>
</a>
					</li>
				<?php }} ?>
			</ul>
		</div>
	
		<?php if (count($_smarty_tpl->getVariable('products')->value)>$_smarty_tpl->getVariable('nbView')->value){?><a id="accessorie_scroll_right" class="active" title="<?php echo smartyTranslate(array('s'=>'Next','mod'=>'accessorie'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Next','mod'=>'accessorie'),$_smarty_tpl);?>
</a><?php }?>
	</div>
	<div class="clear"></div>
<?php }?>
