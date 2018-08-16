<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

?>

<!-- pay && stores -->
<div class="detail__pay-stores">
    <div class="detail__pay">
    <?php
    // pay
    $params = array(
        'SHOW_BUY1CLICK' => ($arParams['OFF_BUY1CLICK'] == 'Y' ? 'N' : 'Y'),
    );
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/pay.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </div>
    <?php if ($arParams['USE_STORE'] == 'Y'): ?>
    <div class="detail__stores">
    <?php
    // stores
    $params = array(
        'PAGE' => 'detail',
    );
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/stores.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?>
    </div>
    <?php endif; ?>
</div>
<!-- /pay && stores -->
