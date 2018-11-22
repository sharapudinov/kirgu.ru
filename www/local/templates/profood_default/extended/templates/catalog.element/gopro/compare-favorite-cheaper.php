<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;

?>

<!-- compare && favorite && cheaper -->
<div class="detail__compare-favorite-cheaper hidden-print">

    <?php if ($arParams['USE_COMPARE'] == 'Y'): ?>
    <span class="detail__compare">
        <a rel="nofollow" class="c-compare js-add2compare" href="<?=$arItem['COMPARE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-compare-small"></use></svg><span class="c-compare__title"><?=Loc::getMessage('ADD2COMPARE')?></span><span class="c-compare__title-in"><?=Loc::getMessage('ADD2COMPARE_IN')?></span></a>
    </span>
    <?php endif; ?>

    <?php if ($arParams['USE_FAVORITE'] == 'Y'): ?>
    <span class="detail__favorite">
        <a rel="nofollow" class="c-favorite js-add2favorite" href="<?=$arItem['DETAIL_PAGE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite-small"></use></svg><span class="c-favorite__title"><?=Loc::getMessage('FAVORITE')?></span><span class="c-favorite__title-in"><?=Loc::getMessage('FAVORITE_IN')?></span></a>
    </span>
    <?php endif; ?>

    <?php if ($arParams['USE_CHEAPER'] == 'Y'): ?>
    <span class="detail__cheaper">
        <a rel="nofollow" class="c-cheaper js-cheaper fancyajax fancybox.ajax" href="<?=SITE_DIR?>include/popup/cheaper/" title="<?=Loc::getMessage('CHEAPER')?>"><?
            ?><span class="c-cheaper__icon"><span class="c-cheaper__icon-in">%</span></span><?
            ?><span class="c-cheaper__title"><?=GetMessage('CHEAPER')?></span><?
        ?></a>
    </span>
    <?php endif; ?>

</div>
<!-- /compare && favorite && cheaper -->
