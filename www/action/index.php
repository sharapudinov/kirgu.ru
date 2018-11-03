<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Акции");
?><?
$APPLICATION->IncludeComponent(
	"bitrix:news", 
	"actions", 
	array(
		"IBLOCK_TYPE" => "presscenter",
		"IBLOCK_ID" => "18",
		"NEWS_COUNT" => "2",
		"USE_SEARCH" => "N",
		"USE_RSS" => "N",
		"USE_RATING" => "N",
		"USE_CATEGORIES" => "N",
		"USE_REVIEW" => "N",
		"USE_FILTER" => "N",
		"SORT_BY1" => "ACTIVE_FROM",
		"SORT_ORDER1" => "DESC",
		"SORT_BY2" => "SORT",
		"SORT_ORDER2" => "ASC",
		"CHECK_DATES" => "Y",
		"SEF_MODE" => "Y",
		"SEF_FOLDER" => "/action/",
		"AJAX_MODE" => "N",
		"AJAX_OPTION_JUMP" => "N",
		"AJAX_OPTION_STYLE" => "Y",
		"AJAX_OPTION_HISTORY" => "N",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
		"CACHE_FILTER" => "N",
		"CACHE_GROUPS" => "Y",
		"SET_STATUS_404" => "N",
		"SET_TITLE" => "Y",
		"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
		"ADD_SECTIONS_CHAIN" => "N",
		"ADD_ELEMENT_CHAIN" => "N",
		"USE_PERMISSIONS" => "N",
		"PREVIEW_TRUNCATE_LEN" => "",
		"LIST_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"LIST_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"LIST_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"HIDE_LINK_WHEN_NO_DETAIL" => "N",
		"DISPLAY_NAME" => "Y",
		"META_KEYWORDS" => "-",
		"META_DESCRIPTION" => "-",
		"BROWSER_TITLE" => "-",
		"DETAIL_ACTIVE_DATE_FORMAT" => "d.m.Y",
		"DETAIL_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"DETAIL_PROPERTY_CODE" => array(
			0 => "ACTION",
			1 => "SECTIONS",
			2 => "",
		),
		"DETAIL_DISPLAY_TOP_PAGER" => "N",
		"DETAIL_DISPLAY_BOTTOM_PAGER" => "Y",
		"DETAIL_PAGER_TITLE" => "Страница",
		"DETAIL_PAGER_TEMPLATE" => "",
		"DETAIL_PAGER_SHOW_ALL" => "Y",
		"PAGER_TEMPLATE" => "gopro",
		"DISPLAY_TOP_PAGER" => "N",
		"DISPLAY_BOTTOM_PAGER" => "Y",
		"PAGER_TITLE" => "Акции",
		"PAGER_SHOW_ALWAYS" => "N",
		"PAGER_DESC_NUMBERING" => "N",
		"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
		"PAGER_SHOW_ALL" => "N",
		"AJAX_OPTION_ADDITIONAL" => "",
		"COMPONENT_TEMPLATE" => "actions",
		"ACTIONS_PAGE" => "",
		"SECTIONS_CODE" => "SECTIONS",
		"CATALOG_IBLOCK_ID" => "4",
		"HIDE_NOT_AVAILABLE" => "Y",
		"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
		"SET_LAST_MODIFIED" => "N",
		"STRICT_SECTION_CHECK" => "N",
		"PROP_MORE_PHOTO" => "-",
		"USE_FAVORITE" => "Y",
		"USE_SHARE" => "Y",
		"SOC_SHARE_ICON" => array(
		),
		"OFF_MEASURE_RATION" => "N",
		"ADD_STYLES_FOR_MAIN" => "N",
		"SHOW_BOTTOM_SECTIONS" => "N",
		"COUNT_ITEMS" => "0",
		"CONVERT_CURRENCY" => "N",
		"COMPOSITE_FRAME_MODE" => "A",
		"COMPOSITE_FRAME_TYPE" => "AUTO",
		"COL_XS_6" => "N",
		"DETAIL_SET_CANONICAL_URL" => "N",
		"PAGER_BASE_LINK_ENABLE" => "N",
		"SHOW_404" => "N",
		"MESSAGE_404" => "",
		"CATALOG_FILTER_NAME" => "",
		"CATALOG_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"PRODUCT_SUBSCRIPTION" => "N",
		"ERROR_EMPTY_ITEMS" => "N",
		"CATALOG_OFFERS_FIELD_CODE" => array(
			0 => "",
			1 => "",
		),
		"CATALOG_OFFERS_PROPERTY_CODE" => array(
			0 => "",
			1 => "",
		),
		"CATALOG_OFFERS_LIMIT" => "5",
		"PRICE_CODE" => array(
			0 => "Розничная",
			1 => "РРЦ",
			2 => "СпецЦена",
		),
		"USE_PRICE_COUNT" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"PRICE_VAT_INCLUDE" => "Y",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"BASKET_URL" => "/personal/cart/",
		"ACTION_VARIABLE" => "action",
		"PRODUCT_ID_VARIABLE" => "id",
		"USE_PRODUCT_QUANTITY" => "Y",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"USE_COMPARE" => "Y",
		"USE_STORE" => "N",
		"SECTION_COUNT_ELEMENTS" => "Y",
		"SECTION_TOP_DEPTH" => "2",
		"USE_MAIN_ELEMENT_SECTION" => "Y",
		"OFFERS_SORT_FIELD" => "sort",
		"OFFERS_SORT_ORDER" => "asc",
		"OFFERS_SORT_FIELD2" => "id",
		"OFFERS_SORT_ORDER2" => "desc",
		"PROP_SKU_MORE_PHOTO" => "-",
		"PROP_ARTICLE" => "-",
		"PROP_SKU_ARTICLE" => "-",
		"PROPS_ATTRIBUTES" => array(
		),
		"PROPS_ATTRIBUTES_COLOR" => array(
			0 => "TSVET_2",
		),
		"SECTION_ID_VARIABLE" => "SECTION_ID",
		"SHOW_DEACTIVATED" => "N",
		"CATALOG_TEMPLATE_AJAXID" => "ajaxpages_catalog_identifier",
		"CATALOG_USE_AJAXPAGES" => "Y",
		"ACTION_CODE" => "ACTION",
		"CATALOG_ACTION_CODE" => "AKTSII",
		"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
		"SEF_URL_TEMPLATES" => array(
			"news" => "",
			"section" => "",
			"detail" => "#ELEMENT_CODE#/",
		)
	),
	false
);
?><?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>