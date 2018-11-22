<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arrBasketIds = array();

// basket
if (is_array($arResult["CATEGORIES"]["READY"]) && count($arResult["CATEGORIES"]["READY"]) > 0) {
	foreach ($arResult["CATEGORIES"]["READY"] as $arItem) {
		$arrBasketIds[$arItem["PRODUCT_ID"]] = 'Y';
	}
} else {
	$userBasketId = \CSaleBasket::GetBasketUserID();
	
	$dbBasketItems = \CSaleBasket::GetList(
			array("NAME" => "ASC", "ID" => "ASC"),
			array("FUSER_ID" => $userBasketId, "LID" => SITE_ID, "ORDER_ID" => "NULL", 'DELAY' => 'N', 'CAN_BUY' => 'Y'),
			false,
			false,
			array("ID", "PRODUCT_ID")
		);
	while ($arItem = $dbBasketItems->Fetch()) {
		$arrBasketIds[$arItem["PRODUCT_ID"]] = 'Y';
	}
}

?><script>
	RSGoPro_INBASKET = <?=json_encode($arrBasketIds)?>;
	RSGoPro_BASKET.allSum_FORMATED = "<?=\CUtil::JSEscape($arResult['TOTAL_PRICE'])?>";
</script>
