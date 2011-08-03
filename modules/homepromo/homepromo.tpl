<!-- MODULE Home Promo Products -->
<div id="promo-products_block_center" class="block products_block">
	<h4><span class="left"></span><span class="middle">{l s='Promotions' mod='homepromo'}</span><span class="right"></span></h4>
	{if isset($products) AND $products}
		<div class="block_content">
			{assign var='liHeight' value=203}
			{assign var='nbItemsPerLine' value=6}
			{assign var='nbLi' value=$products|@count}
			{assign var='nbLines' value=$nbLi/$nbItemsPerLine|ceil}
			{assign var='ulHeight' value=$nbLines*$liHeight}
			<ul>
				{foreach from=$products item=product name=homePromoProducts}
					<li class="ajax_block_product {if $smarty.foreach.homePromoProducts.first}first_item{elseif $smarty.foreach.homePromoProducts.last}last_item{else}item{/if} {if $smarty.foreach.homePromoProducts.iteration%$nbItemsPerLine == 0}last_item_of_line{elseif $smarty.foreach.homePromoProducts.iteration%$nbItemsPerLine == 1}clear{/if} {if $smarty.foreach.homePromoProducts.iteration > ($smarty.foreach.homePromoProducts.total - ($smarty.foreach.homePromoProducts.total % $nbItemsPerLine))}last_line{/if}">
						<a href="{$product.link}" title="{$product.name|escape:html:'UTF-8'}" class="product_image"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home')}" height="{$homeSize.height}" width="{$homeSize.width}" alt="{$product.name|escape:html:'UTF-8'}" /></a>
	
						<div class="action">
							<p class="price">
								<span class="left"></span>
								<span class="middle">{if !$priceDisplay}{convertPrice price=$product.price}{else}{convertPrice price=$product.price_tax_exc}{/if}</span>
								<span class="right">
									{if ($product.quantity > 0 OR $product.allow_oosp) AND $product.customizable != 2}
										<a class="exclusive ajax_add_to_cart_button" rel="ajax_id_product_{$product.id_product}" href="{$base_dir}cart.php?qty=1&amp;id_product={$product.id_product}&amp;token={$static_token}&amp;add" title="{l s='Add to cart' mod='homebest'}"></a>
									{/if}
								</span>
								<span class="clear"></span>
							</p>
						</div>
	
						<div class="title"><a href="{$product.link}" title="{$product.name|escape:html:'UTF-8'}" class="product_image">{$product.name|truncate:40:'...'|escape:html:'UTF-8'}</a></div>
	
						<a class="button ajax_add_to_cart_button exclusive" href="{$product.link}" title="{$product.name|escape:html:'UTF-8'}">{l s='Voir details'}</a>
					</li>
				{/foreach}

				<div class="clear"></div>
			</ul>
		</div>
	{else}
		<p>{l s='No promo products' mod='homepromo'}</p>
	{/if}
</div>
<!-- /MODULE Home Promo Products -->
