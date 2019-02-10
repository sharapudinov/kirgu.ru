<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Loader;
use \Bitrix\Catalog\StoreProductTable;
use \Bitrix\Catalog\StoreTable;



$vitrina = Vitrina::getInstance();

$storeAmount= new StoreAmount( $arParams['ELEMENT_ID']);

if ($storeAmount->isVitrina()) {
    $arResult['STORES']['0']['AMOUNT'] = GetMessage("GOPRO.STORES.QUANTITY.DETAIL.VITRINA");
    $arResult['STORES']['VITRINA'] = 'Y';
}
if (Loader::includeModule('redsign.devfunc')) {
    Redsign\DevFunc\Sale\Location\Region::editCatalogStores($arResult);
}
