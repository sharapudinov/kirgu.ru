<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock'))
	return;

if (!Loader::includeModule('catalog'))
	return;

if (!Loader::includeModule('redsign.devfunc'))
	return;


$arTemplateList = array(
	'horizontal1' => Loc::getMessage('RSGOPRO.SUB_TEMPLATE.horizontal1'),
	'vertical1' => Loc::getMessage('RSGOPRO.SUB_TEMPLATE.vertical1'),
	'vertical2' => Loc::getMessage('RSGOPRO.SUB_TEMPLATE.vertical2'),
);

$arTemplateParameters['RSGOPRO_SUB_TEMPLATE'] = array(
	'NAME' => Loc::getMessage('RSGOPRO.SUB_TEMPLATE'),
	'TYPE' => "LIST",
	'VALUES' => $arTemplateList,
	'DEFAULT' => 'vertical1',
	'REFRESH' => 'Y',
);

switch ($arCurrentValues['RSGOPRO_SUB_TEMPLATE']) {
	case 'horizontal1':
		$subTemplateFolder = 'horizontal1';
		break;
	case 'vertical2':
		$subTemplateFolder = 'vertical2';

		$arTemplateParameters["RSGOPRO_CATALOG_PATH"] = array(
			"NAME" => GetMessage("RSGOPRO_CATALOG_PATH"),
			"TYPE" => "STRING",
			"DEFAULT" => "/catalog/",
		);
		$arTemplateParameters["RSGOPRO_MAX_ITEM"] = array(
			"NAME" => GetMessage("RSGOPRO_MAX_ITEM"),
			"TYPE" => "STRING",
			"DEFAULT" => "9",
		);
		$arTemplateParameters["RSGOPRO_IS_MAIN"] = array(
			"NAME" => GetMessage("RSGOPRO_IS_MAIN"),
			"TYPE" => "STRING",
			"DEFAULT" => "N",
		);
		$arTemplateParameters["RSGOPRO_PROPCODE_ELEMENT_IN_MENU"] = array(
			"NAME" => GetMessage("RSGOPRO_PROPCODE_ELEMENT_IN_MENU"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		);

		break;
	default: // vertical1
		$subTemplateFolder = 'vertical1';

		$arTemplateParameters["RSGOPRO_CATALOG_PATH"] = array(
			"NAME" => GetMessage("RSGOPRO_CATALOG_PATH"),
			"TYPE" => "STRING",
			"DEFAULT" => "/catalog/",
		);
		$arTemplateParameters["RSGOPRO_MAX_ITEM"] = array(
			"NAME" => GetMessage("RSGOPRO_MAX_ITEM"),
			"TYPE" => "STRING",
			"DEFAULT" => "9",
		);
		$arTemplateParameters["RSGOPRO_IS_MAIN"] = array(
			"NAME" => GetMessage("RSGOPRO_IS_MAIN"),
			"TYPE" => "STRING",
			"DEFAULT" => "N",
		);
		$arTemplateParameters["RSGOPRO_PROPCODE_ELEMENT_IN_MENU"] = array(
			"NAME" => GetMessage("RSGOPRO_PROPCODE_ELEMENT_IN_MENU"),
			"TYPE" => "STRING",
			"DEFAULT" => "",
		);

}

$arDFParamsCatalog = RSDevFuncParameters::GetTemplateParamsCatalog($arCurrentValues);
foreach ($arDFParamsCatalog as $PNAME => $arParam) {
	$arTemplateParameters[$PNAME] = $arParam;
}
