<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader,
	\Bitrix\Main\IO\File,
	\Bitrix\Main\Page\Asset,
	\Bitrix\Main\Application,
	\Bitrix\Main\Config\Option,
	\Bitrix\Main\Localization\Loc,
	\Redsign\Tuning;

Loc::loadMessages(__FILE__);

include(Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/extended/pathes.php');

// check module include
if (!Loader::includeModule(GOPRO_MODULE_ID)) {
	ShowError(Loc::getMessage('RSGOPRO.ERROR_NOT_INSTALLED_MODULE'), array('#MODULE#' => GOPRO_MODULE_ID));
	die();
}

if (!Loader::includeModule('redsign.devfunc')) {
    ShowError(Loc::getMessage('RSGOPRO.ERROR_NOT_INSTALLED_MODULE'), array('#MODULE#' => 'redsign.devfunc'));
    die();
} else {
    RSDevFunc::Init(array('jsfunc'));
}

if (!Loader::includeModule('redsign.tuning')) {
    ShowError(Loc::getMessage('RSGOPRO.ERROR_NOT_INSTALLED_MODULE'), array('#MODULE#' => 'redsign.tuning'));
    die();
}

// get module version
$obFile1 = new File(Application::getDocumentRoot().'/bitrix/modules/'.GOPRO_MODULE_ID.'/install/version.php');
if ($obFile1->isExists()) {
	include(Application::getDocumentRoot().'/bitrix/modules/'.GOPRO_MODULE_ID.'/install/version.php');    
} else {
	$obFile2 = new File(Application::getDocumentRoot().'/local/modules/'.GOPRO_MODULE_ID.'/install/version.php');
	if ($obFile2->isExists()) {
		include(Application::getDocumentRoot().'/local/modules/'.GOPRO_MODULE_ID.'/install/version.php');    
	}
}

$request = Application::getInstance()->getContext()->getRequest();

// is main page
$isMain = ($APPLICATION->GetCurPage(true) == SITE_DIR.'index.php') ? 'Y' : 'N';

// is catalog page
$isCatalog = (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'catalog/') === false) ? 'N' : 'Y';

// is personal page
$isPersonal = (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'personal/') === false) ? 'N' : 'Y';

// is auth page
$isAuth = (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'auth/') === false) ? 'N' : 'Y';

// is ajax hit
global $isAjax;
$xFancybox = $request->getQuery('x-fancybox');
$isAjax = isset($_SERVER['HTTP_X_REQUESTED_WITH']) && isset($xFancybox) || (isset($_REQUEST['AJAX_CALL']) && 'Y' == $_REQUEST['AJAX_CALL']);

\CJSCore::Init(array('ajax'));

// redsign.tuning
$tuning = Tuning\TuningCore::getInstance();
$instanceOptionManager = $tuning->getInstanceOptionMananger();
global $mainMenuType, $headerType;
$color = $instanceOptionManager->get('COLOR');
$mainMenuType = $instanceOptionManager->get('MAIN_MENU_TYPE');
$headerType = $instanceOptionManager->get('HEADER_TYPE');
$useHeaderFly = $instanceOptionManager->get('SWITCH_USE_HEADER_FLY');
$tpanelType = $headerType == 'type1' ? 'tpanel1' : 'tpanel2';
$showblockNewsNadSection = $instanceOptionManager->get('SWITCH_NEWS_AND_SECTIONS');
$showblockBestProducts = $instanceOptionManager->get('SWITCH_BEST_PRODUCTS');
$showblockBrands = $instanceOptionManager->get('SWITCH_BRANDS');
// safework
$mainMenuType = ($mainMenuType ?: 'horizontal1');
$headerType = ($headerType ?: 'type2');
// /redsign.tuning

global $licenseWorkLinkFull;
$circular = Option::get(GOPRO_MODULE_ID, 'circular', 'Y');
$skuView = Option::get(GOPRO_MODULE_ID, 'prop_option', 'line_through');
$phoneMask = Option::get(GOPRO_MODULE_ID, 'phone_mask', '+7 (999) 999-9999');
$licenseWorkLink = Option::get(GOPRO_MODULE_ID, 'license_work_link', '');
$offYandex = Option::get(GOPRO_MODULE_ID, 'off_yandex', 'N');
$licenseWorkLinkFull = '<div class="line clearfix license-link-work">';
if (!empty($licenseWorkLink)) {
	$licenseWorkLinkFull.= Loc::getMessage('RSGOPRO.LICENSE_WORK_LINK_PART1').'<br><a href="'.$licenseWorkLink.'" target="_blank">'.Loc::getMessage('RSGOPRO.LICENSE_WORK_LINK_PART2').'</a>';
} else {
	$licenseWorkLinkFull.= Loc::getMessage('RSGOPRO.LICENSE_WORK_LINK_EMPTY');
}
$licenseWorkLinkFull.= '</div>';

