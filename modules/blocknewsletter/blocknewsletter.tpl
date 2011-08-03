<!-- Block Newsletter module-->

<div id="newsletter_block_left" class="block">
	<h4>{l s='Newsletter' mod='blocknewsletter'}</h4>
	<div class="block_content">
	{if $msg != 'false'}
		<p class="{if $nw_error}warning_inline{else}success_inline{/if}">{$msg}</p>
	{/if}
		<form action="{$base_dir}" method="post">
			<p><input type="text" name="email" size="18" value="{if $value}{$value}{else}{l s='your e-mail' mod='blocknewsletter'}{/if}" onfocus="javascript:if(this.value=='{l s='your e-mail' mod='blocknewsletter'}')this.value='';" onblur="javascript:if(this.value=='')this.value='{l s='your e-mail' mod='blocknewsletter'}';" /><input type="submit" value="ok" class="button_mini" name="submitNewsletter" /></p>
			<p>
				<input type="hidden" name="action" value="0" />
			</p>
		</form>
	</div>
</div>

<!-- /Block Newsletter module-->
