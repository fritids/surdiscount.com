<!-- Block Viewed products -->
<div id="viewed-products_block_left" class="block products_block">
	<h4>{l s='Viewed products' mod='blockviewed'}</h4>
	<div class="block_content">
		<ul class="products clearfix">
			{foreach from=$productsViewedObj item=viewedProduct name=myLoop}
				{assign var=imageIds value=$viewedProduct->getCoverOfThis()}

				<li class="clearfix{if $smarty.foreach.myLoop.last} last_item{elseif $smarty.foreach.myLoop.first} first_item{else} item{/if}">
					<a href="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite, $viewedProduct->ean13)}" title="{l s='More about' mod='blockviewed'} {$viewedProduct->name|escape:html:'UTF-8'}"><img src="{$link->getImageLink($viewedProduct->link_rewrite, $imageIds, 'medium')}" height="{$mediumSize.height}" width="{$mediumSize.width}" alt="{$viewedProduct->legend|escape:html:'UTF-8'}" /></a>
					<h5><a href="{$link->getProductLink($viewedProduct->id, $viewedProduct->link_rewrite, $viewedProduct->category_rewrite, $viewedProduct->ean13)}" title="{l s='More about' mod='blockviewed'} {$viewedProduct->name|escape:html:'UTF-8'}">{$viewedProduct->name|escape:html:'UTF-8'}</a></h5>

					{if ($viewedProduct->reduction_price != 0 || $viewedProduct->reduction_percent != 0) && ($viewedProduct->reduction_from == $viewedProduct->reduction_to OR ($smarty.now|date_format:'%Y-%m-%d %H:%M:%S' <= $viewedProduct->reduction_to && $smarty.now|date_format:'%Y-%m-%d %H:%M:%S' >= $viewedProduct->reduction_from))}
						<p class="old_price"><span class="bold">
						{if !$priceDisplay || $priceDisplay == 2}
							<span class="old_price_display">{convertPrice price=$viewedProduct->getPriceWithoutReduct()}</span>
						{/if}
						{if $priceDisplay == 1}
							<span class="old_price_display">{convertPrice price=$viewedProduct->getPriceWithoutReduct(true)}</span>
						{/if}
						</span>
						</p>
					{/if}
					
					{if $viewedProduct->reduction_percent != 0 && ($viewedProduct->reduction_from == $viewedProduct->reduction_to OR ($smarty.now|date_format:'%Y-%m-%d %H:%M:%S' <= $viewedProduct->reduction_to && $smarty.now|date_format:'%Y-%m-%d %H:%M:%S' >= $viewedProduct->reduction_from))}
						<p class="reduction_percent">{l s='(price reduced by'} <span class="reduction_percent_display">{$viewedProduct->reduction_percent|floatval}</span> %{l s=')'}</p>
					{/if}
					{if $packItems|@count}
						<p class="pack_price">{l s='instead of'} <span style="text-decoration: line-through;">{convertPrice price=$viewedProduct->getNoPackPrice()}</span></p>
						<br class="clear" />
					{/if}
					{if $viewedProduct->ecotax != 0}
						<p class="price-ecotax">{l s='include'} <span class="ecotax_price_display">{$viewedProduct->ecotax|convertAndFormatPrice}</span> {l s='for green tax'}</p>
					{/if}
						
					<p class="price">
						<span class="our_price_display">
						{if !$priceDisplay || $priceDisplay == 2}
							<span class="our_price_display">{convertPrice price=$viewedProduct->getPrice(true, $smarty.const.NULL, 2)}</span>
						{/if}
						{if $priceDisplay == 1}
							<span class="our_price_display">{convertPrice price=$viewedProduct->getPrice(false, $smarty.const.NULL, 2)}</span>
						{/if}
						</span>
						{if $priceDisplay == 2}
							<br />
							<span class="pretaxe_price"><span class="pretaxe_price_display">{convertPrice price=$viewedProduct->getPrice(false, $smarty.const.NULL)}</span>&nbsp;{l s='tax excl.'}</span>
						{/if}
						<br />
					</p>
				</li>
			{/foreach}
		</ul>
	</div>
</div>