<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Loader;

if (Loader::includeModule('redsign.devfunc'))
{
	Redsign\DevFunc\Sale\Location\Region::editCatalogStores($arResult);
}
