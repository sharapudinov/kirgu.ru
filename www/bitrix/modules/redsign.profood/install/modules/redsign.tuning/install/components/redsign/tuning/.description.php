<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$arComponentDescription = array(
	'NAME' => GetMessage('RS.TUNING.NAME'),
	'DESCRIPTION' => GetMessage('RS.TUNING.DESCRIPTION'),
	'ICON' => '',
	'PATH' => array(
		'ID' => 'alfa_com',
		'SORT' => 2000,
		'NAME' => GetMessage('RS.TUNING.PATH_NAME_REDSIGN'),
		'CHILD' => array(
			'ID' => 'tuning',
			'NAME' => GetMessage('RS.TUNING.NAMEPATH_NAME_TUNING'),
			'SORT' => 8000,
		),
	),
);
