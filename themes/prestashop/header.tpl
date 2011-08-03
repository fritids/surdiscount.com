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

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="{$lang_iso}">
	<head>
		<title>{$meta_title|escape:'htmlall':'UTF-8'}</title>
		{if isset($meta_description) AND $meta_description}
			<meta name="description" content="{$meta_description|escape:html:'UTF-8'}" />
		{/if}
		{if isset($meta_keywords) AND $meta_keywords}
			<meta name="keywords" content="{$meta_keywords|escape:html:'UTF-8'}" />
		{/if}
		
		<meta property="og:title" content="{$meta_title|escape:'htmlall':'UTF-8'}" />
		{if $page_name == 'product'}
			<meta property="og:type" content="product" />
			<meta property="og:url" content="{$current_url}" />
			<meta property="og:image" content="{$link->getImageLink($product->link_rewrite, $cover.id_image, 'large')}" />
		{/if}
		<meta property="og:site_name" content="Surdiscount.com" />
		<meta property="fb:admins" content="545447247" />
		
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="{if isset($nobots)}no{/if}index,follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="{$img_ps_dir}favicon.ico?{$time}" />
		<link rel="shortcut icon" type="image/x-icon" href="{$img_ps_dir}favicon.ico?{$time}" />

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

		<script type="text/javascript">
			var baseDir = '{$content_dir}';
			var static_token = '{$static_token}';
			var token = '{$token}';
			var priceDisplayPrecision = {$priceDisplayPrecision*$currency->decimals};
			var priceDisplayMethod = {$priceDisplay};
			var roundMode = {$roundMode};
		</script>

		{if isset($css_files)}
			{foreach from=$css_files key=css_uri item=media}
			<link href="{$css_uri}{if DEBUG}?{$time}{/if}" rel="stylesheet" type="text/css" media="{$media}" />
			{/foreach}
		{/if}
		{if isset($js_files)}
			{foreach from=$js_files item=js_uri}
			<script type="text/javascript" src="{$js_uri}"></script>
			{/foreach}
		{/if}
		
		<link  href="http://fonts.googleapis.com/css?family=Bangers:regular" rel="stylesheet" type="text/css">

		{$HOOK_HEADER}
	</head>
	
	<body {if $page_name}id="{$page_name|escape:'htmlall':'UTF-8'}"{/if}>
		{if isset($ad) && isset($live_edit)}
			{include file="$tpl_dir./live_edit.tpl"}
		{/if}
		{if !$content_only}
			{if isset($restricted_country_mode) && $restricted_country_mode}
			<div id="restricted-country">
				<p>{l s='You cannot place a new order from your country.'} <span class="bold">{$geolocation_country}</span></p>
			</div>
			{/if}
			<div id="page">
	
				<!-- Header -->
				<div id="header">
					<div id="logo"><a href="{$base_dir}" title="{$shop_name|escape:'htmlall':'UTF-8'}"></a></div>

					<div id="head2"{if $isLogged} class="logged"{/if}>
						{if $isLogged}
							<div id="login2SD">
								<a class="my_account" href="{$link->getPageLink('my-account.php')}">{l s="Mon compte" mod="header"}</a>
								<a class="my_cart" href="{$link->getPageLink('order.php')}">{l s="Mon panier" mod="header"}</a>
								<a class="my_order" href="{$link->getPageLink('order.php')}?step=1">{l s="Commander" mod="header"}</a>
								<a class="logout" href="{$link->getPageLink('index.php')}?mylogout">{l s="Quitter" mod="header"}</a>
								<div class="clear"></div>
							</div>
						{else}
							<div id="loginSD">
								<form action="{$link->getPageLink('authentication.php')}" method="post" id="login_formSD">
									<label for="pseudo"><img src="{$img_dir}images/logo_login.png" align="absmiddle"></label>
									<input type="text" data-type="text" data-alter="adresse email" class="account_input" name="email" id="pseudo" value="">
									
									<label for="pass"><img src="{$img_dir}images/logo_pass.png" align="absmiddle"></label>
									<input type="text" data-type="password" data-alter="mot de passe" class="account_input"  name="passwd" id="pass" value="">

									<input title="Connection au site" type="image" src="{$img_dir}images/bt_send.png" align="absmiddle" name="SubmitLogin" /> <a href="{$link->getPageLink('authentication.php')}" title="Inscription au site"><img src="{$img_dir}images/inscriptSD.png" align="absmiddle" /></a><a title="Vous avez perdus votre mot de passe c'est part ici !" href="/password.php">Mot de passe perdu ?</a>
								</form>
							</div>
						{/if}
					</div>

					{literal}
					<script type="text/javascript">
						$('#loginSD input.account_input').val(function(){
							return $(this).data('alter');
						}).css('color', '#7f7f7f');
						
						$('#loginSD input.account_input').live( 'focusin focusout', function( e ) {
							var $_this = $(this);
							var oldType = $_this.data('type');
							
							if ( $_this.val() == $_this.data('alter') ) {
								$_this.val('');
								this.type = oldType;
								$_this.css('color', '#000');
								$_this.focus();
							}
							else if ( $_this.val() == '' ) {
								$_this.val( $_this.data('alter') );
								this.type = 'text';
								$_this.css('color', '#7f7f7f');
							}
						});
						
						$("#login2SD a img").live('mouseenter', function () {
							$(this).animate({ "top": "-5" }, 500);
						});
						
						$("#login2SD a img").live('mouseleave', function () {
							$(this).animate({ "top": "0" }, 500);
						});
						
						$('li.hasChild').live('mouseenter', function(e){
							var $subCat = $(this).find('ul');
							var $promo = $(this).find('.promo');
							
							if ( !$('#content-menu').length ) {
								$('body').append('<div class="debug" id="content-menu"></div>');
							}
							
							var offsetMenu = $('#navbar #menu').offset();

							$('#content-menu').css({
								'position': 'absolute',
								'top': parseInt( offsetMenu.top ) + parseInt( $('#navbar #menu').height() ),
								'left': parseInt( offsetMenu.left ) + parseInt( $('#navbar #menu li').css('margin-left') ) + 1,
								'width': parseInt( $('#navbar #menu').width() ) - parseInt( $('#navbar #menu li').css('margin-left') ) - 13
							});
							$('#content-menu').html('<div id="content-menu-in"><div id="submenu"><ul>'+$subCat.html()+'</ul></div><div id="promo" class="debug"></div><div class="clear"></div></div>').addClass('hover').data('menu', $(this));
							$('#content-menu #promo').html($promo.html());
							
							$('#content-menu').css('background-color', $(this).data('color_border'));
							//$('#content-menu-in').css({ 'margin-top': '10px', 'border-top': '1px solid rgba(255, 255, 255, 0.5)', 'background-color': $(this).data('color_hexa') });
							
							$('#content-menu').show();
							$(this).addClass('hover');
						})
						
						$('li.hasChild').live('mouseleave', function(e){
							$('#content-menu').hide();
							$(this).removeClass('hover');
						})
						
						$('#content-menu').live('mouseenter', function(e){
							$('#content-menu').data('menu').addClass('hover');
							$('#content-menu').show();
						});
						
						$('#content-menu').live('mouseleave', function(e){
							$('#content-menu').data('menu').removeClass('hover');
							$('#content-menu').hide();
						});
					</script>
					{/literal}
					
					<div id="telephone">
						<span>02.98.97.77.27</span>
					</div>
					
					<div id="navbar">
						<div id="promos"><a href="{$link->getPageLink('prices-drop.php')}">promotions</a></div>
						{$HOOK_TOP}
						<div class="clear"></div>
							<div class="debug" id="menu">
								<ul>
									{foreach from=$categories item='categorie' name=categorie}
										{assign var='class' value=''}
										{if count( $categorie.children )}
											{assign var='class' value='hasChild'}
										{/if}
										
										{assign var='menu' value=$menu_colors[$categorie.link_rewrite]}
		
										<li class="{$class} {$menu.name}" data-color_name="{$menu.name}" data-color_hexa="{$menu.hexa}" data-color_border="{$menu.border}">
											{if count( $categorie.children )}
												<ul>
													{foreach from=$categorie.children item='child' name=child}
														<li>
															<a class="text" href="{$link->getCategoryLink($child.id_category, $child.link_rewrite)}">{$child.name}</a>
														</li>
													{/foreach}
													<div class="clear"></div>
												</ul>
												
												<div class="promo">
													{assign var='product' value=$menu.promo}

													<div class="center_block">
														<a href="{$product.link|escape:'htmlall':'UTF-8'}" class="product_img_link" title="{$product.name|escape:'htmlall':'UTF-8'}"><img src="{$link->getImageLink($product.link_rewrite, $product.id_image, 'home')}" alt="{$product.legend|escape:'htmlall':'UTF-8'}" width="{$img_menu_size.width}" height="{$img_menu_size.height}" /></a>
														<h3><a href="{$product.link|escape:'htmlall':'UTF-8'}" title="{$product.name|escape:'htmlall':'UTF-8'}">{$product.name|truncate:50:'...'|escape:'htmlall':'UTF-8'}</a></h3>
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
														</div>
													</div>
												</div>

												{assign var='class' value='hasChild'}
											{/if}
											
											<a href="{$link->getCategoryLink($categorie.id_category, $categorie.link_rewrite)}">{$categorie.name}</a>
										</li>
									{/foreach}
									<div class="clear"></div>
								</ul>
							</div>
						<div class="clear"></div>
					</div>
					
					<div class="clear"></div>
				</div>

				<div id="columns">
					<!-- Left -->
					<div id="left_column" class="column">
						{$HOOK_LEFT_COLUMN}
					</div>
	
					<!-- Center -->
					<div id="center_column">
		{/if}
