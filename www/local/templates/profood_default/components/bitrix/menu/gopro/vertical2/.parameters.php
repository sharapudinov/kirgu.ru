<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;

if (!Loader::includeModule('iblock'))
	return;

if (!Loader::includeModule('catalog'))
	return;

if (!Loader::includeModule('redsign.devfunc'))
	return;


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

$arDFParamsCatalog = RSDevFuncParameters::GetTemplateParamsCatalog($arCurrentValues);
foreach ($arDFParamsCatalog as $PNAME => $arParam) {
	$arTemplateParameters[$PNAME] = $arParam;
}
