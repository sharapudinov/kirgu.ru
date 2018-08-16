<?php

use \Bitrix\Main\Application;
use \Bitrix\Main\EventManager;
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class redsign_tuning extends CModule {

    var $MODULE_ID = "redsign.tuning";
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = "Y";

    public function redsign_tuning() {
        $arModuleVersion = array();

        $path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion)) {
			$this->MODULE_VERSION = $arModuleVersion["VERSION"];
			$this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
		}

        $this->MODULE_NAME = GetMessage("RS.TUNING.INSTALL_NAME");
		$this->MODULE_DESCRIPTION = GetMessage("RS.TUNING.INSTALL_DESCRIPTION");
		$this->PARTNER_NAME = GetMessage("RS.TUNING.INSTALL_COPMPANY_NAME");
        $this->PARTNER_URI  = "https://redsign.ru/";
    }

	function InstallDB($install_wizard = true)
	{
		ModuleManager::registerModule($this->MODULE_ID);

		EventManager::getInstance()->registerEventHandler(
			'redsign.tuning',
			'onBeforeGetReadyMacros',
			$this->MODULE_ID,
			'Redsign\\Master\\MyTemplate',
			'rsTuningOnBeforeGetReadyMacros'
		);

		return true;
	}

	function UnInstallDB($arParams = Array())
	{
		ModuleManager::unregisterModule($this->MODULE_ID);

		EventManager::getInstance()->unRegisterEventHandler(
			'redsign.tuning',
			'onBeforeGetReadyMacros',
			$this->MODULE_ID,
			'Redsign\\Master\\MyTemplate',
			'rsTuningOnBeforeGetReadyMacros'
		);

		unset($_SESSION['redsign.tuning']);

		return true;
	}

	function InstallEvents()
	{
		return true;
	}

	function UnInstallEvents()
	{
		return true;
	}

	function InstallFiles()
	{
        CopyDirFiles(Application::getDocumentRoot()."/bitrix/modules/redsign.tuning/install/components", Application::getDocumentRoot()."/bitrix/components", true, true);
		CopyDirFiles(Application::getDocumentRoot().'/bitrix/modules/redsign.tuning/install/css', Application::getDocumentRoot().'/bitrix/css', true, true);
		CopyDirFiles(Application::getDocumentRoot().'/bitrix/modules/redsign.tuning/install/images', Application::getDocumentRoot().'/bitrix/images', true, true);
		CopyDirFiles(Application::getDocumentRoot().'/bitrix/modules/redsign.tuning/install/js', Application::getDocumentRoot().'/bitrix/js', true, true);

		return true;
	}

	function InstallPublic()
	{
        return true;
	}

	function InstallOptions()
	{
        return true;
	}

	function UnInstallFiles()
	{
		DeleteDirFilesEx('/bitrix/css/redsign.tuning');
		DeleteDirFilesEx('/bitrix/images/redsign.tuning');
		DeleteDirFilesEx('/bitrix/js/redsign.tuning');

		return true;
	}

	function DoInstall()
	{
		global $APPLICATION, $step;

		$this->InstallFiles();
		$this->InstallDB(false);
		$this->InstallEvents();
		$this->InstallPublic();
		return true;
	}

	function DoUninstall()
	{
		global $APPLICATION, $step;

		$this->UnInstallDB();
		$this->UnInstallFiles();
		$this->UnInstallEvents();
		return true;
	}
}
