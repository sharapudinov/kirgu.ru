<?
/** @global CMain $APPLICATION */
define('NO_AGENT_CHECK', true);
define('NOT_CHECK_PERMISSIONS', true);

use Bitrix\Main\Localization\Loc,
	Bitrix\Main\Loader;


if (isset($_REQUEST['lid']) && !empty($_REQUEST['lid']))
{
	if (!is_string($_REQUEST['lid']))
		die();
	if (preg_match('/^[a-z0-9_]{2}$/i', $_REQUEST['lid']))
		define('SITE_ID', $_REQUEST['lid']);
}

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (!Loader::includeModule('catalog'))
	return;

Loc::loadMessages(__FILE__);

if ($_SERVER["REQUEST_METHOD"]=="POST" && strlen($_POST["action"])>0 && check_bitrix_sessid())
{
	$APPLICATION->RestartBuffer();

	switch ($_POST["action"])
	{
		case "catalogSetAdd2Basket":
			if (is_array($_POST["set_ids"]))
			{
				foreach($_POST["set_ids"] as $itemID)
				{
					if (!is_string($itemID))
						continue;
					$itemID = (int)$itemID;
					if ($itemID <= 0)
						continue;

					$product_properties = true;
					if (!empty($_POST["setOffersCartProps"]))
					{
						$product_properties = CIBlockPriceTools::GetOfferProperties(
							$itemID,
							$_POST["iblockId"],
							$_POST["setOffersCartProps"]
						);
					}
					$ratio = 1;
					if ($_POST["itemsRatio"][$itemID])
						$ratio = $_POST["itemsRatio"][$itemID];

					$successfulAdd = Add2BasketByProductID($itemID, $ratio, array("LID" => $_POST["lid"]), $product_properties);
				}
			}

			$APPLICATION->IncludeComponent('bitrix:sale.basket.basket.line','json',array());
			$APPLICATION->RestartBuffer();
			if (SITE_CHARSET != 'utf-8') {
				$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
				$json_str_utf = json_encode($data);
				$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
				echo $json_str;
			} else {
				echo json_encode( $arResult['JSON_EXT'] );
			}
			break;
		/* custom */
		case "ajax_recount_prices":
			if (strlen($_POST["currency"])>0)
			{
				$arPices = array("formatSum" => "", "formatOldSum" => "", "formatDiscDiffSum" => "");
				if ($_POST["sumPrice"])
					$arPices["formatSum"] = FormatCurrency($_POST["sumPrice"], $_POST["currency"]);
				if ($_POST["sumOldPrice"] && $_POST["sumOldPrice"] != $_POST["sumPrice"])
					$arPices["formatOldSum"] = FormatCurrency($_POST["sumOldPrice"], $_POST["currency"]);
				if ($_POST["sumDiffDiscountPrice"])
					$arPices["formatDiscDiffSum"] = FormatCurrency($_POST["sumDiffDiscountPrice"], $_POST["currency"]);

				if (SITE_CHARSET != "utf-8")
					$arPices = $APPLICATION->ConvertCharsetArray($arPices, SITE_CHARSET, "utf-8");
				echo json_encode($arPices);
			}
			break;
		/* /custom */
	}

	die();
}
