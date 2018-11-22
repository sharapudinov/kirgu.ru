<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use Bitrix\Main\Localization\Loc;

if ($_REQUEST['rsec_ajax_post'] == 'Y' && $_REQUEST['rsec_mode'] == 'compare') {

	$APPLICATION->RestartBuffer();

	// compare delete
	if (!empty($_SESSION[$arParams["COMPARE_NAME"]][$arParams["COMPARE_IBLOCK_ID"]]["ITEMS"])) {
		foreach($_SESSION[$arParams["COMPARE_NAME"]][$arParams["COMPARE_IBLOCK_ID"]]["ITEMS"] as $key => $ar) {
			$deleteTmp = ($_REQUEST["DELETE_".$key]=='Y')?'Y':'N';
			if ($deleteTmp=='Y') {
				unset($_SESSION[$arParams["COMPARE_NAME"]][$arParams["COMPARE_IBLOCK_ID"]]["ITEMS"][$key]);
			}
		}
	}

	$APPLICATION->IncludeFile(
		SITE_DIR."include/easycart/compare.php",
		array(),
		array("MODE" => "html")
	);

	die();
} else {
  ?><div class="rsec_thistab_compare"><div class="rsec_emptytab rsec_clearfix"><div class="rsec_emptytab_icon"><?=loc::getMessage('NO_ITEMS_rsec_thistab_compare')?></div></div></div><?
}
