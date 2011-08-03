{if $products}
	{include file="$tpl_dir./product-list.tpl" products=$products}
{else}
	<p class="warning">{l s='There are no products.'}</p>
{/if}