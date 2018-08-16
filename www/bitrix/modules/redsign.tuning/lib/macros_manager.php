<?php

namespace Redsign\Tuning;

use Bitrix\Main\Event;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Redsign\Tuning;

Loc::loadMessages(__FILE__);

class MacrosManager {

	private $macrosList = array();
	private $instanceTuning;
    private static $instance;

	public function __construct($tuning) {
		$this->instanceTuning = $tuning;
	}

    public function set($macrosName, $value) {
        return $this->macrosList[$macrosName] = $value;
    }

    public function get($macrosName) {
        return $this->macrosList[$macrosName];
    }

	public function getList() {
		return $this->macrosList;
	}

    public function getReadyMacros() {
		
		$event = new Event('redsign.tuning', 'onBeforeGetReadyMacros', array(
			'ENTITY' => self::$instance,
		));
		$event->send();

        return $this->getList();
    }

	public function initMacrosList() {
		$instanceOptionManager = $this->instanceTuning->getInstanceOptionMananger();

		$optionList = $instanceOptionManager->getOptions();

		if (!empty($optionList)) {
			foreach ($optionList as $id => $arOption) {
				if ($arOption['MULTIPLE'] == 'Y') {
					$arValues = $instanceOptionManager->get($id);

					foreach ($arOption['VALUES'] as $id2 => $arMultipleOption) {
						if (empty($arMultipleOption['CONTROL_NAME']) || empty($arMultipleOption['MACROS']) || $arMultipleOption['MACROS'] == '')
                            continue;

						// save macros values
						$macrosName = $arMultipleOption['MACROS'];
						$tmpValue = $arValues[$id2];
						if (!empty($macrosName) && !empty($tmpValue)) {
							$this->set($macrosName, $tmpValue);
						}
					}
				} else {
					if (empty($arOption['CONTROL_NAME']) || empty($arOption['MACROS']) || $arOption['MACROS'] == '')
						continue;
					
					$value = $instanceOptionManager->get($id);
					
					if (empty($value)) {
						$value = '';
					}

					$macrosName = $arOption['MACROS'];
					$tmpValue = $value;
					if (!empty($macrosName) && !empty($tmpValue)) {
						$this->set($macrosName, $tmpValue);
					}
				}
			}
		}
	}

	public static function getInstance($tuning = array()) {
		if (is_null(self::$instance)) {
			self::$instance = new MacrosManager($tuning);
		}

		return self::$instance;
	}

}
