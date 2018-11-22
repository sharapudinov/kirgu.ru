<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__DIR__.'\\'.$arParams['GOPRO']['SUB_TEMPLATE_NAME'].'\\template.php');

$this->setFrameMode(true);

$templateData['GOPRO'] = $arParams['GOPRO'];

include(Application::getDocumentRoot().$arParams['GOPRO']['SUB_TEMPLATE_FOLDER'].'/template.php');
