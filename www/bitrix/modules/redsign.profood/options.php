<?php
if (!$USER->IsAdmin())
	return;

use \Bitrix\Main\Loader;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

Loader::includeModule($mid);

$arAllOptions['main'][] = Loc::getMessage('GOPRO.SOLUTION');
$arAllOptions['main'][] = array("phone_mask", Loc::getMessage("GOPRO.PHONE_MASK"), '+7 (999) 999-9999', array("text"));
$arAllOptions['main'][] = array("license_work_link", Loc::getMessage("GOPRO.LICENSE_WORK_LINK"), '', array("text"));
$arAllOptions['main'][] = array("off_yandex", Loc::getMessage("GOPRO.OFF_YANDEX"), '', array("checkbox", 'Y'));
$arAllOptions['main'][] = array("google_api_key", Loc::getMessage("GOPRO.GOOGLE_API_KEY"), '', array("text"));
$arAllOptions['main'][] = array("show_custom_area_help", Loc::getMessage("GOPRO.SHOW_CUSTOM_AREA_HELP"), '', array("checkbox", 'Y'));

if ((isset($_REQUEST['save']) ||isset($_REQUEST['apply']) ) && check_bitrix_sessid()) {
    __AdmSettingsSaveOptions($mid, $arAllOptions['main']);
    LocalRedirect('settings.php?mid='.$mid.'&lang='.LANG);
}

$aTabs = array(
	array(
        'DIV' => 'redsign_gopro1',
        'TAB' => Loc::getMessage('GOPRO.TAB_NAME_SETTINGS'),
        'ICON' => '',
        'TITLE' => Loc::getMessage('GOPRO.TAB_TITLE_SETTINGS')
    ),
);

$tabControl = new CAdminTabControl('tabControl', $aTabs);

?><form method="post" action="<?=$APPLICATION->GetCurPage()?>?mid=<?=urlencode($mid)?>&amp;lang=<?=LANGUAGE_ID?>" name="gopro"><?
	echo bitrix_sessid_post();

	$tabControl->Begin();
  
	$tabControl->BeginNextTab();
	__AdmSettingsDrawList($mid, $arAllOptions['main']);

	$tabControl->Buttons(array());
	$tabControl->End();

?></form>

<?php
echo BeginNote();
echo Loc::getMessage('GOPRO.NOTE.CLEAR_CACHE');
echo '<br>';
echo Loc::getMessage('GOPRO.NOTE.SHOW_CUSTOM_AREA_HELP');
echo EndNote();
