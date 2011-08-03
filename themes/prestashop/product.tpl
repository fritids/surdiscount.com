{*
* 2007-2011 PrestaShop
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 1.4 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

{include file="$tpl_dir./errors.tpl"}
{if $errors|@count == 0}

<script type="text/javascript">
// <![CDATA[

// PrestaShop internal settings
var currencySign = '{$currencySign|html_entity_decode:2:"UTF-8"}';
var currencyRate = '{$currencyRate|floatval}';
var currencyFormat = '{$currencyFormat|intval}';
var currencyBlank = '{$currencyBlank|intval}';
var taxRate = {$tax_rate|floatval};
var jqZoomEnabled = {if $jqZoomEnabled}true{else}false{/if};

//JS Hook
var oosHookJsCodeFunctions = new Array();

// Parameters
var id_product = '{$product->id|intval}';
var productHasAttributes = {if isset($groups)}true{else}false{/if};
var quantitiesDisplayAllowed = {if $display_qties == 1}true{else}false{/if};
var quantityAvailable = {if $display_qties == 1 && $product->quantity}{$product->quantity}{else}0{/if};
var allowBuyWhenOutOfStock = {if $allow_oosp == 1}true{else}false{/if};
var availableNowValue = '{$product->available_now|escape:'quotes':'UTF-8'}';
var availableLaterValue = '{$product->available_later|escape:'quotes':'UTF-8'}';
var productPriceTaxExcluded = {$product->getPriceWithoutReduct(true)|default:'null'} - {$product->ecotax};
var reduction_percent = {if $product->specificPrice AND $product->specificPrice.reduction AND $product->specificPrice.reduction_type == 'percentage'}{$product->specificPrice.reduction*100}{else}0{/if};
var reduction_price = {if $product->specificPrice AND $product->specificPrice.reduction AND $product->specificPrice.reduction_type == 'amount'}{$product->specificPrice.reduction}{else}0{/if};
var specific_price = {if $product->specificPrice AND $product->specificPrice.price}{$product->specificPrice.price}{else}0{/if};
var specific_currency = {if $product->specificPrice AND $product->specificPrice.id_currency}true{else}false{/if};
var group_reduction = '{$group_reduction}';
var default_eco_tax = {$product->ecotax};
var ecotaxTax_rate = {$ecotaxTax_rate};
var currentDate = '{$smarty.now|date_format:'%Y-%m-%d %H:%M:%S'}';
var maxQuantityToAllowDisplayOfLastQuantityMessage = {$last_qties};
var noTaxForThisProduct = {if $no_tax == 1}true{else}false{/if};
var displayPrice = {$priceDisplay};
var productReference = '{$product->reference|escape:'htmlall':'UTF-8'}';
var productAvailableForOrder = {if (isset($restricted_country_mode) AND $restricted_country_mode) OR $PS_CATALOG_MODE}'0'{else}'{$product->available_for_order}'{/if};
var productShowPrice = '{if !$PS_CATALOG_MODE}{$product->show_price}{else}0{/if}';
var productUnitPriceRatio = '{$product->unit_price_ratio}';
var idDefaultImage = {if isset($cover.id_image_only)}{$cover.id_image_only}{else}0{/if};

// Customizable field
var img_ps_dir = '{$img_ps_dir}';
var customizationFields = new Array();
{assign var='imgIndex' value=0}
{assign var='textFieldIndex' value=0}
{foreach from=$customizationFields item='field' name='customizationFields'}
	{assign var="key" value="pictures_`$product->id`_`$field.id_customization_field`"}
	customizationFields[{$smarty.foreach.customizationFields.index|intval}] = new Array();
	customizationFields[{$smarty.foreach.customizationFields.index|intval}][0] = '{if $field.type|intval == 0}img{$imgIndex++}{else}textField{$textFieldIndex++}{/if}';
	customizationFields[{$smarty.foreach.customizationFields.index|intval}][1] = {if $field.type|intval == 0 && isset($pictures.$key) && $pictures.$key}2{else}{$field.required|intval}{/if};
{/foreach}

// Images
var img_prod_dir = '{$img_prod_dir}';
var combinationImages = new Array();

{if isset($combinationImages)}
	{foreach from=$combinationImages item='combination' key='combinationId' name='f_combinationImages'}
		combinationImages[{$combinationId}] = new Array();
		{foreach from=$combination item='image' name='f_combinationImage'}
			combinationImages[{$combinationId}][{$smarty.foreach.f_combinationImage.index}] = {$image.id_image|intval};
		{/foreach}
	{/foreach}
{/if}

combinationImages[0] = new Array();
{if isset($images)}
	{foreach from=$images item='image' name='f_defaultImages'}
		combinationImages[0][{$smarty.foreach.f_defaultImages.index}] = {$image.id_image};
	{/foreach}
{/if}

// Translations
var doesntExist = '{l s='The product does not exist in this model. Please choose another.' js=1}';
var doesntExistNoMore = '{l s='This product is no longer in stock' js=1}';
var doesntExistNoMoreBut = '{l s='with those attributes but is available with others' js=1}';
var uploading_in_progress = '{l s='Uploading in progress, please wait...' js=1}';
var fieldRequired = '{l s='Please fill in all required fields' js=1}';

{if isset($groups)}
	// Combinations
	{foreach from=$combinations key=idCombination item=combination}
		addCombination({$idCombination|intval}, new Array({$combination.list}), {$combination.quantity}, {$combination.price}, {$combination.ecotax}, {$combination.id_image}, '{$combination.reference|addslashes}', {$combination.unit_impact}, {$combination.minimal_quantity});
	{/foreach}
	// Colors
	{if $colors|@count > 0}
		{if $product->id_color_default}var id_color_default = {$product->id_color_default|intval};{/if}
	{/if}
{/if}

//]]>
</script>

{include file="$tpl_dir./breadcrumb.tpl"}

<div itemscope itemtype="http://data-vocabulary.org/Product" id="primary_block" class="clearfix">
	<h1 itemprop="name">{$product->name|escape:'htmlall':'UTF-8'}</h1>
	
	<span class="hidden" itemprop="identifier" content="mpn:{$product->id}">{$product->id}</span>
	
	<span class="hidden" itemprop="review" itemscope itemtype="http://data-vocabulary.org/Review-aggregate"><span class="hidden" itemprop="rating">4.9</span> / 5, <span itemprop="count">157</span> votes</span>

	{if isset($adminActionDisplay) && $adminActionDisplay}
	<div id="admin-action">
		<p>{l s='This product is not visible to your customers.'}
		<input type="hidden" id="admin-action-product-id" value="{$product->id}" />
		<input type="submit" value="{l s='Publish'}" class="exclusive" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad}', 0)"/>
		<input type="submit" value="{l s='Back'}" class="exclusive" onclick="submitPublishProduct('{$base_dir}{$smarty.get.ad}', 1)"/>
		</p>
		<div class="clear" ></div>
		<p id="admin-action-result"></p>
		</p>
	</div>
	{/if}

	{if isset($confirmation) && $confirmation}
	<p class="confirmation">
		{$confirmation}
	</p>
	{/if}

	<!-- right infos-->
	<div id="pb-right-column">
		<!-- product img-->
		<div id="image-block">
		{if $have_image}
			<img itemprop="image" src="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large')}"
				{if $jqZoomEnabled}class="jqzoom" alt="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'thickbox')}"{else} title="{$product->name|escape:'htmlall':'UTF-8'}" alt="{$product->name|escape:'htmlall':'UTF-8'}" {/if} id="bigpic" width="{$largeSize.width}" height="{$largeSize.height}" />
		{else}
			<img src="{$img_prod_dir}{$lang_iso}-default-large.jpg" id="bigpic" alt="" title="{$product->name|escape:'htmlall':'UTF-8'}" width="{$largeSize.width}" height="{$largeSize.height}" />
		{/if}
		</div>

		{if isset($images) && count($images) > 0}
			<!-- thumbnails -->
			<div id="views_block"{if isset($images) && count($images) < 2 && !$quantity_discounts} class="hidden"{/if}>
			{if isset($images) && count($images) > 3}
				<span class="view_scroll_spacer"><a id="view_scroll_left" class="hidden" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">{l s='Previous'}</a></span>
			{/if}

			<div id="thumbs_list">
				<ul id="thumbs_list_frame">
					{if isset($images)}
						{foreach from=$images item=image name=thumbnails}
							{assign var=imageIds value="`$product->id`-`$image.id_image`"}

							<li id="thumbnail_{$image.id_image}">
								<a href="{$link->getImageLink($product->link_rewrite, $imageIds, 'thickbox')}" class="zoombox{if count($images) > 1} zgallery_{/if}  {if $smarty.foreach.thumbnails.first}shown{/if}" title="{$image.legend|htmlspecialchars}">
									<img id="thumb_{$image.id_image}" src="{$link->getImageLink($product->link_rewrite, $imageIds, 'medium')}" alt="{$image.legend|htmlspecialchars}" height="{$mediumSize.height}" width="{$mediumSize.width}" />
								</a>
							</li>
						{/foreach}
					{/if}
				</ul>
			</div>

			{if isset($images) && count($images) > 3}
				<a id="view_scroll_right" title="{l s='Other views'}" href="javascript:{ldelim}{rdelim}">{l s='Next'}</a>
			{/if}
			</div>
		{/if}
		{if isset($images) && count($images) > 1}<p class="align_center clear"><span id="wrapResetImages" style="display: none;"><img src="{$img_dir}icon/cancel_16x18.gif" alt="{l s='Cancel'}" width="16" height="18"/> <a id="resetImages" href="{$link->getProductLink($product)}" onclick="$('span#wrapResetImages').hide('slow');return (false);">{l s='Display all pictures'}</a></span></p>{/if}
	</div>

	<!-- left infos-->
	<div id="pb-left-column">
		{if $product->description_short OR $packItems|@count > 0}
		<div id="short_description_block">
			{if $product->description_short}
				<div id="short_description_content" class="rte align_justify">{$product->description_short}</div>
			{/if}
			{if $product->description}
			<p class="buttons_bottom_block"><a href="javascript:{ldelim}{rdelim}" class="button">{l s='More details'}</a></p>
			{/if}
			{if $packItems|@count > 0}
				<h3>{l s='Pack content'}</h3>
				{foreach from=$packItems item=packItem}
					<div class="pack_content">
						{$packItem.pack_quantity} x <a href="{$link->getProductLink($packItem.id_product, $packItem.link_rewrite, $packItem.category)}">{$packItem.name|escape:'htmlall':'UTF-8'}</a>
						<p>{$packItem.description_short}</p>
					</div>
				{/foreach}
			{/if}
		</div>
		{/if}

		{if ($product->show_price AND !isset($restricted_country_mode)) OR isset($groups) OR $product->reference OR (isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS)}
		<!-- add to cart form-->
		<form id="buy_block" {if $PS_CATALOG_MODE AND !isset($groups) AND $product->quantity > 0}class="hidden"{/if} action="{$link->getPageLink('cart.php')}" method="post">
			<!-- hidden datas -->
			<p class="hidden">
				<input type="hidden" name="token" value="{$static_token}" />
				<input type="hidden" name="id_product" value="{$product->id|intval}" id="product_page_product_id" />
				<input type="hidden" name="add" value="1" />
				<input type="hidden" name="id_product_attribute" id="idCombination" value="" />
			</p>

			<!-- prices -->
			
			{if $product->show_price AND !isset($restricted_country_mode) AND !$PS_CATALOG_MODE}
				{if !$priceDisplay || $priceDisplay == 2}
					{assign var='productPrice' value=$product->getPrice(true, $smarty.const.NULL)}
					{assign var='productPriceWithoutRedution' value=$product->getPriceWithoutReduct(false, $smarty.const.NULL)}
				{elseif $priceDisplay == 1}
					{assign var='productPrice' value=$product->getPrice(false, $smarty.const.NULL)}
					{assign var='productPriceWithoutRedution' value=$product->getPriceWithoutReduct(true, $smarty.const.NULL)}
				{/if}
				<div class="price">
					{assign var='prix_barre' value='false'}

					{*
					* if $product->on_sale}
					* 	<img src="{$img_dir}onsale_{$lang_iso}.gif" alt="{l s='On sale'}" class="on_sale_img"/>
					* 	<span class="on_sale">{l s='On sale!'}</span>
					* {elseif $product->specificPrice AND $product->specificPrice.reduction AND $productPriceWithoutRedution > $productPrice}
					* 	<span class="discount">{l s='Reduced price!'}</span>
					* 
					* 	{assign var='prix_barre' value='true'}
					* {/if
					*}
					
					{if $product->specificPrice AND $product->specificPrice.reduction AND $productPriceWithoutRedution > $productPrice}
						{assign var='img_etiquette' value='1303121940-asaisir.png'}
						{assign var='prix_barre' value='true'}
					{/if}

					{if $product->etiquette}
						{assign var='img_etiquette' value=$product->etiquette}
					{/if}
	
					{if $img_etiquette}
						<img src="{$smarty.const._PS_IMG_}et/{$img_etiquette}" alt="" title="" width="" height="" />
					{/if}

					<div id="info_price">
						{if $product->specificPrice AND $product->specificPrice.reduction}
							<p id="old_price">
								<span class="bold">
								{if $priceDisplay >= 0 && $priceDisplay <= 2}
									{if $productPriceWithoutRedution > $productPrice}
										<span id="old_price_display">{convertPrice price=$productPriceWithoutRedution}</span>
										{if $tax_enabled}
											{if $priceDisplay == 1}{l s='tax excl.'}{else}{l s='tax incl.'}{/if}
										{/if}
									{/if}
								{/if}
								</span>
							</p>
						{/if}

						<span class="our_price_display">
							{if $priceDisplay >= 0 && $priceDisplay <= 2}
								<span id="our_price_display">{convertPrice price=$productPrice}</span>
								{if $tax_enabled}
									{l s='tax incl.'}
								{else}
									{l s='tax excl.'}
								{/if}
							{/if}
						</span>
						{if $priceDisplay == 2}
							<br />
							<span id="pretaxe_price"><span id="pretaxe_price_display">{convertPrice price=$product->getPrice(false, $smarty.const.NULL)}</span>&nbsp;{l s='tax excl.'}</span>
						{/if}

						{if $product->getPourcentOfReduction() > 0 && $prix_barre == 'true'}
							<div class="getPourcentOfReduction">
								-{$product->getPourcentOfReduction()}%
							</div>
						{/if}
						<div class="clear"></div>
					</div>
				</div>
				{if $product->specificPrice AND $product->specificPrice.reduction_type == 'percentage'}
					<p id="reduction_percent">{l s='(price reduced by'} <span id="reduction_percent_display">{$product->specificPrice.reduction*100}</span> %{l s=')'}</p>
				{/if}
				{if $packItems|@count}
					<p class="pack_price">{l s='instead of'} <span style="text-decoration: line-through;">{convertPrice price=$product->getNoPackPrice()}</span></p>
					<br class="clear" />
				{/if}
				{if $product->ecotax != 0}
					<p class="price-ecotax">{l s='include'} <span id="ecotax_price_display">{if $priceDisplay == 2}{$ecotax_tax_exc|convertAndFormatPrice}{else}{$ecotax_tax_inc|convertAndFormatPrice}{/if}</span> {l s='for green tax'}
						{if $product->specificPrice AND $product->specificPrice.reduction}
						<br />{l s='(not impacted by the discount)'}
						{/if}
					</p>
				{/if}
				{if !empty($product->unity) && $product->unit_price_ratio > 0.000000}
				    {math equation="pprice / punit_price"  pprice=$productPrice  punit_price=$product->unit_price_ratio assign=unit_price}
					<p class="unit-price"><span id="unit_price_display">{convertPrice price=$unit_price}</span> {l s='per'} {$product->unity|escape:'htmlall':'UTF-8'}</p>
				{/if}
				{*close if for show price*}
			{/if}

			{if isset($groups)}
			<!-- attributes -->
			<div id="attributes">
			{foreach from=$groups key=id_attribute_group item=group}
			{if $group.attributes|@count}
			<p>
				<label for="group_{$id_attribute_group|intval}">{$group.name|escape:'htmlall':'UTF-8'} :</label>
				{assign var="groupName" value="group_$id_attribute_group"}
				<select name="{$groupName}" id="group_{$id_attribute_group|intval}" onchange="javascript:findCombination();{if $colors|@count > 0}$('#wrapResetImages').show('slow');{/if};">
					{foreach from=$group.attributes key=id_attribute item=group_attribute}
						<option value="{$id_attribute|intval}"{if (isset($smarty.get.$groupName) && $smarty.get.$groupName|intval == $id_attribute) || $group.default == $id_attribute} selected="selected"{/if} title="{$group_attribute|escape:'htmlall':'UTF-8'}">{$group_attribute|escape:'htmlall':'UTF-8'}</option>
					{/foreach}
				</select>
			</p>
			{/if}
			{/foreach}
			</div>
			{/if}

			{if isset($colors) && $colors}
			<!-- colors -->
			<div id="color_picker">
				<p>{l s='Pick a color:' js=1}</p>
				<div class="clear"></div>
				<ul id="color_to_pick_list">
				{foreach from=$colors key='id_attribute' item='color'}
					<li><a id="color_{$id_attribute|intval}" class="color_pick" style="background: {$color.value};" onclick="updateColorSelect({$id_attribute|intval});$('#wrapResetImages').show('slow');" title="{$color.name}">{if file_exists($col_img_dir|cat:$id_attribute|cat:'.jpg')}<img src="{$img_col_dir}{$id_attribute}.jpg" alt="{$color.name}" width="20" height="20" />{/if}</a></li>
				{/foreach}
				</ul>
				<div class="clear"></div>
			</div>
			{/if}

			<!-- availability -->
			<p id="availability_statut"{if ($product->quantity == 0 && !$product->available_later) OR ($product->quantity != 0 && !$product->available_now)} style="display:none;"{/if}>
				<span id="availability_label">{l s='Availability:'}</span>
				<span id="availability_value"{if $product->quantity == 0} class="warning-inline"{/if}>
					{if $product->quantity == 0}{if $allow_oosp}{$product->available_later}{else}{l s='This product is no longer in stock'}{/if}{else}{$product->available_now}{/if}
				</span>
			</p>

			<!-- Out of stock hook -->
			<p id="oosHook"{if $product->quantity > 0} style="display: none;"{/if}>
				{$HOOK_PRODUCT_OOS}
			</p>

			<p class="warning_inline" id="last_quantities"{if ($product->quantity > $last_qties OR $product->quantity == 0) OR $allow_oosp OR !$product->available_for_order OR $PS_CATALOG_MODE} style="display: none;"{/if} >{l s='Warning: Last items in stock!'}</p>

			<div id="infostock"{if $product->quantity == 0} class="off"{/if}><a href="{$link->getPageLink('stores.php')}"></a></div>

			<div id="buy">
				<!-- quantity wanted -->
				<p id="quantity_wanted_p"{if (!$allow_oosp && $product->quantity == 0) || $virtual} style="display:none;"{/if}>
					<a class="up" href=""></a>
					<input type="text" data-maxqty="{$product->quantity|intval}" name="qty" id="quantity_wanted" class="text" value="{if isset($quantityBackup)}{$quantityBackup|intval}{else}1{/if}" size="2" maxlength="3" />
					<a class="down" href=""></a>
				</p>

				<p{if (!$allow_oosp && $product->quantity <= 0) OR !$product->available_for_order OR (isset($restricted_country_mode) AND $restricted_country_mode) OR $PS_CATALOG_MODE} style="display: none;"{/if} id="add_to_cart" class="buttons_bottom_block"><input type="submit" name="Submit" value="{l s='Add to cart'}" class="exclusive" /></p>

				{if isset($HOOK_PRODUCT_ACTIONS) && $HOOK_PRODUCT_ACTIONS}{$HOOK_PRODUCT_ACTIONS}{/if}

				<div class="clear"></div>
			</div>

			<!-- usefull links-->
			<ul class="clear" id="usefull_link_block">
				{if $HOOK_EXTRA_LEFT}{$HOOK_EXTRA_LEFT}{/if}
				<li class="print"><a href="javascript:print();">{l s='Print'}</a></li>
				<li class="facebook"><a target="_blank" href="http://www.facebook.com/sharer.php?u={$product->getLink()|urlencode}&t={$product->name|escape:'htmlall':'UTF-8'|urlencode}&src=sp">{l s='Facebook'}</a></li>
				<li class="email"><a href="mailto:?subject={$product->name|escape:'htmlall':'UTF-8'|urlencode}&body={l s='A interresting product for you'}%0A%0A{$product->getLink()|urlencode}">{l s='Email'}</a></li>
				<div class="clear"></div>
			</ul>

			{if $product->online_only}
				<p>{l s='Online only'}</p>
			{/if}
		</form>
		{/if}
		{if $HOOK_EXTRA_RIGHT}{$HOOK_EXTRA_RIGHT}{/if}
		
		<span class="hidden" itemprop="offerDetails" itemscope itemtype="http://data-vocabulary.org/Offer">
			<meta itemprop="currency" content="EUR" />
			<span class="hidden" itemprop="price">{$productPrice|replace:'.':','}</span>
			<span itemprop="condition" content="new"></span>
			<span itemprop="availability" content="{if $product->quantity == 0}instore_only{else}in_stock{/if}"></span>
		</span>
		
		{if $quantity_discounts}
		<!-- quantity discount -->
		<ul class="idTabs">
			<li><a style="cursor: pointer" class="selected">{l s='Quantity discount'}</a></li>
		</ul>
		<div id="quantityDiscount">
			<table class="std">
				<thead>
					<tr>
						<th>{l s='quantity'}</th>
						<th>{l s='Prix unitaire'}</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						{foreach from=$quantity_discounts item='quantity_discount' name='quantity_discounts'}
							<tr>
								<td>
									{$quantity_discount.quantity|intval}&nbsp;

									{if $quantity_discount.quantity|intval > 1}
										{l s='quantities'}
									{else}
										{l s='quantity'}
									{/if}
								</td>
								<td>
									{if $quantity_discount.price != 0 OR $quantity_discount.reduction_type == 'amount'}
										<span class="hidden convert">{$productPriceWithoutRedution} - {$quantity_discount.real_value}</span>
										{convertPrice price=$productPriceWithoutRedution-$quantity_discount.real_value}
									{else}
										<span class="hidden notconvert"></span>
					    				-{$productPriceWithoutRedution-$quantity_discount.real_value|floatval}%
									{/if}
								</td>
							</tr>
						{/foreach}
					</tr>
				</tbody>
			</table>
		</div>
		{/if}
	</div>
