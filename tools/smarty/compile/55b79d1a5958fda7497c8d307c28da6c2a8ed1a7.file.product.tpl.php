<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:21
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/product.tpl" */ ?>
<?php /*%%SmartyHeaderCode:7865744774e396fa5800be8-88413139%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '55b79d1a5958fda7497c8d307c28da6c2a8ed1a7' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/product.tpl',
      1 => 1306243537,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '7865744774e396fa5800be8-88413139',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.date_format.php';
if (!is_callable('smarty_function_math')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/function.math.php';
if (!is_callable('smarty_modifier_replace')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.replace.php';
if (!is_callable('smarty_function_counter')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/function.counter.php';
?>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./errors.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
<?php if (count($_smarty_tpl->getVariable('errors')->value)==0){?>

<script type="text/javascript">
// <![CDATA[

// PrestaShop internal settings
var currencySign = '<?php echo html_entity_decode($_smarty_tpl->getVariable('currencySign')->value,2,"UTF-8");?>
';
var currencyRate = '<?php echo floatval($_smarty_tpl->getVariable('currencyRate')->value);?>
';
var currencyFormat = '<?php echo intval($_smarty_tpl->getVariable('currencyFormat')->value);?>
';
var currencyBlank = '<?php echo intval($_smarty_tpl->getVariable('currencyBlank')->value);?>
';
var taxRate = <?php echo floatval($_smarty_tpl->getVariable('tax_rate')->value);?>
;
var jqZoomEnabled = <?php if ($_smarty_tpl->getVariable('jqZoomEnabled')->value){?>true<?php }else{ ?>false<?php }?>;

//JS Hook
var oosHookJsCodeFunctions = new Array();

// Parameters
var id_product = '<?php echo intval($_smarty_tpl->getVariable('product')->value->id);?>
';
var productHasAttributes = <?php if (isset($_smarty_tpl->getVariable('groups',null,true,false)->value)){?>true<?php }else{ ?>false<?php }?>;
var quantitiesDisplayAllowed = <?php if ($_smarty_tpl->getVariable('display_qties')->value==1){?>true<?php }else{ ?>false<?php }?>;
var quantityAvailable = <?php if ($_smarty_tpl->getVariable('display_qties')->value==1&&$_smarty_tpl->getVariable('product')->value->quantity){?><?php echo $_smarty_tpl->getVariable('product')->value->quantity;?>
<?php }else{ ?>0<?php }?>;
var allowBuyWhenOutOfStock = <?php if ($_smarty_tpl->getVariable('allow_oosp')->value==1){?>true<?php }else{ ?>false<?php }?>;
var availableNowValue = '<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->available_now,'quotes','UTF-8');?>
';
var availableLaterValue = '<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->available_later,'quotes','UTF-8');?>
';
var productPriceTaxExcluded = <?php echo (($tmp = @$_smarty_tpl->getVariable('product')->value->getPriceWithoutReduct(true))===null||$tmp==='' ? 'null' : $tmp);?>
 - <?php echo $_smarty_tpl->getVariable('product')->value->ecotax;?>
;
var reduction_percent = <?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction']&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction_type']=='percentage'){?><?php echo $_smarty_tpl->getVariable('product')->value->specificPrice['reduction']*100;?>
<?php }else{ ?>0<?php }?>;
var reduction_price = <?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction']&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction_type']=='amount'){?><?php echo $_smarty_tpl->getVariable('product')->value->specificPrice['reduction'];?>
<?php }else{ ?>0<?php }?>;
var specific_price = <?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['price']){?><?php echo $_smarty_tpl->getVariable('product')->value->specificPrice['price'];?>
<?php }else{ ?>0<?php }?>;
var specific_currency = <?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['id_currency']){?>true<?php }else{ ?>false<?php }?>;
var group_reduction = '<?php echo $_smarty_tpl->getVariable('group_reduction')->value;?>
';
var default_eco_tax = <?php echo $_smarty_tpl->getVariable('product')->value->ecotax;?>
;
var ecotaxTax_rate = <?php echo $_smarty_tpl->getVariable('ecotaxTax_rate')->value;?>
;
var currentDate = '<?php echo smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S');?>
';
var maxQuantityToAllowDisplayOfLastQuantityMessage = <?php echo $_smarty_tpl->getVariable('last_qties')->value;?>
;
var noTaxForThisProduct = <?php if ($_smarty_tpl->getVariable('no_tax')->value==1){?>true<?php }else{ ?>false<?php }?>;
var displayPrice = <?php echo $_smarty_tpl->getVariable('priceDisplay')->value;?>
;
var productReference = '<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->reference,'htmlall','UTF-8');?>
';
var productAvailableForOrder = <?php if ((isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->getVariable('restricted_country_mode')->value)||$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>'0'<?php }else{ ?>'<?php echo $_smarty_tpl->getVariable('product')->value->available_for_order;?>
'<?php }?>;
var productShowPrice = '<?php if (!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?><?php echo $_smarty_tpl->getVariable('product')->value->show_price;?>
<?php }else{ ?>0<?php }?>';
var productUnitPriceRatio = '<?php echo $_smarty_tpl->getVariable('product')->value->unit_price_ratio;?>
';
var idDefaultImage = <?php if (isset($_smarty_tpl->getVariable('cover',null,true,false)->value['id_image_only'])){?><?php echo $_smarty_tpl->getVariable('cover')->value['id_image_only'];?>
<?php }else{ ?>0<?php }?>;

// Customizable field
var img_ps_dir = '<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
';
var customizationFields = new Array();
<?php $_smarty_tpl->tpl_vars['imgIndex'] = new Smarty_variable(0, null, null);?>
<?php $_smarty_tpl->tpl_vars['textFieldIndex'] = new Smarty_variable(0, null, null);?>
<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customizationFields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customizationFields']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customizationFields']['index']++;
?>
	<?php $_smarty_tpl->tpl_vars["key"] = new Smarty_variable("pictures_".($_smarty_tpl->getVariable('product')->value->id)."_".($_smarty_tpl->tpl_vars['field']->value['id_customization_field']), null, null);?>
	customizationFields[<?php echo intval($_smarty_tpl->getVariable('smarty')->value['foreach']['customizationFields']['index']);?>
] = new Array();
	customizationFields[<?php echo intval($_smarty_tpl->getVariable('smarty')->value['foreach']['customizationFields']['index']);?>
][0] = '<?php if (intval($_smarty_tpl->tpl_vars['field']->value['type'])==0){?>img<?php echo $_smarty_tpl->getVariable('imgIndex')->value++;?>
<?php }else{ ?>textField<?php echo $_smarty_tpl->getVariable('textFieldIndex')->value++;?>
<?php }?>';
	customizationFields[<?php echo intval($_smarty_tpl->getVariable('smarty')->value['foreach']['customizationFields']['index']);?>
][1] = <?php if (intval($_smarty_tpl->tpl_vars['field']->value['type'])==0&&isset($_smarty_tpl->getVariable('pictures',null,true,false)->value[$_smarty_tpl->getVariable('key',null,true,false)->value])&&$_smarty_tpl->getVariable('pictures')->value[$_smarty_tpl->getVariable('key')->value]){?>2<?php }else{ ?><?php echo intval($_smarty_tpl->tpl_vars['field']->value['required']);?>
<?php }?>;
<?php }} ?>

// Images
var img_prod_dir = '<?php echo $_smarty_tpl->getVariable('img_prod_dir')->value;?>
';
var combinationImages = new Array();

<?php if (isset($_smarty_tpl->getVariable('combinationImages',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['combination'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['combinationId'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('combinationImages')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['combination']->key => $_smarty_tpl->tpl_vars['combination']->value){
 $_smarty_tpl->tpl_vars['combinationId']->value = $_smarty_tpl->tpl_vars['combination']->key;
?>
		combinationImages[<?php echo $_smarty_tpl->tpl_vars['combinationId']->value;?>
] = new Array();
		<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['combination']->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['f_combinationImage']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['f_combinationImage']['index']++;
?>
			combinationImages[<?php echo $_smarty_tpl->tpl_vars['combinationId']->value;?>
][<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['f_combinationImage']['index'];?>
] = <?php echo intval($_smarty_tpl->tpl_vars['image']->value['id_image']);?>
;
		<?php }} ?>
	<?php }} ?>
<?php }?>

combinationImages[0] = new Array();
<?php if (isset($_smarty_tpl->getVariable('images',null,true,false)->value)){?>
	<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('images')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['f_defaultImages']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['f_defaultImages']['index']++;
?>
		combinationImages[0][<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['f_defaultImages']['index'];?>
] = <?php echo $_smarty_tpl->tpl_vars['image']->value['id_image'];?>
;
	<?php }} ?>
<?php }?>

// Translations
var doesntExist = '<?php echo smartyTranslate(array('s'=>'The product does not exist in this model. Please choose another.','js'=>1),$_smarty_tpl);?>
';
var doesntExistNoMore = '<?php echo smartyTranslate(array('s'=>'This product is no longer in stock','js'=>1),$_smarty_tpl);?>
';
var doesntExistNoMoreBut = '<?php echo smartyTranslate(array('s'=>'with those attributes but is available with others','js'=>1),$_smarty_tpl);?>
';
var uploading_in_progress = '<?php echo smartyTranslate(array('s'=>'Uploading in progress, please wait...','js'=>1),$_smarty_tpl);?>
';
var fieldRequired = '<?php echo smartyTranslate(array('s'=>'Please fill in all required fields','js'=>1),$_smarty_tpl);?>
';

<?php if (isset($_smarty_tpl->getVariable('groups',null,true,false)->value)){?>
	// Combinations
	<?php  $_smarty_tpl->tpl_vars['combination'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['idCombination'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('combinations')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['combination']->key => $_smarty_tpl->tpl_vars['combination']->value){
 $_smarty_tpl->tpl_vars['idCombination']->value = $_smarty_tpl->tpl_vars['combination']->key;
?>
		addCombination(<?php echo intval($_smarty_tpl->tpl_vars['idCombination']->value);?>
, new Array(<?php echo $_smarty_tpl->tpl_vars['combination']->value['list'];?>
), <?php echo $_smarty_tpl->tpl_vars['combination']->value['quantity'];?>
, <?php echo $_smarty_tpl->tpl_vars['combination']->value['price'];?>
, <?php echo $_smarty_tpl->tpl_vars['combination']->value['ecotax'];?>
, <?php echo $_smarty_tpl->tpl_vars['combination']->value['id_image'];?>
, '<?php echo addslashes($_smarty_tpl->tpl_vars['combination']->value['reference']);?>
', <?php echo $_smarty_tpl->tpl_vars['combination']->value['unit_impact'];?>
, <?php echo $_smarty_tpl->tpl_vars['combination']->value['minimal_quantity'];?>
);
	<?php }} ?>
	// Colors
	<?php if (count($_smarty_tpl->getVariable('colors')->value)>0){?>
		<?php if ($_smarty_tpl->getVariable('product')->value->id_color_default){?>var id_color_default = <?php echo intval($_smarty_tpl->getVariable('product')->value->id_color_default);?>
;<?php }?>
	<?php }?>
<?php }?>

//]]>
</script>

<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./breadcrumb.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>

<div itemscope itemtype="http://data-vocabulary.org/Product" id="primary_block" class="clearfix">
	<h1 itemprop="name"><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name,'htmlall','UTF-8');?>
</h1>
	
	<span class="hidden" itemprop="identifier" content="mpn:<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
"><?php echo $_smarty_tpl->getVariable('product')->value->id;?>
</span>
	
	<span class="hidden" itemprop="review" itemscope itemtype="http://data-vocabulary.org/Review-aggregate"><span class="hidden" itemprop="rating">4.9</span> / 5, <span itemprop="count">157</span> votes</span>

	<?php if (isset($_smarty_tpl->getVariable('adminActionDisplay',null,true,false)->value)&&$_smarty_tpl->getVariable('adminActionDisplay')->value){?>
	<div id="admin-action">
		<p><?php echo smartyTranslate(array('s'=>'This product is not visible to your customers.'),$_smarty_tpl);?>

		<input type="hidden" id="admin-action-product-id" value="<?php echo $_smarty_tpl->getVariable('product')->value->id;?>
" />
		<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Publish'),$_smarty_tpl);?>
" class="exclusive" onclick="submitPublishProduct('<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
<?php echo $_GET['ad'];?>
', 0)"/>
		<input type="submit" value="<?php echo smartyTranslate(array('s'=>'Back'),$_smarty_tpl);?>
" class="exclusive" onclick="submitPublishProduct('<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
<?php echo $_GET['ad'];?>
', 1)"/>
		</p>
		<div class="clear" ></div>
		<p id="admin-action-result"></p>
		</p>
	</div>
	<?php }?>

	<?php if (isset($_smarty_tpl->getVariable('confirmation',null,true,false)->value)&&$_smarty_tpl->getVariable('confirmation')->value){?>
	<p class="confirmation">
		<?php echo $_smarty_tpl->getVariable('confirmation')->value;?>

	</p>
	<?php }?>

	<!-- right infos-->
	<div id="pb-right-column">
		<!-- product img-->
		<div id="image-block">
		<?php if ($_smarty_tpl->getVariable('have_image')->value){?>
			<img itemprop="image" src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value->link_rewrite,$_smarty_tpl->getVariable('cover')->value['id_image'],'large');?>
"
				<?php if ($_smarty_tpl->getVariable('jqZoomEnabled')->value){?>class="jqzoom" alt="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value->link_rewrite,$_smarty_tpl->getVariable('cover')->value['id_image'],'thickbox');?>
"<?php }else{ ?> title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name,'htmlall','UTF-8');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name,'htmlall','UTF-8');?>
" <?php }?> id="bigpic" width="<?php echo $_smarty_tpl->getVariable('largeSize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('largeSize')->value['height'];?>
" />
		<?php }else{ ?>
			<img src="<?php echo $_smarty_tpl->getVariable('img_prod_dir')->value;?>
<?php echo $_smarty_tpl->getVariable('lang_iso')->value;?>
-default-large.jpg" id="bigpic" alt="" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name,'htmlall','UTF-8');?>
" width="<?php echo $_smarty_tpl->getVariable('largeSize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('largeSize')->value['height'];?>
" />
		<?php }?>
		</div>

		<?php if (isset($_smarty_tpl->getVariable('images',null,true,false)->value)&&count($_smarty_tpl->getVariable('images')->value)>0){?>
			<!-- thumbnails -->
			<div id="views_block"<?php if (isset($_smarty_tpl->getVariable('images',null,true,false)->value)&&count($_smarty_tpl->getVariable('images')->value)<2&&!$_smarty_tpl->getVariable('quantity_discounts')->value){?> class="hidden"<?php }?>>
			<?php if (isset($_smarty_tpl->getVariable('images',null,true,false)->value)&&count($_smarty_tpl->getVariable('images')->value)>3){?>
				<span class="view_scroll_spacer"><a id="view_scroll_left" class="hidden" title="<?php echo smartyTranslate(array('s'=>'Other views'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Previous'),$_smarty_tpl);?>
</a></span>
			<?php }?>

			<div id="thumbs_list">
				<ul id="thumbs_list_frame">
					<?php if (isset($_smarty_tpl->getVariable('images',null,true,false)->value)){?>
						<?php  $_smarty_tpl->tpl_vars['image'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('images')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['image']->index=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['image']->key => $_smarty_tpl->tpl_vars['image']->value){
 $_smarty_tpl->tpl_vars['image']->index++;
 $_smarty_tpl->tpl_vars['image']->first = $_smarty_tpl->tpl_vars['image']->index === 0;
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['thumbnails']['first'] = $_smarty_tpl->tpl_vars['image']->first;
?>
							<?php $_smarty_tpl->tpl_vars['imageIds'] = new Smarty_variable(($_smarty_tpl->getVariable('product')->value->id)."-".($_smarty_tpl->tpl_vars['image']->value['id_image']), null, null);?>

							<li id="thumbnail_<?php echo $_smarty_tpl->tpl_vars['image']->value['id_image'];?>
">
								<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value->link_rewrite,$_smarty_tpl->getVariable('imageIds')->value,'thickbox');?>
" class="zoombox<?php if (count($_smarty_tpl->getVariable('images')->value)>1){?> zgallery_<?php }?>  <?php if ($_smarty_tpl->getVariable('smarty')->value['foreach']['thumbnails']['first']){?>shown<?php }?>" title="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['legend']);?>
">
									<img id="thumb_<?php echo $_smarty_tpl->tpl_vars['image']->value['id_image'];?>
" src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value->link_rewrite,$_smarty_tpl->getVariable('imageIds')->value,'medium');?>
" alt="<?php echo htmlspecialchars($_smarty_tpl->tpl_vars['image']->value['legend']);?>
" height="<?php echo $_smarty_tpl->getVariable('mediumSize')->value['height'];?>
" width="<?php echo $_smarty_tpl->getVariable('mediumSize')->value['width'];?>
" />
								</a>
							</li>
						<?php }} ?>
					<?php }?>
				</ul>
			</div>

			<?php if (isset($_smarty_tpl->getVariable('images',null,true,false)->value)&&count($_smarty_tpl->getVariable('images')->value)>3){?>
				<a id="view_scroll_right" title="<?php echo smartyTranslate(array('s'=>'Other views'),$_smarty_tpl);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s'=>'Next'),$_smarty_tpl);?>
</a>
			<?php }?>
			</div>
		<?php }?>
		<?php if (isset($_smarty_tpl->getVariable('images',null,true,false)->value)&&count($_smarty_tpl->getVariable('images')->value)>1){?><p class="align_center clear"><span id="wrapResetImages" style="display: none;"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/cancel_16x18.gif" alt="<?php echo smartyTranslate(array('s'=>'Cancel'),$_smarty_tpl);?>
" width="16" height="18"/> <a id="resetImages" href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->getVariable('product')->value);?>
" onclick="$('span#wrapResetImages').hide('slow');return (false);"><?php echo smartyTranslate(array('s'=>'Display all pictures'),$_smarty_tpl);?>
</a></span></p><?php }?>
	</div>

	<!-- left infos-->
	<div id="pb-left-column">
		<?php if ($_smarty_tpl->getVariable('product')->value->description_short||count($_smarty_tpl->getVariable('packItems')->value)>0){?>
		<div id="short_description_block">
			<?php if ($_smarty_tpl->getVariable('product')->value->description_short){?>
				<div id="short_description_content" class="rte align_justify"><?php echo $_smarty_tpl->getVariable('product')->value->description_short;?>
</div>
			<?php }?>
			<?php if ($_smarty_tpl->getVariable('product')->value->description){?>
			<p class="buttons_bottom_block"><a href="javascript:{}" class="button"><?php echo smartyTranslate(array('s'=>'More details'),$_smarty_tpl);?>
</a></p>
			<?php }?>
			<?php if (count($_smarty_tpl->getVariable('packItems')->value)>0){?>
				<h3><?php echo smartyTranslate(array('s'=>'Pack content'),$_smarty_tpl);?>
</h3>
				<?php  $_smarty_tpl->tpl_vars['packItem'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('packItems')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['packItem']->key => $_smarty_tpl->tpl_vars['packItem']->value){
?>
					<div class="pack_content">
						<?php echo $_smarty_tpl->tpl_vars['packItem']->value['pack_quantity'];?>
 x <a href="<?php echo $_smarty_tpl->getVariable('link')->value->getProductLink($_smarty_tpl->tpl_vars['packItem']->value['id_product'],$_smarty_tpl->tpl_vars['packItem']->value['link_rewrite'],$_smarty_tpl->tpl_vars['packItem']->value['category']);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['packItem']->value['name'],'htmlall','UTF-8');?>
</a>
						<p><?php echo $_smarty_tpl->tpl_vars['packItem']->value['description_short'];?>
</p>
					</div>
				<?php }} ?>
			<?php }?>
		</div>
		<?php }?>

		<?php if (($_smarty_tpl->getVariable('product')->value->show_price&&!isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value))||isset($_smarty_tpl->getVariable('groups',null,true,false)->value)||$_smarty_tpl->getVariable('product')->value->reference||(isset($_smarty_tpl->getVariable('HOOK_PRODUCT_ACTIONS',null,true,false)->value)&&$_smarty_tpl->getVariable('HOOK_PRODUCT_ACTIONS')->value)){?>
		<!-- add to cart form-->
		<form id="buy_block" <?php if ($_smarty_tpl->getVariable('PS_CATALOG_MODE')->value&&!isset($_smarty_tpl->getVariable('groups',null,true,false)->value)&&$_smarty_tpl->getVariable('product')->value->quantity>0){?>class="hidden"<?php }?> action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('cart.php');?>
" method="post">
			<!-- hidden datas -->
			<p class="hidden">
				<input type="hidden" name="token" value="<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
" />
				<input type="hidden" name="id_product" value="<?php echo intval($_smarty_tpl->getVariable('product')->value->id);?>
" id="product_page_product_id" />
				<input type="hidden" name="add" value="1" />
				<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
			</p>

			<!-- prices -->
			
			<?php if ($_smarty_tpl->getVariable('product')->value->show_price&&!isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&!$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?>
				<?php if (!$_smarty_tpl->getVariable('priceDisplay')->value||$_smarty_tpl->getVariable('priceDisplay')->value==2){?>
					<?php $_smarty_tpl->tpl_vars['productPrice'] = new Smarty_variable($_smarty_tpl->getVariable('product')->value->getPrice(true,@NULL), null, null);?>
					<?php $_smarty_tpl->tpl_vars['productPriceWithoutRedution'] = new Smarty_variable($_smarty_tpl->getVariable('product')->value->getPriceWithoutReduct(false,@NULL), null, null);?>
				<?php }elseif($_smarty_tpl->getVariable('priceDisplay')->value==1){?>
					<?php $_smarty_tpl->tpl_vars['productPrice'] = new Smarty_variable($_smarty_tpl->getVariable('product')->value->getPrice(false,@NULL), null, null);?>
					<?php $_smarty_tpl->tpl_vars['productPriceWithoutRedution'] = new Smarty_variable($_smarty_tpl->getVariable('product')->value->getPriceWithoutReduct(true,@NULL), null, null);?>
				<?php }?>
				<div class="price">
					<?php $_smarty_tpl->tpl_vars['prix_barre'] = new Smarty_variable('false', null, null);?>
					
					<?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction']&&$_smarty_tpl->getVariable('productPriceWithoutRedution')->value>$_smarty_tpl->getVariable('productPrice')->value){?>
						<?php $_smarty_tpl->tpl_vars['img_etiquette'] = new Smarty_variable('1303121940-asaisir.png', null, null);?>
						<?php $_smarty_tpl->tpl_vars['prix_barre'] = new Smarty_variable('true', null, null);?>
					<?php }?>

					<?php if ($_smarty_tpl->getVariable('product')->value->etiquette){?>
						<?php $_smarty_tpl->tpl_vars['img_etiquette'] = new Smarty_variable($_smarty_tpl->getVariable('product')->value->etiquette, null, null);?>
					<?php }?>
	
					<?php if ($_smarty_tpl->getVariable('img_etiquette')->value){?>
						<img src="<?php echo @_PS_IMG_;?>
et/<?php echo $_smarty_tpl->getVariable('img_etiquette')->value;?>
" alt="" title="" width="" height="" />
					<?php }?>

					<div id="info_price">
						<?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction']){?>
							<p id="old_price">
								<span class="bold">
								<?php if ($_smarty_tpl->getVariable('priceDisplay')->value>=0&&$_smarty_tpl->getVariable('priceDisplay')->value<=2){?>
									<?php if ($_smarty_tpl->getVariable('productPriceWithoutRedution')->value>$_smarty_tpl->getVariable('productPrice')->value){?>
										<span id="old_price_display"><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('productPriceWithoutRedution')->value),$_smarty_tpl);?>
</span>
										<?php if ($_smarty_tpl->getVariable('tax_enabled')->value){?>
											<?php if ($_smarty_tpl->getVariable('priceDisplay')->value==1){?><?php echo smartyTranslate(array('s'=>'tax excl.'),$_smarty_tpl);?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'tax incl.'),$_smarty_tpl);?>
<?php }?>
										<?php }?>
									<?php }?>
								<?php }?>
								</span>
							</p>
						<?php }?>

						<span class="our_price_display">
							<?php if ($_smarty_tpl->getVariable('priceDisplay')->value>=0&&$_smarty_tpl->getVariable('priceDisplay')->value<=2){?>
								<span id="our_price_display"><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('productPrice')->value),$_smarty_tpl);?>
</span>
								<?php if ($_smarty_tpl->getVariable('tax_enabled')->value){?>
									<?php echo smartyTranslate(array('s'=>'tax incl.'),$_smarty_tpl);?>

								<?php }else{ ?>
									<?php echo smartyTranslate(array('s'=>'tax excl.'),$_smarty_tpl);?>

								<?php }?>
							<?php }?>
						</span>
						<?php if ($_smarty_tpl->getVariable('priceDisplay')->value==2){?>
							<br />
							<span id="pretaxe_price"><span id="pretaxe_price_display"><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('product')->value->getPrice(false,@NULL)),$_smarty_tpl);?>
</span>&nbsp;<?php echo smartyTranslate(array('s'=>'tax excl.'),$_smarty_tpl);?>
</span>
						<?php }?>

						<?php if ($_smarty_tpl->getVariable('product')->value->getPourcentOfReduction()>0&&$_smarty_tpl->getVariable('prix_barre')->value=='true'){?>
							<div class="getPourcentOfReduction">
								-<?php echo $_smarty_tpl->getVariable('product')->value->getPourcentOfReduction();?>
%
							</div>
						<?php }?>
						<div class="clear"></div>
					</div>
				</div>
				<?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction_type']=='percentage'){?>
					<p id="reduction_percent"><?php echo smartyTranslate(array('s'=>'(price reduced by'),$_smarty_tpl);?>
 <span id="reduction_percent_display"><?php echo $_smarty_tpl->getVariable('product')->value->specificPrice['reduction']*100;?>
</span> %<?php echo smartyTranslate(array('s'=>')'),$_smarty_tpl);?>
</p>
				<?php }?>
				<?php if (count($_smarty_tpl->getVariable('packItems')->value)){?>
					<p class="pack_price"><?php echo smartyTranslate(array('s'=>'instead of'),$_smarty_tpl);?>
 <span style="text-decoration: line-through;"><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('product')->value->getNoPackPrice()),$_smarty_tpl);?>
</span></p>
					<br class="clear" />
				<?php }?>
				<?php if ($_smarty_tpl->getVariable('product')->value->ecotax!=0){?>
					<p class="price-ecotax"><?php echo smartyTranslate(array('s'=>'include'),$_smarty_tpl);?>
 <span id="ecotax_price_display"><?php if ($_smarty_tpl->getVariable('priceDisplay')->value==2){?><?php echo Product::convertAndFormatPrice($_smarty_tpl->getVariable('ecotax_tax_exc')->value);?>
<?php }else{ ?><?php echo Product::convertAndFormatPrice($_smarty_tpl->getVariable('ecotax_tax_inc')->value);?>
<?php }?></span> <?php echo smartyTranslate(array('s'=>'for green tax'),$_smarty_tpl);?>

						<?php if ($_smarty_tpl->getVariable('product')->value->specificPrice&&$_smarty_tpl->getVariable('product')->value->specificPrice['reduction']){?>
						<br /><?php echo smartyTranslate(array('s'=>'(not impacted by the discount)'),$_smarty_tpl);?>

						<?php }?>
					</p>
				<?php }?>
				<?php if (!empty($_smarty_tpl->getVariable('product',null,true,false)->value->unity)&&$_smarty_tpl->getVariable('product')->value->unit_price_ratio>0.000000){?>
				    <?php echo smarty_function_math(array('equation'=>"pprice / punit_price",'pprice'=>$_smarty_tpl->getVariable('productPrice')->value,'punit_price'=>$_smarty_tpl->getVariable('product')->value->unit_price_ratio,'assign'=>'unit_price'),$_smarty_tpl);?>

					<p class="unit-price"><span id="unit_price_display"><?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('unit_price')->value),$_smarty_tpl);?>
</span> <?php echo smartyTranslate(array('s'=>'per'),$_smarty_tpl);?>
 <?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->unity,'htmlall','UTF-8');?>
</p>
				<?php }?>
			<?php }?>

			<?php if (isset($_smarty_tpl->getVariable('groups',null,true,false)->value)){?>
			<!-- attributes -->
			<div id="attributes">
			<?php  $_smarty_tpl->tpl_vars['group'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_attribute_group'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('groups')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['group']->key => $_smarty_tpl->tpl_vars['group']->value){
 $_smarty_tpl->tpl_vars['id_attribute_group']->value = $_smarty_tpl->tpl_vars['group']->key;
?>
			<?php if (count($_smarty_tpl->tpl_vars['group']->value['attributes'])){?>
			<p>
				<label for="group_<?php echo intval($_smarty_tpl->tpl_vars['id_attribute_group']->value);?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['group']->value['name'],'htmlall','UTF-8');?>
 :</label>
				<?php $_smarty_tpl->tpl_vars["groupName"] = new Smarty_variable("group_".($_smarty_tpl->tpl_vars['id_attribute_group']->value), null, null);?>
				<select name="<?php echo $_smarty_tpl->getVariable('groupName')->value;?>
" id="group_<?php echo intval($_smarty_tpl->tpl_vars['id_attribute_group']->value);?>
" onchange="javascript:findCombination();<?php if (count($_smarty_tpl->getVariable('colors')->value)>0){?>$('#wrapResetImages').show('slow');<?php }?>;">
					<?php  $_smarty_tpl->tpl_vars['group_attribute'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_attribute'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['group']->value['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['group_attribute']->key => $_smarty_tpl->tpl_vars['group_attribute']->value){
 $_smarty_tpl->tpl_vars['id_attribute']->value = $_smarty_tpl->tpl_vars['group_attribute']->key;
?>
						<option value="<?php echo intval($_smarty_tpl->tpl_vars['id_attribute']->value);?>
"<?php if ((isset($_GET[$_smarty_tpl->getVariable('groupName',null,true,false)->value])&&intval($_GET[$_smarty_tpl->getVariable('groupName')->value])==$_smarty_tpl->tpl_vars['id_attribute']->value)||$_smarty_tpl->tpl_vars['group']->value['default']==$_smarty_tpl->tpl_vars['id_attribute']->value){?> selected="selected"<?php }?> title="<?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['group_attribute']->value,'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['group_attribute']->value,'htmlall','UTF-8');?>
</option>
					<?php }} ?>
				</select>
			</p>
			<?php }?>
			<?php }} ?>
			</div>
			<?php }?>

			<?php if (isset($_smarty_tpl->getVariable('colors',null,true,false)->value)&&$_smarty_tpl->getVariable('colors')->value){?>
			<!-- colors -->
			<div id="color_picker">
				<p><?php echo smartyTranslate(array('s'=>'Pick a color:','js'=>1),$_smarty_tpl);?>
</p>
				<div class="clear"></div>
				<ul id="color_to_pick_list">
				<?php  $_smarty_tpl->tpl_vars['color'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['id_attribute'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('colors')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['color']->key => $_smarty_tpl->tpl_vars['color']->value){
 $_smarty_tpl->tpl_vars['id_attribute']->value = $_smarty_tpl->tpl_vars['color']->key;
?>
					<li><a id="color_<?php echo intval($_smarty_tpl->tpl_vars['id_attribute']->value);?>
" class="color_pick" style="background: <?php echo $_smarty_tpl->tpl_vars['color']->value['value'];?>
;" onclick="updateColorSelect(<?php echo intval($_smarty_tpl->tpl_vars['id_attribute']->value);?>
);$('#wrapResetImages').show('slow');" title="<?php echo $_smarty_tpl->tpl_vars['color']->value['name'];?>
"><?php if (file_exists((($_smarty_tpl->getVariable('col_img_dir')->value).($_smarty_tpl->tpl_vars['id_attribute']->value)).('.jpg'))){?><img src="<?php echo $_smarty_tpl->getVariable('img_col_dir')->value;?>
<?php echo $_smarty_tpl->tpl_vars['id_attribute']->value;?>
.jpg" alt="<?php echo $_smarty_tpl->tpl_vars['color']->value['name'];?>
" width="20" height="20" /><?php }?></a></li>
				<?php }} ?>
				</ul>
				<div class="clear"></div>
			</div>
			<?php }?>

			<!-- availability -->
			<p id="availability_statut"<?php if (($_smarty_tpl->getVariable('product')->value->quantity==0&&!$_smarty_tpl->getVariable('product')->value->available_later)||($_smarty_tpl->getVariable('product')->value->quantity!=0&&!$_smarty_tpl->getVariable('product')->value->available_now)){?> style="display:none;"<?php }?>>
				<span id="availability_label"><?php echo smartyTranslate(array('s'=>'Availability:'),$_smarty_tpl);?>
</span>
				<span id="availability_value"<?php if ($_smarty_tpl->getVariable('product')->value->quantity==0){?> class="warning-inline"<?php }?>>
					<?php if ($_smarty_tpl->getVariable('product')->value->quantity==0){?><?php if ($_smarty_tpl->getVariable('allow_oosp')->value){?><?php echo $_smarty_tpl->getVariable('product')->value->available_later;?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'This product is no longer in stock'),$_smarty_tpl);?>
<?php }?><?php }else{ ?><?php echo $_smarty_tpl->getVariable('product')->value->available_now;?>
<?php }?>
				</span>
			</p>

			<!-- Out of stock hook -->
			<p id="oosHook"<?php if ($_smarty_tpl->getVariable('product')->value->quantity>0){?> style="display: none;"<?php }?>>
				<?php echo $_smarty_tpl->getVariable('HOOK_PRODUCT_OOS')->value;?>

			</p>

			<p class="warning_inline" id="last_quantities"<?php if (($_smarty_tpl->getVariable('product')->value->quantity>$_smarty_tpl->getVariable('last_qties')->value||$_smarty_tpl->getVariable('product')->value->quantity==0)||$_smarty_tpl->getVariable('allow_oosp')->value||!$_smarty_tpl->getVariable('product')->value->available_for_order||$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?> style="display: none;"<?php }?> ><?php echo smartyTranslate(array('s'=>'Warning: Last items in stock!'),$_smarty_tpl);?>
</p>

			<div id="infostock"<?php if ($_smarty_tpl->getVariable('product')->value->quantity==0){?> class="off"<?php }?>><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('stores.php');?>
"></a></div>

			<div id="buy">
				<!-- quantity wanted -->
				<p id="quantity_wanted_p"<?php if ((!$_smarty_tpl->getVariable('allow_oosp')->value&&$_smarty_tpl->getVariable('product')->value->quantity==0)||$_smarty_tpl->getVariable('virtual')->value){?> style="display:none;"<?php }?>>
					<a class="up" href=""></a>
					<input type="text" data-maxqty="<?php echo intval($_smarty_tpl->getVariable('product')->value->quantity);?>
" name="qty" id="quantity_wanted" class="text" value="<?php if (isset($_smarty_tpl->getVariable('quantityBackup',null,true,false)->value)){?><?php echo intval($_smarty_tpl->getVariable('quantityBackup')->value);?>
<?php }else{ ?>1<?php }?>" size="2" maxlength="3" />
					<a class="down" href=""></a>
				</p>

				<p<?php if ((!$_smarty_tpl->getVariable('allow_oosp')->value&&$_smarty_tpl->getVariable('product')->value->quantity<=0)||!$_smarty_tpl->getVariable('product')->value->available_for_order||(isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->getVariable('restricted_country_mode')->value)||$_smarty_tpl->getVariable('PS_CATALOG_MODE')->value){?> style="display: none;"<?php }?> id="add_to_cart" class="buttons_bottom_block"><input type="submit" name="Submit" value="<?php echo smartyTranslate(array('s'=>'Add to cart'),$_smarty_tpl);?>
" class="exclusive" /></p>

				<?php if (isset($_smarty_tpl->getVariable('HOOK_PRODUCT_ACTIONS',null,true,false)->value)&&$_smarty_tpl->getVariable('HOOK_PRODUCT_ACTIONS')->value){?><?php echo $_smarty_tpl->getVariable('HOOK_PRODUCT_ACTIONS')->value;?>
<?php }?>

				<div class="clear"></div>
			</div>

			<!-- usefull links-->
			<ul class="clear" id="usefull_link_block">
				<?php if ($_smarty_tpl->getVariable('HOOK_EXTRA_LEFT')->value){?><?php echo $_smarty_tpl->getVariable('HOOK_EXTRA_LEFT')->value;?>
<?php }?>
				<li class="print"><a href="javascript:print();"><?php echo smartyTranslate(array('s'=>'Print'),$_smarty_tpl);?>
</a></li>
				<li class="facebook"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo urlencode($_smarty_tpl->getVariable('product')->value->getLink());?>
&t=<?php echo urlencode(smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name,'htmlall','UTF-8'));?>
&src=sp"><?php echo smartyTranslate(array('s'=>'Facebook'),$_smarty_tpl);?>
</a></li>
				<li class="email"><a href="mailto:?subject=<?php echo urlencode(smarty_modifier_escape($_smarty_tpl->getVariable('product')->value->name,'htmlall','UTF-8'));?>
&body=<?php echo smartyTranslate(array('s'=>'A interresting product for you'),$_smarty_tpl);?>
%0A%0A<?php echo urlencode($_smarty_tpl->getVariable('product')->value->getLink());?>
"><?php echo smartyTranslate(array('s'=>'Email'),$_smarty_tpl);?>
</a></li>
				<div class="clear"></div>
			</ul>

			<?php if ($_smarty_tpl->getVariable('product')->value->online_only){?>
				<p><?php echo smartyTranslate(array('s'=>'Online only'),$_smarty_tpl);?>
</p>
			<?php }?>
		</form>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('HOOK_EXTRA_RIGHT')->value){?><?php echo $_smarty_tpl->getVariable('HOOK_EXTRA_RIGHT')->value;?>
<?php }?>
		
		<span class="hidden" itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
			<meta itemprop="currency" content="EUR" />
			<span class="hidden" itemprop="price"><?php echo smarty_modifier_replace($_smarty_tpl->getVariable('productPrice')->value,'.',',');?>
</span>
			<span itemprop="condition" content="new"></span>
			<span itemprop="availability" content="<?php if ($_smarty_tpl->getVariable('product')->value->quantity==0){?>instore_only<?php }else{ ?>in_stock<?php }?>"></span>
		</span>
		
		<?php if ($_smarty_tpl->getVariable('quantity_discounts')->value){?>
		<!-- quantity discount -->
		<ul class="idTabs">
			<li><a style="cursor: pointer" class="selected"><?php echo smartyTranslate(array('s'=>'Quantity discount'),$_smarty_tpl);?>
</a></li>
		</ul>
		<div id="quantityDiscount">
			<table class="std">
				<thead>
					<tr>
						<th><?php echo smartyTranslate(array('s'=>'quantity'),$_smarty_tpl);?>
</th>
						<th><?php echo smartyTranslate(array('s'=>'Prix unitaire'),$_smarty_tpl);?>
</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<?php  $_smarty_tpl->tpl_vars['quantity_discount'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('quantity_discounts')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['quantity_discount']->key => $_smarty_tpl->tpl_vars['quantity_discount']->value){
?>
							<tr>
								<td>
									<?php echo intval($_smarty_tpl->tpl_vars['quantity_discount']->value['quantity']);?>
&nbsp;

									<?php if (intval($_smarty_tpl->tpl_vars['quantity_discount']->value['quantity'])>1){?>
										<?php echo smartyTranslate(array('s'=>'quantities'),$_smarty_tpl);?>

									<?php }else{ ?>
										<?php echo smartyTranslate(array('s'=>'quantity'),$_smarty_tpl);?>

									<?php }?>
								</td>
								<td>
									<?php if ($_smarty_tpl->tpl_vars['quantity_discount']->value['price']!=0||$_smarty_tpl->tpl_vars['quantity_discount']->value['reduction_type']=='amount'){?>
										<span class="hidden convert"><?php echo $_smarty_tpl->getVariable('productPriceWithoutRedution')->value;?>
 - <?php echo $_smarty_tpl->tpl_vars['quantity_discount']->value['real_value'];?>
</span>
										<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('productPriceWithoutRedution')->value-$_smarty_tpl->tpl_vars['quantity_discount']->value['real_value']),$_smarty_tpl);?>

									<?php }else{ ?>
										<span class="hidden notconvert"></span>
					    				-<?php echo $_smarty_tpl->getVariable('productPriceWithoutRedution')->value-floatval($_smarty_tpl->tpl_vars['quantity_discount']->value['real_value']);?>
%
									<?php }?>
								</td>
							</tr>
						<?php }} ?>
					</tr>
				</tbody>
			</table>
		</div>
		<?php }?>
	</div>
</div>

<?php if (count($_smarty_tpl->getVariable('packItems')->value)>0){?>
	<div>
		<h2><?php echo smartyTranslate(array('s'=>'Pack content'),$_smarty_tpl);?>
</h2>
		<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./product-list.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
$_template->assign('products',$_smarty_tpl->getVariable('packItems')->value); echo $_template->getRenderedTemplate();?><?php unset($_template);?>
	</div>
<?php }?>

<!-- description and features -->
<div id="more_info_block" class="clear">
	<div id="more_info_sheets" class="sheets align_justify">
		<?php if ($_smarty_tpl->getVariable('product')->value->description){?>
			<h2 id="more_info_tabs"><?php echo smartyTranslate(array('s'=>'More info'),$_smarty_tpl);?>
</h2>

			<!-- full description -->
			<div id="idTab1" class="rte">
				<span itemprop="description"><?php echo $_smarty_tpl->getVariable('product')->value->description;?>
</span>
				<?php if ($_smarty_tpl->getVariable('product')->value->id_manufacturer&&$_smarty_tpl->getVariable('image_manufacturer')->value!=''){?>
					<span class="hidden" itemprop="brand"><?php echo $_smarty_tpl->getVariable('product_manufacturer')->value->name;?>
</span>
					<img class="product_manufacturer" src="<?php echo $_smarty_tpl->getVariable('img_manu_dir')->value;?>
<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('image_manufacturer')->value,'htmlall','UTF-8');?>
-manuProduct.jpg" alt="<?php echo $_smarty_tpl->getVariable('product_manufacturer')->value->name;?>
" title="<?php echo $_smarty_tpl->getVariable('product_manufacturer')->value->name;?>
" width="<?php echo $_smarty_tpl->getVariable('manuProductSize')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('manuProductSize')->value['height'];?>
" />
				<?php }?>
			</div>
		<?php }?>

		<?php echo $_smarty_tpl->getVariable('HOOK_PRODUCT_TAB_TOP')->value;?>


		<?php if ($_smarty_tpl->getVariable('features')->value){?>
			<h2><?php echo smartyTranslate(array('s'=>'Data sheet'),$_smarty_tpl);?>
</h2>

			<div class="features">
				<!-- product's features -->
				<ul id="idTab2" class="bullet">
				<?php  $_smarty_tpl->tpl_vars['feature'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('features')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['feature']->key => $_smarty_tpl->tpl_vars['feature']->value){
?>
					<li><span><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['feature']->value['name'],'htmlall','UTF-8');?>
</span> <?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['feature']->value['value'],'htmlall','UTF-8');?>
</li>
				<?php }} ?>
				</ul>
			</div>
		<?php }?>
		<?php if ($_smarty_tpl->getVariable('attachments')->value){?>
			<h2><?php echo smartyTranslate(array('s'=>'Download'),$_smarty_tpl);?>
</h2>

			<ul id="idTab9" class="bullet">
			<?php  $_smarty_tpl->tpl_vars['attachment'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('attachments')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['attachment']->key => $_smarty_tpl->tpl_vars['attachment']->value){
?>
				<li><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('attachment.php');?>
?id_attachment=<?php echo $_smarty_tpl->tpl_vars['attachment']->value['id_attachment'];?>
"><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['attachment']->value['name'],'htmlall','UTF-8');?>
</a><br /><?php echo smarty_modifier_escape($_smarty_tpl->tpl_vars['attachment']->value['description'],'htmlall','UTF-8');?>
</li>
			<?php }} ?>
			</ul>
		<?php }?>

		<?php echo $_smarty_tpl->getVariable('HOOK_PRODUCT_TAB_CONTENT')->value;?>

	</div>
</div>

<?php echo $_smarty_tpl->getVariable('HOOK_PRODUCT_FOOTER')->value;?>


<!-- Customizable products -->
<?php if ($_smarty_tpl->getVariable('product')->value->customizable){?>
	<ul class="idTabs">
		<li><a style="cursor: pointer"><?php echo smartyTranslate(array('s'=>'Product customization'),$_smarty_tpl);?>
</a></li>
	</ul>
	<div class="customization_block">
		<form method="post" action="<?php echo $_smarty_tpl->getVariable('customizationFormTarget')->value;?>
" enctype="multipart/form-data" id="customizationForm">
			<p>
				<img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/infos.gif" alt="Informations" />
				<?php echo smartyTranslate(array('s'=>'After saving your customized product, remember to add it to your cart.'),$_smarty_tpl);?>

				<?php if ($_smarty_tpl->getVariable('product')->value->uploadable_files){?><br /><?php echo smartyTranslate(array('s'=>'Allowed file formats are: GIF, JPG, PNG'),$_smarty_tpl);?>
<?php }?>
			</p>
			<?php if (intval($_smarty_tpl->getVariable('product')->value->uploadable_files)){?>
			<h2><?php echo smartyTranslate(array('s'=>'Pictures'),$_smarty_tpl);?>
</h2>
			<ul id="uploadable_files">
				<?php echo smarty_function_counter(array('start'=>0,'assign'=>'customizationField'),$_smarty_tpl);?>

				<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customizationFields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customizationFields']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customizationFields']['index']++;
?>
					<?php if ($_smarty_tpl->tpl_vars['field']->value['type']==0){?>
						<li class="customizationUploadLine<?php if ($_smarty_tpl->tpl_vars['field']->value['required']){?> required<?php }?>"><?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(((('pictures_').($_smarty_tpl->getVariable('product')->value->id)).('_')).($_smarty_tpl->tpl_vars['field']->value['id_customization_field']), null, null);?>
							<?php if (isset($_smarty_tpl->getVariable('pictures',null,true,false)->value[$_smarty_tpl->getVariable('key',null,true,false)->value])){?><div class="customizationUploadBrowse"><img src="<?php echo $_smarty_tpl->getVariable('pic_dir')->value;?>
<?php echo $_smarty_tpl->getVariable('pictures')->value[$_smarty_tpl->getVariable('key')->value];?>
_small" alt="" /><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getUrlWith('deletePicture',$_smarty_tpl->tpl_vars['field']->value['id_customization_field']);?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s'=>'Delete'),$_smarty_tpl);?>
" class="customization_delete_icon" width="11" height="13" /></a></div><?php }?>
							<div class="customizationUploadBrowse"><input type="file" name="file<?php echo $_smarty_tpl->tpl_vars['field']->value['id_customization_field'];?>
" id="img<?php echo $_smarty_tpl->getVariable('customizationField')->value;?>
" class="customization_block_input <?php if (isset($_smarty_tpl->getVariable('pictures',null,true,false)->value[$_smarty_tpl->getVariable('key',null,true,false)->value])){?>filled<?php }?>" /><?php if ($_smarty_tpl->tpl_vars['field']->value['required']){?><sup>*</sup><?php }?>
							<div class="customizationUploadBrowseDescription"><?php if (!empty($_smarty_tpl->tpl_vars['field']->value['name'])){?><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
<?php }else{ ?><?php echo smartyTranslate(array('s'=>'Please select an image file from your hard drive'),$_smarty_tpl);?>
<?php }?></div></div>
						</li>
						<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

					<?php }?>
				<?php }} ?>
			</ul>
			<?php }?>
			<div class="clear"></div>
			<?php if (intval($_smarty_tpl->getVariable('product')->value->text_fields)){?>
			<h2><?php echo smartyTranslate(array('s'=>'Texts'),$_smarty_tpl);?>
</h2>
			<ul id="text_fields">
				<?php echo smarty_function_counter(array('start'=>0,'assign'=>'customizationField'),$_smarty_tpl);?>

				<?php  $_smarty_tpl->tpl_vars['field'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('customizationFields')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customizationFields']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['field']->key => $_smarty_tpl->tpl_vars['field']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['customizationFields']['index']++;
?>
					<?php if ($_smarty_tpl->tpl_vars['field']->value['type']==1){?>
						<li class="customizationUploadLine<?php if ($_smarty_tpl->tpl_vars['field']->value['required']){?> required<?php }?>"><?php $_smarty_tpl->tpl_vars['key'] = new Smarty_variable(((('textFields_').($_smarty_tpl->getVariable('product')->value->id)).('_')).($_smarty_tpl->tpl_vars['field']->value['id_customization_field']), null, null);?>
							<?php if (!empty($_smarty_tpl->tpl_vars['field']->value['name'])){?><?php echo $_smarty_tpl->tpl_vars['field']->value['name'];?>
<?php }?><?php if ($_smarty_tpl->tpl_vars['field']->value['required']){?><sup>*</sup><?php }?><textarea type="text" name="textField<?php echo $_smarty_tpl->tpl_vars['field']->value['id_customization_field'];?>
" id="textField<?php echo $_smarty_tpl->getVariable('customizationField')->value;?>
" rows="1" cols="40" class="customization_block_input" /><?php if (isset($_smarty_tpl->getVariable('textFields',null,true,false)->value[$_smarty_tpl->getVariable('key',null,true,false)->value])){?><?php echo stripslashes($_smarty_tpl->getVariable('textFields')->value[$_smarty_tpl->getVariable('key')->value]);?>
<?php }?></textarea>
						</li>
						<?php echo smarty_function_counter(array(),$_smarty_tpl);?>

					<?php }?>
				<?php }} ?>
			</ul>
			<?php }?>
			<p style="clear: left;" id="customizedDatas">
				<input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
				<input type="hidden" name="submitCustomizedDatas" value="1" />
				<input type="button" class="button" value="<?php echo smartyTranslate(array('s'=>'Save'),$_smarty_tpl);?>
" onclick="javascript:saveCustomization()" />
				<span id="ajax-loader" style="display:none"><img src="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
loader.gif" alt="loader" /></span>
			</p>
		</form>
		<p class="clear required"><sup>*</sup> <?php echo smartyTranslate(array('s'=>'required fields'),$_smarty_tpl);?>
</p>
	</div>
<?php }?>

<?php }?>


<script type="text/javascript">
	$('a.zoombox').zoombox();

	$('#quantity_wanted_p .up').live( 'click', function(){
		var $this = $(this);
		var $input = $this.parent().find('input.text');

		var maxQTY = $input.data('maxqty');
		var currentQTY = parseInt( $input.val() );

		if ( currentQTY < maxQTY ) {
			$input.val( currentQTY + 1 );
		}

		return false;
	});

	$('#quantity_wanted_p .down').live( 'click', function(){
		var $this = $(this);
		var $input = $this.parent().find('input.text');

		var minQTY = 1;
		var currentQTY = parseInt( $input.val() );

		if ( currentQTY > minQTY ) {
			$input.val( currentQTY - 1 );
		}

		return false;
	});

	$('#quantity_wanted_p input.text').live( 'keyup', function(){
		var $this = $(this);
		var $input = $this.parent().find('input.text');

		var minQTY = 1;
		var maxQTY = parseInt( $input.data('maxqty') );

		var currentQTY = parseInt( $input.val() );

		if ( currentQTY < minQTY ) {
			$input.val( minQTY );
		}
		else if ( currentQTY > maxQTY ) {
			$input.val( maxQTY );
		}
		else {
			$input.val( currentQTY );
		}

	});
</script>
