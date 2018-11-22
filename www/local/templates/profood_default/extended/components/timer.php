<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$arTimers = array();

if ($arItem['HAVE_DA2'] == 'Y') {

    if (isset($arItem['DAYSARTICLE2'])) {
        $arTimers[] = $arItem['DAYSARTICLE2'];
    } elseif ($haveOffers) {
        foreach ($arItem['OFFERS'] as $arOffer) {
            if (isset($arOffer['DAYSARTICLE2'])) {
                $arTimers[] = $arOffer['DAYSARTICLE2'];
            }
        }
    }

} elseif ($arItem['HAVE_QB'] == 'Y') {

    if (isset($arItem['QUICKBUY'])) {
        $arTimers[] = $arItem['QUICKBUY'];
    } elseif ($haveOffers) {
        foreach ($arItem['OFFERS'] as $arOffer) {
            if (isset($arOffer['QUICKBUY'])) {
                $arTimers[] = $arOffer['QUICKBUY'];
            }
        }
    }
}


if (is_array($arTimers) && count($arTimers) > 0) {
    $haveVision = false;
    ?><div class="c-timers"><?
        foreach ($arTimers as $arTimer) {

            $KY = 'TIMER';
            if (isset($arTimer['DINAMICA_EX'])) {
                $KY = 'DINAMICA_EX';
            }

            $jsTimer = array(
                'DATE_FROM' => $arTimer[$KY]['DATE_FROM'],
                'DATE_TO' => $arTimer[$KY]['DATE_TO'],
                'AUTO_RENEWAL' => $arTimer['AUTO_RENEWAL'],
            );

            if (isset($arTimer['DINAMICA'])) {
                $jsTimer['DINAMICA_DATA'] = $arTimer['DINAMICA'] == 'custom' ? array_flip(unserialize($arTimer['DINAMICA_DATA'])) : $arTimer['DINAMICA'];
            }
            
            ?><div class="timer <?if(isset($arTimer['DINAMICA_EX'])):?>da2<?else:?>qb<?endif;?> js-timer_id<?=$arTimer['ELEMENT_ID']?> clearfix" style="display:<?
                if (($arItem['ID'] == $arTimer['ELEMENT_ID'] || $product['ID'] == $arTimer['ELEMENT_ID']) && !$haveVision) {
                    ?>inline-block<?
                    $haveVision = true;
                } else {
                    ?>none<?
                }
                ?>;" data-timer='<?=json_encode($jsTimer)?>'><?
                ?><div class="clock"></div><?
                ?><div class="intimer clearfix"  data-dateto="<?=$arTimer[$KY]['DATE_TO']?>" data-autoreuse="<?=$arTimer['AUTO_RENEWAL'];?>"><?
                    ?><div class="val"<?=($arTimer[$KY]['DAYS'] < 1 ? ' style="display: none;"' : '');?>><div class="value result-day"><?
                        echo ($arTimer[$KY]['DAYS']>9?$arTimer[$KY]['DAYS']:'0'.$arTimer[$KY]['DAYS'] )
                        ?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_DAY')?></div></div><?
                    ?><div class="val"><div class="value result-hour"><?
                        echo ($arTimer[$KY]['HOUR']>9?$arTimer[$KY]['HOUR']:'0'.$arTimer[$KY]['HOUR'] )
                        ?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_HOUR')?></div></div><?
                    ?><div class="val"><div class="value result-minute"><?
                        echo ($arTimer[$KY]['MINUTE']>9?$arTimer[$KY]['MINUTE']:'0'.$arTimer[$KY]['MINUTE'] )
                        ?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_MIN')?></div></div><?
                        ?><div class="val" <?=($arTimer[$KY]['DAYS'] > 0 ? 'style="display: none;"' : '');?>><div class="value result-second"><?
                            echo ($arTimer[$KY]['SECOND']>9?$arTimer[$KY]['SECOND']:'0'.$arTimer[$KY]['SECOND'] )
                            ?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_SEC')?></div></div><?
                    if (isset($arTimer['DINAMICA_EX']) || isset($arTimer['TIMER'])) {
                        ?><div class="val ml"><div class="value"><span class="num_percent">0</span>%</div><div class="podpis"><?=GetMessage('QB_AND_DA2_PRODANO')?></div></div><?
                    }
                ?></div><?
                if (isset($arTimer['DINAMICA_EX']) || isset($arTimer['TIMER'])) {
                    ?><div class="clear"></div><div class="progressbar"><div class="progress" style="width:0%;"></div></div><?
                }
            ?></div><?
        }
    ?></div><?
}
