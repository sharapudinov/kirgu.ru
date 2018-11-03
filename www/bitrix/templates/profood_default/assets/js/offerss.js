var RSGoPro_OffersExt_timeout_id = 0, RSGoPro_ajaxTimeout = 0, RSGoPro_ajaxTimeoutTime = 1e3;

function RSGoPro_OffersExt_ChangeHTML(e) {
    var s = e.data("elementid");
    if (RSGoPro_OFFERS[s]) {
        var o = new Object;
        e.find(".js-attributes__option.selected").each(function (e) {
            var s = $(this), r = s.parents(".js-attributes__prop").data("code"), t = s.data("value");
            o[r] = t
        });
        var r = 0, t = !0;
        for (offerID in RSGoPro_OFFERS[s].OFFERS) {
            for (pCode in t = !0, o) if (o[pCode] != RSGoPro_OFFERS[s].OFFERS[offerID].PROPERTIES[pCode]) {
                t = !1;
                break
            }
            if (t) {
                r = offerID;
                break
            }
        }
        if (r < 1) return void console.error("Right offer not found. OfferID not found. Product error.");
        BX.onCustomEvent("rs.gopro.before.offerChange", [{
            product: e,
            elementId: s,
            offerId: r
        }]), $article = e.find(".js-article"), 0 < $article.length && (RSGoPro_OFFERS[s].OFFERS[r].ARTICLE ? $article.find(".js-article__value").html(RSGoPro_OFFERS[s].OFFERS[r].ARTICLE).parent(".js-article").removeClass("js-article-invisible") : e.find(".js-article").data("prodarticle") ? $article.find(".js-article__value").html(e.find(".js-article").data("prodarticle")).parent(".js-article").removeClass("js-article-invisible") : $article.find(".js-article__value").parent(".js-article").addClass("js-article-invisible")), 0 < e.find(".js-quantity").length && RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_RATIO && (e.find(".js-quantity").data("ratio", RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_RATIO), e.find(".js-quantity").val(e.find(".js-quantity").data("ratio"))), 0 < e.find(".js-measurename").length && RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_NAME && e.find(".js-measurename").html(RSGoPro_OFFERS[s].OFFERS[r].CATALOG_MEASURE_NAME);
        var i = e.find(".js-prices"), a = i.data("page"), _ = i.data("view"), d = i.data("maxshow"),
            n = (i.data("showmore"), i.data("usealone")), S = 0, l = 0;
        if (RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX) RSGoPro_SetPriceMatrix(e, RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX); else if (RSGoPro_OFFERS[s].OFFERS[r].PRICES) {
            var R = null, p = RSGoPro_OFFERS[s].OFFERS[r].PRICES, c = Object.keys(p).length;
            for (var E in i.removeClass("product-multiple product-alone"), i.find(".js-prices__price").addClass("c-prices__hide c-prices__empty"), i.find(".js-prices__more").addClass("c-prices__hide"), p) if (!((R = i.find(".js-prices__price-code_" + E)).length < 1)) {
                if (R.removeClass("c-prices__empty"), d <= S && "list" == a && "line" == _) break;
                l < d && R.removeClass("c-prices__hide"), 0 < i.find(".js-prices_pdv_" + E).length && (i.find(".js-prices_pdv_" + E).html(p[E].PRINT_DISCOUNT_VALUE), 0 < parseInt(p[E].DISCOUNT_DIFF) && i.find(".js-prices_pdv_" + E)), 0 < i.find(".js-prices_pd_" + E).length && (0 < parseInt(p[E].DISCOUNT_DIFF) || parseInt(p[E].DISCOUNT_DIFF_PERCENT) ? 0 < parseInt(p[E].DISCOUNT_DIFF) ? (i.find(".js-prices_pd_" + E + "_hide").removeClass("c-prices__hide"), i.find(".js-prices_pd_" + E).removeClass("c-prices__hide").html(p[E].PRINT_DISCOUNT)) : (i.find(".js-prices_pd_" + E + "_hide").removeClass("c-prices__hide"), i.find(".js-prices_pd_" + E).removeClass("c-prices__hide").html(p[E].DISCOUNT_DIFF_PERCENT)) : i.find(".js-prices_pd_" + E + "_hide").addClass("c-prices__hide")), 0 < i.find(".js-prices_pv_" + E).length && (0 < parseInt(p[E].DISCOUNT_DIFF) ? (i.find(".js-prices_pv_" + E + "_hide").removeClass("c-prices__hide"), i.find(".js-prices_pv_" + E).removeClass("c-prices__hide").html(p[E].PRINT_VALUE)) : i.find(".js-prices_pv_" + E + "_hide").addClass("c-prices__hide")), 0 < i.find(".js-prices_ddp_" + E).length && (0 < p[E].DISCOUNT_DIFF_PERCENT ? (i.find(".js-prices_ddp_" + E + "_hide").removeClass("c-prices__hide"), i.find(".js-prices_ddp_" + E).html(p[E].DISCOUNT_DIFF_PERCENT)) : i.find(".js-prices_ddp_" + E + "_hide").addClass("c-prices__hide")), l++, S++
            }
            i.data("priceCountShowed", l), i.data("priceCount", S)
        }
        if (l = i.data("priceCountShowed"), S = i.data("priceCount"), l < 2 && "Y" == n) i.addClass("product-alone"), i.removeClass("product-multiple"); else if (i.addClass("product-multiple"), i.removeClass("product-alone"), d < c && 0 < parseInt(c - d)) {
            var f = parseInt(c - d);
            i.find(".js-prices__more").removeClass("c-prices__hide").find(".js-prices__more-count").html(f)
        }
        var O = RSGoPro_OFFERS[s].OFFERS[r].DISPLAY_PROPERTIES;
        for (var F in O) e.find(".js-changelable-props-val__" + F).html(O[F].DISPLAY_VALUE);
        if (e.removeClass("qb da2"), e.find(".timers .timer").hide(), (RSGoPro_OFFERS[s].ELEMENT.QUICKBUY || RSGoPro_OFFERS[s].OFFERS[r].QUICKBUY) && (e.addClass("qb"), 0 < e.find(".timers .qb.js-timer_id" + s).length ? e.find(".timers .qb.js-timer_id" + s).css("display", "inline-block") : 0 < e.find(".timers .qb.js-timer_id" + r).length && e.find(".timers .qb.js-timer_id" + r).css("display", "inline-block")), (RSGoPro_OFFERS[s].ELEMENT.DAYSARTICLE2 || RSGoPro_OFFERS[s].OFFERS[r].DAYSARTICLE2) && (e.removeClass("qb").addClass("da2"), 0 < e.find(".timers .da2.js-timer_id" + s).length ? (e.find(".timers .timer").hide(), e.find(".timers .da2.js-timer_id" + s).css("display", "inline-block")) : 0 < e.find(".timers .da2.js-timer_id" + r).length && (e.find(".timers .timer").hide(), e.find(".timers .da2.js-timer_id" + r).css("display", "inline-block"))), e.find(".js-add2basketpid").val(r), e.find(".js-buy1click").data("insertdata", {RS_ORDER_IDS: r}), RSGoPro_OFFERS[s].OFFERS[r].CAN_BUY ? e.find(".js-pay__form").removeClass("cantbuy") : e.find(".js-pay__form").addClass("cantbuy"), e.find(".js-product-subscribe").attr("data-item", r), e.find(".js-product-subscribe").data("item", r), 0 < e.find(".js-stores").length && 0 < r) if (RSGoPro_STOCK[s]) {
            for (storeID in RSGoPro_STOCK[s].JS.SKU[r]) {
                var P = RSGoPro_STOCK[s].JS.SKU[r][storeID],
                    C = $("#popupstores_" + s).find(".js-stores__store" + storeID);
                1 == RSGoPro_STOCK[s].USE_MIN_AMOUNT ? P < 1 ? C.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_EMPTY) : P < RSGoPro_STOCK[s].MIN_AMOUNT ? (console.log("wonk 2"), console.log(RSGoPro_STOCK[s].MESSAGE_LOW), C.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_LOW)) : C.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_ISSET) : C.find(".js-stores__value").html(P), 0 == RSGoPro_STOCK[s].SHOW_EMPTY_STORE && P < 1 ? C.hide() : C.show()
            }
            if (RSGoPro_STOCK[s].QUANTITY[s]) {
                P = parseInt(RSGoPro_STOCK[s].QUANTITY[r]);
                1 == RSGoPro_STOCK[s].USE_MIN_AMOUNT ? P < 1 ? e.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_EMPTY) : P < RSGoPro_STOCK[s].MIN_AMOUNT ? e.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_LOW) : e.find(".js-stores__value").html(RSGoPro_STOCK[s].MESSAGE_ISSET) : P < 1 ? e.find(".js-stores__value").html("0") : e.find(".js-stores__value").html(P)
            }
        } else console.warn("OffersExt_ChangeHTML -> store not found");
        RSGoPro_SetInBasket(), $(document).trigger("RSGoProOnOfferChange", [e]), BX.onCustomEvent("rs.gopro.after.offerChange", [{
            product: e,
            elementId: s,
            offerId: r
        }])
    }
}

