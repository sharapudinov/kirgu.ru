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
	'RSGOPRO_PROP_IMAGES' => array(
		'NAME' => Loc::getMessage('RSGOPRO_PROP_IMAGES'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
	'RSGOPRO_SHOW_TITLE' => array(
		'NAME' => Loc::getMessage('RSGOPRO_SHOW_TITLE'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
	'USE_LAZYLOAD' => array(
		'NAME' => GetMessage('USE_LAZYLOAD'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),
);
