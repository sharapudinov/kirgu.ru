<?$APPLICATION->IncludeComponent(
	"redsign:easycart",
	"gopro",
	array(
		"USE_VIEWED" => "Y",
		"USE_COMPARE" => "Y",
		"USE_BASKET" => "Y",
		"USE_FAVORITE" => "Y",
		"VIEWED_COUNT" => "10",
		"FAVORITE_COUNT" => "10",
		"TEMPLATE_THEME" => "green",
		"Z_INDEX" => "991",
		"MAX_WIDTH" => "1240",
		"USE_ONLINE_CONSUL" => "Y",
		"ONLINE_CONSUL_LINK" => "#",
		"INCLUDE_JQUERY" => "N",
		"INCLUDE_JQUERY_COOKIE" => "N",
		"INCLUDE_JQUERY_STICKY" => "N",
		"ADD_BODY_PADDING" => "Y",
		"ON_UNIVERSAL_AJAX_HANDLER" => "Y",
		"UNIVERSAL_AJAX_FINDER" => "action=ADD2BASKET",
		"UNIVERSAL_AJAX_FINDER_COMPARE" => "action=ADD_TO_COMPARE_LIST",
		"UNIVERSAL_AJAX_FINDER_BASKET" => "action=ADD2BASKET",
		"UNIVERSAL_AJAX_FINDER_FAVORITE" => "action=add2favorite",
		"UNIVERSAL_AJAX_FINDER_COMPARE_ADD" => "action=ADD_TO_COMPARE_LIST",
		"UNIVERSAL_AJAX_FINDER_COMPARE_REMOVE" => "action=DELETE_FROM_COMPARE_LIST"
	),
	false
);?>