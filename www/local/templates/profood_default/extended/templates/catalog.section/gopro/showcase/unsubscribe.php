<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__unsubscribe">
	<a class="list-showcase__unsubscribe-detail btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('CPSL_TPL_MESS_BTN_DETAIL')?></a>
	<a class="list-showcase__unsubscribe-action js-product__unsubscribe btn-default" data-subscribe-id="<?=CUtil::PhpToJSObject($arParams['LIST_SUBSCRIPTIONS'][$arItem['ID']], false, true)?>"><?=GetMessage('CPSL_TPL_MESS_BTN_UNSUBSCRIBE');?></a>
</div>
