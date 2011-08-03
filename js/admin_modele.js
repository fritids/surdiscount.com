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

$(document).ready(function() {
	var ajax = $.ajax();

	$(".tags input.add_tag").live("keyup", function(e){
		var $input = $(this);
		var $container = $input.parents(".tags");
		var $id_lang = $container.data("id_lang");
		var $tags = $container.find('.all_tags');

		var manufacturer = "";
		if ( parseInt( $("#id_manufacturer").val() ) ) {
			manufacturer = "&id_manufacturer="+$("#id_manufacturer").val();
		}
		
		if ( e.keyCode == '27' ) {
			var $current_tags = $container.find('.list_current_tags');

			var tag = explode( ', ', trim( $(this).val(), ', ' ) );
			var nbTag = tag.length;

			for ( var i = 0; i < nbTag; i++ ) {
				var html = '<li><a>x</a><span>'+tag[i]+'<input type="hidden" value="'+tag[i]+'" class="tag"></span></li>';
				$container.find('.list_current_tags').prepend( html );
			}

			return false;
		}

		ajax.abort();
		ajax = $.ajax({
			url: "/admins/ajax.php",
			dataType: "json",
			data: "ajaxModele=1&q="+$tags.val(),
			success: function( result ) {
				if ( !$("#modele_proposition").length ) {
					$container.find(".hint").before( "<div id='modele_proposition'><ul></ul></div>" );
				}

				var $modele_proposition = $("#modele_proposition ul");

				$modele_proposition.find("li, div").remove();

				for ( var i = 0; i < result.length; i++ ) {
					$modele_proposition.append("<li>"+result[i].name+"</li>");
				}

				$modele_proposition.append("<div class='clear'></div>");

				$modele_proposition.parent().css({
					"width": $input.outerWidth( true )
				});
			}
		});
		
		return false;
	});

	$(".tags input.add_tag").live("keyup change blur focus", function(){
		var tinkco = $(this).val().split(',');

		if ( tinkco.length == 1 ) {
			var words = $(this).val().split(' ');
			
			var tab = new Array();
			var tmp_serie;
			var i = 0;
			$(words).each(function(){
				if ( isNaN( Number( this[0] ) ) ) {
					tmp_serie = String( this );
					tab[tmp_serie] = new Array();
					i = 0;
				}
				else {
					tab[tmp_serie][i] = String( this );
					i++;
				}
			});
		}
	
		
		var new_val = '';

		$('.list_current_tags input.tag').each( function() {
			new_val += ', '+$(this).val();
		});

		new_val = trim( new_val, ', ' )+', '+trim( $(this).val(), ', ' );

		$(this).parents('.tags').find('.all_tags').val( trim( new_val, ', ' ) );
	});

	$("#modele_proposition ul li").live("click", function(){
		var $this = $(this);
		var $container = $this.parents(".tags");
		var $input = $container.find("input.add_tag");

		var tags = explode( ", ", $input.val() );
		array_pop( tags );

		var new_value = ltrim( tags.join(", "), ", " );

		$input.val( ltrim( new_value+", "+$this.text()+", ", ", " ) );

		$this.remove();
		$input.focus();
	});

	$(".tags ul.list_current_tags li a").live("click", function(){
		var $this = $(this);
		var $tag = $this.parents("li");

		var $container = $this.parents("ul");

		$tag.fadeOut('slow').remove();

		$(".tags input.add_tag").change();

		return false;
	});
	
	$('div.tinkco div.ok').live('click', function(){
		var $this = $(this);
		var $container = $this.parents('.tinkco');
		var $input = $container.find('input.tinkco');
		
		if ( !$('.overlay.tinkco').length ) {
			$('body').append('<div class="overlay tinkco"><h1>R&eacute;sultat de recherche: '+$input.val()+'</h1><ul></ul><div class="actions"><button class="cancel">Annuler</button><button class="valide">Valider</button></div></div>');
		}

		$('.overlay.tinkco').fadeIn('slow', function(){
			wait($('.overlay.tinkco ul:first'));
		});
		
		

		ajax.abort();
		ajax = $.ajax({
			url: "/tinkco-search.php",
			dataType: "json",
			data: "s="+$input.val(),
			success: function( result ) {
				var nb = result.length;

				for ( var i = 0; i < nb; i++ ) {
					var item = result[i];

					$('.overlay.tinkco ul').append('<li><span data-id="'+item.id+'">'+item.text+'</span></li>');
				}
				
				wait($('.overlay.tinkco ul:first'));
			}
		});
	});
	
	$('.overlay.tinkco ul li span').live('click', function(){
		wait($('.overlay.tinkco ul:first'));

		var $this = $(this);
		var $data = $this.data();
		var $li = $this.parent();
		
		$('.overlay.tinkco .result').slideUp('slow');
		$('.overlay.tinkco .clicked').removeClass('clicked');
		$li.addClass('clicked');

		$.ajax({
			url: "/tinkco-product.php",
			dataType: "json",
			data: "id="+$data.id,
			success: function( result ) {
				var new_tags = '';
				var nbSerie = result.length;
				
				if ( nbSerie ) {
					if ( $li.find('.result').length ) {
						$li.find('.result').remove();
					}
	
					$li.append('<div class="result"><ul class="series"></ul></div>');
					
					$li.find('.result').hide();
					
					var $result = $li.find('.result ul');
	
					for ( var i = 0; i < nbSerie; i++ ) {
						var serie = result[i];
	
						if ( serie.id != null && serie.name != null ) {
							$result.append('<li data-id="'+serie.id+'" data-name="'+serie.name+'"><span>'+serie.name+'</span></li>');

							var nbReference = serie.references.length;
							
							if ( nbReference ) {
								var $serie = $result.find('li:last');
								
								$serie.find('ul').remove();
								$serie.append('<ul class="references"></ul>');
								
								for ( var j = 0; j < nbReference; j++ ) {
									var reference = serie.references[j];
									var ref_name = serie.name+' '+reference.name;

									if ( typeof reference != 'undefined' ) {
										$serie.find('ul').append('<li data-id="'+reference.id+'" data-name="'+reference.name+'">'+ref_name+'</li>');
										
										new_tags += ', '+ref_name;
									}
								}
								
								$serie.find('ul').append('<div class="clear"></div>');
							}
						}
					}
					
					$result.append('<div class="clear"></div>');
					
					$li.find('.result').slideDown('slow');
				}

				new_tags = trim( new_tags, ', ' );

				$('#all_new_tag_tinkco').remove();

				$this.parents('.overlay').find('.actions').append('<input type="hidden" id="all_new_tag_tinkco" />');
				$('#all_new_tag_tinkco').val( new_tags );
				
				wait($('.overlay.tinkco ul:first'));
			}
		});
	});
	
	$('.actions button.cancel').live('click', function(){
		$('.overlay.tinkco').fadeOut('slow', function(){
			$(this).remove();
		});
	});
	
	$('.actions button.valide').live('click', function(){
		$('.tags:visible').find('.add_tag').val( $('#all_new_tag_tinkco').val() );
		
		var $container = $('.tags:visible');

		var $current_tags = $container.find('.list_current_tags');
		$current_tags.find('li').remove();

		var tag = explode( ', ', trim( $container.find('input.add_tag').val(), ', ' ) );
		var nbTag = tag.length;

		for ( var i = 0; i < nbTag; i++ ) {
			var html = '<li><a>x</a><span>'+tag[i]+'<input type="hidden" value="'+tag[i]+'" class="tag"></span></li>';
			$current_tags.prepend( html );
		}

		$('.tags:visible').find('.add_tag').val('');
		$('.tags:visible').find('.add_tag').keyup();
		
		$('.overlay.tinkco').fadeOut('slow', function(){
			$(this).remove();
		});
	});
});