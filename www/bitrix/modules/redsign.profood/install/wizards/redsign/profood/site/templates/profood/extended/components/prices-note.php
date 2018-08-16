<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (empty($arParams['PROP_PRICES_NOTE']) || empty($arItem['DISPLAY_PROPERTIES'][$arParams['PROP_PRICES_NOTE']]['DISPLAY_VALUE']))
    return;
?>

<span class="c-prices-note">
    <span class="c-prices-note__value"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_PRICES_NOTE']]['DISPLAY_VALUE']?></span>
</span>
