<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$arParams['COL_XS_6'] = 'Y';
$colClassElementMobile = ' col-xs-12';
if ($arParams['COL_XS_6'] == 'Y') {
	$colClassElementMobile = ' col-xs-6';
}

$colClassElement = $colClassElementMobile.' col-sm-4 col-md-3 col-lg-3';
if ($arParams['COLUMNS5'] == 'Y') {
	$colClassElement = $colClassElementMobile.' col-sm-4 col-md-3 col-lg-5rs';
}
?>

<?php
foreach ($arResult['ITEMS'] as $key1 => $arItem):
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], \CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], \CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => Loc::getMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
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
	?> list-element list-showcase__element <?=$colClassElement?>" <?
	?>data-elementid="<?=$arItem['ID']?>" <?
	?>id="<?=$strMainID?>" <?
	?>data-productid="<?=$product['ID']?>" <?
	?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" <?
	?>>
	<div class="list-showcase__inner js-element__shadow">

		<!-- part main -->
		<div class="list-showcase__part-main">

			<div class="list-showcase__mix">

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

				<div class="list-showcase__timer-stickers">
					<div class="list-showcase__timer">
					<?php
					// timer
					include(EXTENDED_PATH_COMPONENTS.'/timer.php');
					?>
					</div>
					<div class="list-showcase__stickers">
					<?php
					// stickers
					include(EXTENDED_PATH_COMPONENTS.'/stickers.php');
					?>
					</div>
				</div>

				<?php if ($arParams['DISPLAY_COMPARE'] == 'Y'): ?>
				<div class="list-showcase__compare">
					<a rel="nofollow" class="c-compare js-add2compare" href="<?=$arItem['COMPARE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-compare-small"></use></svg></a>
				</div>
				<?php endif; ?>

				<?php if ($arParams['USE_FAVORITE'] == 'Y'): ?>
				<div class="list-showcase__favorite">
					<a rel="nofollow" class="c-favorite js-add2favorite" href="<?=$arItem['DETAIL_PAGE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite-small"></use></svg></a>
				</div>
				<?php endif; ?>
			
			</div>

			<div class="list-showcase__name-rating">
				<div class="list-showcase__name"><?
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
				?></div>
				<div class="list-showcase__rating">
				<?php
				// rating
				include(EXTENDED_PATH_COMPONENTS.'/rating.php');
				?>
				</div>
			</div>

			<div class="list-showcase__prices">
			<?php
			// prices
			$params = array(
				'VIEW' => 'list',
				'SHOW_MORE' => 'Y',
				'USE_ALONE' => 'Y',
			);
			include(EXTENDED_PATH_COMPONENTS.'/prices.php');
			?>
			</div>

			<?php if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y'): ?>
			<div class="list-showcase__stores">
			<?php
			// stores
			include(EXTENDED_PATH_BLOCKS.'/stores.php');
			?>
			</div>
			<?php endif; ?>

			<div class="list-showcase__pay<?=($haveOffers ? ' hidden-xs hidden-sm' : '')?>">
			<?php
			$arParams['USE_PRODUCT_QUANTITY'] = 'N';
			// pay
			include(EXTENDED_PATH_BLOCKS.'/pay.php');
			?>
			</div>

			<?php if ($this->__component->getName() == 'bitrix:catalog.product.subscribe.list'): ?>
				<div class="list-showcase__unsubscribe">
					<a class="list-showcase__unsubscribe-detail btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('CPSL_TPL_MESS_BTN_DETAIL')?></a>
					<a class="list-showcase__unsubscribe-action js-product__unsubscribe btn-default" data-subscribe-id="<?=CUtil::PhpToJSObject($arParams['LIST_SUBSCRIPTIONS'][$arItem['ID']], false, true)?>"><?=GetMessage('CPSL_TPL_MESS_BTN_UNSUBSCRIBE');?></a>
				</div>
			<?php endif; ?>

			<?php if ($haveOffers): ?>
			<div class="list-showcase__pay-mobile hidden-md hidden-lg"><?
			?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
				?><a class="btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('GOPRO.MORE')?></a><?
			?><?php endif; ?><?
			?></div>
			<?php endif; ?>

		</div>
		<!-- /part main -->

		<!-- part extended -->
		<div class="list-showcase__part-extended">

			<div class="list-showcase__attributes">
			<?php
			// attributes
			$params = array(
				'VIEW' => $arParams['LIST_SKU_VIEW'],
			);
			include(EXTENDED_PATH_COMPONENTS.'/attributes.php');
			?>
			</div>

			<?php if (isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_TEXT'] != ''): ?>
			<div class="list-showcase__preview-text">
				<div class="list-showcase__preview-text__text"><?=$arItem['PREVIEW_TEXT']?></div>
				<div class="list-showcase__preview-text__more"><a href="<?=$arItem['DETAIL_PAGE_URL']?>" title=""><?=Loc::getMessage('GOPRO.MORE')?></a></div>
			</div>
			<?php endif; ?>
			
		</div>
		<!-- /part extended -->

	</div>
</div><!-- /element -->
<?php endforeach; ?>
