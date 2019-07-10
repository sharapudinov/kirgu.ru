<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;
if(is_array($product['PRICES']["СпецЦена"])){
   $product['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']= round((1-$product['PRICES']["СпецЦена"]['VALUE']/$product['PRICES']["Розничная"]['VALUE'])*100);
}
/*if(is_array($product['PRICES']["РРЦ"])){
   $product['MIN_PRICE']['DISCOUNT_DIFF_PERCENT']= round((1-$product['PRICES']["Розничная"]['VALUE']/$product['PRICES']["РРЦ"]['VALUE'])*100);
}*/
$aktsii=array_merge($arItem['PROPERTIES']['AKTSII']['VALUE_EXT'],$arItem['PROPERTIES']['RASSROCHKA']['VALUE_EXT']);


Loc::loadMessages(__FILE__);
?>

<div class="c-stickers"><?

    ?><?php if ($arParams['STICKERS_DISCOUNT_VALUE'] == 'Y'):
        if ($arParams['USE_PRICE_COUNT'] != 'Y') {
            $val = $product['MIN_PRICE']['DISCOUNT_DIFF_PERCENT'] ;
        } else {
            if (!empty($product['ITEM_PRICES'])) {
                $tmp = reset($product['ITEM_PRICES']);
                $val = $tmp['PERCENT'];
            } else {
                $val = 0;
            }
        }
        ?><?
        ?><span
        class="c-stickers__sticker c-stickers__sticker-standart c-stickers__discount js-discount-value" <?php if ($val < 1): ?> style="display: none;"<?php endif; ?>>
        <?=Loc::getMessage('STICKERS.DP')?><span class="js-discount-value"> <?= $val ?></span>%</span><?
        ?><?php endif; ?><?

    ?>

    <span class="c-stickers__sticker c-stickers__da2"><?= Loc::getMessage('STICKERS.DA2') ?></span><?
    ?><span class="c-stickers__sticker c-stickers__qb"><?= Loc::getMessage('STICKERS.QB') ?></span><?

    ?><?php foreach (array_merge($arItem['PROPERTIES']['AKTSII']['VALUE_EXT'],$arItem['PROPERTIES']['RASSROCHKA']['VALUE_EXT'])as $value):

        ?><?
        ?><?php if (is_array($value)): ?><?
        ?>
        <span
        class="c-stickers__sticker c-stickers__sticker-standart c-stickers__<?= $value['UF_XML_ID'] ?>"<?php if ($value['UF_DESCRIPTION'] != ''): ?>
            style="background-color: <?= $value['UF_DESCRIPTION'] ?>;"<?php endif; ?>><a href="<?=$value['UF_LINK']?>"> <?= $value['UF_NAME'] ?></a>
        </span><?
        ?><?php endif; ?><?
        ?><?php endforeach; ?><?

    ?></div>
