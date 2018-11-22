function rsGoproSearchTitleInit() {
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

function rsGoproSearchTitleResize() {
	var $mobileOpener = $('.js-search-bar-mobile'),
		windowWidth = $(window).outerWidth(),
		windowOldWidth = $mobileOpener.data('windowOldWidth');
	
	if (windowWidth == windowOldWidth)
		return;

	$mobileOpener.data('windowOldWidth', windowWidth);
	$mobileOpener.each(function(){
		var $this = $(this),
			widthBreakPoint = $this.find('.js-form').data('window-width-jsopenser');
		if (windowWidth <= widthBreakPoint) {
			$this.find('.js-search-open').removeClass('open').addClass('closed').css('display', 'none');
		} else {
			$this.find('.js-search-open').removeClass('closed').addClass('open').css('display', 'block');
		}
	});
}

$(document).ready(function(){
	
	setInterval(rsGoproSearchTitleInit, 500);
	rsGoproSearchTitleResize();

	$(window).resize(BX.debounce(function() {
		rsGoproSearchTitleResize();
	}, 100));

	// show/hide button
	$(document).on('click', '.js-show-search-bar', function() {
		$(this).closest('.js-search-bar').find('.js-search-open').addClass('open').removeClass('closed').fadeIn(250);
		return false;
	});
	// /show/hide button

	// close by click outside
	$(document).on('click', function(e) {
		if ($(e.target).closest('.js-search-open').length > 0 || $(e.target).closest('.title-search-result').length > 0) {

		} else {
			$('.js-search-open:not(.js-mobile)').fadeOut(250);
			$('.js-search-open.js-mobile').each(function(){
				var $this = $(this),
					widthBreakPoint = $this.find('.js-form').data('window-width-jsopenser');
				
				if ($(window).outerWidth() <= widthBreakPoint) {
					$this.fadeOut(250);
				}
			});
			$('.title-search-result').hide();
		}
	});
	// /close by click outside
  
});
