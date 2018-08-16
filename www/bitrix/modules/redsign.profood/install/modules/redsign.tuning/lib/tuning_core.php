<?php

namespace Redsign\Tuning;

use Bitrix\Main\Application;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Bitrix\Main\Event;
use Redsign\Tuning;

Loc::loadMessages(__FILE__);

class TuningCore {

    private $instanceOptionManager;
    private $instanceOption;
    private $instanceCssFileManager;
    private $instanceMacrosManager;
    private static $instance;
    private static $allOptions;
    
    const EVENT_ON_AFTER_SAVE_OPTIONS = 'onAfterSaveOptions';

    function __construct(array $params) {
        $tabs = $params['tabs'];
        $instanceOptionManager = $params['options'];
        $this->instanceOptionManager = $instanceOptionManager;
        $this->instanceTab = TabCore::getInstance($tabs);
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

    public function getInstanceGroup() {
        return $this->instanceGroup;
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
        $this->instanceOptionManager->set($optionName, $value);
    }

    public function getOptions() {
        return $this->instanceOptionManager->getOptions();
    }

    public function restoreDefaultOptions() {
        $instanceCssFileManager = $this->getInstanceCssFileManager();
        $instanceMacrosManager = $this->getInstanceMacrosManager();

        $optionList = $this->getOptions();

        if (!is_array($optionList) || empty($optionList))
            return false;
        
        foreach ($optionList as $id => $arOption) {
            if ($arOption['MULTIPLE'] == 'Y') {
                if (!empty($arOption['VALUES']) && !empty($arOption['CONTROL_NAME'])) {
                    $value = array();

                    foreach ($arOption['VALUES'] as $id2 => $arMultipleOption) {
                        if (empty($arOption['DEFAULT']))
                            continue;

                        $value[$id2] = $arOption['DEFAULT'];
                        
                        if (empty($value)) {
                            $value = array();
                        }

                        // save macros values
                        $macrosName = $arMultipleOption['MACROS'];
                        $tmpValue = $value[$id2];
                        if (!empty($macrosName) && !empty($tmpValue)) {
                            $instanceMacrosManager->set($macrosName, $tmpValue);
                        }
                    }

                    // save options value
                    $this->setOptionValue($id, $value);
                }
            } else {
                if (empty($arOption['CONTROL_NAME']))
                    continue;
                
                $value = $arOption['DEFAULT'];
                
                if (empty($value)) {
                    $value = '';
                }

                // save options value
                $this->setOptionValue($id, $value);

                $macrosName = $arOption['MACROS'];
                $tmpValue = $value;
                if (!empty($macrosName) && !empty($tmpValue)) {
                    $instanceMacrosManager->set($macrosName, $tmpValue);
                }
            }
        }

        $instanceCssFileManager->removeCss();
        
        $event = new Event('redsign.tuning', self::EVENT_ON_AFTER_SAVE_OPTIONS);
		$event->send();
        
        return true;
    }
    
    public function saveOptions() {
        $instanceCssFileManager = $this->getInstanceCssFileManager();
        $instanceMacrosManager = $this->getInstanceMacrosManager();

        $optionList = $this->getOptions();

        $request = Application::getInstance()->getContext()->getRequest();

        foreach ($optionList as $id => $arOption) {
            if ($arOption['MULTIPLE'] == 'Y') {
                if (!empty($arOption['VALUES']) && !empty($arOption['CONTROL_NAME'])) {
                    $value = array();
                    $arValue = $request->getPost($arOption['CONTROL_NAME']);
                    
                    foreach ($arOption['VALUES'] as $id2 => $arMultipleOption) {
                        if (empty($arValue[$arMultipleOption['CONTROL_NAME']]))
                            continue;

                        $value[$id2] = $arValue[$arMultipleOption['CONTROL_NAME']];
                        
                        if (empty($value)) {
                            $value = array();
                        }

                        // save macros values
                        $macrosName = $arMultipleOption['MACROS'];
                        $tmpValue = $value[$id2];
                        if (!empty($macrosName) && !empty($tmpValue)) {
                            $instanceMacrosManager->set($macrosName, $tmpValue);
                        }
                    }

                    // save options value
                    $this->setOptionValue($id, $value);

                }
            } else {
                if (empty($arOption['CONTROL_NAME']))
                    continue;
                
                $value = $request->getPost($arOption['CONTROL_NAME']);
                
                if (empty($value)) {
                    $value = '';
                }

                // save options value
                $this->setOptionValue($id, $value);

                $macrosName = $arOption['MACROS'];
                $tmpValue = $value;
                if (!empty($macrosName) && !empty($tmpValue)) {
                    $instanceMacrosManager->set($macrosName, $tmpValue);
                }
            }
            
        }
        
        $event = new Event('redsign.tuning', self::EVENT_ON_AFTER_SAVE_OPTIONS);
		$event->send();
    }

    public function getInstance($params = array()) {
        $intstance = null;
        if (!empty(self::$instance) && self::$instance instanceof TuningCore) {
            $instance = self::$instance;
        } else {
            $instance = new TuningCore($params);
        }

        return $instance;
    }
}
