<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!\Bitrix\Main\Loader::includeModule('redsign.devfunc'))
	return;

$maxSizeWidth = 300;
$maxSizeHeight = 160;

if (empty($arParams['SHOW_COUNT_LVL1']))
	$arParams['SHOW_COUNT_LVL1'] = 8;
if (IntVal($arParams['SHOW_COUNT_LVL2']) < 0)
	$arParams['SHOW_COUNT_LVL2'] = 11;

$arSizes = array('width' => $maxSizeWidth, 'height' => $maxSizeHeight);
$noPhotoFileID = \COption::GetOptionInt('redsign.devfunc', 'no_photo_fileid', 0);
if ($noPhotoFileID > 0) {
	$arResult["NO_PHOTO"] = \CFile::ResizeImageGet($noPhotoFileID, $arSizes, BX_RESIZE_IMAGE_PROPORTIONAL);
}

if (intval($arParams['IBLOCK_ID']) < 1)
	return;

// get iblock fields
if ($arParams['SHOW_IBLOCK_DESCRIPTION'] == 'Y') {
$res = \CIBlock::GetByID($arParams['IBLOCK_ID']);
	if ($arFields = $res->GetNext()) {
		$arResult['IBLOCK_FIELDS'] = $arFields;

		$arFileTmp = \CFile::ResizeImageGet(
			$arFields['PICTURE'],
			array('width' => 800, 'height' => 800),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true,
			array()
		);

		$arResult['IBLOCK_FIELDS']['PICTURE'] = $arFileTmp['src'];

		if (empty($arResult['IBLOCK_FIELDS']['DESCRIPTION'])) {
			$arParams['SHOW_IBLOCK_DESCRIPTION'] = 'N';
		}
	}
}

foreach ($arResult['SECTIONS'] as $key1 => $arSection) {

	if (!empty($arSection['PICTURE']['SRC'])) {

		$arFileTmp = \CFile::ResizeImageGet(
			$arSection['PICTURE']['ID'],
			array('width' => $maxSizeWidth, 'height' => $maxSizeHeight),
			BX_RESIZE_IMAGE_PROPORTIONAL,
			true,
			array()
		);

		$arResult['SECTIONS'][$key1]['PICTURE']['SRC'] = $arFileTmp['src'];
	}
}

$arResult['LEVELING'] = array(
	'FIRST_LEVEL' => $arResult["SECTIONS"][0]['DEPTH_LEVEL'],
	'SECOND_LEVEL' => ($arResult["SECTIONS"][0]['DEPTH_LEVEL']+1),
);

if (isset($arResult['SECTION']) && $arResult['SECTION']['DESCRIPTION'] != '') {
	$arSection = $arResult['SECTION'];
	$mxPicture = false;
	$arSection['PICTURE'] = intval($arSection['PICTURE']);
	if (0 < $arSection['PICTURE'])
		$mxPicture = \CFile::GetFileArray($arSection['PICTURE']);
	$arSection['PICTURE'] = $mxPicture;
	if ($arSection['PICTURE']) {
		$arSection['PICTURE']['ALT'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_ALT'];
		if ($arSection['PICTURE']['ALT'] == '')
			$arSection['PICTURE']['ALT'] = $arSection['NAME'];
		$arSection['PICTURE']['TITLE'] = $arSection['IPROPERTY_VALUES']['SECTION_PICTURE_FILE_TITLE'];
		if ($arSection['PICTURE']['TITLE'] == '')
			$arSection['PICTURE']['TITLE'] = $arSection['NAME'];
	}
	$arResult['SECTION'] = $arSection;
}
