<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (empty($arParams['PROP_BRAND']) || empty($arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']))
    return;
?>

<span class="c-brand"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_BRAND']]['DISPLAY_VALUE']?></span>
