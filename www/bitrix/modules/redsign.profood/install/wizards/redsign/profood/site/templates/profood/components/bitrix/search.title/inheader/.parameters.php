<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

if (!CModule::IncludeModule('iblock'))
	return;
if (!CModule::IncludeModule('catalog'))
	return;
if (!CModule::IncludeModule('redsign.devfunc'))
	return;

$arTemplateParameters = array(
	"SHOW_INPUT" => array(
		"NAME" => GetMessage("TP_BST_SHOW_INPUT"),
		"TYPE" => "CHECKBOX",
		"DEFAULT" => "Y",
		"REFRESH" => "Y",
	),
	"INPUT_ID" => array(
		"NAME" => GetMessage("TP_BST_INPUT_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => "title-search-input",
	),
	"CONTAINER_ID" => array(
		"NAME" => GetMessage("TP_BST_CONTAINER_ID"),
		"TYPE" => "STRING",
		"DEFAULT" => "title-search",
	),
	"START_HIDDEN" => array(
		"NAME" => GetMessage("START_HIDDEN"),
		"TYPE" => "CHECKBOX",
		"VALUE" => "Y",
		"DEFAULT" => "Y",
	),
	"SHOW_SEARCHBAR" => array(
		"NAME" => GetMessage("SHOW_SEARCHBAR"),
		"TYPE" => "CHECKBOX",
		"VALUE" => "Y",
		"DEFAULT" => "Y",
	),
	"JS_OPENER" => array(
		"NAME" => GetMessage("JS_OPENER"),
		"TYPE" => "CHECKBOX",
		"VALUE" => "Y",
		"DEFAULT" => "Y",
	),
	"JS_OPENER_MOBILE" => array(
		"NAME" => GetMessage("JS_OPENER_MOBILE"),
		"TYPE" => "CHECKBOX",
		"VALUE" => "Y",
		"DEFAULT" => "Y",
	),
);

if ($arCurrentValues['JS_OPENER_MOBILE'] == 'Y') {
	$arTemplateParameters['WINDOW_WIDTH_MOBILE_OPENER_USE'] = array(
		'NAME' => GetMessage('WINDOW_WIDTH_MOBILE_OPENER_USE'),
		'TYPE' => 'STRING',
		'DEFAULT' => '992',
	);
}

$arDFParamsCatalog = RSDevFuncParameters::GetTemplateParamsCatalog($arCurrentValues);
foreach ($arDFParamsCatalog as $PNAME => $arParam) {
	$arTemplateParameters[$PNAME] = $arParam;
}
