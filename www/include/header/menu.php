<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
$isMain = ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php') ? 'Y' : 'N';
global $mainMenuType;
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:menu",
	"gopro",
	Array(
		"ALLOW_MULTI_SELECT" => "N",
		"CATALOG_PATH" => "/catalog/",
		"CHILD_MENU_TYPE" => "",
		"CONVERT_CURRENCY" => "N",
		"DELAY" => "N",
		"IBLOCK_ID" => array(),
		"IS_MAIN" => $isMain,
		"MAX_ITEM" => "9",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(""),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"OFFERS_FIELD_CODE" => array("",""),
		"OFFERS_PROPERTY_CODE" => array("",""),
		"PRICE_CODE" => array(),
		"PRICE_VAT_INCLUDE" => "N",
		"PRODUCT_QUANTITY_VARIABLE" => "",
		"ROOT_MENU_TYPE" => "catalog",
		"RSGOPRO_CATALOG_PATH" => "/catalog/",
		"RSGOPRO_IS_MAIN" => "N",
		"RSGOPRO_MAX_ITEM" => "9",
		"RSGOPRO_PROPCODE_ELEMENT_IN_MENU" => "",
		"USE_EXT" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"VIEW" => $mainMenuType,
	)
);?>
