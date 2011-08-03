<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:29
         compiled from "/homepages/13/d194332323/htdocs/www/modules/crossselling/crossselling.tpl" */ ?>
<?php /*%%SmartyHeaderCode:8391313104e396fad88f9a9-64141005%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9858e77c3629b60d3fa94d1984a76fecc20e543b' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/crossselling/crossselling.tpl',
      1 => 1311955787,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '8391313104e396fad88f9a9-64141005',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_function_math')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/function.math.php';
if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
?><?php $_smarty_tpl->tpl_vars['nbView'] = new Smarty_variable('3', null, null);?>

<?php if (count($_smarty_tpl->getVariable('orderProducts')->value)>0){?>
	<script type="text/javascript">var middle = <?php echo $_smarty_tpl->getVariable('middlePosition_crossselling')->value;?>
;</script>
	<script type="text/javascript" src="<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
modules/crossselling/js/crossselling.js"></script>
	
	<?php if ($_smarty_tpl->getVariable('samecat')->value=='on'){?>
		<h2><?php echo smartyTranslate(array('s'=>'Product of the category:','mod'=>'crossselling'),$_smarty_tpl);?>
</h2>
	<?php }else{ ?>
		<h2><?php echo smartyTranslate(array('s'=>'Customers who bought this product also bought:','mod'=>'crossselling'),$_smarty_tpl);?>
</h2>
	<?php }?>

	<div id="<?php if (count($_smarty_tpl->getVariable('orderProducts')->value)>$_smarty_tpl->getVariable('nbView')->value){?>crossselling<?php }else{ ?>crossselling_noscroll<?php }?>">
		<?php if (count($_smarty_tpl->getVariable('orderProducts')->value)>$_smarty_tpl->getVariable('nbView')->value){?><a id="crossselling_scroll_left" class="active" title="<?php echo smartyTranslate(array('s'=>'Previous','mod'=>'crossselling'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Previous','mod'=>'crossselling'),$_smarty_tpl);?>
</a><?php }?>
		
		<div id="crossselling_list"<?php if (count($_smarty_tpl->getVariable('orderProducts')->value)<=$_smarty_tpl->getVariable('nbView')->value){?> style="width: inherit;"<?php }?>>
			<ul <?php if (count($_smarty_tpl->getVariable('orderProducts')->value)>$_smarty_tpl->getVariable('nbView')->value){?>style="width: <?php echo smarty_function_math(array('equation'=>"((width / nbView) * nbImages)+1000",'width'=>710,'nbView'=>$_smarty_tpl->getVariable('nbView')->value,'nbImages'=>count($_smarty_tpl->getVariable('orderProducts')->value)),$_smarty_tpl);?>
px"<?php }?>>
				<?php  $_smarty_tpl->tpl_vars['orderProduct'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('orderProducts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['orderProduct']->key => $_smarty_tpl->tpl_vars['orderProduct']->value){
?>
					<li <?php if (count($_smarty_tpl->getVariable('orderProducts')->value)<=$_smarty_tpl->getVariable('nbView')->value){?>style="width: <?php echo smarty_function_math(array('equation'=>"( width - ( margin * 2 * nbImages ) ) / nbImages",'width'=>750,'margin'=>11,'nbImages'=>count($_smarty_tpl->getVariable('orderProducts')->value)),$_smarty_tpl);?>
px"<?php }?>>
						<a href="<?php echo $_smarty_tpl->tpl_vars['orderProduct']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
">
							<img src="<?php echo $_smarty_tpl->tpl_vars['orderProduct']->value['image'];?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
" />
						</a><br/>
						<a href="<?php echo $_smarty_tpl->tpl_vars['orderProduct']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
">
							<?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->tpl_vars['orderProduct']->value['name'],30,'...'),'htmlall','UTF-8');?>

						</a>
						
						<?php if ($_smarty_tpl->tpl_vars['orderProduct']->value['price']>0){?>
							<div class="block_prices">
								<span class="price">
									<span class="in">
										<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['orderProduct']->value['price']),$_smarty_tpl);?>

									</span>
	
									<?php if ($_smarty_tpl->tpl_vars['orderProduct']->value['price_without_reduction']!=$_smarty_tpl->tpl_vars['orderProduct']->value['price']){?>
										<span class="in barre">
											<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->tpl_vars['orderProduct']->value['price_without_reduction']),$_smarty_tpl);?>

										</span>
									<?php }?>
			
									<span class="before"></span>
								</span>
							</div>
						<?php }?>
						
						<a class="button ajax_add_to_cart_button exclusive" href="<?php echo $_smarty_tpl->tpl_vars['orderProduct']->value['link'];?>
" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['orderProduct']->value['name']);?>
"><?php echo smartyTranslate(array('s'=>'Voir details'),$_smarty_tpl);?>
</a>
					</li>
				<?php }} ?>
			</ul>
		</div>
	
		<?php if (count($_smarty_tpl->getVariable('orderProducts')->value)>$_smarty_tpl->getVariable('nbView')->value){?><a id="crossselling_scroll_right" class="active" title="<?php echo smartyTranslate(array('s'=>'Next','mod'=>'crossselling'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Next','mod'=>'crossselling'),$_smarty_tpl);?>
</a><?php }?>
	</div>
	<div class="clear"></div>
<?php }?>
