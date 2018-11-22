<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/result_modifier.php');

$arResult['SECTIONS'] = array();
$arSectionIds = array();
foreach ($arResult['ITEMS'] as &$arItem) {
    if (!is_array($arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']])) {
        $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']] = array();
        $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'] = array();
    }

    $arResult['SECTIONS'][$arItem['IBLOCK_SECTION_ID']]['ITEMS'][] = &$arItem;
    $arSectionIds[] = $arItem['IBLOCK_SECTION_ID'];
}
unset($arItem);
$dbSections = CIBLockSection::GetTreeList(array(
    'ID' => $arSectionIds
));
while ($arSection = $dbSections->GetNext()) {
    $arResult['SECTIONS'][$arSection['ID']]["NAME"] = $arSection['NAME'];
}
