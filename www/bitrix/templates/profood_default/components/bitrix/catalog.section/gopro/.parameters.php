<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

if(!CModule::IncludeModule('iblock'))
	return;
if(!CModule::IncludeModule('catalog'))
	return;
if(!CModule::IncludeModule('redsign.devfunc'))
	return;

$listProp = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCurrentValues['IBLOCK_ID']);
$arCatalog = CCatalog::GetByID($arCurrentValues['IBLOCK_ID']);

$arTemplateParameters = array(
	'VIEW' => array(
		'NAME' => GetMessage('VIEW'),
		'TYPE' => 'STRING',
	),
	// section, element
	'PROP_MORE_PHOTO' => array(
		'NAME' => GetMessage('PROP_MORE_PHOTO'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
	'PROP_ARTICLE' => array(
		'NAME' => GetMessage('PROP_ARTICLE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'PROP_ACCESSORIES' => array(
		'NAME' => GetMessage('PROP_ACCESSORIES'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['E'],
	),
	'USE_FAVORITE' => array(
		'NAME' => GetMessage('USE_FAVORITE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'USE_SHARE' => array(
		'NAME' => GetMessage('USE_SHARE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'SHOW_ERROR_EMPTY_ITEMS' => array(
		'NAME' => GetMessage('SHOW_ERROR_EMPTY_ITEMS'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'EMPTY_ITEMS_HIDE_FIL_SORT' => array(
		'NAME' => GetMessage('EMPTY_ITEMS_HIDE_FIL_SORT'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'DONT_SHOW_LINKS' => array(
		'NAME' => GetMessage('DONT_SHOW_LINKS'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'USE_AUTO_AJAXPAGES' => array(
		'NAME' => GetMessage('USE_AUTO_AJAXPAGES'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'OFF_MEASURE_RATION' => array(
		'NAME' => GetMessage('OFF_MEASURE_RATION'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	// store
	'USE_STORE' => array(
		'NAME' => GetMessage('USE_STORE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	// showcase
	'LIST_SKU_VIEW' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('LIST_SKU_VIEW'),
		'TYPE' => 'LIST',
		'VALUES' => $arSkuView,
	),
	'COLUMNS5' => array(
		'NAME' => GetMessage('COLUMNS5'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'COL_XS_6' => array(
		'NAME' => GetMessage('COL_XS_6'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'STICKERS_PROPS' => array(
		'NAME' => GetMessage('STICKERS_PROPS'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['L'],
		'MULTIPLE' => 'Y',
	),
	'STICKERS_DISCOUNT_VALUE' => array(
		'NAME' => GetMessage('STICKERS_DISCOUNT_VALUE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'OFF_HOVER_POPUP' => array(
		'NAME' => GetMessage('OFF_HOVER_POPUP'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'USE_LAZYLOAD' => array(
		'NAME' => GetMessage('USE_LAZYLOAD'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	// rating
	'USE_RATING' => array(
		'NAME' => GetMessage('USE_RATING'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
);

if (IntVal($arCatalog["OFFERS_IBLOCK_ID"])) {
	$listProp2 = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCatalog['OFFERS_IBLOCK_ID']);
	$arTemplateParameters['PROP_SKU_MORE_PHOTO'] = array(
		'NAME' => GetMessage('PROP_SKU_MORE_PHOTO'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['F'],
	);
	$arTemplateParameters['PROP_SKU_ARTICLE'] = array(
		'NAME' => GetMessage('PROP_SKU_ARTICLE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['SNL'],
	);
	$arTemplateParameters['PROPS_ATTRIBUTES'] = array(
		'NAME' => GetMessage('PROPS_ATTRIBUTES'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['SNL'],
		'MULTIPLE' => 'Y',
	);
	$arTemplateParameters['PROPS_ATTRIBUTES_COLOR'] = array(
		'NAME' => GetMessage('PROPS_ATTRIBUTES_COLOR'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['HL'],
		'MULTIPLE' => 'Y',
	);
}

/* store */
if (!isset($arCurrentValues['USE_STORE']) || $arCurrentValues['USE_STORE'] == 'Y') {
	$arTemplateParameters['USE_MIN_AMOUNT'] = array(
		'NAME' => GetMessage('USE_MIN_AMOUNT'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	);
	$arTemplateParameters['MIN_AMOUNT'] = array(
		'NAME' => GetMessage('MIN_AMOUNT'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	);
	$arTemplateParameters['MAIN_TITLE'] = array(
		'NAME' => GetMessage('MAIN_TITLE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '',
	);
    $arTemplateParameters['HIDE_IN_LIST'] = array(
        'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('HIDE_IN_LIST'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
    );
	$arTemplateParameters['PROP_STORE_REPLACE_SECTION'] = array(
        'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('PROP_STORE_REPLACE_SECTION'),
		'TYPE' => 'LIST',
        'VALUES' => array_merge(array(GetMessage('PROP_STORE_REPLACE_EMPTY')), $listProp['ALL'])
    );
}

/* rating */
if (!isset($arCurrentValues['USE_RATING']) || $arCurrentValues['USE_RATING'] == 'Y') {
	$arTemplateParameters['RATING_PROP_COUNT'] = array(
		'NAME' => GetMessage('RATING_PROP_COUNT'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['N'],
	);
	$arTemplateParameters['RATING_PROP_SUM'] = array(
		'NAME' => GetMessage('RATING_PROP_SUM'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['N'],
	);
}
/* /rating */

/* ajaxpages */
if (empty($arCurrentValues['USE_AUTO_AJAXPAGES']) || $arCurrentValues['USE_AUTO_AJAXPAGES'] != 'Y') {
	$arTemplateParameters['HIDE_AJAXPAGES_LINK'] = array(
		'NAME' => GetMessage('HIDE_AJAXPAGES_LINK'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
    );
}
/* /ajaxpages */
