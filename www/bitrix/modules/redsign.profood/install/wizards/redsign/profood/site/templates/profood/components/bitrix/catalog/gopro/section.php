<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);

global $APPLICATION, $JSON;

$getTemplatePathPartParams = array('SHOW_HELP' => $arParams['CACHE_GROUPS'] == 'Y' ? 'Y' : 'N');

if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/section.start.php', $getTemplatePathPartParams))) {
    include($path);
}

if (\Bitrix\Main\Loader::includeModule('iblock')) {
	// take data about curent section
	if (\Bitrix\Main\Loader::includeModule('iblock')) {
		$arFilter = array(
			'IBLOCK_ID' => $arParams['IBLOCK_ID'],
			'ACTIVE' => 'Y',
			'GLOBAL_ACTIVE' => 'Y',
		);
		if (IntVal($arResult['VARIABLES']['SECTION_ID'])>0) {
			$arFilter['ID'] = $arResult['VARIABLES']['SECTION_ID'];
		} elseif ($arResult['VARIABLES']['SECTION_CODE']!='') {
			$arFilter['=CODE'] = $arResult['VARIABLES']['SECTION_CODE'];
		}
		$obCache = new CPHPCache();
		if ($obCache->InitCache(36000, serialize($arFilter) ,'/iblock/catalog')) {
			$arCurSection = $obCache->GetVars();
		} elseif ($obCache->StartDataCache()) {
			$arCurSection = array();
			$dbRes = CIBlockSection::GetList(array(), $arFilter, false, array('ID','LEFT_MARGIN','RIGHT_MARGIN'));
			if (defined('BX_COMP_MANAGED_CACHE')) {
				global $CACHE_MANAGER;
				$CACHE_MANAGER->StartTagCache('/iblock/catalog');
				if ($arCurSection = $dbRes->GetNext())  {
					$CACHE_MANAGER->RegisterTag('iblock_id_'.$arParams['IBLOCK_ID']);
				}
				$CACHE_MANAGER->EndTagCache();
			} else {
				if(!$arCurSection = $dbRes->GetNext()) {
					$arCurSection = array();
				}
			}
			$obCache->EndDataCache($arCurSection);
		}
	}
	// /take data about curent section
}
?>

<div class="catalog clearfix" id="catalog">
	<?php if ( $arParams['SECTIONS_VIEW_MODE'] == 'VIEW_SECTIONS' && (($arCurSection['RIGHT_MARGIN'] - $arCurSection['LEFT_MARGIN']) > 1)): ?>

<?php
if ($arParams['SECTIONS_DESCRIPTION_POSITION'] == 'top'):
	$APPLICATION->ShowViewContent('catalog_section_list_descr');
	?><hr><?
endif;
?>

<?$APPLICATION->IncludeComponent(
    'bitrix:catalog.section.list',
    'gopro',
    array(
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
        'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
        'TOP_DEPTH' => $arParams['SECTION_TOP_DEPTH'],
        'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
        'SET_TITLE' => $arParams['SET_TITLE'],
    ),
    $component,
    array('HIDE_ICONS'=>'Y')
);?>

<?php if ($arParams['SECTIONS_DESCRIPTION_POSITION'] == 'bottom'):
        $APPLICATION->ShowViewContent('catalog_section_list_descr');
endif; ?>

	<?php else: // VIEW_MODE ?>
		
        <?php
        $IS_AJAX_CATALOG = false;
        // isset($_SERVER['HTTP_X_REQUESTED_WITH'])
        if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['get'] == 'catalog') {
            $APPLICATION->RestartBuffer();
            $IS_AJAX_CATALOG = true;
        }
        ?>
        
		<div class="sidebar">
<?$APPLICATION->IncludeComponent(
    'bitrix:catalog.section.list',
    'lines',
    Array(
        'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
        'IBLOCK_ID' => $arParams['IBLOCK_ID'],
        'SECTION_ID' => $arResult['VARIABLES']['SECTION_ID'],
        'SECTION_CODE' => $arResult['VARIABLES']['SECTION_CODE'],
        'CACHE_TYPE' => $arParams['CACHE_TYPE'],
        'CACHE_TIME' => $arParams['CACHE_TIME'],
        'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
        'COUNT_ELEMENTS' => $arParams['SECTION_COUNT_ELEMENTS'],
        'TOP_DEPTH' => '1',
        'SECTION_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['section'],
    ),
    $component,
    array('HIDE_ICONS'=>'Y')
);?>

		<?php if ($arParams['USE_FILTER'] == 'Y'): ?>
			<?$APPLICATION->IncludeComponent(
				'bitrix:catalog.smart.filter',
				'gopro',
				array(
					'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
					'IBLOCK_ID' => $arParams['IBLOCK_ID'],
					'SECTION_ID' => $arCurSection['ID'],
					'FILTER_NAME' => $arParams['FILTER_NAME'],
					'PRICE_CODE' => $arParams['FILTER_PRICE_CODE'],
					'CACHE_TYPE' => $arParams['CACHE_TYPE'],
					'CACHE_TIME' => $arParams['CACHE_TIME'],
					'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
					'SAVE_IN_SESSION' => 'N',
					'HIDE_NOT_AVAILABLE' => $arParams["HIDE_NOT_AVAILABLE"],
					'HIDE_NOT_AVAILABLE_OFFERS' => $arParams["HIDE_NOT_AVAILABLE_OFFERS"],
                    'INSTANT_RELOAD' => 'Y',
					// simple
					'PROPS_FILTER_COLORS' => $arParams['PROPS_FILTER_COLORS'],
					'FILTER_PRICE_GROUPED' => $arParams['FILTER_PRICE_GROUPED'],
					'FILTER_PRICE_GROUPED_FOR' => $arParams['FILTER_PRICE_GROUPED_FOR'],
					'FILTER_PROP_SCROLL' => $arParams['FILTER_PROP_SCROLL'],
					'FILTER_PROP_SEARCH' => $arParams['FILTER_PROP_SEARCH'],
					'FILTER_FIXED' => $arParams['FILTER_FIXED'],
					'FILTER_USE_AJAX' => $arParams['FILTER_USE_AJAX'],
					'FILTER_HIDE_PROP_COUNT' => $arParams['FILTER_HIDE_PROP_COUNT'],
					// offers
					'PROPS_SKU_FILTER_COLORS' => $arParams['PROPS_SKU_FILTER_COLORS'],
					'FILTER_SKU_PROP_SCROLL' => $arParams['FILTER_SKU_PROP_SCROLL'],
					'FILTER_SKU_PROP_SEARCH' => $arParams['FILTER_SKU_PROP_SEARCH'],
					// compare
					'USE_COMPARE' => $arParams['USE_COMPARE'],
					'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
					'CURRENCY_ID' => $arParams['CURRENCY_ID'],
					//chpu url
					"SEF_MODE" => $arParams["SEF_MODE"],
					"SEF_RULE" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["smart_filter"],
					"SMART_FILTER_PATH" => $arResult["VARIABLES"]["SMART_FILTER_PATH"],
					// multiregionality
					// 'SITE_LOCATION_ID' => SITE_LOCATION_ID,
				),
				$component,
    			array('HIDE_ICONS'=>'Y')
			);?>
		<?php endif; ?>
        
		</div>
		
		<div class="prods" id="prods">
