<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
  die();

use Bitrix\Main\Localization\Loc;

if ($_REQUEST['rsec_ajax_post'] == 'Y' && $_REQUEST['rsec_mode'] == 'viewed') {

	$APPLICATION->RestartBuffer();

  $APPLICATION->IncludeFile(
    SITE_DIR."include/easycart/viewed_products.php",
    array(),
    array("MODE" => "html")
  );

	die();
} else {
  ?><div class="rsec_thistab_viewed"><div class="rsec_emptytab rsec_clearfix"><div class="rsec_emptytab_icon"><?=loc::getMessage('NO_ITEMS_rsec_thistab_viewed')?></div></div></div><?
}
