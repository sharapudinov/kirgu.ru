<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

$maxSizeWidth = 40;
$maxSizeHeight = 40;

if ($arParams['RS_TAB_IDENT'] == '') {
	$arParams['RS_TAB_IDENT'] = 'rsec_thistab_viewed';
	$arParams['ACTION_VAL'] = '';
}
if ($arParams['RS_TAB_IDENT'] == 'rsec_thistab_viewed') {
	$arParams['ACTION_VAL'] = 'RefreshViewed';
} elseif ($arParams['RS_TAB_IDENT'] == 'rsec_thistab_compare') {
	$arParams['ACTION_VAL'] = 'RefreshCompare';
} elseif ($arParams['RS_TAB_IDENT'] == 'rsec_thistab_favorite') {
	$arParams['ACTION_VAL'] = 'RefreshFavorite';
}

if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0) {
	foreach ($arResult['ITEMS'] as $key => $arItem) {
		$arResult['ITEMS'][$key]['PREVIEW_PICTURE']['RESIZE'] = array();
		$arResult['ITEMS'][$key]['PREVIEW_PICTURE']['RESIZE'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE'], array(
			'width' => $maxSizeWidth,
			'height' => $maxSizeHeight
		), BX_RESIZE_IMAGE_PROPORTIONAL_ALT, true);
	}
}

// get no photo
$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIDTH' => $maxSizeWidth, 'MAX_HEIGHT' => $maxSizeHeight));
// /get no photo
