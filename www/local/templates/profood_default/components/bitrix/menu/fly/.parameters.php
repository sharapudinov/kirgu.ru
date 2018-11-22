<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

if (!Loader::includeModule('iblock'))
	return;

$arIBlock = array();
$rsIBlock = \CIBlock::GetList(array('sort' => 'asc'), array('ACTIVE' => 'Y'));
while ($arr = $rsIBlock->Fetch()) {
	$arIBlock[$arr['ID']] = '['.$arr['ID'].'] '.$arr['NAME'];
}

$arTemplateParameters['IBLOCK_ID'] = array(
	'NAME' => Loc::getMessage('RSGOPRO.IBLOCK_ID'),
	'TYPE' => "LIST",
	'VALUES' => $arIBlock,
);
