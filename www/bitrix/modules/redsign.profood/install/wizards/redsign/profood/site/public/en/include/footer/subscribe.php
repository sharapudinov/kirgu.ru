<?$APPLICATION->IncludeComponent(
	"bitrix:subscribe.form",
	"footer",
	array(
		"USE_PERSONALIZATION" => "Y",
		"SHOW_HIDDEN" => "N",
		"PAGE" => "#SITE_DIR#personal/subscribe/",
		"CACHE_TYPE" => "A",
		"CACHE_TIME" => "36000000",
	),
	false
);?>