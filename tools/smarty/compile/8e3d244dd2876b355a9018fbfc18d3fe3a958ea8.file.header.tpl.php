<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:20
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/header.tpl" */ ?>
<?php /*%%SmartyHeaderCode:18953545534e396fa4926ad9-75643017%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '8e3d244dd2876b355a9018fbfc18d3fe3a958ea8' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/header.tpl',
      1 => 1311955915,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '18953545534e396fa4926ad9-75643017',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<?php if (!is_callable('smarty_modifier_escape')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.escape.php';
if (!is_callable('smarty_modifier_date_format')) include '/homepages/13/d194332323/htdocs/www/tools/smarty/plugins/modifier.date_format.php';
?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $_smarty_tpl->getVariable('lang_iso')->value;?>
">
	<head>
		<title><?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_title')->value,'htmlall','UTF-8');?>
</title>
		<?php if (isset($_smarty_tpl->getVariable('meta_description',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_description')->value){?>
			<meta name="description" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_description')->value,'html','UTF-8');?>
" />
		<?php }?>
		<?php if (isset($_smarty_tpl->getVariable('meta_keywords',null,true,false)->value)&&$_smarty_tpl->getVariable('meta_keywords')->value){?>
			<meta name="keywords" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_keywords')->value,'html','UTF-8');?>
" />
		<?php }?>
		
		<meta property="og:title" content="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('meta_title')->value,'htmlall','UTF-8');?>
" />
		<?php if ($_smarty_tpl->getVariable('page_name')->value=='product'){?>
			<meta property="og:type" content="product" />
			<meta property="og:url" content="<?php echo $_smarty_tpl->getVariable('current_url')->value;?>
" />
			<meta property="og:image" content="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value->link_rewrite,$_smarty_tpl->getVariable('cover')->value['id_image'],'large');?>
" />
		<?php }?>
		<meta property="og:site_name" content="Surdiscount.com" />
		<meta property="fb:admins" content="545447247" />
		
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="<?php if (isset($_smarty_tpl->getVariable('nobots',null,true,false)->value)){?>no<?php }?>index,follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
favicon.ico?<?php echo $_smarty_tpl->getVariable('time')->value;?>
" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $_smarty_tpl->getVariable('img_ps_dir')->value;?>
favicon.ico?<?php echo $_smarty_tpl->getVariable('time')->value;?>
" />

		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.2/jquery.min.js"></script>

		<script type="text/javascript">
			var baseDir = '<?php echo $_smarty_tpl->getVariable('content_dir')->value;?>
';
			var static_token = '<?php echo $_smarty_tpl->getVariable('static_token')->value;?>
';
			var token = '<?php echo $_smarty_tpl->getVariable('token')->value;?>
';
			var priceDisplayPrecision = <?php echo $_smarty_tpl->getVariable('priceDisplayPrecision')->value*$_smarty_tpl->getVariable('currency')->value->decimals;?>
;
			var priceDisplayMethod = <?php echo $_smarty_tpl->getVariable('priceDisplay')->value;?>
;
			var roundMode = <?php echo $_smarty_tpl->getVariable('roundMode')->value;?>
;
		</script>

		<?php if (isset($_smarty_tpl->getVariable('css_files',null,true,false)->value)){?>
			<?php  $_smarty_tpl->tpl_vars['media'] = new Smarty_Variable;
 $_smarty_tpl->tpl_vars['css_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('css_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['media']->key => $_smarty_tpl->tpl_vars['media']->value){
 $_smarty_tpl->tpl_vars['css_uri']->value = $_smarty_tpl->tpl_vars['media']->key;
?>
			<link href="<?php echo $_smarty_tpl->tpl_vars['css_uri']->value;?>
<?php if ('DEBUG'){?>?<?php echo $_smarty_tpl->getVariable('time')->value;?>
<?php }?>" rel="stylesheet" type="text/css" media="<?php echo $_smarty_tpl->tpl_vars['media']->value;?>
" />
			<?php }} ?>
		<?php }?>
		<?php if (isset($_smarty_tpl->getVariable('js_files',null,true,false)->value)){?>
			<?php  $_smarty_tpl->tpl_vars['js_uri'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('js_files')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['js_uri']->key => $_smarty_tpl->tpl_vars['js_uri']->value){
?>
			<script type="text/javascript" src="<?php echo $_smarty_tpl->tpl_vars['js_uri']->value;?>
"></script>
			<?php }} ?>
		<?php }?>
		
		<link  href="http://fonts.googleapis.com/css?family=Bangers:regular" rel="stylesheet" type="text/css">

		<?php echo $_smarty_tpl->getVariable('HOOK_HEADER')->value;?>

	</head>
	
	<body <?php if ($_smarty_tpl->getVariable('page_name')->value){?>id="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('page_name')->value,'htmlall','UTF-8');?>
"<?php }?>>
		<?php if (isset($_smarty_tpl->getVariable('ad',null,true,false)->value)&&isset($_smarty_tpl->getVariable('live_edit',null,true,false)->value)){?>
			<?php $_template = new Smarty_Internal_Template(($_smarty_tpl->getVariable('tpl_dir')->value)."./live_edit.tpl", $_smarty_tpl->smarty, $_smarty_tpl, $_smarty_tpl->cache_id, $_smarty_tpl->compile_id, null, null);
 echo $_template->getRenderedTemplate();?><?php unset($_template);?>
		<?php }?>
		<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
			<?php if (isset($_smarty_tpl->getVariable('restricted_country_mode',null,true,false)->value)&&$_smarty_tpl->getVariable('restricted_country_mode')->value){?>
			<div id="restricted-country">
				<p><?php echo smartyTranslate(array('s'=>'You cannot place a new order from your country.'),$_smarty_tpl);?>
 <span class="bold"><?php echo $_smarty_tpl->getVariable('geolocation_country')->value;?>
</span></p>
			</div>
			<?php }?>
			<div id="page">
	
				<!-- Header -->
				<div id="header">
					<div id="logo"><a href="<?php echo $_smarty_tpl->getVariable('base_dir')->value;?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('shop_name')->value,'htmlall','UTF-8');?>
"></a></div>

					<div id="head2"<?php if ($_smarty_tpl->getVariable('isLogged')->value){?> class="logged"<?php }?>>
						<?php if ($_smarty_tpl->getVariable('isLogged')->value){?>
							<div id="login2SD">
								<a class="my_account" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('my-account.php');?>
"><?php echo smartyTranslate(array('s'=>"Mon compte",'mod'=>"header"),$_smarty_tpl);?>
</a>
								<a class="my_cart" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php');?>
"><?php echo smartyTranslate(array('s'=>"Mon panier",'mod'=>"header"),$_smarty_tpl);?>
</a>
								<a class="my_order" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('order.php');?>
?step=1"><?php echo smartyTranslate(array('s'=>"Commander",'mod'=>"header"),$_smarty_tpl);?>
</a>
								<a class="logout" href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('index.php');?>
?mylogout"><?php echo smartyTranslate(array('s'=>"Quitter",'mod'=>"header"),$_smarty_tpl);?>
</a>
								<div class="clear"></div>
							</div>
						<?php }else{ ?>
							<div id="loginSD">
								<form action="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('authentication.php');?>
" method="post" id="login_formSD">
									<label for="pseudo"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
images/logo_login.png" align="absmiddle"></label>
									<input type="text" data-type="text" data-alter="adresse email" class="account_input" name="email" id="pseudo" value="">
									
									<label for="pass"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
images/logo_pass.png" align="absmiddle"></label>
									<input type="text" data-type="password" data-alter="mot de passe" class="account_input"  name="passwd" id="pass" value="">

									<input title="Connection au site" type="image" src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
images/bt_send.png" align="absmiddle" name="SubmitLogin" /> <a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('authentication.php');?>
" title="Inscription au site"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
images/inscriptSD.png" align="absmiddle" /></a><a title="Vous avez perdus votre mot de passe c'est part ici !" href="/password.php">Mot de passe perdu ?</a>
								</form>
							</div>
						<?php }?>
					</div>

					
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
					
					
					<div id="telephone">
						<span>02.98.97.77.27</span>
					</div>
					
					<div id="navbar">
						<div id="promos"><a href="<?php echo $_smarty_tpl->getVariable('link')->value->getPageLink('prices-drop.php');?>
">promotions</a></div>
						<?php echo $_smarty_tpl->getVariable('HOOK_TOP')->value;?>

						<div class="clear"></div>
							<div class="debug" id="menu">
								<ul>
									<?php  $_smarty_tpl->tpl_vars['categorie'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('categories')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['categorie']->key => $_smarty_tpl->tpl_vars['categorie']->value){
?>
										<?php $_smarty_tpl->tpl_vars['class'] = new Smarty_variable('', null, null);?>
										<?php if (count($_smarty_tpl->tpl_vars['categorie']->value['children'])){?>
											<?php $_smarty_tpl->tpl_vars['class'] = new Smarty_variable('hasChild', null, null);?>
										<?php }?>
										
										<?php $_smarty_tpl->tpl_vars['menu'] = new Smarty_variable($_smarty_tpl->getVariable('menu_colors')->value[$_smarty_tpl->tpl_vars['categorie']->value['link_rewrite']], null, null);?>
		
										<li class="<?php echo $_smarty_tpl->getVariable('class')->value;?>
 <?php echo $_smarty_tpl->getVariable('menu')->value['name'];?>
" data-color_name="<?php echo $_smarty_tpl->getVariable('menu')->value['name'];?>
" data-color_hexa="<?php echo $_smarty_tpl->getVariable('menu')->value['hexa'];?>
" data-color_border="<?php echo $_smarty_tpl->getVariable('menu')->value['border'];?>
">
											<?php if (count($_smarty_tpl->tpl_vars['categorie']->value['children'])){?>
												<ul>
													<?php  $_smarty_tpl->tpl_vars['child'] = new Smarty_Variable;
 $_from = $_smarty_tpl->tpl_vars['categorie']->value['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['child']->key => $_smarty_tpl->tpl_vars['child']->value){
?>
														<li>
															<a class="text" href="<?php echo $_smarty_tpl->getVariable('link')->value->getCategoryLink($_smarty_tpl->tpl_vars['child']->value['id_category'],$_smarty_tpl->tpl_vars['child']->value['link_rewrite']);?>
"><?php echo $_smarty_tpl->tpl_vars['child']->value['name'];?>
</a>
														</li>
													<?php }} ?>
													<div class="clear"></div>
												</ul>
												
												<div class="promo">
													<?php $_smarty_tpl->tpl_vars['product'] = new Smarty_variable($_smarty_tpl->getVariable('menu')->value['promo'], null, null);?>

													<div class="center_block">
														<a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value['link'],'htmlall','UTF-8');?>
" class="product_img_link" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value['name'],'htmlall','UTF-8');?>
"><img src="<?php echo $_smarty_tpl->getVariable('link')->value->getImageLink($_smarty_tpl->getVariable('product')->value['link_rewrite'],$_smarty_tpl->getVariable('product')->value['id_image'],'home');?>
" alt="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value['legend'],'htmlall','UTF-8');?>
" width="<?php echo $_smarty_tpl->getVariable('img_menu_size')->value['width'];?>
" height="<?php echo $_smarty_tpl->getVariable('img_menu_size')->value['height'];?>
" /></a>
														<h3><a href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value['link'],'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value['name'],'htmlall','UTF-8');?>
"><?php echo smarty_modifier_escape(smarty_modifier_truncate($_smarty_tpl->getVariable('product')->value['name'],50,'...'),'htmlall','UTF-8');?>
</a></h3>
														<a class="button ajax_add_to_cart_button exclusive" href="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value['link'],'htmlall','UTF-8');?>
" title="<?php echo smarty_modifier_escape($_smarty_tpl->getVariable('product')->value['name'],'htmlall','UTF-8');?>
"><?php echo smartyTranslate(array('s'=>'Voir details'),$_smarty_tpl);?>
</a>
													</div>
													<div class="right_block">
														<!--
														<?php if ($_smarty_tpl->getVariable('product')->value['on_sale']){?>
															<span class="on_sale"><?php echo smartyTranslate(array('s'=>'On sale!'),$_smarty_tpl);?>
</span>
														<?php }elseif(($_smarty_tpl->getVariable('product')->value['reduction_price']!=0||$_smarty_tpl->getVariable('product')->value['reduction_percent']!=0)&&($_smarty_tpl->getVariable('product')->value['reduction_from']==$_smarty_tpl->getVariable('product')->value['reduction_to']||(smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')<=$_smarty_tpl->getVariable('product')->value['reduction_to']&&smarty_modifier_date_format(time(),'%Y-%m-%d %H:%M:%S')>=$_smarty_tpl->getVariable('product')->value['reduction_from']))){?>
															<span class="discount"><?php echo smartyTranslate(array('s'=>'Price lowered!'),$_smarty_tpl);?>
</span>
														<?php }?>
														-->
										
														<div class="block_prices">
															<span class="price">
																<span class="in">
																	<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('product')->value['price']),$_smarty_tpl);?>

																</span>
										
																<?php if ($_smarty_tpl->getVariable('product')->value['price_without_reduction']!=$_smarty_tpl->getVariable('product')->value['price']){?>
																	<span class="in barre">
																		<?php echo Product::convertPrice(array('price'=>$_smarty_tpl->getVariable('product')->value['price_without_reduction']),$_smarty_tpl);?>

																	</span>
																<?php }?>
										
																<span class="before"></span>
															</span>
														</div>
													</div>
												</div>

												<?php $_smarty_tpl->tpl_vars['class'] = new Smarty_variable('hasChild', null, null);?>
											<?php }?>
											
											<a href="<?php echo $_smarty_tpl->getVariable('link')->value->getCategoryLink($_smarty_tpl->tpl_vars['categorie']->value['id_category'],$_smarty_tpl->tpl_vars['categorie']->value['link_rewrite']);?>
"><?php echo $_smarty_tpl->tpl_vars['categorie']->value['name'];?>
</a>
										</li>
									<?php }} ?>
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
						<?php echo $_smarty_tpl->getVariable('HOOK_LEFT_COLUMN')->value;?>

					</div>
	
					<!-- Center -->
					<div id="center_column">
		<?php }?>
