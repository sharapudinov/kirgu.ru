var RSGoPro_Hider_called = false;
var RSGoPro_BigadataGalleryFlag = true;

// hide filter and sorter when goods is empty
function RSGoPro_Hider() {
	RSGoPro_Hider_called = true;
	$('.sidebar, .mix, .navi, .catalogsorter').hide();
	$('.catalog .prods').css('marginLeft','0px');
}

function RSGoProListPictures(elementObj) {
	var $product = $(elementObj),
		$picture = $product.find('.js-list-picture'),
		elementId = $product.data('elementid'),
		offerId = $product.find('.js-add2basketpid').val() ? $product.find('.js-add2basketpid').val() : $product.data('productid');
	var imageElementCount = Object.keys(RSGoPro_Pictures[elementId][elementId]).length,
		imageOfferCount = Object.keys(RSGoPro_Pictures[elementId][offerId]).length,
		imageCount = imageElementCount + imageOfferCount,
		images;

	if ($picture.length > 0 && imageCount > 0) {
		if (imageOfferCount && offerId != elementId) {
			images = RSGoPro_Pictures[elementId][offerId];
			for (var key in images) {
				$picture.attr('src', images[key].SRC);
				return;
			}
		} else if (imageElementCount) {
			images = RSGoPro_Pictures[elementId][elementId];
			for (var key in images) {
				$picture.attr('src', images[key].SRC);
				return;
			}
		}
	}
}

$(document).ready(function(){

	if( $('.prices_jscrollpane').length>0 ) {
		RSGoPro_ScrollInit('.prices_jscrollpane');
		$(window).resize(function(){
			RSGoPro_ScrollReinit('.prices_jscrollpane');
		});
	}
	
	// close open attributes (list view)
	$(document).on('mouseleave', '.view-showcase .js-element' ,function(){
		$(this).find('.js-attributes__prop.open').removeClass('open').addClass('close');
		return false;
	});

	if (add_hidder == true) {
		RSGoPro_Hider();
	}
	if (RSGoPro_Hider_called) {
		RSGoPro_Hider();
	}

	// change offer handler
	$(document).on('RSGoProOnOfferChange', function(e, elementObj){
		RSGoProListPictures(elementObj);
	});
	
});
