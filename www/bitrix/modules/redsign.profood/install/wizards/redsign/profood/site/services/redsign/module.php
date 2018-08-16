<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Loader;

if (Loader::includeModule('redsign.devfunc') && defined('WIZARD_TEMPLATE_ID')) {
    $arData = array(
        'mp_code' => array('redsign.'.WIZARD_TEMPLATE_ID),
    );

    $ret = \Redsign\DevFunc\Module::registerInstallation($arData);
}
