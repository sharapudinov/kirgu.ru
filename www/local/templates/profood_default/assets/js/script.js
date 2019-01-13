function RSGoPro_PutJSon(e, o, t) {
    if ("OK" == e.TYPE) {
        if (t && t == e.IDENTIFIER ? o && e.HTML.catalogajaxpages ? o.parents(".js-ajaxpages").replaceWith(e.HTML.catalogajaxpages) : o && o.parents(".js-ajaxpages").remove() : console.warn("PutJSon -> no ajaxpages"), e.HTMLBYID) for (var a in e.HTMLBYID) $("#" + a) && ("append" == e.METHOD ? $("#" + a).append(e.HTMLBYID[a]) : $("#" + a).html(e.HTMLBYID[a]));
        if (e.HTMLBYCLASS && t && t == e.IDENTIFIER) for (var a in e.HTMLBYCLASS) {
            var n = $("#" + t).find("." + a);
            n && ("append" == e.METHOD ? n.append(e.HTMLBYCLASS[a]) : n.html(e.HTMLBYCLASS[a]))
        }
        RSGoPro_SetSet()
    } else console.warn("PutJSon -> request return error")
}

function RSGoPro_Area2Darken(e, o, t) {
    var a = $.extend({progressLeft: !1, progressTop: !1}, t);
    e.hasClass("areadarken") ? e.removeClass("areadarken").removeAttr("style").find(".area2darken").remove() : ("absolute" != e.css("position") && "relative" != e.css("position") && e.css({position: "relative"}), e.addClass("areadarken").append('<div class="area2darken"></div>'), "animashka" == o && (e.find(".area2darken").append('<i class="icon animashka"></i>'), a.progressTop && e.find(".animashka").css({top: a.progressTop})))
}

function RSGoPro_SetSet() {
    RSGoPro_SetViewed(), RSGoPro_SetCompared(), RSGoPro_SetFavorite(), RSGoPro_SetInBasket(), RSGoPro_TIMER(), rsGoProLazyInit()
}

function RSGoPro_SetViewed() {
    var e = ".js-viewed-prod-count", o = parseInt(Object.keys(RSGoPro_VIEWED).length);
    $(e).html(o), 0 < o ? $(e).addClass("js-more-than-zero") : $(e).removeClass("js-more-than-zero")
}

function RSGoPro_SetCompared() {
    var e = ".js-compare-prod-count", o = parseInt(Object.keys(RSGoPro_COMPARE).length);
    for (element_id in $(".js-add2compare").removeClass("in"), RSGoPro_COMPARE) "Y" == RSGoPro_COMPARE[element_id] && 0 < $(".js-elementid" + element_id).find(".js-add2compare").length && $(".js-elementid" + element_id).find(".js-add2compare").addClass("in");
    $(e).html(o), 0 < o ? $(e).addClass("js-more-than-zero") : $(e).removeClass("js-more-than-zero")
}

function RSGoPro_SetFavorite() {
    var e = ".js-favorite-prod-count", o = parseInt(Object.keys(RSGoPro_FAVORITE).length);
    for (element_id in $(".js-add2favorite").removeClass("in"), RSGoPro_FAVORITE) "Y" == RSGoPro_FAVORITE[element_id] && 0 < $(".js-elementid" + element_id).find(".js-add2favorite").length && $(".js-elementid" + element_id).find(".js-add2favorite").addClass("in");
    $(e).html(o), 0 < o ? $(e).addClass("js-more-than-zero") : $(e).removeClass("js-more-than-zero")
}

function RSGoPro_SetInBasket() {
    var e = ".js-basket-prod-count", o = parseInt(Object.keys(RSGoPro_INBASKET).length);
    for (element_id in $(".js-pay__form").removeClass("in"), RSGoPro_INBASKET) "Y" == RSGoPro_INBASKET[element_id] && 0 < $(".js-add2basketpid[value='" + element_id + "']").length && $('.js-add2basketpid[value="' + element_id + '"]').css("color", "red").parents(".js-pay__form").addClass("in"), 0 < parseInt(RSGoPro_INBASKET[element_id]) && 0 < $(".products").find(".js-add2basketform" + RSGoPro_INBASKET[element_id]).length && $(".js-add2basketform" + RSGoPro_INBASKET[element_id]).addClass("in");
    $(e).html(o), 0 < o ? $(e).addClass("js-more-than-zero") : $(e).removeClass("js-more-than-zero"), $(".js-basket-allsum-formated").html(RSGoPro_BASKET.allSum_FORMATED)
}

