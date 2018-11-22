<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

if (!CModule::IncludeModule('iblock'))
	return;
if (!CModule::IncludeModule('catalog'))
	return;
if (!CModule::IncludeModule('redsign.devfunc'))
	return;

$listProp = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCurrentValues['IBLOCK_ID']);
$arCatalog = CCatalog::GetByID($arCurrentValues['IBLOCK_ID']);

$arIBlock = array();
$rsIBlock = \CIBlock::GetList(array('sort' => 'asc'), array('ACTIVE' => 'Y'));
while ($arr = $rsIBlock->Fetch()) {
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
}

$arViewModeList = array(
	'VIEW_SECTIONS' => GetMessage('RSGOPRO_VIEW_SECTIONS'),
	'VIEW_ELEMENTS' => GetMessage('RSGOPRO_VIEW_ELEMENTS')
);

$arSectionsDescriptionPosition = array(
	'none' => GetMessage('RSGOPRO.SECTIONS_DESCRIPTION_POSITION.NONE'),
	'top' => GetMessage('RSGOPRO.SECTIONS_DESCRIPTION_POSITION.TOP'),
	'bottom' => GetMessage('RSGOPRO.SECTIONS_DESCRIPTION_POSITION.BOTTOM'),
);
$arSectionDescriptionPosition = array(
	'none' => GetMessage('RSGOPRO.SECTION_DESCRIPTION_POSITION.NONE'),
	'top' => GetMessage('RSGOPRO.SECTION_DESCRIPTION_POSITION.TOP'),
	'bottom' => GetMessage('RSGOPRO.SECTION_DESCRIPTION_POSITION.BOTTOM'),
);

$arPrice = array();
$rsPrice = CCatalogGroup::GetList($v1='sort', $v2='asc');
while ($arr = $rsPrice->Fetch()) {
	$arPrice[$arr['NAME']] = '['.$arr['NAME'].'] '.$arr['NAME_LANG'];
}

$arShareBlock = array(
	'collections' => GetMessage("MSG_SHARE-collections"),
	'vkontakte' => GetMessage("MSG_SHARE-vkontakte"),
	'facebook' => GetMessage("MSG_SHARE-facebook"),
	'odnoklassniki' => GetMessage("MSG_SHARE-odnoklassniki"),
	'moimir' => GetMessage("MSG_SHARE-moimir"),
	'gplus' => GetMessage("MSG_SHARE-gplus"),
	'twitter' => GetMessage("MSG_SHARE-twitter"),
	'blogger' => GetMessage("MSG_SHARE-blogger"),
	'delicious' => GetMessage("MSG_SHARE-delicious"),
	'digg' => GetMessage("MSG_SHARE-digg"),
	'reddit' => GetMessage("MSG_SHARE-reddit"),
	'evernote' => GetMessage("MSG_SHARE-evernote"),
	'linkedin' => GetMessage("MSG_SHARE-linkedin"),
	'lj' => GetMessage("MSG_SHARE-lj"),
	'pocket' => GetMessage("MSG_SHARE-pocket"),
	'qzone' => GetMessage("MSG_SHARE-qzone"),
	'renren' => GetMessage("MSG_SHARE-renren"),
	'sinaWeibo' => GetMessage("MSG_SHARE-sinaWeibo"),
	'surfingbird' => GetMessage("MSG_SHARE-surfingbird"),
	'tencentWeibo' => GetMessage("MSG_SHARE-tencentWeibo"),
	'tumblr' => GetMessage("MSG_SHARE-tumblr"),
	'viber' => GetMessage("MSG_SHARE-viber"),
	'whatsapp' => GetMessage("MSG_SHARE-whatsapp"),
	'skype' => GetMessage("MSG_SHARE-skype"),
	'telegram' => GetMessage("MSG_SHARE-telegram"),
);

$arSkuView = array(
	'list' => GetMessage("SKU_VIEW_LIST"),
	'buttons' => GetMessage("SKU_VIEW_BUTTONS"),
);

