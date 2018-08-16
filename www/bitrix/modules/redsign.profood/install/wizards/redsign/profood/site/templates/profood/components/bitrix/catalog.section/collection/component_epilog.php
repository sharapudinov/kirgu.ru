<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/component_epilog.php');

$APPLICATION->AddHeadScript(SITE_TEMPLATE_PATH.'/components/bitrix/catalog.section/gopro/script.js');
