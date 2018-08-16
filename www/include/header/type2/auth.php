<?$APPLICATION->IncludeComponent(
	"bitrix:system.auth.form", 
	"inheader2", 
	array(
		"REGISTER_URL" => "/auth/?register=yes",
		"PROFILE_URL" => "/personal/profile/",
		"COMPONENT_TEMPLATE" => "inheader",
		"FORGOT_PASSWORD_URL" => "",
		"SHOW_ERRORS" => "N"
	),
	false
);?>
