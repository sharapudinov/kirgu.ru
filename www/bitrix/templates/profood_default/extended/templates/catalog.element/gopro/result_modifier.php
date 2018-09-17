<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Loader,
	\Bitrix\Main\Config\Option,
	\Redsign\DevFunc\Sale\Location\Region;

if (!Loader::includeModule('redsign.devfunc'))
    return;

if (!Loader::includeModule('catalog'))
	return;

// multiregionality
if (Loader::includeModule('redsign.devfunc'))
{
	\Redsign\DevFunc\Sale\Location\Region::editCatalogResult($arResult);
	\Redsign\DevFunc\Sale\Location\Region::editCatalogItem($arResult);
}

$arParams['GOPRO'] = array(
	'OFF_YANDEX' => Option::get(GOPRO_MODULE_ID, 'off_yandex', 'N'),
);

// /Get sorted properties
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
		'MAX_WIDTH' => 90,
		'MAX_HEIGHT' => 90,
		'PAGE' => 'detail',
		'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
		'FILTER_PRICE_TYPES' => $arPriceTypeID,
		'CURRENCY_PARAMS' => $arResult['CONVERT_CURRENCY'],
	);
    
	$arItems = array(0 => &$arResult);
	RSDevFunc::GetDataForProductItem($arItems, $params);
	
	// get no photo
	$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIGHT' => 210, 'MAX_HEIGHT' => 140));
	
	// quantity for bitrix:catalog.store.amount
	$arQuantity[$arResult['ID']] = $arResult['CATALOG_QUANTITY'];
	foreach ($arResult['OFFERS'] as $key => $arOffer) {
		$arQuantity[$arOffer['ID']] = $arOffer['CATALOG_QUANTITY'];
	}
	$arResult['DATA_QUANTITY'] = $arQuantity;
	
	// get SKU_IBLOCK_ID
	$arResult['OFFERS_IBLOCK'] = 0;
	$arSKU = CCatalogSKU::GetInfoByProductIBlock($arParams['IBLOCK_ID']);
	if (!empty($arSKU) && is_array($arSKU)) {
		$arResult['OFFERS_IBLOCK'] = $arSKU['IBLOCK_ID'];
	}
	
	// QB and DA2
	$arResult['HAVE_DA2'] = 'N';
	$arResult['HAVE_QB'] = 'N';
	if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
		foreach ($arResult['OFFERS'] as $arOffer) {
			if (isset($arOffer['DAYSARTICLE2'])) {
				$arResult['HAVE_DA2'] = 'Y';
			}
			if (isset($arOffer['QUICKBUY'])) {
				$arResult['HAVE_QB'] = 'Y';
			}
			
		}
	}
	if (isset($arResult['DAYSARTICLE2'])) {
		$arResult['HAVE_DA2'] = 'Y';
	}
	if (isset($arResult['QUICKBUY'])) {
		$arResult['HAVE_QB'] = 'Y';
	}
	// /QB and DA2
}


// tabs
$arResult['TABS'] = array(
	'DETAIL_TEXT' => false,				// description
	'DISPLAY_PROPERTIES' => false,		// grouped props
	'SET' => false,						// set
	'PROPS_TABS' => false,				// tabs from properties
	'DELIVERY_COST' => false,			// delivery cost
	'STOCKS' => false,					// stocks
);
if ($arResult['HAVE_SET']) {
	$arResult['TABS']['SET'] = true;
}
$arResult['OFFERS_PROP'] = array();
if (is_array($arResult['OFFERS']) && count($arResult['OFFERS']) > 0) {
	foreach ($arResult['OFFERS'] as $arOffer) {
		foreach ($arOffer['DISPLAY_PROPERTIES'] as $key1 => $arProp) {
			$arResult['OFFERS_PROP'][$key1] =  $arProp;
		}
		if ($arOffer['HAVE_SET']) {
			$arResult['TABS']['SET'] = true;
			break;
		}
	}
}

// tab - detail text
if ($arResult['DETAIL_TEXT'] != '')  {
	$arResult['TABS']['DETAIL_TEXT'] = true;
}

// tab - properties
$arTemp = array();
if (is_array($arParams['PROPS_TABS']) && count($arParams['PROPS_TABS']) > 0) {
    foreach ($arParams['PROPS_TABS'] as $sPropCode) {
        $arTemp[$sPropCode] = $sPropCode;
    }
}
if (is_array($arParams['STICKERS_PROPS']) && count($arParams['STICKERS_PROPS']) > 0) {
    foreach ($arParams['STICKERS_PROPS'] as $sPropCode) {
         $arTemp[$sPropCode] = $sPropCode;
     }
}
if ($arParams['PROP_STORE_REPLACE_SECTION'] != '') {
    $arTemp[$arParams['PROP_STORE_REPLACE_SECTION']] = $arParams['PROP_STORE_REPLACE_SECTION'];
}
if ($arParams['PROP_STORE_REPLACE_DETAIL'] != '') {
     $arTemp[$arParams['PROP_STORE_REPLACE_DETAIL']] = $arParams['PROP_STORE_REPLACE_DETAIL'];
}
if ($arParams['PROP_BRAND'] != '') {
	$arTemp[$arParams['PROP_BRAND']] = $arParams['PROP_BRAND'];
}
$arDisplyProps = array_diff_key($arResult['DISPLAY_PROPERTIES'], $arTemp);
if (!empty($arDisplyProps)) {
	$arResult['TABS']['DISPLAY_PROPERTIES'] = true;
}

// tab - delivery cost
if ($arParams['USE_DELIVERY_COST_TAB'] == 'Y') {
	$arResult['TABS']['DELIVERY_COST'] = true;
}

