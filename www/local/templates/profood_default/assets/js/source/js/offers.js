var RSGoPro_OffersExt_timeout_id = 0,
    RSGoPro_ajaxTimeout = 0,
    RSGoPro_ajaxTimeoutTime = 1000;

function RSGoPro_OffersExt_ChangeHTML($product) {
	var element_id = $product.data('elementid');
	if (RSGoPro_OFFERS[element_id] ) {
		// get all selected values
		var arrFullChosed = new Object();
		$product.find('.div_option.selected').each(function(index1){
			var $optionObj = $(this);
			var code = $optionObj.parents('.offer_prop').data('code');
			var value = $optionObj.data('value');
			arrFullChosed[code] = value;
		});

		// get offerID (key=ID)
		var finedOfferID = 0;
		var all_prop_true2 = true;
		for(offerID in RSGoPro_OFFERS[element_id].OFFERS) {
			all_prop_true2 = true;
			for(pCode in arrFullChosed) {
				if (arrFullChosed[pCode] != RSGoPro_OFFERS[element_id].OFFERS[offerID].PROPERTIES[pCode] ) {
					all_prop_true2 = false;
					break;
				}
			}
			if(all_prop_true2) {
				finedOfferID = offerID;
				break;
			}
		}
    
    if (finedOfferID < 1) {
      console.error('Right offer not found. OfferID not found. Product error.');
      return;
    }
		
		// article
		if ($product.find('.offer_article').length > 0) {
			if (RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].ARTICLE) {
				$product.find('.offer_article').html(RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].ARTICLE).parent().css('visibility', 'visible');
			} else if ($product.find('.offer_article').data('prodarticle') ) {
				$product.find('.offer_article').html($product.find('.offer_article').data('prodarticle')).parent().css('visibility', 'visible');
			} else {
				$product.find('.offer_article').parent().css('visibility', 'hidden');
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

		// set price
    if (!!RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICE_MATRIX) {
			RSGoPro_SetPriceMatrix($product, RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICE_MATRIX);
    } else if (RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICES) {
      
			var PRICES = RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].PRICES;

			for (var PRICE_CODE in PRICES) {
        
				if ($product.find('.price_pdv_' + PRICE_CODE).length > 0) {
					$product.find('.price_pdv_' + PRICE_CODE).removeClass('new').html(PRICES[PRICE_CODE].PRINT_DISCOUNT_VALUE);
					if (parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF) > 0) {
						$product.find('.price_pdv_' + PRICE_CODE).addClass('new');
					}
				}
        
				if ($product.find('.price_pd_' + PRICE_CODE).length > 0) {
					if (parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF) > 0) {
						$product.find('.price_pd_' + PRICE_CODE).html(PRICES[PRICE_CODE].PRINT_DISCOUNT);
					} else {
						$product.find('.price_pd_' + PRICE_CODE).html('');
					}
				}
        
				if ($product.find('.price_pv_' + PRICE_CODE).length > 0) {
					if (parseInt(PRICES[PRICE_CODE].DISCOUNT_DIFF) > 0) {
						$product.find('.price_pv_' + PRICE_CODE).html(PRICES[PRICE_CODE].PRINT_VALUE);
					} else {
						$product.find('.price_pv_' + PRICE_CODE).html('');
					}
				}

				if ($product.find('.js-discount-value').length > 0) {
					if (PRICES[PRICE_CODE].DISCOUNT_DIFF_PERCENT > 0) {
						$product.find('.js-discount-value').show().html(PRICES[PRICE_CODE].DISCOUNT_DIFF_PERCENT);
					} else {
						$product.find('.js-discount-value').hide();
					}
				}

				if ($product.find('.js-discount-hideifzero').length > 0) {
					if (PRICES[PRICE_CODE].DISCOUNT_DIFF > 0) {
						$product.find('.js-discount-hideifzero').show();
					} else {
						$product.find('.js-discount-hideifzero').hide();
					}
				}
			}
		}
		
		var SKUProps = RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].DISPLAY_PROPERTIES;
		for(var SKUProp in SKUProps) {
      $product.find('.prop_num'+SKUProp).find('.val_prop_sku').html(SKUProps[SKUProp].DISPLAY_VALUE);
		}
		
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
		
		
		// change product id
		$product.find('.js-add2basketpid').val(finedOfferID);
		if (RSGoPro_OFFERS[element_id].OFFERS[finedOfferID].CAN_BUY) {
			$product.find('.add2basketform').removeClass('cantbuy');
		} else {
			$product.find('.add2basketform').addClass('cantbuy');
		}
		// change product id in buy1click
		$product.find('.js-buy1click').data('insertdata', {RS_ORDER_IDS: finedOfferID});

		// product subscribe
		$product.find('.js-product-subscribe').attr('data-item', finedOfferID);
		$product.find('.js-product-subscribe').data('item', finedOfferID);
		
		// stores
		if ($product.find('.stores').length > 0 && finedOfferID > 0) {
			if (RSGoPro_STOCK[element_id]) {
        if ($product.find('.stores').hasClass('gopro_20')) {
          // change stores
          for (storeID in RSGoPro_STOCK[element_id].JS.SKU[finedOfferID]) {
            var stores = RSGoPro_STOCK[element_id].JS.SKU[finedOfferID];
            var quantity = stores[storeID];
            if (RSGoPro_STOCK[element_id].USE_MIN_AMOUNT == true) {
              if (quantity < 1) {
                $product.find('.stores').find('.store_' + storeID).find('.amount').css('color','#ff0000').html( RSGoPro_STOCK[element_id].MESSAGE_EMPTY);
              } else if (quantity < RSGoPro_STOCK[element_id].MIN_AMOUNT) {
                $product.find('.stores').find('.store_' + storeID).find('.amount').css('color','').html( RSGoPro_STOCK[element_id].MESSAGE_LOW);
              } else {
                $product.find('.stores').find('.store_' + storeID).find('.amount').css('color','#00cc00').html( RSGoPro_STOCK[element_id].MESSAGE_ISSET);
              }
            } else {
              $product.find('.stores').find('.store_' + storeID).find('.amount').html(quantity);
            }
            if (RSGoPro_STOCK[element_id].SHOW_EMPTY_STORE == false && quantity < 1) {
              $product.find('.stores').find('.store_' + storeID).hide();
            } else {
              $product.find('.stores').find('.store_' + storeID).show();
            }
          }
        }
        
				// change general
				if (RSGoPro_STOCK[element_id].QUANTITY[element_id]) {
          
					var quantity = parseInt( RSGoPro_STOCK[element_id].QUANTITY[finedOfferID] );
					if (RSGoPro_STOCK[element_id].USE_MIN_AMOUNT == true) {
						if (quantity < 1) {
							$product.find('.stores').find('.genamount span').css('color','#ff0000').html( RSGoPro_STOCK[element_id].MESSAGE_EMPTY);
						} else if (quantity < RSGoPro_STOCK[element_id].MIN_AMOUNT) {
							$product.find('.stores').find('.genamount span').css('color','').html( RSGoPro_STOCK[element_id].MESSAGE_LOW);
						} else {
							$product.find('.stores').find('.genamount span').css('color','#00cc00').html( RSGoPro_STOCK[element_id].MESSAGE_ISSET);
						}
            
					} else {
            if (quantity < 1){
                $product.find('.stores').find('.genamount span').css('color','#ff0000').html('0');
            }  else{
                $product.find('.stores').find('.genamount span').css('color','#00cc00').html(quantity);
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
		$(document).trigger('RSGoProOnOfferChange',[$product]);
		
	}
}

function RSGoPro_OffersExt_PropChanged($optionObj) {
	var element_id = $optionObj.parents('.js-element').data('elementid'),
      CURRENT_PROP_CODE = $optionObj.parents('.offer_prop').data('code'),
      value = $optionObj.data('value');
  
	if (RSGoPro_OFFERS[element_id] && !$optionObj.hasClass('disabled') ) {
		// change styles
		$optionObj.parents('.offer_prop').removeClass('opened').addClass('closed');
		$optionObj.parents('.offer_prop').find('.div_option').removeClass('selected');
		$optionObj.addClass('selected');
		
		// set current value
		if ($optionObj.parents('.offer_prop').hasClass('color')) { // color 
			$optionObj.parents('.offer_prop').find('.div_selected span').css({'backgroundImage':$optionObj.find('span').css('backgroundImage')});
			$optionObj.parents('.offer_prop').find('.div_selected span').attr('title', $optionObj.data('value'));
		} else {
			$optionObj.parents('.offer_prop').find('.div_selected span').html(value);
		}
		
		var next_index = 0,
        NEXT_PROP_CODE = '',
        PROP_CODE = '';
		
		// get current values
		var arCurrentValues = new Object();
		for (index in RSGoPro_OFFERS[element_id].SORT_PROPS) {
			PROP_CODE = RSGoPro_OFFERS[element_id].SORT_PROPS[index];
			arCurrentValues[PROP_CODE] = $optionObj.parents('.js-element').find('.prop_'+PROP_CODE).find('.div_option.selected').data('value');
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
			$optionObj.parents('.js-element').find('.prop_'+NEXT_PROP_CODE).find('.div_option').each(function(i){
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
			if(!$optionObj.parents('.js-element').find('.prop_'+NEXT_PROP_CODE).find('.div_option.selected').hasClass('disabled')) {
				nextOptionObj = $optionObj.parents('.js-element').find('.prop_'+NEXT_PROP_CODE).find('.div_option.selected');
			} else {
				nextOptionObj = $optionObj.parents('.js-element').find('.prop_'+NEXT_PROP_CODE).find('.div_option:not(.disabled):first');
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
	var iQuantity = $product.find('.js-quantity').val();

	for (var row in matrix.ROWS) {

		if (
				(matrix.ROWS[row].QUANTITY_FROM == 0 || matrix.ROWS[row].QUANTITY_FROM <= iQuantity) &&
				(matrix.ROWS[row].QUANTITY_TO == 0 || matrix.ROWS[row].QUANTITY_TO >= iQuantity)
		) {
      
			for (var col in matrix.COLS) {

				if (!!matrix.MATRIX[col][row]) {
          
					if ($product.find('.price_pdv_' + matrix.COLS[col].NAME)) {
						$product.find('.price_pdv_' + matrix.COLS[col].NAME).removeClass('new').html(matrix.MATRIX[col][row].PRINT_DISCOUNT_VALUE);

						if (parseInt(matrix.MATRIX[col][row].DISCOUNT_DIFF) > 0) {
							$product.find('.price_pdv_' + matrix.COLS[col].NAME).addClass('new');
						}
					}

					if ($product.find('.price_pd_' + matrix.COLS[col].NAME)) {
						if (parseInt(matrix.MATRIX[col][row].DISCOUNT_DIFF) > 0) {
							$product.find('.price_pd_' + matrix.COLS[col].NAME).html(matrix.MATRIX[col][row].PRINT_DISCOUNT_DIFF);
						} else {
							$product.find('.price_pd_' + matrix.COLS[col].NAME).html('');
						}
					}

					if ($product.find('.price_pv_' + matrix.COLS[col].NAME)) {
						if (parseInt(matrix.MATRIX[col][row].DISCOUNT_DIFF) > 0) {
							$product.find('.price_pv_' + matrix.COLS[col].NAME).html(matrix.MATRIX[col][row].PRIN_VALUE);
						} else {
							$product.find('.price_pv_' + matrix.COLS[col].NAME).html('');
						}
					}

				}
			}
			break;
		}
	}
}

// prop select -> click
$(document).on('click', '.div_option', function(e){
  e.stopPropagation();
  clearTimeout( RSGoPro_OffersExt_timeout_id );
  
  var $option = $(this),
      $product = $option.closest('.js-element'),
      url_begin = $product.data('detail');

  if (!$option.hasClass('disabled')) {
    
    var element_id = $product.data('elementid');
    
    if (element_id > 0) {
      
      var propCode = $option.parents('.offer_prop').data('code'),
          value = $option.data('value');
          
      if (RSGoPro_OFFERS[element_id]) {
        RSGoPro_OffersExt_PropChanged($option);
      } else {
        RSGoPro_Area2Darken($product, 'animashka');
        var url = url_begin + '?AJAX_CALL=Y&' + rsGoProActionVariableName + '=get_element_json&' + rsGoProProductIdVariableName + '=' + element_id;
        
        $.getJSON(url, {}, function(json){
          RSGoPro_OFFERS[element_id] = json;
          RSGoPro_OffersExt_PropChanged($option);
          RSGoPro_Area2Darken( $product );
        }).fail(function(data){
          console.warn( 'Get element JSON -> fail request' );
          RSGoPro_Area2Darken($product);
        });
      }
    } else {
      console.warn( 'Get element JSON -> element_id is empty' );
    }
  }
  return false;
});

$(document).on('change', '.js-element .js-quantity.js-use_count', function() {
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
			$(document).trigger('RSGoProOnChangeQuantity',[$product]);

    } else {
      var url = url_begin + '?AJAX_CALL=Y&' + rsGoProActionVariableName + '=get_element_json&' + rsGoProProductIdVariableName + '=' + element_id;
      
      RSGoPro_ajaxTimeout = setTimeout(function(){
        RSGoPro_Area2Darken($product, 'animashka');
        
        $.ajax({
          type: 'POST',
          url: url,
          dataType: 'json',
          success: function(json) {

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
          error: function() {
            console.warn( 'Get element JSON -> fail request' );
          },
          complete: function() {
            RSGoPro_Area2Darken($product);
						// event
						$(document).trigger('RSGoProOnChangeQuantity',[$product]);
          }
        });
      }, RSGoPro_ajaxTimeoutTime);
    }
  } else {
    console.warn( 'Get element JSON -> element_id is empty' );
  }

  return false;
});

$(document).on('click','.div_selected',function(e){
  $('.offer_prop.opened:not(.prop_'+ $(this).parents('.offer_prop').data('code')+')').removeClass('opened').addClass('closed');
  if ($(this).parents('.offer_prop').hasClass('closed') ) { // was closed 
    $(this).parents('.offer_prop').removeClass('closed').addClass('opened');
  } else { // was opened
    $(this).parents('.offer_prop').removeClass('opened').addClass('closed');
  }
  return false;
});

// close prop select by click outside
$(document).on('click',function(e){
  if ($(e.target).parents('.offer_prop').length>0 && !$(e.target).parents('.offer_prop').hasClass('color') ) {

  } else {
    $('.offer_prop').removeClass('opened').addClass('closed');
  }
});
