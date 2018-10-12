<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);

global $APPLICATION, $JSON;
?>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?$ElementID = $APPLICATION->IncludeComponent(
	'bitrix:news.detail',
	'brands',
	Array(
		'DISPLAY_DATE'				=> $arParams['DISPLAY_DATE'],
		'DISPLAY_NAME'				=> $arParams['DISPLAY_NAME'],
		'DISPLAY_PICTURE'			=> $arParams['DISPLAY_PICTURE'],
		'DISPLAY_PREVIEW_TEXT'		=> $arParams['DISPLAY_PREVIEW_TEXT'],
		'IBLOCK_TYPE'				=> $arParams['IBLOCK_TYPE'],
		'IBLOCK_ID'					=> $arParams['IBLOCK_ID'],
		'FIELD_CODE'				=> $arParams['DETAIL_FIELD_CODE'],
		'PROPERTY_CODE'				=> $arParams['DETAIL_PROPERTY_CODE'],
		'DETAIL_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['detail'],
		'SECTION_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
		'META_KEYWORDS'				=> $arParams['META_KEYWORDS'],
		'META_DESCRIPTION'			=> $arParams['META_DESCRIPTION'],
		'BROWSER_TITLE'				=> $arParams['BROWSER_TITLE'],
		'DISPLAY_PANEL'				=> $arParams['DISPLAY_PANEL'],
		'SET_TITLE'					=> $arParams['SET_TITLE'],
		'SET_STATUS_404'			=> $arParams['SET_STATUS_404'],
		'INCLUDE_IBLOCK_INTO_CHAIN' => $arParams['INCLUDE_IBLOCK_INTO_CHAIN'],
		'ADD_SECTIONS_CHAIN'		=> $arParams['ADD_SECTIONS_CHAIN'],
		'ACTIVE_DATE_FORMAT'		=> $arParams['DETAIL_ACTIVE_DATE_FORMAT'],
		'CACHE_TYPE'				=> $arParams['CACHE_TYPE'],
		'CACHE_TIME'				=> $arParams['CACHE_TIME'],
		'CACHE_GROUPS'				=> $arParams['CACHE_GROUPS'],
		'USE_PERMISSIONS'			=> $arParams['USE_PERMISSIONS'],
		'GROUP_PERMISSIONS'			=> $arParams['GROUP_PERMISSIONS'],
		'DISPLAY_TOP_PAGER'			=> $arParams['DETAIL_DISPLAY_TOP_PAGER'],
		'DISPLAY_BOTTOM_PAGER'		=> $arParams['DETAIL_DISPLAY_BOTTOM_PAGER'],
		'PAGER_TITLE'				=> $arParams['DETAIL_PAGER_TITLE'],
		'PAGER_SHOW_ALWAYS'			=> 'N',
		'PAGER_TEMPLATE'			=> $arParams['DETAIL_PAGER_TEMPLATE'],
		'PAGER_SHOW_ALL'			=> $arParams['DETAIL_PAGER_SHOW_ALL'],
		'CHECK_DATES'				=> $arParams['CHECK_DATES'],
		'ELEMENT_ID'				=> $arResult['VARIABLES']['ELEMENT_ID'],
		'ELEMENT_CODE'				=> $arResult['VARIABLES']['ELEMENT_CODE'],
		'IBLOCK_URL'				=> $arResult['FOLDER'].$arResult['URL_TEMPLATES']['news'],
		'USE_SHARE' 				=> $arParams['USE_SHARE'],
		'SHARE_HIDE' 				=> $arParams['SHARE_HIDE'],
		'SHARE_TEMPLATE' 			=> $arParams['SHARE_TEMPLATE'],
		'SHARE_HANDLERS' 			=> $arParams['SHARE_HANDLERS'],
		'SHARE_SHORTEN_URL_LOGIN'	=> $arParams['SHARE_SHORTEN_URL_LOGIN'],
		'SHARE_SHORTEN_URL_KEY'		=> $arParams['SHARE_SHORTEN_URL_KEY'],
		'ADD_ELEMENT_CHAIN'			=> (isset($arParams['ADD_ELEMENT_CHAIN']) ? $arParams['ADD_ELEMENT_CHAIN'] : ''),
		'ADD_STYLES_FOR_MAIN'		=> $arParams['ADD_STYLES_FOR_MAIN'],
		'BRAND_CODE'				=> $arParams['BRAND_CODE'],
		'SECTIONS_CODE'				=> $arParams['SECTIONS_CODE'],
		'SHOW_BOTTOM_SECTIONS'		=> $arParams['SHOW_BOTTOM_SECTIONS'],
		'COUNT_ITEMS'				=>	$arParams['COUNT_ITEMS'],
		'CATALOG_FILTER_NAME'		=> $arParams['CATALOG_FILTER_NAME'],
		'CATALOG_IBLOCK_ID'			=> $arParams['CATALOG_IBLOCK_ID'],
        // custom
        'CATALOG_BRAND_CODE' => $arParams['CATALOG_BRAND_CODE'],
	),
	$component
);?>
    </div>
