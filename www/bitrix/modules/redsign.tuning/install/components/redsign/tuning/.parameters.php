<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$arComponentParameters = array(
	'PARAMETERS' => array(
		'FILE_OPTIONS' => array(
			'NAME' => 'FILE_OPTIONS',
			'TYPE' => 'STRING',
		),
		'FILE_COLORS' => array(
			'NAME' => 'FILE_COLORS',
			'TYPE' => 'STRING',
		),
	)
);
