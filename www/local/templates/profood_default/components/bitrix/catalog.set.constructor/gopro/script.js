var RSGoPro_SetBuy1Click = false;

function RSGoPro_OnOfferChangeDetailSet($elementObj)
{
	var finedOfferID = $elementObj.find('.js-add2basketpid').val();
	var element_id = $elementObj.data('elementid');
	if(finedOfferID>0)
	{
		// hide/show sets
		var have_offer_showed = false;
		$('.detailtabs .content.set').find('.aroundset.offer').addClass('noned');
		if( $('.detailtabs .content.set').find('.aroundset.offerid'+finedOfferID).length>0 )
		{
			$('.detailtabs .content.set').find('.aroundset.offerid'+finedOfferID).removeClass('noned');
			have_offer_showed = true;
		}
		if( $('.detailtabs .content.set').find('.aroundset.simple').length>0 )
		{
			if(have_offer_showed)
			{
				$('.detailtabs .content.set').find('.aroundset.simple').addClass('noned');
			} else {
				$('.detailtabs .content.set').find('.aroundset.simple').removeClass('noned');
			}
		}
		
		// hide/show tab switcher
		RSGoPro_SetHideShowSwitcher();
	}
}

function RSGoPro_SetHideShowSwitcher()
{
	if( $('.detailtabs').find('.content.set').find('.aroundset:not(.noned)').length>0 )
	{
		if( $('.detailtabs .switcher[href="#set"]').length>0 )
		{
			$('.detailtabs .switcher[href="#set"]').removeAttr('style');
		}
	} else {
		if( $('.detailtabs .switcher[href="#set"]').length>0 )
		{
			$('.detailtabs .switcher[href="#set"]').hide();
			if( $('.detailtabs .switcher[href="#set"]').hasClass('selected') )
			{
				$('.detailtabs').find('.switcher:first').trigger('click');
			}
		}
	}
}

function RSGoPro_SetRecalcPrices($jsSet) {
	var sumPrice = 0,
		sumOldPrice = 0,
		sumDiffDiscountPrice = 0;
	
	$jsSet.find('.items.line1').find('.js-element').each(function(i){
		sumPrice += +$(this).data('price');
		sumOldPrice += +$(this).data('oldprice');
		sumDiffDiscountPrice += +$(this).data('discount');
	});

	BX.ajax.post(
		$jsSet.data('ajaxpath'),
		{
			sessid					: BX.bitrix_sessid(),
			action					: "ajax_recount_prices",
			sumPrice				: sumPrice,
			sumOldPrice				: sumOldPrice,
			sumDiffDiscountPrice	: sumDiffDiscountPrice,
			currency				: $jsSet.data('currency')
		},
		function(result) {
			RSGoPro_Area2Darken($jsSet);
			var json = JSON.parse(result);
			if(json.formatSum) {
				$jsSet.find('.fullpanel').find('.price.new').html(json.formatSum);
			}
			if(json.formatOldSum) {
				$jsSet.find('.fullpanel').find('.price.old').html(json.formatOldSum).show();
			} else {
				$jsSet.find('.fullpanel').find('.price.old').hide();
			}
			if(json.formatDiscDiffSum) {
				$jsSet.find('.fullpanel').find('.diff').html(json.formatDiscDiffSum).parent().show();
			} else {
				$jsSet.find('.fullpanel').find('.discount').hide();
			}
		}
	);
}
function RSGoPro_SetAddRemoveItem($checkbox)
{
	var maxInSet = 4,
		$jsSet = $checkbox.parents('.js-set'),
		$elementObj = $checkbox.parents('.js-element'),
		inSetCount = $jsSet.find('.items.js-line1').find('.js-element').length,
		productID = $elementObj.data('elementid'),
		prefixLine1 = $jsSet.find('.items.js-line1').data('prefix');

	RSGoPro_Area2Darken($jsSet, 'animashka');

	if ($checkbox.is(':checked')) { // was in
		$jsSet.find('.items.js-line1').find('.sliderin').append($jsSet.find('.items.line2').find('.js-elementid' + productID).clone());
		$jsSet.find('.items.js-line1').find('.js-elementid' + productID).find('input.addremove').attr('id', prefixLine1 + $elementObj.data('elementid'));
		$jsSet.find('.items.js-line1').find('.js-elementid' + productID).find('label.addremove_label').attr('for', prefixLine1 + $elementObj.data('elementid'));
	} else if(inSetCount < maxInSet) { // was out
		$jsSet.find('.items.js-line1').find('.js-elementid' + productID).remove();
		$jsSet.find('.js-elementid' + productID).find('input.addremove').attr('checked', 'checked');
	}

	RSGoPro_SetRecalcPrices($jsSet);
}
function RSGoPro_SetAddRemoveItemOld($link)
{
	var maxInSet = 4;
	var $jsSet = $link.parents('.js-set');
	var $elementObj = $link.parents('.js-element');
	var inSetCount = $jsSet.find('.items.line1').find('.js-element').length;
	var productID = $elementObj.data('elementid');
	if( $link.hasClass('in') ) // was in
	{
		RSGoPro_Area2Darken( $jsSet,'animashka' );
		$jsSet.find('.items.line1').find('.js-elementid'+productID).remove();
		$link.removeClass('in');
		RSGoPro_SetRecalcPrices($jsSet);
	} else if(inSetCount<maxInSet) { // was out
		RSGoPro_Area2Darken( $jsSet,'animashka' );
		$link.addClass('in');
		$jsSet.find('.items.line1').find('.sliderin').append( $jsSet.find('.items.line2').find('.js-elementid'+productID).clone() );
		RSGoPro_SetRecalcPrices($jsSet);
	}
}

