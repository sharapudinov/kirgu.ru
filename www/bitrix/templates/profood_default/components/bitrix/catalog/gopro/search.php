<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

global $APPLICATION, $JSON;

$getTemplatePathPartParams = array('SHOW_HELP' => $arParams['CACHE_GROUPS'] == 'Y' ? 'Y' : 'N');

if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/search.start.php', $getTemplatePathPartParams))) {
    include($path);
}
?>

<div class="prods" id="prods">
	<div class="mix clearfix">
	<?$arElements = $APPLICATION->IncludeComponent(
		"bitrix:search.page",
		"gopro_catalog",
		array(
			"RESTART" => $arParams["RESTART"],
			"NO_WORD_LOGIC" => $arParams["NO_WORD_LOGIC"],
			"USE_LANGUAGE_GUESS" => $arParams["USE_LANGUAGE_GUESS"],
			"CHECK_DATES" => $arParams["CHECK_DATES"],
			"arrFILTER" => array("iblock_".$arParams["IBLOCK_TYPE"]),
			"arrFILTER_iblock_".$arParams["IBLOCK_TYPE"] => array($arParams["IBLOCK_ID"]),
			"USE_TITLE_RANK" => "N",
			"DEFAULT_SORT" => "rank",
			"FILTER_NAME" => "",
			"SHOW_WHERE" => "N",
			"arrWHERE" => array(),
			"SHOW_WHEN" => "N",
			"PAGE_RESULT_COUNT" => 50,
			"DISPLAY_TOP_PAGER" => "N",
			"DISPLAY_BOTTOM_PAGER" => "N",
			"PAGER_TITLE" => "",
			"PAGER_SHOW_ALWAYS" => "N",
			"PAGER_TEMPLATE" => "N",

			"PAGE_RESULT_COUNT" => !empty($arParams["SEARCH_PAGE_RESULT_COUNT"]) ? $arParams["SEARCH_PAGE_RESULT_COUNT"] : "50",
			"RESTART" => !empty($arParams["SEARCH_RESTART"]) ? $arParams["SEARCH_RESTART"] : "N",
			"NO_WORD_LOGIC" => !empty($arParams["SEARCH_NO_WORD_LOGIC"]) ? $arParams["SEARCH_NO_WORD_LOGIC"] : "Y",
			"USE_LANGUAGE_GUESS" => !empty($arParams["SEARCH_USE_LANGUAGE_GUESS"]) ? $arParams["SEARCH_USE_LANGUAGE_GUESS"] : "Y",
			"CHECK_DATES" => !empty($arParams["SEARCH_CHECK_DATES"]) ? $arParams["SEARCH_CHECK_DATES"] : "Y",
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);?>

	<?php if (!empty($arElements) && is_array($arElements)):
	global $searchFilter;
	$searchFilter = array(
		"=ID" => $arElements,
	);

	global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
	$arOutupVariables = array(0 => "10",1 => "15",2 => "20");
	if (is_array($arParams['SORTER_OUTPUT_OF']) && count($arParams['SORTER_OUTPUT_OF']) > 0) {
		$arOutupVariables = $arParams['SORTER_OUTPUT_OF'];
	}
	?>
	<?php
	$APPLICATION->IncludeFile(
		SITE_DIR."include/sorter/catalog_section_search.php",
		array(),
		array("MODE" => "html")
	);
	?>
	</div>
	<div id="ajaxpages_gmci_search" class="ajaxpages_gmci_search clearfix">
	<?php
	$IS_SORTERCHANGE = 'N';
	if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == 'ajaxpages_gmci_search') {
		$IS_SORTERCHANGE = 'Y';
		$JSON['TYPE'] = 'OK';
	}
	if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == 'ajaxpages_gmci_search') {
		$IS_AJAXPAGES = 'Y';
		$JSON['TYPE'] = 'OK';
	}
	$intSectionID = 0;
	?>
	<?$APPLICATION->IncludeComponent(
		"bitrix:catalog.section",
		"gopro",
		array(
			'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ELEMENT_SORT_FIELD' => (!empty($alfaCSortType) ? $alfaCSortType : $arParams['ELEMENT_SORT_FIELD']),
			'ELEMENT_SORT_ORDER' => (!empty($alfaCSortToo) ? $alfaCSortToo : $arParams['ELEMENT_SORT_ORDER']),
			'ELEMENT_SORT_FIELD2' => $arParams['ELEMENT_SORT_FIELD2'],
			'ELEMENT_SORT_ORDER2' => $arParams['ELEMENT_SORT_ORDER2'],
			'PROPERTY_CODE' => $arParams['LIST_PROPERTY_CODE'],
			'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
			'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
			'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
			'INCLUDE_SUBSECTIONS' => $arParams['INCLUDE_SUBSECTIONS'],
			'BASKET_URL' => $arParams['BASKET_URL'],
			'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
			'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
			'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
			'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
			'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
			'FILTER_NAME' => "searchFilter",
			'CACHE_TYPE' => $arParams['CACHE_TYPE'],
			'CACHE_TIME' => $arParams['CACHE_TIME'],
			'CACHE_FILTER' => "N",
			'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
			'SET_TITLE' => $arParams['SET_TITLE'],
			'SET_STATUS_404' => $arParams['SET_STATUS_404'],
			'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
			'PAGE_ELEMENT_COUNT' => (!empty($alfaCOutput) ? $alfaCOutput : $arParams['PAGE_ELEMENT_COUNT']),
			'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
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

			'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
			'OFFERS_FIELD_CODE' => $arParams['LIST_OFFERS_FIELD_CODE'],
			'OFFERS_PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
			'OFFERS_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
			'OFFERS_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
			'OFFERS_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
			'OFFERS_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
			'OFFERS_LIMIT' => $arParams['LIST_OFFERS_LIMIT'],

			'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
			'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
			'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
			'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
			'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
			'CURRENCY_ID' => $arParams['CURRENCY_ID'],
			'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
			'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
			// ajaxpages
			'AJAXPAGESID' => 'ajaxpages_gmci_search',
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
			'STICKERS_PROPS' => $arParams['STICKERS_PROPS'],
			'STICKERS_DISCOUNT_VALUE' => $arParams['STICKERS_DISCOUNT_VALUE'],
			// rating
			'USE_RATING' => $arParams['USE_RATING'],
			'RATING_PROP_COUNT' => $arParams['RATING_PROP_COUNT'],
			'RATING_PROP_SUM' => $arParams['RATING_PROP_SUM'],
			// showcase
			'COL_XS_6' => $arParams['COL_XS_6'],
			'OFF_HOVER_POPUP' => $arParams['OFF_HOVER_POPUP'],
			'USE_LAZYLOAD' => $arParams['USE_LAZYLOAD'],
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
			// ajaxpages
			"HIDE_AJAXPAGES_LINK" => $arParams['HIDE_AJAXPAGES_LINK'],
			// view
			'VIEW' => $alfaCTemplate,
			// columns
			'COLUMNS5' => 'Y',
			// error 404
			"SET_STATUS_404" => $arParams["SET_STATUS_404"],
			"SHOW_404" => $arParams["SHOW_404"],
			"MESSAGE_404" => $arParams["MESSAGE_404"],
			"FILE_404" => $arParams["FILE_404"],"FILE_404" => "Y",
			// search settings
			"INCLUDE_SUBSECTIONS" => "Y",
			"SHOW_ALL_WO_SECTION" => "Y",
			// multiregionality
			'SITE_LOCATION_ID' => SITE_LOCATION_ID,
		),
		$component,
		array('HIDE_ICONS' => 'Y')
	);?>
	<?php
	if ($IS_AJAXPAGES == 'Y' || $IS_SORTERCHANGE == 'Y') {
		$APPLICATION->RestartBuffer();
		$JSON['ABC'] = 'DFG';
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
			<div id="paginator"><?php $APPLICATION->ShowViewContent('paginator'); ?></div>
            <div class="bottom"><?php $APPLICATION->ShowViewContent('catalog_sorter_output_of_show'); ?></div>
			<?php if ($arParams['SECTION_DESCRIPTION_POSITION'] == 'bottom'):
				$APPLICATION->ShowViewContent('catalog_section_list_descr');
			endif; ?>
		</div>

<?php elseif (is_array($arElements)): ?>
	<?=GetMessage("CT_BCSE_NOT_FOUND"); ?>
<?php endif; ?>

<?php

if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/search.finish.php', $getTemplatePathPartParams))) {
    include($path);
}
