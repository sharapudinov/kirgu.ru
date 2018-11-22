<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Config\Option;

global $moduleId;

$arParams['GOPRO'] = array(
	'OFF_YANDEX' => Option::get($moduleId, 'off_yandex', 'N'),
	'GOOGLE_API_KEY' => Option::get($moduleId, 'google_api_key', ''),
);

if (!Loader::includeModule('iblock'))
    return;

if (empty($arParams['RSGOPRO_PROP_TYPES']) || empty($arParams['RSGOPRO_PROP_COORD']))
    return;

$arResult['FILTER_TYPES'] = array();
$arFilter = array('IBLOCK_ID' => $arParams['IBLOCK_ID'], 'CODE' => $arParams['RSGOPRO_PROP_TYPES']);
$propertyEnums = CIBlockPropertyEnum::GetList(array(), $arFilter);
while ($arFields = $propertyEnums->GetNext()) {
    $arResult['FILTER_TYPES'][] = array(
		'ID' => $arFields['ID'],
		'VALUE' => $arFields['VALUE'],
		'XML_ID' => $arFields['XML_ID'],
	);
}

foreach ($arResult['ITEMS'] as &$arItem) {
    $arItem['COORDINATES'] = $arItem['PROPERTIES'][$arParams['RSGOPRO_PROP_COORD']]['VALUE'];
    $arItem['TYPE'] = $arItem['PROPERTIES'][$arParams['RSGOPRO_PROP_TYPES']]['VALUE_XML_ID'];
}

unset($arItem);
