<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;

if (!Loader::includeModule('iblock'))
	return;

if (is_array($arResult) && count($arResult) > 0 && intval($arParams['IBLOCK_ID']) > 0) {

	////////////////////////////////// get section detail pictures //////////////////////////////////
	if (intval($arParams["IBLOCK_ID"]) > 0) {
		$arTmpSections = array();
		$arFilter = array(
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'GLOBAL_ACTIVE' => 'Y',
			'IBLOCK_ACTIVE' => 'Y',
		);
		$arOrder = array(
			'left_margin' => 'asc',
		);
		$arSelect = array(
			'ID',
			'DEPTH_LEVEL',
			'NAME',
			'SECTION_PAGE_URL',
			'DETAIL_PICTURE',
		);

		$rsSections = \CIBlockSection::GetList($arOrder, $arFilter, false, $arSelect);
		if ($arParams['IS_SEF'] !== 'Y')
			$rsSections->SetUrlTemplates('', $arParams['SECTION_URL']);
		else
			$rsSections->SetUrlTemplates('', $arParams['SEF_BASE_URL'].$arParams['SECTION_PAGE_URL']);
		while ($arSection = $rsSections->GetNext()) {
			$arTmpSections[$arSection['~SECTION_PAGE_URL']] = $arSection;
		}
	}

	////////////////////////////////// base //////////////////////////////////
	foreach ($arResult as $key => $arItem){
		if (!empty($arTmpSections[$arItem['LINK']])) {
			$arResult[$key]['DETAIL_PICTURE'] = CFile::GetPath($arTmpSections[$arItem['LINK']]['DETAIL_PICTURE']);
		}
	}
}
