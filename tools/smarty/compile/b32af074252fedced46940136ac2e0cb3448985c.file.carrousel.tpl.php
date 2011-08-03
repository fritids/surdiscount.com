<?php /* Smarty version Smarty-3.0.7, created on 2011-08-03 18:02:49
         compiled from "/homepages/13/d194332323/htdocs/www/modules/carrousel/carrousel.tpl" */ ?>
<?php /*%%SmartyHeaderCode:1195076684e397129484f68-69991743%%*/if(!defined('SMARTY_DIR')) exit('no direct access allowed');
$_smarty_tpl->decodeProperties(array (
  'file_dependency' => 
  array (
    'b32af074252fedced46940136ac2e0cb3448985c' => 
    array (
      0 => '/homepages/13/d194332323/htdocs/www/modules/carrousel/carrousel.tpl',
      1 => 1300808782,
      2 => 'file',
    ),
  ),
  'nocache_hash' => '1195076684e397129484f68-69991743',
  'function' => 
  array (
  ),
  'has_nocache_code' => false,
)); /*/%%SmartyHeaderCode%%*/?>
<!-- Block carrousel module-->

<div id="carrousel_block_left" class="block">
	<div class="main_image">
	    <a href="<?php echo $_smarty_tpl->getVariable('first')->value['url'];?>
"><img src="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
crll/<?php echo $_smarty_tpl->getVariable('first')->value['image'];?>
" alt="" /></a>
	    <div class="desc">
	        <a class="collapse">Close Me!</a>
	        <div class="blocks">
	            <h2><?php echo $_smarty_tpl->getVariable('first')->value['title'];?>
</h2>
	            <small><?php echo $_smarty_tpl->getVariable('first')->value['subtitle'];?>
</small>
	            <p><?php echo $_smarty_tpl->getVariable('first')->value['description'];?>
</p>
	        </div>
	    </div>
	</div>
	<div class="image_thumb">
	    <ul>
	    	<?php  $_smarty_tpl->tpl_vars['carrousel'] = new Smarty_Variable;
 $_from = $_smarty_tpl->getVariable('carrousels')->value; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array');}
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['carrousel']['index']=-1;
if ($_smarty_tpl->_count($_from) > 0){
    foreach ($_from as $_smarty_tpl->tpl_vars['carrousel']->key => $_smarty_tpl->tpl_vars['carrousel']->value){
 $_smarty_tpl->tpl_vars['smarty']->value['foreach']['carrousel']['index']++;
?>
		        <li data-slide="<?php echo $_smarty_tpl->getVariable('smarty')->value['foreach']['carrousel']['index'];?>
">
		            <a data-url="<?php echo $_smarty_tpl->tpl_vars['carrousel']->value['url'];?>
" href="<?php echo $_smarty_tpl->getVariable('img_dir')->value;?>
crll/<?php echo $_smarty_tpl->tpl_vars['carrousel']->value['image'];?>
"></a>
		            <div class="blocks">
		                <h2><?php echo $_smarty_tpl->tpl_vars['carrousel']->value['title'];?>
</h2>
		                <small><?php echo $_smarty_tpl->tpl_vars['carrousel']->value['subtitle'];?>
</small>
		                <p><?php echo $_smarty_tpl->tpl_vars['carrousel']->value['description'];?>
</p>
		            </div>
		        </li>
            <?php }} ?>
	    </ul>
	</div>
	
	<div class="clear"></div>
</div>
<div class="clear"></div>

<!---->
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
<!---->

<div class="clear"></div>

<!-- /Block carrousel module-->