<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */

$frame = $this->createFrame()->begin();
include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.php');
$frame->beginStub();
$frame->end();
