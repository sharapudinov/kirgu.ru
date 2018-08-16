<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"inheader2", 
	array(
		"REGISTER_URL" => "#SITE_DIR#auth/?register=yes",
		"PROFILE_URL" => "#SITE_DIR#personal/profile/",
		"COMPONENT_TEMPLATE" => "inheader",
		"FORGOT_PASSWORD_URL" => "",
		"SHOW_ERRORS" => "N"
	),
	false
);?>
