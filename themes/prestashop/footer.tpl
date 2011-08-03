			{if !$content_only}
					</div>
					<!-- Right -->

					<div id="right_column" class="column">
						{$HOOK_RIGHT_COLUMN}
					</div>
					<div class="clear"></div>
				</div>
				<!-- Footer -->

				<div id="footer">{$HOOK_FOOTER}</div>
			</div>
		{/if}
		
		{if 0}
		<div class="coupon once hidden">
			<div class="in">
				<div class="close"></div>
			</div>
		</div>
		
		<script type="text/javascript">
			{literal}
			$('.coupon.once').live('click', function () {
				$(this).fadeOut('slow');
				
				$.post( '/ajax.php', { 'close': 'coupon' } );
				$.post( '/commande', { 'discount_name': 'TRANSPORT25', 'submitAddDiscount': 'Ajouter', 'submitDiscount': '' } );
			});
			{/literal}
		</script>
		{/if}
	</body>
</html>
