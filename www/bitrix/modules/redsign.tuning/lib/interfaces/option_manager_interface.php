<?php
namespace Redsign\Tuning\Interfaces;

interface OptionManagerInterface {

    function __construct($defaultOptions);
    public function getOption($optionName, $default = '');
    public function saveOption($optionName, $value);

}
