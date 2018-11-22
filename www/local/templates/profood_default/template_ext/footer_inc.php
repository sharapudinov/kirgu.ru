<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Loader;
use \Bitrix\Main\Page\Frame;
use \Bitrix\Main\Config\Option;

Frame::getInstance()->startDynamicWithID('footer_inc');

// viewed
if (Loader::includeModule('catalog') && Loader::includeModule('sale')) {
        
    $arrViewedIds = array();
    $userBasketId = \CSaleBasket::GetBasketUserID();
	$countViewed = Option::get('catalog', 'viewed_count', 0);

	$viewedIterator = \Bitrix\Catalog\CatalogViewedProductTable::getList(
		array(
			'filter' => array('FUSER_ID' => $userBasketId, 'SITE_ID' => SITE_ID),
			'select' => array('ID', 'PRODUCT_ID'),
			'order' => array('DATE_VISIT' => 'DESC'),
			'limit' => $countViewed,
		)
	);

	while ($arItem = $viewedIterator->fetch()) {
		$arrViewedIds[$arItem['PRODUCT_ID']] = 'Y';
	}

    ?><script>RSGoPro_VIEWED = <?=json_encode($arrViewedIds)?>;</script><?
}

// compare
global $compareName, $compareIblockId;
if (!empty($_SESSION[$compareName][$compareIblockId]['ITEMS'])) {
    $arrCompareIds = array();
    foreach ($_SESSION[$compareName][$compareIblockId]['ITEMS'] as $arItem) {
        $arrCompareIds[$arItem['ID']] = 'Y';
    }
    ?><script>RSGoPro_COMPARE = <?=json_encode($arrCompareIds)?>;</script><?
}

Frame::getInstance()->finishDynamicWithID('footer_inc', '');
