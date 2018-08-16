<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

switch ($arParams['VIEW']) {
	case 'table':
		$view = 'table';
		break;
	case 'gallery':
		$view = 'gallery';
		break;
	default:
		$view = 'showcase';
}

$this->SetViewTarget('paginator');
if ($arParams['IS_AJAXPAGES'] != 'Y' && $arParams['IS_SORTERCHANGE'] != 'Y' && $arParams['DISPLAY_BOTTOM_PAGER'] == 'Y') {
	echo $arResult['NAV_STRING'];
}
$this->EndViewTarget();

if ($arParams['IS_SORTERCHANGE'] == 'Y') {
	$this->SetViewTarget('paginator');
	echo $arResult['NAV_STRING'];
	$this->EndViewTarget();
	$templateData['paginator'] = $APPLICATION->GetViewContent('paginator');
	$this->SetViewTarget('sorterchange');
}

if ($arParams['IS_AJAXPAGES'] != 'Y') {
	?><!-- <?=$view?> --><div class="gopro-container"><div class="list-<?=$view?> view-<?=$view?> row" id="view-<?=$view?>"><?
}

if ($arParams['IS_AJAXPAGES'] == 'Y') {
	$this->SetViewTarget('view-'.$view);
}
