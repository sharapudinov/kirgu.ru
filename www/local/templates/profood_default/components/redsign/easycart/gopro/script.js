var RSEC_MODULE_IS_HERE = true,
	RSEC_BX_COOKIE_PREFIX = 'BITRIX_SM_',
	RSEC_flag_tension_line = false,
	RSEC_ec_start_coordY = 0,
	RSEC_ec_start_height,
	RSEC_ec_start_height2;

function RSEC_BlockTab() {
	if ($('#rs_easycart').find('.rsec_tabs').find('.rsec_block').length < 1) {
		$('#rs_easycart').find('.rsec_tabs').css({"position":"relative"}).append('<div class="rsec_block"><i class="rsec_ikonka"></i></div>');
	}
}

function RSEC_UnBlockTab() {
	$('#rs_easycart').find('.rsec_tabs').css({"position":"static"}).find('.rsec_block').remove();
}

function RSEC_SetHeight() {
	var defaultHeight = 200,
		savedHeight = parseInt($.cookie(RSEC_BX_COOKIE_PREFIX+'RSEC_HEIGHT'));
		maxHeight = $('#rs_easycart').find('.rsec.rsec_headers').offset().top - window.pageYOffset - 50;

	if (savedHeight > 50) {
		if (savedHeight < maxHeight) {
			$('#rs_easycart').find('.rsec_content .rsec_tabs').css({'height':savedHeight+'px'});
		}
	} else {
		$('#rs_easycart').find('.rsec_content .rsec_tabs').css({'height':defaultHeight+'px'});
	}
}

function RSEC_HideEasyCart() {
	$('#rs_easycart').find('.rsec_content').removeClass('open');
	$('#rs_easycart').find('.rsec_tab').removeClass('selected');
	$('#rs_easycart').find('.rsec_changer').removeClass('selected');
}

function RSEC_SwitchTab($link) {
	var wasOpened = $('#rs_easycart').find('.rsec_content').hasClass('open'),
		tabSelector = $link.data('tabid'),
		tabWasOpened = $(tabSelector).hasClass('selected');

	RSEC_SetHeight();

	if (wasOpened && tabWasOpened) {
		RSEC_HideEasyCart();
	} else if(wasOpened && !tabWasOpened) {
		$('#rs_easycart').find('.rsec_tab').removeClass('selected');
		$(tabSelector).addClass('selected');
		$('#rs_easycart').find('.rsec_changer').removeClass('selected');
		$link.addClass('selected');
		$('#rs_easycart').find('.rsec_content').addClass('open');
	} else {
		$('#rs_easycart').find('.rsec_tab').removeClass('selected');
		$(tabSelector).addClass('selected');
		$('#rs_easycart').find('.rsec_changer').removeClass('selected');
		$link.addClass('selected');
		$('#rs_easycart').find('.rsec_content').addClass('open');
	}
}

// VIEWED
function RSEC_VIEWED_Refresh() {
	$(document).trigger('RSEC_BeforeViewedRefresh');

	$('#rs_easycart .rsec_viewed.js-unload').removeClass('js-unload');
	
	var url = $('#rs_easycart').data('serviceurl'),
		data = '';

	if (url.indexOf('?',0) > 0) {
		url = url + '&rsec_ajax_post=Y&rsec_mode=viewed';
	} else {
		url = url + '?rsec_ajax_post=Y&rsec_mode=viewed';
	}

	$('#rs_easycart').find('#rsec_viewed').find('form').find('input[name^="DELETE_"]').each(function(){
		if ($(this).is(':checked')) {
			data = data + $(this).attr('name') + '=' + $(this).val() + '&';
		}
	});

	if ($('#rs_easycart').find('#rsec_viewed').find('#rsec_indent').length > 0) {
		data = data + $('#rs_easycart').find('#rsec_viewed').find('#rsec_indent').attr('name') + '=' + $('#rs_easycart').find('#rsec_favorite').find('#rsec_indent').val() + '&';
	}

	RSEC_BlockTab();

	$.ajax({
		type: 'POST',
		url: url,
		data: data
	}).done(function(response) {
		$('#rs_easycart').find('#rsec_viewed').html(response);
		setTimeout(function() {
			$(document).trigger('RSEC_AfterViewedRefreshDone');
		}, 50);
	}).fail(function(){
		console.warn( 'RSEasyCart -> Viewed -> error' );
		$(document).trigger('RSEC_AfterViewedRefreshError');
	}).always(function(){
		if ($('#rs_easycart').find('#rsec_viewed').find('.rsec_jsline').length > 0) {
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_viewed').removeClass('rsec_changer_hide');
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_viewed').find('.rsec_cnt').html($('#rs_easycart').find('#rsec_viewed').find('.rsec_jsline').length);
		} else {
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_viewed').removeClass('rsec_changer_hide');
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_viewed').find('.rsec_cnt').html(0);
		}
		RSEC_UnBlockTab();
		$(document).trigger('RSEC_AfterViewedRefresh');
	});
}

