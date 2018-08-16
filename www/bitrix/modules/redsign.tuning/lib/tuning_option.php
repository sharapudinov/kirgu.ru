<?php

namespace Redsign\Tuning;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\SystemException;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class TuningOption extends OptionCore {

	private static $instance;

	protected $name = '';
	protected $description = '';

	public function showOption($options = array()) {}

	public function onload($options = array()) {}

	public function getOptionName() {
		return $this->name;
	}

	public function getOptionDescription() {
		return $this->description;
	}

	public static function getInstance() {
		if (is_null(self::$instance)) {
			self::$instance = new TuningOption();
		}

		return self::$instance;
	}

}