<?php
//$frame = $this->createFrame('prods',false)->begin('<img class="ajax_loader" src="'.SITE_TEMPLATE_PATH.'/img/ajax-loader.gif" />');
//\Bitrix\Main\Page\Frame::getInstance()->startDynamicWithID('prods');
if ($arParams['SECTION_DESCRIPTION_POSITION'] == 'top'):
	$APPLICATION->ShowViewContent('catalog_section_list_descr');
endif;
?>
			<div class="mix clearfix">
                <?php if ($arParams['USE_COMPARE'] == 'Y' && 1==2): ?>
                    <div class="borlef">
                        <div class="compareandpaginator clearfix">
							<div id="compare" class="compare">
							<?$APPLICATION->IncludeComponent('bitrix:catalog.compare.list', 'gopro', array(
								'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
								'IBLOCK_ID' => $arParams['IBLOCK_ID'],
								'NAME' => $arParams['COMPARE_NAME'],
								'DETAIL_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['element'],
								'COMPARE_URL' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
								'PROPCODE_MORE_PHOTO' => $arParams['PROPCODE_MORE_PHOTO'],
								'PROPCODE_SKU_MORE_PHOTO' => $arParams['PROPCODE_SKU_MORE_PHOTO'],
								),
								$component,
								array('HIDE_ICONS'=>'Y')
							);?>
							</div>
                        </div>
                    </div>
                <?php endif; ?>
<?php
global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
$arOutupVariables = array(0 => "10",1 => "15",2 => "20");
if (is_array($arParams['SORTER_OUTPUT_OF']) && count($arParams['SORTER_OUTPUT_OF']) > 0) {
	$arOutupVariables = $arParams['SORTER_OUTPUT_OF'];
}
?>

<?php
$APPLICATION->IncludeFile(
    SITE_DIR."include/sorter/catalog_section.php",
    array(),
    array("MODE" => "html")
);
?>

			</div>
			<div id="ajaxpages_gmci" class="ajaxpages_gmci clearfix">
<?php
$IS_SORTERCHANGE = 'N';
if ($_REQUEST['AJAX_CALL'] == 'Y' && $_REQUEST['sorterchange'] == 'ajaxpages_gmci') {
	$IS_SORTERCHANGE = 'Y';
	$JSON['TYPE'] = 'OK';
}
if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == 'ajaxpages_gmci') {
	$IS_AJAXPAGES = 'Y';
	$JSON['TYPE'] = 'OK';
}
$intSectionID = 0;
?>
				<?$intSectionID = $APPLICATION->IncludeComponent(
					'bitrix:catalog.section',
					'gopro',
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
						'FILTER_NAME' => $arParams['FILTER_NAME'],
						'CACHE_TYPE' => $arParams['CACHE_TYPE'],
						'CACHE_TIME' => $arParams['CACHE_TIME'],
						'CACHE_FILTER' => $arParams['CACHE_FILTER'],
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
						'AJAXPAGESID' => 'ajaxpages_gmci',
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
						'LIST_SKU_VIEW' => $arParams['LIST_SKU_VIEW'],
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
						'COLUMNS5' => 'N',
                        // error 404
                        "SET_STATUS_404" => $arParams["SET_STATUS_404"],
                        "SHOW_404" => $arParams["SHOW_404"],
                        "MESSAGE_404" => $arParams["MESSAGE_404"],
                        "FILE_404" => $arParams["FILE_404"],"FILE_404" => "Y",
						// multiregionality
						'SITE_LOCATION_ID' => SITE_LOCATION_ID,
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
			<div id="paginator"><?php $APPLICATION->ShowViewContent('paginator'); ?></div>
            <div class="bottom"><?php $APPLICATION->ShowViewContent('catalog_sorter_output_of_show'); ?></div>
			<?php if ($arParams['SECTION_DESCRIPTION_POSITION'] == 'bottom'):
				$APPLICATION->ShowViewContent('catalog_section_list_descr');
			endif; ?>
		</div>
<?php
if ($IS_AJAX_CATALOG) {
	die();
}
	endif; //VIEW_MODE
?>	
</div>

<?php
if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/section.finish.php', $getTemplatePathPartParams))) {
    include($path);
}
