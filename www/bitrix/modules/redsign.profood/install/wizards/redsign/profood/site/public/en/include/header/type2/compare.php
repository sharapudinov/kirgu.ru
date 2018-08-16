<?$APPLICATION->IncludeComponent(
	"bitrix:catalog.compare.list", 
	"header2", 
	array(
		"COMPONENT_TEMPLATE" => "header2",
		"IBLOCK_TYPE" => "catalog",
		"IBLOCK_ID" => "#IBLOCK_ID_catalog#",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"DETAIL_URL" => "",
		"COMPARE_URL" => "#SITE_DIR#catalog/compare/",
		"NAME" => "CATALOG_COMPARE_LIST",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id"
	),
	false
);?>
