<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 17:56:23
         compiled from "/homepages/13/d194332323/htdocs/www/themes/prestashop/footer.tpl" */ ?>
<?php /*%%SmartyHeaderCode:3777491874e396fa7c96e94-36372124%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    '9143757660c88fa6d6e91f64a4a98b352acc4aeb' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/themes/prestashop/footer.tpl',
      1 => 1311862487,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '3777491874e396fa7c96e94-36372124',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
			<?php if (!$_smarty_tpl->getVariable('content_only')->value){?>
					</div>
					<!-- Right -->

					<div id="right_column" class="column">
						<?php echo $_smarty_tpl->getVariable('HOOK_RIGHT_COLUMN')->value;?>

					</div>
					<div class="clear"></div>
				</div>
				<!-- Footer -->

				<div id="footer"><?php echo $_smarty_tpl->getVariable('HOOK_FOOTER')->value;?>
</div>
			</div>
		<?php }?>
		
		<?php if (0){?>
		<div class="coupon once hidden">
			<div class="in">
				<div class="close"></div>
			</div>
		</div>
		
		<script type="text/javascript">
			
			$('.coupon.once').live('click', function () {
				$(this).fadeOut('slow');
				
				$.post( '/ajax.php', { 'close': 'coupon' } );
				$.post( '/commande', { 'discount_name': 'TRANSPORT25', 'submitAddDiscount': 'Ajouter', 'submitDiscount': '' } );
			});
			
		</script>
		<?php }?>
	</body>
</html>
