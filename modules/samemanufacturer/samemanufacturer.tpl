{assign var='nbView' value='3'}

{if count($orderProducts) > 0}
	<script type="text/javascript">var middle = {$middlePosition_samemanufacturer};</script>
	<script type="text/javascript" src="{$content_dir}modules/samemanufacturer/js/samemanufacturer.js"></script>
	
	<h2>{l s='Product of the manufacturer: ' mod='samemanufacturer'} {$manufacturer_name}</h2>

	<div id="{if count($orderProducts) > $nbView}samemanufacturer{else}samemanufacturer_noscroll{/if}">
		{if count($orderProducts) > $nbView}<a id="samemanufacturer_scroll_left" class="active" title="{l s='Previous' mod='samemanufacturer'}" href="javascript:{ldelim}{rdelim}">{l s='Previous' mod='samemanufacturer'}</a>{/if}
		
		<div id="samemanufacturer_list"{if count($orderProducts) <= $nbView} style="width: inherit;"{/if}>
			<ul {if count($orderProducts) > $nbView}style="width: {math equation="((width / nbView) * nbImages)+1000" width=710 nbView=$nbView nbImages=$orderProducts|@count}px"{/if}>
				{foreach from=$orderProducts item='orderProduct' name=orderProduct}
					<li {if count($orderProducts) <= $nbView}style="width: {math equation="( width - ( margin * 2 * nbImages ) ) / nbImages" width=750 margin=11 nbImages=$orderProducts|@count}px"{/if}>
						<a href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}">
							<img src="{$orderProduct.image}" alt="{$orderProduct.name|htmlspecialchars}" />
						</a><br/>
						<a href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}">
							{$orderProduct.name|truncate:30:'...'|escape:'htmlall':'UTF-8'}
						</a>
						
						<div class="block_prices">
							<span class="price">
								<span class="before"></span>

								{if $orderProduct.price_without_reduction neq $orderProduct.price}
									<span class="in barre">
										{convertPrice price=$orderProduct.price_without_reduction}
									</span>
								{/if}
		
								<span class="in">
									{convertPrice price=$orderProduct.price}
								</span>
							</span>
						</div>
						
						<a class="button ajax_add_to_cart_button exclusive" href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}">{l s='Voir details'}</a>
					</li>
				{/foreach}
			</ul>
		</div>
	
		{if count($orderProducts) > $nbView}<a id="samemanufacturer_scroll_right" class="active" title="{l s='Next' mod='samemanufacturer'}" href="javascript:{ldelim}{rdelim}">{l s='Next' mod='samemanufacturer'}</a>{/if}
	</div>
	<div class="clear"></div>
{/if}
