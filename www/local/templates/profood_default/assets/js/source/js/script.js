;(function($) {
  $.fn.setHtmlByUrl = function(options) {
    var settings = $.extend({
      'url': ''
    }, options);
    return this.each(function() {
      if ('' != settings.url) {
        var $this = $(this);
        $.ajax({
          type: 'GET',
          dataType: 'html',
          url: settings.url,
          beforeSend: function() {
            if ('localStorage' in window && window['localStorage'] !== null) {
              data = localStorage.getItem(settings.url);
              if (data) {
                localStorage.setItem(settings.url, data);
                $this.append(data);
                return false;
              }
              return true;
            }
          },
          success: function(data) {
            localStorage.setItem(settings.url, data);
            $this.append(data);
          },
        });
      }
    });
  };
})(jQuery);

var RSGoPro_AJAXPAGES_processing = false;

function RSGoPro_PutJSon(json,$linkObj,ajaxpagesid) {
	if(json.TYPE=='OK') {
		if(ajaxpagesid && ajaxpagesid==json.IDENTIFIER) {
			if(json.HTML.catalognames) {
				$('#'+ajaxpagesid).find('.names > tbody > tr:last').after( json.HTML.catalognames );
			}
			if(json.HTML.catalogproducts) {
				$('#'+ajaxpagesid).find('.products > tbody > tr:last').after( json.HTML.catalogproducts );
			}
			if(json.HTML.showcaseview) {
				$('#'+ajaxpagesid).find('#showcaseview').append( json.HTML.showcaseview );
			}
			if($linkObj && json.HTML.catalogajaxpages) {
				$linkObj.parents('.ajaxpages').replaceWith( json.HTML.catalogajaxpages );
			} else if($linkObj) {
				$linkObj.parents('.ajaxpages').remove();
			}
		} else {
			console.warn( 'PutJSon -> no ajaxpages' );
		}
		if(json.HTMLBYID) {
			for(var key in json.HTMLBYID) {
				if( $('#'+key) ) {
					$('#'+key).html( json.HTMLBYID[key] );
				}
			}
		}
	} else {
		console.warn( 'PutJSon -> request return error' );
	}
}

// AjaxPages
function RSGoPro_AjaxPages(linkObj) {
	if(linkObj.parent().hasClass('animation')) {
		linkObj.parent().removeClass('animation');
		// if that was table - repaint lines
		var $div = $( '#'+linkObj.data('ajaxpagesid') );
		if( $div.length>0 && $div.find('.artables').length>0 && $div.find('.artables .names > tbody > tr').length>1 ) {
			var id = 0;
			$div.find('.artables .names > tbody > tr').each(function(i){
				id = $(this).data('elementid');
				if( i % 2 == 0 ) {
					$(this).addClass('even');
					$div.find('.artables .products tr.js-elementid'+id).addClass('even');
				} else {
					$(this).removeClass('even');
					$div.find('.artables .products tr.js-elementid'+id).removeClass('even');
				}
			});
		}
		// /if that was table - repaint lines
	} else {
		linkObj.parent().addClass('animation');
	}
}

// Area2Darken
function RSGoPro_Area2Darken(areaObj, anim, options) {
	var opt = $.extend( {
		'progressLeft': false,
		'progressTop': false,
    }, options);
	if(!areaObj.hasClass('areadarken')){
		areaObj.addClass('areadarken').css({"position":"relative"}).append('<div class="area2darken"></div>');
		if(anim == 'animashka'){
			areaObj.find('.area2darken').append('<i class="icon animashka"></i>');
			if(opt.progressTop){
				areaObj.find('.animashka').css({'top': opt.progressTop});
			}
		}
	} else {
		areaObj.removeClass('areadarken').removeAttr('style').find('.area2darken').remove();
	}
}

function RSGoPro_SetSet() {
	RSGoPro_SetViewed();
	RSGoPro_SetCompared();
	RSGoPro_SetFavorite();
	RSGoPro_SetInBasket();
	RSGoPro_TIMER();
}

// set viewed
function RSGoPro_SetViewed() {
	var selector = '.js-viewed-prod-count',
		count = parseInt(Object.keys(RSGoPro_VIEWED).length);
	$(selector).html(count);
	if (count > 0) {
		$(selector).addClass('js-have');
	} else {
		$(selector).removeClass('js-have');
	}
}

