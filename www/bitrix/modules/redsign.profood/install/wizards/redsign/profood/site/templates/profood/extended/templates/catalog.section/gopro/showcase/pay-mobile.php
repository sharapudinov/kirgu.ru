<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<?php if ($haveOffers): ?>
<div class="list-showcase__pay-mobile hidden-md hidden-lg"><?
?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
?><a class="btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('GOPRO.MORE')?></a><?
?><?php endif; ?><?
?></div>
<?php endif; ?>
