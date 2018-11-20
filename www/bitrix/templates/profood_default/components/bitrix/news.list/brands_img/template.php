<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

if (count($arResult['ITEMS']) > 0) {
	if($arParams['DISPLAY_TOP_PAGER']) {
		?><?=$arResult['NAV_STRING']?><?
	}
	
	?><div class="brandslistimg clearfix<?if($arParams['ADD_STYLES_FOR_MAIN']=='Y'):?> mainstyles<?endif;?>"><?

		if ($arParams['ADD_STYLES_FOR_MAIN'] == 'Y') {
			?><div class="title"><h3><a href="<?=$arParams['BRAND_PAGE']?>"><?=GetMessage('BRAND_TITLE')?></a></h3></div><?
		}
		
		foreach ($arResult['ITEMS'] as $key => $arItem) {
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			if($arParams['DISPLAY_PICTURE']!='N' && is_array($arItem['PREVIEW_PICTURE'])) {
				?><div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
					?><div class="pic"><?
						if (!$arParams['HIDE_LINK_WHEN_NO_DETAIL'] || ($arItem['DETAIL_TEXT'] && $arResult['USER_HAVE_ACCESS'])) {
							?><a class="brandslistimg__block" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
								?><img <?
									?>class="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? ' js-lazy lazy-animation' : '')?>" <?
									?>src="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? $arResult['LAZY_PHOTO']['src'] : $arItem['PREVIEW_PICTURE']['SRC'])?>" <?
									?>data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" <?
									?>alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" <?
									?>title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" <?
								?>/><?
							?></a><?
						} else {
							?><span class="brandslistimg__block"><?
								?><img <?
									?>class="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? ' js-lazy lazy-animation' : '')?>" <?
									?>src="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? $arResult['LAZY_PHOTO']['src'] : $arItem['PREVIEW_PICTURE']['SRC'])?>" <?
									?>data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" <?
									?>alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" <?
									?>title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" <?
								?>/><?
							?></span><?
						}
					?></div><?
				?></div><?
			}
		}
		
	?></div><?
	
	if ($arParams['DISPLAY_BOTTOM_PAGER']) {
		?><?=$arResult['NAV_STRING']?><?
	}
}