</div>

<br><br>

<div class="row">
    <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
<?php if (!empty($arParams['BRAND_CODE']) && !empty($arParams['CATALOG_BRAND_CODE']) && $arParams['BRAND_CODE'] != '' && $arParams['CATALOG_BRAND_CODE'] != ''): ?>
<div class="catalog brands">
    <div class="prods" id="prods">
<?php
//$frame = $this->createFrame('prods',false)->begin('<img class="ajax_loader" src="'.SITE_TEMPLATE_PATH.'/img/ajax-loader.gif" />');
//\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID('prods');
?>
        <div class="mix clearfix">
<?php
global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
$arOutupVariables = array(0 => "10",1 => "15",2 => "20");
if (is_array($arParams['SORTER_OUTPUT_OF']) && count($arParams['SORTER_OUTPUT_OF']) > 0) {
	$arOutupVariables = $arParams['SORTER_OUTPUT_OF'];
}
?>

<?php
$APPLICATION->IncludeFile(
    SITE_DIR."include/sorter/brands.php",
    array(),
    array("MODE" => "html")
);
?>

			</div>
			<div id="ajaxpages_brandprods" class="ajaxpages_brandprods clearfix">
<?php
$IS_SORTERCHANGE = 'N';
if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == 'ajaxpages_brandprods') {
	$IS_SORTERCHANGE = 'Y';
	$JSON['TYPE'] = 'OK';
}
if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == 'ajaxpages_brandprods') {
	$IS_AJAXPAGES = 'Y';
	$JSON['TYPE'] = 'OK';
}
$intSectionID = 0;
?>

