<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

if (!CModule::IncludeModule('iblock'))
	return;

$arResult['SECTIONS'] = array();

if ($arResult['PROPERTIES'][$arParams['SECTIONS_CODE']]['VALUE'] && is_array($arResult['PROPERTIES'][$arParams['SECTIONS_CODE']]['VALUE'])) {
	foreach ($arResult['PROPERTIES'][$arParams['SECTIONS_CODE']]['VALUE'] as $sect) {
		$arResult['SECTIONS'][] = $sect;
	}
} elseif ($arResult['PROPERTIES'][$arParams['SECTIONS_CODE']]['VALUE']) {
	$arResult['SECTIONS'][] = $arResult['PROPERTIES'][$arParams['SECTIONS_CODE']]['VALUE'];
}

if ($arParams['SECTIONS_CODE'] != '' && is_array($arResult['SECTIONS']) && count($arResult['PROPERTIES'][$arParams['SECTIONS_CODE']]['VALUE']) > 0) {
	$sectionId = $arResult['SECTIONS'][0];
    
	if (IntVal($sectionId) > 0) {
		$res = CIBlockSection::GetByID($sectionId);
		if ($arFileds = $res->GetNext()) {
			$arResult['SECOND_IBLOCK_ID'] = $arFileds['IBLOCK_ID'];
		}
	}
}
if (($arParams['CATALOG_IBLOCK_ID']) > 0 && $arParams['CATALOG_ACTION_CODE'] != '') {
	$arOrder = array('SORT' => 'ASC','ID' => 'DESC');
	$arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'], 'CODE' => $arParams['CATALOG_ACTION_CODE']);
	$propRes = CIBlockProperty::GetList($arOrder, $arFilter);
	if ($arFields = $propRes->GetNext()) {
		$arResult['PROP'] = $arFields;
	}
}
/*if ($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['MULTIPLE'] != 'Y') {
	$arResult['FILTER_CONTROL_NAME'] = htmlspecialcharsbx($arParams['CATALOG_FILTER_NAME'].'_'.$arResult['PROP']['ID'].'_'.abs(crc32($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE']))).'=Y&set_filter=YYY';
} else {
	if (is_array($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE']) && count($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE']) > 0) {
		$arResult['FILTER_CONTROL_NAME'] = '';
		foreach ($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'] as $value) {
			$arResult['FILTER_CONTROL_NAME'] = $arResult['FILTER_CONTROL_NAME'].htmlspecialcharsbx($arParams['CATALOG_FILTER_NAME'].'_'.$arResult['PROP']['ID'].'_'.abs(crc32($value))).'=Y&';
		}
		$arResult['FILTER_CONTROL_NAME'] = $arResult['FILTER_CONTROL_NAME'].'set_filter=YYY';
	}
}*/
if ($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['MULTIPLE'] != 'Y') {
    $arResult['FILTER_CONTROL_NAME'] = htmlspecialcharsbx('filter/'.strtolower($arResult['PROP']['CODE']).'-is-'.$arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE']).'/apply/';
} else {
    if (is_array($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE']) && count($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE']) > 0) {
        $arResult['FILTER_CONTROL_NAME'] .= 'filter/'.htmlspecialcharsbx(strtolower($arParams['ACTION_CODE']).'-is-'.implode('-or-',$arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'])).'/apply/';
    }
}
if (!empty($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'])) {
    $arResult['CATALOG_FILTER'] = array();
    
    $filterKey = "=PROPERTY_".$arResult['PROP']['ID'];
    
    $arResult['CATALOG_FILTER'][$filterKey] = $arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'];
    
    $this->__component->arResult["CATALOG_FILTER"] = $arResult['CATALOG_FILTER']; 
}

$this->__component->SetResultCacheKeys(array("CATALOG_FILTER"));
