<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');?>

<?$APPLICATION->IncludeComponent(
	"bitrix:sale.basket.basket", 
	"rs_easycart", 
	array(
		"COLUMNS_LIST" => array(
		),
		"PATH_TO_ORDER" => "#SITE_DIR#personal/order/make/",
		"HIDE_COUPON" => "N",
		"PRICE_VAT_SHOW_VALUE" => "N",
		"COUNT_DISCOUNT_4_ALL_QUANTITY" => "N",
		"USE_PREPAYMENT" => "N",
		"QUANTITY_FLOAT" => "N",
		"SET_TITLE" => "Y",
		"ACTION_VARIABLE" => "action",
		"OFFERS_PROPS" => "",
		"COMPONENT_TEMPLATE" => "rs_easycart"
	),
	false
);?>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>
