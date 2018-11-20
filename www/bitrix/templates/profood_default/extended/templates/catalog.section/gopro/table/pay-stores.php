<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-table__pay-stores">
    <div class="list-table__pay-stores__inner">
        <div class="list-table__pay hidden-print">
        <?php
        // pay
        if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/pay.php', $getTemplatePathPartParams))) {
            include($path);
        }
        ?><?
        ?></div><?
        
        if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y'):
            ?><div class="list-table__stores"><?
            //stores
            if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/stores.php', $getTemplatePathPartParams))) {
                include($path);
            }
            ?>
            </div>
        <?php endif; ?>
    </div>
</div>
