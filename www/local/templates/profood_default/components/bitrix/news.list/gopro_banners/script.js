$(document).ready(function() {

	var $owlGoProBanners = $('#owlGoProBanners'),
		owlGoProBannersOptions = {
			changeSpeed : $owlGoProBanners.parent().data('change-speed'),
			changeDelay : $owlGoProBanners.parent().data('change-delay')
		};

	if ($owlGoProBanners.find('.js-item').length > 1) {
		var rsGoPro_goProBannersOptions = {
			items				: 1,
			loop				: true,
			autoplay			: true,
			nav					: true,
			navText				: ['<span><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-left"></use></svg></span>',
									'<span><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-right"></use></svg></span>'],
			navClass			: ['owl-prev', 'owl-next'],
			autoplaySpeed		: owlGoProBannersOptions.changeSpeed,
			autoplayTimeout		: owlGoProBannersOptions.changeDelay,
			smartSpeed			: owlGoProBannersOptions.changeSpeed
		};
		$owlGoProBanners.owlCarousel(rsGoPro_goProBannersOptions);
	}

	// play video
	$('.gopro-banners').find('video').each(function() {
		if ($(this).attr('autoplay') == 'autoplay') {
			$(this).get(0).play();
		}
	});
	
});
