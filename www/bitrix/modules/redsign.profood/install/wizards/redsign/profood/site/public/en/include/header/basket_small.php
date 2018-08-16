<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"inheader", 
	array(
		"PATH_TO_BASKET" => "#SITE_DIR#personal/cart/",
		"PATH_TO_ORDER" => "#SITE_DIR#personal/order/",
		"SHOW_DELAY" => "Y",
		"SHOW_NOTAVAIL" => "Y",
		"SHOW_SUBSCRIBE" => "Y",
		"COMPONENT_TEMPLATE" => "inheader",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"PATH_TO_PERSONAL" => "#SITE_DIR#personal/",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => "#SITE_DIR#login/",
		"PATH_TO_PROFILE" => "#SITE_DIR#personal/",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"POSITION_FIXED" => "N",
		"HIDE_ON_BASKET_PAGES" => "N"
	),
	false
);?>