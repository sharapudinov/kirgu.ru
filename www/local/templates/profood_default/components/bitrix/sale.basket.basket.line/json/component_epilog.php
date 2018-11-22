<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

global $APPLICATION, $JSON;

$JSON = array(
	'TYPE' => 'OK',
	'HTMLBYID' => array(
		'basketinfo' => $arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)'].' '.GetMessage('RSGOPRO.SMALLBASKET_NA').' '.$arResult['TOTAL_PRICE'],
	),
	'NUM_PRODUCTS' => $arResult['NUM_PRODUCTS'],
	'TOTAL_PRICE' => $arResult['TOTAL_PRICE'],
);

if ($arResult['NUM_PRODUCTS'] < 1) {
	$JSON['HTMLBYID']['basketinfo'] = GetMessage('RSGOPRO.SMALLBASKET_PUSTO');
}
