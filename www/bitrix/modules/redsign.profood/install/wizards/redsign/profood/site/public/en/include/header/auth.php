<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form",
	"inheader",
	array(
		"REGISTER_URL" => "#SITE_DIR#auth/",
		"PROFILE_URL" => "#SITE_DIR#personal/profile/"
	)
);?>