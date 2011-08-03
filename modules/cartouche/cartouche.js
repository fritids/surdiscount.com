var ajax = $.ajax();

function slideRight ( $this ) {
	var $fieldset = $this.parents('fieldset');
	
	if ( !$fieldset.children().is(':visible') ) {
		$fieldset.children().css( 'left', -$fieldset.width() );
		$fieldset.children().css( 'display', 'block' );
	}

	$fieldset.children().animate({
	    'left': 0
	}, 'slow');
}

function slideLeft ( $this ) {
	var $fieldset = $this.parents('fieldset');

	$fieldset.children().animate({
	    'left': -$fieldset.width()
	}, 'slow');
}

function wait ( $el, close ) {
	if ( typeof $el == 'undefined' ) {
		$el = $('body');
	}

	if ( typeof close == 'undefined' ) {
		close = false;
	}

	if ( !$el.data('isWaiting') && !close ) {
		if ( !$('#waiting').length ) {
			$('body').append('<div id="waiting" class="overlay"></div>');
		}

		var offset = $el.offset();

		$('#waiting').css({
			'width': $el.width(),
			'height': $el.height(),
			'top': offset.top,
			'left': offset.left,
			'display': 'block'
		});

		$el.data('isWaiting', true);
	}
	else if ( close ) {
		$('#waiting').css('display', 'none');
		
		$el.data('isWaiting', false);
	}
	else {
		$('#waiting').css('display', 'none');

		$el.data('isWaiting', false);
	}
}

$(document).ready(function(){
	var $form = $('#cartouche_block_left form.cartouches');
	var $type = $('#select_type');
	var $manufacturer = $('#select_manufacturer');
	var $serie = $('#select_serie');
	var $reference = $('#select_reference');
	var $waiting = $('#cartouche_block_left');

	$type.live('change', function(){
		wait( $waiting );
		var $this = $(this);
		
		$manufacturer.html('<option value="0">Recherche ...</option>');
		
		if ( !$('#result_cartouches').length )
			$this.parents('form').after('<div id="result_cartouches"></div>');

		//ajax.abort();
		ajax = $.ajax({
			url: baseDir + 'modules/cartouche/ajax.php',
			dataType: 'json',
			data: 'getManufacturers=1&'+$form.serialize(),
			success: function( result ) {
				slideLeft( $serie );
				slideLeft( $reference );

				var nb = result.list.length;

				if ( nb ) {
					$manufacturer.html( '' );

					for ( var i = 0; i < nb; i++ ) {
						var item = result.list[i];
						if ( item.id_category > 0 && item.name != '' ) {
							$manufacturer.append('<option value="'+item.id_category+'">'+item.name+'</option>');
						}
					}

					slideRight( $manufacturer );
				}
				else {
					$manufacturer.append('<option value="0">Aucun r&eacute;sultat</option>');
					slideLeft( $manufacturer );
				}
				
				var $html = $(result.search).find('#center_column');
				$('#result_cartouches').html( $html );
				
				$this.find('option[value='+$this.val()+']').attr('selected', 'selected');
				
				wait( $waiting, true );
			},
			error: function(){
				wait( $waiting, true );
			}
		});
		
		return ajax;
	});
	
	$manufacturer.live('change', function(){
		wait( $waiting );
		var $this = $(this);
		
		$serie.html('<option value="0">Recherche ...</option>');

		//ajax.abort();
		ajax = $.ajax({
			url: baseDir + 'modules/cartouche/ajax.php',
			dataType: 'json',
			data: 'getSeries=1&'+$form.serialize(),
			success: function( result ) {
				slideLeft( $reference );
				
				var nb = result.list.length;

				if ( nb ) {
					$serie.html( '' );

					for ( var i = 0; i < nb; i++ ) {
						var item = result.list[i];
	
						if ( item ) {
							$serie.append('<option value="'+item+'">'+item+'</option>');
						}
					}
					
					$this.find('option[value='+$this.val()+']').attr('selected', 'selected');

					slideRight( $serie );
				}
				else {
					$serie.append('<option value="0">Aucun r&eacute;sultat</option>');
					slideLeft( $serie );
				}
				
				var $html = $(result.search).find('#center_column');
				$('#result_cartouches').html( $html );
				
				wait( $waiting, true );
			},
			error: function(){
				wait( $waiting, true );
			}
		});
		
		return ajax;
	});

	$serie.live('change', function(){
		wait( $waiting );
		var $this = $(this);
		
		$reference.html('<option value="0">Recherche ...</option>');
		
		$(this).find('option[value='+$(this).val()+']').attr('selected', 'selected');

		ajax.abort();
		ajax = $.ajax({
			url: baseDir + 'modules/cartouche/ajax.php',
			dataType: 'json',
			data: 'getReferences=1&'+$form.serialize(),
			success: function( result ) {
				var nb = result.list.length;

				if ( nb ) {
					$reference.html( '' );

					for ( var i = 0; i < nb; i++ ) {
						var item = result.list[i];
	
						if ( item.id > 0 && item.name != '' ) {
							$reference.append('<option value="'+item.name_clean+'">'+item.name+'</option>');
						}
					}
					
					slideRight( $reference );
				}
				else {
					$reference.append('<option value="0">Aucun r&eacute;sultat</option>');
					slideLeft( $reference );
				}
				
				var $html = $(result.search).find('#center_column');
				$('#result_cartouches').html( $html );
				
				wait( $waiting, true );
			},
			error: function(){
				wait( $waiting, true );
			}
		});
		
		return ajax;
	});

	$('#select_reference, #direct_reference_print').live('change keyup', function(e){
		wait( $waiting );
		var $this = $(this);
		
		if ( e.type == 'keyup' && $this.val().length < 3 ) {
			wait( $waiting, true );
			return false;
		}
		
		if ( e.type == 'change' ) {
			$(this).find('option[value='+$(this).val()+']').attr('selected', 'selected');
		}

		if ( !$('#result_cartouches').length )
			$this.parents('form').after('<div id="result_cartouches"></div>');

		$('#result_cartouches').html('Recherche ...');

		ajax.abort();
		ajax = $.ajax({
			url: baseDir + 'search.php',
			data: 'tag='+$this.val(),
			success: function( result ) {
				result = $(result).find('#center_column');
				$('#result_cartouches').html(result);
				
				wait( $waiting, true );
			},
			error: function(){
				wait( $waiting, true );
			}
		});
		
		return ajax;
	});
	
	$('#direct_reference_ink').live('keyup', function(){
		wait( $waiting );

		var $this = $(this);
		
		if ( $this.val().length < 3 ) {
			wait( $waiting, true );
			return false;
		}
		
		if ( !$('#result_cartouches').length )
			$this.parents('form').after('<div id="result_cartouches"></div>');

		ajax.abort();
		ajax = $.ajax({
			url: baseDir + 'modules/cartouche/ajax.php',
			data: 'searchRefInk=1&q='+$this.val()+'&id_category_cartouche='+$('#id_category_cartouche').val(),
			success: function( result ) {
				$('#result_cartouches').html(result);
				
				wait( $waiting, true );
			},
			error: function(e){
				console.log(e);
				wait( $waiting, true );
			}
		});
		
		return ajax;
	});
});