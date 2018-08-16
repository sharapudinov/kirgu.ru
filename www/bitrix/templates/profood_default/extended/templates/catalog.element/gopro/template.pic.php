<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
?>

<!-- picture -->
<div class="detail__pic">
    <div class="detail__stickers">
    <?php
    // stickers
    include(EXTENDED_PATH_COMPONENTS.'/stickers.php');
    ?>
    </div>
    <div class="detail__pic__inner">
        <div class="detail__pic__carousel js-picslider">
            <?php
            // js-pictures
            include(EXTENDED_PATH_COMPONENTS.'/js-pictures.php');
            ?>
        </div>
    </div>
    <div class="detail__pic__zoom hidden-xs"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-search"></use></svg><?=GetMessage('ZOOM')?></div>
    <div class="detail__pic__preview js-scroll scrollbar-inner"><div class="detail__pic__dots js-detail-dots"></div></div>
</div>
<!-- /picture -->
