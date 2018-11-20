<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
?>

<!-- article & rating & brand -->
<div class="detail__article-rating-brand">
    <span class="detail__article">
    <?php
    // article
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/article.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </span>
    <span class="detail__rating">
    <?php
    // rating
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/rating.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </span>
    <span class="detail__brand hidden-xs">
    <?php
    // brand
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/brand.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </span>
</div>
<!-- /article & rating & brand -->