$asset = Asset::getInstance();

// add strings
$asset->addString('<link href="'.SITE_DIR.'favicon.ico" rel="shortcut icon"  type="image/x-icon">');
$asset->addString('<meta http-equiv="X-UA-Compatible" content="IE=edge" />');
$asset->addString('<meta name="viewport" content="width=device-width, initial-scale=1.0">');
if ($offYandex != 'Y') {
	$asset->addString('<script type="text/javascript" src="//yandex.st/share/share.js" charset="utf-8"></script>');
	$asset->addString('<script src="//yastatic.net/share2/share.js" async="async" charset="utf-8"></script>');
}
if (strlen($color['COLOR_1']) == 6) {
	$asset->addString('<meta name="theme-color" content="#'.$color['COLOR_1'].'">');
}

// add styles
$asset->addCss(SITE_TEMPLATE_PATH.'/assets/css/style.css');
// $asset->addCss(SITE_TEMPLATE_PATH.'/assets/lib/fancybox/jquery.fancybox.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/assets/lib/fancybox3/jquery.fancybox.min.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/assets/lib/owl2-2.2.1/owl.carousel.min.css');
// $asset->addCss(SITE_TEMPLATE_PATH.'/assets/lib/jscrollpane/jquery.jscrollpane.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/assets/lib/scrollbar/jquery.scrollbar.css');
$asset->addCss(SITE_TEMPLATE_PATH.'/assets/js/glass/style.css');

// add scripts (lib)
// $asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jquery/jquery-3.2.1.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jquery/jquery-3.2.1.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jquery.mousewheel.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jquery.cookie.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jquery.maskedinput.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/owl2-2.2.1/owl.carousel.min.js');
// $asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jscrollpane/jquery.jscrollpane.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/scrollbar/jquery.scrollbar.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jssor/jssor.core.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jssor/jssor.utils.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jssor/jssor.slider.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/fancybox3/jquery.fancybox.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/scrollto/jquery.scrollTo.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/smoothscroll/SmoothScroll.js');
// $asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/bootstrap/bootstrap.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/bootstrap/bootstrap.min.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/lib/jquery.lazy-master/jquery.lazy.min.js');

// add scripts (our)
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/popup/script.js');
// $asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/jscrollpane.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/glass/script.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/ajaxpages.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/script.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/offers.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/timer.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/tabs.js');

// init default templates
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/basket.js');
$asset->addJs(SITE_TEMPLATE_PATH.'/assets/js/personal.js');

// add custom
$asset->addCss(SITE_TEMPLATE_PATH.'/custom/style.css');
$asset->addJs(SITE_TEMPLATE_PATH.'/custom/script.js');
$asset->addCss(SITE_DIR.'include/style.css');
$asset->addJs(SITE_DIR.'include/script.js');

// add fonts
$asset->addString('<link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">');

// add module version
if (!empty($arModuleVersion['VERSION'])) {
	$asset->addString('<meta property="gopro:version" content="'.$arModuleVersion['VERSION'].'">');
}

