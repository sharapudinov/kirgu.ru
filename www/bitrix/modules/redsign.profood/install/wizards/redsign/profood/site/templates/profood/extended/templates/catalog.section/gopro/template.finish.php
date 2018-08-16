<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

switch ($arParams['VIEW']) {
	case 'table':
		$view = 'table';
		break;
	case 'gallery':
		$view = 'gallery';
		break;
	default:
		$view = 'showcase';
}

if ($arParams['IS_AJAXPAGES'] == 'Y') {
	$this->EndViewTarget();
	$templateData['view-'.$view] = $APPLICATION->GetViewContent('view-'.$view);

	$this->SetViewTarget("catalogajaxpages");
} else {
	?></div></div><!-- <?=$view?> --><?
}

if (IntVal($arResult['NAV_RESULT']->NavPageNomer) < IntVal($arResult['NAV_RESULT']->NavPageCount) && $arParams['HIDE_AJAXPAGES_LINK'] != 'Y') {
	?><div class="c-ajaxpages js-ajaxpages<?if($arParams['USE_AUTO_AJAXPAGES'] == 'Y'):?> auto<?endif;?>">
		<a class="c-ajaxpages__link js-ajaxpages__link link-dashed-in" rel="nofollow" href="#" <?
			?>data-ajaxurl="<?=str_replace("+", "%2B", $arResult['AJAXPAGE_URL'])?>" <?
			?>data-ajaxpagesid="<?=$arParams['AJAXPAGESID']?>" <?
			?>data-navpagenomer="<?=($arResult['NAV_RESULT']->NavPageNomer)?>" <?
			?>data-navpagecount="<?=($arResult['NAV_RESULT']->NavPageCount)?>" <?
			?>data-navnum="<?=($arResult['NAV_RESULT']->NavNum)?>"<?
		?>><i class="c-ajaxpages__animashka animashka"></i><span class="c-ajaxpages__text link-dashed-in"><?=Loc::getMessage('AJAXPAGES_LOAD_MORE')?></span></a>
	</div><?
}

if ($arParams['IS_AJAXPAGES'] == 'Y') {
	$this->EndViewTarget();
	$templateData['catalogajaxpages'] = $APPLICATION->GetViewContent('catalogajaxpages');
}

if ($arParams['IS_SORTERCHANGE'] == 'Y') {
	$this->EndViewTarget();
	$templateData[$arParams['AJAXPAGESID']] = $APPLICATION->GetViewContent('sorterchange');
}
