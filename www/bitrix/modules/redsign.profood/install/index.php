<?

use \Bitrix\Main\Application;
use \Bitrix\Main\EventManager;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\ModuleManager;
use \Bitrix\Main\Localization\Loc;

global $MESS;
$strPath2Lang = str_replace("\\", "/", __FILE__);
$strPath2Lang = substr($strPath2Lang, 0, strlen($strPath2Lang)-strlen("/install/index.php"));
include(GetLangFileName($strPath2Lang."/lang/", "/install/index.php"));

Class redsign_profood extends CModule
{
	var $MODULE_ID = 'redsign.profood';
	var $MODULE_VERSION;
	var $MODULE_VERSION_DATE;
	var $MODULE_NAME;
	var $MODULE_DESCRIPTION;
	var $MODULE_CSS;
	var $MODULE_GROUP_RIGHTS = 'Y';

	function redsign_profood()
	{
		$arModuleVersion = array();

		$path = str_replace("\\", "/", __FILE__);
		$path = substr($path, 0, strlen($path) - strlen("/index.php"));
		include($path."/version.php");

		if (is_array($arModuleVersion)) {
			$this->MODULE_VERSION = $arModuleVersion['VERSION'];
			$this->MODULE_VERSION_DATE = $arModuleVersion['VERSION_DATE'];
		} else {
			$this->MODULE_VERSION = '1.0.0';
			$this->MODULE_VERSION_DATE = '2017-01-01 12:00:00';
		}

		$this->MODULE_NAME = GetMessage('RS.GOPRO.PROFOOD.INSTALL_NAME');
		$this->MODULE_DESCRIPTION = GetMessage('RS.GOPRO.PROFOOD.INSTALL_DESCRIPTION');
		$this->PARTNER_NAME = GetMessage('RS.GOPRO.PROFOOD.INSTALL_COPMPANY_NAME');
		$this->PARTNER_URI = 'https://www.redsign.ru/';
	}


	function InstallDB($install_wizard = true)
	{
		ModuleManager::registerModule($this->MODULE_ID);

		EventManager::getInstance()->registerEventHandler(
			'main',
			'OnBeforeProlog',
			$this->MODULE_ID,
			'Redsign\\GoPro\\ProFood\\Main',
			'ShowPanel'
		);
		EventManager::getInstance()->registerEventHandler(
			'redsign.tuning',
			'onBeforeGetReadyMacros',
			$this->MODULE_ID,
			'Redsign\\GoPro\\ProFood\\Main',
			'rsTuningOnBeforeGetReadyMacros'
		);

		Option::set($this->MODULE_ID, 'wizard_version', '2');

		return true;
	}

	function UnInstallDB($arParams = Array())
	{
		ModuleManager::unRegisterModule($this->MODULE_ID);
		
		EventManager::getInstance()->unRegisterEventHandler(
			'main',
			'OnBeforeProlog',
			$this->MODULE_ID,
			'Redsign\\GoPro\\ProFood\\Main',
			'ShowPanel'
		);
		EventManager::getInstance()->unRegisterEventHandler(
			'redsign.tuning',
			'onBeforeGetReadyMacros',
			$this->MODULE_ID,
			'Redsign\\GoPro\\ProFood\\Main',
			'rsTuningOnBeforeGetReadyMacros'
		);

		Option::Delete($this->MODULE_ID);

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
        CopyDirFiles(Application::getDocumentRoot().'/bitrix/modules/'.$this->MODULE_ID.'/install/modules', Application::getDocumentRoot().'/bitrix/modules', true, true);
	
		return true;
	}

	function InstallPublic()
	{
		return true;
	}

	function UnInstallFiles()
	{
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
