<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\localization\Loc;

Loc::loadMessages(__FILE__);

$priceCanViewCount = 1;
if (is_array($arResult['PRICES']) && count($arResult['PRICES']) > 0) {
    foreach ($arResult['PRICES'] as $sPriceCode => $arPrice) {
        if (!$arPrice['CAN_VIEW']) {
            continue;
        }
        $priceCanViewCount++;
    }
}

$priceCount = 0;
$priceCountShowed = 0;
if (!empty($product['PRICE_MATRIX']['COLS'])) {
    $bMultyPrice = ($priceCanViewCount && is_array($product['PRICE_MATRIX']['COLS']) && count($product['PRICE_MATRIX']['COLS']) > 1 ? true : false);
    $bProductMultyPrice = (is_array($product['PRICE_MATRIX']['COLS']) && count($product['PRICE_MATRIX']['COLS']) > 1 ? true : false);
} else {
    $bMultyPrice = ($priceCanViewCount && is_array($product['PRICES']) && count($product['PRICES']) > 1 ? true : false);
    $bProductMultyPrice = (is_array($product['PRICES']) && count($product['PRICES']) > 1 ? true : false);
}

$params = array(
    'SHOW_NAME' => true,
    'SHOW_DISCOUNT_NAME' => ($params['SHOW_DISCOUNT_NAME'] == 'Y' ? true : false),
    'SHOW_DISCOUNT_DIFF' => ($params['SHOW_DISCOUNT_DIFF'] == 'Y' ? true : false),
    'SHOW_DISCOUNT_DIFF_PERCENT' => ($params['SHOW_DISCOUNT_DIFF_PERCENT'] == 'Y' ? true : false),
    'SHOW_OLD_PRICE' => ($params['SHOW_OLD_PRICE'] != 'Y' ? false : true),
    'PAGE' => (isset($params['PAGE']) && $params['PAGE'] == 'detail' ? 'detail' : 'list'),
    'VIEW' => (isset($params['VIEW']) && $params['VIEW'] == 'list' ? 'list' : 'line'),
    'MAX_SHOW' => (!empty($params['MAX_SHOW']) ? $params['MAX_SHOW'] : 2),
    'SHOW_MORE' => ($params['SHOW_MORE'] == 'Y' ? true : false),
    'USE_ALONE' => ($params['USE_ALONE'] == 'Y' ? true : false),
    'PRICE_CODE' => '',
    'PRICE_NAME' => '',
    'HIDE_PRICE' => false,
);

if (!$params['USE_ALONE']) {
    $bProductMultyPrice = true;
}

$prices = ($params['PAGE'] == 'detail' ? $arResult['CAT_PRICES'] : $arResult['PRICES']);

if (empty($prices)) {
    return;
}

if (!function_exists('rsGoProShowPrice')) {
    function rsGoProShowPrice($arPrice = array(), $params = array()) {
        $issetPrice = (!empty($arPrice) && is_array($arPrice)) ? true : false;
        $flag = ($params['PAGE'] == 'list' && $params['VIEW'] == 'line' ?: false);
        ?><span <?
            ?>class="c-prices__price <?
            ?><?=($params['HIDE_PRICE'] && !$flag ? ' c-prices__hide' : '')?> <?
            ?><?=(!$issetPrice && !$flag ? ' c-prices__empty' : '')?> <?
            ?>js-prices__price <?
            ?>js-prices__price-code_<?=$params['PRICE_CODE']?><?
            ?>" <?
            ?>data-pricecode="<?=$params['PRICE_CODE']?>" <?
            ?>><?
            if ($params['SHOW_NAME']) {
                ?><span class="c-prices__name"><?=$params['PRICE_NAME']?>:</span><?
            }
            ?><span class="c-prices__value js-prices_pdv_<?=$params['PRICE_CODE']?>"><?=($issetPrice ? $arPrice["PRINT_DISCOUNT_VALUE"] : ' &nbsp; ')?></span><?
            if ($params['SHOW_OLD_PRICE']) {
                ?><span class="c-prices__value-old js-prices_pv_<?=$params['PRICE_CODE']?>_hide js-prices_pv_<?=$params['PRICE_CODE']?><?=($arPrice['DISCOUNT_DIFF'] > 0 ? '' : ' c-prices__hide')?>"><?=($issetPrice ? $arPrice['PRINT_VALUE'] : '')?></span><?
            }
            if ($params['SHOW_DISCOUNT_DIFF']) {
                if (empty($arPrice['PRINT_DISCOUNT']) && !empty($arPrice['PRINT_DISCOUNT_DIFF'])) {
                    $arPrice['PRINT_DISCOUNT'] = $arPrice['PRINT_DISCOUNT_DIFF'];
                }
                ?><span class="c-prices__discount js-prices-discount js-prices_pd_<?=$params['PRICE_CODE']?>_hide<?=($arPrice['DISCOUNT_DIFF'] && !empty($arPrice['PRINT_DISCOUNT']) > 0 ? '' : ' c-prices__hide')?>"><?
                    ?><span class="c-prices__value-discount-name"><?=Loc::getMessage('PRICES.DISCOUNT.NAME')?></span><?
                    ?><span class="c-prices__value-discount js-prices_pd_<?=$params['PRICE_CODE']?>"><?=($issetPrice ? $arPrice['PRINT_DISCOUNT'] : '')?></span><?
                ?></span><?
            }
            if ($params['SHOW_DISCOUNT_DIFF_PERCENT']) {
                ?><span class="c-prices__discount js-prices-discount js-prices_ddp_<?=$params['PRICE_CODE']?>_hide<?=($arPrice['DISCOUNT_DIFF'] && !empty($arPrice['DISCOUNT_DIFF_PERCENT']) > 0 ? '' : ' c-prices__hide')?>"><?
                    ?><span class="c-prices__value-discount-name"><?=Loc::getMessage('PRICES.DISCOUNT.NAME')?></span><?
                    ?><span class="c-prices__value-discount js-prices_ddp_<?=$params['PRICE_CODE']?>"><?=($issetPrice ? $arPrice['DISCOUNT_DIFF_PERCENT'] : '')?></span><?
                ?></span><?
            }
        ?></span><?
        
        if ($issetPrice) {
            return true;
        }
        return false;
    }
}
?>

