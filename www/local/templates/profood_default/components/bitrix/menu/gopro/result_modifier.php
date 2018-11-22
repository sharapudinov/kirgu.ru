<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;

$arParams['GOPRO'] = array();
$arParams['GOPRO']['VIEW'] = $arParams['VIEW'];

$templateFolder = $this->__folder;

switch ($arParams['GOPRO']['VIEW']) {
	case 'horizontal1':
		$arParams['GOPRO']['SUB_TEMPLATE_NAME'] = 'horizontal1';
		break;
	case 'vertical2':
		$arParams['GOPRO']['SUB_TEMPLATE_NAME'] = 'vertical2';
		break;
	default: // vert1
		$arParams['GOPRO']['SUB_TEMPLATE_NAME'] = 'vertical1';
}

$arParams['GOPRO']['SUB_TEMPLATE_FOLDER'] = $templateFolder.'/'.$arParams['GOPRO']['SUB_TEMPLATE_NAME'];

include(Application::getDocumentRoot().$arParams['GOPRO']['SUB_TEMPLATE_FOLDER'].'/result_modifier.php');
