function RSGoPro_SearchTitle() {
	if ($('.title-search-result').length > 0 && $('.title-search-result').is(':visible')) {
		var trueH = 32,
			needAdd = false;

		$('.title-search-result').find('.item.catitem').each(function(i) {
			if ($(this).outerHeight() > trueH) {
				needAdd = true;
				return false;
			}
		});

		if ($('.title-search-result').find('.stitle').hasClass('twolines') && !needAdd) {
			$('.title-search-result').find('.stitle').removeClass('twolines');
		} else if (!$('.title-search-result').find('.stitle').hasClass('twolines') && needAdd) {
			$('.title-search-result').find('.stitle').addClass('twolines');
		}
	}
}

$(document).ready(function(){
	
	setInterval(RSGoPro_SearchTitle, 500);
	
	$(document).on('focus blur', '#title-search-input', function(){
		$(this).parents('#title-search').toggleClass('focus');
	});

	// header search box
	$(document).on('click', '.nav .search-btn', function() {
		$('.search-open').fadeIn(250);
		return false;
	});
	$(document).on('click', '.nav .search-a-close', function() {
		$('.search-open').fadeOut(250);
		$('.title-search-result').hide();
		return false;
	});

	$(document).on('click', function(e) {
		if ($(e.target).parents('.search-open').length > 0 || $(e.target).parents('.title-search-result').length > 0) {

		} else {
			$('.search-open').fadeOut(250);
			$('.title-search-result').hide();
		}
	});
  
});