// COMPARE
function RSEC_COMPARE_Refresh() {
	$(document).trigger('RSEC_BeforeCompareRefresh');

	$('#rs_easycart .rsec_compare.js-unload').removeClass('js-unload');

	var url = $('#rs_easycart').data('serviceurl'),
		data = '';

	if (url.indexOf('?',0) > 0) {
		url = url + '&rsec_ajax_post=Y&rsec_mode=compare';
	} else {
		url = url + '?rsec_ajax_post=Y&rsec_mode=compare';
	}

	$('#rs_easycart').find('#rsec_compare').find('form').find('input[name^="DELETE_"]').each(function(){
		if ($(this).is(':checked')) {
			data = data + $(this).attr('name') + '=' + $(this).val() + '&';
		}
	});

	RSEC_BlockTab();

	$.ajax({
		type: 'POST',
		url: url,
		data: data
	}).done(function(response) {
		$('#rs_easycart').find('#rsec_compare').html(response);
		setTimeout(function() {
			$(document).trigger('RSEC_AfterCompareRefreshDone');
		}, 50);
	}).fail(function(){
		console.warn( 'RSEasyCart -> Compare -> error' );
		$(document).trigger('RSEC_AfterCompareRefreshError');
	}).always(function(){
		if ($('#rs_easycart').find('#rsec_compare').find('.rsec_jsline').length > 0) {
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_compare').removeClass('rsec_changer_hide');
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_compare').find('.rsec_cnt').html( $('#rs_easycart').find('#rsec_compare').find('.rsec_jsline').length );
		} else {
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_compare').removeClass('rsec_changer_hide');
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_compare').find('.rsec_cnt').html( 0 );
		}
		RSEC_UnBlockTab();
		$(document).trigger('RSEC_AfterCompareRefresh');
	});
}

// FAVORITE
function RSEC_FAVORITE_Refresh() {
	$(document).trigger('RSEC_BeforeFavoriteRefresh');

	$('#rs_easycart .rsec_favorite.js-unload').removeClass('js-unload');
	
	var url = $('#rs_easycart').data('serviceurl'),
		data = '';

	if (url.indexOf('?',0) > 0) {
		url = url + '&rsec_ajax_post=Y&rsec_mode=favorite';
	} else {
		url = url + '?rsec_ajax_post=Y&rsec_mode=favorite';
	}

	$('#rs_easycart').find('#rsec_favorite').find('form').find('input[name^="DELETE_"]').each(function(){
		if ($(this).is(':checked')) {
			data = data + $(this).attr('name') + '=' + $(this).val() + '&';
		}
	});

	if ($('#rs_easycart').find('#rsec_favorite').find('#rsec_indent').length > 0) {
		data = data + $('#rs_easycart').find('#rsec_favorite').find('#rsec_indent').attr('name') + '=' + $('#rs_easycart').find('#rsec_favorite').find('#rsec_indent').val() + '&';
	}

	RSEC_BlockTab();

	$.ajax({
		type: 'POST',
		url: url,
		data: data
	}).done(function(response) {
		$('#rs_easycart').find('#rsec_favorite').html(response);
		setTimeout(function() {
			$(document).trigger('RSEC_AfterFavoriteRefreshDone');
		}, 50);
	}).fail(function(){
		console.warn( 'RSEasyCart -> Favorite -> error' );
		$(document).trigger('RSEC_AfterFavoriteRefreshError');
	}).always(function(){
		if ($('#rs_easycart').find('#rsec_favorite').find('.rsec_jsline').length > 0) {
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_favorite').removeClass('rsec_changer_hide');
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_favorite').find('.rsec_cnt').html( $('#rs_easycart').find('#rsec_favorite').find('.rsec_jsline').length );
		} else {
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_favorite').removeClass('rsec_changer_hide');
			$('#rs_easycart').find('.rsec_headers').find('.rsec_changer.rsec_favorite').find('.rsec_cnt').html( 0 );
		}
		RSEC_UnBlockTab();
		$(document).trigger('RSEC_AfterFavoriteRefresh');
	});
}

