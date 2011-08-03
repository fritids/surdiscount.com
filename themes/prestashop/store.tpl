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

{capture name=path}{$Store->name} - {$Store->city}{/capture}
{include file="$tpl_dir./breadcrumb.tpl"}

<h1>{$Store->name} - {$Store->city}</h1>

<div id="infos_store">
	<div class="address">
		<h2>{l s='Adresse'}</h2>

		{if $Store->address1}<p class="street">{$Store->address1}</p>{/if}
		{if $Store->address2}<p class="streetbis">{$Store->address2}</p>{/if}
		{if $Store->postcode}<p class="codepostal">{$Store->postcode}</p>{/if}
		{if $Store->city}<p class="city">{$Store->city}</p>{/if}
		{if $Store->getCountry()}<p class="country">{$Store->getCountry()}</p>{/if}
		{if $Store->getState()}<p class="state">{$Store->getState()}</p>{/if}
		
	</div>
	<div class="contact">
		<h2>{l s='Contact'}</h2>

		{if $Store->email}
			<p class="email">
				<label>{l s='Email:'}</label>
				<span>{$Store->email}</span>
				<span class="clear"></span>
			</p>
		{/if}
		
		{if $Store->phone}
			<p class="telephone">
				<label>{l s='Telephone:'}</label>
				<span>{$Store->phone}</span>
				<span class="clear"></span>
			</p>
		{/if}
		
		{if $Store->fax}
			<p class="fax">
				<label>{l s='Fax:'}</label>
				<span>{$Store->fax}</span>
				<span class="clear"></span>
			</p>
		{/if}
	</div>
	<div class="horaires">
		<h2>{l s='Horaires'}</h2>
		
		{foreach from=$Store->getHours() item=hour key=key}
			{if $hour}
				<p>
					<label>{$days[$key]}:</label>
					<span>{$hour}</span>
					<span class="clear"></span>
				</p>
			{/if}
		{/foreach}
	</div>
	
	{if $Store->id == 1}
		<iframe width="100%" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps?f=q&source=s_q&hl=fr&geocode=&q=surdiscount,+16+avenue+de+ty+douar,+29000+Quimper&aq=&sll=46.75984,1.738281&sspn=8.806411,19.665527&ie=UTF8&hq=surdiscount,+16+avenue+de+ty+douar,&hnear=Quimper,+Finist%C3%A8re,+Bretagne&ll=47.98096,-4.076786&spn=0.055155,0.109863&z=13&iwloc=A&output=embed"></iframe>
	{elseif $Store->id == 2}
		<iframe width="100%" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=surdiscount+Kerouel,+29910+Tr%C3%A9gunc&amp;aq=&amp;sll=47.856885,-3.862467&amp;sspn=0.033691,0.076818&amp;ie=UTF8&amp;hq=surdiscount&amp;hnear=Kerouel,+29910+Tr%C3%A9gunc,+Finist%C3%A8re,+Bretagne&amp;z=14&amp;iwloc=A&amp;cid=10361847265560566111&amp;ll=47.85687,-3.862492&amp;output=embed"></iframe>
	{elseif $Store->id == 3}
		<iframe width="100%" height="480" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="http://maps.google.fr/maps?f=q&amp;source=s_q&amp;hl=fr&amp;geocode=&amp;q=10+rue+de+coat+meur+29400++Landivisiau&amp;aq=&amp;sll=48.166085,-3.070679&amp;sspn=2.051753,4.916382&amp;ie=UTF8&amp;hq=&amp;hnear=Coat+Meur,+29400+Landivisiau,+Finist%C3%A8re,+Bretagne&amp;ll=48.506332,-4.053389&amp;spn=0.008317,0.019205&amp;z=14&amp;output=embed"></iframe>
	{/if}
	
	{if $Store->note}
		<div class="commentaire">
			{$Store->note}
		</div>
	{/if}
	
	<div class="photo">
		<!--<h2>{l s='Photo'}</h2>-->

		<p>			
			{foreach from=$Store->getImages( $Store->id ) item=item}
				<img src="{$img_store_dir}mags/{$Store->id}/{$item|basename}" alt="{$Store->name} - {$Store->city}" title="{$Store->name} - {$Store->city}" width="{$storeSize.width}" />	
			{/foreach}
		</p>
	</div>
</div>