<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Config\Option;

global $moduleId;

$arParams['GOPRO'] = array(
	'OFF_YANDEX' => Option::get($moduleId, 'off_yandex', 'N'),
	'GOOGLE_API_KEY' => Option::get($moduleId, 'google_api_key', ''),
);
