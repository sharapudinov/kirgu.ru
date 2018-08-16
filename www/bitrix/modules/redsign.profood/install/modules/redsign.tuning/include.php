<?php

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
use \Bitrix\Main\Localization\Loc;
use \Redsign\Tuning;

Loc::loadMessages(__FILE__);
/**/
$arClasses = array(
    '\Redsign\Tuning\Interfaces\OptionCoreInterface' => 'lib/interfaces/option_core_interface.php',
    '\Redsign\Tuning\Interfaces\OptionManagerInterface' => 'lib/interfaces/option_manager_interface.php',
    '\Redsign\Tuning\TuningCore' => 'lib/tuning_core.php',
    '\Redsign\Tuning\TabCore' => 'lib/tab_core.php',
    '\Redsign\Tuning\OptionCore' => 'lib/option_core.php',
    '\Redsign\Tuning\TuningOption' => 'lib/tuning_option.php',
    '\Redsign\Tuning\OptionManager' => 'lib/option_manager.php',
    '\Redsign\Tuning\OptionManagerBitrix' => 'lib/option_manager_bitrix.php',
    '\Redsign\Tuning\OptionManagerSession' => 'lib/option_manager_session.php',
    '\Redsign\Tuning\CssFileManager' => 'lib/css_file_manager.php',
    '\Redsign\Tuning\MacrosManager' => 'lib/macros_manager.php',
);

Loader::registerAutoLoadClasses('redsign.tuning', $arClasses);

$arJSCoreConfig = array(
    'rs_tuning' => array(
        'js' => '/bitrix/css/redsign.tuning/tuning.js',
        'rel' => array('rs_core'),
    ),
);

foreach ($arJSCoreConfig as $ext => $arExt) {
    CJSCore::RegisterExt($ext, $arExt);
}

$fromSession = Option::get('redsign.tuning', 'fromSession', '', SITE_ID);
$fileOptions = Option::get('redsign.tuning', 'fileOptions', '', SITE_ID);
$fileOptionsExt = Option::get('redsign.tuning', 'fileOptionsExt', '', SITE_ID);
$fileColorMacros = Option::get('redsign.tuning', 'fileColorMacros', '', SITE_ID);
$fileColorCompiled = Option::get('redsign.tuning', 'fileColorCompiled', '', SITE_ID);
$dirOptionsExt = Option::get('redsign.tuning', 'dirOptionsExt', '', SITE_ID);
$arErrors = array();

if (!file_exists(Application::getDocumentRoot().$fileOptions)) {
	$arErrors[] = 'Option file is not found.';
}

$temporary = include(Application::getDocumentRoot().$fileOptions);
if (isset($temporary['PARAMETERS'])) {
    $tabs = $temporary['TABS'];
    $options = $temporary['PARAMETERS'];
} else {
    $tabs = array();
    $options = $temporary;    
}

if (!empty($fileOptionsExt) && $fileOptionsExt != '' && file_exists(Application::getDocumentRoot().$fileOptionsExt)) {
    $temporaryExt = include(Application::getDocumentRoot().$fileOptionsExt);
    if (isset($temporaryExt['PARAMETERS'])) {
        if (!empty($temporaryExt['TABS'])) {
            $tabs = array_merge($tabs, $temporaryExt['TABS']);
        }
        if (!empty($temporaryExt)) {
            $options = array_merge($options, $temporaryExt['PARAMETERS']);
        }
    } else {
        if (!empty($temporaryExt)) {
            $options = array_merge($options, $temporaryExt['PARAMETERS']);
        }
    }
}

if (empty($arErrors)) {

    if ($fromSession == 'Y') {
        $optionsInstance = new Tuning\OptionManagerSession($options);
    } else {
        $optionsInstance = new Tuning\OptionManagerBitrix($options);
    }
    $optionCore = Tuning\TuningOption::getInstance();

    if (!empty($dirOptionsExt) && file_exists(Application::getDocumentRoot().$dirOptionsExt) && is_dir(Application::getDocumentRoot().$dirOptionsExt)) {
        $optionCore->addOptionPath(Application::getDocumentRoot().$dirOptionsExt);
    }
    
    $optionCore->defaultInit();

    $params = array(
        'tabs' => $tabs,
        'options' => $optionsInstance,
    );
    $tuning = Tuning\TuningCore::getInstance($params);

    $instanceMacrosManager = Tuning\MacrosManager::getInstance();
    $instanceMacrosManager->initMacrosList();

} else {
    ShowError($arErrors);
}