function RSGoPro_OffersExt_PropChanged(e) {
    var s = e.parents(".js-element").data("elementid"), r = e.parents(".js-attributes__prop").data("code"),
        t = e.data("value");
    if (RSGoPro_OFFERS[s] && !e.hasClass("disabled")) {
        e.parents(".js-attributes__prop").removeClass("open").addClass("close"), e.parents(".js-attributes__prop").find(".js-attributes__option").removeClass("selected"), e.addClass("selected"), e.parents(".js-attributes__prop").find(".js-attributes__set-value-text").html(t), e.parents(".js-attributes__prop").hasClass("js-pic") && e.parents(".js-attributes__prop").find(".js-attributes__set-value-pic").css("backgroundImage", "url('" + e.data("value-pic") + "')");
        var o = 0, i = "", a = "", _ = new Object;
        for (index in RSGoPro_OFFERS[s].SORT_PROPS) if (_[a = RSGoPro_OFFERS[s].SORT_PROPS[index]] = e.parents(".js-element").find(".js-attributes__code__" + a).find(".js-attributes__option.selected").data("value"), a == r) {
            o = parseInt(index) + 1;
            i = !!RSGoPro_OFFERS[s].SORT_PROPS[o] && RSGoPro_OFFERS[s].SORT_PROPS[o];
            break
        }
        if (i) {
            var d = !0, n = new Array;
            for (offerID in RSGoPro_OFFERS[s].OFFERS) {
                for (pCode1 in d = !0, _) _[pCode1] != RSGoPro_OFFERS[s].OFFERS[offerID].PROPERTIES[pCode1] && (d = !1);
                d && n.push(RSGoPro_OFFERS[s].OFFERS[offerID].PROPERTIES[i])
            }
            e.parents(".js-element").find(".js-attributes__code__" + i).find(".js-attributes__option").each(function (e) {
                var s = $(this), r = !0;
                for (inden in n) if (s.data("value") == n[inden]) {
                    r = !1;
                    break
                }
                s.addClass("disabled"), r || s.removeClass("disabled")
            }),RSGoPro_OffersExt_PropChanged(e.parents(".js-element").find(".js-attributes__code__" + i).find(".js-attributes__option.selected").hasClass("disabled") ? e.parents(".js-element").find(".js-attributes__code__" + i).find(".js-attributes__option:not(.disabled):first") : e.parents(".js-element").find(".js-attributes__code__" + i).find(".js-attributes__option.selected"))
        } else RSGoPro_OffersExt_ChangeHTML(e.parents(".js-element"))
    }
}
function SelectOfferByName(e){debugger
    s=e.parents(".js-element").data("elementid");
    e.parents(".js-attributes__prop").removeClass("open").addClass("close");
        e.parents(".js-attributes__prop").find(".js-attributes__option").removeClass("selected");
        e.addClass("selected");
    if (RSGoPro_OFFERS[s]) {
        RSGoPro_OffersExt_PropChanged(e.parents(".js-element").find(".js-attributes__code__" + i).find(".js-attributes__option.selected"))
    }
    else RSGoPro_OffersExt_ChangeHTML(e.parents(".js-element"))

};

