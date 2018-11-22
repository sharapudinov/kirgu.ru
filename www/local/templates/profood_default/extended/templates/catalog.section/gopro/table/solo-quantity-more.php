<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-table__solo-quantity-more">
    <div class="list-table__solo-quantity hidden-xs hidden-sm"><?
    ?><?php
    // quantity
    $params = array(
        'DISABLE' => 'Y',
    );
    if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/quantity.php', $getTemplatePathPartParams))) {
        include($path);
    }
    ?><?
    ?></div>
    <div class="list-table__more"><?
    ?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
        ?><a class="btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('GOPRO.MORE')?></a><?
    ?><?php endif; ?><?
    ?></div>
</div>