// tab - stocks
if ($arParams['USE_STORE'] == 'Y' && $arParams['SHOW_GENERAL_STORE_INFORMATION'] != 'Y') {
	$arResult['TABS']['STOCKS'] = true;
}

// tab - properties like tabs
if (is_array($arParams['PROPS_TABS']) && count($arParams['PROPS_TABS']) > 0) {
	$arDiff = array(
		$arParams['PROP_BRAND'],
		$arParams['RATING_PROP_COUNT'],
		$arParams['RATING_PROP_SUM'],
		$arParams['STICKERS_PROPS'],
		$arParams['PROP_PRICES_NOTE'],
		$arParams['PROP_STORE_REPLACE_SECTION'],
		$arParams['PROP_STORE_REPLACE_DETAIL'],
	);
	$arParams['PROPS_TABS'] = array_diff($arParams['PROPS_TABS'], $arDiff);
	foreach ($arParams['PROPS_TABS'] as $sPropCode) {
		if (
			$sPropCode != '' &&
			(
				(isset($arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE'])) ||
				($arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'F' && isset($arResult['PROPERTIES'][$sPropCode]['VALUE'])) ||
				($arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'E' && isset($arResult['PROPERTIES'][$sPropCode]['VALUE']))
			)
		) {
			$arResult['TABS']['PROPS_TABS'] = true;
			if ($arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'F') {
				if (is_array($arResult['PROPERTIES'][$sPropCode]['VALUE'])) {
					foreach ($arResult['PROPERTIES'][$sPropCode]['VALUE'] as $keyF => $fileID) {
						$rsFile = CFile::GetByID($fileID);
						if ($arFile = $rsFile->Fetch()) {
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF] = $arFile;
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF]['FULL_PATH'] = '/upload/'.$arFile['SUBDIR'].'/'.$arFile['FILE_NAME'];
							$tmp = explode('.', $arFile['FILE_NAME']);
							$tmp = end($tmp);
							$type = 'other';
							$type2 = '';
							switch($tmp) {
								case 'docx':
									$type = 'word';
									break;
								case 'doc':
									$type = 'word';
									break;
								case 'pdf':
									$type = 'pdf';
									break;
								case 'xls':
									$type = 'excel';
									break;
								case 'xlsx':
									$type = 'excel';
									break;
							}
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF]['TYPE'] = $type;
							$arResult['PROPERTIES'][$sPropCode]['VALUE'][$keyF]['SIZE'] = CFile::FormatSize($arFile['FILE_SIZE'],1);
						}
					}
				} else {
					$fileID = $arResult['PROPERTIES'][$sPropCode]['VALUE'];
					$rsFile = CFile::GetByID($fileID);
					if ($arFile = $rsFile->Fetch()) {
						$arResult['PROPERTIES'][$sPropCode]['VALUE'] = array();
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0] = $arFile;
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0]['FULL_PATH'] = '/upload/'.$arFile['SUBDIR'].'/'.$arFile['FILE_NAME'];
						$tmp = explode('.', $arFile['FILE_NAME']);
						$tmp = end($tmp);
						$type = 'other';
						$type2 = '';
						switch($tmp){
							case 'doc':
							case 'docx':
								$type = 'doc';
								break;
							case 'xls':
							case 'xlsx':
								$type = 'excel';
								break;
							case 'pdf':
								$type = 'pdf';
								break;
						}
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0]['TYPE'] = $type;
						$arResult['PROPERTIES'][$sPropCode]['VALUE'][0]['SIZE'] = CFile::FormatSize($arFile['FILE_SIZE'],1);
					}
				}
			}
		}
	}
}

// social icons
$shareIcons = '';
foreach ($arParams['SOC_SHARE_ICON'] as $arShare) {
	$shareIcons .= $arShare.',';
}
$arResult['SHARE_SOC'] = $shareIcons;

// brands
if (!empty($arParams['PROP_BRAND']) && !empty($arResult['PROPERTIES'][$arParams['PROP_BRAND']]['VALUE'])) {
	$IBLOCK_BRANDS = (float) $arParams['BRAND_IBLOCK_BRANDS'];
	if ($arParams['BRAND_DETAIL_SHOW_LOGO'] == 'Y' && $IBLOCK_BRANDS > 0 && !empty($arParams['BRAND_IBLOCK_BRANDS_PROP_BRAND'])) {
		$arFilter = array(
			'IBLOCK_ID' => $IBLOCK_BRANDS,
			'ACTIVE' => 'Y',
			'=PROPERTY_'.$arParams['BRAND_IBLOCK_BRANDS_PROP_BRAND'] => $arResult['PROPERTIES'][$arParams['PROP_BRAND']]['VALUE'],
		);
		$arSelect = array('ID', 'IBLOCK_ID', 'ACTIVE', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_'.$arParams['BRAND_IBLOCK_BRANDS_PROP_BRAND']);
		$resBrands = \CIBlockElement::GetList(array(), $arFilter, false, array('nTopCount' => 1), $arSelect);
		if ($arBrandFields = $resBrands->GetNext()) {
			$arResult['RS_GOPRO_BRAND_IMAGE'] = \CFile::ResizeImageGet(
				$arBrandFields['PREVIEW_PICTURE'],
				array('width' => 50, 'height' => 50),
				BX_RESIZE_IMAGE_PROPORTIONAL,
				true
			);
		}
	}
}

// add cache keys
$cp = $this->__component;
if (is_object($cp)) {
	$cp->SetResultCacheKeys(array('PREVIEW_PICTURE', 'DETAIL_PICTURE'));
}
