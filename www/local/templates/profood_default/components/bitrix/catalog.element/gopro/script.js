function RSGoProDetailShowFancyGallery() {
	var options = {
			loop	: true
		},
		$product = $('.js-detail'),
		$slider = $product.find('.js-picslider'),
		elementId = $product.data('elementid'),
		offerId = $product.find('.js-add2basketpid').val() ? $product.find('.js-add2basketpid').val() : $product.data('productid'),
		fancyImages = [],
		elementCount = (!!RSGoPro_Pictures[elementId] ? Object.keys(RSGoPro_Pictures[elementId]).length : 0),
		imageElementCount = (!!RSGoPro_Pictures[elementId] ? Object.keys(RSGoPro_Pictures[elementId][elementId]).length : 0),
		imageOfferCount = (!!RSGoPro_Pictures[elementId] ? Object.keys(RSGoPro_Pictures[elementId][offerId]).length : 0),
		imageCount = imageElementCount + imageOfferCount,
		images,
		owlViewPicSrc = $('.js-picslider').find('.owl-item.active').find('.js-picslide-a').attr('href'),
		imageIndex = 0;

	if (imageCount > 0) {
		if (imageOfferCount) {
			images = RSGoPro_Pictures[elementId][offerId];
			for (var key in images) {
				fancyImages.push(
					{
						src  : images[key].SRC_ORIGINAL,
						opts : {
							caption : images[key].TITLE
						}
					}
				);
			}
		}

		if (imageElementCount) {
			images = RSGoPro_Pictures[elementId][elementId];
			for (var key in images) {
				fancyImages.push(
					{
						src  : images[key].SRC_ORIGINAL,
						opts : {
							caption : images[key].TITLE
						}
					}
				);
			}
		}

		if (fancyImages) {
			for (var key in fancyImages) {
				if (fancyImages[key].src == owlViewPicSrc) {
					break;
				}
				imageIndex++;
			}
		}

		options = $.extend({}, options);
		$.fancybox.open(fancyImages, options, imageIndex);
	} else {
		console.warn('fancygallery -> images empty');
	}
}

function RSGoProDetailPictures() {
	var options = {
			items: 1,
			nav: false,
			dots: true,
			dotsData: true,
			dotsContainer: '.js-detail-dots',
			onInitialized: function () {
				this.$element.addClass('owl-carousel');
	
				if (this.$element.closest('.rs-gopro-popup').length) {
					$.fancybox.update();
				}

				$('.js-detail-dots').addClass('owl-carousel');
			}
		},
		$product = $('.js-detail'),
		$slider = $product.find('.js-picslider'),
		$sliderApi = $slider.data('owl.carousel'),
		elementId = $product.data('elementid'),
		offerId = $product.find('.js-add2basketpid').val() ? $product.find('.js-add2basketpid').val() : $product.data('productid'),
		owlHtml = '',
		smartSpeed = ($sliderApi ? $sliderApi.settings.smartSpeed : 0);
	var elementCount = Object.keys(RSGoPro_Pictures[elementId]).length,
		imageElementCount = Object.keys(RSGoPro_Pictures[elementId][elementId]).length,
		imageOfferCount = Object.keys(RSGoPro_Pictures[elementId][offerId]).length,
		imageCount = imageElementCount + imageOfferCount,
		images,
		lastofferid = $slider.data('lastofferid') ? $slider.data('lastofferid') : 0;

	if (lastofferid == offerId)
		return;

	if (offerId) 
		$slider.data('lastofferid', offerId);

	if (imageCount > 0) {
		if (imageOfferCount && offerId != elementId) {
			images = RSGoPro_Pictures[elementId][offerId];
			for (var key in images) {
				owlHtml += '<a class="js_picture_glass detail__pic__a js-picslide-a" href="'+ images[key].SRC_ORIGINAL +'" data-offer-id="'+ offerId +'" data-dot="<img class=\'owl-preview\' src=\''+ images[key].SRC +'\' data-offer-id=\'' + offerId +'\'>">\
					<img class="detail__pic__img" src="' + images[key].SRC_ORIGINAL + '"' + (!!images[key].ALT ? ' alt="' + images[key].ALT + '"' : '') + (!!images[key].TITLE ? ' title="' + images[key].TITLE + '"' : '') + '>\
				</a>';
			}
		}

		if (imageElementCount) {
			images = RSGoPro_Pictures[elementId][elementId];
			for (var key in images) {
				owlHtml += '<a class="js_picture_glass detail__pic__a js-picslide-a" href="'+ images[key].SRC_ORIGINAL +'" data-offer-id="'+ offerId +'" data-dot="<img class=\'owl-preview\' src=\''+ images[key].SRC +'\'>">\
					<img class="detail__pic__img" src="' + images[key].SRC_ORIGINAL + '"' + (!!images[key].ALT ? ' alt="' + images[key].ALT + '"' : '') + (!!images[key].TITLE ? ' title="' + images[key].TITLE + '"' : '') + '>\
				</a>';
			}
		}

		if (!$slider.hasClass('owl-carousel')) {
			options = $.extend({}, rsGoPro.options.owl.base, options);
			$slider.owlCarousel(options);
			$sliderApi = $slider.data('owl.carousel');
			smartSpeed = $sliderApi.settings.smartSpeed;
		}

		$sliderApi._plugins.navigation._templates = [];
        $sliderApi._plugins.navigation._controls.$absolute.html('');
        $sliderApi.settings.smartSpeed = 0;
		$slider.trigger('replace.owl.carousel', [owlHtml]);

		setTimeout(function() {
			$slider.trigger('refresh.owl.carousel').trigger('to.owl.carousel', [0]);
			$product.find('.js-scroll').scrollbar();
		}, 50);

		$sliderApi.settings.smartSpeed = smartSpeed;
	}
}

$(document).on('rsGoPro.document.ready', function(){

	$(document).on('click', '.js-picslide-a', function(e){
		e.stopPropagation();
		RSGoProDetailShowFancyGallery();
		return false;
	});

	// change offer handler
	$(document).on('RSGoProOnOfferChange', function(e, elementObj){
		RSGoProDetailPictures();
		BX.onCustomEvent('rs_delivery_update');
	});

	// activate first tab
	$('.js-detail-tabs a:first').tab('show');

	// tabs -> add review
	$(document).on('click','.js-add2review',function(e){
		e.stopPropagation();
		$('#detailreviews').find('.js-reviewform').toggleClass('hide');
		return false;
	});

	// pseudo tabs - anchor
	$(document).on('click', '.js-detail-anchor a', function(){
		var $this = $(this),
			selector = 'a[href="' + $this.attr('href') + '"]';
		
		$('.js-detail-tabs').find(selector).tab('show');

		return false;
	});

});

// add this element to viewed list
$(window).on('load', function(){

	// init images
	RSGoProDetailPictures();
	
	setTimeout(function(){
		$.ajax({
			type: 'POST',
			url: '/bitrix/components/bitrix/catalog.element/ajax.php',
			data: {
				AJAX		: 'Y',
				SITE_ID		: SITE_ID,
				PARENT_ID	: $('.js-detail').data('elementid'),
				PRODUCT_ID	: $('.js-detail').find('.js-add2basketpid').val()
			}
		}).done(function(response){
			console.log( 'Element add to viewed' );
		}).fail(function(){
			console.warn( 'Element can\'t add to viewed' );
		});
	}, 250);

});
