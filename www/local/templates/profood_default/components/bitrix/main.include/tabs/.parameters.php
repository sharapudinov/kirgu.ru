<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arTemplateParameters = array(
	'MAIN_TAB_NAME' => array(
		'PARENT' => 'PARAMS',
		'NAME' => Loc::getMessage('PARAMS.TABS.NAME.MAIN_TAB'),
		'TYPE' => 'STRING',
	),
	/*'AJAX_LOAD' => array(
		'NAME' => Loc::getMessage('PARAMS.TABS.AJAX_LOAD'),
		'TYPE' => 'CHECKBOX',
		'VALUE' => 'Y',
		'DEFAULT' => 'Y',
	),*/
	'TABS_COUNT' => array(
		'NAME' => Loc::getMessage('PARAMS.TABS.COUNT'),
		'TYPE' => 'STRING',
		'REFRESH' => 'Y',
	),
);

$count = intval($arCurrentValues['TABS_COUNT']);

if ($count > 0) {
	for ($i = 0; $i < $count; $i++) {
		$arTemplateParameters['TAB_NAME_N'.$i] = array(
			'NAME' => Loc::getMessage('PARAMS.TABS.NAME').' #'.($i + 2),
			'TYPE' => 'STRING',
		);
		$arTemplateParameters['TAB_PATH_N'.$i] = array(
			'NAME' => Loc::getMessage('PARAMS.TABS.PATH').' #'.($i + 2),
			'TYPE' => 'STRING',
		);
	}
}
