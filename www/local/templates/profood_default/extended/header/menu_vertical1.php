<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- menu vertical1 -->
<div id="menu" class="menu js-menu hidden-print">
	<div class="centering">
		<div class="centeringin clearfix">
			<div class="b-mmenu type1">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/menu.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/search_title.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
			</div>
		</div>
	</div>
</div>
<!-- /menu vertical1 -->
