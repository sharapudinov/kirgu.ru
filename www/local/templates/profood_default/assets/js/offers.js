var RSGoPro_OffersExt_timeout_id = 0,
    RSGoPro_ajaxTimeout = 0,
    RSGoPro_ajaxTimeoutTime = 1000;

function RSGoPro_OffersExt_ChangeHTML($product,$optionObj=null) {
    var element_id = $product.data('elementid');
    if (RSGoPro_OFFERS[element_id]) {
        if(!RSGoPro_OFFERS[element_id].SELECT_OFFER_BY_NAME) {

            // get all selected values
            var arrFullChosed = new Object();
            $product.find('.js-attributes__option.selected').each(function (index1) {
                var $optionObj = $(this);
                var code = $optionObj.parents('.js-attributes__prop').data('code');
                var value = $optionObj.data('value');
                arrFullChosed[code] = value;
            });
            // get offerID (key=ID)
            var finedOfferID = 0;
            var all_prop_true2 = true;
            for (offerID in RSGoPro_OFFERS[element_id].OFFERS) {
                all_prop_true2 = true;
                for (pCode in arrFullChosed) {
                    if (arrFullChosed[pCode] != RSGoPro_OFFERS[element_id].OFFERS[offerID].PROPERTIES[pCode]) {
                        all_prop_true2 = false;
                        break;
                    }
                }
                if (all_prop_true2) {
                    finedOfferID = offerID;
                    break;
                }
            }
        } else {
            finedOfferID=$optionObj.data('value');
        }
        if (finedOfferID < 1) {
            console.error('Right offer not found. OfferID not found. Product error.');
            return;
        }

	// article
	$article = $product.find('.js-article');
	if ($article.length > 0) {
		if (RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].ARTICLE) {
			$article.find('.js-article__value').html(RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].ARTICLE).parent('.js-article').removeClass('js-article-invisible');
		} else if ($product.find('.js-article').data('prodarticle') ) {
			$article.find('.js-article__value').html($product.find('.js-article').data('prodarticle')).parent('.js-article').removeClass('js-article-invisible');
		} else {
			$article.find('.js-article__value').parent('.js-article').addClass('js-article-invisible');
		}
	}

	// set ratio
	if ($product.find('.js-quantity').length > 0 && RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].CATALOG_MEASURE_RATIO) {
		$product.find('.js-quantity').data('ratio',RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].CATALOG_MEASURE_RATIO);
		$product.find('.js-quantity').val($product.find('.js-quantity').data('ratio'));
	}
	if ($product.find('.js-measurename').length > 0 && RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].CATALOG_MEASURE_NAME) {
		$product.find('.js-measurename').html(RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].CATALOG_MEASURE_NAME);
	}

		// prices
    if (!!RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICE_MATRIX) {
			RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICE_MATRIX);
    } else if (RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICES) {
			var $prices = $product.find('.js-prices'),
				$curPrice = null,
				PRICES = RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICES,
				basePricesCount = Object.keys(PRICES).length,
				params = {
					'PAGE': $prices.data('page'),
					'VIEW': $prices.data('view'),
					'MAX_SHOW': $prices.data('maxshow'),
					'SHOW_MORE': $prices.data('showmore'),
					'USE_ALONE': $prices.data('usealone'),
				},
				priceCount = 0,
				priceCountShowed = 0;

			$prices.removeClass('product-multiple product-alone');debugger
			$prices.find('.js-prices__price').addClass('c-prices__hide c-prices__empty');
			$prices.find('.js-prices__more').addClass('c-prices__hide');

			for (var PRICE_CODE in PRICES) {
				$curPrice = $prices.find('.js-prices__price-code_' + PRICE_CODE);

				if ($curPrice.length < 1) {
					continue;
				}

				$curPrice.removeClass('c-prices__empty');

				if (priceCount >= params.MAX_SHOW && params.PAGE == 'list' && params.VIEW == 'line') {
					break;
				}

				if (priceCountShowed < params.MAX_SHOW) {
					$curPrice.removeClass('c-prices__hide');
				}

				if ($prices.find('.js-prices_pdv_' + PRICE_CODE).length > 0) {
					$prices.find('.js-prices_pdv_' + PRICE_CODE).html(PRICES[PRICE_CODE].PRINT_DISCOUNT_VALUE);
					if (parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF) > 0) {
						$prices.find('.js-prices_pdv_' + PRICE_CODE);
					}
				}

				if ($prices.find('.js-prices_pd_' + PRICE_CODE).length > 0) {
					if (parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF) > 0 || parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF_PERCENT)) {
						if (parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF) > 0) {
							$prices.find('.js-prices_pd_' + PRICE_CODE + '_hide').removeClass('c-prices__hide');
							$prices.find('.js-prices_pd_' + PRICE_CODE).removeClass('c-prices__hide').html(PRICES[PRICE_CODE].PRINT_DISCOUNT);
						} else {
							$prices.find('.js-prices_pd_' + PRICE_CODE + '_hide').removeClass('c-prices__hide');
							$prices.find('.js-prices_pd_' + PRICE_CODE).removeClass('c-prices__hide').html(PRICES[PRICE_CODE].DISCOUNT_DIFF_PERCENT);
						}
					} else {
						$prices.find('.js-prices_pd_' + PRICE_CODE + '_hide').addClass('c-prices__hide');
					}
				}

				if ($prices.find('.js-prices_pv_' + PRICE_CODE).length > 0) {
					if (parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF) > 0) {
						$prices.find('.js-prices_pv_' + PRICE_CODE + '_hide').removeClass('c-prices__hide');
						$prices.find('.js-prices_pv_' + PRICE_CODE).removeClass('c-prices__hide').html(PRICES[PRICE_CODE].PRINT_VALUE);
					} else {
						$prices.find('.js-prices_pv_' + PRICE_CODE + '_hide').addClass('c-prices__hide');
					}
				}

				if ($prices.find('.js-prices_ddp_' + PRICE_CODE).length > 0) {
					if (PRICES[PRICE_CODE].DISCOUNT_DIFF_PERCENT > 0) {
						$prices.find('.js-prices_ddp_' + PRICE_CODE + '_hide').removeClass('c-prices__hide');
						$prices.find('.js-prices_ddp_' + PRICE_CODE).html(PRICES[PRICE_CODE].DISCOUNT_DIFF_PERCENT);
					} else {
						$prices.find('.js-prices_ddp_' + PRICE_CODE + '_hide').addClass('c-prices__hide');
					}
				}

				priceCountShowed++;
				priceCount++;
			}
		}

		if (priceCountShowed < 2 && params.USE_ALONE == 'Y') {
			$prices.addClass('product-alone');
		} else {
			$prices.addClass('product-multiple');
			if (basePricesCount > params.MAX_SHOW && parseInt(basePricesCount - params.MAX_SHOW) > 0) {
				var moreCount = parseInt(basePricesCount - params.MAX_SHOW);
				$prices.find('.js-prices__more').removeClass('c-prices__hide').find('.js-prices__more-count').html(moreCount);
			}
		}
		// /prices

		// changelable props
		var SKUProps = RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].DISPLAY_PROPERTIES;
		for (var SKUProp in SKUProps) {
      		$product.find('.js-changelable-props-val__' + SKUProp).html(SKUProps[SKUProp].DISPLAY_VALUE);
		}
		// /changelable props

		// daysarticle & quickbuy
		$product.removeClass('qb da2');
		$product.find('.timers .timer').hide();
		if (RSGoPro_OFFERS[element_id].ELEMENT.QUICKBUY || RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].QUICKBUY ) {
			$product.addClass('qb');
			if ($product.find('.timers .qb.js-timer_id'+element_id).length > 0) {
				$product.find('.timers .qb.js-timer_id'+element_id).css('display', 'inline-block');
			} else if ($product.find('.timers .qb.js-timer_id'+finedOfferID).length > 0) {
				$product.find('.timers .qb.js-timer_id'+finedOfferID).css('display', 'inline-block');
			}
		}
		if (RSGoPro_OFFERS[element_id].ELEMENT.DAYSARTICLE2 || RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].DAYSARTICLE2 ) {
			$product.removeClass('qb').addClass('da2');
			if ($product.find('.timers .da2.js-timer_id'+element_id).length > 0) {
				$product.find('.timers .timer').hide();
				$product.find('.timers .da2.js-timer_id'+element_id).css('display', 'inline-block');
			} else if ($product.find('.timers .da2.js-timer_id'+finedOfferID).length > 0) {
				$product.find('.timers .timer').hide();
				$product.find('.timers .da2.js-timer_id'+finedOfferID).css('display', 'inline-block');
			}
		}

		// change buy product id
		$product.find('.js-add2basketpid').val(finedOfferID);
		$product.find('.js-buy1click').data('insertdata', {RS_ORDER_IDS: finedOfferID});
		// /change buy product id

		// change can buy (canbuy)
		if (RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].CAN_BUY) {
			$product.find('.js-pay__form').removeClass('cantbuy');
		} else {
			$product.find('.js-pay__form').addClass('cantbuy');
		}
		// /change can buy (canbuy)

		// change product subscribe
		$product.find('.js-product-subscribe').attr('data-item', finedOfferID);
		$product.find('.js-product-subscribe').data('item', finedOfferID);
		// /change product subscribe

		// stores
		if ($product.find('.js-stores').length > 0 && finedOfferID > 0) {
			if (RSGoPro_STOCK[element_id]) {
				// change stores
				for (storeID in RSGoPro_STOCK[element_id].JS.SKU[finedOfferID]) {

					var stores = RSGoPro_STOCK[element_id].JS.SKU[finedOfferID],
						quantity = stores[storeID],
						$store = $('#popupstores_' + element_id).find('.js-stores__store' + storeID);

					if (RSGoPro_STOCK[element_id].USE_MIN_AMOUNT == true) {
						if (quantity < 1) {
							$store.find('.js-stores__value').html(RSGoPro_STOCK[element_id].MESSAGE_EMPTY);
						} else if (quantity < RSGoPro_STOCK[element_id].MIN_AMOUNT) {
							console.log('wonk 2');
							console.log(RSGoPro_STOCK[element_id].MESSAGE_LOW);
							$store.find('.js-stores__value').html(RSGoPro_STOCK[element_id].MESSAGE_LOW);
						} else {
							$store.find('.js-stores__value').html(RSGoPro_STOCK[element_id].MESSAGE_ISSET);
						}
					} else {
						$store.find('.js-stores__value').html(quantity);
					}
					if (RSGoPro_STOCK[element_id].SHOW_EMPTY_STORE == false && quantity < 1) {
						$store.hide();
					} else {
						$store.show();
					}
				}

				// change general
				if (RSGoPro_STOCK[element_id].QUANTITY[element_id]) {

					var quantity = parseInt( RSGoPro_STOCK[element_id].QUANTITY[finedOfferID] );
					if (RSGoPro_STOCK[element_id].USE_MIN_AMOUNT == true) {
						if (quantity < 1) {
							$product.find('.js-stores__value').html(RSGoPro_STOCK[element_id].MESSAGE_EMPTY);
						} else if (quantity < RSGoPro_STOCK[element_id].MIN_AMOUNT) {
							$product.find('.js-stores__value').html(RSGoPro_STOCK[element_id].MESSAGE_LOW);
						} else {
							$product.find('.js-stores__value').html(RSGoPro_STOCK[element_id].MESSAGE_ISSET);
						}

					} else {
						if (quantity < 1){
							$product.find('.js-stores__value').html('0');
						}  else{
							$product.find('.js-stores__value').html(quantity);
						}
					}
				}
			} else {
				console.warn( 'OffersExt_ChangeHTML -> store not found' );
			}
		}

		// set buttons "in basket" and "not in basket"
		RSGoPro_SetInBasket();

        // event
        $(document).trigger('RSGoProOnOfferChange', [$product]);

        BX.onCustomEvent("rs.gopro.after.offerChange", [{
            product: $product,
            elementId: element_id,
            offerId: finedOfferID
        }])

    }
}

