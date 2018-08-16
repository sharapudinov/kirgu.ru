<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Page\Asset;

$asset = Asset::getInstance();

if ($templateData['GOPRO']['OFF_YANDEX'] != 'Y') {
    $asset->addString('<script src="//api-maps.yandex.ru/2.1/?lang=ru_RU" type="text/javascript"></script>', true);
} else {
    $asset->addString('<script async defer src="//maps.googleapis.com/maps/api/js?key='.$templateData['GOPRO']['GOOGLE_API_KEY'].'"></script>', true);
}
