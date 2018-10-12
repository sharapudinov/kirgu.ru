<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader;
use Bitrix\Main\ModuleManager;
use Bitrix\Iblock;
use Bitrix\Currency;

global $USER_FIELD_MANAGER;

if (!Loader::includeModule('iblock'))
	return;

if (!Loader::includeModule('catalog'))
	return;

if (!Loader::includeModule('redsign.devfunc'))
	return;

$listProp = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCurrentValues['IBLOCK_ID']);
$listPropCatalog = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCurrentValues['CATALOG_IBLOCK_ID']);
$arCatalog = CCatalog::GetByID($arCurrentValues['CATALOG_IBLOCK_ID']);

$arIBlock = array();
$rsIBlock = CIBlock::GetList(array("sort" => "asc"), array("ACTIVE"=>"Y"));
while ($arr=$rsIBlock->Fetch()) {
	$arIBlock[$arr["ID"]] = "[".$arr["ID"]."] ".$arr["NAME"];
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

/****************************/
$catalogIncluded = Loader::includeModule('catalog');


$IBLOCK_ID = $arCurrentValues['IBLOCK_ID'];
$arProperty = array();
if (intval($IBLOCK_ID) > 0) {
	$rsProp = CIBlockProperty::GetList(Array('sort' => 'asc', 'name' => 'asc'), Array('IBLOCK_ID' => $IBLOCK_ID, 'ACTIVE' => 'Y'));
	while ($arr = $rsProp->Fetch()) {
		$arProperty[$arr['CODE']] = '['.$arr['CODE'].'] '.$arr['NAME'];
	}
}

$iblocCatalogkExists = (!empty($arCurrentValues['CATALOG_IBLOCK_ID']) && (int)$arCurrentValues['CATALOG_IBLOCK_ID'] > 0);

$arIBlockType = CIBlockParameters::GetIBlockTypes();

$arIBlock = array();
$iblockFilter = (
	!empty($arCurrentValues['CATALOG_IBLOCK_TYPE'])
	? array('TYPE' => $arCurrentValues['CATALOG_IBLOCK_TYPE'], 'ACTIVE' => 'Y')
	: array('ACTIVE' => 'Y')
);
$rsIBlock = CIBlock::GetList(array('SORT' => 'ASC'), $iblockFilter);
while ($arr = $rsIBlock->Fetch())
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
unset($arr, $rsIBlock, $iblockFilter);

$arCatalogProperty = array();
$arCatalogProperty_N = array();
$arCatalogProperty_X = array();
$arCatalogProperty_F = array();
if ($iblocCatalogkExists)
{
	$propertyIterator = Iblock\PropertyTable::getList(array(
		'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE'),
		'filter' => array('=IBLOCK_ID' => $arCurrentValues['CATALOG_IBLOCK_ID'], '=ACTIVE' => 'Y'),
		'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
	));
	while ($property = $propertyIterator->fetch())
	{
		$propertyCode = (string)$property['CODE'];
		if ($propertyCode == '')
			$propertyCode = $property['ID'];
		$propertyName = '['.$propertyCode.'] '.$property['NAME'];
        
		if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
		{
			$arCatalogProperty[$propertyCode] = $propertyName;

			if ($property['MULTIPLE'] == 'Y')
				$arCatalogProperty_X[$propertyCode] = $propertyName;
			elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_LIST)
				$arCatalogProperty_X[$propertyCode] = $propertyName;
			elseif ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_ELEMENT && (int)$property['LINK_IBLOCK_ID'] > 0)
				$arCatalogProperty_X[$propertyCode] = $propertyName;
		}
		else
		{
            $arCatalogProperty_F[$propertyCode] = $propertyName;
		}

		if ($property['PROPERTY_TYPE'] == Iblock\PropertyTable::TYPE_NUMBER)
			$arCatalogProperty_N[$propertyCode] = $propertyName;
	}
	unset($propertyCode, $propertyName, $property, $propertyIterator);
}
$arCatalogProperty_LNS = $arCatalogProperty;

