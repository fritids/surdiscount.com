{*
* 2007-2011 PrestaShop 
*
* NOTICE OF LICENSE
*
* This source file is subject to the Academic Free License (AFL 3.0)
* that is bundled with this package in the file LICENSE.txt.
* It is also available through the world-wide-web at this URL:
* http://opensource.org/licenses/afl-3.0.php
* If you did not receive a copy of the license and are unable to
* obtain it through the world-wide-web, please send an email
* to license@prestashop.com so we can send you a copy immediately.
*
* DISCLAIMER
*
* Do not edit or add to this file if you wish to upgrade PrestaShop to newer
* versions in the future. If you wish to customize PrestaShop for your
* needs please refer to http://www.prestashop.com for more information.
*
*  @author PrestaShop SA <contact@prestashop.com>
*  @copyright  2007-2011 PrestaShop SA
*  @version  Release: $Revision: 1.4 $
*  @license    http://opensource.org/licenses/afl-3.0.php  Academic Free License (AFL 3.0)
*  International Registered Trademark & Property of PrestaShop SA
*}

<!-- Block stores module -->
<div id="stores_block_left" class="block">
	<h4><a href="{$link->getPageLink('stores.php')}" title="{l s='Our stores' mod='blockstore'}">{l s='Our stores' mod='blockstore'}</a></h4>
	<div class="block_content blockstore">
		{foreach from=$stores item=item}
			<p>
				<a href="{$link->getPageLink('store.php')}?id_store={$item.id_store}" title="{$item.name} - {$item.city}"><img src="{$img_store_dir}{$item.id_store}-blockStore.jpg" alt="{$item.name} - {$item.city}" width="{$blockStore.width}" height="{$blockStore.height}" /></a><br />
				<a href="{$link->getPageLink('store.php')}?id_store={$item.id_store}" title="{$item.name} - {$item.city}">{$item.name} - {$item.city}</a>
			</p>
		{/foreach}
	</div>
</div>
<!-- /Block stores module -->
