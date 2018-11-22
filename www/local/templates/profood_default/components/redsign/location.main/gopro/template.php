<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) {
    die();
}

use \Bitrix\Main\Localization\Loc;

$jsParams = [
    'ajaxUrl' => $componentPath.'/ajax.php',
    'siteId' => SITE_ID,
    'confirmPopupId' =>  'location_confirm'
];

$arParams['POPUP_URL'] = (isset($arParams['POPUP_URL']) ? $arParams['POPUP_URL'] : SITE_DIR.'include/popup/mycity/');
?>

<div class="b-location" id="topline-location">
    <span><?=GetMessage('RS_LOCATION_YOUR_CITY_1')?></span><?
    ?><?php
    $frame = $this->createFrame('topline-location')->begin();
    $frame->setBrowserStorage(true);
    ?><?

    ?><a class="b-topline-location__link fancyajax fancybox.ajax big" href="<?=$arParams['POPUP_URL']?>" title="<?=GetMessage('RS_LOCATION_SELECT')?>"><?
        ?><?=(!empty($arResult['NAME']) ? $arResult['NAME'] : Loc::getMessage('RS_LOCATION_NOT_SELECT')); ?><?
        ?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg><?
    ?></a>

    <?php if (!empty($arResult['NAME'])): ?>
    <div class="b-location-confirm" id="location_confirm" style="display: none">
        <div class="b-location-confirm__triangle"></div>
        <div class="b-location-confirm__your"><?=Loc::getMessage('RS_LOCATION_YOUR_CITY', ['#CITY_NAME#' => $arResult['NAME']]); ?></div>
        <div class="b-location-confirm__controls">
            <a class="btn btn-primary" onclick="RS.Location.hideConfirm(); return false;" href=""><?=Loc::getMessage('RS_LOCATION_CITY_RIGHT');?></a>
            <a class="btn btn-default fancyajax fancybox.ajax big" href="<?=$arParams['POPUP_URL']?>" title="<?=Loc::getMessage('RS_LOCATION_SELECT');?>"><?=Loc::getMessage('RS_LOCATION_CITY_SEARCH');?></a>
        </div>
    </div>
    <?php endif; ?>

    <script>
    RS.Location = new RSLocation(<?=CUtil::PhpToJSObject($arResult)?>, <?=CUtil::PhpToJSObject($jsParams)?>);
    </script>

    <?php $frame->beginStub(); ?>
        <a class="b-topline-location__link fancyajax fancybox.ajax big" href="<?=$arParams['POPUP_URL']?>" title="<?=Loc::getMessage('RS_LOCATION_SELECT');?>"><?= Loc::getMessage('RS_LOCATION_NOT_SELECT'); ?></a>
    <?php $frame->end(); ?>
</div>