$arUserFields_S = array("-"=>" ");
$arUserFields_F = array("-"=>" ");
if ($iblocCatalogkExists)
{
	$arUserFields = $USER_FIELD_MANAGER->GetUserFields('IBLOCK_'.$arCurrentValues['CATALOG_IBLOCK_ID'].'_SECTION', 0, LANGUAGE_ID);
	foreach ($arUserFields as $FIELD_NAME => $arUserField)
	{
		$arUserField['LIST_COLUMN_LABEL'] = (string)$arUserField['LIST_COLUMN_LABEL'];
		$arCatalogProperty_UF[$FIELD_NAME] = $arUserField['LIST_COLUMN_LABEL'] ? '['.$FIELD_NAME.']'.$arUserField['LIST_COLUMN_LABEL'] : $FIELD_NAME;
		if ($arUserField["USER_TYPE"]["BASE_TYPE"] == "string")
			$arUserFields_S[$FIELD_NAME] = $arCatalogProperty_UF[$FIELD_NAME];
		if ($arUserField["USER_TYPE"]["BASE_TYPE"] == "file" && $arUserField['MULTIPLE'] == 'N')
			$arUserFields_F[$FIELD_NAME] = $arCatalogProperty_UF[$FIELD_NAME];
	}
	unset($arUserFields);
}

$offers = false;
$arCatalogProperty_Offers = array();
$arCatalogProperty_OffersWithoutFile = array();
if ($catalogIncluded && $iblocCatalogkExists)
{
	$offers = CCatalogSKU::GetInfoByProductIBlock($arCurrentValues['CATALOG_IBLOCK_ID']);
	if (!empty($offers))
	{
		$propertyIterator = Iblock\PropertyTable::getList(array(
			'select' => array('ID', 'IBLOCK_ID', 'NAME', 'CODE', 'PROPERTY_TYPE', 'MULTIPLE', 'LINK_IBLOCK_ID', 'USER_TYPE'),
			'filter' => array('=IBLOCK_ID' => $offers['IBLOCK_ID'], '=ACTIVE' => 'Y', '!=ID' => $offers['SKU_PROPERTY_ID']),
			'order' => array('SORT' => 'ASC', 'NAME' => 'ASC')
		));
		while ($property = $propertyIterator->fetch())
		{
			$propertyCode = (string)$property['CODE'];
			if ($propertyCode == '')
				$propertyCode = $property['ID'];
			$propertyName = '['.$propertyCode.'] '.$property['NAME'];

			$arCatalogProperty_Offers[$propertyCode] = $propertyName;
			if ($property['PROPERTY_TYPE'] != Iblock\PropertyTable::TYPE_FILE)
				$arCatalogProperty_OffersWithoutFile[$propertyCode] = $propertyName;
		}
		unset($propertyCode, $propertyName, $property, $propertyIterator);
	}
}

$arSort = CIBlockParameters::GetElementSortFields(
	array('SHOWS', 'SORT', 'TIMESTAMP_X', 'NAME', 'ID', 'ACTIVE_FROM', 'ACTIVE_TO'),
	array('KEY_LOWERCASE' => 'Y')
);

$arPrice = array();
if ($catalogIncluded)
{
	$arSort = array_merge($arSort, CCatalogIBlockParameters::GetCatalogSortFields());
	$arPrice = CCatalogIBlockParameters::getPriceTypesList();
}
else
{
	$arPrice = $arCatalogProperty_N;
}

$arAscDesc = array(
	"asc" => GetMessage("IBLOCK_SORT_ASC"),
	"desc" => GetMessage("IBLOCK_SORT_DESC"),
);

$defaultListValues = array('-' => getMessage('RS_SLINE.UNDEFINED'));
/****************************/

