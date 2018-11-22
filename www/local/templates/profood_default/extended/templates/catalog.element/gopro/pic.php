<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();
use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;
?>

<!-- picture -->
<div class="detail__pic">
    <div class="detail__stickers">
    <?php
    // stickers
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/action-stickers.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </div>
    <div class="detail__pic__inner">
        <div class="detail__pic__carousel js-picslider">
            <?php
            // js-pictures
            if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/js-pictures.php', $getTemplatePathPartParams))) {
                include($path);
            }
            ?>
        </div>
    </div>
    <div class="detail__pic__zoom hidden-xs hidden-print"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg><?=Loc::getMessage('ZOOM')?></div>
    <div class="detail__pic__preview js-scroll scrollbar-inner hidden-print"><div class="detail__pic__dots js-detail-dots"></div></div>
</div>
<!-- /picture -->
