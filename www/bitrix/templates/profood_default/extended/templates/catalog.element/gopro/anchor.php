<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

// anchor
$esOffset = '-135';

$this->SetViewTarget('TABS_HTML_HEADERS_ANCHOR');
if ($arResult['TABS']['DETAIL_TEXT']) {
    ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#detailtext" data-es-offset="<?=$esOffset?>"><?=GetMessage('TABS_DETAIL_TEXT')?></a><?
}
if ($arResult['TABS']['DISPLAY_PROPERTIES']) {
    ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#properties" data-es-offset="<?=$esOffset?>"><?=GetMessage('TABS_PROPERTIES')?></a><?
}
if ($arResult['TABS']['DELIVERY_COST']) {
    ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#deliverycost" data-es-offset="<?=$esOffset?>"><?=GetMessage('TABS_DELIVERY_COST')?></a><?
}
if ($arResult['TABS']['SET']) {
    ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#set" data-es-offset="<?=$esOffset?>"><?=GetMessage('TABS_SET')?></a><?
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
            ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#prop<?=$sPropCode?>" data-es-offset="<?=$esOffset?>"><?=$arResult['PROPERTIES'][$sPropCode]['NAME']?></a><?
        } elseif(
            $sPropCode != '' &&
            $arResult['PROPERTIES'][$sPropCode]['PROPERTY_TYPE'] == 'F' &&
            isset($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            is_array($arResult['PROPERTIES'][$sPropCode]['VALUE']) &&
            count($arResult['PROPERTIES'][$sPropCode]['VALUE'])>0
        ) { // files
            ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#prop<?=$sPropCode?>" data-es-offset="<?=$esOffset?>"><?=$arResult['PROPERTIES'][$sPropCode]['NAME']?></a><?
        } elseif( $sPropCode!='' && isset($arResult['DISPLAY_PROPERTIES'][$sPropCode]['DISPLAY_VALUE']) ) { // else
            ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#prop<?=$sPropCode?>" data-es-offset="<?=$esOffset?>"><?=$arResult['PROPERTIES'][$sPropCode]['NAME']?></a><?
        }
    }
}
if ($arResult['TABS']['STOCKS']) {
    ?><a class="detail__anchor__link link-dashed js-easy-scroll" href="#stocks" data-es-offset="<?=$esOffset?>"><?=GetMessage('TABS_STOCKS')?></a><?
}
$this->EndViewTarget();
?>

<div class="detail__anchor js-detail-anchor hidden-xs hidden-print">
<?php
echo $APPLICATION->GetViewContent('TABS_HTML_HEADERS_ANCHOR');
?>
<?php if ($arParams['USE_REVIEW'] == 'Y' && IsModuleInstalled('forum')): ?>
<a class="detail__anchor__link link-dashed js-easy-scroll" href="#review"><?=GetMessage('TABS_REVIEW')?><?=($arParams['DETAIL_REVIEW_SHOW_COUNT'] == 'Y' ? ' (<span class="js-detailelement-review-count">0</span>)' : '')?></a>
<?php endif; ?>
</div>