?><!DOCTYPE html>
<html xml:lang="<?=LANGUAGE_ID?>" lang="<?=LANGUAGE_ID?>" itemscope itemtype="http://schema.org/WebSite">
<head>
	<title><?php $APPLICATION->ShowTitle(); ?></title>
	<script type="text/javascript">
	var rsGoPro = rsGoPro || {};
		rsGoPro.options = {},
		rsGoPro.options.owl = {},
		rsGoPro.options.fancybox = {};
	var BX_COOKIE_PREFIX = 'BITRIX_SM_',
		SITE_ID = '<?=SITE_ID?>',
		SITE_DIR = '<?=str_replace('//', '/', SITE_DIR);?>',
		SITE_TEMPLATE_PATH = '<?=str_replace('//', '/', SITE_TEMPLATE_PATH);?>',
		SITE_CATALOG_PATH = 'catalog',
		RSGoPro_Adaptive = 'true',
		RSGoPro_FancyCloseDelay = 1000,
		RSGoPro_FancyReloadPageAfterClose = false,
		RSGoPro_FancyOptionsBase = {},
		RSGoPro_OFFERS = {},
		RSGoPro_VIEWED = {},
		RSGoPro_FAVORITE = {},
		RSGoPro_COMPARE = {},
		RSGoPro_INBASKET = {},
		RSGoPro_BASKET = {},
		RSGoPro_STOCK = {},
		RSGoPro_Pictures = {},
		RSGoPro_PHONETABLET = "N",
        RSGoPro_PhoneMask = '<?=$phoneMask?>',
		rsGoProActionVariableName = 'rs_action',
		rsGoProProductIdVariableName = 'rs_id',
		rsGoProLicenseWorkLink = '<?=($licenseWorkLink)?>';
	</script>
    <?php $APPLICATION->ShowHead(); ?>
    <script type="text/javascript">
    BX.message({
		"RSGOPRO_JS_TO_MACH_CLICK_LIKES": '<?=CUtil::JSEscape(Loc::getMessage('RSGOPRO.JS_TO_MACH_CLICK_LIKES'))?>',
		"RSGOPRO_IN_STOCK_ISSET": '<?=CUtil::JSEscape(Loc::getMessage('RSGOPRO.IN_STOCK_ISSET'))?>',
		"LICENSE_WORK_LINK": '<?=($licenseWorkLink)?>',
		"LICENSE_WORK_LINK_PART1": '<?=CUtil::JSEscape(Loc::getMessage('RSGOPRO.LICENSE_WORK_LINK_PART1'))?>',
		"LICENSE_WORK_LINK_PART2": '<?=CUtil::JSEscape(Loc::getMessage('RSGOPRO.LICENSE_WORK_LINK_PART2'))?>',
	});
    </script>
    <?$APPLICATION->IncludeFile(
        SITE_DIR."include/header/head_end.php",
        array(),
        array("MODE"=>"html")
    );?>
</head>
<body class="<?
	?>rsgopro <?
	?>adaptive <?
	?>prop_option_<?=$skuView?> <?
	?><?=($circular == 'Y' ? 'circular' : '')?> <?
	?><?=$tpanelType?> <?
	?>header_<?=$headerType?> <?
	?>menu_<?=$mainMenuType?> <?
	?><?=($offYandex == 'Y' ? 'js-off-yandex' : '')?> <?
	?><?=(($useHeaderFly == 'Y' && $headerType == 'type1') ? 'header-fly__body-padding' : '')?> <?
	?>">

    <?$APPLICATION->IncludeFile(
        SITE_DIR.'include/header/body_start.php',
        Array(),
        Array('MODE' => 'html')
    );?>
    
	<div id="panel"><?=$APPLICATION->ShowPanel()?></div>
    
    <div id="svg-icons" style="display: none;"></div>
    
	<div class="body" itemscope itemtype="http://schema.org/WebPage"><!-- body -->

		<!-- header type -->
		<?php if ($useHeaderFly == 'Y' || $headerType == 'type2'): ?><?
			?><?php require_once (EXTENDED_PATH_HEADERS.'/fly.php'); ?><?
		?><?php endif; ?>

		<?=($headerType == 'type2' ? '<div class="hidden-xs">' : '')?>

		<?php require_once (EXTENDED_PATH_HEADERS.'/'.$tpanelType.'.php'); ?>

		<?php require_once (EXTENDED_PATH_HEADERS.'/'.$headerType.'.php'); ?>

		<?php require_once (EXTENDED_PATH_HEADERS.'/menu_'.$mainMenuType.'.php'); ?>

		<?=($headerType == 'type2' ? '</div>' : '')?>
		<!-- /header type -->

		<?php if ($isMain != 'Y'): ?>
			<div id="title" class="title">
				<div class="centering">
					<div class="centeringin clearfix">
						<?$APPLICATION->IncludeFile(
							SITE_DIR.'include/header/breadcrumb.php',
							array(),
							array('MODE' => 'html')
						);?>
						<h1 class="pagetitle"><?php $APPLICATION->ShowTitle(false); ?></h1>
					</div>
				</div>
			</div><!-- /title -->
		<?php endif; ?>

		<div id="content" class="content">
			<div class="centering">
				<div class="centeringin clearfix">

<?php
if ($isAjax) {
	$APPLICATION->RestartBuffer();
	?><div class="restart-buffer"><div class="restart-buffer__content"><?
}
