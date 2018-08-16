<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Config\Option;

$moduleId = 'redsign.tuning';

Option::set($moduleId, 'dirOptionsExt', WIZARD_SITE_DIR.'include/tuning/options.ext.php', WIZARD_SITE_ID);
Option::set($moduleId, 'fileColorCompiled', WIZARD_SITE_DIR.'include/tuning/color.css', WIZARD_SITE_ID);
Option::set($moduleId, 'fileColorMacros', WIZARD_SITE_DIR.'include/tuning/color.macros', WIZARD_SITE_ID);
Option::set($moduleId, 'fileOptions', WIZARD_SITE_DIR.'include/tuning/options.php', WIZARD_SITE_ID);

if ($obModule = \CModule::CreateModuleObject($moduleId)){
	if (!$obModule->IsInstalled()){
		$obModule->InstallFiles();
		$obModule->InstallDB();
		$obModule->InstallEvents();
		$obModule->InstallPublic();
	}
}
