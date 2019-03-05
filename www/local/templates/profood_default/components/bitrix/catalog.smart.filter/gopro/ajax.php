<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main;
use \Bitrix\Main\Loader;

if (Loader::includeModule('redsign.devfunc')) {
	\Redsign\DevFunc\Sale\Location\Region::editSmartFilterResult($arResult);
}

if (intval($this->__component->SECTION_ID) < 1)
{
    $FILTER_NAME = (string)$arParams["FILTER_NAME"];

    global ${$FILTER_NAME};
    if(!is_array(${$FILTER_NAME}))
        ${$FILTER_NAME} = array();

    $arFilter = $this->__component->makeFilter($FILTER_NAME);

    unset($arFilter['INCLUDE_SUBSECTIONS']);
    unset($arFilter['FACET_OPTIONS']);

    $arResult["ELEMENT_COUNT"] = CIBlockElement::GetList(array(), $arFilter, array(), false);
}

if ($arParams['INSTANT_RELOAD'] == 'Y' && $arParams['TEMPLATE_AJAXID'])
{
	$arResult['COMPONENT_CONTAINER_ID'] = $arParams['TEMPLATE_AJAXID'];
	$arResult['INSTANT_RELOAD'] = true;
}

$APPLICATION->RestartBuffer();
unset($arResult["COMBO"]);

if (!empty($arResult))
{
    $arResult['JS'] = Main\Page\Asset::getInstance()->getJs();
}

echo Main\Web\Json::encode($arResult);
