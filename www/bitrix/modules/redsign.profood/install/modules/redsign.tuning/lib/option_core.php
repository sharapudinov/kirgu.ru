<?php

namespace Redsign\Tuning;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\SystemException;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

abstract class OptionCore implements Interfaces\OptionCoreInterface {

	protected $optionPaths = array();
	public static $optionsList = array();

	public function __construct() {
		
	}

	abstract public function showOption($options = array());

	abstract public function onload($options = array());

	public function defaultInit() {
		$arDefaultPathes = array(
			__DIR__.'/option'
		);
		$option = $this->addOptionsPathByArray($arDefaultPathes);
		$this->readOptionClasses();
	}

	public function readOptionClasses() {
		$options = array();
		
		foreach ($this->optionPaths as $path) {
			try {
				// Get all "*_option.php" files
				$arFiles = new \RegexIterator(
					new \RecursiveIteratorIterator(
						new \RecursiveDirectoryIterator($path)
					),
					'/^.+_option.php$/'
				);
				foreach ($arFiles as $file) {
					// Prepare filename
					$option = $this->sanitizeName(substr($file->getFilename(), 0, -11));
					$optionName = strtolower($option);
					if (array_key_exists($optionName, $options)) {
						continue;
					}

					require_once $file->getPathname();

					$optionObject = $this->getOptionObjectByName($option);
					if (is_object($optionObject)) {
						$options[$optionName] = $optionObject;
					}
				}
			} catch (\Exception $e) {
				throw new SystemException('Error getting options from path: '.$path);
			}
		}
		$this->setOptionsList($options);

		return $this->getOptionsList();
	}

	public function getOptionObjectByName($option) {
		$optionNamespace = __NAMESPACE__."\\".$option.'option';
		if (class_exists($optionNamespace)) {
			return new $optionNamespace();
		}
		return null;
	}

	public function getOptionObjectByOptionName($option) {
		$tmp = $this->getOptionsList();
		if (isset($tmp[$option]) && is_object($tmp[$option])) {
			return $tmp[$option];
		} else {
			return false;
		}
	}

	public function addOptionPath($path) {
		if (!file_exists($path) || !is_dir($path)) {
			throw new SystemException('Option path "'.$path.'" does not exist!');
		}
		if (!in_array($path, $this->optionPaths)) {
			if ($before) {
				array_unshift($this->optionPaths, $path);
			} else {
				array_push($this->optionPaths, $path);
			}
		}
		return $this;
	}

	public function addOptionsPathByArray($arPathes = array()) {
		if (!empty($arPathes)) {
			foreach ($arPathes as $value) {
				$this->addOptionPath($value);
			}
		}
	}

	public function setOptionsList($arOptions = array()) {
		$this->optionsList = $arOptions;
	}

	public function getOptionsList() {
		return $this->optionsList;
	}

	public function sanitizeName($option) {
		return str_replace(' ', '', $this->ucwordsUnicode(str_replace('_', ' ', $option)));
	}

	protected function ucwordsUnicode($str, $encoding = 'UTF-8') {
		return mb_convert_case($str, MB_CASE_TITLE, $encoding);
	}

}
