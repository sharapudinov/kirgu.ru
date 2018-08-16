<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket.line", 
	"inheader", 
	array(
		"PATH_TO_BASKET" => "/personal/cart/",
		"PATH_TO_ORDER" => "/personal/order/",
		"SHOW_DELAY" => "Y",
		"SHOW_NOTAVAIL" => "Y",
		"SHOW_SUBSCRIBE" => "Y",
		"COMPONENT_TEMPLATE" => "inheader",
		"SHOW_NUM_PRODUCTS" => "Y",
		"SHOW_TOTAL_PRICE" => "Y",
		"SHOW_EMPTY_VALUES" => "Y",
		"SHOW_PERSONAL_LINK" => "N",
		"PATH_TO_PERSONAL" => "/personal/",
		"SHOW_AUTHOR" => "N",
		"PATH_TO_REGISTER" => "/login/",
		"PATH_TO_PROFILE" => "/personal/",
		"SHOW_PRODUCTS" => "Y",
		"SHOW_IMAGE" => "Y",
		"SHOW_PRICE" => "Y",
		"SHOW_SUMMARY" => "Y",
		"POSITION_FIXED" => "N",
		"HIDE_ON_BASKET_PAGES" => "N"
	),
	false
);?>