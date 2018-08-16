<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Оформление заказа");
?>

<div class="pmenu">
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
<?$APPLICATION->IncludeComponent("bitrix:sale.order.ajax", "", Array(
	"PAY_FROM_ACCOUNT" => "Y",
		"ONLY_FULL_PAY_FROM_ACCOUNT" => "N",
		"COUNT_DELIVERY_TAX" => "N",
		"ALLOW_AUTO_REGISTER" => "Y",
		"SEND_NEW_USER_NOTIFY" => "Y",
		"DELIVERY_NO_AJAX" => "N",
		"DELIVERY_NO_SESSION" => "N",
		"TEMPLATE_LOCATION" => "popup",
		"DELIVERY_TO_PAYSYSTEM" => "d2p",
		"USE_PREPAYMENT" => "N",
		"PROP_1" => "",
		"ALLOW_NEW_PROFILE" => "Y",
		"SHOW_PAYMENT_SERVICES_NAMES" => "Y",
		"SHOW_STORES_IMAGES" => "N",
		"PATH_TO_BASKET" => "#SITE_DIR#personal/cart/",
		"PATH_TO_PERSONAL" => "#SITE_DIR#personal/",
		"PATH_TO_PAYMENT" => "#SITE_DIR#personal/order/payment/",
		"PATH_TO_AUTH" => "#SITE_DIR#auth/",
		"SET_TITLE" => "Y",
		"DISABLE_BASKET_REDIRECT" => "N",
		"PRODUCT_COLUMNS" => "",
		"PROP_2" => "",
		"COMPONENT_TEMPLATE" => "",
		"COMPATIBLE_MODE" => "Y",
		"PRODUCT_COLUMNS_VISIBLE" => array(
			0 => "PREVIEW_PICTURE",
			1 => "PROPS",
		),
		"ADDITIONAL_PICT_PROP_7" => "-",
		"ADDITIONAL_PICT_PROP_8" => "-",
		"BASKET_IMAGES_SCALING" => "standard",
		"CODE_PHONES" => ""
	),
	false
);?>
</div>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
