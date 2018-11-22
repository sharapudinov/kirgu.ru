<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

$templateExtFolder = Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/template_ext/catalog.section/gopro/';

switch($arParams['VIEW']) {
	case 'table': //////////////////////////////////////// table ////////////////////////////////////////
		include($templateExtFolder."/table.php");
		break;
	case 'gallery': //////////////////////////////////////// gallery ////////////////////////////////////////
		include($templateExtFolder."/gallery.php");
		break;
	default: //////////////////////////////////////// showcase ////////////////////////////////////////
		include($templateExtFolder."/showcase.php");
}

$templateData['ADD_HIDER'] = false;
if (!is_array($arResult['ITEMS']) || count($arResult['ITEMS']) < 1 && $arParams['EMPTY_ITEMS_HIDE_FIL_SORT'] == 'Y' && empty($_REQUEST['set_filter']) ) {
	$templateData['ADD_HIDER'] = true;
}