function SelectOfferByName( $optionObj){
    var element_id=$optionObj.parents(".js-element").data("elementid");
    $optionObj.parents(".js-attributes__prop").removeClass("open").addClass("close");
    $optionObj.parents(".js-attributes__prop").find(".js-attributes__option").removeClass("selected");
    $optionObj.addClass("selected");
    $optionObj.parents('.js-attributes__prop').find('.js-attributes__curent-value span span').html($optionObj.html());
    RSGoPro_OffersExt_ChangeHTML($optionObj.parents(".js-element"),$optionObj)

};
function RSGoPro_OffersExt_PropChanged($optionObj) {
	var element_id = $optionObj.parents('.js-element').data('elementid'),
      CURRENT_PROP_CODE = $optionObj.parents('.js-attributes__prop').data('code'),
      value = $optionObj.data('value');

	if (RSGoPro_OFFERS[element_id] && !$optionObj.hasClass('disabled') ) {
		// change styles
		$optionObj.parents('.js-attributes__prop').removeClass('open').addClass('close');
		$optionObj.parents('.js-attributes__prop').find('.js-attributes__option').removeClass('selected');
		$optionObj.addClass('selected');

		// set current value
		$optionObj.parents('.js-attributes__prop').find('.js-attributes__set-value-text').html(value);
		if ($optionObj.parents('.js-attributes__prop').hasClass('js-pic')) {
			console.log($optionObj.data('value-pic'));
			$optionObj.parents('.js-attributes__prop').find('.js-attributes__set-value-pic').css('backgroundImage', "url('" + $optionObj.data('value-pic') + "')");
		}

		var next_index = 0,
			NEXT_PROP_CODE = '',
			PROP_CODE = '';

		// get current values
		var arCurrentValues = new Object();
		for (index in RSGoPro_OFFERS[element_id].SORT_PROPS) {
			PROP_CODE = RSGoPro_OFFERS[element_id].SORT_PROPS[index];
			arCurrentValues[PROP_CODE] = $optionObj.parents('.js-element').find('.js-attributes__code__'+PROP_CODE).find('.js-attributes__option.selected').data('value');
			// save next prop_code
			if (PROP_CODE == CURRENT_PROP_CODE) {
				var next_index = parseInt(index) + 1;
				if (RSGoPro_OFFERS[element_id].SORT_PROPS[next_index])
					NEXT_PROP_CODE = RSGoPro_OFFERS[element_id].SORT_PROPS[next_index];
				else
					NEXT_PROP_CODE = false;
				break;
			}
		}

		// get enabled values for next property
		if (NEXT_PROP_CODE) {
			var allPropTrue1 = true;
			var arNextEnabledProps = new Array();
			for (offerID in RSGoPro_OFFERS[element_id].OFFERS) {
				allPropTrue1 = true;
				for (pCode1 in arCurrentValues) {
					if (arCurrentValues[pCode1] != RSGoPro_OFFERS[element_id].OFFERS[offerID].PROPERTIES[pCode1] ) {
						allPropTrue1 = false;
					}
				}
				if (allPropTrue1) {
					arNextEnabledProps.push( RSGoPro_OFFERS[element_id].OFFERS[offerID].PROPERTIES[NEXT_PROP_CODE] );
				}
			}

			// disable and enable values for NEXT_PROP_CODE
			$optionObj.parents('.js-element').find('.js-attributes__code__'+NEXT_PROP_CODE).find('.js-attributes__option').each(function(i){
				var $option = $(this);
				var emptyInEnabled = true;
				for(inden in arNextEnabledProps) {
					if ($option.data('value') == arNextEnabledProps[inden] ) {
						emptyInEnabled = false;
						break;
					}
				}
				$option.addClass('disabled');
				if(!emptyInEnabled)
					$option.removeClass('disabled');
			});

			// call itself
			var nextOptionObj;
			if(!$optionObj.parents('.js-element').find('.js-attributes__code__'+NEXT_PROP_CODE).find('.js-attributes__option.selected').hasClass('disabled')) {
				nextOptionObj = $optionObj.parents('.js-element').find('.js-attributes__code__'+NEXT_PROP_CODE).find('.js-attributes__option.selected');
			} else {
				nextOptionObj = $optionObj.parents('.js-element').find('.js-attributes__code__'+NEXT_PROP_CODE).find('.js-attributes__option:not(.disabled):first');
			}
			RSGoPro_OffersExt_PropChanged(nextOptionObj);
		} else {
			RSGoPro_OffersExt_ChangeHTML( $optionObj.parents('.js-element') );
		}
	}
}

