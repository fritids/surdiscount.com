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

<script type="text/javascript" src="{$base_dir}js/jquery/jquery.jgrowl-1.2.1.min.js"></script>
<link href="{$base_dir}css/jquery.jgrowl.css" rel="stylesheet" type="text/css" />

<script type="text/javascript">
$(document).ready(function() {ldelim}
	{if isset($nb_people)}$.jGrowl('{$nb_people} {if $nb_people == 1}{l s='person is currently watching' mod='producttooltip'}{else}{l s='people are currently watching' mod='producttooltip'}{/if} {l s='this product' mod='producttooltip'}', {literal}{ life: 3500 }{/literal});{/if}
	{if isset($date_last_order)}$.jGrowl('{l s='This product was bought last' mod='producttooltip'} {dateFormat date=$date_last_order full=1}', {literal}{ life: 3500 }{/literal});{/if}
	{if isset($date_last_cart)}$.jGrowl('{l s='This product was added to cart last' mod='producttooltip'} {dateFormat date=$date_last_cart full=1}', {literal}{ life: 3500 }{/literal});{/if}
{rdelim});
</script>
