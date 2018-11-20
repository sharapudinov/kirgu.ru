<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<!-- header type2 -->
<div id="header" class="header js-header">
	<div class="centering">
		<div class="centeringin clearfix">

<div class="row header__flex">
<div class="col-xs-12 col-sm-6 col-md-3 col-lg-3 text-xs-center">
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
<div class="col-sm-6 col-md-9 col-lg-9 hidden-xs text-right hidden-print">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/type2/topline_menu.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</div>
</div>

		</div>
	</div>
</div>
<!-- /header type2 -->
