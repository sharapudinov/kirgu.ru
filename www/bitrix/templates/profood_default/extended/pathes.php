<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

if (!defined('EXTENDED_PATH'))
	define('EXTENDED_PATH', Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/extended');

if (!defined('EXTENDED_PATH_BLOCKS'))
	define('EXTENDED_PATH_BLOCKS', EXTENDED_PATH.'/blocks');

if (!defined('EXTENDED_PATH_COMPONENTS'))
	define('EXTENDED_PATH_COMPONENTS', EXTENDED_PATH.'/components');

if (!defined('EXTENDED_PATH_TEMPLATES'))
	define('EXTENDED_PATH_TEMPLATES', EXTENDED_PATH.'/templates');

if (!defined('EXTENDED_PATH_HEADERS'))
	define('EXTENDED_PATH_HEADERS', EXTENDED_PATH.'/header');

if (!defined('EXTENDED_PATH_CUSTOM_TEMPLATE'))
	define('EXTENDED_PATH_CUSTOM_TEMPLATE', SITE_DIR.'include/custom/');

global $moduleId;
if (!defined('GOPRO_MODULE_ID')) {
	include(EXTENDED_PATH.'/module_id.php');
	define('GOPRO_MODULE_ID', $moduleId);
}
