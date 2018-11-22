<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader;

$maxSizeWidth = 220;
$maxSizeHeight = 220;

if (!Loader::includeModule('redsign.devfunc'))
	return;
if (!Loader::includeModule('catalog'))
	return;

$params = array();

if ($arParams['USE_PRICE_COUNT']) {

	$arPriceTypeID = array();
	foreach ($arResult['PRICES'] as $value) {
		$arPriceTypeID[] = $value['ID'];
	}
    
    $arElementsIDs = array($arResult['ID']);
    if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0) {
        
        foreach ($arResult['ITEMS'] as $iItemKey => $arItem) {
            if (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) {
                
                foreach ($arItem['OFFERS'] as $iOfferKey => $arOffer) {

                    // USE_PRICE_COUNT fix
                    if (!in_array($arOffer['ID'], $arElementsIDs)) {
                        $arElementsIDs[] = $arOffer['ID'];
                    } else {
                      unset($arResult['ITEMS'][$iItemKey]['OFFERS'][$iOfferKey]);  
                    }
                }
            }
        }
    }
    
	$params['USE_PRICE_COUNT'] = $arParams['USE_PRICE_COUNT'];
	$params['FILTER_PRICE_TYPES'] = $arPriceTypeID;
	$params['CURRENCY_PARAMS'] = $arResult['CONVERT_CURRENCY'];
}

// get other data
$params['PROP_MORE_PHOTO'] = $arParams['PROP_MORE_PHOTO'];
$params['PROP_SKU_MORE_PHOTO'] = $arParams['PROP_SKU_MORE_PHOTO'];
$params['MAX_WIDTH'] = $maxSizeWidth;
$params['MAX_HEIGHT'] = $maxSizeHeight;
RSDevFunc::GetDataForProductItem($arResult['ITEMS'],$params);
// /get other data

// ADD AJAX URL
$arResult['AJAXPAGE_URL'] = $APPLICATION->GetCurPageParam('',array('ajaxpages', 'ajaxpagesid', 'get', 'AJAX_CALL', 'PAGEN_'.($arResult['NAV_RESULT']->NavNum)));

// get no photo
$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIDTH' => $maxSizeWidth, 'MAX_HEIGHT' => $maxSizeHeight));
// /get no photo
