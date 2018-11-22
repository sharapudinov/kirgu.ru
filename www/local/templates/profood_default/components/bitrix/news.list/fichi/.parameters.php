<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

if (!Loader::includeModule('iblock'))
	return;
if (!Loader::includeModule('redsign.devfunc'))
	return;

Loc::loadMessages(__FILE__);

$listProp = RSDevFuncParameters::GetTemplateParamsPropertiesList($arCurrentValues['IBLOCK_ID']);

$arTemplateParameters = array(
	'RSGOPRO_LINK' => array(
		'NAME' => Loc::getMessage('RSGOPRO_LINK'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'RSGOPRO_BLANK' => array(
		'NAME' => Loc::getMessage('RSGOPRO_BLANK'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
);
