<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);

if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0) {
	?><div <?
		?>class="brandslistimgowl1<?if($arParams['ADD_STYLES_FOR_MAIN']=='Y'):?> mainstyles<?endif;?>" <?
		?>data-change-speed="<?=$arParams['RSGOPRO_CHANGE_SPEED']?>" <?
		?>data-change-delay="<?=$arParams['RSGOPRO_CHANGE_DELAY']?>" <?
	?>><?

		if($arParams['ADD_STYLES_FOR_MAIN']=='Y') {
			?><div class="title"><h3><a href="<?=$arParams['BRAND_PAGE']?>"><?=GetMessage('BRAND_TITLE')?></a></h3></div><?
		}

		?><div id="owl_brandslist1" class="owl-carousel"><?
			foreach ($arResult['ITEMS'] as $arItem) {
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				if($arParams['DISPLAY_PICTURE']!='N' && is_array($arItem['PREVIEW_PICTURE'])) {
					?><div class="item" id="<?=$this->GetEditAreaId($arItem['ID']);?>"><?
						?><div class="in"><?
							?><div class="pic"><?
								?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
									?><img <?
										?>class="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? ' owl-lazy lazy-animation' : '')?>" <?
										?>src="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? $arResult['LAZY_PHOTO']['src'] : $arItem['PREVIEW_PICTURE']['SRC'])?>" <?
										?>data-src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" <?
										?>alt="<?=$arItem['PREVIEW_PICTURE']['ALT']?>" <?
										?>title="<?=$arItem['PREVIEW_PICTURE']['TITLE']?>" <?
									?>/><?
								?></a><?
							?></div><?
						?></div><?
					?></div><?
				}
			}
		?></div><?
	?></div><?
}
