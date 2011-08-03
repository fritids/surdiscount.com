<?php /* Smarty version 2.6.20, created on 2011-03-23 15:04:44
         compiled from /homepages/13/d194332323/htdocs/beta/themes/surdiscount/header.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'escape', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/header.tpl', 4, false),array('function', 'l', '/homepages/13/d194332323/htdocs/beta/themes/surdiscount/header.tpl', 61, false),)), $this); ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="<?php echo $this->_tpl_vars['lang_iso']; ?>
">
	<head>
		<title><?php echo ((is_array($_tmp=$this->_tpl_vars['meta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
</title>
		<?php if (isset ( $this->_tpl_vars['meta_description'] ) && $this->_tpl_vars['meta_description']): ?>
			<meta name="description" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['meta_description'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" />
		<?php endif; ?>
		<?php if (isset ( $this->_tpl_vars['meta_keywords'] ) && $this->_tpl_vars['meta_keywords']): ?>
			<meta name="keywords" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['meta_keywords'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html', 'UTF-8') : smarty_modifier_escape($_tmp, 'html', 'UTF-8')); ?>
" />
		<?php endif; ?>
		
		<meta property="og:title" content="<?php echo ((is_array($_tmp=$this->_tpl_vars['meta_title'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
" />
		<?php if ($this->_tpl_vars['page_name'] == 'product'): ?>
			<meta property="og:type" content="product" />
			<meta property="og:url" content="<?php echo $this->_tpl_vars['current_url']; ?>
" />
			<meta property="og:image" content="<?php echo $this->_tpl_vars['link']->getImageLink($this->_tpl_vars['product']->link_rewrite,$this->_tpl_vars['cover']['id_image'],'large'); ?>
" />
		<?php endif; ?>
		<meta property="og:site_name" content="Surdiscount.com" />
		<meta property="fb:admins" content="545447247" />
		
		<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8" />
		<meta name="generator" content="PrestaShop" />
		<meta name="robots" content="<?php if (isset ( $this->_tpl_vars['nobots'] )): ?>no<?php endif; ?>index,follow" />
		<link rel="icon" type="image/vnd.microsoft.icon" href="<?php echo $this->_tpl_vars['img_dir']; ?>
favicon.ico" />
		<link rel="shortcut icon" type="image/x-icon" href="<?php echo $this->_tpl_vars['img_dir']; ?>
favicon.ico" />
		<?php if (isset ( $this->_tpl_vars['css_files'] )): ?>
			<?php $_from = $this->_tpl_vars['css_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['css_uri'] => $this->_tpl_vars['media']):
?>
				<link href="<?php echo $this->_tpl_vars['css_uri']; ?>
" rel="stylesheet" type="text/css" media="<?php echo $this->_tpl_vars['media']; ?>
" />
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.5.1/jquery.min.js"></script>

		<script type="text/javascript">
			var baseDir = '<?php echo $this->_tpl_vars['content_dir']; ?>
';
			var static_token = '<?php echo $this->_tpl_vars['static_token']; ?>
';
			var token = '<?php echo $this->_tpl_vars['token']; ?>
';
			var priceDisplayPrecision = <?php echo $this->_tpl_vars['priceDisplayPrecision']*$this->_tpl_vars['currency']->decimals; ?>
;
			var roundMode = <?php echo $this->_tpl_vars['roundMode']; ?>
;
		</script>


		<?php if (isset ( $this->_tpl_vars['js_files'] )): ?>
			<?php $_from = $this->_tpl_vars['js_files']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['js_uri']):
?>
				<script type="text/javascript" src="<?php echo $this->_tpl_vars['js_uri']; ?>
"></script>
			<?php endforeach; endif; unset($_from); ?>
		<?php endif; ?>
		<?php echo $this->_tpl_vars['HOOK_HEADER']; ?>

	</head>
	
	<body <?php if ($this->_tpl_vars['page_name']): ?>id="<?php echo ((is_array($_tmp=$this->_tpl_vars['page_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"<?php endif; ?>>
		<?php if (! $this->_tpl_vars['content_only']): ?>
			<div id="page">
	
				<!-- Header -->
				<div id="header">
					<div id="logo"><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['shop_name'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'htmlall', 'UTF-8') : smarty_modifier_escape($_tmp, 'htmlall', 'UTF-8')); ?>
"></a></div>

					<div id="head2"<?php if ($this->_tpl_vars['isLogged']): ?> class="logged"<?php endif; ?>>
						<?php if ($this->_tpl_vars['isLogged']): ?>
							<div id="login2SD">
								<a class="my_account" href='<?php echo $this->_tpl_vars['base_dir']; ?>
my-account.php'><?php echo smartyTranslate(array('s' => 'Mon compte','mod' => 'header'), $this);?>
</a>
								<a class="my_cart" href='<?php echo $this->_tpl_vars['base_dir']; ?>
order.php'><?php echo smartyTranslate(array('s' => 'Mon panier','mod' => 'header'), $this);?>
</a>
								<a class="my_order" href='<?php echo $this->_tpl_vars['base_dir']; ?>
order.php?step=1'><?php echo smartyTranslate(array('s' => 'Commander','mod' => 'header'), $this);?>
</a>
								<a class="logout" href='<?php echo $this->_tpl_vars['base_dir']; ?>
index.php?mylogout'><?php echo smartyTranslate(array('s' => 'Quitter','mod' => 'header'), $this);?>
</a>
								<div class="clear"></div>
							</div>
						<?php else: ?>
							<div id="loginSD">
								<form action="<?php echo $this->_tpl_vars['base_dir']; ?>
authentication.php" method="post" id="login_formSD">
									<input type="hidden" value="<?php echo $this->_tpl_vars['back']; ?>
" name="back"/>

									<label for="pseudo"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
images/logo_login.png" align="absmiddle"></label>
									<input type="text" data-type="text" data-alter="adresse email" class="account_input" name="email" id="pseudo" value="">
									
									<label for="pass"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
images/logo_pass.png" align="absmiddle"></label>
									<input type="text" data-type="password" data-alter="mot de passe" class="account_input"  name="passwd" id="pass" value="">

									<input title="Connection au site" type="image" src="<?php echo $this->_tpl_vars['img_dir']; ?>
images/bt_send.png" align="absmiddle" name="SubmitLogin" /> <a href='<?php echo $this->_tpl_vars['base_dir']; ?>
authentication.php' title="Inscription au site"><img src="<?php echo $this->_tpl_vars['img_dir']; ?>
images/inscriptSD.png" align="absmiddle" /></a><a title="Vous avez perdus votre mot de passe c'est part ici !" href='<?php echo $this->_tpl_vars['base_dir']; ?>
password.php'>Mot de passe perdu ?</a>
								</form>
							</div>
						<?php endif; ?>
					</div>
					
					<div id="clear"></div>
					
					<?php echo '
					<script type="text/javascript">
						$(\'#loginSD input.account_input\').val(function(){
							return $(this).data(\'alter\');
						}).css(\'color\', \'#7f7f7f\');
						
						$(\'#loginSD input.account_input\').live( \'focusin focusout\', function( e ) {
							var $_this = $(this);
							var oldType = $_this.data(\'type\');
							
							if ( $_this.val() == $_this.data(\'alter\') ) {
								$_this.val(\'\');
								this.type = oldType;
								$_this.css(\'color\', \'#000\');
								$_this.focus();
							}
							else if ( $_this.val() == \'\' ) {
								$_this.val( $_this.data(\'alter\') );
								this.type = \'text\';
								$_this.css(\'color\', \'#7f7f7f\');
							}
						});
						
						$("#login2SD a img").live(\'mouseenter\', function () {
							$(this).animate({ "top": "-5" }, 500);
						});
						
						$("#login2SD a img").live(\'mouseleave\', function () {
							$(this).animate({ "top": "0" }, 500);
						});
						
						$(\'li.hasChild\').live(\'mouseenter\', function(e){
							var $subCat = $(this).find(\'ul\');
							
							if ( !$(\'#content-menu\').length ) {
								$(\'body\').append(\'<div id="content-menu"></div>\');
							}
							
							var offsetMenu = $(\'#navbar #menu\').offset();
							
							$(\'#content-menu\').css({
								\'position\': \'absolute\',
								\'top\': parseInt( offsetMenu.top ),
								\'left\': offsetMenu.left,
								\'width\': $(\'#navbar #menu ul\').width()
							});
							$(\'#content-menu\').html(\'<ul>\'+$subCat.html()+\'</ul>\').addClass(\'hover\').data(\'menu\', $(this));
							
							$(\'#content-menu\').show();
							$(this).addClass(\'hover\');
						})
						
						$(\'li.hasChild\').live(\'mouseleave\', function(e){
							$(\'#content-menu\').hide();
							$(this).removeClass(\'hover\');
						})
						
						$(\'#content-menu\').live(\'mouseenter\', function(e){
							$(\'#content-menu\').data(\'menu\').addClass(\'hover\');
							$(\'#content-menu\').show();
						});
						
						$(\'#content-menu\').live(\'mouseleave\', function(e){
							$(\'#content-menu\').data(\'menu\').removeClass(\'hover\');
							$(\'#content-menu\').hide();
						});
					</script>
					'; ?>

					
					<div id="telephone">
						<span>02.98.97.77.27</span>
					</div>
					<div class="clear"></div>
				</div>
				<div id="navbar">
					<div id="promos"><a href="<?php echo $this->_tpl_vars['base_dir']; ?>
prices-drop.php">promotions</a></div>
					<div id="menu">
						<ul>
							<?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['categorie'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['categorie']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['categorie']):
        $this->_foreach['categorie']['iteration']++;
?>
								<?php $this->assign('class', ''); ?>
								<?php if (count ( $this->_tpl_vars['categorie']['children'] )): ?>
									<?php $this->assign('class', 'hasChild'); ?>
								<?php endif; ?>

								<li class="<?php echo $this->_tpl_vars['class']; ?>
">
									<?php if (count ( $this->_tpl_vars['categorie']['children'] )): ?>
										<ul>
											<?php $_from = $this->_tpl_vars['categorie']['children']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['child'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['child']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['child']):
        $this->_foreach['child']['iteration']++;
?>
												<li>
													<a class="img" href="<?php echo $this->_tpl_vars['link']->getCategoryLink($this->_tpl_vars['child']['id_category'],$this->_tpl_vars['child']['link_rewrite']); ?>
"><img height="98" width="98" alt="<?php echo $this->_tpl_vars['child']['name']; ?>
" title="<?php echo $this->_tpl_vars['child']['name']; ?>
" src="<?php echo $this->_tpl_vars['link']->getCatImageLink($this->_tpl_vars['child']['link_rewrite'],$this->_tpl_vars['child']['id_category'],'menu'); ?>
" /></a>
													<a class="text" href="<?php echo $this->_tpl_vars['link']->getCategoryLink($this->_tpl_vars['child']['id_category'],$this->_tpl_vars['child']['link_rewrite']); ?>
"><?php echo $this->_tpl_vars['child']['name']; ?>
</a>
												</li>
											<?php endforeach; endif; unset($_from); ?>
											<div class="clear"></div>
										</ul>
										<?php $this->assign('class', 'hasChild'); ?>
									<?php endif; ?>
									
									<a href="<?php echo $this->_tpl_vars['link']->getCategoryLink($this->_tpl_vars['categorie']['id_category'],$this->_tpl_vars['categorie']['link_rewrite']); ?>
"><?php echo $this->_tpl_vars['categorie']['name']; ?>
</a>
								</li>
							<?php endforeach; endif; unset($_from); ?>
							<div class="clear"></div>
						</ul>
					</div>
					<div class="clear"></div>
					<?php echo $this->_tpl_vars['HOOK_TOP']; ?>

				</div>
				<div id="columns">
					<!-- Left -->
					<div id="left_column" class="column">
						<?php echo $this->_tpl_vars['HOOK_LEFT_COLUMN']; ?>

					</div>
	
					<!-- Center -->
					<div id="center_column">
		<?php endif; ?>