<!-- Block cartouche module-->
<div class="clear"></div>

<div id="cartouche_block_left" class="block">
	<form class="cartouches" method="post">
		<input type="hidden" name="id_category_cartouche" id="id_category_cartouche" value="{$id_category_cartouches}" />

		<fieldset class="bloc libre">
			<div id="img_print"></div>
			<label for="direct_reference_print">{l s='Vous connaissez votre reference d\'imprimante'}</label>
			<input type="text" data-type="text" data-alter="{l s='DCP 145C, I 560, Stylus C 64, ...'}" class="account_input" name="direct_reference_print" id="direct_reference_print" value="">
		</fieldset>
		<fieldset class="bloc libre right">
			<div id="img_ink"></div>
			<label for="direct_reference_ink">{l s='Vous connaissez votre reference de cartouche'}</label>
			<input type="text" data-type="text" data-alter="{l s='T 0711, C 5B, LC 1100, ...'}" class="account_input" name="direct_reference_ink" id="direct_reference_ink" value="">
		</fieldset>

		<div class="enchainement">
			<fieldset class="bloc reference">
				<label for="select_reference">{l s='References'}</label>
				<select size="12" name="select_reference" id="select_reference">
					{foreach from=$references item=item}
						<option value="{$item.id_reference}">{$item.name}</option>
					{/foreach}
				</select>
			</fieldset>
	
			<fieldset class="bloc serie">
				<label for="select_serie">{l s='Series'}</label>
				<select size="12" name="select_serie" id="select_serie">
					{foreach from=$series item=item}
						<option value="{$item.id_serie}">{$item.name}</option>
					{/foreach}
				</select>
			</fieldset>
	
			<fieldset class="bloc manufacturer">
				<label for="select_manufacturer">{l s='Marques'}</label>
				<select size="12" name="select_manufacturer" id="select_manufacturer">
					{foreach from=$manufacturers item=item}
						<option value="{$item.id_manufacturer}">{$item.name}</option>
					{/foreach}
				</select>
			</fieldset>
			
			<fieldset class="bloc type">
				<label for="select_type">{l s='Type de cartouches'}</label>
				<select size="12" name="select_type" id="select_type">
					{foreach from=$types item=item}
						{if $item.id_category neq 123}<option value="{$item.id_category}">{$item.name}</option>{/if}
					{/foreach}
				</select>
			</fieldset>
			
			<div class="clear"></div>
		</div>
		
		<div class="clear"></div>
	</form>
</div>

<script type="text/javascript">
	{if $type_id && $type_id != $id_category_cartouches}
		{literal}
		$('#select_type').ready(function(){
		{/literal}
			$('#select_type').val({$type_id});
			$('#select_type').change();
		{literal}
		});
		{/literal}
	{/if}

	{if $manufacturer_id}
		setTimeout( function(){
			{literal}
			$('document').ready(function(){
			{/literal}
				$('#select_manufacturer').val({$manufacturer_id});
				$('#select_manufacturer').change();
			{literal}
			});
			{/literal}
		}, 5000 );
	{/if}
	
	{literal}
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
	{/literal}
</script>

<div class="clear"></div>

<!-- /Block cartouche module-->