function RSGoPro_SetPrice($product) {
  var element_id = $product.data('elementid'),
      iOfferId = $product.find('.js-add2basketpid').val();

  if (RSGoPro_OFFERS[element_id]) {
		if (
				!!RSGoPro_OFFERS[element_id].OFFERS[iOfferId] &&
				!!RSGoPro_OFFERS[element_id].OFFERS[iOfferId].PRICE_MATRIX &&
				!!RSGoPro_OFFERS[element_id].OFFERS[iOfferId].PRICE_MATRIX
		) {
			RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].OFFERS[iOfferId].PRICE_MATRIX);
		} else if (!!RSGoPro_OFFERS[element_id].ELEMENT.PRICE_MATRIX) {
			RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].ELEMENT.PRICE_MATRIX);
		}
  }
}

function RSGoPro_SetPriceMatrix($product, matrix) {
	var iQuantity = $product.find('.js-quantity').val(),
			$prices = $product.find('.js-prices'),
			$curPrice = null,
			PRICES = null,
			basePricesCount = null,
			params = {
				'PAGE': $prices.data('page'),
				'VIEW': $prices.data('view'),
				'MAX_SHOW': $prices.data('maxshow'),
				'SHOW_MORE': $prices.data('showmore'),
				'USE_ALONE': $prices.data('usealone'),
			},
			priceCount = 0,
			priceCountShowed = 0;

	$prices.removeClass('product-multiple product-alone');
	if (params.PAGE != 'list' && params.VIEW != 'line') {
		$prices.find('.js-prices__price').addClass('c-prices__hide c-prices__empty');
	}
$prices.find('.js-prices__more').addClass('c-prices__hide');

    for (var row in matrix.ROWS) {

        if (
            (matrix.ROWS[row].QUANTITY_FROM == 0 || matrix.ROWS[row].QUANTITY_FROM <= iQuantity) &&
            (matrix.ROWS[row].QUANTITY_TO == 0 || matrix.ROWS[row].QUANTITY_TO >= iQuantity)
        ) {

			PRICES = matrix.COLS;
			basePricesCount = Object.keys(PRICES).length;

			for (var col in PRICES) {

				if (!!matrix.MATRIX[col][row]) {
					PRICE_CODE = matrix.COLS[col].NAME;
					$curPrice = $prices.find('.js-prices__price-code_' + PRICE_CODE);

					if ($curPrice.length < 1) {
						continue;
					}

					$curPrice.removeClass('c-prices__empty');

					if (priceCount >= params.MAX_SHOW && params.PAGE == 'list' && params.VIEW == 'line') {
						break;
					}

					if (priceCountShowed < params.MAX_SHOW) {
						$curPrice.removeClass('c-prices__hide');
					}

					// console.log('price code = ' + PRICE_CODE);

					if ($product.find('.js-prices_pdv_' + PRICE_CODE)) {
						$product.find('.js-prices_pdv_' + PRICE_CODE).html(matrix.MATRIX[col][row].PRINT_DISCOUNT_VALUE);
						if (parseInt(matrix.MATRIX[col][row].DISCOUNT_DIFF) > 0) {
							$product.find('.js-prices_pdv_' + PRICE_CODE);
						}
					}

					if ($product.find('.js-prices_pd_' + PRICE_CODE)) {
						if (parseInt(matrix.MATRIX[col][row].DISCOUNT_DIFF) > 0) {
							$product.find('.js-prices_pd_' + PRICE_CODE).removeClass('c-prices__hide').html(matrix.MATRIX[col][row].PRINT_DISCOUNT_DIFF);
						} else {
							$product.find('.js-prices_pd_' + PRICE_CODE).addClass('c-prices__hide');
						}
					}

					if ($product.find('.js-prices_pv_' + PRICE_CODE)) {
						if (parseInt(matrix.MATRIX[col][row].DISCOUNT_DIFF) > 0) {
							$product.find('.js-prices_pv_' + PRICE_CODE).removeClass('c-prices__hide').html(matrix.MATRIX[col][row].PRINT_VALUE);
						} else {
							$product.find('.js-prices_pv_' + PRICE_CODE).addClass('c-prices__hide');
						}
					}

					priceCountShowed++;
					priceCount++;
				}
			}
			break;
		}
	}

	if (priceCountShowed < 2 && params.USE_ALONE == 'Y') {
		$prices.addClass('product-alone');
	} else {
		$prices.addClass('product-multiple');
		if (basePricesCount > params.MAX_SHOW && parseInt(basePricesCount - params.MAX_SHOW) > 0) {
			var moreCount = parseInt(basePricesCount - params.MAX_SHOW);
			$prices.find('.js-prices__more').removeClass('c-prices__hide').find('.js-prices__more-count').html(moreCount);
		}
	}
}

