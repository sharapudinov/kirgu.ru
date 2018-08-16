<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;

?>

<!-- social -->
<?php if ($arParams['USE_SHARE'] == 'Y' && !empty($arParams["SOC_SHARE_ICON"]) && $arParams['GOPRO']['OFF_YANDEX'] != 'Y'): ?>
<div class="detail__social">
    <div class="share">
        <div class="ya-share2"
            data-services="<?=implode(',', $arParams['SOC_SHARE_ICON'])?>"
            data-lang="<?=LANGUAGE_ID?>"
            data-size="s"
            data-copy="first" <?
            if (!empty($templateData['imageOg'])) {
                ?>data-image="<?=CHTTP::URN2URI($templateData['imageOg'])?>" <?
            } elseif (!empty($templateData['imageOgOffer'])) {
                ?>data-image="<?=CHTTP::URN2URI($templateData['imageOgOffer'])?>" <?
            }
            
        ?> ></div>
    </div>
</div>
<?php endif; ?>
<!-- /social -->