function RSGoPro_SetPrice(e) {
    var s = e.data("elementid"), r = e.find(".js-add2basketpid").val();
    RSGoPro_OFFERS[s] && (RSGoPro_OFFERS[s].OFFERS[r] && RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX && RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX ? RSGoPro_SetPriceMatrix(e, RSGoPro_OFFERS[s].OFFERS[r].PRICE_MATRIX) : RSGoPro_OFFERS[s].ELEMENT.PRICE_MATRIX && RSGoPro_SetPriceMatrix(e, RSGoPro_OFFERS[s].ELEMENT.PRICE_MATRIX))
}

function RSGoPro_SetPriceMatrix(e, s) {
    var r = e.find(".js-quantity").val(), t = e.find(".js-prices"), o = null, i = null, a = null, _ = t.data("page"),
        d = t.data("view"), n = t.data("maxshow"), S = (t.data("showmore"), t.data("usealone")), l = 0, R = 0;
    for (var p in t.removeClass("product-multiple product-alone"), "list" != _ && "line" != d && t.find(".js-prices__price").addClass("c-prices__hide c-prices__empty"), t.find(".js-prices__more").addClass("c-prices__hide"), s.ROWS) {
        if ((0 == s.ROWS[p].QUANTITY_FROM || s.ROWS[p].QUANTITY_FROM <= r) && (0 == s.ROWS[p].QUANTITY_TO || s.ROWS[p].QUANTITY_TO >= r)) {
            for (var c in i = s.COLS, a = Object.keys(i).length, i) if (s.MATRIX[c][p]) {
                if (PRICE_CODE = s.COLS[c].NAME, (o = t.find(".js-prices__price-code_" + PRICE_CODE)).length < 1) continue;
                if (o.removeClass("c-prices__empty"), n <= l && "list" == _ && "line" == d) break;
                R < n && o.removeClass("c-prices__hide"), e.find(".js-prices_pdv_" + PRICE_CODE) && (e.find(".js-prices_pdv_" + PRICE_CODE).html(s.MATRIX[c][p].PRINT_DISCOUNT_VALUE), 0 < parseInt(s.MATRIX[c][p].DISCOUNT_DIFF) && e.find(".js-prices_pdv_" + PRICE_CODE)), e.find(".js-prices_pd_" + PRICE_CODE) && (0 < parseInt(s.MATRIX[c][p].DISCOUNT_DIFF) ? e.find(".js-prices_pd_" + PRICE_CODE).removeClass("c-prices__hide").html(s.MATRIX[c][p].PRINT_DISCOUNT_DIFF) : e.find(".js-prices_pd_" + PRICE_CODE).addClass("c-prices__hide")), e.find(".js-prices_pv_" + PRICE_CODE) && (0 < parseInt(s.MATRIX[c][p].DISCOUNT_DIFF) ? e.find(".js-prices_pv_" + PRICE_CODE).removeClass("c-prices__hide").html(s.MATRIX[c][p].PRINT_VALUE) : e.find(".js-prices_pv_" + PRICE_CODE).addClass("c-prices__hide")), R++, l++
            }
            break
        }
        t.data("priceCountShowed", R), t.data("priceCount", l)
    }
    if (R < 2 && "Y" == S) t.addClass("product-alone"); else if (t.addClass("product-multiple"), n < a && 0 < parseInt(a - n)) {
        var E = parseInt(a - n);
        t.find(".js-prices__more").removeClass("c-prices__hide").find(".js-prices__more-count").html(E)
    }
}