</div>

{if $packItems|@count > 0}
	<div>
		<h2>{l s='Pack content'}</h2>
		{include file="$tpl_dir./product-list.tpl" products=$packItems}
	</div>
{/if}

<!-- description and features -->
<div id="more_info_block" class="clear">
	<div id="more_info_sheets" class="sheets align_justify">
		{if $product->description}
			<h2 id="more_info_tabs">{l s='More info'}</h2>

			<!-- full description -->
			<div id="idTab1" class="rte">
				<span itemprop="description">{$product->description}</span>
				{if $product->id_manufacturer && $image_manufacturer != ''}
					<span class="hidden" itemprop="brand">{$product_manufacturer->name}</span>
					<img class="product_manufacturer" src="{$img_manu_dir}{$image_manufacturer|escape:'htmlall':'UTF-8'}-manuProduct.jpg" alt="{$product_manufacturer->name}" title="{$product_manufacturer->name}" width="{$manuProductSize.width}" height="{$manuProductSize.height}" />
				{/if}
			</div>
		{/if}

		{$HOOK_PRODUCT_TAB_TOP}

		{if $features}
			<h2>{l s='Data sheet'}</h2>

			<div class="features">
				<!-- product's features -->
				<ul id="idTab2" class="bullet">
				{foreach from=$features item=feature}
					<li><span>{$feature.name|escape:'htmlall':'UTF-8'}</span> {$feature.value|escape:'htmlall':'UTF-8'}</li>
				{/foreach}
				</ul>
			</div>
		{/if}
		{if $attachments}
			<h2>{l s='Download'}</h2>

			<ul id="idTab9" class="bullet">
			{foreach from=$attachments item=attachment}
				<li><a href="{$link->getPageLink('attachment.php')}?id_attachment={$attachment.id_attachment}">{$attachment.name|escape:'htmlall':'UTF-8'}</a><br />{$attachment.description|escape:'htmlall':'UTF-8'}</li>
			{/foreach}
			</ul>
		{/if}

		{$HOOK_PRODUCT_TAB_CONTENT}
	</div>
