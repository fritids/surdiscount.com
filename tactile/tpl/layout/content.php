<div id="content">
	<?
	
	if ( file_exists( $file_controler ) ) {
		include( $file_controler );
	}
	
	if ( file_exists( $file_page ) ) {
		include( $file_page );
	}
	else {
		include( TPL.'home.php' );
	}
	
	?>
</div>
