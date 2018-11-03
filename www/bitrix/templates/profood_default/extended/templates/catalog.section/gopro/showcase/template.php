<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$colClassElementMobile = ' col-xs-12';
if ($arParams['COL_XS_6'] == 'Y') {
	$colClassElementMobile = ' col-xs-6';
}

$colClassElement = $colClassElementMobile.' col-sm-4 col-md-3 col-lg-3';
if ($arParams['COLUMNS5'] == 'Y') {
	$colClassElement = $colClassElementMobile.' col-sm-4 col-md-3 col-lg-5rs';
}

$getTemplatePathPartParams = array('SHOW_HELP' => $arParams['CACHE_GROUPS'] == 'Y' ? 'Y' : 'N');
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
<div class="js-element js-elementid<?=$arItem['ID']?> <?
	if (isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2'])) { echo 'da2 '; }
	if (isset($arItem['QUICKBUY']) || isset($product['QUICKBUY'])) { echo 'qb '; }
	?>list-element list-showcase__element <?
	if ($arParams['OFF_HOVER_POPUP'] == 'Y') {
		?>list-showcase__hide-hover-popup <?
	}
	?><?=$colClassElement?> <?
	?><?=(count($arResult['PRICES']) < 2 ? 'mod-short' : '')?><?
	?>" <?
	?>data-elementid="<?=$arItem['ID']?>" <?
	?>id="<?=$strMainID?>" <?
	?>data-productid="<?=$product['ID']?>" <?
	?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" <?
	?>>
	<div class="list-showcase__inner js-element__shadow">

		<!-- part main -->
		<div class="list-showcase__part-main">

			<div class="list-showcase__mix">

				<?php
				// pictures
                if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pic.php', $getTemplatePathPartParams))) {
                    include($path);
				}

				if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/timer-stickers.php', $getTemplatePathPartParams))) {
                    include($path);
				}

				if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/compare.php', $getTemplatePathPartParams))) {
                    include($path);
				}

				if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/favorite.php', $getTemplatePathPartParams))) {
                    include($path);
				}
				?>

			</div>

			<?php
			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/name-rating.php', $getTemplatePathPartParams))) {
				include($path);
			}

			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/prices.php', $getTemplatePathPartParams))) {
				include($path);
			}

			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/stores.php', $getTemplatePathPartParams))) {
				include($path);
			}

			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pay.php', $getTemplatePathPartParams))) {
				include($path);
			}
			?>

			<?php
			if ($this->__component->getName() == 'bitrix:catalog.product.subscribe.list') {
				if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/unsubscribe.php', $getTemplatePathPartParams))) {
					include($path);
				}
			}

			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pay-mobile.php', $getTemplatePathPartParams))) {
				include($path);
			}
			?>

		</div>
		<!-- /part main -->

		<!-- part extended -->
		<div class="list-showcase__part-extended">

			<?php
			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/attributes.php', $getTemplatePathPartParams))) {
				include($path);
			}

			if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/preview-text.php', $getTemplatePathPartParams))) {
				include($path);
			}
			?>

		</div>
		<!-- /part extended -->

	</div>
</div><!-- /element -->
<?php endforeach; ?>