<div <?
    ?>class="c-prices js-prices view-<?=$params['VIEW']?> page-<?=$params['PAGE']?> product-<?=($bProductMultyPrice ? 'multiple' : 'alone')?>" <?
    ?>data-page="<?=$params['PAGE']?>" <?
    ?>data-view="<?=$params['VIEW']?>" <?
    ?>data-maxshow="<?=$params['MAX_SHOW']?>" <?
    ?>data-showmore="<?=($params['SHOW_MORE'] ? 'Y' : 'N')?>" <?
    ?>data-usealone="<?=($params['USE_ALONE'] ? 'Y' : 'N')?>" <?
    ?>data-multiprice="<?=($bMultyPrice ? 'Y' : 'N')?>" <?
    ?>data-productmultiprice="<?=($bProductMultyPrice ? 'Y' : 'N')?>" <?
    ?>>
<?php
foreach ($prices as $priceCode => $arPriceInfo) {
    if (!$arPriceInfo['CAN_VIEW']) {
        continue;
    }

    if ($priceCount >= $params['MAX_SHOW'] && $params['PAGE'] == 'list' && $params['VIEW'] == 'line') {
        break;
    }

    if ($priceCountShowed >= $params['MAX_SHOW']) {
        $params['HIDE_PRICE'] = true;
    }

    $priceTypeId = $arPriceInfo['ID'];
    $params['PRICE_CODE'] = $arPriceInfo['CODE'];
    $params['PRICE_NAME'] = $arPriceInfo['TITLE'];

    if ($arParams['USE_PRICE_COUNT'] == 'Y' && !empty($product['PRICE_MATRIX']['COLS'])) {
        if (!empty($product['PRICE_MATRIX']['MATRIX'][$priceTypeId])) {
            $arPrice = reset($product['PRICE_MATRIX']['MATRIX'][$priceTypeId]);
        } else {
            $arPrice = array();
        }
    } else {
        $arPrice = $product['PRICES'][$priceCode];
    }

    if (rsGoProShowPrice($arPrice, $params)) {
        $priceCountShowed++;
    }

    $priceCount++;
}

////////////////// more part //////////////////
if ($arParams['USE_PRICE_COUNT'] == 'Y' && !empty($product['PRICE_MATRIX']['COLS'])) {
    $count = count($product['PRICE_MATRIX']['COLS']) - $params['MAX_SHOW'];
} else {
    $count = count($product['PRICES']) - $params['MAX_SHOW'];
}

$hideMore = true;
if ($count > 0) {
    $hideMore = false;
}

if ($params['SHOW_MORE']) {
    ?><div class="c-prices__more js-prices__more<?=($hideMore ? ' c-prices__hide' : '')?>"><?
        ?><a class="c-prices__more-link" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('PRICES.MORE', array('#COUNT#' => $count))?></a><?
    ?></div><?
}
////////////////// /more part //////////////////
?></div>
