<?php

namespace Redsign\Tuning;

use Bitrix\Main\Config\Option;

class OptionManagerSession extends OptionManager {

    function __construct($options) {
        parent::__construct($options);
    }

    public function getOption($optionName, $default = '') {
        if (isset($_SESSION['redsign.tuning'][$optionName])) {
            return $_SESSION['redsign.tuning'][$optionName];
        } else {
            return $default;
        }
    }

    public function saveOption($optionName, $value) {
        $_SESSION['redsign.tuning'][$optionName] = $value;
    }

}
