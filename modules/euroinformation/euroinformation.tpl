<p class="payment_module">
    <a href="javascript:$('#euroinformation_form').submit();" title="{l s='Payer par carte bancaire' mod='euroinformation'}">
		<img src="{$module_template_dir}{$Bank}.gif" alt="{l s='Payer par carte bancaire' mod='euroinformation'}" />
		{l s='Payer par carte bancaire' mod='euroinformation'}
	</a>
<form action="{$BankServer}" method="post" class="hidden" id="euroinformation_form">
    <input type="hidden" name="version"        value="{$version}">
    <input type="hidden" name="TPE"            value="{$TpeNum}">
    <input type="hidden" name="date"           value="{$datetoday}">
    <input type="hidden" name="montant"        value="{$amount}">
    <input type="hidden" name="reference"      value="{$id_cart}">
    <input type="hidden" name="MAC"            value="{$MAC}">
    <input type="hidden" name="url_retour"     value="{$urlRetour}">
    <input type="hidden" name="url_retour_ok"  value="{$urlRetourOK}">
    <input type="hidden" name="url_retour_err" value="{$urlRetourKO}">
    <input type="hidden" name="lgue"           value="{$lgue}">
    <input type="hidden" name="societe"        value="{$SiteCode}">
    <input type="hidden" name="texte-libre"    value="Commande">
</form>
</p>
