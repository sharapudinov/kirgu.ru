<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\loc;
?>

<?php
// tabs -> HEADERS
$this->SetViewTarget('TABS_HTML_HEADERS');

if ($arResult['TABS']['DETAIL_TEXT']) {
    ?><li role="presentation"><a href="#detailtext" aria-controls="home" role="tab" data-toggle="tab"><?=loc::getMessage('TABS_DETAIL_TEXT')?></a></li><?
}

if ($arResult['TABS']['DISPLAY_PROPERTIES']) {
    ?><li role="presentation"><a href="#properties" aria-controls="home" role="tab" data-toggle="tab"><?=loc::getMessage('TABS_PROPERTIES')?></a></li><?
}

if ($arResult['TABS']['DELIVERY_COST']) {
    ?><li role="presentation"><a href="#deliverycost" aria-controls="home" role="tab" data-toggle="tab"><?=loc::getMessage('TABS_DELIVERY_COST')?></a></li><?
}

if ($arResult['TABS']['SET']) {
    ?><li role="presentation"><a href="#set" aria-controls="home" role="tab" data-toggle="tab"><?=loc::getMessage('TABS_SET')?></a></li><?
}

if ($arResult['TABS']['PROPS_TABS']) {
    foreach ($arParams['PROPS_TABS'] as $sPropCode) {
        if (
            $sPropCode != '' &&
            $arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE']=='E' &&
            isset($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            is_array($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            count($arResult['PROPERTIES'][$sPropCode]['VALUE'])>0
        ) {
            ?><li role="presentation"><a href="#prop<?=$sPropCode?>" aria-controls="home" role="tab" data-toggle="tab"><?=$arResult['PROPERTIES'][$sPropCode]['NAME']?></a></li><?
        } elseif(
            $sPropCode!='' &&
            $arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE']=='F' &&
            isset($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            is_array($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            count($arResult['PROPERTIES'][$sPropCode]['VALUE'])>0
        ) { // files
            ?><li role="presentation"><a href="#prop<?=$sPropCode?>" aria-controls="home" role="tab" data-toggle="tab"><?=$arResult['PROPERTIES'][$sPropCode]['NAME']?></a></li><?
        } elseif( $sPropCode!='' && isset($arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE']) ) { // else
            ?><li role="presentation"><a href="#prop<?=$sPropCode?>" aria-controls="home" role="tab" data-toggle="tab"><?=$arResult['DISPLAY_PROPERTIES'][$sPropCode]['NAME']?></a></li><?
        }
    }
}

if ($arResult['TABS']['STOCKS']) {
    ?><li role="presentation"><a href="#stocks" aria-controls="home" role="tab" data-toggle="tab"><?=loc::getMessage('TABS_STOCKS')?></a></li><?
}

$this->EndViewTarget();



// tabs -> CONTENTS
$this->SetViewTarget('TABS_HTML_CONTENTS');

if ($arResult['TABS']['DETAIL_TEXT']) {
    ?><div class="tab-pane active tabpanel-show-on-print" role="tabpanel" id="detailtext"><?
        ?><div class="tab-pane-in"><?
            ?><div class="b-print__tab-name clearfix"><div class="b-sorter__block-name visible-print-block"><?=loc::getMessage('TABS_DETAIL_TEXT')?></div></div><?
            ?><div class="tab-pane-in2"><?
                ?><?=$arResult['DETAIL_TEXT']?><?
            ?></div><?
        ?></div><?
    ?></div><?
}

if ($arResult['TABS']['DISPLAY_PROPERTIES']) {
    ?><div class="tab-pane active tabpanel-show-on-print" role="tabpanel" id="properties"><?
        ?><div class="tab-pane-in"><?
            ?><div class="b-print__tab-name clearfix"><div class="b-sorter__block-name visible-print-block"><?=loc::getMessage('TABS_PROPERTIES')?></div></div><?
            ?><div class="tab-pane-in2"><?
                $arDiff = array();
                if (!empty($arParams['PROP_BRAND']))
                    $arDiff[$arParams['PROP_BRAND']] = $arParams['PROP_BRAND'];
                if (!empty($arParams['RATING_PROP_COUNT']))
                    $arDiff[$arParams['RATING_PROP_COUNT']] = $arParams['RATING_PROP_COUNT'];
                if (!empty($arParams['RATING_PROP_SUM']))
                    $arDiff[$arParams['RATING_PROP_SUM']] = $arParams['RATING_PROP_SUM'];
                if (!empty($arParams['PROP_PRICES_NOTE']))
                    $arDiff[$arParams['PROP_PRICES_NOTE']] = $arParams['PROP_PRICES_NOTE'];
                if (!empty($arParams['PROP_STORE_REPLACE_SECTION']))
                    $arDiff[$arParams['PROP_STORE_REPLACE_SECTION']] = $arParams['PROP_STORE_REPLACE_SECTION'];
                if (!empty($arParams['PROP_STORE_REPLACE_DETAIL']))
                    $arDiff[$arParams['PROP_STORE_REPLACE_DETAIL']] = $arParams['PROP_STORE_REPLACE_DETAIL'];
                if (is_array($arParams['STICKERS_PROPS']) && count($arParams['STICKERS_PROPS']) > 0) {
                    foreach ($arParams['STICKERS_PROPS'] as $sPropCode) {
                        $arDiff[$sPropCode] = $sPropCode;
                    }
                }
                if (is_array($arParams['PROPS_TABS']) && count($arParams['PROPS_TABS']) > 0) {
                    foreach ($arParams['PROPS_TABS'] as $sPropCode) {
                        $arDiff[$sPropCode] = $sPropCode;
                    }
                }
                $APPLICATION->IncludeComponent('redsign:grupper.list',
                    'gopro',
                    array(
                        'DISPLAY_PROPERTIES' => array_diff_key($arResult['DISPLAY_PROPERTIES'], $arDiff),
                        'CACHE_TIME' => 36000,
                    ),
                    $component,
                    array('HIDE_ICONS' => 'Y')
                );
            ?></div><?
        ?></div><?
    ?></div><?
}

if ($arResult['TABS']['DELIVERY_COST']) {
    ?><div class="tab-pane active tabpanel-show-on-print" role="tabpanel" id="deliverycost"><?
        ?><div class="tab-pane-in"><?
            ?><div class="b-print__tab-name clearfix"><div class="b-sorter__block-name visible-print-block"><?=loc::getMessage('TABS_DELIVERY_COST')?></div></div><?
            ?><div class="tab-pane-in2"><?
                ?><div id="delivery-tab"><?=loc::getMessage('TABS_DELIVERY_COST_LOADING')?></div><?
            ?></div><?
        ?></div><?
    ?></div><?
}

if ($arResult['TABS']['SET']) {
    ?><div class="tab-pane active" role="tabpanel" id="set"><?
        ?><div class="tab-pane-in"><?
            ?><div class="tab-pane-in2"><?
                ?><div class="set"><?
                if (isset($arResult['OFFERS']) && !empty($arResult['OFFERS'])) {
                    foreach ($arResult['OFFERS'] as $arOffer) {
                        if(!$arOffer['HAVE_SET'])
                            continue;
                        ?><div class="aroundset offer offerid<?=$arOffer['ID']?><?if($product['ID']!=$arOffer['ID']):?> noned<?endif;?>"><?
                            ?><?$APPLICATION->IncludeComponent('bitrix:catalog.set.constructor',
                                'gopro',
                                array(
                                    'IBLOCK_ID' => $arResult['OFFERS_IBLOCK'],
                                    'ELEMENT_ID' => $arOffer['ID'],
                                    'PRICE_CODE' => $arParams['PRICE_CODE'],
                                    'BASKET_URL' => $arParams['BASKET_URL'],
                                    'OFFERS_CART_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
                                    'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                    'CACHE_TIME' => $arParams['CACHE_TIME'],
                                    'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );?><?
                        ?></div><?
                    }
                } else {
                    ?><div class="aroundset simple"><?
                        ?><?$APPLICATION->IncludeComponent('bitrix:catalog.set.constructor',
                            'gopro',
                            array(
                                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                'ELEMENT_ID' => $arResult['ID'],
                                'PRICE_CODE' => $arParams['PRICE_CODE'],
                                'BASKET_URL' => $arParams['BASKET_URL'],
                                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                'CACHE_TIME' => $arParams['CACHE_TIME'],
                                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                "CONVERT_CURRENCY" => $arParams['CONVERT_CURRENCY'],
                                "CURRENCY_ID" => $arParams['CURRENCY_ID'],
                            ),
                            $component,
                            array('HIDE_ICONS' => 'Y')
                        );?><?
                    ?></div><?
                }
                ?></div><?
            ?></div><?
        ?></div><?
    ?></div><?
}

if ($arResult['TABS']['PROPS_TABS']) {
    global $lightFilter;
    foreach ($arParams['PROPS_TABS'] as $sPropCode) {
        if (
            $sPropCode != '' &&
            $arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'E' &&
            isset($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            is_array($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            count($arResult['PROPERTIES'][$sPropCode]['VALUE']) > 0
        )
        { // binds to elements
            ?><div class="tab-pane active" role="tabpanel" id="prop<?=$sPropCode?>"><?
                ?><div class="tab-pane-in"><?
                    ?><div class="tab-pane-in2"><?
                        $lightFilter = array(
                            'ID' => $arResult['PROPERTIES'][$sPropCode]['VALUE'],
                        );
                        ?><?$intSectionID = $APPLICATION->IncludeComponent(
                            'bitrix:catalog.section',
                            'gopro',
                            array(
                                'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
                                'IBLOCK_ID' => $arParams['IBLOCK_ID'],
                                'ELEMENT_SORT_FIELD' => $arParams['OFFERS_SORT_FIELD'],
                                'ELEMENT_SORT_ORDER' => $arParams['OFFERS_SORT_ORDER'],
                                'ELEMENT_SORT_FIELD2' => $arParams['OFFERS_SORT_FIELD2'],
                                'ELEMENT_SORT_ORDER2' => $arParams['OFFERS_SORT_ORDER2'],
                                'PROPERTY_CODE' => $arParams['LIST_OFFERS_PROPERTY_CODE'],
                                'META_KEYWORDS' => $arParams['LIST_META_KEYWORDS'],
                                'META_DESCRIPTION' => $arParams['LIST_META_DESCRIPTION'],
                                'BROWSER_TITLE' => $arParams['LIST_BROWSER_TITLE'],
                                'INCLUDE_SUBSECTIONS' => 'N',
                                'BASKET_URL' => $arParams['BASKET_URL'],
                                'ACTION_VARIABLE' => $arParams['ACTION_VARIABLE'],
                                'PRODUCT_ID_VARIABLE' => $arParams['PRODUCT_ID_VARIABLE'],
                                'SECTION_ID_VARIABLE' => $arParams['SECTION_ID_VARIABLE'],
                                'PRODUCT_QUANTITY_VARIABLE' => $arParams['PRODUCT_QUANTITY_VARIABLE'],
                                'PRODUCT_PROPS_VARIABLE' => $arParams['PRODUCT_PROPS_VARIABLE'],
                                'FILTER_NAME' => 'lightFilter',
                                'CACHE_TYPE' => $arParams['CACHE_TYPE'],
                                'CACHE_TIME' => $arParams['CACHE_TIME'],
                                'CACHE_FILTER' => $arParams['CACHE_FILTER'],
                                'CACHE_GROUPS' => $arParams['CACHE_GROUPS'],
                                'SET_TITLE' => 'N',
                                'SET_STATUS_404' => 'N',
                                'DISPLAY_COMPARE' => $arParams['USE_COMPARE'],
                                'PAGE_ELEMENT_COUNT' => '100',
                                'LINE_ELEMENT_COUNT' => $arParams['LINE_ELEMENT_COUNT'],
                                'PRICE_CODE' => $arParams['PRICE_CODE'],
                                'USE_PRICE_COUNT' => $arParams['USE_PRICE_COUNT'],
                                'SHOW_PRICE_COUNT' => $arParams['SHOW_PRICE_COUNT'],
            
                                'PRICE_VAT_INCLUDE' => $arParams['PRICE_VAT_INCLUDE'],
                                'USE_PRODUCT_QUANTITY' => $arParams['~USE_PRODUCT_QUANTITY'],
                                'ADD_PROPERTIES_TO_BASKET' => (isset($arParams['OFFERS_CART_PROPERTIES']) ? $arParams['OFFERS_CART_PROPERTIES'] : ''),
                                'PARTIAL_PRODUCT_PROPERTIES' => (isset($arParams['PARTIAL_PRODUCT_PROPERTIES']) ? $arParams['PARTIAL_PRODUCT_PROPERTIES'] : ''),
                                'PRODUCT_PROPERTIES' => $arParams['OFFERS_CART_PROPERTIES'],
            
                                'DISPLAY_TOP_PAGER' => 'N',
                                'DISPLAY_BOTTOM_PAGER' => 'N',
                                'PAGER_TITLE' => $arParams['PAGER_TITLE'],
                                'PAGER_SHOW_ALWAYS' => $arParams['PAGER_SHOW_ALWAYS'],
                                'PAGER_TEMPLATE' => $arParams['PAGER_TEMPLATE'],
                                'PAGER_DESC_NUMBERING' => $arParams['PAGER_DESC_NUMBERING'],
                                'PAGER_DESC_NUMBERING_CACHE_TIME' => $arParams['PAGER_DESC_NUMBERING_CACHE_TIME'],
                                'PAGER_SHOW_ALL' => $arParams['PAGER_SHOW_ALL'],
                                'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
                                'CURRENCY_ID' => $arParams['CURRENCY_ID'],
                                // ajaxpages
                                // 'AJAXPAGESID' => 'ajaxpages_mods',
                                // 'IS_AJAXPAGES' => $isAjaxpages,
                                // 'IS_SORTERCHANGE' => $isSorterChange,
                                // goPro params
                                'PROP_MORE_PHOTO' => $arParams['PROP_MORE_PHOTO'],
                                'HIGHLOAD' => $arParams['HIGHLOAD'],
                                'PROP_ARTICLE' => $arParams['PROP_MODS_ARTICLE'],
                                'PROP_ACCESSORIES' => $arParams['PROP_ACCESSORIES'],
                                'USE_FAVORITE' => $arParams['USE_FAVORITE'],
                                'USE_SHARE' => $arParams['USE_SHARE'],
                                'SOC_SHARE_ICON' => $arParams['SOC_SHARE_ICON'],
                                'SHOW_ERROR_EMPTY_ITEMS' => 'N',
                                'OFF_MEASURE_RATION' => $arParams['OFF_MEASURE_RATION'],
                                'PROP_SKU_MORE_PHOTO' => $arParams['PROP_SKU_MORE_PHOTO'],
                                'PROP_SKU_ARTICLE' => $arParams['PROP_MODS_ARTICLE'],
                                'PROPS_ATTRIBUTES' => $arParams['PROPS_ATTRIBUTES'],
                                'STICKERS_PROPS' => $arParams['STICKERS_PROPS'],
                                'STICKERS_DISCOUNT_VALUE' => $arParams['STICKERS_DISCOUNT_VALUE'],
                                // rating
                                'USE_RATING' => $arParams['USE_RATING'],
                                'RATING_PROP_COUNT' => $arParams['RATING_PROP_COUNT'],
                                'RATING_PROP_SUM' => $arParams['RATING_PROP_SUM'],
                                // showcase
                                'OFF_SMALLPOPUP' => $arParams['OFF_SMALLPOPUP'],
                                'USE_SHADOW_ON_HOVER' => $arParams['USE_SHADOW_ON_HOVER'],
                                // store
                                'USE_STORE' => $arParams['USE_STORE'],
                                'USE_MIN_AMOUNT' => $arParams['USE_MIN_AMOUNT'],
                                'MIN_AMOUNT' => $arParams['MIN_AMOUNT'],
                                'MAIN_TITLE' => $arParams['MAIN_TITLE'],
                                "PROP_STORE_REPLACE_SECTION" => $arParams['PROP_STORE_REPLACE_SECTION'],
                                "PROP_STORE_REPLACE_DETAIL" => $arParams['PROP_STORE_REPLACE_DETAIL'],
                                // -----
                                'BY_LINK' => 'Y',
                                'DONT_SHOW_LINKS' => 'N',
                                // 'VIEW' => $alfaCTemplate,
                                'COLUMNS5' => 'Y',
                                // seo
                                "ADD_SECTIONS_CHAIN" => "N",
                                "SET_BROWSER_TITLE" => "N",
                                "SET_META_KEYWORDS" => "N",
                                "SET_META_DESCRIPTION" => "N",
                                "ADD_ELEMENT_CHAIN" => "N",
                            ),
                            $component,
                            array('HIDE_ICONS'=>'Y')
                        );?><?
                    ?></div><?
                ?></div><?
            ?></div><?
        } elseif(
            $sPropCode!='' &&
            $arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE']=='F' &&
            isset($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            is_array($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            count($arResult['PROPERTIES'][$sPropCode]['VALUE'])>0
        ) { // files
            ?><div class="tab-pane active" role="tabpanel" id="prop<?=$sPropCode?>"><?
                ?><div class="tab-pane-in"><?
                    ?><div class="tab-pane-in2"><?
                        $index = 1;
                        foreach ($arResult['PROPERTIES'][$sPropCode]['VALUE'] as $arFile) {
                            ?><a class="docs" href="<?=$arFile['FULL_PATH']?>"><?
                                ?><i class="icon pngicons <?=$arFile['TYPE']?>"></i><?
                                ?><span class="name"><?=$arFile['ORIGINAL_NAME']?></span><?
                                if( isset($arFile['DESCRIPTION']) ) { ?><span class="description"><?=$arFile['DESCRIPTION']?></span><? }
                                ?><span class="size">(<?=$arFile['TYPE']?>, <?=$arFile['SIZE']?>)</span><?
                            ?></a><?
                            if ($index > 3) { $index==0; }
                            ?><span class="separator x<?=$index?>"></span><?
                            $index++;
                        }
                    ?></div><?
                ?></div><?
            ?></div><?
        } elseif ($sPropCode != '' && isset($arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE'])) { // else
            ?><div class="tab-pane active" role="tabpanel" id="prop<?=$sPropCode?>"><?
                ?><div class="tab-pane-in"><?
                    ?><div class="tab-pane-in2"><?
                        ?><?
                        if(is_array($arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE'])){
                            echo implode(' / ', $arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE']);
                        } else {
                            echo $arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE'];
                        }
                        ?><?
                    ?></div><?
                ?></div><?
            ?></div><?
        }
    }
}

$this->EndViewTarget();
