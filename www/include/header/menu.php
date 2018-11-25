<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>

<?php
$isMain = ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php') ? 'Y' : 'N';
global $mainMenuType;
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"gopro", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CATALOG_PATH" => "/catalog/",
		"CHILD_MENU_TYPE" => "",
		"CONVERT_CURRENCY" => "N",
		"DELAY" => "N",
		"IBLOCK_ID" => array(
			0 => "4",
		),
		"IS_MAIN" => $isMain,
		"MAX_ITEM" => "9",
		"MAX_LEVEL" => "1",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "360000",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PRICE_CODE" => array(
			0 => "Розничная",
			1 => "РРЦ",
			2 => "СпецЦена",
		),
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
		"COMPONENT_TEMPLATE" => "gopro",
		"RSGOPRO_SUB_TEMPLATE" => "vertical1",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO"
	),
	false
);?>
