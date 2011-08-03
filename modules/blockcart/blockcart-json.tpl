{ldelim}
	"discounts": [],
	"shippingCost": "{$shipping_cost|html_entity_decode:2:'UTF-8'}",
	"wrappingCost": "{$wrapping_cost|html_entity_decode:2:'UTF-8'}",
	"nbTotalProducts": "{$nb_total_products}",
	"total": "{$total|html_entity_decode:2:'UTF-8'}",
	"productTotal": "{$product_total|html_entity_decode:2:'UTF-8'}",

	{if isset($errors) && $errors}
		"hasError" : true,
		errors : {ldelim}
			{foreach from=$errors key=k item=error name='errors'}
				"{$error|addslashes|html_entity_decode:2:'UTF-8'}"
				{if !$smarty.foreach.errors.last},{/if}
			{/foreach}
		{rdelim}
	{else}
		"hasError" : false
	{/if}
{rdelim}