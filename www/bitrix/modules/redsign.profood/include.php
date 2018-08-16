<?php

use \Bitrix\Main\IO,
    \Bitrix\Main\Loader,
    \Bitrix\Main\Application,
    \Bitrix\Main\Config\Option;

global $moduleIdGoPro;
$moduleIdGoPro = 'redsign.profood';

$arClasses = array(
    '\Redsign\GoPro\ProFood\Main' => 'lib/main.php',
);

Loader::registerAutoLoadClasses($moduleIdGoPro, $arClasses);

if (!function_exists('rsGoProGetTemplatePathPart')) {
    function rsGoProGetTemplatePathPart($sPath, $params = array()) {
        if (empty($sPath))
            return;

        $sPath = str_replace('\\', '/', $sPath);

        if (strpos($sPath, 'templates/'.SITE_TEMPLATE_ID) === false)
            return $sPath;

        global $APPLICATION, $moduleIdGoPro;

        $arParams = array(
            'SHOW_HELP' => 'N',
        );

        foreach ($arParams as $name => $value) {
            if (!empty($params[$name]))
                $arParams[$name] = $params[$name];
        }

        $arPathReplace = array(
            Application::getDocumentRoot().'/bitrix/templates/'.SITE_TEMPLATE_ID,
            Application::getDocumentRoot().'/local/templates/'.SITE_TEMPLATE_ID,
        );
        $pathCustomDir = Application::getDocumentRoot().SITE_DIR.'include/custom/templates/'.SITE_TEMPLATE_ID;

        $pathCustom = str_replace(
            $arPathReplace,
            $pathCustomDir,
            $sPath
        );

        $fileName = IO\Path::getName($sPath);

        if ($arParams['SHOW_HELP'] == 'Y' && Option::get($moduleIdGoPro, 'show_custom_area_help', 'N') == 'Y' && $APPLICATION->GetShowIncludeAreas()) {
            echo '<span style="font-size: 10px; line-height: 1em; word-wrap: break-word; border: 1px dashed black;" title="Create custom file for this area: '.$pathCustom.'">';
            echo $fileName;
            echo '</span>';
        }

        if (file_exists($pathCustom))
            return $pathCustom;

        if (file_exists($sPath))
            return $sPath;

        return false;
    }
}

