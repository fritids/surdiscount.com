<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 2, false),array('modifier', 'html_entity_decode', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 7, false),array('modifier', 'floatval', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 8, false),array('modifier', 'intval', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 9, false),array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 24, false),array('modifier', 'default', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 26, false),array('modifier', 'date_format', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 33, false),array('modifier', 'cat', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 45, false),array('modifier', 'addslashes', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 77, false),array('modifier', 'htmlspecialchars', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 121, false),array('modifier', 'convertAndFormatPrice', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 184, false),array('modifier', 'urlencode', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 272, false),array('modifier', 'stripslashes', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 428, false),array('function', 'l', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 67, false),array('function', 'math', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 117, false),array('function', 'convertPrice', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 162, false),array('function', 'counter', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/product.tpl', 407, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./errors.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (count($this->_tpl_vars['errors']) == 0): ?>
<script type="text/javascript">
// <![CDATA[

// PrestaShop internal settings
var currencySign = '<?php echo ((is_array($_tmp=$this->_tpl_vars['currencySign'])) ? $this->_run_mod_handler('html_entity_decode', true, $_tmp, 2, "UTF-8") : html_entity_decode($_tmp, 2, "UTF-8")); ?>
';
var currencyRate = '<?php echo ((is_array($_tmp=$this->_tpl_vars['currencyRate'])) ? $this->_run_mod_handler('floatval', true, $_tmp) : floatval($_tmp)); ?>
';
var currencyFormat = '<?php echo ((is_array($_tmp=$this->_tpl_vars['currencyFormat'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
';
var currencyBlank = '<?php echo ((is_array($_tmp=$this->_tpl_vars['currencyBlank'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
';
var taxRate = <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->tax_rate)) ? $this->_run_mod_handler('floatval', true, $_tmp) : floatval($_tmp)); ?>
;
var defaultTaxRate = <?php if (isset ( $this->_tpl_vars['default_product_tax'] ) && $this->_tpl_vars['default_product_tax']): ?><?php echo $this->_tpl_vars['default_product_tax']; ?>
<?php else: ?>0<?php endif; ?>;
var jqZoomEnabled = <?php if ($this->_tpl_vars['jqZoomEnabled']): ?>true<?php else: ?>false<?php endif; ?>;

//JS Hook
var oosHookJsCodeFunctions = new Array();

// Parameters
var id_product = '<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
';
var productHasAttributes = <?php if (isset ( $this->_tpl_vars['groups'] )): ?>true<?php else: ?>false<?php endif; ?>;
var quantitiesDisplayAllowed = <?php if ($this->_tpl_vars['display_qties'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
var quantityAvailable = <?php if ($this->_tpl_vars['display_qties'] == 1 && $this->_tpl_vars['product']->quantity): ?><?php echo $this->_tpl_vars['product']->quantity; ?>
<?php else: ?>0<?php endif; ?>;
var allowBuyWhenOutOfStock = <?php if ($this->_tpl_vars['allow_oosp'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
var availableNowValue = '<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->available_now)) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes', 'UTF-8') : smarty_modifier_escape($_tmp, 'quotes', 'UTF-8')); ?>
';
var availableLaterValue = '<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->available_later)) ? $this->_run_mod_handler('escape', true, $_tmp, 'quotes', 'UTF-8') : smarty_modifier_escape($_tmp, 'quotes', 'UTF-8')); ?>
';
var productPriceWithoutReduction = <?php echo ((is_array($_tmp=@$this->_tpl_vars['product']->getPriceWithoutReduct())) ? $this->_run_mod_handler('default', true, $_tmp, 'null') : smarty_modifier_default($_tmp, 'null')); ?>
;
var reduction_percent = <?php if ($this->_tpl_vars['product']->reduction_percent): ?><?php echo $this->_tpl_vars['product']->reduction_percent; ?>
<?php else: ?>0<?php endif; ?>;
var reduction_price = <?php if ($this->_tpl_vars['product']->reduction_percent): ?>0<?php else: ?><?php echo $this->_tpl_vars['product']->getPrice(true,@NULL,2,@NULL,true); ?>
<?php endif; ?>;
var reduction_from = '<?php echo $this->_tpl_vars['product']->reduction_from; ?>
';
var reduction_to = '<?php echo $this->_tpl_vars['product']->reduction_to; ?>
';
var group_reduction = '<?php echo $this->_tpl_vars['group_reduction']; ?>
';
var default_eco_tax = <?php echo $this->_tpl_vars['product']->ecotax; ?>
;
var currentDate = '<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')); ?>
';
var maxQuantityToAllowDisplayOfLastQuantityMessage = <?php echo $this->_tpl_vars['last_qties']; ?>
;
var noTaxForThisProduct = <?php if ($this->_tpl_vars['no_tax'] == 1): ?>true<?php else: ?>false<?php endif; ?>;
var displayPrice = <?php echo $this->_tpl_vars['priceDisplay']; ?>
;
var productReference = '<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->reference)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
';