<?$APPLICATION->IncludeComponent(
    "bitrix:catalog.section",
    "gopro",
    array(
        'IBLOCK_TYPE' => '',
        'IBLOCK_ID' => $arParams['CATALOG_IBLOCK_ID'],
        'ELEMENT_SORT_FIELD' => (!empty($alfaCSortType) ? $alfaCSortType : $arParams['ELEMENT_SORT_FIELD']),
        'ELEMENT_SORT_ORDER' => (!empty($alfaCSortToo) ? $alfaCSortToo : $arParams['ELEMENT_SORT_ORDER']),
        'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
        'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
        'PROPERTY_CODE' => $arParams['CATALOG_PROPERTY_CODE'],
        // 'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
        // 'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
        // 'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
        // 'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
        'BASKET_URL' => $arParams['BASKET_URL'],
        'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
        'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
        'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
        'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
        'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
        'FILTER_NAME' => $arParams['CATALOG_FILTER_NAME'],
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_FILTER' => $arParams['CACHE_FILTER'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'SET_TITLE' => $arParams['SET_TITLE'],
        'SET_STATUS_404' => $arParams['SET_STATUS_404'],
        'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
        'PAGE_ELEMENT_COUNT' => (!empty($alfaCOutput) ? $alfaCOutput : $arParams['PAGE_ELEMENT_COUNT']),
        // 'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
        'PRICE_CODE' => $arParams['PRICE_CODE'],
        'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
        'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],

        'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
        'USE_PRODUCT_QUANTITY' => $arParams['USE_PRODUCT_QUANTITY'],
        'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['ADD_PROPERTIES_TO_BASKET']) ? $arParams['ADD_PROPERTIES_TO_BASKET'] : ''),
        'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
        'PRODUCT_PROPERTIES' => $arParams['PRODUCT_PROPERTIES'],
        "USE_MAIN_ELEMENT_SECTION" => $arParams["USE_MAIN_ELEMENT_SECTION"],
        'DISPLAY_TOP_PAGER' => $arParams['DISPLAY_TOP_PAGER'],
        'DISPLAY_BOTTOM_PAGER' => $arParams['DISPLAY_BOTTOM_PAGER'],
        'PAGER_TITLE' => $arParams['PAGER_TITLE'],
        'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
        'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
        'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
        'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
        'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],

        // 'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
        'OFFERS_FIELD_CODE' => $arParams['CATALOG_OFFERS_FIELD_CODE'],
        'OFFERS_PROPERTY_CODE' => $arParams['CATALOG_OFFERS_PROPERTY_CODE'],
        'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
        'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
        'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
        'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
        'OFFERS_LIMIT' => $arParams['CATALOG_OFFERS_LIMIT'],

        'SECTION_ID' => '',
        'SECTION_CODE' => '',
        'SECTION_URL' => '',
        'DETAIL_URL' => '',
        'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
        'CURRENCY_ID' => $arParams['CURRENCY_ID'],
        'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
        'HIDE_NOT_AVAILABLE_OFFERS' => $arParams['HIDE_NOT_AVAILABLE_OFFERS'],
        // ajaxpages
        'AJAXPAGESID' => 'ajaxpages_brandprods',
        'IS_AJAXPAGES' => $IS_AJAXPAGES,
        'IS_SORTERCHANGE' => $IS_SORTERCHANGE,
        // goPro params
        'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
        'HIGHLOAD' => $arParams['HIGHLOAD'],
        'PROP_ARTICLE' => $arParams['PROP_ARTICLE'],
        'PROP_ACCESSORIES' => $arParams['PROP_ACCESSORIES'],
        'USE_FAVORITE' => $arParams['USE_FAVORITE'],
        'USE_SHARE' => $arParams['USE_SHARE'],
        'SHOW_ERROR_EMPTY_ITEMS' => $arParams['SHOW_ERROR_EMPTY_ITEMS'],
        'EMPTY_ITEMS_HIDE_FIL_SORT' => 'Y',
        'USE_AUTO_AJAXPAGES' => $arParams['USE_AUTO_AJAXPAGES'],
        'OFF_MEASURE_RATION' => $arParams['OFF_MEASURE_RATION'],
        // showcase
        'COL_XS_6' => $arParams['COL_XS_6'],
        // SKU
        'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
        'PROP_SKU_ARTICLE' => $arParams['PROP_SKU_ARTICLE'],
        'PROPS_ATTRIBUTES' => $arParams['PROPS_ATTRIBUTES'],
        'PROPS_ATTRIBUTES_COLOR' => $arParams['PROPS_ATTRIBUTES_COLOR'],
        // store
        'USE_STORE' => $arParams['USE_STORE'],
        'USE_MIN_AMOUNT' => $arParams['USE_MIN_AMOUNT'],
        'MIN_AMOUNT' => $arParams['MIN_AMOUNT'],
        'MAIN_TITLE' => $arParams['MAIN_TITLE'],
        'HIDE_IN_LIST' => $arParams['HIDE_IN_LIST'],
        "PROP_STORE_REPLACE_SECTION" => $arParams['PROP_STORE_REPLACE_SECTION'],
		"PROP_STORE_REPLACE_DETAIL" => $arParams['PROP_STORE_REPLACE_DETAIL'],
        // view
        'VIEW' => $alfaCTemplate,
        // columns
        'COLUMNS5' => 'Y',
        // error 404
        "SET_STATUS_404" => "N",
        "SHOW_404" => "N",
        "MESSAGE_404" => "",
        "FILE_404" => "",
        "SHOW_ALL_WO_SECTION" => "Y", // set smart.filter + INCLUDE_SUBSECTIONS=Y = bug
    ),
    $component
);?>

<?php
if ($IS_AJAXPAGES == 'Y' || $IS_SORTERCHANGE == 'Y') {
	$APPLICATION->RestartBuffer();
	if (SITE_CHARSET != 'utf-8') {
		$data = $APPLICATION->ConvertCharsetArray($JSON, SITE_CHARSET, 'utf-8');
		$json_str_utf = json_encode($data);
		$json_str = $APPLICATION->ConvertCharset($json_str_utf, 'utf-8', SITE_CHARSET);
		echo $json_str;
	} else {
		echo json_encode($JSON);
	}
	die();
}
?>
        </div>
    </div>
<?php
if ($IS_AJAX_CATALOG) {
	die();
}
?>
</div>
<?php endif; ?>
    </div>
</div>
