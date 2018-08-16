<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Config\Option;

if (!Loader::includeModule('redsign.devfunc'))
	return;
if (!Loader::includeModule('catalog'))
	return;

global $moduleId;
	
if (!in_array($arParams['VIEW'], array('showcase', 'gallery', 'table'))) {
	$arParams['VIEW'] = 'showcase';
}

$arParams['GOPRO'] = array(
	'OFF_YANDEX' => Option::get($moduleId, 'off_yandex', 'N'),
);

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

switch ($arParams['VIEW']) {

	case 'showcase':
		if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0) {
			foreach ($arResult['ITEMS'] as $key1 => $arItem) {
				if (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) {
					// Get sorted properties
					$arResult['ITEMS'][$key1]['OFFERS_EXT'] = RSDevFuncOffersExtension::GetSortedProperties($arItem['OFFERS'], $arParams['PROPS_ATTRIBUTES']);
				}
				// compare URL fix
				$arResult['ITEMS'][$key1]['COMPARE_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPageParam('action=ADD_TO_COMPARE_LIST&id='.$arItem['ID'], array('action', 'id', 'ajaxpages', 'ajaxpagesid')));
			}
		}

		$maxSizeWidth = 210;
		$maxSizeHeight = 170;
		$params['PROP_MORE_PHOTO'] = $arParams['PROP_MORE_PHOTO'];
		$params['PROP_SKU_MORE_PHOTO'] = $arParams['PROP_SKU_MORE_PHOTO'];
		$params['MAX_WIDTH'] = $maxSizeWidth;
		$params['MAX_HEIGHT'] = $maxSizeHeight;
		break;

	case 'gallery':

		$maxSizeWidth = 55;
		$maxSizeHeight = 55;
		$params['PROP_MORE_PHOTO'] = $arParams['PROP_MORE_PHOTO'];
		$params['PROP_SKU_MORE_PHOTO'] = $arParams['PROP_SKU_MORE_PHOTO'];
		$params['MAX_WIDTH'] = $maxSizeWidth;
		$params['MAX_HEIGHT'] = $maxSizeHeight;
		break;

	default:
        $params['PROP_MORE_PHOTO'] = $arParams['PROP_MORE_PHOTO'];
		$params['PROP_SKU_MORE_PHOTO'] = $arParams['PROP_SKU_MORE_PHOTO'];
		// $params['MAX_WIDTH'] = 220;
		// $params['MAX_HEIGHT'] = 220;
}

// get other data
RSDevFunc::GetDataForProductItem($arResult['ITEMS'], $params);
// /get other data

// QB and DA2
if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0) {
	foreach ($arResult['ITEMS'] as $key1 => $arItem) {
        
		$arResult['ITEMS'][$key1]['HAVE_DA2'] = 'N';
		$arResult['ITEMS'][$key1]['HAVE_QB'] = 'N';
		$arResult['ITEMS'][$key1]['FULL_CATALOG_QUANTITY'] = (IntVal($arItem['CATALOG_QUANTITY'])>0 ? $arItem['CATALOG_QUANTITY'] : 0);
        
		if (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) {
			foreach ($arItem['OFFERS'] as $arOffer) {
				if (isset($arOffer['DAYSARTICLE2'])) {
					$arResult['ITEMS'][$key1]['HAVE_DA2'] = 'Y';
				}
				if (isset($arOffer['QUICKBUY'])) {
					$arResult['ITEMS'][$key1]['HAVE_QB'] = 'Y';
				}
				$arResult['ITEMS'][$key1]['FULL_CATALOG_QUANTITY'] = $arResult['ITEMS'][$key1]['FULL_CATALOG_QUANTITY'] + $arOffer['CATALOG_QUANTITY'];
			}
		}
        
		if (isset($arItem['DAYSARTICLE2'])) {
			$arResult['ITEMS'][$key1]['HAVE_DA2'] = 'Y';
		}
        
		if (isset($arItem['QUICKBUY'])) {
			$arResult['ITEMS'][$key1]['HAVE_QB'] = 'Y';
		}
        
        // quantity for bitrix:catalog.store.amount
        $arQuantity = array();
        $arQuantity[$arItem['ID']] = $arItem['CATALOG_QUANTITY'];
        if (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) {
            foreach ($arItem['OFFERS'] as $arOffer) {
                $arQuantity[$arOffer['ID']] = $arOffer['CATALOG_QUANTITY'];
            }
        }
        $arResult['ITEMS'][$key1]['DATA_QUANTITY'] = $arQuantity;
	}
}
// /QB and DA2

// get no photo
$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIDTH' => $maxSizeWidth, 'MAX_HEIGHT' => $maxSizeHeight));
// /get no photo

// ADD AJAX URL
$arResult['AJAXPAGE_URL'] = $APPLICATION->GetCurPageParam('',array('ajaxpages', 'ajaxpagesid', 'get', 'AJAX_CALL', 'PAGEN_'.($arResult['NAV_RESULT']->NavNum)));
