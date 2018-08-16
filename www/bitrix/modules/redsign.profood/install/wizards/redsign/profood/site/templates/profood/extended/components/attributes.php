<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

if (!is_array($arItem['OFFERS_EXT']['PROPERTIES']) || empty($arItem['OFFERS_EXT']['PROPERTIES']))
    return;

$params = array(
    'VIEW' => ($params['VIEW'] == 'list' ? 'list' : 'buttons'),
    'HIDE_NAME' => ($params['HIDE_NAME'] != 'Y' ? false : true),
);

$svgArrowDown = '<svg class="c-attributes__arrow svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-down"></use></svg>';
?>

<div class="c-attributes view-<?=$params['VIEW']?> <?=($params['HIDE_NAME'] ? 'hide-name' : '')?> js-attributes" data-view="<?=$params['VIEW']?>">
<?php foreach ($arItem['OFFERS_EXT']['PROPERTIES'] as $propCode => $arProperty):
    $isPic = false;
    if (is_array($arParams['PROPS_ATTRIBUTES_COLOR']) && in_array($propCode, $arParams['PROPS_ATTRIBUTES_COLOR']))
        $isPic = true;
    ?>
    <!-- prop --><div class="c-attributes__prop js-attributes__prop js-attributes__code__<?=$propCode?> close<?php if ($isPic): ?> is-pic js-pic<?php endif;?>" data-code="<?=$propCode?>">

        <?php
        ?><span class="c-attributes__select js-attributes__select"><?

        foreach ($arProperty as $value => $arValue):
            if ($arValue['FIRST_OFFER'] != 'Y')
                continue;
                
            ?><!-- name-current-value --><span class="c-attributes__name-current-value"><?
            ?><span class="c-attributes__name"><?=$arItem['OFFERS_EXT']['PROPS'][$propCode]['NAME']?>: </span><?

            if (is_array($arValue)):
            ?><span class="c-attributes__current-value js-attributes__curent-value"><?
                ?><span class="c-attributes__current-value__pseudo-option"><?
                    ?><?php if ($isPic): ?><?
                        ?><span class="c-attributes__value-pic js-attributes__set-value-pic" style="background-image:url('<?=$arValue['PICT']['SRC']?>');" title="<?=$arValue['VALUE']?>"></span><?
                    ?><?php endif; ?><?
                    ?><span class="c-attributes__value js-attributes__set-value-text"><?=$arValue['VALUE']?></span><?
                    ?><?=$svgArrowDown?><?
                ?></span><?
            ?></span><?
            endif;

            ?></span><!-- /name-current-value --><?

            break;
        endforeach;

            ?><!-- options --><span class="c-attributes__options js-attributes__options"><?
            $isFirstValue = false;
            foreach ($arProperty as $value => $arValue):
                ?><span class="c-attributes__option <?
                    ?>js-attributes__option <?
                    if ($arValue['FIRST_OFFER'] == 'Y'):?> selected<?
                    elseif ($arValue['DISABLED_FOR_FIRST'] == 'Y'):?> disabled<?
                    endif;?>" <?
                    ?>data-value="<?=htmlspecialcharsbx($arValue['VALUE'])?>" <?
                    if ($isPic):
                        ?>data-value-pic="<?=$arValue['PICT']['SRC']?>" <?
                    endif;
                    ?>><?
                    ?><?php if ($isPic): ?><?
                        ?><span class="c-attributes__value-pic js-attributes__value-pic" style="background-image:url('<?=$arValue['PICT']['SRC']?>');" title="<?=$arValue['VALUE']?>"></span><?
                    ?><?php endif; ?><?
                    ?><span class="c-attributes__value c-attributes__option__value js-attributes__value-text"><?=$arValue['VALUE']?></span><?
                ?></span><?
            endforeach;
            ?></span><!-- /options --><?
        ?></span><?

    ?></div><!-- /prop -->
<?php endforeach; ?>
</diV>


<?/*
<div class="c-properties">
    <?php foreach ($arItem['OFFERS_EXT']['PROPERTIES'] as $propCode => $arProperty): ?>
        <?php
        $isColor = false;
        if (is_array($arParams['PROPS_ATTRIBUTES_COLOR']) && in_array($propCode, $arParams['PROPS_ATTRIBUTES_COLOR']))
            $isColor = true;
        ?>
        <div class="offer_prop prop_<?=$propCode?> closed<?php if ($isColor): ?> color<?php endif;?>" data-code="<?=$propCode?>">
            <span class="offer_prop-name"><?=$arItem['OFFERS_EXT']['PROPS'][$propCode]['NAME']?>: </span>
            <div class="div_select">
                <div class="div_options">
                <?php
                $firstVal = false;
                ?>
                <?php foreach ($arProperty as $value => $arValue): ?>
                    <div class="div_option<?
                        if ($arValue['FIRST_OFFER'] == 'Y'):?> selected<?
                        elseif ($arValue['DISABLED_FOR_FIRST'] == 'Y'):?> disabled<?
                        endif;?>" data-value="<?=htmlspecialcharsbx($arValue['VALUE'])?>">
                        <?php if ($isColor): ?>
                            <span style="background-image:url('<?=$arValue['PICT']['SRC']?>');" title="<?=$arValue['VALUE']?>"></span> &nbsp; <?=$arValue['VALUE']?>
                        <?php else: ?>
                            <span><?=$arValue['VALUE']?></span>
                        <?php endif; ?>
                    </div>
                    <?php
                    if ($arValue['FIRST_OFFER'] == 'Y')
                        $firstVal = $arValue;
                    ?>
                <?php endforeach; ?>
                </div>
                <?php if (is_array($firstVal)): ?>
                    <div class="div_selected">
                        <?php if ($isColor): ?>
                            <span style="background-image:url('<?=$firstVal['PICT']['SRC']?>');" title="<?=$firstVal['VALUE']?>"></span>
                        <?php else: ?>
                            <span><?=$firstVal['VALUE']?></span>
                        <?php endif; ?>
                        <svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    <?php endforeach; ?>
</div>
*/
