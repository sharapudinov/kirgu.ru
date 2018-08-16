<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!CModule::IncludeModule('redsign.devfunc'))
	return;

$maxSizeWidth = 227;
$maxSizeHeight = 171;

// if(empty($arParams["SHOW_COUNT_LVL1"]))
// 	$arParams["SHOW_COUNT_LVL1"] = 8;
// if(IntVal($arParams["SHOW_COUNT_LVL2"])<0)
// 	$arParams["SHOW_COUNT_LVL2"] = 11;

// foreach ($arResult['SECTIONS'] as $key1 => $arSection) {

// 	if (!empty($arSection['PICTURE']['SRC'])) {

// 		$arFileTmp = CFile::ResizeImageGet(
// 			$arSection['PICTURE']['ID'],
// 			array('width' => $maxSizeWidth, 'height' => $maxSizeHeight),
// 			BX_RESIZE_IMAGE_PROPORTIONAL,
// 			true,
// 			array()
// 		);

// 		$arResult['SECTIONS'][$key1]['PICTURE']['SRC'] = $arFileTmp['src'];
// 	}
// }

// $arSizes = array("width" => $maxSizeWidth,"height" => $maxSizeHeight);
// $noPhotoFileID = COption::GetOptionInt('redsign.devfunc', 'no_photo_fileid', 0);
// if ($noPhotoFileID > 0) {
// 	$arResult["NO_PHOTO"] = CFile::ResizeImageGet($noPhotoFileID, $arSizes, BX_RESIZE_IMAGE_PROPORTIONAL);
// }
