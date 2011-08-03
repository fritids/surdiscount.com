{assign var='nbView' value='3'}

{if count($products) > 0}
	<script type="text/javascript">var middleAcc = {$middlePosition_accessorie};</script>
	<script type="text/javascript" src="{$content_dir}modules/accessorie/js/accessorie.js"></script>
	
	<h2>{l s='Accessories of the current product' mod='accessories'}</h2>

	<div id="accessorie{if count($products) > $nbView}_noscroll{/if}">
		{if count($products) > $nbView}<a id="accessorie_scroll_left" class="active" title="{l s='Previous' mod='accessorie'}" href="javascript:{ldelim}{rdelim}">{l s='Previous' mod='accessorie'}</a>{/if}
		
		<div id="accessorie_list"{if count($products) <= $nbView} style="width: inherit;"{/if}>
			<ul {if count($products) > $nbView}style="width: {math equation="((710 / nbView) * nbImages)+1000" width=710 nbView=$nbView nbImages=$products|@count}px"{/if}>
				{foreach from=$products item='product' name=product}
					<li {if count($products) <= $nbView}style="width: {math equation="( width - ( margin * 2 * nbImages ) ) / nbImages" width=790 margin=11 nbImages=$products|@count}px"{/if}>
						<a href="{$product.link}" title="{$product.name|htmlspecialchars}">
							<img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'crosselling')}" alt="{$product.name|htmlspecialchars}" />
						</a><br/>
						<a href="{$product.link}" title="{$product.name|htmlspecialchars}">
							{$product.name|truncate:30:'...'|escape:'htmlall':'UTF-8'}
						</a>
						
						<div class="block_prices">
							<span class="price">
								<span class="in">
									{convertPrice price=$product.price}
								</span>
		
								{if $product.price_without_reduction neq $product.price}
									<span class="in barre">
										{convertPrice price=$product.price_without_reduction}
									</span>
								{/if}
		
								<span class="before"></span>
							</span>
						</div>
						
						<a class="button ajax_add_to_cart_button exclusive" href="{$product.link}" title="{$product.name|htmlspecialchars}">{l s='Voir details'}</a>
					</li>
				{/foreach}
			</ul>
		</div>
	
		{if count($products) > $nbView}<a id="accessorie_scroll_right" class="active" title="{l s='Next' mod='accessorie'}" href="javascript:{ldelim}{rdelim}">{l s='Next' mod='accessorie'}</a>{/if}
	</div>
	<div class="clear"></div>
{/if}