// prop select -> click
$(document).on('click', '.js-attributes__option', function(e){
  e.stopPropagation();
  clearTimeout(RSGoPro_OffersExt_timeout_id);

  var $option = $(this),
			$product = $option.closest('.js-element'),
			$animashkaDom = $product.find('.js-element__shadow'),
      url_begin = $product.data('detail');

    if (!$option.hasClass('disabled')) {

        var element_id = $product.data('elementid');

        if (element_id > 0) {

            var propCode = $option.parents('.js-attributes__prop').data('code'),
                value = $option.data('value');

            if (RSGoPro_OFFERS[element_id]) {
                if (!RSGoPro_OFFERS[element_id].SELECT_OFFER_BY_NAME)
                    RSGoPro_OffersExt_PropChanged($option);
                else SelectOfferByName($option);
            }
            else {
                RSGoPro_Area2Darken($product, "animashka");
                var url = url_begin + '?AJAX_CALL=Y&' + rsGoProActionVariableName + '=get_element_json&' + rsGoProProductIdVariableName + '=' + element_id;
                $.getJSON(url, {}, function (json) {
                    RSGoPro_OFFERS[element_id] = json;
                    if (!RSGoPro_OFFERS[element_id].SELECT_OFFER_BY_NAME)
                        RSGoPro_OffersExt_PropChanged($option);
                    else SelectOfferByName($option);
                    RSGoPro_Area2Darken($product);
                }).fail(function (data) {
                    console.warn('Get element JSON -> fail request');
                    RSGoPro_Area2Darken($product);
                });
            }
        } else {
            console.warn('Get element JSON -> element_id is empty');
        }
    }
    return false;
});

