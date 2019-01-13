<?define('NEED_AUTH', true);
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');

if (isset($_REQUEST['backurl']) && strlen($_REQUEST['backurl'])>0) 
	LocalRedirect($backurl);
global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;

$APPLICATION->SetTitle('Авторизация');
$ajaxPagesID='ajaxpages_auth';

if ($_REQUEST['ajaxpages'] == 'Y' && $_REQUEST['ajaxpagesid'] == $ajaxPagesID) {
    $IS_AJAXPAGES = 'Y';
    $JSON['TYPE'] = 'OK';
}

?>

<p>Вы успешно зарегистрировались и авторизовались на сайте!</p>

<div class="sorter_and_name clearfix">
	<h3 class="name">Лучшие товары</h3>
</div>
    <div id="<?=$ajaxPagesID?>" class="<?=$ajaxPagesID?> clearfix">

        <?$APPLICATION->IncludeComponent(
            "bitrix:catalog.section",
            "gopro",
            array(
                "IBLOCK_TYPE" => "catalog",
                "IBLOCK_ID" => "4",
                "SECTION_ID" => "",
                "SECTION_CODE" => "",
                "SECTION_USER_FIELDS" => array(
                    0 => "",
                    1 => "",
                ),
                "ELEMENT_SORT_FIELD" => "sort",
                "ELEMENT_SORT_ORDER" => "asc",
                "ELEMENT_SORT_FIELD2" => "timestamp_x",
                "ELEMENT_SORT_ORDER2" => "asc",
                "FILTER_NAME" => "",
                "INCLUDE_SUBSECTIONS" => "A",
                "SHOW_ALL_WO_SECTION" => "Y",
                "HIDE_NOT_AVAILABLE" => "Y",
                "PAGE_ELEMENT_COUNT" => "15",
                "LINE_ELEMENT_COUNT" => "3",
                "PROPERTY_CODE" => array(
                    0 => "CML2_ARTICLE",
                    1 => "BRAND",
                    2 => "YEAR",
                    3 => "CUSTOM_STORE_INFO",
                    4 => "",
                ),
                "OFFERS_LIMIT" => "0",
                "TEMPLATE_THEME" => "",
                "PRODUCT_SUBSCRIPTION" => "N",
                "SHOW_DISCOUNT_PERCENT" => "N",
                "SHOW_OLD_PRICE" => "N",
                "MESS_BTN_BUY" => "Купить",
                "MESS_BTN_ADD_TO_BASKET" => "В корзину",
                "MESS_BTN_SUBSCRIBE" => "Подписаться",
                "MESS_BTN_DETAIL" => "Подробнее",
                "MESS_NOT_AVAILABLE" => "Нет в наличии",
                "SECTION_URL" => "/catalog/#SECTION_CODE_PATH#/",
                "DETAIL_URL" => "/catalog/#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
                "SECTION_ID_VARIABLE" => "SECTION_ID",
                "AJAX_MODE" => "N",
                "AJAX_OPTION_JUMP" => "N",
                "AJAX_OPTION_STYLE" => "N",
                "AJAX_OPTION_HISTORY" => "N",
                "CACHE_TYPE" => "A",
                "CACHE_TIME" => "360000",
                "CACHE_GROUPS" => "Y",
                "SET_META_KEYWORDS" => "N",
                "META_KEYWORDS" => "",
                "SET_META_DESCRIPTION" => "N",
                "META_DESCRIPTION" => "",
                "BROWSER_TITLE" => "-",
                "ADD_SECTIONS_CHAIN" => "N",
                "DISPLAY_COMPARE" => "Y",
                "SET_TITLE" => "Y",
                "SET_STATUS_404" => "N",
                "CACHE_FILTER" => "N",
                "PRICE_CODE" => array(
                    0 => "Розничная",
                    1 => "РРЦ",
                    2 => "СпецЦена",
                ),
                "USE_PRICE_COUNT" => "N",
                "SHOW_PRICE_COUNT" => "1",
                "PRICE_VAT_INCLUDE" => "Y",
                "CONVERT_CURRENCY" => "N",
                "BASKET_URL" => "/personal/cart/",
                "ACTION_VARIABLE" => "action",
                "PRODUCT_ID_VARIABLE" => "id",
                "USE_PRODUCT_QUANTITY" => "Y",
                "ADD_PROPERTIES_TO_BASKET" => "N",
                "PRODUCT_PROPS_VARIABLE" => "prop",
                "PARTIAL_PRODUCT_PROPERTIES" => "N",
                "PRODUCT_PROPERTIES" => array(
                ),
                "PAGER_TEMPLATE" => "gopro",
                "DISPLAY_TOP_PAGER" => "Y",
                "DISPLAY_BOTTOM_PAGER" => "Y",
                "PAGER_TITLE" => "Товары",
                "PAGER_SHOW_ALWAYS" => "N",
                "PAGER_DESC_NUMBERING" => "N",
                "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                "PAGER_SHOW_ALL" => "Y",
                "OFFERS_FIELD_CODE" => array(
                    0 => "ID",
                    1 => "CODE",
                    2 => "XML_ID",
                    3 => "NAME",
                    4 => "TAGS",
                    5 => "SORT",
                    6 => "PREVIEW_TEXT",
                    7 => "PREVIEW_PICTURE",
                    8 => "DETAIL_TEXT",
                    9 => "DETAIL_PICTURE",
                    10 => "DATE_ACTIVE_FROM",
                    11 => "ACTIVE_FROM",
                    12 => "DATE_ACTIVE_TO",
                    13 => "ACTIVE_TO",
                    14 => "SHOW_COUNTER",
                    15 => "SHOW_COUNTER_START",
                    16 => "IBLOCK_TYPE_ID",
                    17 => "IBLOCK_ID",
                    18 => "IBLOCK_CODE",
                    19 => "IBLOCK_NAME",
                    20 => "IBLOCK_EXTERNAL_ID",
                    21 => "DATE_CREATE",
                    22 => "CREATED_BY",
                    23 => "CREATED_USER_NAME",
                    24 => "TIMESTAMP_X",
                    25 => "MODIFIED_BY",
                    26 => "USER_NAME",
                    27 => "",
                ),
                "OFFERS_PROPERTY_CODE" => array(
                    0 => "CML2_ARTICLE",
                    1 => "MORE_PHOTO",
                    2 => "COLOR_DIRECTORY",
                    3 => "SKU_SIZE_MEMORY",
                    4 => "SKY_SIZE_WEIGHT",
                    5 => "",
                ),
                "OFFERS_SORT_FIELD" => "sort",
                "OFFERS_SORT_ORDER" => "asc",
                "OFFERS_SORT_FIELD2" => "id",
                "OFFERS_SORT_ORDER2" => "asc",
                "PROP_MORE_PHOTO" => "MORE_PHOTO",
                "PROP_ARTICLE" => "CML2_ARTICLE",
                "PROP_ACCESSORIES" => "-",
                "USE_FAVORITE" => "Y",
                "USE_SHARE" => "Y",
                "SHOW_ERROR_EMPTY_ITEMS" => "Y",
                "DONT_SHOW_LINKS" => "N",
                "USE_STORE" => "Y",
                "USE_MIN_AMOUNT" => "Y",
                "MIN_AMOUNT" => "10",
                "MAIN_TITLE" => "Наличие на складах",
                "PROP_SKU_MORE_PHOTO" => "MORE_PHOTO",
                "PROP_SKU_ARTICLE" => "-",
                "PROPS_ATTRIBUTES" => array(
                ),
                "OFFERS_CART_PROPERTIES" => array(
                ),
                "PRODUCT_QUANTITY_VARIABLE" => "quantity",
                "AJAXPAGESID" => $ajaxPagesID,
                "IS_AJAXPAGES" => $IS_AJAXPAGES,
                "IS_SORTERCHANGE" => $isSorterChange,
                "AJAX_OPTION_ADDITIONAL" => "",
                "VIEW" => $alfaCTemplate,
                "COLUMNS5" => "Y",
                "SET_BROWSER_TITLE" => "N",
                "USE_AUTO_AJAXPAGES" => "Y",
                "PROPS_ATTRIBUTES_COLOR" => array(
                ),
                "COMPARE_PATH" => "",
                "OFF_SMALLPOPUP" => "N",
                "COMPONENT_TEMPLATE" => "gopro",
                "BACKGROUND_IMAGE" => "-",
                "SEF_MODE" => "N",
                "SET_LAST_MODIFIED" => "N",
                "USE_MAIN_ELEMENT_SECTION" => "Y",
                "EMPTY_ITEMS_HIDE_FIL_SORT" => "Y",
                "OFF_MEASURE_RATION" => "N",
                "PAGER_BASE_LINK_ENABLE" => "N",
                "SHOW_404" => "N",
                "MESSAGE_404" => "",
                "DISABLE_INIT_JS_IN_COMPONENT" => "N",
                "USE_SHADOW_ON_HOVER" => "N",
                "STICKERS_PROPS" => array(
                ),
                "STICKERS_DISCOUNT_VALUE" => "Y",
                "CUSTOM_FILTER" => "",
                "HIDE_NOT_AVAILABLE_OFFERS" => "Y",
                "HIDE_IN_LIST" => "Y",
                "PROP_STORE_REPLACE_SECTION" => "0",
                "COMPATIBLE_MODE" => "Y",
                "LIST_SKU_VIEW" => "",
                "COL_XS_6" => "N",
                "OFF_HOVER_POPUP" => "N",
                "USE_LAZYLOAD" => "Y",
                "USE_RATING" => "Y",
                "RATING_PROP_COUNT" => "-",
                "RATING_PROP_SUM" => "-",
                "HIDE_AJAXPAGES_LINK" => "N"
            ),
            false
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
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>