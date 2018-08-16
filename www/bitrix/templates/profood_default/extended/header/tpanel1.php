<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- tpanel1 -->
<div id="tpanel" class="tpanel js-tpanel mod-background">
	<div class="tline"></div>

	<div class="centering">
		<div class="centeringin clearfix">

<div class="authandlocation nowrap">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/location.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/auth.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</div>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/topline_menu.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>

		</div>
	</div>
</div>
<!-- /tpanel1 -->
