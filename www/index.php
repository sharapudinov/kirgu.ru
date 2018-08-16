<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetPageProperty('NOT_SHOW_NAV_CHAIN', 'Y');
$APPLICATION->SetTitle('Главная');
$APPLICATION->SetPageProperty('title', 'Главная');

$tuning = \Redsign\Tuning\TuningCore::getInstance();
$instanceOptionManager = $tuning->getInstanceOptionMananger();
$showblockFichi = $instanceOptionManager->get('SWITCH_FICHI');
$showblockNewsAndSection = $instanceOptionManager->get('SWITCH_NEWS_AND_SECTIONS');
$showblockBestProducts = $instanceOptionManager->get('SWITCH_BEST_PRODUCTS');
$showblockGallery = $instanceOptionManager->get('SWITCH_GALLERY');
$showblockBrands = $instanceOptionManager->get('SWITCH_BRANDS');
$showblockShops = $instanceOptionManager->get('SWITCH_SHOPS');
?>

<!-- banner -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/banner.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => "Y"
	)
);?>
<!-- /banner -->

<!-- banner -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/fichi.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => ($showblockFichi == 'Y' ? 'Y' : 'N')
	)
);?>
<!-- /banner -->

<!-- section.list -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/section.list.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => ($showblockNewsAndSection == 'Y' ? 'Y' : 'N')
	)
);?>
<!-- /section.list -->

<!-- news -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/news.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => ($showblockNewsNadSection == 'Y' ? 'Y' : 'N')
	)
);?>
<!-- /news -->

<!-- best.offers -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/best.offers.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => ($showblockBestProducts == 'Y' ? 'Y' : 'N')
	)
);?>
<!-- /best.offers -->

<!-- brands -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/gallery.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => ($showblockGallery == 'Y' ? 'Y' : 'N')
	)
);?>
<!-- /brands -->

<!-- brands -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/brands.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => ($showblockBrands == 'Y' ? 'Y' : 'N')
	)
);?>
<!-- /brands -->

<!-- shops -->
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/index/shops.php",
		"EDIT_TEMPLATE" => ""
	),
	false,
	array(
		"ACTIVE_COMPONENT" => ($showblockShops == 'Y' ? 'Y' : 'N')
	)
);?>
<!-- /shops -->

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>
