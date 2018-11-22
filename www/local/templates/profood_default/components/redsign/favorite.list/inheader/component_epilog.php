<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arrFavositeIds = array();
if (is_array($arResult["ITEMS"]) && count($arResult["ITEMS"]) > 0) {
	foreach ($arResult["ITEMS"] as $arItem) {
		$arrFavositeIds[$arItem["ELEMENT_ID"]] = "Y";
	}
	?><script>RSGoPro_FAVORITE = <?=json_encode($arrFavositeIds)?>;</script><?
}
