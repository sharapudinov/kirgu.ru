<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Page\Asset;
use \Bitrix\Main\Application;

$asset = Asset::getInstance();

$asset->addJs($templateData['GOPRO']['SUB_TEMPLATE_FOLDER'].'/script.js');

include(Application::getDocumentRoot().$templateData['GOPRO']['SUB_TEMPLATE_FOLDER'].'/component_epilog.php');