$(document).on('change', '.js-element .js-quantity.js-use_count', function () {
    clearTimeout(RSGoPro_OffersExt_timeout_id);
    clearTimeout(RSGoPro_ajaxTimeout);

    var $input = $(this),
        $product = $input.closest('.js-element'),
        url_begin = $product.data('detail'),
        element_id = $product.data('elementid');

    if (element_id > 0) {

        if (RSGoPro_OFFERS[element_id]) {

            var iOfferId = $product.find('.js-add2basketpid').val();

            if (
                !!RSGoPro_OFFERS[element_id].OFFERS[iOfferId] &&
                !!RSGoPro_OFFERS[element_id].OFFERS[iOfferId].PRICE_MATRIX
            ) {
                RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].OFFERS[iOfferId].PRICE_MATRIX);
            } else if (!!RSGoPro_OFFERS[element_id].ELEMENT.PRICE_MATRIX) {
                RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].ELEMENT.PRICE_MATRIX);
            }

            // event
            $(document).trigger('RSGoProOnChangeQuantity', [$product]);

        } else {
            var url = url_begin + '?AJAX_CALL=Y&' + rsGoProActionVariableName + '=get_element_json&' + rsGoProProductIdVariableName + '=' + element_id;

            RSGoPro_ajaxTimeout = setTimeout(function () {
                RSGoPro_Area2Darken($product, 'animashka');

                $.ajax({
                    type: 'POST',
                    url: url,
                    dataType: 'json',
                    success: function (json) {

                        RSGoPro_OFFERS[element_id] = json;

                        var iOfferId = $product.find('.js-add2basketpid').val();

                        if (RSGoPro_OFFERS[element_id]) {

                            if (
                                !!RSGoPro_OFFERS[element_id].OFFERS[iOfferId] &&
                                !!RSGoPro_OFFERS[element_id].OFFERS[iOfferId].PRICE_MATRIX
                            ) {
                                RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].OFFERS[iOfferId].PRICE_MATRIX);
                            } else if (!!RSGoPro_OFFERS[element_id].ELEMENT.PRICE_MATRIX) {
                                RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].ELEMENT.PRICE_MATRIX);
                            }
                        }
                    },
                    error: function () {
                        console.warn('Get element JSON -> fail request');
                    },
                    complete: function () {
                        RSGoPro_Area2Darken($product);
                        // event
                        $(document).trigger('RSGoProOnChangeQuantity', [$product]);
                    }
                });
            }, RSGoPro_ajaxTimeoutTime);
        }
    } else {
        console.warn('Get element JSON -> element_id is empty');
    }

    return false;
});

$(document).on('click', '.js-attributes__curent-value', function(e) {
	var $link = $(this);

	$('.js-attributes__prop.open:not(.js-attributes__code__'+ $link.parents('.js-attributes__prop').data('code')+')').removeClass('open').addClass('close');

	if ($link.parents('.js-attributes__prop').hasClass('open') ) { // was opened
		$link.parents('.js-attributes__prop').removeClass('open').addClass('close');
	} else { // was closed
		$link.parents('.js-attributes__prop').removeClass('close').addClass('open');
	}
	return false;
});

// close prop select by click outside
$(document).on('click', function(e) {
  if ($(e.target).parents('.js-attributes__prop').length > 0 && !$(e.target).parents('.js-attributes__prop').hasClass('js-pic')) {

  } else {
    $('.js-attributes__prop').removeClass('open').addClass('close');
  }
});

