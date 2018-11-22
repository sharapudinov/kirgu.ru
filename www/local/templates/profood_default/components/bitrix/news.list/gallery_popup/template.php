<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;

$this->setFrameMode(true);

$i = 1;
?>

<?php if (!empty($arResult['ITEMS'])): ?>
	<div class="gallery-popup<?=($arParams['USE_LAZYLOAD'] == 'Y' ? ' js-lazy-section is-loading' : '')?>">

		<?php if ($arParams['RSGOPRO_SHOW_TITLE'] == 'Y'): ?>
			<div class="nice-title"><?=$arResult['NAME']?></div>
		<?php endif; ?>
		
		<div class="row<?=($arParams['USE_LAZYLOAD'] == 'Y' ? ' lazy-animation' : '')?>">
			<?php foreach($arResult['ITEMS'] as $arItem): ?>
				<?php
				$previewPic = $arItem['PREVIEW_PICTURE']['SRC'];
				$arImages = $arItem['DISPLAY_PROPERTIES'][$arParams['RSGOPRO_PROP_IMAGES']]['FILE_VALUE'];
				if (isset($arImages[0]) && is_array($arImages[0]) && count($arImages[0]) > 1) {
					$firstImage = $arImages[0]['SRC'];
				} else {
					$firstImage = $arImages['SRC'];
				}
				$jsFancyboxClass = 'js-gallery-popup__'.$arItem['CODE'];

				if (empty($previewPic) || empty($arImages))
					continue;

				// get _$strAlt_ and _$strTitle_
				include(EXTENDED_PATH.'/img_alt_title.php');
				?>
				<div class="col-xs-6 col-sm-3 col-md-3 col-lg-3 gallery-popup__col_item">
					<div class="gallery-popup__item">
						<a data-fancybox="<?=$jsFancyboxClass?>" class="gallery-popup__link js-gallery-item" href="<?=$firstImage?>" data-caption="<?=$arItem['NAME']?>">
							<img <?
								?>class="gallery-popup__pic<?=($arParams['USE_LAZYLOAD'] == 'Y' ? ' js-lazy' : '')?>" <?
								?>src="<?=($arParams['USE_LAZYLOAD'] == 'Y' ? $arResult['LAZY_PHOTO']['src'] : $previewPic)?>" <?
								?>data-src="<?=$previewPic?>" <?
								?>alt="<?=$strAlt?>" title="">
							<div class="gallery-popup__info">
								<div class="gallery-popup__title"><?=$arItem['NAME']?></div>
							</div>
						</a>
						<div class="hidden js-images">
							<?php
							if (isset($arImages[0]) && is_array($arImages[0]) && count($arImages[0]) > 1):
								unset($arImages[0]);
								foreach ($arImages as $arFile):
								?>
									<a data-fancybox="<?=$jsFancyboxClass?>" href="<?=$arFile['SRC']?>" title="<?=$arItem['NAME']?>" data-open-mobile="true"></a>
								<?php
								endforeach;
							else:
								?><a class="alone" data-fancybox="<?=$jsFancyboxClass?>" href="<?=$arImages['SRC']?>" title="<?=$arItem['NAME']?>" data-open-mobile="true"></a><?
							endif;
							?>
						</div>
					</div>
				</div>
				<?php $i++; ?>
			<?php endforeach;?>
		</div>
	</div>
<?php endif; ?>
