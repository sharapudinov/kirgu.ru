<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arParams['IS_AJAXPAGES'] == 'Y') {
	global $JSON;
	$JSON['IDENTIFIER'] = $arParams['AJAXPAGESID'];
	$JSON['HTML'] = $templateData;
}

if ($arParams['IS_SORTERCHANGE'] == 'Y') {
	global $JSON;
	$JSON['HTMLBYID'] = $templateData;
}

if ($templateData['ADD_HIDER']) {
	?><script>var add_hidder = true;</script><?
} else {
	?><script>var add_hidder = false;</script><?	
}

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/components/bitrix/catalog.product.subscribe/gopro/script.js');
