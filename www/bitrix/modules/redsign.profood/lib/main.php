<?php

namespace Redsign\GoPro\ProFood;

use Bitrix\Main\Loader;
use Bitrix\Main\Page\Asset;
use Bitrix\Main\Config\Option;
use Bitrix\Main\Localization\Loc;
use Redsign\GoPro\ProFood;

Loc::loadMessages(__FILE__);

class Main {

    public static function rsTuningOnBeforeGetReadyMacros(\Bitrix\Main\Event $event) {

        if (!Loader::includeModule('redsign.devfunc'))
            return;

        $arParams = $event->getParameters();
        $macrosManager = $arParams['ENTITY'];

        $macrosList = $macrosManager->getList();

        $color11 = $macrosList['COLOR_1_1'];
        if (strlen($color11) == 6) {
            $rsColor11 = new \RSColor($color11);
            $macrosManager->set('COLOR_1_1_DARKEN_10_PERSENT', $rsColor11->darken(10)->getHex());
        } else {
            $macrosManager->set('COLOR_1_1_DARKEN_10_PERSENT', $color11);
        }

        $color12 = $macrosList['COLOR_1_2'];
        if (strlen($color12) == 6) {
            $rsColor12 = new \RSColor($color12);
            $macrosManager->set('COLOR_1_2_DARKEN_10_PERSENT', $rsColor12->darken(10)->getHex());
        } else {
            $macrosManager->set('COLOR_1_2_DARKEN_10_PERSENT', $color12);
        }
    }

    public static function ShowPanel() {
        if ($GLOBALS["USER"]->IsAdmin() && Option::get('main', 'wizard_solution', '', SITE_ID) == 'redsign.profood') {

            $asset = Asset::getInstance();
            $asset->addCss('/bitrix/wizards/redsign/profood/css/panel.css');

            $arMenu = Array(
                Array(        
                    "ACTION" => "jsUtils.Redirect([], '".\CUtil::JSEscape("/bitrix/admin/wizard_install.php?lang=".LANGUAGE_ID."&wizardSiteID=".SITE_ID."&wizardName=redsign:profood&".bitrix_sessid_get())."')",
                    "ICON" => "bx-popup-item-wizard-icon",
                    "TITLE" => Loc::getMessage("STOM_BUTTON_TITLE_W1"),
                    "TEXT" => Loc::getMessage("STOM_BUTTON_NAME_W1"),
                )
            );

            $GLOBALS["APPLICATION"]->AddPanelButton(array(
                "HREF" => "/bitrix/admin/wizard_install.php?lang=".LANGUAGE_ID."&wizardName=redsign:profood&wizardSiteID=".SITE_ID."&".bitrix_sessid_get(),
                "ID" => "profood_wizard",
                "ICON" => "bx-panel-site-wizard-icon",
                "MAIN_SORT" => 2500,
                "TYPE" => "BIG",
                "SORT" => 10,    
                "ALT" => Loc::getMessage("SCOM_BUTTON_DESCRIPTION"),
                "TEXT" => Loc::getMessage("SCOM_BUTTON_NAME"),
                "MENU" => $arMenu,
            ));
        }
    }

}
