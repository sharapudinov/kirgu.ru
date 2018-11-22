<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

global $APPLICATION;

// $templateData['imageOg'] && $templateData['imageOgOffer'] from "extended/components/js-pictures.php"
if (!empty($templateData['imageOg'])) {
    $APPLICATION->SetPageProperty("og:image", $templateData['imageOg']);
} elseif (!empty($templateData['imageOgOffer'])) {
    $APPLICATION->SetPageProperty("og:image", $templateData['imageOgOffer']);
}
