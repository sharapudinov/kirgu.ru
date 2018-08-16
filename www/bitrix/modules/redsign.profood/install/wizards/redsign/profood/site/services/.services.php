<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arServices = array(
	"main" => array(
		"NAME" => GetMessage("SERVICE_MAIN_SETTINGS"),
		"STAGES" => array(
			"files.php", // Copy bitrix files
			"search.php", // Indexing files
			"template.php", // Install template
			"theme.php", // Install theme
			"menu.php", // Install menu
			"settings.php",
		),
	),
	"iblock" => array(
		"NAME" => GetMessage("SERVICE_IBLOCK_DEMO_DATA"),
		"STAGES" => array(
			"types.php", // IBlock types
			"action.php",
			"banners.php",
			"brands.php",
			"files.php",
			"news.php",
			"shops.php",
			"references.php", // hl
			"references2.php",
			"catalog.php", // catalog iblock import
			"catalog2.php", // offers iblock import
			"catalog3.php", // catalog binds
			"catalog4.php", // reindex
			// new
			"company_gallery.php",
			"presscenter_fichi.php",
			"presscenter_shops2.php",
			"system_regions.php",
			// /new
			"binds_items.php",
		),
	),
	"sale" => array(
		"NAME" => GetMessage("SERVICE_SALE_DEMO_DATA"),
		"STAGES" => array(
			"locations.php",
			"step1.php",
			"step2.php",
			"step3.php"
		),
	),
	"catalog" => array(
		"NAME" => GetMessage("SERVICE_CATALOG_SETTINGS"),
		"STAGES" => array(
			"index.php",
			"eshopapp.php",
		),
	),
	"forum" => array(
		"NAME" => GetMessage("SERVICE_FORUM")
	),
	"redsign" => array(
		"NAME" => GetMessage("SERVICE_REDSIGN"),
        "STAGES" => array(
			"daysarticle.php",
			"devcom.php",
			"devfunc.php",
			"favorite.php",
			"grupper.php",
			"location.php",
			"recaptcha.php",
			"module.php",
			"quickbuy.php",
			"easycart.php",
			"tuning.php",
		),
        "MODULE_ID" => "redsign.profood"
	),
);
