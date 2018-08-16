<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Viewed");

global $arrAlreadyViewed;
$APPLICATION->IncludeComponent("bitrix:sale.viewed.product", "filter", array(
	"VIEWED_COUNT" => "10000",
	"VIEWED_NAME" => "Y",
	"VIEWED_IMAGE" => "Y",
	"VIEWED_PRICE" => "Y",
	"VIEWED_CURRENCY" => "default",
	"VIEWED_CANBUY" => "N",
	"VIEWED_CANBUSKET" => "N",
	"VIEWED_IMG_HEIGHT" => "75",
	"VIEWED_IMG_WIDTH" => "75",
	"BASKET_URL" => "#SITE_DIR#personal/cart/",
	"ACTION_VARIABLE" => "action",
	"PRODUCT_ID_VARIABLE" => "id",
	"SET_TITLE" => "N"
	),
	false
);
?><div class="pmenu">
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"personal", 
	array(
		"ROOT_MENU_TYPE" => "personal",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_USE_GROUPS" => "Y",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MAX_LEVEL" => "1",
		"CHILD_MENU_TYPE" => "",
		"USE_EXT" => "N",
		"DELAY" => "N",
		"ALLOW_MULTI_SELECT" => "N",
		"SEPARATORS_PLACE" => array(
			0 => "3",
			1 => "7",
			2 => "",
		),
		"COMPONENT_TEMPLATE" => "personal"
	),
	false
);?>
</div>
<div class="pcontent">
	 <?global $rsGoProViewedFilter;?> <?$APPLICATION->IncludeComponent(
	"bitrix:catalog.viewed.products",
	"gopro",
	Array(
		"ACTION_VARIABLE" => "action",
		"ADDITIONAL_PICT_PROP_#IBLOCK_ID_catalog#" => "DOCS",
		"ADDITIONAL_PICT_PROP_#IBLOCK_ID_offers#" => "MORE_PHOTO",
		"ADD_PROPERTIES_TO_BASKET" => "Y",
		"BASKET_URL" => "#SITE_DIR#personal/cart/",
		"CACHE_GROUPS" => "Y",
		"CACHE_TIME" => "36000000",
		"CACHE_TYPE" => "A",
		"CART_PROPERTIES_#IBLOCK_ID_catalog#" => array(0=>"",1=>"",),
		"CART_PROPERTIES_#IBLOCK_ID_offers#" => array(0=>"",1=>"",),
		"COLUMNS5" => "N",
		"COMPONENT_TEMPLATE" => "gopro",
		"CONVERT_CURRENCY" => "N",
		"DEPTH" => "",
		"DETAIL_URL" => "",
		"DONT_SHOW_LINKS" => "N",
		"EMPTY_ITEMS_HIDE_FIL_SORT" => "N",
		"HIDE_NOT_AVAILABLE" => "N",
		"IBLOCK_ID" => "#IBLOCK_ID_catalog#",
		"IBLOCK_TYPE" => "catalog",
		"LABEL_PROP_#IBLOCK_ID_catalog#" => "-",
		"MAIN_TITLE" => "",
		"MESS_BTN_BUY" => "Buy",
		"MESS_BTN_DETAIL" => "More",
		"MESS_BTN_SUBSCRIBE" => "Subscribe",
		"MIN_AMOUNT" => "10",
		"OFFER_TREE_PROPS_8" => array(0=>"COLOR_DIRECTORY",1=>"SKU_SIZE_MEMORY",),
		"OFF_MEASURE_RATION" => "Y",
		"OFF_SMALLPOPUP" => "N",
		"PAGE_ELEMENT_COUNT" => "30",
		"PARTIAL_PRODUCT_PROPERTIES" => "N",
		"PRICE_CODE" => array(0=>"BASE",),
		"PRICE_VAT_INCLUDE" => "Y",
		"PRODUCT_ID_VARIABLE" => "id",
		"PRODUCT_PROPS_VARIABLE" => "prop",
		"PRODUCT_QUANTITY_VARIABLE" => "quantity",
		"PRODUCT_SUBSCRIPTION" => "Y",
		"PROPERTY_CODE_#IBLOCK_ID_catalog#" => array(0=>"",1=>"",),
		"PROPERTY_CODE_#IBLOCK_ID_offers#" => array(0=>"",1=>"",),
		"PROPS_ATTRIBUTES" => array(0=>"COLOR_DIRECTORY",1=>"SKU_SIZE_MEMORY",2=>"SKY_SIZE_WEIGHT",3=>"CVET_FOR_CHANGE",),
		"PROPS_ATTRIBUTES_COLOR" => array(0=>"COLOR_DIRECTORY",),
		"PROP_ACCESSORIES" => "ACCESSORIES",
		"PROP_ARTICLE" => "CML2_ARTICLE",
		"PROP_MORE_PHOTO" => "MORE_PHOTO",
		"PROP_SKU_ARTICLE" => "CML2_ARTICLE",
		"PROP_SKU_MORE_PHOTO" => "MORE_PHOTO",
		"SECTION_CODE" => "",
		"SECTION_ELEMENT_CODE" => "",
		"SECTION_ELEMENT_ID" => "",
		"SECTION_ID" => "",
		"SHOW_DISCOUNT_PERCENT" => "Y",
		"SHOW_ERROR_EMPTY_ITEMS" => "Y",
		"SHOW_FROM_SECTION" => "N",
		"SHOW_IMAGE" => "Y",
		"SHOW_NAME" => "Y",
		"SHOW_OLD_PRICE" => "N",
		"SHOW_PRICE_COUNT" => "1",
		"SHOW_PRODUCTS_#IBLOCK_ID_catalog#" => "Y",
		"USE_AUTO_AJAXPAGES" => "N",
		"USE_FAVORITE" => "Y",
		"USE_MIN_AMOUNT" => "Y",
		"USE_PRODUCT_QUANTITY" => "N",
		"USE_SHADOW_ON_HOVER" => "N",
		"USE_SHARE" => "Y",
		"USE_STORE" => "Y",
		"VIEW" => "showcase"
	)
);?> <?$APPLICATION->ShowViewContent('paginator');?>
</div>
<br><?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
