var cs_serialScrollNbImagesDisplayed = 3;
var cs_serialScrollNbImages;
var cs_serialScrollActualImagesIndex;

function cs_serialScrollFixLock(event, targeted, scrolled, items, position)
{
	serialScrollNbImages = $('#crossselling_list li:visible').length;

	var leftArrow = position == 0 ? true : false;
	var rightArrow = position + cs_serialScrollNbImagesDisplayed >= serialScrollNbImages ? true : false;

	$('a#crossselling_scroll_left')
		.css('cursor', leftArrow ? 'default' : 'pointer')
		.fadeTo(0.2, leftArrow ? 0.2 : 1)
		.attr('class', leftArrow ? '' : 'active');
	$('a#crossselling_scroll_right')
		.css('cursor', rightArrow ? 'default' : 'pointer')
		.fadeTo(0.2, rightArrow ? 0.2 : 1)
		.attr('class', rightArrow ? '' : 'active');

	return true;
}

$(document).ready(function(){
//init the serialScroll for thumbs
	cs_serialScrollNbImages = $('#crossselling_list li').length;
	cs_serialScrollActualImagesIndex = 0;
	
	$('#crossselling_list').serialScroll({
		items: 'li',
		prev: 'a#crossselling_scroll_left.active',
		next: 'a#crossselling_scroll_right.active',
		axis: 'x',
		offset: 0,
		stop: true,
		onBefore: cs_serialScrollFixLock,
		duration: 500,
		step: 3,
		lazy: true,
		lock: false,
		force: false,
		cycle: false
	});
	
	$('#crossselling_list').trigger( 'goto', [middle-3] );
});
