<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;

?>

<!-- preview text -->
<?php if ($arParams['SHOW_PREVIEW_TEXT']=='Y' && $arResult['PREVIEW_TEXT'] != ''): ?>
<div class="detail__previewtext hidden-xs"><?
    ?><?=$arResult['PREVIEW_TEXT']?><?
    if ($arResult['TABS']['DETAIL_TEXT']) {
        ?><div class="detail__previewtext__go-to hidden-print"><a class="detail__previewtext__go-to__link js-easy-scroll" href="#detailtext" data-es-offset="-135"><?=Loc::getMessage('GO2DETAILFROMPREVIEW')?></a></div><?
    }
?></div>
<?php endif; ?>
<!-- /preview text -->
