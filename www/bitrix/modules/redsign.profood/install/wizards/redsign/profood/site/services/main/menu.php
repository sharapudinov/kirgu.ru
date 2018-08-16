<?
if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)
	die();

WizardServices::IncludeServiceLang("menu.php", $lang);
CModule::IncludeModule('fileman');
$arMenuTypes = GetMenuTypes(WIZARD_SITE_ID);

$arMenuTypes['tpanel'] = GetMessage('WIZ_MENU_tpanel');
$arMenuTypes['catalog'] = GetMessage('WIZ_MENU_catalog');
$arMenuTypes['footer'] = GetMessage('WIZ_MENU_footer');
$arMenuTypes['footercatalog'] = GetMessage('WIZ_MENU_footercatalog');

SetMenuTypes($arMenuTypes, WIZARD_SITE_ID);
COption::SetOptionInt("fileman", "num_menu_param", 2, false ,WIZARD_SITE_ID);
