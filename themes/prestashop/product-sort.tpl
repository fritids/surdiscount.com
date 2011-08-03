{if isset($orderby) AND isset($orderway)}
	<!-- Sort products -->
	{if $smarty.get.id_category|intval}
		{assign var='request' value=$link->getPaginationLink('category', $category, false, true)}
	{elseif $smarty.get.id_manufacturer|intval}
		{assign var='request' value=$link->getPaginationLink('manufacturer', $manufacturer, false, true)}
	{elseif $smarty.get.id_supplier|intval}
		{assign var='request' value=$link->getPaginationLink('supplier', $supplier, false, true)}
	{else}
		{assign var='request' value=$link->getPaginationLink(false, false, false, true)}
	{/if}

	<form id="productsSortForm" action="{$request}">
		{if $manufacturers}
			<p class="select">
				<select id="selectManuFilter" name="filter_manufacturer">
					<option value="0" selected="selected">{l s='--'}</option>
	
					{foreach from=$manufacturers item=manufacturer name=manufacturer}
						<option value="{$manufacturer.id}" {if $filter_manufacturer == $manufacturer.id}selected="selected"{/if}>{$manufacturer.name}</option>
					{/foreach}
				</select>
				<label for="selectManuFilter">{l s='Manufacturer'}</label>
			</p>
		{/if}

		<p class="select">
			<select id="selectPrductSort" onchange="document.location.href = $(this).val();">
				<option value="{$link->addSortDetails($request, $orderbydefault, $orderwaydefault)|escape:'htmlall':'UTF-8'}" {if $orderby eq $orderbydefault}selected="selected"{/if}>{l s='--'}</option>

				{if !$PS_CATALOG_MODE}
					<option value="{$link->addSortDetails($request, 'price', 'asc')|escape:'htmlall':'UTF-8'}" {if $orderby eq 'price' AND $orderway eq 'asc'}selected="selected"{/if}>{l s='Price: lowest first'}</option>
					<option value="{$link->addSortDetails($request, 'price', 'desc')|escape:'htmlall':'UTF-8'}" {if $orderby eq 'price' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='Price: highest first'}</option>
				{/if}

				<option value="{$link->addSortDetails($request, 'name', 'asc')|escape:'htmlall':'UTF-8'}" {if $orderby eq 'name' AND $orderway eq 'asc'}selected="selected"{/if}>{l s='Product Name: A to Z'}</option>
				<option value="{$link->addSortDetails($request, 'name', 'desc')|escape:'htmlall':'UTF-8'}" {if $orderby eq 'name' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='Product Name: Z to A'}</option>

				{if !$PS_CATALOG_MODE}
					<option value="{$link->addSortDetails($request, 'quantity', 'desc')|escape:'htmlall':'UTF-8'}" {if $orderby eq 'quantity' AND $orderway eq 'desc'}selected="selected"{/if}>{l s='In-stock first'}</option>
				{/if}
			</select>
			<label for="selectPrductSort">{l s='Sort by'}</label>
		</p>

		<div class="clear"></div>
	</form>

	{literal}
	<script type="text/javascript">
		$('form#productsSortForm p select').live('change', function(){
			var filter_manufacturer = $('#selectManuFilter').val();
			var filter_sort = $('#selectPrductSort').val().split(':');
			
			var request = '{/literal}{$request}{literal}';
			request = request.split('?');
			
			var url = request[0]+'?orderby='+filter_sort[0]+'&orderway='+filter_sort[1]+'&filter_manufacturer='+filter_manufacturer;
			
			document.location.href = url;
		});
	</script>
	{/literal}
	<!-- /Sort products -->
{/if}
