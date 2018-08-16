<?php

namespace Redsign\Tuning;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\SystemException;
use Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

class TabCore {

	private static $instance;
	public static $tabList = array();

	public function __construct($tabs) {
		if (!empty($tabs)) {
			$this->tabList = $tabs;
		}
	}

	public function getTabList($code = '') {
		if (!empty($code)) {
			return $this->tabList[$code];
		} else {
			return $this->tabList;
		}
	}

	public static function getInstance($tabs = null) {
		if (is_null(self::$instance)) {
			self::$instance = new TabCore($tabs);
		}

		return self::$instance;
	}

}
