<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;
?>

<!-- header fly -->
<div id="header-fly" class="header-fly js-header-fly text-left b-mmenu hidden-print">
	<!-- fly__shadow --><div class="header-fly__shadow">
		
	<div class="centering header-fly__white-bg"><div class="centeringin clearfix"><div class="header-fly__panel">

	<div class="header-fly__block logo logo-left hidden-xs">
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
		<div class="header-fly__block header-fly__menu">
			<div class="hamburger js-hamburger js-fly-menu js-fly-menu-parent"><div class="hamburger-box"><div class="hamburger-inner"></div></div><span class="hamburger-name hidden-xs"><?=Loc::getMessage('RSGOPRO.MENU')?></span></div>
		</div>
		<div class="header-fly__block logo logo-center visible-xs">
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
		<div class="header-fly__block phone link-dashed hidden-xs">
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
		<div class="header-fly__block callback link-dashed hidden-xs">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/fly/callback.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
		</div>
		<div class="header-fly__block search">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/fly/search_title.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
		</div>
	</div></div></div>

	</div><!-- /fly__shadow -->

	<!-- fly shade --><div class="header-fly__menu-shade js-menu-shade">

<!-- personal panel --><div class="header-fly__personal header-fly__white-bg hidden-sm hidden-md hidden-lg">
<span class="header-fly__block auth">
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
<span class="header-fly__block compare">
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
<span class="header-fly__block favorite">
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
<span class="header-fly__block basket">
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
</div><!-- /personal panel -->

<!-- catalog menu --><div class="header-fly__catalog-menu js-fly-menu-children" data-count-subopen="0">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/fly/menu.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</div><!-- /catalog menu -->

<div class="header-fly__footer header-fly__subopen-hide header-fly__white-bg hidden-sm hidden-md hidden-lg">
<span class="header-fly__footer-block"><?php $APPLICATION->ShowViewContent('autodetect_location_header2');?></span>
<span class="header-fly__footer-block">
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
<span class="header-fly__footer-block">
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
<span class="header-fly__footer-block">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/fly/callback.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</span>
</div>

	</div><!-- /fly shade -->
</div>
<!-- /header fly -->
