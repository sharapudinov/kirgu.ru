<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Page\Asset;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Localization\Loc;
use \Redsign\Tuning;

global $APPLICATION;

$arErrors = array();

if (!Loader::includeModule('redsign.tuning')) {
	$arErrors = 'Not included module redsign.tuning';
}

Loc::loadMessages(__FILE__);

$fromSession = Option::get('redsign.tuning', 'fromSession', '', SITE_ID);

if (!Loader::includeModule('redsign.devfunc')) {
	$arErrors = 'Not included module redsign.devfunc';
}
if (empty($arErrors)) {

    $asset = Asset::getInstance();
	
	CJSCore::Init(array('rs_color', 'rs_tuning'));

	$tuning = Tuning\TuningCore::getInstance();

	$instanceOptionManager = Tuning\OptionManager::getInstance();
    $instanceTab = Tuning\TabCore::getInstance();
    $instanceOption = Tuning\TuningOption::getInstance();
	$instanceCssFileManager = Tuning\CssFileManager::getInstance();
	$instanceMacrosManager = Tuning\MacrosManager::getInstance();

	$asset->addCss($instanceCssFileManager->getFileColorCompiled(), true);
	$asset->addString('<link href="https://fonts.googleapis.com/css?family=Roboto:300,300i,400,400i,600,600i,700,700i,800,800i&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">');

	if ($fromSession != 'Y' && !$USER->IsAdmin())
		return;

	$asset->addCss($arParams['CUSTOM_CSS'], true);
	$asset->addJs($arParams['CUSTOM_JS']);

	$optionList = $instanceOptionManager->getOptions();

	$arResult['FROM_SESSION'] = $fromSession == 'Y' ? 'Y' : 'N';
	$arResult['COOKIE_OPEN'] = $APPLICATION->get_cookie('COOKIE_OPEN', 'RSTUNING') == 'Y' ? 'Y' : 'N';
	$tabActiveFromCookie = $APPLICATION->get_cookie('COOKIE_TAB_ACTIVE', 'RSTUNING');
	$arResult['FORM_ACTION'] = $componentPath.'/ajax.php';
	$arResult['FILE_COLOR_MACROS_CONTENT'] = $instanceCssFileManager->getFileColorMacrosContent();
	$arResult['FILE_COLOR_COMPILED_CONTENT'] = $instanceCssFileManager->getFileColorCompiledContent($instanceMacrosManager->getReadyMacros());
	$arResult['OPTIONS'] = array();
	$arResult['TABS'] = array();
	$arResult['TABS']['ITEMS'] = $instanceTab->getTabList();

	if (!empty($arResult['TABS']['ITEMS'])) {
		if (array_key_exists($tabActiveFromCookie, $arResult['TABS']['ITEMS'])) {
			$arResult['TABS']['FIRST_TAB_ID'] = $tabActiveFromCookie;
		} else {
			reset($arResult['TABS']['ITEMS']);
			$arResult['TABS']['FIRST_TAB_ID'] = key($arResult['TABS']['ITEMS']);
		}
	} else {
		$arResult['TABS'] = array();
	}

	foreach ($optionList as $id => $arOption) {
		$optionObj = $instanceOption->getOptionObjectByName($arOption['TYPE']);
		if ($optionObj != null) {

			$optionObj->onload();

			if ($arOption['MULTIPLE'] == 'Y') {
				$arValues = $instanceOptionManager->get($id);

				if (!empty($arOption['VALUES'])) {
					foreach ($arOption['VALUES'] as $id2 => $arValue) {
						if (array_key_exists($id2, $arValues)) {
							$arOption['VALUES'][$id2]['VALUE'] = $arValues[$id2];
						}
					}
				}
			} else {
				$arOption['VALUE'] = $instanceOptionManager->get($id);
			}

			ob_start();
			$optionObj->showOption($arOption);
			$out = ob_get_contents();
			ob_end_clean();

			$arResult['OPTIONS'][$id] = $arOption;
			$arResult['OPTIONS'][$id]['DISPLAY_HTML'] = $out;

			if (!empty($arResult['TABS']['ITEMS'])) {
				if (!empty($arOption['TAB'])) {
					$arResult['TABS']['ITEMS'][$arOption['TAB']]['OPTIONS'][] = $id;
				} else {
					$arResult['TABS']['ITEMS'][$arResult['TABS']['FIRST_TAB_ID']]['OPTIONS'][] = $id;
				}
			}
		}
	}

	if ($fromSession == 'Y') {
		$asset->addString('<style>'.$arResult['FILE_COLOR_COMPILED_CONTENT'].'</style>');
	}

	$this->IncludeComponentTemplate();

} else {
	ShowError($arErrors);
}
