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

{if isset($products)}
	<!-- Products list -->
	<ul id="product_list" class="clear">
	{foreach from=$products item=product name=products}
		<li class="ajax_block_product {if $smarty.foreach.products.first}first_item{elseif $smarty.foreach.products.last}last_item{/if} {if $smarty.foreach.products.index % 2}alternate_item{else}item{/if} clearfix">
			<div class="center_block">
				<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="{$product.name|escape:'htmlall':'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'listing')}" alt="{$product.legend|escape:'htmlall':'UTF-8'}" width="{$listingSize.width}" height="{$listingSize.height}" /></a>
				<h3>{if $product.new == 1}<span class="new">{l s='new'}</span>{/if}<a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}</a></h3>
				<a class="button ajax_add_to_cart_button exclusive" href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{l s='Voir details'}</a>
			</div>
			<div class="right_block">
				<!--
				{if $product.on_sale}
					<span class="on_sale">{l s='On sale!'}</span>
				{elseif ($product.reduction_price != 0 || $product.reduction_percent != 0) && ($product.reduction_from == $product.reduction_to OR ($smarty.now|date_format:'%Y-%m-%d %H:%M:%S' <= $product.reduction_to && $smarty.now|date_format:'%Y-%m-%d %H:%M:%S' >= $product.reduction_from))}
					<span class="discount">{l s='Price lowered!'}</span>
				{/if}
				-->

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

					<span class="availability">{if ($product.allow_oosp OR $product.quantity > 0)}{l s='Available'}{else}{l s='Out of stock'}{/if}</span>
				</div>
			</div>
		</li>
	{/foreach}
	</ul>
	<!-- /Products list -->
{/if}