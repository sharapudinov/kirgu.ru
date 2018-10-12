<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

if (strlen($arParams["CATALOG_FILTER_NAME"]) <= 0 || !preg_match("/^[A-Za-z_][A-Za-z01-9_]*$/", $arParams["CATALOG_FILTER_NAME"])) {
    $arParams["CATALOG_FILTER_NAME"] = "arrFilter";
}
