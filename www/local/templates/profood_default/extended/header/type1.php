<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- header type1 -->
<div id="header" class="header js-header">
	<div class="centering">
		<div class="centeringin clearfix">
			<div class="logo column1">
				<div class="column1inner">
<a href="<?=SITE_DIR?>"><?
?><?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/company_logo.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?><?
?></a>
				</div>
			</div>
			<div class="phone column1 nowrap">
				<div class="column1inner">
					<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-handphone"></use></svg>
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
				</div>
			</div>
			<div class="callback column1 nowrap hidden-print">
				<div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/nasvyazi.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
			<div class="favorite column1 nowrap hidden-print">
				<div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/favorite.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
			<div class="basket column1 nowrap hidden-print">
				<div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type1/basket_small.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /header type1 -->