// BASKET
function RSEC_BASKET_Refresh() {
	$(document).trigger('RSEC_BeforeBasketRefresh');

	$('#rs_easycart .rsec_basket.js-unload').removeClass('js-unload');

	var url = '',
		data = '';

	if ($('#rs_easycart').find('#rsec_basket').find('form').length > 0) {
		url = $('#rs_easycart').find('#rsec_basket').find('form').attr('action');
		data = $('#rs_easycart').find('#rsec_basket').find('form').serialize();
	} else {
		url = $('#rs_easycart').data('serviceurl');
		data = '';
	}
  
	if (url.indexOf('?', 0) > 0) {
		url = url + '&rsec_ajax_post=Y&rsec_mode=basket&via_ajax=Y';
	} else {
		url = url + '?rsec_ajax_post=Y&rsec_mode=basket&via_ajax=Y';
	}

	RSEC_BlockTab();
	
	$.ajax({
		type: 'POST',
		url: url,
		data: data,
	}).done(function(response) {
		$('#rs_easycart').find('#rsec_basket').html( response );
		setTimeout(function() {
			if ($('#rs_easycart').find('#rsec_basket').find('.rsec_take_normalCount').length > 0) {
				$('#rs_easycart').find('.rsec_normalCount').html( $('#rs_easycart').find('#rsec_basket').find('.rsec_take_normalCount').html() );
				$('#rs_easycart').find('.rsec_allSum_FORMATED').html( $('#rs_easycart').find('#rsec_basket').find('.rsec_take_allSum_FORMATED').html() );
			} else {
				$('#rs_easycart').find('.rsec_normalCount').html( '0' );
				$('#rs_easycart').find('.rsec_allSum_FORMATED').html( '0' );
			}
			$(document).trigger('RSEC_AfterBasketRefreshDone');
		}, 50);
	}).fail(function(){
		console.warn( 'RSEasyCart -> Basket -> error' );
		$(document).trigger('RSEC_AfterBasketRefreshError');
	}).always(function(){
		RSEC_UnBlockTab();
		$(document).trigger('RSEC_AfterBasketRefresh');
	});
}

