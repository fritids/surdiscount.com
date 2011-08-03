<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 18:06:24
         compiled from "/homepages/13/d194332323/htdocs/www/modules/cartouche/cartouche.tpl" */ ?>
<?php /*%%SmartyHeaderCode:640911634e39720038e751-40217914%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'd099cd17c43cc5bc26f90f9ba8876ddd08ec1f80' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/cartouche/cartouche.tpl',
      1 => 1303911668,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '640911634e39720038e751-40217914',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Block cartouche module-->
<div class="clear"></div>

<div id="cartouche_block_left" class="block">
	<form class="cartouches" method="post">
		<input type="hidden" name="id_category_cartouche" id="id_category_cartouche" value="<?php echo $_smarty_tpl->getVariable('id_category_cartouches')->value;?>
" />

		<fieldset class="bloc libre">
			<div id="img_print"></div>
			<label for="direct_reference_print"><?php echo smartyTranslate(array('s'=>'Vous connaissez votre reference d\'imprimante'),$_smarty_tpl);?>
</label>
			<input type="text" data-type="text" data-alter="<?php echo smartyTranslate(array('s'=>'DCP 145C, I 560, Stylus C 64, ...'),$_smarty_tpl);?>
" class="account_input" name="direct_reference_print" id="direct_reference_print" value="">
		</fieldset>
		<fieldset class="bloc libre right">
			<div id="img_ink"></div>
			<label for="direct_reference_ink"><?php echo smartyTranslate(array('s'=>'Vous connaissez votre reference de cartouche'),$_smarty_tpl);?>
</label>
			<input type="text" data-type="text" data-alter="<?php echo smartyTranslate(array('s'=>'T 0711, C 5B, LC 1100, ...'),$_smarty_tpl);?>
" class="account_input" name="direct_reference_ink" id="direct_reference_ink" value="">
		</fieldset>

		<div class="enchainement">
			<fieldset class="bloc reference">
				<label for="select_reference"><?php echo smartyTranslate(array('s'=>'References'),$_smarty_tpl);?>
</label>
				<select size="12" name="select_reference" id="select_reference">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('references')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id_reference'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
					<?php }} ?>
				</select>
			</fieldset>
	
			<fieldset class="bloc serie">
				<label for="select_serie"><?php echo smartyTranslate(array('s'=>'Series'),$_smarty_tpl);?>
</label>
				<select size="12" name="select_serie" id="select_serie">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('series')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id_serie'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
					<?php }} ?>
				</select>
			</fieldset>
	
			<fieldset class="bloc manufacturer">
				<label for="select_manufacturer"><?php echo smartyTranslate(array('s'=>'Marques'),$_smarty_tpl);?>
</label>
				<select size="12" name="select_manufacturer" id="select_manufacturer">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('manufacturers')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
						<option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id_manufacturer'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option>
					<?php }} ?>
				</select>
			</fieldset>
			
			<fieldset class="bloc type">
				<label for="select_type"><?php echo smartyTranslate(array('s'=>'Type de cartouches'),$_smarty_tpl);?>
</label>
				<select size="12" name="select_type" id="select_type">
					<?php  $_smarty_tpl->tpl_vars['item'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('types')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['item']->key => $_smarty_tpl->tpl_vars['item']->value){
?>
						<?php if ($_smarty_tpl->tpl_vars['item']->value['id_category']!=123){?><option value="<?php echo $_smarty_tpl->tpl_vars['item']->value['id_category'];?>
"><?php echo $_smarty_tpl->tpl_vars['item']->value['name'];?>
</option><?php }?>
					<?php }} ?>
				</select>
			</fieldset>
			
			<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
	</form>
</div>

<script type="text/javascript">
	<?php if ($_smarty_tpl->getVariable('type_id')->value&&$_smarty_tpl->getVariable('type_id')->value!=$_smarty_tpl->getVariable('id_category_cartouches')->value){?>
		
		$('#select_type').ready(function(){
		
			$('#select_type').val(<?php echo $_smarty_tpl->getVariable('type_id')->value;?>
);
			$('#select_type').change();
		
		});
		
	<?php }?>

	<?php if ($_smarty_tpl->getVariable('manufacturer_id')->value){?>
		setTimeout( function(){
			
			$('document').ready(function(){
			
				$('#select_manufacturer').val(<?php echo $_smarty_tpl->getVariable('manufacturer_id')->value;?>
);
				$('#select_manufacturer').change();
			
			});
			
		}, 5000 );
	<?php }?>
	
	
		$('input.account_input').val(function(){
			return $(this).data('alter');
		}).css('color', '#7f7f7f');
		
		$('input.account_input').live( 'focusin focusout', function( e ) {
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
	
</script>

<div class="clear"></div>

<!-- /Block cartouche module-->