var cs_serialScrollNbImagesDisplayed = 3;
var cs_serialScrollNbImages;
var cs_serialScrollActualImagesIndex;

function cs_serialScrollFixLock(event, targeted, scrolled, items, position)
{
	serialScrollNbImages = $('#accessorie_list li:visible').length;

	var leftArrow = position == 0 ? true : false;
	var rightArrow = position + cs_serialScrollNbImagesDisplayed >= serialScrollNbImages ? true : false;

	$('a#accessorie_scroll_left')
		.css('cursor', leftArrow ? 'default' : 'pointer')
		.fadeTo(0.2, leftArrow ? 0.2 : 1)
		.attr('class', leftArrow ? '' : 'active');
	$('a#accessorie_scroll_right')
		.css('cursor', rightArrow ? 'default' : 'pointer')
		.fadeTo(0.2, rightArrow ? 0.2 : 1)
		.attr('class', rightArrow ? '' : 'active');

	return true;
}

$(document).ready(function(){
//init the serialScroll for thumbs
	cs_serialScrollNbImages = $('#accessorie_list li').length;
	cs_serialScrollActualImagesIndex = 0;
	
	$('#accessorie_list').serialScroll({
		items: 'li',
		prev: 'a#accessorie_scroll_left.active',
		next: 'a#accessorie_scroll_right.active',
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
	
	$('#accessorie_list').trigger( 'goto', [middleAcc-3] );
});