$(document).ready(function(){
	
	// hide/show switcher
	RSGoPro_SetHideShowSwitcher();
	
	// jScrollPane -> items
	var $aroundSet = $('.detailtabs .aroundset'),
		cnt = 0,
		elW = 0;
	
	$aroundSet.each(function(){
		// ELEMENT & DEFAULT
		cnt = $(this).find('.line1 .sliderin .js-element').length
		elW = $(this).find('.line1 .sliderin .js-element').filter(':first').outerWidth(true);
		$(this).find('.line1 .sliderin').css({width:(cnt*elW)+'px'});
		// DEFAULT && OTHER
		cnt = $(this).find('.line2 .sliderin .js-element').length
		elW = $(this).find('.line2 .sliderin .js-element').filter(':first').outerWidth(true);
		$(this).find('.line2 .sliderin').css({width:(cnt*elW)+'px'});
	});
	
	// massadd2basket
	$(document).on('click','.js-set .massadd2basket', function(){
		var $jsSet = $(this).parents('.js-set');
		RSGoPro_Area2Darken( $jsSet.find('.fullpanel'), 'animashka' );
		RSGoPro_Area2Darken( $('#header').find('.basketinhead') );
		var arSetIDs = new Array();
		$jsSet.find('.items.line1').find('.js-element').each(function(i){
			arSetIDs.push( $(this).data('elementid') );
		});
		BX.ajax.post(
			$jsSet.data('ajaxpath'), {
				sessid: BX.bitrix_sessid(),
				action: 'catalogSetAdd2Basket',
				set_ids: arSetIDs,
				lid: $jsSet.data('lid'),
				iblockId: $jsSet.data('iblockid'),
				setOffersCartProps: $jsSet.data('setOffersCartProps')
			},
			function(result) {
				var json = JSON.parse(result);
				RSGoPro_PutJSon( json );
				RSGoPro_Area2Darken( $jsSet.find('.fullpanel') );
				RSGoPro_Area2Darken( $('#header').find('.basketinhead') );
				RSEC_BASKET_Refresh();
			}
		);
		return false;
	});
	
	// delete
	$(document).on('click','.js-set .delete', function(){
		var productID = $(this).parents('.js-element').data('elementid');
		$(this).parents('.js-set').find('.items.js-line2').find('.js-elementid' + productID).find('.addremove_label').trigger('click');
		return false;
	});
	
	// checkbox
	$(document).on('change','.js-set input.addremove', function(){
		RSGoPro_SetAddRemoveItem($(this));
	});
	$(document).on('click','.js-set .checkbox', function(){
		RSGoPro_SetAddRemoveItemOld($(this));
		return false;
	});
	
	// open other
	$(document).on('click','a.myset', function(){
		var $line2 = $(this).parents('.js-set').find('.items.line2');
		if ($line2.length > 0) {
			$line2.toggleClass('noned');
		}
		return false;
	});

	// change offer
	$(document).on('RSGoProOnOfferChange', function(e,elementObj){
		RSGoPro_OnOfferChangeDetailSet(elementObj);
	});
	
	// buy1click
	$(document).on('click', '.buy1click.set', function(e){
		RSGoPro_SetBuy1Click = true;
	});
	// buy1click - put data to form
	$(document).on('RSGoProOnFancyBeforeShow',function(){
		if (RSGoPro_SetBuy1Click) {
			var value = '';
			value += BX.message("RSGoPro_SET_NABOR") + '\n' +
				'-----------------------------------------------------';
			$('.aroundset:not(.noned)').find('.items.line1').find('.js-element').each(function(i){
				value += '\n' +
					BX.message("RSGoPro_SET_PROD_ID") + ': ' + $(this).data('elementid') + '\n' +
					BX.message("RSGoPro_SET_PROD_NAME") + ': ' + $(this).data('elementname') + '\n' +
					BX.message("RSGoPro_SET_PROD_LINK") + ': ' + ( $(this).find('.setitemlink').length>0 ? (window.location.protocol+'//'+window.location.host+$(this).find('.setitemlink').attr('href')) : window.location.href ) + '\n' +
					'-----------------------------------------------------';
			});
			
			$('.fancybox-inner').find('textarea[name="RS_AUTHOR_ORDER_LIST"]').text( value );
		}
		RSGoPro_SetBuy1Click = false;
	});
});
