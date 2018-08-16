$(document).ready(function(){

	var $owlGoProBrands = $('#owl_brandslist1'),
		owlGoProBrandsOptions = {
			changeSpeed : $owlGoProBrands.parent().data('change-speed'),
			changeDelay : $owlGoProBrands.parent().data('change-delay')
		};
	
	if ($owlGoProBrands.find('.item').length > 1) {
		
		var rsGoPro_goProBrandsOptions = {
			items				: 6,
			loop				: true,
			autoplay			: true,
			margin 				: 20,
			nav					: true,
			navText				: ['<span><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-left"></use></svg></span>',
									'<span><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-right"></use></svg></span>'],
			navClass			: ['owl-prev', 'owl-next'],
			dots				: false,
			responsive:{
				0: {
					items 	: 2
				},
				600: {
					items 	: 3
				},
				800: {
					items 	: 4
				},
				1000: {
					items 	: 5
				},
				1200: {
					items 	: 6
				}
			},
			autoplaySpeed		: owlGoProBrandsOptions.changeSpeed,
			autoplayTimeout		: owlGoProBrandsOptions.changeDelay,
			smartSpeed			: owlGoProBrandsOptions.changeSpeed,
			lazyLoad			: true,
			animateIn			: 'fadeIn',
			onLoadedLazy		: function (e) {
				var element = $(e.element);
				element.removeClass('lazy-animation').addClass('lazy-loaded');
			}
		};
		$owlGoProBrands.owlCarousel(rsGoPro_goProBrandsOptions);

	}
	
});
