<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$filterName = (string)$arParams["CATALOG_FILTER_NAME"];

global ${$filterName};
if (!is_array(${$filterName})) {
	${$filterName} = array();
}

${$filterName} = array_merge(${$filterName}, $arResult['CATALOG_FILTER']);
