<!-- Block carrousel module-->

<div id="carrousel_block_left" class="block">
	<div class="main_image">
	    <a href="{$first.url}"><img src="{$img_dir}crll/{$first.image}" alt="" /></a>
	    <div class="desc">
	        <a class="collapse">Close Me!</a>
	        <div class="blocks">
	            <h2>{$first.title}</h2>
	            <small>{$first.subtitle}</small>
	            <p>{$first.description}</p>
	        </div>
	    </div>
	</div>
	<div class="image_thumb">
	    <ul>
	    	{foreach from=$carrousels item=carrousel name=carrousel}
		        <li data-slide="{$smarty.foreach.carrousel.index}">
		            <a data-url="{$carrousel.url}" href="{$img_dir}crll/{$carrousel.image}"></a>
		            <div class="blocks">
		                <h2>{$carrousel.title}</h2>
		                <small>{$carrousel.subtitle}</small>
		                <p>{$carrousel.description}</p>
		            </div>
		        </li>
            {/foreach}
	    </ul>
	</div>
	
	<div class="clear"></div>
</div>
<div class="clear"></div>

<!--{literal}-->
<script type="text/javascript">
	var delaiCarrousel = 3000;
	var playCarrouselTimeout = setInterval(playCarrousel, delaiCarrousel);

	$(document).ready(function() {	
		//Show Banner
		$(".main_image .desc").show(); //Show Banner
		$(".main_image .blocks").animate({ opacity: 0.85 }, 1 ); //Set Opacity
	 
		//Click and Hover events for thumbnail list
		$(".image_thumb ul li:first").addClass('active'); 
		$(".image_thumb ul li").click(function(){ 
			//Set Variables
			var imgAlt = $(this).find('img').attr("alt"); //Get Alt Tag of Image
			var imgTitle = $(this).find('a').attr("href"); //Get Main Image URL
			var imgDesc = $(this).find('.blocks').html(); 	//Get HTML of blocks
			var imgURL = $(this).find('a').data("url");
			var imgDescHeight = $(".main_image").find('.blocks').height();	//Calculate height of blocks	

			if ($(this).is(".active")) {  //If it's already active, then...
				return false; // Don't click through
			} else {
				//Animate the Teaser				
				$(".main_image .blocks").animate({ opacity: 0, marginBottom: -imgDescHeight }, 250 , function() {
					$(".main_image .blocks").html(imgDesc).animate({ opacity: 0.85,	marginBottom: "0" }, 250 );
					$(".main_image img").attr({ src: imgTitle });
					$(".main_image img").parent().attr( 'href', imgURL );
				});
			}
			
			$(".image_thumb ul li").removeClass('active'); //Remove class of 'active' on all lists
			$(this).addClass('active');  //add class of 'active' on this list only
			return false;
			
		}) .hover(function(){
			$(this).addClass('hover');
			}, function() {
			$(this).removeClass('hover');
		});

		$(".main_image .blocks").slideToggle();
		$("a.collapse").toggleClass("show");

		//Toggle Teaser
		$("a.collapse").click(function(){
			$(".main_image .blocks").slideToggle();
			$("a.collapse").toggleClass("show");
		});
		
		$('#carrousel_block_left').live('mouseenter', function(){
			clearInterval( playCarrouselTimeout );
		});
		
		$('#carrousel_block_left').live('mouseleave', function(){
			playCarrouselTimeout = setInterval(playCarrousel, delaiCarrousel);
		});
	});//Close Function
	
	function playCarrousel () {
		var nbSlide = $('.image_thumb ul li').length;
		var currentSlide = $('.image_thumb ul li.active').data('slide') + 1;
		
		if ( currentSlide == nbSlide ) {
			$nextSlide = $('.image_thumb ul li').eq(0);
		}
		else {
			$nextSlide = $('.image_thumb ul li.active').next();
		}
		
		$nextSlide.click();
	}
</script>
<!--{/literal}-->

<div class="clear"></div>

<!-- /Block carrousel module-->