function RSGoPro_TIMER() {
    $(".timer").timer({
        days: ".result-day",
        hours: ".result-hour",
        minute: ".result-minute",
        second: ".result-second",
        blockTime: ".val",
        linePercent: ".progress",
        textLinePercent: ".num_percent"
    })
}

function timerCanDelete() {
}

function rsGoProLazyInit() {
    $(".js-lazy-section").each(function () {
        var e = $(this), o = e.find(".lazy-animation");
        e.hasClass("is-loading") && (e.find(".js-lazy").removeClass("js-lazy").addClass("js-lazy-sect"), e.find(".js-lazy-sect").lazy({
            onFinishedAll: function () {
                e.removeClass("is-loading"), o.removeClass("lazy-animation").fadeIn(500)
            }
        }))
    }), $(".js-lazy").Lazy({
        effect: "fadeIn", effectTime: 500, afterLoad: function (e) {
            e.removeClass("lazy-animation")
        }
    })
}

function RSGoPro_InitMaskPhone() {
    0 < $(".maskPhone").length && $(".maskPhone").mask(window.RSGoPro_PhoneMask)
}

function rsGoProToggleLockPageScroll() {
    $("html").toggleClass("rsgopro-lockscroll")
}

function rsGoProLockPageScroll() {
    $("html").addClass("rsgopro-lockscroll")
}

function rsGoProUnLockPageScroll() {
    $("html").removeClass("rsgopro-lockscroll")
}

