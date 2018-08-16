<?$APPLICATION->IncludeComponent(
	"redsign:favorite.list",
	"inheader",
	array(
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "3600",
		"ACTION_VARIABLE" => "topaction",
		"PRODUCT_ID_VARIABLE" => "id"
	),
	false
);?>