</div>

{$HOOK_PRODUCT_FOOTER}

<!-- Customizable products -->
{if $product->customizable}
	<ul class="idTabs">
		<li><a style="cursor: pointer">{l s='Product customization'}</a></li>
	</ul>
	<div class="customization_block">
		<form method="post" action="{$customizationFormTarget}" enctype="multipart/form-data" id="customizationForm">
			<p>
				<img src="{$img_dir}icon/infos.gif" alt="Informations" />
				{l s='After saving your customized product, remember to add it to your cart.'}
				{if $product->uploadable_files}<br />{l s='Allowed file formats are: GIF, JPG, PNG'}{/if}
			</p>
			{if $product->uploadable_files|intval}
			<h2>{l s='Pictures'}</h2>
			<ul id="uploadable_files">
				{counter start=0 assign='customizationField'}
				{foreach from=$customizationFields item='field' name='customizationFields'}
					{if $field.type == 0}
						<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='pictures_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
							{if isset($pictures.$key)}<div class="customizationUploadBrowse"><img src="{$pic_dir}{$pictures.$key}_small" alt="" /><a href="{$link->getUrlWith('deletePicture', $field.id_customization_field)}"><img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" class="customization_delete_icon" width="11" height="13" /></a></div>{/if}
							<div class="customizationUploadBrowse"><input type="file" name="file{$field.id_customization_field}" id="img{$customizationField}" class="customization_block_input {if isset($pictures.$key)}filled{/if}" />{if $field.required}<sup>*</sup>{/if}
							<div class="customizationUploadBrowseDescription">{if !empty($field.name)}{$field.name}{else}{l s='Please select an image file from your hard drive'}{/if}</div></div>
						</li>
						{counter}
					{/if}
				{/foreach}
			</ul>
			{/if}
			<div class="clear"></div>
			{if $product->text_fields|intval}
			<h2>{l s='Texts'}</h2>
			<ul id="text_fields">
				{counter start=0 assign='customizationField'}
				{foreach from=$customizationFields item='field' name='customizationFields'}
					{if $field.type == 1}
						<li class="customizationUploadLine{if $field.required} required{/if}">{assign var='key' value='textFields_'|cat:$product->id|cat:'_'|cat:$field.id_customization_field}
							{if !empty($field.name)}{$field.name}{/if}{if $field.required}<sup>*</sup>{/if}<textarea type="text" name="textField{$field.id_customization_field}" id="textField{$customizationField}" rows="1" cols="40" class="customization_block_input" />{if isset($textFields.$key)}{$textFields.$key|stripslashes}{/if}</textarea>
						</li>
						{counter}
					{/if}
				{/foreach}
			</ul>
			{/if}
			<p style="clear: left;" id="customizedDatas">
				<input type="hidden" name="quantityBackup" id="quantityBackup" value="" />
				<input type="hidden" name="submitCustomizedDatas" value="1" />
				<input type="button" class="button" value="{l s='Save'}" onclick="javascript:saveCustomization()" />
				<span id="ajax-loader" style="display:none"><img src="{$img_ps_dir}loader.gif" alt="loader" /></span>
			</p>
		</form>
		<p class="clear required"><sup>*</sup> {l s='required fields'}</p>
	</div>
{/if}

{/if}

{literal}
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
{/literal}