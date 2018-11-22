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
	'RSGOPRO_BANNER_TYPE' => array(
		'NAME' => Loc::getMessage('RSGOPRO_BANNER_TYPE'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'RSGOPRO_BLANK' => array(
		'NAME' => Loc::getMessage('RSGOPRO_BLANK'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'RSGOPRO_PROP_LINE1' => array(
		'NAME' => Loc::getMessage('RSGOPRO_PROP_LINE1'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'RSGOPRO_PROP_LINE2' => array(
		'NAME' => Loc::getMessage('RSGOPRO_PROP_LINE2'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'RSGOPRO_PROP_LINE3' => array(
		'NAME' => Loc::getMessage('RSGOPRO_PROP_LINE3'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['SNL'],
	),
	'RSGOPRO_CHANGE_SPEED' => array(
		'NAME' => Loc::getMessage('RSGOPRO_CHANGE_SPEED'),
		'TYPE' => 'STRING',
		'DEFAULT' => '2000',
	),
	'RSGOPRO_CHANGE_DELAY' => array(
		'NAME' => Loc::getMessage('RSGOPRO_CHANGE_DELAY'),
		'TYPE' => 'STRING',
		'DEFAULT' => '8000',
	),
	'RSGOPRO_BANNER_HEIGHT' => array(
		'NAME' => Loc::getMessage('RSGOPRO_BANNER_HEIGHT'),
		'TYPE' => 'STRING',
		'DEFAULT' => '411',
	),
	'RSGOPRO_BANNER_VIDEO_MP4' => array(
		'NAME' => Loc::getMessage('RSGOPRO_BANNER_VIDEO_MP4'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
	'RSGOPRO_BANNER_VIDEO_WEBM' => array(
		'NAME' => Loc::getMessage('RSGOPRO_BANNER_VIDEO_WEBM'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
	'RSGOPRO_BANNER_VIDEO_PIC' => array(
		'NAME' => Loc::getMessage('RSGOPRO_BANNER_VIDEO_PIC'),
		'TYPE' => 'LIST',
		'VALUES' => $listProp['F'],
	),
);