// set compare
function RSGoPro_SetCompared() {
	var selector = '.js-compare-prod-count',
		count = parseInt(Object.keys(RSGoPro_COMPARE).length);
	$('.add2compare').removeClass('in');
	for (element_id in RSGoPro_COMPARE) {
		if (RSGoPro_COMPARE[element_id] == 'Y' && $('.js-elementid' + element_id).find('.add2compare').length > 0) {
			$('.js-elementid' + element_id).find('.add2compare').addClass('in');
		}
	}
	$(selector).html(count);
	if (count > 0) {
		$(selector).addClass('js-have');
	} else {
		$(selector).removeClass('js-have');
	}
}

// set favorite
function RSGoPro_SetFavorite() {
	var selector = '.js-favorite-prod-count',
		count = parseInt(Object.keys(RSGoPro_FAVORITE).length);
	$('.add2favorite').removeClass('in');
	for (element_id in RSGoPro_FAVORITE) {
		if (RSGoPro_FAVORITE[element_id] == 'Y' && $('.js-elementid' + element_id).find('.add2favorite').length > 0) {
			$('.js-elementid' + element_id).find('.add2favorite').addClass('in');
		}
	}
	$(selector).html(count);
	if (count > 0) {console.log('a cho');
		$(selector).addClass('js-have');
	} else {console.log('ne-ne-ne');
		$(selector).removeClass('js-have');
	}
}

// set in basket
function RSGoPro_SetInBasket() {
	var selector = '.js-basket-prod-count',
		count = parseInt(Object.keys(RSGoPro_INBASKET).length);
	$('.add2basketform').removeClass('in');
	for (element_id in RSGoPro_INBASKET) {
		if (RSGoPro_INBASKET[element_id] == 'Y' && $(".js-add2basketpid[value='" + element_id + "']").length > 0) {
			$('.js-add2basketpid[value="' + element_id + '"]').parents('.add2basketform').addClass('in');
		}
		if (parseInt(RSGoPro_INBASKET[element_id]) > 0 && $('.products').find('.js-add2basketform' + RSGoPro_INBASKET[element_id]).length > 0) {
			$('.products').find('.js-add2basketform' + RSGoPro_INBASKET[element_id]).addClass('in');
		}
	}
	$(selector).html(count);
	if (count > 0) {
		$(selector).addClass('js-have');
	} else {
		$(selector).removeClass('js-have');
	}
	$('.js-basket-allsum-formated').html(RSGoPro_BASKET.allSum_FORMATED);
}

// AJAXPAGES
function RSGoPro_AJAXPAGESAuto() {
	$('.ajaxpages.auto').each(function(i){
		var porog = 200,
			$ajaxpObj = $(this);
		var ajaxpOffsetTop = $ajaxpObj.offset().top,
			window_height = $(window).height();
		if (porog > (ajaxpOffsetTop - window.pageYOffset - window_height) && !RSGoPro_AJAXPAGES_processing && !$ajaxpObj.hasClass('')) {
			$ajaxpObj.find('a').trigger('click');
		}
	});
}

// TIMER
function RSGoPro_TIMER() {
	$('.timer').timer({
		days: ".result-day",
		hours: ".result-hour",
		minute: ".result-minute",
		second: ".result-second",
		blockTime: ".val",
		linePercent: ".progress",
		textLinePercent: ".num_percent",
	});
}

function timerCanDelete() {
  
}

// phone mask
function RSGoPro_InitMaskPhone() {
	if ($('.maskPhone').length > 0) {
    $(".maskPhone").mask(window.RSGoPro_PhoneMask);
	}
}

