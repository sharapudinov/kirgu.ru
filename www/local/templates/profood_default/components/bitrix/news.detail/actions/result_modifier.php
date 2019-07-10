<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

if (!CModule::IncludeModule('iblock'))
	return;

$vse_rassrochki= [
    "PROPERTY_AKTSII" => [
        '1eafd29f-9b38-11e9-a9e0-0050568b168f',
        '4d854d17-9b34-11e9-a9e0-0050568b168f',
        '9d7eaf29-5486-11e9-a9d0-0050568b168f'
    ]
];

$arResult['SECTIONS'] = array();
if($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'])
    $filter= array(
        'IBLOCK_ID'=> $arParams['CATALOG_IBLOCK_ID'],
            'PROPERTY_'.$arParams['CATALOG_ACTION_CODE']=>$arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'],
        'ACTIVE' =>'Y',
        'CATALOG_AVAILABLE' =>'Y'
    );
elseif($arResult['PROPERTIES'][$arParams['RASSROCHKA_CODE']]['VALUE'])
    $filter= array(
        'IBLOCK_ID'=> $arParams['CATALOG_IBLOCK_ID'],
        'PROPERTY_'.$arParams['CATALOG_RASSROCHKA_CODE']=>$arResult['PROPERTIES'][$arParams['RASSROCHKA_CODE']]['VALUE'],
        'ACTIVE' =>'Y',
        'CATALOG_AVAILABLE' =>'Y'
    );

if ($arParams['isRassrochka']){
    $filter=$vse_rassrochki;
}

$obEl=CIBlockElement::GetList(
    array(),
   $filter,
    false,
    false,
    array('ID','IBLOCK_ID','IBLOCK_SECTION_ID', 'PROPERTY_'.$arParams['CATALOG_ACTION_CODE'],'NAME')
);
while($el=$obEl->GetNext()){
    $arResult['SECTIONS'][] = $el['IBLOCK_SECTION_ID'];
}
$arResult['SECTIONS']=array_unique($arResult['SECTIONS']);


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
		$arResult['ACTION_PROP'] = $arFields;
	}
}
if (($arParams['CATALOG_IBLOCK_ID']) > 0 && $arParams['CATALOG_RASSROCHKA_CODE'] != '') {
	$arOrder = array('SORT' => 'ASC','ID' => 'DESC');
	$arFilter = array('ACTIVE' => 'Y', 'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'], 'CODE' => $arParams['CATALOG_RASSROCHKA_CODE']);
	$propRes = CIBlockProperty::GetList($arOrder, $arFilter);
	if ($arFields = $propRes->GetNext()) {
		$arResult['RASSROCHKA_PROP'] = $arFields;
	}
}

    if ($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'] ) {
        $arResult['FILTER_CONTROL_NAME'] = htmlspecialcharsbx('filter/'.strtolower($arResult['ACTION_PROP']['CODE']).'-is-'.$arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE']).'/apply/';
    }

    if ($arResult['PROPERTIES'][$arParams['RASSROCHKA_CODE']]['VALUE']) {
        $arResult['FILTER_CONTROL_NAME'] = htmlspecialcharsbx('filter/'.strtolower($arResult['RASSROCHKA_PROP']['CODE']).'-is-'.$arResult['PROPERTIES'][$arParams['RASSROCHKA_CODE']]['VALUE']).'/apply/';
    }

if (!empty($arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'])||$arResult['PROPERTIES'][$arParams['RASSROCHKA_CODE']]['VALUE']) {
    $arResult['CATALOG_FILTER'] = array();

    if ($arParams['isRassrochka']){
        $arrrfilter =  $vse_rassrochki;
    } else  $arrrfilter = [
            "=PROPERTY_" . $arResult['ACTION_PROP']['ID']     => $arResult['PROPERTIES'][$arParams['ACTION_CODE']]['VALUE'],
            "=PROPERTY_" . $arResult['RASSROCHKA_PROP']['ID'] => $arResult['PROPERTIES'][$arParams['RASSROCHKA_CODE']]['VALUE']

        ];

    $this->__component->arResult["CATALOG_FILTER"] =array_merge($arResult['CATALOG_FILTER'],$arrrfilter);
}



$this->__component->SetResultCacheKeys(array("CATALOG_FILTER"));
