<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0) {

	// echo"<textarea style='color:red;'>";
	// print_r($arResult['ITEMS'][2]);
	// echo"</textarea>";

	// ajaxpages && sorterchange -> start
	if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.start.php', $getTemplatePathPartParams))) {
		include($path);
	}

	$templateExtFolder = EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/';

	switch ($arParams['VIEW']) {
		case 'table':
			if (file_exists($path = rsGoProGetTemplatePathPart($templateExtFolder.'/table/template.php', $getTemplatePathPartParams))) {
				include($path);
			}
			break;
		case 'gallery':
			if (file_exists($path = rsGoProGetTemplatePathPart($templateExtFolder.'/gallery/template.php', $getTemplatePathPartParams))) {
				include($path);
			}
			break;
		default:
			if (file_exists($path = rsGoProGetTemplatePathPart($templateExtFolder.'/showcase/template.php', $getTemplatePathPartParams))) {
				include($path);
			}
	}

	// ajaxpages && sorterchange -> start
	if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.finish.php', $getTemplatePathPartParams))) {
		include($path);
	}

} elseif ($arParams['SHOW_ERROR_EMPTY_ITEMS'] == 'Y') {
	ShowError(Loc::getMessage('ERROR_EMPTY_ITEMS'));
}

$templateData['ADD_HIDER'] = false;
if (!is_array($arResult['ITEMS']) || count($arResult['ITEMS']) < 1 && $arParams['EMPTY_ITEMS_HIDE_FIL_SORT'] == 'Y' && empty($_REQUEST['set_filter']) ) {
	$templateData['ADD_HIDER'] = true;
}
