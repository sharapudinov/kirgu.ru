<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if ($arParams['USE_PRODUCT_QUANTITY'] != 'Y')
    return;

$paramsQuantity = array(
    'DISABLE' => $params['DISABLE_QUANTITY'] == 'Y' ? true : false,
);
?>

<span class="c-quantity<?=($paramsQuantity['DISABLE_QUANTITY'] ? ' disable' : '')?>">
    <span class="c-quantity__inner">
        <a class="c-quantity__minus js-minus"></a>
        <input type="text" class="c-quantity__value js-quantity<?php if ($arParams['USE_PRICE_COUNT']):?> js-use_count<?endif;?>" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="<?=$product['CATALOG_MEASURE_RATIO']?>" data-ratio="<?=$product['CATALOG_MEASURE_RATIO']?>">
        <?php if ($arParams['OFF_MEASURE_RATION'] != 'Y'): ?>
        <span class="c-quantity__measure js-measurename"><?=$product['CATALOG_MEASURE_NAME']?></span>
        <?php endif; ?>
        <a class="c-quantity__plus js-plus"></a>
    </span>
</span>
