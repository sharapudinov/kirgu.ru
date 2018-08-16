<?php

namespace Redsign\Tuning;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Redsign\Tuning;

Loc::loadMessages(__FILE__);

class CssFileManager {

    private $fileColorMacros;
    private $fileColorCompiled;
	private static $fileColorMacrosContent = null;
	private static $fileColorCompiledContent = null;
    private static $instance;

	public function __construct() {
		$this->fileColorMacros = Option::get('redsign.tuning', 'fileColorMacros', '', SITE_ID);
		$this->fileColorCompiled = Option::get('redsign.tuning', 'fileColorCompiled', '', SITE_ID);
	}

    public function generateCss(array $arMacroses = array()) {
        $file = file_get_contents($this->getFileColorMacros(true));
        file_put_contents($this->getFileColorCompiled(true), $file);

		if (!empty($arMacroses)) {
			require_once($_SERVER["DOCUMENT_ROOT"].'/bitrix/modules/main/classes/general/wizard.php');

        	\CWizardUtil::ReplaceMacros($this->getFileColorCompiled(true), $arMacroses);
		}
	}
	
	public function removeCss() {
		\Bitrix\Main\IO\File::deleteFile($this->getFileColorCompiled(true));
	}

	public function getFileColorMacrosContent() {
		if ($this->fileColorMacrosContent == null) {
			$this->fileColorMacrosContent = file_get_contents($this->getFileColorMacros(true));
		}
		return $this->fileColorMacrosContent;
    }

	public function getFileColorCompiledContent(array $arMacroses = array()) {
		if ($this->fileColorCompiledContent == null) {
			$macrosContent = $this->getFileColorMacrosContent();

			if (!empty($arMacroses)) {
				foreach ($arMacroses as $macrosName => $value) {
					$macrosContent = str_replace('#'.$macrosName.'#', $value, $macrosContent);
				}
			}

			$this->fileColorCompiledContent = $macrosContent;
		}

		return $this->fileColorCompiledContent;
    }

	public function getFileColorMacros($addDocRoot = false) {
		if ($addDocRoot === true) {
			return Application::getDocumentRoot().$this->fileColorMacros;
		} else {
        	return $this->fileColorMacros;
		}
    }

	public function getFileColorCompiled($addDocRoot = false) {
        if ($addDocRoot === true) {
			return Application::getDocumentRoot().$this->fileColorCompiled;
		} else {
        	return $this->fileColorCompiled;
		}
    }

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new CssFileManager();
		}

		return self::$instance;
	}

}