$(document).ready(function(){

	$(window).resize(BX.debounce(function() {
		var left_B = $('.catalogmenu2 li ul.first').height();
		var right_B = $('.aroundjssorslider1').height();

		if (left_B < right_B && screen.width > 100) {
			$('.aroundjssorslider1').css('min-height','auto');
		}
	}, 100));

	$(window).scroll(function(){
		RSGoPro_AJAXPAGESAuto();
	});

	$(document).on('RSGoProOnOfferChange', function(e, obj){
		if($(obj).find('.timers').length >0){
			if($(obj).find('.intimer').data('autoreuse') == 'N'){
				var dateNowOfferChange = new Date;
				dateNowOfferChange = (Date.parse(dateNowOfferChange))/1000;
				var dateFromOfferChange = $(obj).find('.timer').data('datefrom');
				var dateToOfferChange = $(obj).find('.intimer').data('dateto');
				if((dateToOfferChange - dateNowOfferChange) < 0){
					$(obj).find('.timers').css('display', 'none');
					$(obj).removeClass('da2 qb');
					$(obj).find('.price').removeClass('new');
				}
			}
		}
	});
	// Click protection
	$(document).on('click','.click_protection',function(e){
		e.stopImmediatePropagation();
		console.warn( 'Click protection' );
		return false;
	});
	// /Click protection
	
	// a -> submit form
	$(document).on('click', 'form a.submit', function() {
		$(this).parents('form').find('input[type="submit"]').trigger('click');
		return false;
	});
	// /a -> submit form
	
	// AJAX -> add2basket
	$(document).on('submit', '.add2basketform', function() {
		var $formObj = $(this),
			id = parseInt($formObj.find('.js-add2basketpid').val()),
			url = $formObj.parents('.js-element').data('detail');
		
		if (id > 0) {
			var seriData = $(this).serialize(),
				url = url+'?' + seriData + '&AJAX_CALL=Y&' + rsGoProActionVariableName + '=add2basket';

			RSGoPro_Area2Darken($formObj);
			RSGoPro_Area2Darken($('#header').find('.basketinhead'));
			$.getJSON(url, {}, function(json) {
				if (json.TYPE == 'OK') {
					RSGoPro_INBASKET[id] = "Y";
					RSGoPro_BASKET.allSum_FORMATED = json.TOTAL_PRICE;
					RSGoPro_SetInBasket();
					RSGoPro_PutJSon(json);
				} else {
					console.warn( 'add2basket - error responsed' );
				}
			}).fail(function(data) {
				console.warn( 'add2basket - can\'t load json' );
			}).always(function() {
				RSGoPro_Area2Darken($formObj);
				RSGoPro_Area2Darken($('#header').find('.basketinhead'));
			});
		} else if ($formObj.parents('.elementpopup').length < 1) {
			// id = 0 -> Show popup (if PC)
			if (!RSDevFunc_PHONETABLET) {
				RSGoPro_GoPopup($formObj.parents('.js-element').data('elementid'), $formObj.parents('.js-element'));
			} else {
				if ($formObj.parents('.js-element').find('.js-detaillink').length > 0) {
					window.location = '//' + window.location.hostname + $formObj.parents('.js-element').find('.js-detaillink').attr('href')
				} else {
					console.warn( 'fail redirect - can\'t find link' );
				}
			}
		} else {
			console.warn( 'add product to basket failed' );
		}
		return false;
	});
	
	// AJAX -> add2compare 
	$(document).on('click', '.add2compare', function(){
		var $linkObj = $(this);
		var id = parseInt( $linkObj.parents('.js-element').data('elementid') );
		var action = '';
		var url = $linkObj.parents('.js-element').data('detail');
		if (id > 0) {
			RSGoPro_Area2Darken($('.add2compare'));
			if (RSGoPro_COMPARE[id] == 'Y') { // delete from compare
				action = 'DELETE_FROM_COMPARE_LIST';
			} else {
				action = 'ADD_TO_COMPARE_LIST';
			}
			var url = url+'?AJAX_CALL=Y&' + rsGoProActionVariableName + '=' + action + '&' + rsGoProProductIdVariableName + '='+id;
			$.getJSON(url, {}, function(json){
				if (json.TYPE == "OK") {
					RSGoPro_PutJSon(json);
					if (action == 'DELETE_FROM_COMPARE_LIST') { // delete from compare
						delete RSGoPro_COMPARE[id];
					} else { // add to compare
						RSGoPro_COMPARE[id] = 'Y';
					}
				} else {
					console.warn( 'compare - error responsed' );
				}
			}).fail(function(data){
				console.warn( 'compare - fail request' );
			}).always(function(){
				RSGoPro_Area2Darken($('.add2compare'));
				RSGoPro_SetCompared();
			});
		}
		return false;
	});
	
	// AJAX -> add2favorite
	$(document).on('click','.add2favorite',function(){
		var $linkObj = $(this);
		var id = parseInt( $linkObj.parents('.js-element').data('elementid') );
		var url = $linkObj.parents('.js-element').data('detail');
		if (id > 0) {
			RSGoPro_Area2Darken($('.add2favorite'));
			var url = url + '?AJAX_CALL=Y&' + rsGoProActionVariableName + '=add2favorite&' + rsGoProProductIdVariableName + '=' + id;
			$.getJSON(url, {}, function(json){
				if (json.TYPE == "OK") {
					RSGoPro_PutJSon(json);
					if (RSGoPro_FAVORITE[id] == 'Y') { // remove from favorite
						delete RSGoPro_FAVORITE[id];
					} else { // add to favorite
						RSGoPro_FAVORITE[id] = 'Y';
					}
				} else {
					console.warn( 'favorite - error responsed' );
				}
			}).fail(function(data){
				console.warn( 'favorite - fail request' );
			}).always(function(){
				RSGoPro_Area2Darken($('.add2favorite'));
				RSGoPro_SetFavorite();
			});
		}
		return false;
	});

	// AJAXPAGES
	$(document).on('click','.ajaxpages a',function(){
		var $linkObj = $(this);
		var ajaxurl = $linkObj.data('ajaxurl');
		var ajaxpagesid = $linkObj.data('ajaxpagesid');
		var navpagenomer = $linkObj.data('navpagenomer');
		var navpagecount = $linkObj.data('navpagecount');
		var navnum = $linkObj.data('navnum');
		var nextpagenomer = parseInt(navpagenomer) + 1;
		var url = '';
		
		if( $('#'+ajaxpagesid).length>0 && navpagenomer<navpagecount && parseInt(navnum)>0 && ajaxurl!="" ) {
			RSGoPro_AJAXPAGES_processing = true;
			RSGoPro_AjaxPages( $linkObj );
			if(ajaxurl.indexOf("?")<1) {
				url = ajaxurl + '?ajaxpages=Y&ajaxpagesid=' + ajaxpagesid + '&PAGEN_'+navnum+'='+nextpagenomer;
			} else {
				url = ajaxurl + '&ajaxpages=Y&ajaxpagesid=' + ajaxpagesid + '&PAGEN_'+navnum+'='+nextpagenomer;
			}
			$.getJSON(url, {}, function(json){
				RSGoPro_PutJSon( json,$linkObj,ajaxpagesid );
			}).fail(function(json){
				console.warn( 'ajaxpages - error responsed' );
			}).always(function(){
				setTimeout(function(){ // fix for slow shit
					RSGoPro_AJAXPAGES_processing = false;
					RSGoPro_AjaxPages( $linkObj );
				},50);
			});
		} else {
			if( !($('#'+ajaxpagesid).length>0) ) {
				console.warn( 'AJAXPAGES: ajaxpages -> empty DOM element' );
			}
			if( !(navpagenomer<navpagecount) ) {
				console.warn( 'AJAXPAGES: ajaxpages -> navpagenomer !< navpagecount' );
			}
			if( !(parseInt(navnum)>0) ) {
				console.warn( 'AJAXPAGES: ajaxpages -> parseInt(navnum)!>0' );
			}
			if( !(ajaxurl!="") ) {
				console.warn( 'AJAXPAGES: ajaxpages -> ajaxurl is empty' );
			}
		}
		return false;
	});
	// /AJAXPAGES
	
	// price table scroll
	$(document).on('click','.prices .arrowtop',function(){
		var $arrow = $(this);
		if($arrow.parent().find('tr').length>3 && !$(this).parent().find('tr:first').is(':visible')) {
			$arrow.parent().find('tr').each(function(i){
				if(!$(this).hasClass('noned')) {
					$arrow.parent().find('tr:eq('+(i-1)+')').removeClass('noned');
					$arrow.parent().find('tr:eq('+(i+2)+')').addClass('noned');
					return false;
				}
			});
		}
		return false;
	});
	$(document).on('click','.prices .arrowbot',function(){
		var $arrow = $(this);
		if($arrow.parent().find('tr').length>3 && !$(this).parent().find('tr:last').is(':visible')) {
			$arrow.parent().find('tr').each(function(i){
				if(!$(this).hasClass('noned')) {
					$(this).addClass('noned');
					$arrow.parent().find('tr:eq('+(i+3)+')').removeClass('noned');
					return false;
				}
			});
		}
		return false;
	});
	
	// disableSelection
	$(document).on('mouseenter mouseleave','.prices .arrowtop, .prices .arrowbot, .js-minus, .js-plus',function(){
		$('html').toggleClass('disableSelection');
	});
	
	// quantity
	$(document).on('click','.js-minus',function(){
    
		var $btn = $(this),
        $input = $btn.parent().find('.js-quantity'),
        ratio = parseFloat($btn.parent().find('.js-quantity').data('ratio')),
        ration2 = ratio.toString().split('.', 2)[1],
        length = 0,
        val = parseFloat($input.val());

		if (ration2 !== undefined) {
      length = ration2.length;
    }
		if (val > ratio) {
			$input.val((val - ratio).toFixed(length));
		}
    
    $input.trigger('change');

		return false;
	});
	$(document).on('click','.js-plus',function(){
    
		var $btn = $(this),
        $input = $btn.parent().find('.js-quantity'),
        ratio = parseFloat($input.data('ratio') ),
        ration2 = ratio.toString().split('.', 2)[1],
        length = 0,
        val = parseFloat($input.val());

		if (ration2 !== undefined) {
      length = ration2.length;
    }
		$input.val((val + ratio).toFixed(length));
    
    $input.trigger('change');

		return false;
	});
	$(document).on('blur','.js-quantity',function(){
		var $input = $(this),
        ratio = parseFloat($input.data('ratio')),
        ration2 = ratio.toString().split('.', 2)[1],
        length = 0;
		if (ration2 !== undefined) {
      length = ration2.length;
    }
		var val = parseFloat($input.val());
		if (val > 0) {
			$input.val((ratio * (Math.floor(val / ratio))).toFixed(length));
		} else {
			$input.val(ratio);
		}
	});
	
	// fancybox3 -> all
	rsGoPro.options.fancybox.popup = {},
	rsGoPro.options.fancybox.bigPopup = {};
	rsGoPro.options.fancybox.base = {
		infobar: false,
		buttons: false,
		slideShow: false,
		fullScreen: false,
		thumbs: false,
		closeBtn: false,
		closeTpl: '<a title="Close" data-fancybox-close class="fancybox-close" href="javascript:;"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-close-button"></use></svg></a>',
		ajax: {
			settings: {
				data: {
					'x-fancybox': 'y'
				}
			}
		},
		touch: false,
		keyboard: true,
		beforeLoad: function() {
			RSGoPro_HideAllPopup();
		},
		afterLoad: function() {
			var data, fieldName;

			if (this.opts.caption) {
				this.$slide.children('div').prepend('<div class="fancybox-custom-title"><span>' + this.opts.caption + '</span></div>');
			}

			if (this.opts.$orig && this.opts.$orig.data('insertdata')) {
				data = this.opts.$orig.data('insertdata');

				for (fieldName in data) {
					this.$slide.find('[name="' + fieldName + '"]').val(data[fieldName]);
				}
			}

			setTimeout(function(){
				RSGoPro_InitMaskPhone();
			}, 75);
		},
	};
	rsGoPro.options.fancybox.popup = $.extend({}, rsGoPro.options.fancybox.base);
	rsGoPro.options.fancybox.popup.baseClass = 'rs-gopro-popup',
	$('.fancyajax:not(.big)')
		.on('click touchstart', function(event) {})
		.data({
			type: 'ajax'
		})
		.fancybox(rsGoPro.options.fancybox.popup);
	rsGoPro.options.fancybox.bigPopup = $.extend({}, rsGoPro.options.fancybox.base);
	rsGoPro.options.fancybox.bigPopup.baseClass = 'rs-gopro-popup',
	$('.fancyajax.big')
		.on('click touchstart', function(event) {})
		.data({
		type: 'ajax'
		})
		.fancybox(rsGoPro.options.fancybox.bigPopup);
  
	RSGoPro_InitMaskPhone();

	$(document).on('focus blur', '.dropdown-block .bx-ui-sls-fake', function(){
		$(this).parents('.dropdown-block').toggleClass('focus');
	});

	$(document).on('click', '.js-element .js-product__unsubscribe', function(e) {
		e.preventDefault();
		var $link = $(this),
			$product = $(this).closest('.js-element'),
			productId = $product.data('elementid');

		if (parseInt(productId) > 0) {
			var ajaxRequest = {
				type: 'POST',
				data: {
					sessid: BX.bitrix_sessid(),
					deleteSubscribe: 'Y',
					itemId: productId,
					listSubscribeId: $link.data('subscribe-id').length > 0 ? BX.parseJSON($link.data('subscribe-id')) : []
				},
				url: '/bitrix/components/bitrix/catalog.product.subscribe.list/ajax.php',
				success: function(data) {
					data = BX.parseJSON(data);
					if (data.success) {
						// location.reload();
						$product.remove();
					}
				},
				error: function() {
					console.error('deleteSubscribe - error responsed?');
				},
				complete: function() {
					RSGoPro_Area2Darken($product, 'animashka');
				}
			};

			RSGoPro_Area2Darken($product, 'animashka');

			$.ajax(ajaxRequest);

		} else {
			console.warn('Product ID undefined');
		}
		return false;
	});

});