$(document).ready(function(){
	
	// easycart is here
	RSEC_MODULE_IS_HERE = true;
	
	// add padding for body
	if ($('#rs_easycart').hasClass('addbodypadding')) {
		$('body').css('padding-bottom','40px');
	}
	
	// tab switcher
	$(document).on('click', '#rs_easycart .rsec_headers .rsec_changer', function() {
		RSEC_SwitchTab($(this));
		return false;
	});
	
	// close by outside click
	$(document).on('click',function(e) {
		if ($(e.target).parents('#rs_easycart').length > 0) {
			
		} else {
			RSEC_HideEasyCart();
		}
	});
	
	// close by close button
	$(document).on('click','#rs_easycart a.rsec_close',function(e) {
		RSEC_HideEasyCart();
		return false;
	});

	// easycart resize
	$(document).on('mousedown','.rsec_tyanya',function(e) {
		RSEC_flag_tension_line = true;
		$('html').addClass('rsec_disableSelection');
		RSEC_ec_start_coordY = e.pageY;
		RSEC_ec_start_height = $('#rs_easycart').find('.rsec_tabs').height();
	});
	$(document).on('mouseup',function() {
		if (RSEC_flag_tension_line) {
			RSEC_flag_tension_line = false;
			$('html').removeClass('rsec_disableSelection');
		}
	});
	$(document).mousemove(function(e) {
		RSEC_ec_cur_height = $('#rs_easycart').find('.rsec_tabs').height();
		if (RSEC_flag_tension_line && (RSEC_ec_start_height+RSEC_ec_start_coordY-e.pageY) > 100) {
			$.cookie(RSEC_BX_COOKIE_PREFIX+'RSEC_HEIGHT',(RSEC_ec_start_height+RSEC_ec_start_coordY-e.pageY),'/');
			RSEC_SetHeight();
		}
	});
	
	// quantity
	$(document).on('blur', '.rs_easycart .js-quantity', BX.debounce(function(){
		RSEC_BASKET_Refresh();
	}, 250));
	$(document).on('mouseenter mouseleave', '#rs_easycart .rsec_quantity', function() {
		$('html').toggleClass('rsec_disableSelection');
	});
	
	// VIEWED
	$(document).on('click', '#rs_easycart .rsec_viewed.js-unload', function() {
		RSEC_VIEWED_Refresh();
		return false;
	});
	
	// COMPARE
	$(document).on('click', '#rs_easycart .rsec_thistab_compare .rsec_delall', function() {
		$(this).parents('form').find('input[name^="DELETE_"]').attr('checked', true);
		RSEC_COMPARE_Refresh();
		return false;
	});
	$(document).on('click', '#rs_easycart .rsec_thistab_compare .rsec_delete', function() {
		$(this).parents('.rsec_jsline').find('input[name^="DELETE_"]').attr('checked', true);
		RSEC_COMPARE_Refresh();
		return false;
	});
	$(document).on('click', '#rs_easycart .rsec_thistab_compare .rsec_delsome, #rs_easycart .rsec_compare.js-unload', function() {
		RSEC_COMPARE_Refresh();
		return false;
	});
	
	// FAVORITE
	$(document).on('click', '#rs_easycart .rsec_thistab_favorite .rsec_delall', function() {
		$(this).parents('form').find('input[name^="DELETE_"]').attr('checked', true);
		RSEC_FAVORITE_Refresh();
		return false;
	});
	$(document).on('click', '#rs_easycart .rsec_thistab_favorite .rsec_delete', function() {
		$(this).parents('.rsec_jsline').find('input[name^="DELETE_"]').attr('checked', true);
		RSEC_FAVORITE_Refresh();
		return false;
	});
	$(document).on('click', '#rs_easycart .rsec_thistab_favorite .rsec_delsome, #rs_easycart .rsec_favorite.js-unload', function() {
		RSEC_FAVORITE_Refresh();
		return false;
	});
	
	// BASKET
	var RSEC_BASKET_timeout = 0,
		RSEC_BASKET_delay = 1200;
	$(document).on('click', '#rs_easycart .rsec_thistab_basket .rsec_plus, #rs_easycart .rsec_thistab_basket .rsec_minus', function() {
		clearTimeout( RSEC_BASKET_timeout );
		RSEC_BASKET_timeout = setTimeout(function(){
			RSEC_BASKET_Refresh();
		}, RSEC_BASKET_delay);
	});
	$(document).on('click', '#rs_easycart .rsec_thistab_basket .rsec_delall', function() {
		$(this).parents('form').find('input[name^="DELETE_"]').attr('checked', true);
		RSEC_BASKET_Refresh();
		return false;
	});
	$(document).on('click', '#rs_easycart .rsec_thistab_basket .rsec_delete', function() {
		$(this).parents('.rsec_jsline').find('input[name^="DELETE_"]').attr('checked', true);
		RSEC_BASKET_Refresh();
		return false;
	});
	$(document).on('click', '#rs_easycart .rsec_thistab_basket .rsec_refresh, '+
		'#rs_easycart .rsec_thistab_basket .rsec_delsome, '+
		'#rs_easycart .rsec_thistab_basket .rsec_coup, '+
		'#rs_easycart .rsec_basket.js-unload', function() {
		RSEC_BASKET_Refresh();
		return false;
	});
	
	// universal ajax handler
	if ($('#rs_easycart').find('.rsec_universalhandler').length > 0) {
		var ajaxFinderCompare_add = '',
			ajaxFinderCompare_remove = '',
			ajaxFinderFavorite = '',
			ajaxFinderBasket = '';
		// COMPARE
		if ($('#rs_easycart').find('#rsec_compare').hasClass('rsec_universalhandler')) {
			ajaxFinderCompare_add = $('#rs_easycart').find('#rsec_compare').data('ajaxfinder_add');
		}
		if ($('#rs_easycart').find('#rsec_compare').hasClass('rsec_universalhandler')) {
			ajaxFinderCompare_remove = $('#rs_easycart').find('#rsec_compare').data('ajaxfinder_remove');
		}
		
		// FAVORITE
		if ($('#rs_easycart').find('#rsec_favorite').hasClass('rsec_universalhandler')) {
			ajaxFinderFavorite = $('#rs_easycart').find('#rsec_favorite').data('ajaxfinder');
		}
		
		// BASKET
		if ($('#rs_easycart').find('#rsec_basket').hasClass('rsec_universalhandler')) {
			ajaxFinderBasket = $('#rs_easycart').find('#rsec_basket').data('ajaxfinder');
		}
		
		if (ajaxFinderCompare_add != '' || ajaxFinderCompare_remove != '' || ajaxFinderFavorite != '' || ajaxFinderBasket != '') {
			$(document).ajaxSuccess(function(event, xhr, settings) {
				// COMPARE
				if ((ajaxFinderCompare_add != '' && settings.url.indexOf(ajaxFinderCompare_add, 0) > 0) || (ajaxFinderCompare_remove != '' && settings.url.indexOf(ajaxFinderCompare_remove, 0) > 0)) {
					RSEC_COMPARE_Refresh();
				}
				// FAVORITE
				if (ajaxFinderFavorite != '' && settings.url.indexOf(ajaxFinderFavorite, 0) > 0) {
					RSEC_FAVORITE_Refresh();
				}
				// BASKET
				if (ajaxFinderBasket != '' && (settings.url.indexOf(ajaxFinderBasket, 0) > 0 || settings.url.indexOf(rsGoProActionVariableName + '=add2basket', 0) > 0)) {
					RSEC_BASKET_Refresh();
				}
			});
		}
	}
	
});
