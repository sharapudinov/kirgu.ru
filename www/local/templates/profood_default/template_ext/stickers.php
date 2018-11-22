<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!empty($arParams['STICKERS_PROPS']) || $arParams['STICKERS_DISCOUNT_VALUE'] == 'Y') {
    ?><div class="stickers"><?

        foreach ($arParams['STICKERS_PROPS'] as $propCode) {
            $prop = $arItem['PROPERTIES'][$propCode];
            if ($prop['VALUE'] != '') {
                ?><div class="sticker sticker__<?=$prop['VALUE']?>"<?php if ($prop['HINT'] != ''): ?>style="background-color: <?=$prop['HINT']?>;"<?php endif; ?>><?=$prop['NAME']?></div><?
            }
        }

        if ($arParams['STICKERS_DISCOUNT_VALUE'] == 'Y') {
            if ($arParams['USE_PRICE_COUNT'] != 'Y') {
                $val = $product['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'];
            } else {
                if (!empty($product['ITEM_PRICES'])) {
                    $tmp = reset($product['ITEM_PRICES']);
                    $val = $tmp['PERCENT'];
                } else {
                    $val = 0;
                }
            }

            ?><div class="sticker sticker__discount js-discount-value" <?php if ($val < 1): ?> style="display: none;"<?php endif; ?>>-<span class="js-discount-value"><?=$val?></span>%</div><?
        }

    ?></div><?
}
