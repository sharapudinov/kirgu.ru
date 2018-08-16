<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$tableParams = array(
	'GRID' => array(
		'PICTURE' => 'col-xs-3 col-sm-2 col-md-2 col-lg-2',
		'RIGHT_SIDE' => 'col-xs-9 col-sm-10 col-md-10 col-lg-10',
		'MIX' => 'col-xs-12 col-sm-4 col-md-5 col-lg-5',
		'PRICES' => 'col-xs-12 col-sm-4 col-md-4 col-lg-4',
		'PAY_STORES_MORE' => 'col-xs-12 col-sm-4 col-md-3 col-lg-3',
	),
);
?>

<?php if ($arParams['IS_AJAXPAGES'] != 'Y'): ?>
<!-- thead -->
<div class="row no-gutter list-thead list-gallery__thead hidden-xs">
	<span class="<?=$tableParams['GRID']['PICTURE']?>">
		<span class="list-thead__tr">
			<span class="list-thead__td"><?=Loc::getMessage('GOPRO_TH_PICTURE')?></span>
		</span>
	</span>
	<span class="<?=$tableParams['GRID']['RIGHT_SIDE']?>">

		<span class="row">
			<span class="<?=$tableParams['GRID']['MIX']?>">
				<span class="list-thead__tr">
					<span class="list-thead__td list-gallery__thead__product"><?=Loc::getMessage('GOPRO_TH_PRODUCT')?></span>
				</span>
			</span>
			<span class="<?=$tableParams['GRID']['PRICES']?>">
				<span class="list-thead__tr">
					<span class="list-thead__td"><?=Loc::getMessage('GOPRO_TH_PRICE')?></span>
				</span>
			</span>
			<span class="<?=$tableParams['GRID']['PAY_STORES']?>"></span>
		</span>

	</span>
</div>
<!-- /thead -->
<?php endif; ?>

<?php
foreach ($arResult['ITEMS'] as $key1 => $arItem):
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
	$strMainID = $this->GetEditAreaId($arItem['ID']);

	$arItem['OFFERS_SELECTED'] = (intval($arItem['OFFERS_SELECTED']) > 0 ? $arItem['OFFERS_SELECTED'] : 0);
	$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) ? true : false;
	if ($haveOffers)
		$product = &$arItem['OFFERS'][$arItem['OFFERS_SELECTED']];
	else
		$product = &$arItem;
	
	if($arItem['CATALOG_SUBSCRIBE'] == 'Y')
		$showSubscribeBtn = true;
	else
		$showSubscribeBtn = false;
	
	$canBuy = $product['CAN_BUY'];
?>
<!-- element -->
<div class="js-element js-elementid<?=$arItem['ID']?><?
	if (isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2'])) { echo ' da2'; }
	if (isset($arItem['QUICKBUY']) || isset($product['QUICKBUY'])) { echo ' qb'; }
	?> list-element list-gallery__element <?=$colClassElement?>" <?
	?>data-elementid="<?=$arItem['ID']?>" <?
	?>id="<?=$strMainID?>" <?
	?>data-productid="<?=$product['ID']?>" <?
	?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" <?
	?>>
	<div class="list-gallery__inner js-element__shadow">

		<div class="row no-gutter">

			<div class="list-gallery__left-side <?=$tableParams['GRID']['PICTURE']?>">
				<div class="list-gallery__picture"><?
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
					?><img class="js-list-picture" src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
				} else {
					?><img class="js-list-picture" src="<?=$arResult['NO_PHOTO']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
				}
				?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
					?></a><?
				?><?php else: ?><?
					?></span><?
				?><?php endif; ?><?
				?></div>
			</div>

			<div class="list-gallery__right-side <?=$tableParams['GRID']['RIGHT_SIDE']?>">
				<div class="row">

					<!-- mix -->
					<div class="list-gallery__over-mix <?=$tableParams['GRID']['MIX']?>">
						<div class="list-gallery__mix">

							<div class="list-gallery__stickers hidden-xs">
							<?php
							// stickers
							include(EXTENDED_PATH_COMPONENTS.'/stickers.php');
							?>
							</div>

							<div class="list-gallery__name-rating-article">
								<div class="list-gallery__name-rating">
									<span class="list-gallery__name"><?
									?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
										?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
									?><?php else: ?><?
										?><span><?
									?><?php endif; ?><?
									?><?=$arItem['NAME']?><?
									?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
										?></a><?
									?><?php else: ?><?
										?></span><?
									?><?php endif; ?><?
									?></span>
									<span class="list-gallery__rating hidden-xs">
									<?php
									// rating
									include(EXTENDED_PATH_COMPONENTS.'/rating.php');
									?>
									</span>
								</div>
								<div class="list-gallery__article hidden-xs hidden-sm">
								<?php
								// article
								include(EXTENDED_PATH_COMPONENTS.'/article.php');
								?>
								</div>
							</div>

							<div class="list-gallery__compare-favorite hidden-xs">
								<?php if ($arParams['DISPLAY_COMPARE'] == 'Y'): ?>
								<span class="list-gallery__compare">
									<a rel="nofollow" class="c-compare js-add2compare" href="<?=$arItem['COMPARE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-compare-small"></use></svg><span class="c-compare__title"><?=Loc::getMessage('ADD2COMPARE')?></span><span class="c-compare__title-in"><?=Loc::getMessage('ADD2COMPARE_IN')?></span></a>
								</span>
								<?php endif; ?>
				
								<?php if ($arParams['USE_FAVORITE'] == 'Y'): ?>
								<span class="list-gallery__favorite">
									<a rel="nofollow" class="c-favorite js-add2favorite" href="<?=$arItem['DETAIL_PAGE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite-small"></use></svg><span class="c-favorite__title"><?=Loc::getMessage('FAVORITE')?></span><span class="c-favorite__title-in"><?=Loc::getMessage('FAVORITE_IN')?></span></a>
								</span>
								<?php endif; ?>
							</div>

						</div>
					</div>

					<div class="<?=$tableParams['GRID']['PRICES']?>">
						<div class="list-gallery__prices">
						<?php
						// prices
						$params = array(
							'VIEW' => 'list',
							'SHOW_MORE' => 'Y',
							'MAX_SHOW' => 3,
						);
						include(EXTENDED_PATH_COMPONENTS.'/prices.php');
						?>
						</div>
					</div>

					<div class="<?=$tableParams['GRID']['PAY_STORES_MORE']?>">
					<?php if (!$haveOffers): ?>
						<div class="list-gallery__pay-stores">
							<div class="list-gallery__pay">
							<?php
							$arParams['USE_PRODUCT_QUANTITY'] = 'N';
							// pay
							include(EXTENDED_PATH_BLOCKS.'/pay.php');
							?><?
							?></div><?

							if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y'):
								?><div class="list-gallery__stores"><?
								// stores
								include(EXTENDED_PATH_BLOCKS.'/stores.php');
								?>
								</div>
							<?php endif; ?>
						</div>
					<?php else: ?>
						<div class="list-gallery__more"><?
						?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
							?><a class="btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('GOPRO.MORE')?></a><?
						?><?php endif; ?><?
						?></div>
					<?php endif; ?>
					</div>
					<!-- /mix -->

				</div>
			</div>

		</div>

	</div>
</div><!-- /element -->
<?php endforeach; ?>
