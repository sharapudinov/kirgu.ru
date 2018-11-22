<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);
?>

<?php if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0): ?>
	<div <?
		?>class="gopro-banners owl-gopro-banners" <?
		?>data-change-speed="<?=$arParams['RSGOPRO_CHANGE_SPEED']?>" <?
		?>data-change-delay="<?=$arParams['RSGOPRO_CHANGE_DELAY']?>" <?
		?>data-banner-height="<?=$arParams['RSGOPRO_BANNER_HEIGHT']?>" <?
		?>style="max-height: <?=$arParams['RSGOPRO_BANNER_HEIGHT']?>px;" <?
	?>>
		<div id="owlGoProBanners" class="owl-carousel">
			<?php foreach ($arResult['ITEMS'] as $arItem): ?>
				<?php
				$bannerType = $arItem['PROPERTIES'][$arParams['RSGOPRO_BANNER_TYPE']]['VALUE_XML_ID'];
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				?>
				<div class="gopro-banners__banner js-item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
					<div class="gopro-banners__background <?=$bannerType?>" <?
						?>data-banner-type="<?=$bannerType?>" <?
						if (($bannerType == 'text' || $bannerType == 'banner') && !empty($arItem['DETAIL_PICTURE']['SRC'])):
							?>data-img-src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" <?
							?>style="background-image:url('<?=$arItem['DETAIL_PICTURE']['SRC']?>');" <?
						endif;
					?>></div>
					<div class="gopro-banners__wrap">

						<?php if ($bannerType == 'product' && !empty($arItem['DETAIL_PICTURE']['SRC'])): ?>
							<div class="gopro-banners__product"><img class="gopro-banners__product-image" src="<?=$arItem['DETAIL_PICTURE']['SRC']?>" alt="" title=""></div>
						<?php endif; ?>

						<?php if (
							$bannerType == 'video' &&
							$arItem['PROPERTIES'][$arParams['RSGOPRO_BANNER_VIDEO_MP4']]['FILE_PATH_MP4'] != '' &&
							$arItem['PROPERTIES'][$arParams['RSGOPRO_BANNER_VIDEO_WEBM']]['FILE_PATH_WEBM'] != '' &&
							$arItem['PROPERTIES'][$arParams['RSGOPRO_BANNER_VIDEO_PIC']]['FILE_PATH_PIC'] != ''
						): ?>
							<div class="gopro-banners__video">
								<video class="gopro-banners__video-video" id="video<?=$arItem['ID']?>" autoplay="autoplay" muted="muted" poster="<?=$arItem['PROPERTIES'][$arParams['RSGOPRO_BANNER_VIDEO_PIC']]['FILE_PATH_PIC']?>" loop="loop">
									<source src="<?=$arItem['PROPERTIES'][$arParams['RSGOPRO_BANNER_VIDEO_MP4']]['FILE_PATH_MP4']?>" type="video/mp4">
									<source src="<?=$arItem['PROPERTIES'][$arParams['RSGOPRO_BANNER_VIDEO_WEBM']]['FILE_PATH_WEBM']?>" type="video/webm">
								</video>
							</div>
						<?php endif; ?>

						<div class="gopro-banners__infowrap">
							<div class="gopro-banners__info">

								<?php if ($bannerType == 'text'): ?>
									<div class="gopro-banners__text">
										<?php if (isset($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE1']]['VALUE'])): ?>
											<div class="gopro-banners__text1"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE1']]['DISPLAY_VALUE']?></div>
										<?php endif; ?>
										<?php if (isset($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE2']]['VALUE'])): ?>
											<div class="gopro-banners__text2"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE2']]['DISPLAY_VALUE']?></div>
										<?php endif; ?>
										<?php if (isset($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE3']]['VALUE'])): ?>
											<div class="gopro-banners__text3 hidden-xs"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE3']]['DISPLAY_VALUE']?></div>
										<?php endif; ?>
									</div>

								<?php elseif ($bannerType == 'banner'): ?>

								<?php elseif ($bannerType == 'product'): ?>

									<div class="gopro-banners__text">
										<?php if (isset($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE1']]['VALUE'])): ?>
											<div class="gopro-banners__text1 product"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE1']]['DISPLAY_VALUE']?></div>
										<?php endif; ?>
										<?php if (isset($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE3']]['VALUE'])): ?>
											<div class="gopro-banners__text3 product hidden-xs"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE3']]['DISPLAY_VALUE']?></div>
										<?php endif; ?>
										<?php if (isset($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE2']]['VALUE'])): ?>
											<div class="gopro-banners__text2 product"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_LINE2']]['DISPLAY_VALUE']?></div>
										<?php endif; ?>
									</div>

								<?endif; ?>

							</div>
						</div>
					</div>
					<?php if (isset($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_LINK']]['VALUE'])): ?>
						<a href="<?=$arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_LINK']]['VALUE']?>" <?
							?>class="gopro-banners__link" <?
							if (!empty($arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_BLANK']]['VALUE'])) {
								?> target="_blank"<?
							}
							?>></a>
					<?php endif; ?>
				</div>
			<?php endforeach; ?>
		</div>
	</div>
<?php endif; ?>
