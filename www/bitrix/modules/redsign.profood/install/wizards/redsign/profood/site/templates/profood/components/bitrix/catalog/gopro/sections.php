<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!\Bitrix\Main\Loader::includeModule('redsign.favorite'))
    return;

$this->setFrameMode(true);

$getTemplatePathPartParams = array('SHOW_HELP' => $arParams['CACHE_GROUPS'] == 'Y' ? 'Y' : 'N');

if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/sections.start.php', $getTemplatePathPartParams))) {
    include($path);
}
?>

<?$APPLICATION->IncludeComponent(
    'bitrix:catalog.section.list',
    'gopro',
    array(
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
        'TOP_DEPTH' => $arParams['SECTION_TOP_DEPTH'],
        'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
        'SHOW_IBLOCK_DESCRIPTION' => 'Y',
        'SECTIONS_DESCRIPTION_POSITION' => $arParams['SECTIONS_DESCRIPTION_POSITION'],
    ),
    $component,
    array('HIDE_ICONS' => 'Y')
);?>

<?php
if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/sections.finish.php', $getTemplatePathPartParams))) {
    include($path);
}
