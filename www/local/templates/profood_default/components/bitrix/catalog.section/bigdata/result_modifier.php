<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

include(Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/extended/pathes.php');

include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/result_modifier.php');
