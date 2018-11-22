<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use \Bitrix\Main\Loader;

$arParams['FILTER_PROP_SCROLL_CNT'] = 7;

if (Loader::includeModule('redsign.devfunc'))
{
	\Redsign\DevFunc\Sale\Location\Region::editSmartFilterResult($arResult);
}
