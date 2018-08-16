<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$tableParams = array(
	'GRID' => array(
		'PRODUCT_NAME'		=> 'col-xs-12 col-sm-12 col-md-3 col-lg-3',
		'ATTRIBUTES'		=> 'col-xs-12 col-sm-12 col-md-5 col-lg-6',
		'PRICES'			=> 'col-xs-12 col-sm-12 col-md-5 col-lg-6',
		'PAY_STORES_MORE'	=> 'col-xs-12 col-sm-12 col-md-4 col-lg-3',
	),
);

$pricesParams = array(
	'VIEW' => 'line',
	'MAX_SHOW' => 3,
);
?>

<?php if ($arParams['IS_AJAXPAGES'] != 'Y'): ?>
<!-- thead -->
<div class="row no-gutter list-thead list-table__thead hidden-xs hidden-sm">
	<span class="<?=$tableParams['GRID']['PRODUCT_NAME']?>">
		<span class="list-thead__tr">
			<span class="list-thead__td name"><?=Loc::getMessage('GOPRO_TH_PRODUCT')?></span>
		</span>
	</span>
	<span class="<?=$tableParams['GRID']['PRICES']?>">
		<span class="list-thead__tr">
		<?php
		$i = 1;
		foreach ($arResult['PRICES'] as $priceCode => $arPriceInfo):
			if ($i > $pricesParams['MAX_SHOW'])
				break;
			?>
			<span class="list-thead__td"><?=$arPriceInfo['TITLE']?></span>
		<?php
		$i++;
		endforeach;
		?>
		</span>
	</span>
	<span class="<?=$tableParams['GRID']['PAY_STORES_MORE']?>">
		<span class="list-thead__tr">
			<span class="list-thead__td quantity"><?=Loc::getMessage('CT_BCE_QUANTITY')?></span>
			<span class="list-thead__td pay"></span>
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
	?> list-element list-table__element <?=$colClassElement?>" <?
	?>data-elementid="<?=$arItem['ID']?>" <?
	?>id="<?=$strMainID?>" <?
	?>data-productid="<?=$product['ID']?>" <?
	?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" <?
	?>>
	<div class="list-table__inner js-element__shadow">

		<div class="row no-gutter">

			<div class="<?=$tableParams['GRID']['PRODUCT_NAME']?>">
				<div class="list-table__name-article">
					<div class="list-table__name"><?
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
					<div class="list-table__article hidden-xs hidden-sm">
					<?php
					// article
					include(EXTENDED_PATH_COMPONENTS.'/article.php');
					?>
					</div>
				</div>
			</div>

			<div class="list-table__prices <?=$tableParams['GRID']['PRICES']?>">
			<?php
			// prices
			$params = $pricesParams;
			include(EXTENDED_PATH_COMPONENTS.'/prices.php');
			?>
			</div>

			<div class="<?=$tableParams['GRID']['PAY_STORES_MORE']?>">
			<?php if (!$haveOffers): ?>
				<div class="list-table__pay-stores">
					<div class="list-table__pay-stores__inner">
						<div class="list-table__pay">
						<?php
						// pay
						include(EXTENDED_PATH_BLOCKS.'/pay.php');
						?><?
						?></div><?
						
						if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y'):
							?><div class="list-table__stores"><?
							//stores
							include(EXTENDED_PATH_BLOCKS.'/stores.php');
							?>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php else: ?>
				<div class="list-table__solo-quantity-more">
					<div class="list-table__solo-quantity hidden-xs hidden-sm"><?
					?><?php
					// quantity
					$params = array(
						'DISABLE' => 'Y',
					);
					include(EXTENDED_PATH_COMPONENTS.'/quantity.php');
					?><?
					?></div>
					<div class="list-table__more"><?
					?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
						?><a class="btn-primary" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=Loc::getMessage('GOPRO.MORE')?></a><?
					?><?php endif; ?><?
					?></div>
				</div>
			<?php endif; ?>
			</div>

		</div>

	</div>
</div><!-- /element -->
<?php endforeach; ?>
