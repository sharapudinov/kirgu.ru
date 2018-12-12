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

function RSGoPro_PutJSon(json, $linkObj, ajaxpagesid) {
    if (json.TYPE == 'OK') {
        if (ajaxpagesid && ajaxpagesid == json.IDENTIFIER) {
            if ($linkObj && json.HTML.catalogajaxpages) {
                $linkObj.parents('.js-ajaxpages').replaceWith(json.HTML.catalogajaxpages);
            } else if ($linkObj) {
                $linkObj.parents('.js-ajaxpages').remove();
            }
        } else {
            console.warn( 'PutJSon -> no ajaxpages' );
        }

        if (json.HTMLBYID) {
            for (var key in json.HTMLBYID) {
                if ($('#' + key)) {
                    if (json.METHOD == 'append') {
                        $('#' + key).append(json.HTMLBYID[key]);
                    } else {
                        $('#' + key).html(json.HTMLBYID[key]);
                    }
                }
            }
        }

        if (json.HTMLBYCLASS && ajaxpagesid && ajaxpagesid == json.IDENTIFIER) {
            for (var key in json.HTMLBYCLASS) {
                var $obj = $('#' + ajaxpagesid).find('.' + key);
                if ($obj) {
                    if (json.METHOD == 'append') {
                        $obj.append(json.HTMLBYCLASS[key]);
                    } else {
                        $obj.html(json.HTMLBYCLASS[key]);
                    }
                }
            }
        }

        RSGoPro_SetSet();
    } else {
        console.warn( 'PutJSon -> request return error' );
    }
}

