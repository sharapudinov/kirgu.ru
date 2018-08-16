<?php
namespace Redsign\Tuning\Interfaces;

interface OptionCoreInterface {

    function __construct();
    public function showOption($options = array());
    public function onload($options = array());

}
