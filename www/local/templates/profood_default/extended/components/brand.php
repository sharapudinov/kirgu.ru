<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (empty($arParams['PROP_BRAND']) || empty($arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']))
    return;
?>

<?php if (empty($arResult['RS_GOPRO_BRAND_IMAGE'])): ?>
    <span class="c-brand"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?></span>
<?php else: ?>
    <span class="c-brand is-image"><img <?
        ?>src="<?=$arResult['RS_GOPRO_BRAND_IMAGE']['src']?>" <?
        ?>alt="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?>" <?
        ?>title="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?>"<?
    ?>></span>
<?php endif; ?>