// Area2Darken
function RSGoPro_Area2Darken(areaObj, anim, options) {
    var opt = $.extend({
        'progressLeft': false,
        'progressTop': false,
    }, options);

    if(!areaObj.hasClass('areadarken')) {
        if (areaObj.css('position') != 'absolute' && areaObj.css('position') != 'relative') {
            areaObj.css({'position': 'relative'});
        }
        areaObj.addClass('areadarken').append('<div class="area2darken"></div>');
        if (anim == 'animashka') {
            areaObj.find('.area2darken').append('<i class="icon animashka"></i>');
            if (opt.progressTop) {
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
    rsGoProLazyInit();
}

// set viewed
function RSGoPro_SetViewed() {
    var selector = '.js-viewed-prod-count',
        count = parseInt(Object.keys(RSGoPro_VIEWED).length);
    $(selector).html(count);
    if (count > 0) {
        $(selector).addClass('js-more-than-zero');
    } else {
        $(selector).removeClass('js-more-than-zero');
    }
}

// set compare
function RSGoPro_SetCompared() {
    var selector = '.js-compare-prod-count',
        count = parseInt(Object.keys(RSGoPro_COMPARE).length);
    $('.js-add2compare').removeClass('in');
    for (element_id in RSGoPro_COMPARE) {
        if (RSGoPro_COMPARE[element_id] == 'Y' && $('.js-elementid' + element_id).find('.js-add2compare').length > 0) {
            $('.js-elementid' + element_id).find('.js-add2compare').addClass('in');
        }
    }
    $(selector).html(count);
    if (count > 0) {
        $(selector).addClass('js-more-than-zero');
    } else {
        $(selector).removeClass('js-more-than-zero');
    }
}

// set favorite
function RSGoPro_SetFavorite() {
    var selector = '.js-favorite-prod-count',
        count = parseInt(Object.keys(RSGoPro_FAVORITE).length);
    $('.js-add2favorite').removeClass('in');
    for (element_id in RSGoPro_FAVORITE) {
        if (RSGoPro_FAVORITE[element_id] == 'Y' && $('.js-elementid' + element_id).find('.js-add2favorite').length > 0) {
            $('.js-elementid' + element_id).find('.js-add2favorite').addClass('in');
        }
    }
    $(selector).html(count);
    if (count > 0) {
        $(selector).addClass('js-more-than-zero');
    } else {
        $(selector).removeClass('js-more-than-zero');
    }
}

// set in basket
function RSGoPro_SetInBasket() {
    var selector = '.js-basket-prod-count',
        count = parseInt(Object.keys(RSGoPro_INBASKET).length);
    $('.js-pay__form').removeClass('in');
    for (element_id in RSGoPro_INBASKET) {
        if (RSGoPro_INBASKET[element_id] == 'Y' && $(".js-add2basketpid[value='" + element_id + "']").length > 0) {
            $('.js-add2basketpid[value="' + element_id + '"]').css('color', 'red').parents('.js-pay__form').addClass('in');
        }
        if (parseInt(RSGoPro_INBASKET[element_id]) > 0 && $('.products').find('.js-add2basketform' + RSGoPro_INBASKET[element_id]).length > 0) {
            $('.js-add2basketform' + RSGoPro_INBASKET[element_id]).addClass('in');
        }
    }
    $(selector).html(count);
    if (count > 0) {
        $(selector).addClass('js-more-than-zero');
    } else {
        $(selector).removeClass('js-more-than-zero');
    }
    $('.js-basket-allsum-formated').html(RSGoPro_BASKET.allSum_FORMATED);
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

// lazyload images
function rsGoProLazyInit() {
    $('.js-lazy-section').each(function() {
        var $section = $(this),
            $animationBlock = $section.find('.lazy-animation');

        if (!$section.hasClass('is-loading')) {
            return;
        }

        $section.find('.js-lazy').removeClass('js-lazy').addClass('js-lazy-sect');
        $section.find('.js-lazy-sect').lazy({
            onFinishedAll: function() {
                $section.removeClass('is-loading');
                $animationBlock.removeClass('lazy-animation').fadeIn(500);
            }
        });
    });

    $('.js-lazy').Lazy({
        effect: 'fadeIn',
        effectTime: 500,
        afterLoad: function(element) {
            element.removeClass('lazy-animation');
        }
    });
}

// phone mask
function RSGoPro_InitMaskPhone() {
    if ($('.maskPhone').length > 0) {
        $(".maskPhone").mask(window.RSGoPro_PhoneMask);
    }
}

function rsGoProToggleLockPageScroll() {
    $('html').toggleClass('rsgopro-lockscroll');
}
function rsGoProLockPageScroll() {
    $('html').addClass('rsgopro-lockscroll');
}
function rsGoProUnLockPageScroll() {
    $('html').removeClass('rsgopro-lockscroll');
}

/*
$(document).on('rsGoPro.document.ready', function(){
*/
debugger

BX.addCustomEvent('onFrameDataReceived', function(json){
    debugger
    $('html').addClass('rsgopro-document-ready');

    if ($('.js-header-fly').length > 0) {
        setTimeout(function(){
            $('.js-header-fly').addClass('document-ready');
        }, 50);
    }

    $(window).resize(BX.debounce(function() {
        var left_B = $('.catalogmenu2 li ul.first').height();
        var right_B = $('.aroundjssorslider1').height();

        if (left_B < right_B && screen.width > 100) {
            $('.aroundjssorslider1').css('min-height','auto');
        }
    }, 100));

    // Location change
    BX.addCustomEvent('rs.location_change', function() {
        BX.reload();
    });

    // quantity
    $(document).on('change', '.js-quantity', BX.debounce(function(){
        if ($(this).closest('.js-detail').length > 0) {
            var quantity = $(this).val();
            BX.onCustomEvent('rs_delivery_update', [0, quantity]);
        }
    }, 250));

    // lazyload images
    rsGoProLazyInit();

    // offer change
    $(document).on('RSGoProOnOfferChange', function(e, obj){
        if ($(obj).find('.timers').length > 0){
            if ($(obj).find('.intimer').data('autoreuse') == 'N'){
                var dateNowOfferChange = new Date;
                dateNowOfferChange = (Date.parse(dateNowOfferChange))/1000;
                var dateFromOfferChange = $(obj).find('.timer').data('datefrom');
                var dateToOfferChange = $(obj).find('.intimer').data('dateto');
                if ((dateToOfferChange - dateNowOfferChange) < 0){
                    $(obj).find('.timers').css('display', 'none');
                    $(obj).removeClass('da2 qb');
                    $(obj).find('.price').removeClass('new');
                }
            }
        }
        BX.onCustomEvent('rs_delivery_update');
    });

    // Click protection
    $(document).on('click','.click_protection',function(e){
        e.stopImmediatePropagation();
        console.warn( 'Click protection' );
        return false;
    });

    // a -> submit form
    $(document).on('click', 'form .js-submit, form .submit', function() {
        $(this).parents('form').find('input[type="submit"]').trigger('click');
        return false;
    });

    // AJAX -> add2basket
    $(document).on('submit', '.js-pay__form', function() {
        var $formObj = $(this),
            id = parseInt($formObj.find('.js-add2basketpid').val()),
            url = $formObj.parents('.js-element').data('detail');

        if (id > 0) {
            BX.onCustomEvent('rs.gopro.before.add2basket', [{elementId: id}]);

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

                    BX.onCustomEvent('rs.gopro.after.add2basket', [{elementId: id}]);
                } else {
                    console.warn( 'add2basket - error responsed' );
                }
            }).fail(function(data) {
                console.warn( 'add2basket - can\'t load json' );
            }).always(function() {
                RSGoPro_Area2Darken($formObj);
                RSGoPro_Area2Darken($('#header').find('.basketinhead'));
            });
        } else {
            console.warn( 'add product to basket failed' );
        }
        return false;
    });

    // AJAX -> add2compare
    $(document).on('click', '.js-add2compare', function(){
        var $linkObj = $(this);
        var id = parseInt( $linkObj.parents('.js-element').data('elementid') );
        var action = '';
        var url = $linkObj.parents('.js-element').data('detail');
        if (id > 0) {
            BX.onCustomEvent('rs.gopro.before.add2compare', [{elementId: id}]);
            RSGoPro_Area2Darken($('.js-add2compare'));
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
                    BX.onCustomEvent('rs.gopro.after.add2compare', [{elementId: id}]);
                } else {
                    console.warn( 'compare - error responsed' );
                }
            }).fail(function(data){
                console.warn( 'compare - fail request' );
            }).always(function(){
                RSGoPro_Area2Darken($('.js-add2compare'));
                RSGoPro_SetCompared();
            });
        }
        return false;
    });

    // AJAX -> add2favorite
    $(document).on('click','.js-add2favorite',function(){
        var $linkObj = $(this);
        var id = parseInt( $linkObj.parents('.js-element').data('elementid') );
        var url = $linkObj.parents('.js-element').data('detail');
        if (id > 0) {
            BX.onCustomEvent('rs.gopro.before.add2favorite', [{elementId: id}]);
            RSGoPro_Area2Darken($('.js-add2favorite'));
            var url = url + '?AJAX_CALL=Y&' + rsGoProActionVariableName + '=add2favorite&' + rsGoProProductIdVariableName + '=' + id;
            $.getJSON(url, {}, function(json){
                if (json.TYPE == "OK") {
                    RSGoPro_PutJSon(json);
                    if (RSGoPro_FAVORITE[id] == 'Y') { // remove from favorite
                        delete RSGoPro_FAVORITE[id];
                    } else { // add to favorite
                        RSGoPro_FAVORITE[id] = 'Y';
                    }
                    BX.onCustomEvent('rs.gopro.after.add2favorite', [{elementId: id}]);
                } else {
                    console.warn( 'favorite - error responsed' );
                }
            }).fail(function(data){
                console.warn( 'favorite - fail request' );
            }).always(function(){
                RSGoPro_Area2Darken($('.js-add2favorite'));
                RSGoPro_SetFavorite();
            });
        }
        return false;
    });

    // quantity
    $(document).on('click', '.js-minus', function(){
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

    $(document).on('click', '.js-plus', function(){
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

    $(document).on('blur', '.js-quantity', function(){
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

    // owl -> all
    rsGoPro.options.owl.base = {
        autoHeight: false,
        nav: true,
        items: 1,
        dots: false,
        dotsData: false,
        margin: 20,
        responsive: {},
        loop: true,
        onInitialized: function () {
            this.$element.addClass('owl-carousel');

            if (this.$element.closest('.rs-gopro-popup').length) {
                $.fancybox.update();
            }
        }
    };

    $('.js-owl-slider').each(function() {
        $slider = $(this);
        $slider.owlCarousel($.extend({}, rsGoPro.options.owl.base));
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
            BX.onCustomEvent('rs.gopro.fancybox.beforeLoad', [this]);
            RSGoPro_HideAllPopup();
        },
        afterLoad: function() {
            var data, fieldName;

            BX.onCustomEvent('rs.gopro.fancybox.afterLoad', [this]);

            var title = this.opts.$orig.attr('title') ||  this.opts.$orig.text();
            if (title) {
                this.$slide.children('div').prepend('<div class="fancybox-custom-title"><span>' + title + '</span></div>');
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
            id = $product.data('elementid');

        if (parseInt(id) > 0) {
            BX.onCustomEvent('rs.gopro.before.unsubscribe', [{elementId: id}]);
            var ajaxRequest = {
                type: 'POST',
                data: {
                    sessid: BX.bitrix_sessid(),
                    deleteSubscribe: 'Y',
                    itemId: id,
                    listSubscribeId: $link.data('subscribe-id').length > 0 ? BX.parseJSON($link.data('subscribe-id')) : []
                },
                url: '/bitrix/components/bitrix/catalog.product.subscribe.list/ajax.php',
                success: function(data) {
                    data = BX.parseJSON(data);
                    if (data.success) {
                        // location.reload();
                        $product.remove();
                        BX.onCustomEvent('rs.gopro.after.unsubscribe', [{elementId: id}]);
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

    // pseudo focus
    $(document).on('focus blur', '.js-pseudo-focus-blur-input', function(){
        $(this).parents('.js-pseudo-focus-blur').toggleClass('js-pseudo-focus');
    });
    // /pseudo focus

    $(document).on('click', '.js-easy-scroll', function(e){
        var $this = $(this),
            scrollSelector = $this.attr('href'),
            offset = $this.data('es-offset') ? $this.data('es-offset') : 0;

        if ($(scrollSelector).length != 0) {
            if ($('a[href="' + scrollSelector +'"]').length > 0) {
                $('a[href="' + scrollSelector +'"]').tab('show');
            }
            setTimeout(function(){
                $('html:not(:animated), body:not(:animated)').animate({
                    scrollTop: $(scrollSelector).offset().top + (offset)
                }, {
                    duration: 500,
                    easing: 'swing'
                });
            }, 50);
        }

        return false;
    });

});

if (window.frameCacheVars !== undefined) {
    BX.addCustomEvent('onFrameDataReceived', function(json) {
        $(document).trigger('rsGoPro.document.ready');
    });
} else {
    BX.ready(function() {
        $(document).trigger('rsGoPro.document.ready');
    });
}
