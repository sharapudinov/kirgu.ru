<?php

namespace Redsign\Tuning;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Redsign\Tuning;

Loc::loadMessages(__FILE__);

class TuningCore {

    private $instanceOptionManager;
    private $instanceOption;
    private $instanceCssFileManager;
    private $instanceMacrosManager;
    private static $instance;
    private static $allOptions;

    function __construct(Interfaces\OptionManagerInterface $instanceOptionManager) {
        $this->instanceOptionManager = $instanceOptionManager;
        $this->instanceOption = TuningOption::getInstance();
        $this->instanceCssFileManager = CssFileManager::getInstance();
        $this->instanceMacrosManager = MacrosManager::getInstance($this);

        self::$instance = $this;
    }

    public function getOptionValue($optionName) {
        return $this->instanceOption->get($optionName);
    }

    public function getInstanceOptionMananger() {
        return $this->instanceOptionManager;
    }

    public function getInstanceOption() {
        return $this->instanceOption;
    }

    public function getInstanceCssFileManager() {
        return $this->instanceCssFileManager;
    }

    public function getInstanceMacrosManager() {
        return $this->instanceMacrosManager;
    }

    public function setOptionValue($optionName, $value) {
        $this->instanceOption->set($optionName, $value);
    }

    public function getSettings() {
        return $this->allOptions;
    }

    public function getInstance($instanceOptionManager = array()) {
        $intstance = null;
        if (!empty(self::$instance) && self::$instance instanceof TuningCore) {
            $instance = self::$instance;
        } else {
            $instance = new TuningCore($instanceOptionManager);
        }

        return $instance;
    }
}
