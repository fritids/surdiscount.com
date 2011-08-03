{*************************************************************************************************************************************}
{* IMPORTANT : If you change some data here, you have to report these changes in the ./blockcart-json.js (to let ajaxCart available) *}
{*************************************************************************************************************************************}

{if $ajax_allowed}
	{* to perfectly play the tranfert animation, the script ifx.js has to be called here, but it creates a method conflict with jquery.serialScroll.js file *}
	<script type="text/javascript" src="{$content_dir}js/jquery/ifxtransfer.js"></script>
	<script type="text/javascript">
	var CUSTOMIZE_TEXTFIELD = {$CUSTOMIZE_TEXTFIELD};
	var customizationIdMessage = '{l s='Customization #' mod='blockcart' js=1}';
	var removingLinkText = '{l s='remove this product from my cart' mod='blockcart' js=1}';
	</script>
	{if !$order_page}
		<script type="text/javascript" src="{$content_dir}modules/blockcart/ajax-cart.js"></script>
	{/if}
{/if}

<!-- MODULE Block cart -->
<div id="cart_block" class="block exclusive">
	<h4>
		<a href="{$base_dir_ssl}order.php">{l s='Cart' mod='blockcart'}</a>
		{if $ajax_allowed}
		<span id="block_cart_expand" {if $colapseExpandStatus eq 'expanded'}class="hidden"{/if}>&nbsp;</span>
		<span id="block_cart_collapse" {if $colapseExpandStatus eq 'collapsed' || !isset($colapseExpandStatus)}class="hidden"{/if}>&nbsp;</span>
		{/if}
	</h4>
	<div class="block_content">
	<!-- block summary -->
	<div id="cart_block_summary" class="{if $colapseExpandStatus eq 'expanded' || !$ajax_allowed}collapsed{else}expanded{/if}">
		{if $cart_qties > 0}<span class="ajax_cart_quantity">{$cart_qties}</span>{/if}
		<span class="ajax_cart_product_txt_s{if $cart_qties < 2} hidden{/if}">{l s='products' mod='blockcart'}</span>
		<span class="ajax_cart_product_txt{if $cart_qties != 1} hidden{/if}">{l s='product' mod='blockcart'}</span>
		{if $cart_qties > 0}<span class="ajax_cart_total">{if $priceDisplay == 1}{convertPrice price=$cart->getOrderTotal(false)}{else}{convertPrice price=$cart->getOrderTotal(true)}{/if}</span>{/if}
		{if $cart_qties == 0}<span class="ajax_cart_no_product">{if $cart_qties == 0}{l s='(empty)' mod='blockcart'}{/if}</span>{/if}
	</div>
	<!-- block list of products -->
	<div id="cart_block_list" class="{if $colapseExpandStatus eq 'expanded' || !$ajax_allowed}expanded{else}collapsed{/if}">
	{if $products}
		<span class="top">{$nb_total_products}x Article{if $nb_total_products > 1}s{/if}</span>
	{/if}
		<a href="{$base_dir}order.php"><p {if $products}class="hidden"{/if} id="cart_block_no_products">{l s='No products' mod='blockcart'}</p></a>
		
		{if $discounts|@count > 0}<table id="vouchers">
			<tbody>
			{foreach from=$discounts item=discount}
				<tr id="bloc_cart_voucher_{$discount.id_discount}">
					<td class="name" title="{$discount.description}">{$discount.name|cat:' : '|cat:$discount.description|truncate:18:'...'|escape:'htmlall':'UTF-8'}</td>
					<td class="price">-{if $discount.value_real != '!'}{if $priceDisplay == 1}{convertPrice price=$discount.value_tax_exc}{else}{convertPrice price=$discount.value_real}{/if}{/if}</td>
					<td class="delete"><a href="{$base_dir_ssl}order.php?deleteDiscount={$discount.id_discount}" title="{l s='Delete'}"><img src="{$img_dir}icon/delete.gif" alt="{l s='Delete'}" width="11" height="13" class="icon" /></a></td>
				</tr>
			{/foreach}
			</tbody>
		</table>
		{/if}
		
		<a href="{$base_dir}order.php">
		<p id="cart-prices">
			<span>{l s='Shipping' mod='blockcart'}</span>
			<span id="cart_block_shipping_cost" class="price ajax_cart_shipping_cost">{$shipping_cost}</span>
			<br/>
			{if $show_wrapping}
				<span>{l s='Wrapping' mod='blockcart'}</span>
				<span id="cart_block_wrapping_cost" class="price cart_block_wrapping_cost">{if $priceDisplay == 1}{convertPrice price=$cart->getOrderTotal(false, 6)}{else}{convertPrice price=$cart->getOrderTotal(true, 6)}{/if}</span>
				<br/>
			{/if}
			<span>{l s='Total' mod='blockcart'}</span>
			<span id="cart_block_total" class="price ajax_block_cart_total">{$total}</span>
		</p>
		</a>
		<a href="{$base_dir}order.php">
		{if $priceDisplay == 2}
			<p id="cart-price-precisions">
				{l s='Prices are tax included' mod='blockcart'}
			</p>
		{/if}
		{if $priceDisplay == 1}
			<p id="cart-price-precisions">
				{l s='Prices are tax excluded' mod='blockcart'}
			</p>
		{/if}
		</a>
		<p id="cart-buttons">
			<a href="{$base_dir_ssl}order.php" class="button_small" title="{l s='Cart' mod='blockcart'}">{l s='Cart' mod='blockcart'}</a>
			<a href="{$base_dir_ssl}order.php?step=1" id="button_order_cart" class="exclusive" title="{l s='Check out' mod='blockcart'}">{l s='Check out' mod='blockcart'}</a>
		</p>
	</div>
	</div>
</div>
<!-- /MODULE Block cart -->