$arTemplateParameters = array(
    // base
	'SECTIONS_VIEW_MODE' => array(
		'PARENT' => 'BASE',
		'NAME' => GetMessage('RSGOPRO_VIEW_MODE'),
		'TYPE' => 'LIST',
		'VALUES' => $arViewModeList,
		'MULTIPLE' => 'N',
		'DEFAULT' => 'LIST',
	),
    // additional
    'PROP_MORE_PHOTO' => array(
		'NAME' => GetMessage('PROP_MORE_PHOTO'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
	'USE_FAVORITE' => array(
		'NAME' => GetMessage('USE_FAVORITE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
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
	// price
	'OFF_MEASURE_RATION' => array(
		'PARENT' => 'PRICES',
		'NAME' => GetMessage('OFF_MEASURE_RATION'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	// rating
	'USE_RATING' => array(
		'NAME' => GetMessage('USE_RATING'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	// sections
	'SECTIONS_DESCRIPTION_POSITION' => array(
		'PARENT' => 'SECTIONS_SETTINGS',
		'NAME' => GetMessage('RSGOPRO.SECTIONS_DESCRIPTION_POSITION'),
		'TYPE' => 'LIST',
		'VALUES' => $arSectionsDescriptionPosition,
		'MULTIPLE' => 'N',
		'DEFAULT' => 'top',
	),
	// section
	'LIST_SKU_VIEW' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('LIST_SKU_VIEW'),
		'TYPE' => 'LIST',
		'VALUES' => $arSkuView,
	),
	'SHOW_ERROR_EMPTY_ITEMS' => array(
        'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('SHOW_ERROR_EMPTY_ITEMS'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'USE_AUTO_AJAXPAGES' => array(
        'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('USE_AUTO_AJAXPAGES'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'SECTION_DESCRIPTION_POSITION' => array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('RSGOPRO.SECTION_DESCRIPTION_POSITION'),
		'TYPE' => 'LIST',
		'VALUES' => $arSectionDescriptionPosition,
		'MULTIPLE' => 'N',
		'DEFAULT' => 'top',
	),
	'COL_XS_6' => array(
        'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('COL_XS_6'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'OFF_HOVER_POPUP' => array(
		'PARENT' => 'LIST_SETTINGS',
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
	// detail
	'DETAIL_SKU_VIEW' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('DETAIL_SKU_VIEW'),
		'TYPE' => 'LIST',
		'VALUES' => $arSkuView,
	),
	'PROPS_TABS' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('PROPS_TABS'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['ALL'],
		'MULTIPLE' => 'Y',
	),
	'USE_CHEAPER' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('USE_CHEAPER'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'USE_BLOCK_MODS' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('USE_BLOCK_MODS'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'SHOW_PREVIEW_TEXT' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('SHOW_PREVIEW_TEXT'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
    'USE_CUSTOM_COLLECTION' => array(
        'PARENT' => 'DETAIL_SETTINGS',
        'NAME' => GetMessage('USE_CUSTOM_COLLECTION'),
        'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
        'DEFAULT' => 'Y',
        'REFRESH' => 'Y',
    ),
	'PROP_ARTICLE' => array(
        'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('PROP_ARTICLE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'USE_DELIVERY_COST_BLOCK' => array(
        'PARENT' => 'DETAIL_SETTINGS',
        'NAME' => GetMessage('USE_DELIVERY_COST_BLOCK'),
        'TYPE' => 'CHECKBOX',
        'VALUE' => 'Y',
        'DEFAULT' => 'N',
		'REFRESH' => 'Y',
    ),
	'USE_DELIVERY_COST_TAB' => array(
        'PARENT' => 'DETAIL_SETTINGS',
        'NAME' => GetMessage('USE_DELIVERY_COST_TAB'),
        'TYPE' => 'CHECKBOX',
        'VALUE' => 'Y',
        'DEFAULT' => 'N',
	),
	'PROP_BRAND' => array(
        'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('PROP_BRAND'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['HL'],
		'REFRESH' => 'Y',
	),
	'PROP_PRICES_NOTE' => array(
        'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('PROP_PRICES_NOTE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['S'],
	),
	'OFF_BUY1CLICK' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('OFF_BUY1CLICK'),
		'TYPE' => 'CHECKBOX',
        'VALUE' => 'Y',
        'DEFAULT' => 'N',
	),
	'USE_SHARE' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('USE_SHARE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'SOC_SHARE_ICON' => array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('SOC_SHARE_ICON'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $arShareBlock,
	),
	// filter
	'FILTER_PROP_SCROLL' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => GetMessage('FILTER_PROP_SCROLL'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $listProp['ALL'],
	),
	'FILTER_PROP_SEARCH' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => GetMessage('FILTER_PROP_SEARCH'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $listProp['ALL'],
	),
	'FILTER_FIXED' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => GetMessage('FILTER_FIXED'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
	'FILTER_USE_AJAX' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => GetMessage('FILTER_USE_AJAX'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
    'FILTER_HIDE_PROP_COUNT' => array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => GetMessage('FILTER_HIDE_PROP_COUNT'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
    // bigdata
    'USE_BIG_DATA' => array(
		'PARENT' => 'BIG_DATA_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_USE_BIG_DATA'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		'REFRESH' => 'Y',
	),
);

/* if offers IBLOCK_ID */
if (IntVal($arCatalog["OFFERS_IBLOCK_ID"])) {
	$listProp2 = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCatalog['OFFERS_IBLOCK_ID']);
	$arTemplateParameters['PROP_SKU_MORE_PHOTO'] = array(
		'NAME' => GetMessage('PROP_SKU_MORE_PHOTO'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['F'],
	);
	$arTemplateParameters['PROP_SKU_ARTICLE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
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
	$arTemplateParameters['FILTER_SKU_PROP_SCROLL'] = array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => GetMessage('FILTER_SKU_PROP_SCROLL'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $listProp2['ALL'],
	);
	$arTemplateParameters['FILTER_SKU_PROP_SEARCH'] = array(
		'PARENT' => 'FILTER_SETTINGS',
		'NAME' => GetMessage('FILTER_SKU_PROP_SEARCH'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $listProp2['ALL'],
	);
}

/* collections */
if (!isset($arCurrentValues['USE_CUSTOM_COLLECTION']) || $arCurrentValues['USE_CUSTOM_COLLECTION'] == 'Y') {
    $arTemplateParameters['CUSTOM_COLLECTION_PROPERTY'] = array(
        'PARENT' => 'DETAIL_SETTINGS',
        'NAME' => GetMessage('CUSTOM_COLLECTION_PROPERTY'),
        'TYPE' => 'LIST',
        'VALUES' => $listProp['E']
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

/* catalog.section */
if (!isset($arCurrentValues['USE_STORE']) || $arCurrentValues['USE_STORE'] == 'Y') {
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
	$arTemplateParameters['PROP_STORE_REPLACE_DETAIL'] = array(
        'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('PROP_STORE_REPLACE_DETAIL'),
        'TYPE' => 'LIST',
        'VALUES' => array_merge(array(GetMessage('PROP_STORE_REPLACE_EMPTY')), $listProp['ALL'])
    );
}
/* ajaxpages */
if (empty($arCurrentValues['USE_AUTO_AJAXPAGES']) || $arCurrentValues['USE_AUTO_AJAXPAGES'] != 'Y') {
	$arTemplateParameters['HIDE_AJAXPAGES_LINK'] = array(
		'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('HIDE_AJAXPAGES_LINK'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
    );
}

/* detail */
if ($arCurrentValues['USE_BLOCK_MODS'] == 'Y') {
	$arTemplateParameters['PROP_MODS_ARTICLE'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('PROP_MODS_ARTICLE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['SNL'],
	);
	$arTemplateParameters['MODS_ELEMENT_COUNT'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('MODS_ELEMENT_COUNT'),
		'TYPE' => 'STRING',
		'DEFAULT' => '10',
	);
}

/* catalog.element */
if ($arCurrentValues['USE_DELIVERY_COST_BLOCK'] == 'Y') {
	$arTemplateParameters['DELIVERY_COST_PAY_LINK'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('DELIVERY_COST_PAY_LINK'),
		'TYPE' => 'STRING',
	);
	$arTemplateParameters['DELIVERY_COST_DELIVERY_LINK'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('DELIVERY_COST_DELIVERY_LINK'),
		'TYPE' => 'STRING',
	);
}
if (!empty($arCurrentValues['PROP_BRAND'])) {
	$arTemplateParameters['BRAND_DETAIL_SHOW_LOGO'] = array(
		'PARENT' => 'DETAIL_SETTINGS',
		'NAME' => GetMessage('BRAND_DETAIL_SHOW_LOGO'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y',
	);
	
	if ($arCurrentValues['BRAND_DETAIL_SHOW_LOGO'] == 'Y') {
		$arTemplateParameters['BRAND_IBLOCK_BRANDS'] = array(
			'PARENT' => 'DETAIL_SETTINGS',
			'NAME' => GetMessage('BRAND_IBLOCK_BRANDS'),
			'TYPE' => 'LIST',
			'VALUES' => $arIBlock,
			'REFRESH' => 'Y',
		);

		if (!empty($arCurrentValues['BRAND_IBLOCK_BRANDS'])) {
			$listPropBrand = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCurrentValues['BRAND_IBLOCK_BRANDS']);
			$arTemplateParameters['BRAND_IBLOCK_BRANDS_PROP_BRAND'] = array(
				'PARENT' => 'DETAIL_SETTINGS',
				'NAME' => GetMessage('BRAND_IBLOCK_BRANDS_PROP_BRAND'),
				'TYPE' => 'LIST',
				'VALUES' => $listPropBrand['HL'],
			);
		}
	}
}

/* review */
if (!isset($arCurrentValues['USE_REVIEW']) || $arCurrentValues['USE_REVIEW'] == 'Y') {
	$arTemplateParameters['DETAIL_REVIEW_SHOW_COUNT'] = array(
		'PARENT' => 'REVIEW_SETTINGS',
		'NAME' => GetMessage('DETAIL_REVIEW_SHOW_COUNT'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	);
}

/* bigdata */
if (!isset($arCurrentValues['USE_BIG_DATA']) || $arCurrentValues['USE_BIG_DATA'] == 'Y') {
	$rcmTypeList = array(
		'bestsell' => GetMessage('CP_BC_TPL_RCM_BESTSELLERS'),
		'personal' => GetMessage('CP_BC_TPL_RCM_PERSONAL'),
		'similar_sell' => GetMessage('CP_BC_TPL_RCM_SOLD_WITH'),
		'similar_view' => GetMessage('CP_BC_TPL_RCM_VIEWED_WITH'),
		'similar' => GetMessage('CP_BC_TPL_RCM_SIMILAR'),
		'any_similar' => GetMessage('CP_BC_TPL_RCM_SIMILAR_ANY'),
		'any_personal' => GetMessage('CP_BC_TPL_RCM_PERSONAL_WBEST'),
		'any' => GetMessage('CP_BC_TPL_RCM_RAND')
	);
	$arTemplateParameters['BIG_DATA_RCM_TYPE'] = array(
		'PARENT' => 'BIG_DATA_SETTINGS',
		'NAME' => GetMessage('CP_BC_TPL_BIG_DATA_RCM_TYPE'),
		'TYPE' => 'LIST',
		'VALUES' => $rcmTypeList
	);
	$arTemplateParameters['BIG_DATA_ELEMENT_COUNT'] = array(
		'PARENT' => 'BIG_DATA_SETTINGS',
		'NAME' => GetMessage('BIG_DATA_ELEMENT_COUNT'),
		'TYPE' => 'STRING',
		'DEFAULT' => 10,
	);
	unset($rcmTypeList);
}

/* search */
$arTemplateParameters['SEARCH_PAGE_RESULT_COUNT'] = array(
	'PARENT' => 'SEARCH_SETTINGS',
	'NAME' => GetMessage("RS_GOPRO_CP_BC_TPL_SEARCH_PAGE_RESULT_COUNT"),
	"TYPE" => "STRING",
	"DEFAULT" => "50",
);
$arTemplateParameters['SEARCH_RESTART'] = array(
	'PARENT' => 'SEARCH_SETTINGS',
	'NAME' => GetMessage("RS_GOPRO_CP_BC_TPL_SEARCH_RESTART"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "N",
);
$arTemplateParameters['SEARCH_NO_WORD_LOGIC'] = array(
	'PARENT' => 'SEARCH_SETTINGS',
	'NAME' => GetMessage("RS_GOPRO_CP_BC_TPL_SEARCH_NO_WORD_LOGIC"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
$arTemplateParameters['SEARCH_USE_LANGUAGE_GUESS'] = array(
	'PARENT' => 'SEARCH_SETTINGS',
	'NAME' => GetMessage("RS_GOPRO_CP_BC_TPL_SEARCH_USE_LANGUAGE_GUESS"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
$arTemplateParameters['SEARCH_CHECK_DATES'] = array(
	'PARENT' => 'SEARCH_SETTINGS',
	'NAME' => GetMessage("RS_GOPRO_CP_BC_TPL_SEARCH_CHECK_DATES"),
	"TYPE" => "CHECKBOX",
	"DEFAULT" => "Y",
);
