{assign var='nbView' value='3'}

{if count($orderProducts) > 0}
	<script type="text/javascript">var middle = {$middlePosition_crossselling};</script>
	<script type="text/javascript" src="{$content_dir}modules/crossselling/js/crossselling.js"></script>
	
	{if $samecat == 'on'}
		<h2>{l s='Product of the category:' mod='crossselling'}</h2>
	{else}
		<h2>{l s='Customers who bought this product also bought:' mod='crossselling'}</h2>
	{/if}

	<div id="{if count($orderProducts) > $nbView}crossselling{else}crossselling_noscroll{/if}">
		{if count($orderProducts) > $nbView}<a id="crossselling_scroll_left" class="active" title="{l s='Previous' mod='crossselling'}" href="javascript:{ldelim}{rdelim}">{l s='Previous' mod='crossselling'}</a>{/if}
		
		<div id="crossselling_list"{if count($orderProducts) <= $nbView} style="width: inherit;"{/if}>
			<ul {if count($orderProducts) > $nbView}style="width: {math equation="((width / nbView) * nbImages)+1000" width=710 nbView=$nbView nbImages=$orderProducts|@count}px"{/if}>
				{foreach from=$orderProducts item='orderProduct' name=orderProduct}
					<li {if count($orderProducts) <= $nbView}style="width: {math equation="( width - ( margin * 2 * nbImages ) ) / nbImages" width=750 margin=11 nbImages=$orderProducts|@count}px"{/if}>
						<a href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}">
							<img src="{$orderProduct.image}" alt="{$orderProduct.name|htmlspecialchars}" />
						</a><br/>
						<a href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}">
							{$orderProduct.name|truncate:30:'...'|escape:'htmlall':'UTF-8'}
						</a>
						
						{if $orderProduct.price > 0}
							<div class="block_prices">
								<span class="price">
									<span class="in">
										{convertPrice price=$orderProduct.price}
									</span>
	
									{if $orderProduct.price_without_reduction neq $orderProduct.price}
										<span class="in barre">
											{convertPrice price=$orderProduct.price_without_reduction}
										</span>
									{/if}
			
									<span class="before"></span>
								</span>
							</div>
						{/if}
						
						<a class="button ajax_add_to_cart_button exclusive" href="{$orderProduct.link}" title="{$orderProduct.name|htmlspecialchars}">{l s='Voir details'}</a>
					</li>
				{/foreach}
			</ul>
		</div>
	
		{if count($orderProducts) > $nbView}<a id="crossselling_scroll_right" class="active" title="{l s='Next' mod='crossselling'}" href="javascript:{ldelim}{rdelim}">{l s='Next' mod='crossselling'}</a>{/if}
	</div>
	<div class="clear"></div>
{/if}
