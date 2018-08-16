<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- tpanel1 -->
<div id="tpanel" class="tpanel js-tpanel mod-bot-line">
	<div class="centering">
		<div class="centeringin clearfix bot-line">

		<div class="tline"></div>

		<div class="row tpanel__flex">
			<div class="col-xs-4 col-sm-6 col-md-7 col-lg-7 left-part link-dashed">
<span class="tpanel__block location2">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type2/location.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
<span class="tpanel__block phone">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/phone.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
<span class="tpanel__block schedule hidden-xs hidden-sm">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/schedule.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
<span class="tpanel__block callback">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type2/callback.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
			</div>
			<div class="col-xs-8 col-sm-6 col-md-5 col-lg-5 text-right right-part">
<span class="tpanel__block auth">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type2/auth.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
<span class="tpanel__block compare">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type2/compare.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
<span class="tpanel__block favorite">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type2/favorite.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
<span class="tpanel__block basket">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type2/basket_small.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
			</div>
		</div>

		</div>
	</div>
</div>
<!-- /tpanel1 -->
