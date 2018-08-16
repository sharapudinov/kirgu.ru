<?php

namespace Redsign\Tuning;

use Bitrix\Main\Config\Option;
use Redsign\Tuning;

defined('ADMIN_MODULE_NAME') or define('ADMIN_MODULE_NAME', 'redsign.tuning');

abstract class OptionManager implements Interfaces\OptionManagerInterface {

    public $options = array();
    public $optionValuesDefault = array();
    public $optionValues = array();

    function __construct($options) {
        $this->options = $options;
        $this->initOptions();
    }

    abstract public function getOption($optionName, $default = '');

    abstract public function saveOption($optionName, $value);

    public function set($optionName, $value) {
        if (array_key_exists($optionName, $this->options)) {

            $this->optionValues[$name] = $value;

            $valueTmp = $value;
            if (is_array($value)) {
                $valueTmp = serialize($value);
            }

            $this->saveOption($optionName, $valueTmp);
        }
    }

    public function get($optionName) {
        if (array_key_exists($optionName, $this->options)) {
            return $this->optionValues[$optionName];
        } else {
            return false;
        }
    }

    public function getOptions() {
        return $this->options;
    }

    public function saveOptionsByArray($arValues) {
        foreach ($arValues as $optionName => $value) {
            $this->set($optionName, $value);
        }
    }

    private function initOptions() {
        $defaultOption = array();
        $optionValues = array();

        if (!is_array($this->options) || empty($this->options))
            return;

        foreach ($this->options as $optionName => $arOption) {
            if ($arOption['MULTIPLE'] == 'Y') {
                if (!empty($arOption['VALUES'])) {
                    $defaultOption[$optionName] = array();
                    $optionValues[$optionName] = array();
                    foreach ($arOption['VALUES'] as $id => $arMultipleOption) {
                        if (!empty($arMultipleOption['DEFAULT'])) {
                            $defaultOption[$optionName][$id] = $arMultipleOption['DEFAULT'];
                        }
                    }
                    $optionValues[$optionName] = unserialize($this->getOption($optionName, serialize($defaultOption[$optionName])));
                }
            } else {
                if (!empty($arOption['DEFAULT'])) {
                    $defaultOption[$optionName] = $arOption['DEFAULT'];
                    $optionValues[$optionName] = $this->getOption($optionName, $arOption['DEFAULT']);
                }
            }
        }

        $this->optionValuesDefault = $defaultOption;
        $this->optionValues = $optionValues;
    }

    public function getInstance() {
        return Tuning\TuningCore::getInstance()->getInstanceOptionMananger();
    }
}
