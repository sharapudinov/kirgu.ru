<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<?php if (isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_TEXT'] != ''): ?>
<div class="list-showcase__preview-text">
	<div class="list-showcase__preview-text__text"><?=$arItem['PREVIEW_TEXT']?></div>
	<div class="list-showcase__preview-text__more"><a href="<?=$arItem['DETAIL_PAGE_URL']?>" title=""><?=Loc::getMessage('GOPRO.MORE')?></a></div>
</div>
<?php endif; ?>
