function rsGoProFlyHeaderResize() {
	var $headerFly = $('.js-header-fly'),
		$menu = $('.js-menu'),
		startFlying = $menu.offset().top + $menu.outerHeight() + 50;
		scrollTop = $(window).scrollTop();
	
	if ($headerFly.length > 0 && scrollTop <= startFlying) {
		$('html').removeClass('header-fly-active');
	}

	$('html').removeClass('header-fly-active-menu');
	$('.js-fly-menu').removeClass('is-active');
	rsGoProUnLockPageScroll();
}

function rsGoProFlyHeaderScroll() {
	var $headerFly = $('.js-header-fly'),
		$menu = $('.js-menu'),
		startFlying = $menu.offset().top + $menu.outerHeight() + 50;
		scrollTop = $(window).scrollTop();

	if ($headerFly.length > 0) {
		if (scrollTop > startFlying) {
			$('html').addClass('header-fly-active');
		} else {
			$('html').removeClass('header-fly-active');
			$('html').removeClass('header-fly-active-menu');
			$('.js-fly-menu').removeClass('is-active');
			rsGoProUnLockPageScroll();
		}
	}
}

function rsGoProFlyMenuResize() {
	var $flyMenuParent = $('.js-fly-menu-parent'),
		$flyMenuChildren = $('.js-fly-menu-children'),
		windowWidthBreakpoint = 767;

	if ($(window).outerWidth() > windowWidthBreakpoint) {
		setTimeout(function(){
			$flyMenuChildren.removeClass('js-fly-menu-mobile-mode').css('left', Math.ceil($flyMenuParent.position().left));
		}, 10);
	} else {
		$flyMenuChildren.addClass('js-fly-menu-mobile-mode').css({left: 'auto', top: 'auto'});
	}
}

function rsGoProFlyMenuOpen() {
	var windowWidthBreakpoint = 767;

	$('html').addClass('header-fly-active-menu');
	$('.js-fly-menu').addClass('is-active');
	
	if ($(window).outerWidth() <= windowWidthBreakpoint) {
		rsGoProLockPageScroll();
	}
}

function rsGoProFlyMenuClose() {
	var windowWidthBreakpoint = 767;

	$('html').removeClass('header-fly-active-menu');
	$('.js-fly-menu').removeClass('is-active');
	$('.js-fly-menu-children').data('count-subopen', 0).css('height', 'auto').find('.open').removeClass('open');
	$('.js-fly-menu-subopen').removeClass('js-fly-menu-subopen');

	if ($(window).outerWidth() <= windowWidthBreakpoint) {
		rsGoProUnLockPageScroll();
	}
}

$(document).ready(function(){

    rsGoProFlyMenuResize();

    $(window).resize(BX.debounce(function() {
		rsGoProFlyHeaderResize();
		rsGoProFlyMenuResize();
		rsGoProUnLockPageScroll();
    }, 100));
    
    $(window).on('scroll', function(){
		rsGoProFlyHeaderScroll();
	});

	$(document).on('click', '.js-fly-menu', function(e) {
		// var windowWidthBreakpoint = 767;

		// if ($(window).outerWidth() <= windowWidthBreakpoint) {
			if ($('html').hasClass('header-fly-active-menu')) {
				rsGoProFlyMenuClose();
			} else {
				rsGoProFlyMenuOpen();
			}
			rsGoProFlyMenuResize();
		// }
	});

	/*$(document).on('mouseenter', '.js-fly-menu', function(e) {
		var windowWidthBreakpoint = 767;

		if ($(window).outerWidth() > windowWidthBreakpoint) {
			rsGoProFlyMenuOpen();
			rsGoProFlyMenuResize();
		}
	}).on('mouseleave', '.js-fly-menu', function(e) {
		var windowWidthBreakpoint = 767;

		if ($(window).outerWidth() > windowWidthBreakpoint) {
			rsGoProFlyMenuClose();
			rsGoProFlyMenuResize();
		}
	});*/

	$(document).on('click', '.js-fly-menu-children.js-fly-menu-mobile-mode .js-fly-menu__open-sub', function(e) {
		// e.preventDefault();
		var $this = $(this),
			$countSubOpen = parseInt($this.closest('.js-fly-menu-children').data('count-subopen')) + 1;

		$this.closest('.js-fly-menu-children').data('count-subopen', $countSubOpen);

		$('.js-fly-menu-children').css('height', 'auto');
		$this.closest('.js-fly-menu-children').find('.current-open').removeClass('current-open');
		$this.closest('.js-fly-menu__parent-ul').addClass('open current-open');
		$this.closest('.js-fly-menu__parent-li').addClass('open current-open');
		$('.js-fly-menu-children').css('height', $('.js-fly-menu-children').find('li.current-open > ul').outerHeight());
		$('.js-menu-shade').addClass('js-fly-menu-subopen');
		return false;
	});

	$(document).on('click', '.js-fly-menu-children.js-fly-menu-mobile-mode .js-fly-menu__back', function(e) {
		// e.preventDefault();
		var $this = $(this),
			$countSubOpen = parseInt($this.closest('.js-fly-menu-children').data('count-subopen')) - 1;

		$this.closest('.js-fly-menu-children').data('count-subopen', $countSubOpen);

		$('.js-fly-menu-children').css('height', 'auto');
		$this.closest('.js-fly-menu__parent-ul.open').removeClass('open current-open');
		$this.closest('.js-fly-menu__parent-li.open').removeClass('open current-open');
		$this.closest('.js-fly-menu__parent-ul.open').addClass('current-open');
		$this.closest('.js-fly-menu__parent-li.open').addClass('current-open');
		$('.js-fly-menu-children').css('height', $('.js-fly-menu-children').find('li.current-open > ul').outerHeight());
		if ($countSubOpen < 1) {
			$('.js-menu-shade').removeClass('js-fly-menu-subopen');
		}
		return false;
	});

	// close by click outside
	$(document).on('click', function(e) {
		if ($(e.target).parents('.js-fly-menu').length > 0 || $(e.target).parents('.js-menu-shade').length ||  $(e.target).hasClass('js-fly-menu')) {
			
		} else {
			rsGoProFlyMenuClose();
			rsGoProUnLockPageScroll();
		}
	});
	// /close by click outside

});
