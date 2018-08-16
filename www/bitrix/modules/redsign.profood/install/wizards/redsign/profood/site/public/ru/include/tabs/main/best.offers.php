<div class="tab-sorter">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/tabs/main/best.offers.sorter.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
</div>

<div id="ajaxpages_main" class="ajaxpages_main">
<?php
global $APPLICATION, $JSON, $isSorterChange, $isAjaxPages;

$isSorterChange = 'N';
if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == 'ajaxpages_main') {
	$isSorterChange = 'Y';
	$JSON['TYPE'] = 'OK';
}

$isAjaxPages = 'N';
if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == 'ajaxpages_main') {
	$isAjaxPages = 'Y';
	$JSON['TYPE'] = 'OK';
}
?>

<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/tabs/main/best.offers.catalog.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>

</div>
<?php
if ($isAjaxPages == 'Y' || $isSorterChange == 'Y') {
	$APPLICATION->RestartBuffer();
	if (SITE_CHARSET != 'utf-8') {
		$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
		$jsonStrUtf = json_encode($data);
		$jsonStr = $APPLICATION->ConvertCharset($jsonStrUtf, 'utf-8', SITE_CHARSET);
		echo $jsonStr;
	} else {
		echo json_encode($JSON);
	}

	die();
}
?>
