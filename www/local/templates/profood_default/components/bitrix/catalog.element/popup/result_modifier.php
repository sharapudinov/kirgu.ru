<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader;

if (!Loader::includeModule('redsign.devfunc'))
	return;

if (!empty($arResult)) {
    
    $arElementsIDs = array($arResult['ID']);
    
    if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
        foreach ($arResult['OFFERS'] as $iOfferKey => $arOffer) {
			// USE_PRICE_COUNT fix
            if (!in_array($arOffer['ID'], $arElementsIDs)) {
                $arElementsIDs[] = $arOffer['ID'];
            } else {
              unset($arResult['OFFERS'][$iOfferKey]);  
            }
        }
    }
    
	if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
		// Get sorted properties
		$arResult['OFFERS_EXT'] = RSDevFuncOffersExtension::GetSortedProperties($arResult['OFFERS'],$arParams['PROPS_ATTRIBUTES']);
	}
	
	// compare URL fix
	$arResult['COMPARE_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPageParam('action=ADD_TO_COMPARE_LIST&id='.$arItem['ID'], array('action', 'id', 'ajaxpages', 'ajaxpagesid')));
	// /compare URL fix
	
	if ($arParams['USE_PRICE_COUNT']) {
		$arPriceTypeID = array();
		foreach ($arResult['CAT_PRICES'] as $value) {
			$arPriceTypeID[] = $value['ID'];
		}
	}

	// get other data
	$params = array(
        'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
		'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
		'MAX_WIDTH' => 210,
		'MAX_HEIGHT' => 170,
        'PAGE' => 'detail',
        'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'FILTER_PRICE_TYPES' => $arPriceTypeID,
		'CURRENCY_PARAMS' => $arResult['CONVERT_CURRENCY'],
	);
    
	$arItems = array(0 => &$arResult);
	RSDevFunc::GetDataForProductItem($arItems, $params);
	// /get other data
	
	// get no photo
	$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIGHT' => 210, 'MAX_HEIGHT' => 140));
	// /get no photo
}