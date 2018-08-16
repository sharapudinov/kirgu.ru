<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS'])>0) ? true : false;
?>

<?php if ($haveOffers): ?>
    <div class="c-changelable-props">
        <?php foreach ($product['DISPLAY_PROPERTIES'] as $arProp): ?>
            <?php if (!in_array($arProp['CODE'], $arParams['PROPS_ATTRIBUTES'])): ?>
                <div class="c-changelable-props__property"><?
                    ?><span class="c-changelable-props__name"><?=$arProp['NAME']?>: </span><?
                    ?><span class="c-changelable-props__value js-changelable-props-val__<?=$arProp['CODE']?>"><?
                    echo (is_array($arProp['DISPLAY_VALUE']) ? implode(' / ', $arProp['DISPLAY_VALUE']) : $arProp['DISPLAY_VALUE']);
                    ?></span>
                </div>
            <?php endif; ?>
        <?php endforeach; ?>
    </div>
<?php endif; ?>