$(document).on("click", ".js-attributes__option", function (e) {debugger
    e.stopPropagation(), clearTimeout(RSGoPro_OffersExt_timeout_id);
    var s = $(this), r = s.closest(".js-element"), t = r.find(".js-element__shadow"), o = r.data("detail");
    if (!s.hasClass("disabled")) {
        var i = r.data("elementid");
        if (0 < i) {
            s.parents(".js-attributes__prop").data("code"), s.data("value");
            if (RSGoPro_OFFERS[i])
                if(!RSGoPro_OFFERS[i].SELECT_OFFER_BY_NAME)
                    RSGoPro_OffersExt_PropChanged(s);
                else SelectOfferByName(s);
            else {
                RSGoPro_Area2Darken(t, "animashka");
                var a = o + "?AJAX_CALL=Y&" + rsGoProActionVariableName + "=get_element_json&" + rsGoProProductIdVariableName + "=" + i;
                $.getJSON(a, {}, function (e) {
                    RSGoPro_OFFERS[i] = e;
                    if (!e.SELECT_OFFER_BY_NAME)
                        RSGoPro_OffersExt_PropChanged(s)
                    else
                        SelectOfferByName(s);
                    RSGoPro_Area2Darken(t);
                }).fail(function (e) {
                    console.warn("Get element JSON -> fail request"), RSGoPro_Area2Darken(t)
                })
            }
        } else console.warn("Get element JSON -> element_id is empty")
    }
    return !1
}), $(document).on("change", ".js-element .js-quantity.js-use_count", function () {
    clearTimeout(RSGoPro_OffersExt_timeout_id), clearTimeout(RSGoPro_ajaxTimeout);
    var r = $(this).closest(".js-element"), e = r.data("detail"), t = r.data("elementid");
    if (0 < t) if (RSGoPro_OFFERS[t]) {
        var s = r.find(".js-add2basketpid").val();
        RSGoPro_OFFERS[t].OFFERS[s] && RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX ? RSGoPro_SetPriceMatrix(r, RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX) : RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX && RSGoPro_SetPriceMatrix(r, RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX), $(document).trigger("RSGoProOnChangeQuantity", [r])
    } else {
        var o = e + "?AJAX_CALL=Y&" + rsGoProActionVariableName + "=get_element_json&" + rsGoProProductIdVariableName + "=" + t;
        RSGoPro_ajaxTimeout = setTimeout(function () {
            RSGoPro_Area2Darken(r, "animashka"), $.ajax({
                type: "POST", url: o, dataType: "json", success: function (e) {
                    RSGoPro_OFFERS[t] = e;
                    var s = r.find(".js-add2basketpid").val();
                    RSGoPro_OFFERS[t] && (RSGoPro_OFFERS[t].OFFERS[s] && RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX ? RSGoPro_SetPriceMatrix(r, RSGoPro_OFFERS[t].OFFERS[s].PRICE_MATRIX) : RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX && RSGoPro_SetPriceMatrix(r, RSGoPro_OFFERS[t].ELEMENT.PRICE_MATRIX))
                }, error: function () {
                    console.warn("Get element JSON -> fail request")
                }, complete: function () {
                    RSGoPro_Area2Darken(r), $(document).trigger("RSGoProOnChangeQuantity", [r])
                }
            })
        }, RSGoPro_ajaxTimeoutTime)
    } else console.warn("Get element JSON -> element_id is empty");
    return !1
}), $(document).on("click", ".js-attributes__curent-value", function (e) {debugger
    var s = $(this);
    return $(".js-attributes__prop.open:not(.js-attributes__code__" + s.parents(".js-attributes__prop").data("code") + ")").removeClass("open").addClass("close"), s.parents(".js-attributes__prop").hasClass("open") ? s.parents(".js-attributes__prop").removeClass("open").addClass("close") : s.parents(".js-attributes__prop").removeClass("close").addClass("open"), !1
}), $(document).on("click", function (e) {
    0 < $(e.target).parents(".js-attributes__prop").length && !$(e.target).parents(".js-attributes__prop").hasClass("js-pic") || $(".js-attributes__prop").removeClass("open").addClass("close")
});