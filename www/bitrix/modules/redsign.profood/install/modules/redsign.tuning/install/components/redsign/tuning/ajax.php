<?php

define('NO_AGENT_CHECK', true);

use \Bitrix\Main\Loader;
use \Bitrix\Main\Application;
use \Bitrix\Main\Config\Option;
use \Redsign\Tuning;

if (isset($_REQUEST['site_id']) && !empty($_REQUEST['site_id'])) {
	if (!is_string($_REQUEST['site_id']))
		die();
	if (preg_match('/^[a-z0-9_]{2}$/i', $_REQUEST['site_id']) === 1)
		define('SITE_ID', htmlspecialchars($_REQUEST['site_id']));
}

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/prolog_before.php');

$request = Application::getInstance()->getContext()->getRequest();

if ($request->getPost('rstuning_ajax') == 'Y' || $_REQUEST['test'] == 'Y') {

    if (!Loader::includeModule('redsign.tuning')) {
		echo CUtil::PhpToJSObject(array('STATUS' => 'ERROR', 'TEXT' => 'Can not include modules redsign.tuning'));
		die();
	}

    $tuning = Tuning\TuningCore::getInstance();

    $instanceCssFileManager = $tuning->getInstanceCssFileManager();
    $instanceMacrosManager = $tuning->getInstanceMacrosManager();

    $optionList = $tuning->getOptions();

    if (empty($optionList)) {

        echo CUtil::PhpToJSObject(array('STATUS' => 'ERROR', 'TEXT' => 'Options list is empty'));
		die();
    } else {

        $fromSession = Option::get('redsign.tuning', 'fromSession', '', SITE_ID);

        if ($request->getPost('rstuning_action') == 'restoredefaultsettings' || $_REQUEST['test'] == 'Y') {

            $tuning->restoreDefaultOptions();

            echo CUtil::PhpToJSObject(array('STATUS' => 'OK', 'TEXT' => 'Settings restored.'));
            die();
        } else {

            $tuning->saveOptions();

            if ($fromSession != 'Y') {
                $macrosList = $instanceMacrosManager->getReadyMacros();
                $instanceCssFileManager->generateCss($macrosList);

                echo CUtil::PhpToJSObject(array('STATUS' => 'OK', 'TEXT' => 'Settings saved. Css file regenerated.'));
                die();
            }

            echo CUtil::PhpToJSObject(array('STATUS' => 'OK', 'TEXT' => 'Settings saved.'));
            die();
        }
    }

    die();
} else {
    echo CUtil::PhpToJSObject(array('STATUS' => 'ERROR', 'TEXT' => 'Bad request.'));
    die();
}
