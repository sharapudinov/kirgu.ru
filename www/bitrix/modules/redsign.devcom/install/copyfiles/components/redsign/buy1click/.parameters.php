<?
use Bitrix\Main\Localization\Loc,
		Bitrix\Main\Config\Option;

Loc::loadMessages(__FILE__);

if (!Bitrix\Main\Loader::includeModule('sale'))
	return;

if(!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED!==true)die();

$arShowFieldsList = array(
	"NONE" => Loc::getMessage("NONE"),
	"RS_AUTHOR_NAME" => Loc::getMessage("RS.BUY1CLICK.AUTHOR_NAME"),
	"RS_AUTHOR_EMAIL" => Loc::getMessage("RS.BUY1CLICK.AUTHOR_EMAIL"),
	"RS_AUTHOR_PHONE" => Loc::getMessage("RS.BUY1CLICK.AUTHOR_PHONE"),
);



$siteId = isset($_REQUEST['src_site']) && is_string($_REQUEST['src_site']) ? $_REQUEST['src_site'] : '';
$siteId = substr(preg_replace('/[^a-z0-9_]/i', '', $siteId), 0, 2);

if (!$siteId)
	$siteId = $arCurrentValues["ALFA_SITE_ID"];


$dbPerson = CSalePersonType::GetList(array("SORT" => "ASC", "NAME" => "ASC"), array('ACTIVE' => 'Y', 'LID' => $siteId));
while ($arPerson = $dbPerson->GetNext())
{
	$arPers2Prop[$arPerson["ID"]] = $arPerson["NAME"];

	$dbProp = CSaleOrderProps::GetList(
		array("SORT" => "ASC", "NAME" => "ASC"),
		array("PERSON_TYPE_ID" => $arPerson["ID"])
	);
	while ($arProp = $dbProp->Fetch())
	{
		if ($arProp["IS_LOCATION"] == 'Y')
			continue;

		//$arPers2Prop[$arProp["CODE"]] = $arProp["NAME"];
		$allProps[$arPerson["ID"]][$arProp["ID"]] = $arProp["NAME"];
	}

}
if (!empty($arCurrentValues["ALFA_SALE_PERSON"]))
	$persProp = $arCurrentValues["ALFA_SALE_PERSON"];
else
	$persProp = key($arPers2Prop);


$arComponentParameters = array(
	"GROUPS" => array(
		"FIELDS" => array(
			"NAME" =>Loc::getMessage("RS.BUY1CLICK.GROUP_FIELDS")
		),
		"ADDITIONAL_SETTINGS" => array(
			"NAME" =>Loc::getMessage("RS.BUY1CLICK.GROUP_ADDITIONAL")
		),
		/*"ORDER" => array(
			"NAME" =>Loc::getMessage("RS.BUY1CLICK.GROUP_ORDER")
		)*/
	),
	"PARAMETERS" => array(
		"ALFA_SALE_PERSON" => Array(
			"NAME" => Loc::getMessage("RS.BUY1CLICK.SALE_PERSON"), 
			"TYPE" => "LIST", 
			"VALUES" => $arPers2Prop,
			"PARENT" => "FIELDS",
			"REFRESH" => "Y",
		),
		"SHOW_FIELDS" => Array(
			"NAME" => Loc::getMessage("RS.BUY1CLICK.SHOW_FIELDS"), 
			"TYPE" => "LIST", 
			"MULTIPLE" => "Y", 
			"VALUES" => $allProps[$persProp],
			"PARENT" => "FIELDS",
		),
		"REQUIRED_FIELDS" => Array(
			"NAME" => Loc::getMessage("RS.BUY1CLICK.REQUIRED_FIELDS"), 
			"TYPE" => "LIST", 
			"MULTIPLE" => "Y", 
			"VALUES" => $allProps[$persProp], 
			"PARENT" => "FIELDS",
		),
		"ALFA_USE_CAPTCHA" => array(
			"NAME" => Loc::getMessage("RS.BUY1CLICK.USE_CAPTCHA"),
			"TYPE" => "CHECKBOX",
			"PARENT" => "FIELDS",
			"VALUE" => "Y",
		),
		"ALFA_MESSAGE_AGREE" => array(
			"NAME" => Loc::getMessage("RS.BUY1CLICK.MESSAGE_AGREE"),
			"TYPE" => "STRING",
			"PARENT" => "ADDITIONAL_SETTINGS",
			"DEFAULT" => Loc::getMessage("RS.BUY1CLICK.MESSAGE_AGREE_DEFAULT"),
		),
		"CACHE_TIME"  =>  Array(
			"PARENT" => "CACHE_SETTINGS",
			"DEFAULT" => 3600
		),
		"AJAX_MODE" => array(),
		"DATA" => array(
			"NAME" => Loc::getMessage("RS.BUY1CLICK.DATA"),
			"PARENT" => "ADDITIONAL_SETTINGS",
			"TYPE" => "STRING",
		),
/*		"EVENT_TYPE" => array(
		  "NAME" => Loc::getMessage("RS.BUY1CLICK.EVENT_TYPE"),
		  "PARENT" => "ORDER",
		  "TYPE" => "STRING",
		  "DEFAULT" => "REDSIGN_BUY_ONE_CLICK",
		),*/
		"ALFA_SITE_ID" => Array(
			"PARENT" => "FIELDS",
			"HIDDEN" => 'Y',
			"DEFAULT" => $siteId,
        ),
        "USER_CONSENT" => array(),
	)
);

?>
