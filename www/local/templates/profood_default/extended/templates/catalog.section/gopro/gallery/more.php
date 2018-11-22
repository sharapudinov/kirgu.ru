<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-gallery__more hidden-print"><?
?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
	?><a class="btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('GOPRO.MORE')?></a><?
?><?php endif; ?><?
?></div>