$arTemplateParameters = array(
    // base
    'ACTIONS_PAGE' => array(
        'PARENT' => 'BASE',
        'NAME' => GetMessage('ACTIONS_PAGE'),
        'TYPE' => 'STRING',
    ),
	'ACTION_CODE' => array(
        'PARENT' => 'BASE',
		'NAME' => GetMessage('ACTION_CODE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['HL'],
	),
	'SECTIONS_CODE' => array(
        'PARENT' => 'BASE',
		'NAME' => GetMessage('SECTIONS_CODE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['ALL'],
	),
	'CATALOG_IBLOCK_ID' => array(
        'PARENT' => 'BASE',
		'NAME' => GetMessage('CATALOG_IBLOCK_ID'),
		'TYPE' => 'LIST',
		'ADDITIONAL_VALUES' => 'Y',
		'VALUES' => $arIBlock,
		'REFRESH' => 'Y',
	),
	'CATALOG_ACTION_CODE' => array(
		'PARENT' => 'BASE',
		'NAME' => GetMessage('CATALOG_ACTION_CODE'),
		'TYPE' => 'LIST',
		'VALUES' => $listPropCatalog['HL'],
	),
    // additional
    'PROP_MORE_PHOTO' => array(
		'NAME' => GetMessage('PROP_MORE_PHOTO'),
		'TYPE' => 'LIST',
		'VALUES' => $listPropCatalog['F'],
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
	'SOC_SHARE_ICON' => array(
		'NAME' => GetMessage('SOC_SHARE_ICON'),
		'TYPE' => 'LIST',
		'MULTIPLE' => 'Y',
		'VALUES' => $arShareBlock,
	),
	'OFF_MEASURE_RATION' => array(
		'NAME' => GetMessage('OFF_MEASURE_RATION'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
	'ADD_STYLES_FOR_MAIN' => array(
		'NAME' => GetMessage('ADD_STYLES_FOR_MAIN'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
	'COL_XS_6' => array(
        'PARENT' => 'LIST_SETTINGS',
		'NAME' => GetMessage('COL_XS_6'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
	),
    // 
	'SHOW_BOTTOM_SECTIONS' => array(
		'NAME' => GetMessage('SHOW_BOTTOM_SECTIONS'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
	),
	'COUNT_ITEMS' => array(
		'NAME' => GetMessage('COUNT_ITEMS'),
		'TYPE' => 'STRING',
		'DEFAULT' => '0',
	),
);

if (isset($arCurrentValues['CATALOG_IBLOCK_ID']) && (int)$arCurrentValues['CATALOG_IBLOCK_ID'] > 0)
{
    // section
    $arTemplateParameters["CATALOG_PROPERTY_CODE"] = array(
        "PARENT" => "VISUAL",
        "NAME" => GetMessage("CATALOG_PROPERTY_CODE"),
        "TYPE" => "LIST",
        "MULTIPLE" => "Y",
        "ADDITIONAL_VALUES" => "Y",
        "VALUES" => $arCatalogProperty_LNS,
	);
    // filter
	$arTemplateParameters["CATALOG_FILTER_NAME"] = array(
        "PARENT" => "FILTER_SETTINGS",
        "NAME" => GetMessage("CATALOG_FILTER_NAME"),
        "TYPE" => "STRING",
        "DEFAULT" => "",
	);
	$arTemplateParameters["PRICE_CODE"] = array(
        "PARENT" => "PRICES",
        "NAME" => GetMessage("IBLOCK_PRICE_CODE"),
        "TYPE" => "LIST",
        "MULTIPLE" => "Y",
        "VALUES" => $arPrice,
	);
	$arTemplateParameters["USE_PRICE_COUNT"] = array(
        "PARENT" => "PRICES",
        "NAME" => GetMessage("IBLOCK_USE_PRICE_COUNT"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
	);
	$arTemplateParameters["SHOW_PRICE_COUNT"] = array(
        "PARENT" => "PRICES",
        "NAME" => GetMessage("IBLOCK_SHOW_PRICE_COUNT"),
        "TYPE" => "STRING",
        "DEFAULT" => "1"
	);
	$arTemplateParameters["PRICE_VAT_INCLUDE"] = array(
        "PARENT" => "PRICES",
        "NAME" => GetMessage("IBLOCK_VAT_INCLUDE"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
	);
	$arTemplateParameters["PRICE_VAT_SHOW_VALUE"] = array(
        "PARENT" => "PRICES",
        "NAME" => GetMessage("IBLOCK_VAT_SHOW_VALUE"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
	);
	$arTemplateParameters["BASKET_URL"] = array(
        "PARENT" => "BASKET",
        "NAME" => GetMessage("IBLOCK_BASKET_URL"),
        "TYPE" => "STRING",
        "DEFAULT" => "/personal/cart/",
	);
	$arTemplateParameters["ACTION_VARIABLE"] = array(
        "PARENT" => "ACTION_SETTINGS",
        "NAME"		=> GetMessage("IBLOCK_ACTION_VARIABLE"),
        "TYPE"		=> "STRING",
        "DEFAULT"	=> "action"
	);
	$arTemplateParameters["PRODUCT_ID_VARIABLE"] = array(
        "PARENT" => "ACTION_SETTINGS",
        "NAME"		=> GetMessage("IBLOCK_PRODUCT_ID_VARIABLE"),
        "TYPE"		=> "STRING",
        "DEFAULT"	=> "id"
	);
	$arTemplateParameters["USE_PRODUCT_QUANTITY"] = array(
        "PARENT" => "BASKET",
        "NAME" => GetMessage("CP_BC_USE_PRODUCT_QUANTITY"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
        "REFRESH" => "Y",
	);
	$arTemplateParameters["PRODUCT_QUANTITY_VARIABLE"] = array(
        "PARENT" => "BASKET",
        "NAME" => GetMessage("CP_BC_PRODUCT_QUANTITY_VARIABLE"),
        "TYPE" => "STRING",
        "DEFAULT" => "quantity",
        "HIDDEN" => (isset($arCurrentValues['USE_PRODUCT_QUANTITY']) && $arCurrentValues['USE_PRODUCT_QUANTITY'] == 'Y' ? 'N' : 'Y')
	);
	$arTemplateParameters["PRODUCT_SUBSCRIPTION"] = array(
        'PARENT' => 'VISUAL',
        'NAME' => GetMessage('CP_BC_TPL_PRODUCT_SUBSCRIPTION'),
        'TYPE' => 'CHECKBOX',
        'DEFAULT' => 'N',
	);
	$arTemplateParameters["CATALOG_TEMPLATE_AJAXID"] = array(
		'PARENT' => 'PAGER_SETTINGS',
		'NAME' => getMessage('RS_SLINE.CATALOG_TEMPLATE_AJAXID'),
		'TYPE' => 'STRING',
		'DEFAULT' => 'ajaxpages_catalog_identifier',
	);
	$arTemplateParameters["CATALOG_USE_AJAXPAGES"] = array(
		'PARENT' => 'PAGER_SETTINGS',
		'NAME' => getMessage('RS_SLINE.CATALOG_USE_AJAXPAGES'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	);
	$arTemplateParameters["USE_COMPARE"] = array(
        "PARENT" => "COMPARE_SETTINGS",
        "NAME" => GetMessage("T_IBLOCK_DESC_USE_COMPARE_EXT"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
        "REFRESH" => "Y",
	);
    $arTemplateParameters["USE_STORE"] = array(
        "PARENT" => "COMPARE_SETTINGS",
        "NAME" => GetMessage("T_IBLOCK_DESC_USE_STORE"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
        "REFRESH" => "Y",
	);
	$arTemplateParameters["SECTION_COUNT_ELEMENTS"] = array(
        "PARENT" => "SECTIONS_SETTINGS",
        "NAME" => GetMessage('CP_BC_SECTION_COUNT_ELEMENTS'),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y",
	);
	$arTemplateParameters["SECTION_TOP_DEPTH"] = array(
        "PARENT" => "SECTIONS_SETTINGS",
        "NAME" => GetMessage('CP_BC_SECTION_TOP_DEPTH'),
        "TYPE" => "STRING",
        "DEFAULT" => "2",
	);
	$arTemplateParameters["USE_MAIN_ELEMENT_SECTION"] = array(
        "PARENT" => "ADDITIONAL_SETTINGS",
        "NAME" => GetMessage("CP_BC_USE_MAIN_ELEMENT_SECTION"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
	);
	$arTemplateParameters["SECTION_ID_VARIABLE"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME"		=> GetMessage("IBLOCK_SECTION_ID_VARIABLE"),
        "TYPE"		=> "STRING",
        "DEFAULT"	=> "SECTION_ID"
	);
	$arTemplateParameters["SHOW_DEACTIVATED"] = array(
        "PARENT" => "DETAIL_SETTINGS",
        "NAME" => GetMessage('CP_BC_SHOW_DEACTIVATED'),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N"
	);
	$arTemplateParameters["SET_LAST_MODIFIED"] = array(
        "PARENT" => "ADDITIONAL_SETTINGS",
        "NAME" => GetMessage("CP_BC_SET_LAST_MODIFIED"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "N",
	);
	$arTemplateParameters["ADD_SECTIONS_CHAIN"] = array(
        "PARENT" => "ADDITIONAL_SETTINGS",
        "NAME" => GetMessage("CP_BC_ADD_SECTIONS_CHAIN"),
        "TYPE" => "CHECKBOX",
        "DEFAULT" => "Y"
	);
	$arTemplateParameters["ERROR_EMPTY_ITEMS"] = array(
        'PARENT' => 'VISUAL',
        'NAME' => getMessage('RS_SLINE.ERROR_EMPTY_ITEMS'),
        'TYPE' => 'CHECKBOX',
        'VALUE' => 'Y',
        'DEFAULT' => 'N',
	);
}

if ($arCurrentValues["USE_COMPARE"] == "Y") {
	$arTemplateParameters["COMPARE_NAME"] = array(
		"PARENT" => "COMPARE_SETTINGS",
		"NAME" => GetMessage("IBLOCK_COMPARE_NAME"),
		"TYPE" => "STRING",
		"DEFAULT" => "CATALOG_COMPARE_LIST"
	);
}

if ($catalogIncluded) {
	$arTemplateParameters['HIDE_NOT_AVAILABLE'] = array(
		'PARENT' => 'DATA_SOURCE',
		'NAME' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_EXT2'),
		'TYPE' => 'LIST',
		'DEFAULT' => 'N',
		'VALUES' => array(
			'Y' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_HIDE'),
			'L' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_LAST'),
			'N' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_SHOW')
		),
		'ADDITIONAL_VALUES' => 'N'
	);
	$arTemplateParameters['HIDE_NOT_AVAILABLE_OFFERS'] = array(
		'PARENT' => 'DATA_SOURCE',
		'NAME' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_OFFERS'),
		'TYPE' => 'LIST',
		'DEFAULT' => 'N',
		'VALUES' => array(
			'Y' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_OFFERS_HIDE'),
			'L' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_OFFERS_SUBSCRIBE'),
			'N' => GetMessage('CP_BC_HIDE_NOT_AVAILABLE_OFFERS_SHOW')
		)
	);

	$arTemplateParameters['CONVERT_CURRENCY'] = array(
		'NAME' => GetMessage('CP_BC_CONVERT_CURRENCY'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'N',
		'REFRESH' => 'Y',
	);

	if (isset($arCurrentValues['CONVERT_CURRENCY']) && $arCurrentValues['CONVERT_CURRENCY'] == 'Y')
	{
		$arTemplateParameters['CURRENCY_ID'] = array(
			'NAME' => GetMessage('CP_BC_CURRENCY_ID'),
			'TYPE' => 'LIST',
			'VALUES' => Currency\CurrencyManager::getCurrencyList(),
			'DEFAULT' => Currency\CurrencyManager::getBaseCurrency(),
			"ADDITIONAL_VALUES" => "Y",
		);
	}
}

if (IntVal($arCatalog["OFFERS_IBLOCK_ID"])) {
    // offers 2
    $arTemplateParameters["CATALOG_OFFERS_FIELD_CODE"] = CIBlockParameters::GetFieldCode(GetMessage("CP_BC_LIST_OFFERS_FIELD_CODE"), "VISUAL");
	$arTemplateParameters["CATALOG_OFFERS_PROPERTY_CODE"] = array(
		"PARENT" => "VISUAL",
		"NAME" => GetMessage("CP_BC_LIST_OFFERS_PROPERTY_CODE"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arCatalogProperty_Offers,
		"ADDITIONAL_VALUES" => "Y",
	);
	$arTemplateParameters["CATALOG_OFFERS_LIMIT"] = array(
		"PARENT" => "VISUAL",
		"NAME" => GetMessage("CP_BC_LIST_OFFERS_LIMIT"),
		"TYPE" => "STRING",
		"DEFAULT" => 5,
	);
	/*$arTemplateParameters["OFFERS_CART_PROPERTIES"] = array(
		"NAME" => GetMessage("CP_BC_OFFERS_CART_PROPERTIES"),
		"TYPE" => "LIST",
		"MULTIPLE" => "Y",
		"VALUES" => $arProperty_OffersWithoutFile,
		"HIDDEN" => (isset($arCurrentValues['ADD_PROPERTIES_TO_BASKET']) && $arCurrentValues['ADD_PROPERTIES_TO_BASKET'] == 'N' ? 'Y' : 'N')
	);*/
	$arTemplateParameters["OFFERS_SORT_FIELD"] = array(
		"NAME" => GetMessage("CP_BC_OFFERS_SORT_FIELD"),
		"TYPE" => "LIST",
		"VALUES" => $arSort,
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT" => "sort",
	);
	$arTemplateParameters["OFFERS_SORT_ORDER"] = array(
		"NAME" => GetMessage("CP_BC_OFFERS_SORT_ORDER"),
		"TYPE" => "LIST",
		"VALUES" => $arAscDesc,
		"DEFAULT" => "asc",
		"ADDITIONAL_VALUES" => "Y",
	);
	$arTemplateParameters["OFFERS_SORT_FIELD2"] = array(
		"NAME" => GetMessage("CP_BC_OFFERS_SORT_FIELD2"),
		"TYPE" => "LIST",
		"VALUES" => $arSort,
		"ADDITIONAL_VALUES" => "Y",
		"DEFAULT" => "id",
	);
	$arTemplateParameters["OFFERS_SORT_ORDER2"] = array(
		"NAME" => GetMessage("CP_BC_OFFERS_SORT_ORDER2"),
		"TYPE" => "LIST",
		"VALUES" => $arAscDesc,
		"DEFAULT" => "desc",
		"ADDITIONAL_VALUES" => "Y",
	);
    // offers
	$listProp2 = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCatalog['OFFERS_IBLOCK_ID']);
	$arTemplateParameters['PROP_SKU_MORE_PHOTO'] = array(
		'NAME' => GetMessage('PROP_SKU_MORE_PHOTO'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['F'],
	);
	$arTemplateParameters['PROP_ARTICLE'] = array(
		'NAME' => GetMessage('PROP_ARTICLE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp2['SNL'],
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
if ($catalogIncluded && $arCurrentValues["USE_STORE"] == 'Y') {
	$arTemplateParameters['USE_MIN_AMOUNT'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('USE_MIN_AMOUNT'),
		'TYPE' => 'CHECKBOX',
		'DEFAULT' => 'Y',
		"REFRESH" => "Y",
	);
	if ($arCurrentValues['USE_MIN_AMOUNT'] != "N") {
		$arTemplateParameters["MIN_AMOUNT"] = array(
            "PARENT" => "STORE_SETTINGS",
            "NAME" => GetMessage("MIN_AMOUNT"),
            "TYPE" => "STRING",
            "DEFAULT" => 10,
        );
	}
	$arTemplateParameters['MAIN_TITLE'] = array(
		'PARENT' => 'STORE_SETTINGS',
		'NAME' => GetMessage('MAIN_TITLE'),
		"TYPE" => "STRING",
		"DEFAULT" => GetMessage('MAIN_TITLE_VALUE'),
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
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'N',
    );
}
