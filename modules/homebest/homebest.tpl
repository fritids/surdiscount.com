<!-- MODULE Home Best Products -->
<div id="best-products_block_center" class="block products_block">
	<h4><span class="left"></span><span class="middle">{l s='Meilleures ventes' mod='homebest'}</span><span class="right"></span></h4>
	{if isset($best_sellers) AND $best_sellers}
		<div class="block_content">
			{assign var='liHeight' value=203}
			{assign var='nbItemsPerLine' value=3}
			{assign var='nbLi' value=$best_sellers|@count}
			{assign var='nbLines' value=$nbLi/$nbItemsPerLine|ceil}
			{assign var='ulHeight' value=$nbLines*$liHeight}

			<ul>
				{foreach from=$best_sellers item=product name=homeBestProducts}
					<li class="ajax_block_product {if $smarty.foreach.homeBestProducts.first}first_item{elseif $smarty.foreach.homeBestProducts.last}last_item{else}item{/if} {if $smarty.foreach.homeBestProducts.iteration%$nbItemsPerLine == 0}last_item_of_line{elseif $smarty.foreach.homeBestProducts.iteration%$nbItemsPerLine == 1}clear{/if} {if $smarty.foreach.homeBestProducts.iteration > ($smarty.foreach.homeBestProducts.total - ($smarty.foreach.homeBestProducts.total % $nbItemsPerLine))}last_line{/if}">
						<!-- image -->
						<a href="{$product.link}" title="{$product.name|escape:html:'UTF-8'}" class="product_image"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home')}" height="{$homeSize.height}" width="{$homeSize.width}" alt="{$product.name|escape:html:'UTF-8'}" /></a>

						<!-- prix + add to cart -->
						<div class="action">
							<p class="price">
								<span class="left"></span>
								<span class="middle">{convertPrice price=$product.price}</span>
								<span class="right">
									{if ($product.quantity > 0 OR $product.allow_oosp) AND $product.customizable != 2}
										<a class="exclusive ajax_add_to_cart_button" rel="ajax_id_product_{$product.id_product}" href="{$base_dir}cart.php?qty=1&amp;id_product={$product.id_product}&amp;token={$static_token}&amp;add" title="{l s='Add to cart' mod='homebest'}"></a>
									{/if}
								</span>
								<span class="clear"></span>
							</p>
						</div>

						<!-- titre -->
						<div class="title"><a href="{$product.link}" title="{$product.name|escape:html:'UTF-8'}" class="product_image">{$product.name|truncate:40:'...'|escape:html:'UTF-8'}</a></div>
						<!-- add to cart -->
						<a class="button ajax_add_to_cart_button exclusive" href="{$product.link}" title="{$product.name|escape:html:'UTF-8'}">{l s='Voir details'}</a>
					</li>
				{/foreach}

				<div class="clear"></div>
			</ul>
		</div>
	{else}
		<p>{l s='No best products' mod='homebest'}</p>
	{/if}
</div>
<!-- /MODULE Home Best Products -->
