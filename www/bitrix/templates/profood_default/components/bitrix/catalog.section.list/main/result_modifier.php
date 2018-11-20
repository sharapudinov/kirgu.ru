<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!\Bitrix\Main\Loader::includeModule('redsign.devfunc'))
	return;

$maxSizeWidth = 300;
$maxSizeHeight = 160;

if (empty($arParams['SHOW_COUNT_LVL1']))
	$arParams['SHOW_COUNT_LVL1'] = 8;
if (IntVal($arParams['SHOW_COUNT_LVL2'])<0)
	$arParams['SHOW_COUNT_LVL2'] = 11;

$arSizes = array('width' => $maxSizeWidth, 'height' => $maxSizeHeight);
$noPhotoFileID = \COption::GetOptionInt('redsign.devfunc', 'no_photo_fileid', 0);
if ($noPhotoFileID > 0) {
	$arResult["NO_PHOTO"] = \CFile::ResizeImageGet($noPhotoFileID, $arSizes, BX_RESIZE_IMAGE_PROPORTIONAL);
}
