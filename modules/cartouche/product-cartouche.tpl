<h2>{l s='Cartouche compatible avec les modeles suivant:'}</h2>

<div class="compatible">
	<ul>
		{foreach from=$tags item=item key=key}
			<li>
				<h3>{$key}</h3>
				<ul class="bullet left">
					{foreach from=$item item=subitem}
						<li{if $subitem.name_clean == $last_tag && $last_tag != ''} class="last_tag"{/if}><a href="{$link->getPageLink('search.php')}?tag={$subitem.name_clean|urlencode}">{$subitem.name_clean|escape:'htmlall':'UTF-8'}</a></li>
					{/foreach}

					<div class="clear"></div>
				</ul>
			</li>
		{/foreach}

		<div class="clear"></div>
		
		<div id=""><a href="{$link->getCategoryLink( $id_category_cartouches )}">{l s='Votre modele n\'est pas present ?'}</a></div>
	</ul>
</div>