// Customizable field
var img_ps_dir = '<?php echo $this->_tpl_vars['img_ps_dir']; ?>
';
var customizationFields = new Array();
<?php $this->assign('imgIndex', 0); ?>
<?php $this->assign('textFieldIndex', 0); ?>
<?php $_from = $this->_tpl_vars['customizationFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['customizationFields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['customizationFields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['customizationFields']['iteration']++;
?>
<?php $this->assign('key', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='pictures_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['product']->id) : smarty_modifier_cat($_tmp, $this->_tpl_vars['product']->id)))) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['field']['id_customization_field']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['field']['id_customization_field']))); ?>
	customizationFields[<?php echo ((is_array($_tmp=($this->_foreach['customizationFields']['iteration']-1))) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
] = new Array();
	customizationFields[<?php echo ((is_array($_tmp=($this->_foreach['customizationFields']['iteration']-1))) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
][0] = '<?php if (((is_array($_tmp=$this->_tpl_vars['field']['type'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)) == 0): ?>img<?php echo $this->_tpl_vars['imgIndex']++; ?>
<?php else: ?>textField<?php echo $this->_tpl_vars['textFieldIndex']++; ?>
<?php endif; ?>';
	customizationFields[<?php echo ((is_array($_tmp=($this->_foreach['customizationFields']['iteration']-1))) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
][1] = <?php if (((is_array($_tmp=$this->_tpl_vars['field']['type'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)) == 0 && $this->_tpl_vars['pictures'][$this->_tpl_vars['key']]): ?>2<?php else: ?><?php echo ((is_array($_tmp=$this->_tpl_vars['field']['required'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
<?php endif; ?>;
<?php endforeach; endif; unset($_from); ?>

// Images
var img_prod_dir = '<?php echo $this->_tpl_vars['img_prod_dir']; ?>
';
var combinationImages = new Array();
<?php $_from = $this->_tpl_vars['combinationImages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_combinationImages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_combinationImages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['combinationId'] => $this->_tpl_vars['combination']):
        $this->_foreach['f_combinationImages']['iteration']++;
?>
	combinationImages[<?php echo $this->_tpl_vars['combinationId']; ?>
] = new Array();
	<?php $_from = $this->_tpl_vars['combination']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_combinationImage'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_combinationImage']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['image']):
        $this->_foreach['f_combinationImage']['iteration']++;
?>
		combinationImages[<?php echo $this->_tpl_vars['combinationId']; ?>
][<?php echo ($this->_foreach['f_combinationImage']['iteration']-1); ?>
] = <?php echo ((is_array($_tmp=$this->_tpl_vars['image']['id_image'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
;
	<?php endforeach; endif; unset($_from); ?>
<?php endforeach; endif; unset($_from); ?>

combinationImages[0] = new Array();
<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['f_defaultImages'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['f_defaultImages']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['image']):
        $this->_foreach['f_defaultImages']['iteration']++;
?>
	combinationImages[0][<?php echo ($this->_foreach['f_defaultImages']['iteration']-1); ?>
] = <?php echo $this->_tpl_vars['image']['id_image']; ?>
;
<?php endforeach; endif; unset($_from); ?>

// Translations
var doesntExist = '<?php echo smartyTranslate(array('s' => 'The product does not exist in this model. Please choose another.','js' => 1), $this);?>
';
var doesntExistNoMore = '<?php echo smartyTranslate(array('s' => 'This product is no longer in stock','js' => 1), $this);?>
';
var doesntExistNoMoreBut = '<?php echo smartyTranslate(array('s' => 'with those attributes but is available with others','js' => 1), $this);?>
';
var uploading_in_progress = '<?php echo smartyTranslate(array('s' => 'Uploading in progress, please wait...','js' => 1), $this);?>
';
var fieldRequired = '<?php echo smartyTranslate(array('s' => 'Please fill all required fields','js' => 1), $this);?>
';


<?php if (isset ( $this->_tpl_vars['groups'] )): ?>
	// Combinations
	<?php $_from = $this->_tpl_vars['combinations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['idCombination'] => $this->_tpl_vars['combination']):
?>
		addCombination(<?php echo ((is_array($_tmp=$this->_tpl_vars['idCombination'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
, new Array(<?php echo $this->_tpl_vars['combination']['list']; ?>
), <?php echo $this->_tpl_vars['combination']['quantity']; ?>
, <?php echo $this->_tpl_vars['combination']['price']; ?>
, <?php echo $this->_tpl_vars['combination']['ecotax']; ?>
, <?php echo $this->_tpl_vars['combination']['id_image']; ?>
, '<?php echo ((is_array($_tmp=$this->_tpl_vars['combination']['reference'])) ? $this->_run_mod_handler('addslashes', true, $_tmp) : addslashes($_tmp)); ?>
');
	<?php endforeach; endif; unset($_from); ?>
	// Colors
	<?php if (count($this->_tpl_vars['colors']) > 0): ?>
		<?php if ($this->_tpl_vars['product']->id_color_default): ?>var id_color_default = <?php echo ((is_array($_tmp=$this->_tpl_vars['product']->id_color_default)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
;<?php endif; ?>
	<?php endif; ?>
<?php endif; ?>

//]]>
</script>

<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./breadcrumb.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div id="primary_block" class="clearfix">

	<h2><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</h2>
	<?php if ($this->_tpl_vars['confirmation']): ?>
	<p class="confirmation">
		<?php echo $this->_tpl_vars['confirmation']; ?>

	</p>
	<?php endif; ?>

	<!-- right infos-->
	<div id="pb-right-column">
		<!-- product img-->
		<div id="image-block">
			<?php if ($this->_tpl_vars['have_image']): ?>
				<img src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']->link_rewrite,$this->_tpl_vars['cover']['id_image'],'large'); ?>
" <?php if ($this->_tpl_vars['jqZoomEnabled']): ?>class="jqzoom" alt="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']->link_rewrite,$this->_tpl_vars['cover']['id_image'],'thickbox'); ?>
"<?php else: ?> title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" <?php endif; ?> id="bigpic" width="<?php echo $this->_tpl_vars['largeSize']['width']; ?>
" height="<?php echo $this->_tpl_vars['largeSize']['height']; ?>
" />
			<?php else: ?>
				<img src="<?php echo $this->_tpl_vars['img_prod_dir']; ?>
<?php echo $this->_tpl_vars['lang_iso']; ?>
-default-large.jpg" alt="" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
			<?php endif; ?>
			
			<div class="zoom"><span id="view_full_size" class="span_link"></span></div>
		</div>

		<?php if (count ( $this->_tpl_vars['images'] ) > 0): ?>
		<!-- thumbnails -->
		<div id="views_block" <?php if (count ( $this->_tpl_vars['images'] ) < 2): ?>class="hidden"<?php endif; ?>>
		<?php if (count ( $this->_tpl_vars['images'] ) > 3): ?><span class="view_scroll_spacer"><a id="view_scroll_left" class="hidden" title="<?php echo smartyTranslate(array('s' => 'Other views'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Previous'), $this);?>
</a></span><?php endif; ?>
		<div id="thumbs_list">
			<ul style="width: <?php echo smarty_function_math(array('equation' => "width * nbImages",'width' => 80,'nbImages' => count($this->_tpl_vars['images'])), $this);?>
px" id="thumbs_list_frame">
				<?php $_from = $this->_tpl_vars['images']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['thumbnails'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['thumbnails']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['image']):
        $this->_foreach['thumbnails']['iteration']++;
?>
				<?php $this->assign('imageIds', ($this->_tpl_vars['product']->id)."-".($this->_tpl_vars['image']['id_image'])); ?>
				<li id="thumbnail_<?php echo $this->_tpl_vars['image']['id_image']; ?>
">
					<a href="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']->link_rewrite,$this->_tpl_vars['imageIds'],'thickbox'); ?>
" class="zoombox<?php if (count ( $this->_tpl_vars['images'] ) > 1): ?> zgallery_<?php endif; ?> <?php if (($this->_foreach['thumbnails']['iteration'] <= 1)): ?>shown<?php endif; ?>" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['image']['legend'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
">
						<img id="thumb_<?php echo $this->_tpl_vars['image']['id_image']; ?>
" src="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']->link_rewrite,$this->_tpl_vars['imageIds'],'medium'); ?>
" alt="<?php echo ((is_array($_tmp=$this->_tpl_vars['image']['legend'])) ? $this->_run_mod_handler('htmlspecialchars', true, $_tmp) : htmlspecialchars($_tmp)); ?>
" height="<?php echo $this->_tpl_vars['mediumSize']['height']; ?>
" width="<?php echo $this->_tpl_vars['mediumSize']['width']; ?>
" />
					</a>
				</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
		<?php if (count ( $this->_tpl_vars['images'] ) > 3): ?><a id="view_scroll_right" title="<?php echo smartyTranslate(array('s' => 'Other views'), $this);?>
" href="javascript:{}"><?php echo smartyTranslate(array('s' => 'Next'), $this);?>
</a><?php endif; ?>
		</div>
		<?php endif; ?>
		<?php if (count ( $this->_tpl_vars['images'] ) > 1): ?><p class="align_center clear"><span id="wrapResetImages" style="display:none;"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/cancel_16x18.gif" alt="<?php echo smartyTranslate(array('s' => 'Cancel'), $this);?>
" width="16" height="18"/> <a id="resetImages" href="<?php echo $this->_tpl_vars['link']->getProductLink($this->_tpl_vars['product']); ?>
" onclick="$('span#wrapResetImages').hide('slow');return (false);"><?php echo smartyTranslate(array('s' => 'Display all pictures'), $this);?>
</a></span></p><?php endif; ?>
	</div>

	<!-- left infos-->
	<div id="pb-left-column">
		<!-- add to cart form-->
		<form id="buy_block" action="<?php echo $this->_tpl_vars['base_dir']; ?>
cart.php" method="post">
			<!-- hidden datas -->
			<p class="hidden">
				<input type="hidden" name="token" value="<?php echo $this->_tpl_vars['static_token']; ?>
" />
				<input type="hidden" name="id_product" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->id)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" id="product_page_product_id" />
				<input type="hidden" name="add" value="1" />
				<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
			</p>

			<!-- prices -->
			<p class="price">
				<?php $this->assign('prix_barre', 'false'); ?>

				<?php if ($this->_tpl_vars['product']->on_sale): ?>
					<img src="<?php echo $this->_tpl_vars['img_dir']; ?>
onsale_<?php echo $this->_tpl_vars['lang_iso']; ?>
.gif" alt="<?php echo smartyTranslate(array('s' => 'On sale'), $this);?>
" class="on_sale_img"/>
					<span class="on_sale"><?php echo smartyTranslate(array('s' => 'On sale!'), $this);?>
</span>
				<?php elseif (( $this->_tpl_vars['product']->reduction_price != 0 || $this->_tpl_vars['product']->reduction_percent != 0 ) && ( $this->_tpl_vars['product']->reduction_from == $this->_tpl_vars['product']->reduction_to || ( ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) <= $this->_tpl_vars['product']->reduction_to && ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) >= $this->_tpl_vars['product']->reduction_from ) )): ?>
					<span class="discount"><?php echo smartyTranslate(array('s' => 'Price lowered!'), $this);?>
</span>
					<?php $this->assign('prix_barre', 'true'); ?>
				<?php endif; ?>

				<div id="info_price">
					<?php if (( $this->_tpl_vars['product']->reduction_price != 0 || $this->_tpl_vars['product']->reduction_percent != 0 ) && ( $this->_tpl_vars['product']->reduction_from == $this->_tpl_vars['product']->reduction_to || ( ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) <= $this->_tpl_vars['product']->reduction_to && ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) >= $this->_tpl_vars['product']->reduction_from ) )): ?>
						<p id="old_price"><span class="bold">
							<?php if (! $this->_tpl_vars['priceDisplay'] || $this->_tpl_vars['priceDisplay'] == 2): ?>
								<span id="old_price_display"><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']->getPriceWithoutReduct()), $this);?>
</span>
									<?php if ($this->_tpl_vars['tax_enabled']): ?><?php echo smartyTranslate(array('s' => 'tax incl.'), $this);?>
<?php endif; ?>
								</span>
							<?php endif; ?>
	
							<?php if ($this->_tpl_vars['priceDisplay'] == 1): ?>
								<span id="old_price_display"><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']->getPriceWithoutReduct(true)), $this);?>
</span>
									<?php if ($this->_tpl_vars['tax_enabled']): ?><?php echo smartyTranslate(array('s' => 'tax excl.'), $this);?>
<?php endif; ?>
								</span>
							<?php endif; ?>
						</p>
					<?php endif; ?>
				</p>
	
				<?php if ($this->_tpl_vars['product']->reduction_percent != 0 && ( $this->_tpl_vars['product']->reduction_from == $this->_tpl_vars['product']->reduction_to || ( ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) <= $this->_tpl_vars['product']->reduction_to && ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%Y-%m-%d %H:%M:%S') : smarty_modifier_date_format($_tmp, '%Y-%m-%d %H:%M:%S')) >= $this->_tpl_vars['product']->reduction_from ) )): ?>
					<p id="reduction_percent"><?php echo smartyTranslate(array('s' => '(price reduced by'), $this);?>
 <span id="reduction_percent_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->reduction_percent)) ? $this->_run_mod_handler('floatval', true, $_tmp) : floatval($_tmp)); ?>
</span> %<?php echo smartyTranslate(array('s' => ')'), $this);?>
</p>
				<?php endif; ?>
				<?php if (count($this->_tpl_vars['packItems'])): ?>
					<p class="pack_price"><?php echo smartyTranslate(array('s' => 'instead of'), $this);?>
 <span style="text-decoration: line-through;"><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']->getNoPackPrice()), $this);?>
</span></p>
					<br class="clear" />
				<?php endif; ?>
				<?php if ($this->_tpl_vars['product']->ecotax != 0): ?>
					<p class="price-ecotax"><?php echo smartyTranslate(array('s' => 'include'), $this);?>
 <span id="ecotax_price_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->ecotax)) ? $this->_run_mod_handler('convertAndFormatPrice', true, $_tmp) : Product::convertAndFormatPrice($_tmp)); ?>
</span> <?php echo smartyTranslate(array('s' => 'for green tax'), $this);?>
</p>
				<?php endif; ?>
					
				<p class="price">
					<span class="our_price_display">
					<?php if (! $this->_tpl_vars['priceDisplay'] || $this->_tpl_vars['priceDisplay'] == 2): ?>
						<span id="our_price_display"><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']->getPrice(true,@NULL,2)), $this);?>
</span>
							<?php if ($this->_tpl_vars['tax_enabled']): ?><?php echo smartyTranslate(array('s' => 'tax incl.'), $this);?>
<?php endif; ?>
					<?php endif; ?>
					<?php if ($this->_tpl_vars['priceDisplay'] == 1): ?>
						<span id="our_price_display"><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']->getPrice(false,@NULL,2)), $this);?>
</span>
							<?php if ($this->_tpl_vars['tax_enabled']): ?><?php echo smartyTranslate(array('s' => 'tax excl.'), $this);?>
<?php endif; ?>
					<?php endif; ?>
					</span>
					<?php if ($this->_tpl_vars['priceDisplay'] == 2): ?>
						<br />
						<span id="pretaxe_price"><span id="pretaxe_price_display"><?php echo Product::convertPrice(array('price' => $this->_tpl_vars['product']->getPrice(false,@NULL)), $this);?>
</span>&nbsp;<?php echo smartyTranslate(array('s' => 'tax excl.'), $this);?>
</span>
					<?php endif; ?>
					<br />
				</p>
				
				<?php if ($this->_tpl_vars['product']->getPourcentOfReduction() > 0 && $this->_tpl_vars['prix_barre'] == 'true'): ?>
					<div class="getPourcentOfReduction">
						-<?php echo $this->_tpl_vars['product']->getPourcentOfReduction(); ?>
%
					</div>
				<?php endif; ?>
				<div class="clear"></div>
			</div>

			<?php if (isset ( $this->_tpl_vars['groups'] )): ?>
			<!-- attributes -->
			<div id="attributes">
			<?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id_attribute_group'] => $this->_tpl_vars['group']):
?>
			<?php if (count($this->_tpl_vars['group']['attributes'])): ?>
			<p>
				<label for="group_<?php echo ((is_array($_tmp=$this->_tpl_vars['id_attribute_group'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['group']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
 :</label>
				<?php $this->assign('groupName', ((is_array($_tmp='group_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['id_attribute_group']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['id_attribute_group']))); ?>
				<select name="<?php echo $this->_tpl_vars['groupName']; ?>
" id="group_<?php echo ((is_array($_tmp=$this->_tpl_vars['id_attribute_group'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" onchange="javascript:findCombination();<?php if (count($this->_tpl_vars['colors']) > 0): ?>$('#wrapResetImages').show('slow');<?php endif; ?>">
					<?php $_from = $this->_tpl_vars['group']['attributes']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id_attribute'] => $this->_tpl_vars['group_attribute']):
?>
						<option value="<?php echo ((is_array($_tmp=$this->_tpl_vars['id_attribute'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
"<?php if (( isset ( $_GET[$this->_tpl_vars['groupName']] ) && ((is_array($_tmp=$_GET[$this->_tpl_vars['groupName']])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)) == $this->_tpl_vars['id_attribute'] ) || $this->_tpl_vars['group']['default'] == $this->_tpl_vars['id_attribute']): ?> selected="selected"<?php endif; ?> title="<?php echo ((is_array($_tmp=$this->_tpl_vars['group_attribute'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['group_attribute'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</option>
					<?php endforeach; endif; unset($_from); ?>
				</select>
			</p>
			<?php endif; ?>
			<?php endforeach; endif; unset($_from); ?>
			</div>
			<?php endif; ?>

			<!-- availability -->
			<p id="availability_statut"<?php if (( $this->_tpl_vars['product']->quantity == 0 && ! $this->_tpl_vars['product']->available_later ) || ( $this->_tpl_vars['product']->quantity != 0 && ! $this->_tpl_vars['product']->available_now )): ?> style="display:none;"<?php endif; ?>>
				<span id="availability_label"><?php echo smartyTranslate(array('s' => 'Availability:'), $this);?>
</span>
				<span id="availability_value"<?php if ($this->_tpl_vars['product']->quantity == 0): ?> class="warning-inline"<?php endif; ?>>
					<?php if ($this->_tpl_vars['product']->quantity == 0): ?><?php if ($this->_tpl_vars['allow_oosp']): ?><?php echo $this->_tpl_vars['product']->available_later; ?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'This product is no longer in stock'), $this);?>
<?php endif; ?><?php else: ?><?php echo $this->_tpl_vars['product']->available_now; ?>
<?php endif; ?>
				</span>
			</p>

			<!-- number of item in stock -->
			<p id="pQuantityAvailable"<?php if ($this->_tpl_vars['display_qties'] != 1 || $this->_tpl_vars['product']->quantity == 0): ?> style="display:none;"<?php endif; ?>>
				<span id="quantityAvailable"><?php echo ((is_array($_tmp=$this->_tpl_vars['product']->quantity)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
</span>
				<span<?php if ($this->_tpl_vars['product']->quantity > 1): ?> style="display:none;"<?php endif; ?> id="quantityAvailableTxt"><?php echo smartyTranslate(array('s' => 'item in stock'), $this);?>
</span>
				<span<?php if ($this->_tpl_vars['product']->quantity == 1): ?> style="display:none;"<?php endif; ?> id="quantityAvailableTxtMultiple"><?php echo smartyTranslate(array('s' => 'items in stock'), $this);?>
</span>
			</p>
			
			<!-- Out of stock hook -->
			<p id="oosHook"<?php if ($this->_tpl_vars['product']->quantity > 0): ?> style="display:none;"<?php endif; ?>>
				<?php echo $this->_tpl_vars['HOOK_PRODUCT_OOS']; ?>

			</p>

			<p class="warning_inline" id="last_quantities"<?php if (( $this->_tpl_vars['product']->quantity > $this->_tpl_vars['last_qties'] || $this->_tpl_vars['product']->quantity == 0 ) || $this->_tpl_vars['allow_oosp']): ?> style="display:none;"<?php endif; ?> ><?php echo smartyTranslate(array('s' => 'Warning: Last items in stock!'), $this);?>
</p>

			<div id="infostock"></div>

			<div id="buy">
				<!-- quantity wanted -->
				<p id="quantity_wanted_p"<?php if (( ! $this->_tpl_vars['allow_oosp'] && $this->_tpl_vars['product']->quantity == 0 ) || $this->_tpl_vars['virtual']): ?> style="display:none;"<?php endif; ?>>
					<a class="up" href=""></a>
					<input type="text" data-maxqty="<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->quantity)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" name="qty" id="quantity_wanted" class="text" value="<?php if (isset ( $this->_tpl_vars['quantityBackup'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['quantityBackup'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
<?php else: ?>1<?php endif; ?>" size="2" maxlength="3" />
					<a class="down" href=""></a>
				</p>
	
				<p<?php if (! $this->_tpl_vars['allow_oosp'] && $this->_tpl_vars['product']->quantity == 0): ?> style="display:none;"<?php endif; ?> id="add_to_cart" class="buttons_bottom_block"><input type="submit" name="Submit" value="<?php echo smartyTranslate(array('s' => 'Add to cart'), $this);?>
" class="exclusive" /></p>

				<div class="clear"></div>
			</div>
			<!-- usefull links-->
			<ul class="clear" id="usefull_link_block">
				<?php if ($this->_tpl_vars['HOOK_EXTRA_LEFT']): ?><?php echo $this->_tpl_vars['HOOK_EXTRA_LEFT']; ?>
<?php endif; ?>
				<li class="print"><a href="javascript:print();"><?php echo smartyTranslate(array('s' => 'Print'), $this);?>
</a></li>
				<li class="facebook"><a target="_blank" href="http://www.facebook.com/sharer.php?u=<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->getLink())) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&t=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')))) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&src=sp"><?php echo smartyTranslate(array('s' => 'Facebook'), $this);?>
</a></li>
				<li class="email"><a href="mailto:?subject=<?php echo ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['product']->name)) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')))) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
&body=<?php echo smartyTranslate(array('s' => 'A interresting product for you'), $this);?>
%0A%0A<?php echo ((is_array($_tmp=$this->_tpl_vars['product']->getLink())) ? $this->_run_mod_handler('urlencode', true, $_tmp) : urlencode($_tmp)); ?>
"><?php echo smartyTranslate(array('s' => 'Email'), $this);?>
</a></li>
				<div class="clear"></div>
			</ul>

			<?php if ($this->_tpl_vars['HOOK_PRODUCT_ACTIONS']): ?>
				<?php echo $this->_tpl_vars['HOOK_PRODUCT_ACTIONS']; ?>

			<?php endif; ?>
		</form>

		<?php if ($this->_tpl_vars['product']->description_short || count($this->_tpl_vars['packItems']) > 0): ?>
		<div id="short_description_block">
			<?php if ($this->_tpl_vars['product']->description_short): ?>
				<div id="short_description_content" class="rte align_justify"><?php echo $this->_tpl_vars['product']->description_short; ?>
</div>
			<?php endif; ?>
			<?php if ($this->_tpl_vars['product']->description): ?>
			<p class="buttons_bottom_block"><a href="javascript:{}" class="button"><?php echo smartyTranslate(array('s' => 'More details'), $this);?>
</a></p>
			<?php endif; ?>
			<?php if (count($this->_tpl_vars['packItems']) > 0): ?>
				<h3><?php echo smartyTranslate(array('s' => 'Pack content'), $this);?>
</h3>
				<?php $_from = $this->_tpl_vars['packItems']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['packItem']):
?>
					<div class="pack_content">
						<?php echo $this->_tpl_vars['packItem']['pack_quantity']; ?>
 x <a href="<?php echo $this->_tpl_vars['link']->getProductLink($this->_tpl_vars['packItem']['id_product'],$this->_tpl_vars['packItem']['link_rewrite'],$this->_tpl_vars['packItem']['category'],$this->_tpl_vars['packItem']['ean13']); ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['packItem']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a>
						<p><?php echo $this->_tpl_vars['packItem']['description_short']; ?>
</p>
					</div>
				<?php endforeach; endif; unset($_from); ?>
			<?php endif; ?>
		</div>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['colors']): ?>
		<!-- colors -->
		<div id="color_picker">
			<p><?php echo smartyTranslate(array('s' => 'Pick a color:','js' => 1), $this);?>
</p>
			<div class="clear"></div>
			<ul id="color_to_pick_list">
			<?php $_from = $this->_tpl_vars['colors']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['id_attribute'] => $this->_tpl_vars['color']):
?>
				<li><a id="color_<?php echo ((is_array($_tmp=$this->_tpl_vars['id_attribute'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
" class="color_pick" style="background: <?php echo $this->_tpl_vars['color']['value']; ?>
;" onclick="updateColorSelect(<?php echo ((is_array($_tmp=$this->_tpl_vars['id_attribute'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
);$('#wrapResetImages').show('slow');" title="<?php echo $this->_tpl_vars['color']['name']; ?>
"><?php if (file_exists ( ((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['col_img_dir'])) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['id_attribute']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['id_attribute'])))) ? $this->_run_mod_handler('cat', true, $_tmp, '.jpg') : smarty_modifier_cat($_tmp, '.jpg')) )): ?><img src="<?php echo $this->_tpl_vars['img_col_dir']; ?>
<?php echo $this->_tpl_vars['id_attribute']; ?>
.jpg" alt="<?php echo $this->_tpl_vars['color']['name']; ?>
" width="20" height="20" /><?php endif; ?></a></li>
			<?php endforeach; endif; unset($_from); ?>
			</ul>
			<div class="clear"></div>
		</div>
		<?php endif; ?>

		<?php if ($this->_tpl_vars['HOOK_EXTRA_RIGHT']): ?><?php echo $this->_tpl_vars['HOOK_EXTRA_RIGHT']; ?>
<?php endif; ?>
	</div>
</div>

<?php if ($this->_tpl_vars['quantity_discounts']): ?>
<!-- quantity discount -->
<ul class="idTabs">
	<li><a style="cursor: pointer" class="selected"><?php echo smartyTranslate(array('s' => 'Quantity discount'), $this);?>
</a></li>
</ul>
<div id="quantityDiscount">
	<table class="std">
		<tr>
			<?php $_from = $this->_tpl_vars['quantity_discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['quantity_discounts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['quantity_discounts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['quantity_discount']):
        $this->_foreach['quantity_discounts']['iteration']++;
?>
				<th><?php echo ((is_array($_tmp=$this->_tpl_vars['quantity_discount']['quantity'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)); ?>
 
				<?php if (((is_array($_tmp=$this->_tpl_vars['quantity_discount']['quantity'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)) > 1): ?>
					<?php echo smartyTranslate(array('s' => 'quantities'), $this);?>

				<?php else: ?>
					<?php echo smartyTranslate(array('s' => 'quantity'), $this);?>

				<?php endif; ?>
				</th>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
		<tr>
			<?php $_from = $this->_tpl_vars['quantity_discounts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['quantity_discounts'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['quantity_discounts']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['quantity_discount']):
        $this->_foreach['quantity_discounts']['iteration']++;
?>
				<td>
				<?php if (((is_array($_tmp=$this->_tpl_vars['quantity_discount']['id_discount_type'])) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp)) == 1): ?>
					-<?php echo ((is_array($_tmp=$this->_tpl_vars['quantity_discount']['value'])) ? $this->_run_mod_handler('floatval', true, $_tmp) : floatval($_tmp)); ?>
%
				<?php else: ?>
					-<?php echo Product::convertPrice(array('price' => ((is_array($_tmp=$this->_tpl_vars['quantity_discount']['real_value'])) ? $this->_run_mod_handler('floatval', true, $_tmp) : floatval($_tmp))), $this);?>

				<?php endif; ?>
				</td>
			<?php endforeach; endif; unset($_from); ?>
		</tr>
	</table>
</div>
<?php endif; ?>

<!-- description and features -->
<?php if ($this->_tpl_vars['product']->description || $this->_tpl_vars['features'] || $this->_tpl_vars['accessories'] || $this->_tpl_vars['HOOK_PRODUCT_TAB'] || $this->_tpl_vars['attachments']): ?>
<div id="more_info_block" class="clear">
	<h2 id="more_info_tabs"><?php echo smartyTranslate(array('s' => 'More info'), $this);?>
</h2>	
	<div id="more_info_sheets" class="sheets align_justify">
		<?php if ($this->_tpl_vars['product']->description): ?>
			<!-- full description -->
			<div class="rte"><?php echo $this->_tpl_vars['product']->description; ?>
</div>
		<?php endif; ?>
		
	</div>
	
	<?php if ($this->_tpl_vars['features']): ?>
		<h2><?php echo smartyTranslate(array('s' => 'Data sheet'), $this);?>
</h2>

		<div class="features">
			<!-- product's features -->
			<ul class="bullet">
				<?php $_from = $this->_tpl_vars['features']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['feature']):
?>
					<li><span><?php echo ((is_array($_tmp=$this->_tpl_vars['feature']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</span> <?php echo ((is_array($_tmp=$this->_tpl_vars['feature']['value'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
		</div>
	<?php endif; ?>

	<?php if ($this->_tpl_vars['attachments']): ?>
		<h2><?php echo smartyTranslate(array('s' => 'Download'), $this);?>
</h2>
		
		<ul class="bullet">
			<?php $_from = $this->_tpl_vars['attachments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['attachment']):
?>
				<li><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
attachment.php?id_attachment=<?php echo $this->_tpl_vars['attachment']['id_attachment']; ?>
"><?php echo ((is_array($_tmp=$this->_tpl_vars['attachment']['name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</a><br /><?php echo ((is_array($_tmp=$this->_tpl_vars['attachment']['description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</li>
			<?php endforeach; endif; unset($_from); ?>
		</ul>
	<?php endif; ?>
	
	<?php echo $this->_tpl_vars['HOOK_PRODUCT_TAB_CONTENT']; ?>

</div>
<?php endif; ?>

<!-- Customizable products -->
<?php if ($this->_tpl_vars['product']->customizable): ?>
	<ul class="idTabs">
		<li><a style="cursor: pointer"><?php echo smartyTranslate(array('s' => 'Product customization'), $this);?>
</a></li>
	</ul>
	<div class="customization_block">
		<form method="post" action="<?php echo $this->_tpl_vars['customizationFormTarget']; ?>
" enctype="multipart/form-data" id="customizationForm">
			<p>
				<img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/infos.gif" alt="Informations" />
				<?php echo smartyTranslate(array('s' => 'After saving your customized product, do not forget to add it to your cart.'), $this);?>

				<?php if ($this->_tpl_vars['product']->uploadable_files): ?><br /><?php echo smartyTranslate(array('s' => 'Allowed file formats are: GIF, JPG, PNG'), $this);?>
<?php endif; ?>
			</p>
			<?php if (((is_array($_tmp=$this->_tpl_vars['product']->uploadable_files)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp))): ?>
			<h2><?php echo smartyTranslate(array('s' => 'Pictures'), $this);?>
</h2>
			<ul id="uploadable_files">
				<?php echo smarty_function_counter(array('start' => 0,'assign' => 'customizationField'), $this);?>

				<?php $_from = $this->_tpl_vars['customizationFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['customizationFields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['customizationFields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['customizationFields']['iteration']++;
?>
					<?php if ($this->_tpl_vars['field']['type'] == 0): ?>
						<li class="customizationUploadLine<?php if ($this->_tpl_vars['field']['required']): ?> required<?php endif; ?>"><?php $this->assign('key', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='pictures_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['product']->id) : smarty_modifier_cat($_tmp, $this->_tpl_vars['product']->id)))) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['field']['id_customization_field']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['field']['id_customization_field']))); ?>
							<?php if (isset ( $this->_tpl_vars['pictures'][$this->_tpl_vars['key']] )): ?><div class="customizationUploadBrowse"><img src="<?php echo $this->_tpl_vars['pic_dir']; ?>
<?php echo $this->_tpl_vars['pictures'][$this->_tpl_vars['key']]; ?>
_small" alt="" /><a href="<?php echo $this->_tpl_vars['link']->getUrlWith('deletePicture',$this->_tpl_vars['field']['id_customization_field']); ?>
"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
icon/delete.gif" alt="<?php echo smartyTranslate(array('s' => 'delete'), $this);?>
" width="11" height="13" class="customization_delete_icon" /></a></div><?php endif; ?>
							<div class="customizationUploadBrowse"><input type="file" name="file<?php echo $this->_tpl_vars['field']['id_customization_field']; ?>
" id="img<?php echo $this->_tpl_vars['customizationField']; ?>
" class="customization_block_input <?php if (isset ( $this->_tpl_vars['pictures'][$this->_tpl_vars['key']] )): ?>filled<?php endif; ?>" /><?php if ($this->_tpl_vars['field']['required']): ?><sup>*</sup><?php endif; ?>
							<div class="customizationUploadBrowseDescription"><?php if (! empty ( $this->_tpl_vars['field']['name'] )): ?><?php echo $this->_tpl_vars['field']['name']; ?>
<?php else: ?><?php echo smartyTranslate(array('s' => 'Please select an image file from your hard drive'), $this);?>
<?php endif; ?></div></div>
						</li>
						<?php echo smarty_function_counter(array(), $this);?>

					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<?php endif; ?>
			<div class="clear"></div>
			<?php if (((is_array($_tmp=$this->_tpl_vars['product']->text_fields)) ? $this->_run_mod_handler('intval', true, $_tmp) : intval($_tmp))): ?>
			<h2><?php echo smartyTranslate(array('s' => 'Texts'), $this);?>
</h2>
			<ul id="text_fields">
				<?php echo smarty_function_counter(array('start' => 0,'assign' => 'customizationField'), $this);?>

				<?php $_from = $this->_tpl_vars['customizationFields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['customizationFields'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['customizationFields']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field']):
        $this->_foreach['customizationFields']['iteration']++;
?>
					<?php if ($this->_tpl_vars['field']['type'] == 1): ?>
						<li class="customizationUploadLine<?php if ($this->_tpl_vars['field']['required']): ?> required<?php endif; ?>"><?php $this->assign('key', ((is_array($_tmp=((is_array($_tmp=((is_array($_tmp='textFields_')) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['product']->id) : smarty_modifier_cat($_tmp, $this->_tpl_vars['product']->id)))) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['field']['id_customization_field']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['field']['id_customization_field']))); ?>
							<?php if (! empty ( $this->_tpl_vars['field']['name'] )): ?><?php echo $this->_tpl_vars['field']['name']; ?>
<?php endif; ?><input type="text" name="textField<?php echo $this->_tpl_vars['field']['id_customization_field']; ?>
" id="textField<?php echo $this->_tpl_vars['customizationField']; ?>
" value="<?php if (isset ( $this->_tpl_vars['textFields'][$this->_tpl_vars['key']] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['textFields'][$this->_tpl_vars['key']])) ? $this->_run_mod_handler('stripslashes', true, $_tmp) : stripslashes($_tmp)); ?>
<?php endif; ?>" class="customization_block_input" /><?php if ($this->_tpl_vars['field']['required']): ?><sup>*</sup><?php endif; ?>
						</li>
						<?php echo smarty_function_counter(array(), $this);?>

					<?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			</ul>
			<?php endif; ?>
			<p style="clear: left;" id="customizedDatas">
				<input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
				<input type="hidden" name="submitCustomizedDatas" value="1" />
				<input type="button" class="button" value="<?php echo smartyTranslate(array('s' => 'Save'), $this);?>
" onclick="javascript:saveCustomization()" />
			</p>
		</form>
		<p class="clear required"><sup>*</sup> <?php echo smartyTranslate(array('s' => 'required fields'), $this);?>
</p>
	</div>
<?php endif; ?>

<?php if (count($this->_tpl_vars['packItems']) > 0): ?>
	<div>
		<h2><?php echo smartyTranslate(array('s' => 'Pack content'), $this);?>
</h2>
		<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ($this->_tpl_vars['tpl_dir'])."./product-list.tpl", 'smarty_include_vars' => array('products' => $this->_tpl_vars['packItems'])));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
	</div>
<?php endif; ?>

<?php echo $this->_tpl_vars['HOOK_PRODUCT_FOOTER']; ?>


<?php endif; ?>

<?php echo '
<script type="text/javascript">
	$(\'a.zoombox\').zoombox();
	
	$(\'#quantity_wanted_p .up\').live( \'click\', function(){
		var $this = $(this);
		var $input = $this.parent().find(\'input.text\');

		var maxQTY = $input.data(\'maxqty\');
		var currentQTY = parseInt( $input.val() );

		if ( currentQTY < maxQTY ) {
			$input.val( currentQTY + 1 );
		}

		return false;
	});
	
	$(\'#quantity_wanted_p .down\').live( \'click\', function(){
		var $this = $(this);
		var $input = $this.parent().find(\'input.text\');

		var minQTY = 1;
		var currentQTY = parseInt( $input.val() );

		if ( currentQTY > minQTY ) {
			$input.val( currentQTY - 1 );
		}

		return false;
	});
		
	$(\'#quantity_wanted_p input.text\').live( \'keyup\', function(){
		var $this = $(this);
		var $input = $this.parent().find(\'input.text\');

		var minQTY = 1;
		var maxQTY = parseInt( $input.data(\'maxqty\') );

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
'; ?>