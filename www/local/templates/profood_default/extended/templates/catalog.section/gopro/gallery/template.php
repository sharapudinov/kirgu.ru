<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

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

$getTemplatePathPartParams = array('SHOW_HELP' => $arParams['CACHE_GROUPS'] == 'Y' ? 'Y' : 'N');
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
	
	if($arItem['CATALOG_SUBSCRIBE'] == 'Y' && $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' )
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
			<?php
			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pic.php', $getTemplatePathPartParams))) {
				include($path);
			}
			?>
			</div>

			<div class="list-gallery__right-side <?=$tableParams['GRID']['RIGHT_SIDE']?>">
				<div class="row">

					<div class="list-gallery__over-mix <?=$tableParams['GRID']['MIX']?>">
					<?php
					if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/mix.php', $getTemplatePathPartParams))) {
						include($path);
					}
					?>
					</div>

					<div class="<?=$tableParams['GRID']['PRICES']?>">
					<?php
					if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/prices.php', $getTemplatePathPartParams))) {
						include($path);
					}
					?>
					</div>

					<div class="<?=$tableParams['GRID']['PAY_STORES_MORE']?>">
					<?php
					if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pay-stores.php', $getTemplatePathPartParams))) {
						include($path);
					}
					?>
					</div>

				</div>
			</div>

		</div>

	</div>
</div>
<!-- /element -->
<?php endforeach; ?>
