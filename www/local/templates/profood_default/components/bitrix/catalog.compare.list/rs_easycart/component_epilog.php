<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

global $rsecCompareFilterGo;
$rsecCompareFilterGo = array();
if (is_array($arResult) && count($arResult) > 0) {
	foreach($arResult as $arItem){
		$rsecCompareFilterGo['ID'][] = $arItem['ID'];
	}
}

if ($_REQUEST['rsec_ajax_post'] == 'Y' && $_REQUEST['rsec_mode'] == 'compare') {
	// compare delete
	foreach ($_SESSION[$arParams["NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"] as $id => $ar) {
		$deleteTmp = ($_REQUEST["DELETE_".$id] == 'Y') ? 'Y' : 'N';
		if ($deleteTmp == 'Y') {
			unset($_SESSION[$arParams["NAME"]][$arParams["IBLOCK_ID"]]["ITEMS"][$id]);
            $key = array_search($id, $rsecCompareFilterGo['ID']);
            if ($key !== false) {
                unset($rsecCompareFilterGo['ID'][$key]);
            }
		}
	}
}

if ((is_array($rsecCompareFilterGo['ID']) && count($rsecCompareFilterGo['ID']) < 1) || empty($rsecCompareFilterGo['ID'])){
	$rsecCompareFilterGo['ID'] = array('0');
}
