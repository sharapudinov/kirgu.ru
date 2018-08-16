<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__picture"><?
	// js-pictures
	$params = array(
		'PAGE' => 'list',
	);
	include(EXTENDED_PATH_COMPONENTS.'/js-pictures.php');

	?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
		?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
	?><?php else: ?><?
		?><span><?
	?><?php endif; ?><?

	// get _$strAlt_ and _$strTitle_
	include(EXTENDED_PATH.'/img_alt_title.php');
	if (isset($arItem['FIRST_PIC']['RESIZE']['src']) && trim($arItem['FIRST_PIC']['RESIZE']['src']) != '') {
		?><img <?
			?>class="js-list-picture<?=($arParams['USE_LAZYLOAD'] == 'Y' ? ' js-lazy lazy-animation' : '')?>" <?
			?>src="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? $arResult['LAZY_PHOTO']['src'] : $arItem['FIRST_PIC']['RESIZE']['src'])?>" <?
			?>data-src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" <?
			?>alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
	} else {
		?><img class="js-list-picture" src="<?=$arResult['NO_PHOTO']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
	}
	
	?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
		?></a><?
	?><?php else: ?><?
		?></span><?
	?><?php endif; ?><?
?></div>
