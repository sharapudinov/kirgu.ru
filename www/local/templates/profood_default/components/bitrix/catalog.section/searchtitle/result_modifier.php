<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

if (!CModule::IncludeModule('redsign.devfunc'))
	return;

$maxSizeWidth = 22;
$maxSizeHeight = 14;

// get other data
$params = array(
	'MAX_WIDTH' => $maxSizeWidth,
	'MAX_HEIGHT' => $maxSizeHeight,
);
RSDevFunc::GetDataForProductItem($arResult['ITEMS'],$params);
// /get other data

// get no photo
$arResult['NO_PHOTO'] = RSDevFunc::GetNoPhoto(array('MAX_WIDTH' => $maxSizeWidth, 'MAX_HEIGHT' => $maxSizeHeight));
// /get no photo