!function (a) {
    a.fn.setHtmlByUrl = function (e) {
        var t = a.extend({url: ""}, e);
        return this.each(function () {
            if ("" != t.url) {
                var o = a(this);
                a.ajax({
                    type: "GET", dataType: "html", url: t.url, beforeSend: function () {
                        if ("localStorage" in window && null !== window.localStorage) return data = localStorage.getItem(t.url), !data || (localStorage.setItem(t.url, data), o.append(data), !1)
                    }, success: function (e) {
                        localStorage.setItem(t.url, e), o.append(e)
                    }
                })
            }
        })
    }
}(jQuery), $(document).on("rsGoPro.document.ready", function () {
    $("html").addClass("rsgopro-document-ready"), 0 < $(".js-header-fly").length && setTimeout(function () {
        $(".js-header-fly").addClass("document-ready")
    }, 50), $(window).resize(BX.debounce(function () {
        $(".catalogmenu2 li ul.first").height() < $(".aroundjssorslider1").height() && 100 < screen.width && $(".aroundjssorslider1").css("min-height", "auto")
    }, 100)), BX.addCustomEvent("rs.location_change", function () {
        BX.reload()
    }), $(document).on("change", ".js-quantity", BX.debounce(function () {
        if (0 < $(this).closest(".js-detail").length) {
            var e = $(this).val();
            BX.onCustomEvent("rs_delivery_update", [0, e])
        }
    }, 250)), rsGoProLazyInit(), $(document).on("RSGoProOnOfferChange", function (e, o) {
        if (0 < $(o).find(".timers").length && "N" == $(o).find(".intimer").data("autoreuse")) {
            var t = new Date;
            t = Date.parse(t) / 1e3;
            $(o).find(".timer").data("datefrom");
            $(o).find(".intimer").data("dateto") - t < 0 && ($(o).find(".timers").css("display", "none"), $(o).removeClass("da2 qb"), $(o).find(".price").removeClass("new"))
        }
        BX.onCustomEvent("rs_delivery_update")
    }), $(document).on("click", ".click_protection", function (e) {
        return e.stopImmediatePropagation(), console.warn("Click protection"), !1
    }), $(document).on("click", "form .js-submit, form .submit", function () {
        return $(this).parents("form").find('input[type="submit"]').trigger("click"), !1
    }), $(document).on("submit", ".js-pay__form", function () {
        var e = $(this), o = parseInt(e.find(".js-add2basketpid").val()), t = e.parents(".js-element").data("detail");
        if (0 < o) {
            BX.onCustomEvent("rs.gopro.before.add2basket", [{elementId: o}]);
            t = t + "?" + $(this).serialize() + "&AJAX_CALL=Y&" + rsGoProActionVariableName + "=add2basket";
            RSGoPro_Area2Darken(e), RSGoPro_Area2Darken($("#header").find(".basketinhead")), $.getJSON(t, {}, function (e) {
                "OK" == e.TYPE ? (RSGoPro_INBASKET[o] = "Y", RSGoPro_BASKET.allSum_FORMATED = e.TOTAL_PRICE, RSGoPro_SetInBasket(), RSGoPro_PutJSon(e), BX.onCustomEvent("rs.gopro.after.add2basket", [{elementId: o}])) : "ERROR" == e.TYPE && e.MESSAGE ? alert(e.MESSAGE) : console.warn("add2basket - error responsed")
            }).fail(function (e) {
                console.warn("add2basket - can't load json")
            }).always(function () {
                RSGoPro_Area2Darken(e), RSGoPro_Area2Darken($("#header").find(".basketinhead"))
            })
        } else console.warn("add product to basket failed");
        return !1
    }), $(document).on("click", ".js-add2compare", function () {
        var e = $(this), o = parseInt(e.parents(".js-element").data("elementid")), t = "",
            a = e.parents(".js-element").data("detail");
        if (0 < o) {
            BX.onCustomEvent("rs.gopro.before.add2compare", [{elementId: o}]), RSGoPro_Area2Darken($(".js-add2compare")), t = "Y" == RSGoPro_COMPARE[o] ? "DELETE_FROM_COMPARE_LIST" : "ADD_TO_COMPARE_LIST";
            a = a + "?AJAX_CALL=Y&" + rsGoProActionVariableName + "=" + t + "&" + rsGoProProductIdVariableName + "=" + o;
            $.getJSON(a, {}, function (e) {
                "OK" == e.TYPE ? (RSGoPro_PutJSon(e), "DELETE_FROM_COMPARE_LIST" == t ? delete RSGoPro_COMPARE[o] : RSGoPro_COMPARE[o] = "Y", BX.onCustomEvent("rs.gopro.after.add2compare", [{elementId: o}])) : console.warn("compare - error responsed")
            }).fail(function (e) {
                console.warn("compare - fail request")
            }).always(function () {
                RSGoPro_Area2Darken($(".js-add2compare")), RSGoPro_SetCompared()
            })
        }
        return !1
    }), $(document).on("click", ".js-add2favorite", function () {
        var e = $(this), o = parseInt(e.parents(".js-element").data("elementid")),
            t = e.parents(".js-element").data("detail");
        if (0 < o) {
            BX.onCustomEvent("rs.gopro.before.add2favorite", [{elementId: o}]), RSGoPro_Area2Darken($(".js-add2favorite"));
            t = t + "?AJAX_CALL=Y&" + rsGoProActionVariableName + "=add2favorite&" + rsGoProProductIdVariableName + "=" + o;
            $.getJSON(t, {}, function (e) {
                "OK" == e.TYPE ? (RSGoPro_PutJSon(e), "Y" == RSGoPro_FAVORITE[o] ? delete RSGoPro_FAVORITE[o] : RSGoPro_FAVORITE[o] = "Y", BX.onCustomEvent("rs.gopro.after.add2favorite", [{elementId: o}])) : console.warn("favorite - error responsed")
            }).fail(function (e) {
                console.warn("favorite - fail request")
            }).always(function () {
                RSGoPro_Area2Darken($(".js-add2favorite")), RSGoPro_SetFavorite()
            })
        }
        return !1
    }), $(document).on("click", ".js-minus", function () {
        var e = $(this), o = e.parent().find(".js-quantity"),
            t = parseFloat(e.parent().find(".js-quantity").data("ratio")), a = t.toString().split(".", 2)[1], n = 0,
            r = parseFloat(o.val());
        return void 0 !== a && (n = a.length), t < r && o.val((r - t).toFixed(n)), o.trigger("change"), !1
    }), $(document).on("click", ".js-plus", function () {
        var e = $(this).parent().find(".js-quantity"), o = parseFloat(e.data("ratio")),
            t = o.toString().split(".", 2)[1], a = 0, n = parseFloat(e.val());
        return void 0 !== t && (a = t.length), e.val((n + o).toFixed(a)), e.trigger("change"), !1
    }), $(document).on("blur", ".js-quantity", function () {
        var e = $(this), o = parseFloat(e.data("ratio")), t = o.toString().split(".", 2)[1], a = 0;
        void 0 !== t && (a = t.length);
        var n = parseFloat(e.val());
        0 < n ? e.val((o * Math.floor(n / o)).toFixed(a)) : e.val(o)
    }), rsGoPro.options.owl.base = {
        autoHeight: !1,
        nav: !0,
        items: 1,
        dots: !1,
        dotsData: !1,
        margin: 20,
        responsive: {},
        loop: !0,
        onInitialized: function () {
            this.$element.addClass("owl-carousel"), this.$element.closest(".rs-gopro-popup").length && $.fancybox.update()
        }
    }, $(".js-owl-slider").each(function () {
        $slider = $(this), $slider.owlCarousel($.extend({}, rsGoPro.options.owl.base))
    }), rsGoPro.options.fancybox.popup = {}, rsGoPro.options.fancybox.bigPopup = {}, rsGoPro.options.fancybox.base = {
        infobar: !1,
        buttons: !1,
        slideShow: !1,
        fullScreen: !1,
        thumbs: !1,
        closeBtn: !1,
        closeTpl: '<a title="Close" data-fancybox-close class="fancybox-close" href="javascript:;"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-close-button"></use></svg></a>',
        ajax: {settings: {data: {"x-fancybox": "y"}}},
        touch: !1,
        keyboard: !0,
        beforeLoad: function () {
            BX.onCustomEvent("rs.gopro.fancybox.beforeLoad", [this]), RSGoPro_HideAllPopup()
        },
        afterLoad: function () {
            var e, o;
            BX.onCustomEvent("rs.gopro.fancybox.afterLoad", [this]);
            var t = this.opts.$orig.attr("title") || this.opts.$orig.text();
            if (t && this.$slide.children("div").prepend('<div class="fancybox-custom-title"><span>' + t + "</span></div>"), this.opts.$orig && this.opts.$orig.data("insertdata")) for (o in e = this.opts.$orig.data("insertdata")) this.$slide.find('[name="' + o + '"]').val(e[o]);
            setTimeout(function () {
                RSGoPro_InitMaskPhone()
            }, 75)
        }
    }, rsGoPro.options.fancybox.popup = $.extend({}, rsGoPro.options.fancybox.base), rsGoPro.options.fancybox.popup.baseClass = "rs-gopro-popup", $(".fancyajax:not(.big)").on("click touchstart", function (e) {
    }).data({type: "ajax"}).fancybox(rsGoPro.options.fancybox.popup), rsGoPro.options.fancybox.bigPopup = $.extend({}, rsGoPro.options.fancybox.base), rsGoPro.options.fancybox.bigPopup.baseClass = "rs-gopro-popup", $(".fancyajax.big").on("click touchstart", function (e) {
    }).data({type: "ajax"}).fancybox(rsGoPro.options.fancybox.bigPopup), RSGoPro_InitMaskPhone(), $(document).on("focus blur", ".dropdown-block .bx-ui-sls-fake", function () {
        $(this).parents(".dropdown-block").toggleClass("focus")
    }), $(document).on("click", ".js-element .js-product__unsubscribe", function (e) {
        e.preventDefault();
        var o = $(this), t = $(this).closest(".js-element"), a = t.data("elementid");
        if (0 < parseInt(a)) {
            BX.onCustomEvent("rs.gopro.before.unsubscribe", [{elementId: a}]);
            var n = {
                type: "POST",
                data: {
                    sessid: BX.bitrix_sessid(),
                    deleteSubscribe: "Y",
                    itemId: a,
                    listSubscribeId: 0 < o.data("subscribe-id").length ? BX.parseJSON(o.data("subscribe-id")) : []
                },
                url: "/bitrix/components/bitrix/catalog.product.subscribe.list/ajax.php",
                success: function (e) {
                    (e = BX.parseJSON(e)).success && (t.remove(), BX.onCustomEvent("rs.gopro.after.unsubscribe", [{elementId: a}]))
                },
                error: function () {
                    console.error("deleteSubscribe - error responsed?")
                },
                complete: function () {
                    RSGoPro_Area2Darken(t, "animashka")
                }
            };
            RSGoPro_Area2Darken(t, "animashka"), $.ajax(n)
        } else console.warn("Product ID undefined");
        return !1
    }), $(document).on("focus blur", ".js-pseudo-focus-blur-input", function () {
        $(this).parents(".js-pseudo-focus-blur").toggleClass("js-pseudo-focus")
    }), $(document).on("click", ".js-easy-scroll", function (e) {
        var o = $(this), t = o.attr("href"), a = o.data("es-offset") ? o.data("es-offset") : 0;
        return 0 != $(t).length && (0 < $('a[href="' + t + '"]').length && $('a[href="' + t + '"]').tab("show"), setTimeout(function () {
            $("html:not(:animated), body:not(:animated)").animate({scrollTop: $(t).offset().top + a}, {
                duration: 500,
                easing: "swing"
            })
        }, 50)), !1
    })
}), void 0 !== window.frameCacheVars ? BX.addCustomEvent("onFrameDataReceived", function (e) {
    $(document).trigger("rsGoPro.document.ready")
}) : BX.ready(function () {
    $(document).trigger("rsGoPro.document.ready")
});