<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$strAlt = '';
$strTitle = '';

if (!empty($arItem['DETAIL_PAGE_URL'])) {
    $strAlt = (
        isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"]) && $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"] != ''
        ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_ALT"]
        : (!empty($arItem['PREVIEW_PICTURE']['ALT']) ? $arItem['PREVIEW_PICTURE']['ALT'] : $arItem['NAME'])
    ); 
    $strTitle = (
        isset($arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]) && $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"] != ''
        ? $arItem["IPROPERTY_VALUES"]["ELEMENT_PREVIEW_PICTURE_FILE_TITLE"]
        : (!empty($arItem['PREVIEW_PICTURE']['TITLE']) ? $arItem['PREVIEW_PICTURE']['TITLE'] : $arItem['NAME'])
    );
}

if (!empty($arResult['DETAIL_PAGE_URL'])) {
    $strAlt = (
        isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"] != ''
        ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_ALT"]
        : (!empty($arResult['DETAIL_PICTURE']['ALT']) ? $arResult['DETAIL_PICTURE']['ALT'] : $arResult['NAME'])
    ); 
    $strTitle = (
        isset($arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]) && $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"] != ''
        ? $arResult["IPROPERTY_VALUES"]["ELEMENT_DETAIL_PICTURE_FILE_TITLE"]
        : (!empty($arResult['DETAIL_PICTURE']['TITLE']) ? $arResult['DETAIL_PICTURE']['TITLE'] : $arResult['NAME'])
    );
}
