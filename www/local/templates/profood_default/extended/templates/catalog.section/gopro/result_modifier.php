<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;

if (!Loader::includeModule('redsign.devfunc'))
	return;
if (!Loader::includeModule('catalog'))
	return;

global $moduleId;
if (empty($moduleId)) {
	include(EXTENDED_PATH.'/module_id.php');
}

// multiregionality
if (Loader::includeModule('redsign.devfunc'))
{
	\Redsign\DevFunc\Sale\Location\Region::editCatalogResult($arResult);
	if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0)
	{
		foreach ($arResult['ITEMS'] as $iItemKey => $arItem)
		{
			\Redsign\DevFunc\Sale\Location\Region::editCatalogItem($arResult['ITEMS'][$iItemKey]);
		}
		unset($iItemKey, $arItem);
	}
}

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
					$arResult['ITEMS'][$key1]['OFFERS_EXT'] = RSDevFuncOffersExtension::GetSortedPropertiesExt($arItem['OFFERS'], $arParams['PROPS_ATTRIBUTES']);
				}
				// compare URL fix
				$arResult['ITEMS'][$key1]['COMPARE_URL'] = htmlspecialcharsbx($APPLICATION->GetCurPageParam('action=ADD_TO_COMPARE_LIST&id='.$arItem['ID'], array('action', 'id', 'ajaxpages', 'ajaxpagesid')));
			}
		}

		$params['PROP_MORE_PHOTO'] = $arParams['PROP_MORE_PHOTO'];
		$params['PROP_SKU_MORE_PHOTO'] = $arParams['PROP_SKU_MORE_PHOTO'];
		$params['MAX_WIDTH'] = 198;
		$params['MAX_HEIGHT'] = 208;
		$arResult['LAZY_PHOTO'] = array(
			'src' => SITE_TEMPLATE_PATH.'/assets/img/empty_198_208.png',
		);
		break;

	case 'gallery':

		$params['PROP_MORE_PHOTO'] = $arParams['PROP_MORE_PHOTO'];
		$params['PROP_SKU_MORE_PHOTO'] = $arParams['PROP_SKU_MORE_PHOTO'];
		$params['MAX_WIDTH'] = 100;
		$params['MAX_HEIGHT'] = 100;
		$arResult['LAZY_PHOTO'] = array(
			'src' => SITE_TEMPLATE_PATH.'/assets/img/empty_100_100.png',
		);
		break;

	default:
        $params['PROP_MORE_PHOTO'] = '';
		$params['PROP_SKU_MORE_PHOTO'] = '';
}

// get no photo
$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIDTH' => $params['MAX_WIDTH'], 'MAX_HEIGHT' => $params['MAX_HEIGHT']));
// /get no photo

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


        $HLiB_name=$arItem['PROPERTIES']['AKTSII']['USER_TYPE_SETTINGS']['TABLE_NAME'];
        $XML_ID=$arItem['PROPERTIES']['AKTSII']['VALUE'];

        if(CModule::IncludeModule('highloadblock')) {
            $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $HLiB_name)));
            if (!($hldata = $rsData->fetch())) {
                //          echo 'Инфоблок не найден';
            } else {
                $hlentity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                $hlDataClass = $hldata['NAME'] . 'Table';
                $res = $hlDataClass::getList(array(
                        'filter' => array(
                            'UF_XML_ID' => $XML_ID,
                        ),
                        'select' => array("*"),
                        'order' => array(
                            'UF_NAME' => 'asc'
                        ),
                    )
                );
                $arResult['ITEMS'][$key1]['PROPERTIES']['AKTSII']['VALUE_EXT']=array();
                while ($row = $res->fetch()) {
                    $el_Filter= [
                        'IBLOCK_CODE' => 'action',
                        'PROPERTY_ACTION' => $row['UF_XML_ID']
                    ];

                    $el_Select= [ 'IBLOCK_ID', 'ID', 'CODE', 'PROPERTY_ACTION' ];

                    $el_res= CIBlockElement::GetList( false, $el_Filter, false, $el_Nav, $el_Select );
                    while ( $el_arr= $el_res->Fetch() ) {
                            $row['UF_LINK']="/action/".$el_arr['CODE']."/";

                    }
                    $arResult['ITEMS'][$key1]['PROPERTIES']['AKTSII']['VALUE_EXT'][$row['UF_XML_ID']] = $row;
                }
            }
        }
        $HLiB_name=$arItem['PROPERTIES']['RASSROCHKA']['USER_TYPE_SETTINGS']['TABLE_NAME'];
        $XML_ID=$arItem['PROPERTIES']['RASSROCHKA']['VALUE'];

/*test_dump($arItem['PROPERTIES']['RASSROCHKA']['VALUE']);*/

        if(CModule::IncludeModule('highloadblock')) {
            $rsData = \Bitrix\Highloadblock\HighloadBlockTable::getList(array('filter' => array('TABLE_NAME' => $HLiB_name)));
            if (!($hldata = $rsData->fetch())) {
                //          echo 'Инфоблок не найден';
            } else {
                $hlentity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hldata);
                $hlDataClass = $hldata['NAME'] . 'Table';
                $res = $hlDataClass::getList(array(
                        'filter' => array(
                            'UF_XML_ID' => $XML_ID,
                        ),
                        'select' => array("*"),
                        'order' => array(
                            'UF_NAME' => 'asc'
                        ),
                    )
                );
                $arResult['ITEMS'][$key1]['PROPERTIES']['RASSROCHKA']['VALUE_EXT']=array();

                while ($row = $res->fetch()) {
                    $el_Filter= [
                        'IBLOCK_CODE' => 'action',
                        'PROPERTY_RASSROCHKA' => $row['UF_XML_ID']
                    ];

                    $el_Select= [ 'IBLOCK_ID', 'ID', 'CODE', 'PROPERTY_RASSROCHKA' ];

                    $el_res= CIBlockElement::GetList( false, $el_Filter, false, $el_Nav, $el_Select );
                    while ( $el_arr= $el_res->Fetch() ) {
                            $row['UF_LINK']="/action/".$el_arr['CODE']."/";


                    }
                    $arResult['ITEMS'][$key1]['PROPERTIES']['RASSROCHKA']['VALUE_EXT'][$row['UF_XML_ID']] = $row;
                }
            }
        }
	}
}
// /QB and DA2

// ADD AJAX URL
$arDiff = array('ajaxpages', 'ajaxpagesid', 'get', 'AJAX_CALL', 'PAGEN_'.($arResult['NAV_RESULT']->NavNum), 'fancybox', 'x-fancybox');
if (empty($arParams['AJAXPAGE_URL'])) {
	$arResult['AJAXPAGE_URL'] = $APPLICATION->GetCurPageParam('', $arDiff);
} else {
	$arResult['AJAXPAGE_URL'] = $arParams['AJAXPAGE_URL'];
}
// /ADD AJAX URL
