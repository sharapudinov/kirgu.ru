<div class="nice-title">Selection of goods</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include", 
	"tabs", 
	array(
		"AREA_FILE_SHOW" => "file",
		"AREA_FILE_SUFFIX" => "inc",
		"EDIT_TEMPLATE" => "",
		"COMPONENT_TEMPLATE" => "tabs",
		"AJAX_LOAD" => "Y",
		"TABS_COUNT" => "0",
		"PATH" => "#SITE_DIR#include/tabs/main/best.offers.php",
		"MAIN_TAB_NAME" => "Popular goods"
	),
	false
);?>
