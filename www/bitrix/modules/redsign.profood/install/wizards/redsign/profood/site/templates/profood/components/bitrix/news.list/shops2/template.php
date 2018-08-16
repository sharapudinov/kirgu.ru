<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$templateData['GOPRO'] = $arParams['GOPRO'];

if (empty($arParams['RSGOPRO_PROP_TYPES']) || empty($arParams['RSGOPRO_PROP_COORD']))
    return;
?>

<?php if (is_array($arResult["ITEMS"]) && count($arResult["ITEMS"]) > 0): ?>
    <div class="shops2">

		<?php if ($arParams['RSGOPRO_SHOW_TITLE'] == 'Y'): ?>
			<div class="nice-title"><?=$arResult['NAME']?></div>
		<?php endif; ?>
		
        <div class="shops2-panel">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 col-lg-3 js-search_city">
                    <div class="form-group">
                        <input type="text" class="form-control" placeholder="<?=Loc::getMessage('SHOP_SEARCH_PLACEHOLDER');?>">
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 js-shops">
                    <div class="shops2-panel__filters js-filter">
                        <?php foreach ($arResult['FILTER_TYPES'] as $arFilterType): ?>
                            <div class="btn btn1 js-btn" data-filter="<?=htmlspecialcharsbx($arFilterType['XML_ID'])?>"><?=$arFilterType['VALUE']?></div>
                        <?php endforeach; ?>
                        <div class="btn btn1 active js-btn"  data-filter=""><?=Loc::getMessage('SHOP_FILTER_ALL');?></div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xs-12 col-sm-12  col-md-3 col-lg-3">
                <div class="shops2__list js-shops_list">
                    <?php foreach ($arResult["ITEMS"] as $arItem): ?>
                        <div
                            class="shops2-item js-item" <?
                            ?>data-coords="<?=$arItem['COORDINATES']?>" <?
                            ?>data-id="<?=$arItem['ID']?>" <?
                            ?>data-type="<?=$arItem['TYPE']?>" <?
                        ?>>
                        <div class="shops2-item__name js-item__name"><?=$arItem['NAME']?></div>
                            <div class="shops2-item__descr js-item__descr"><?=$arItem['PREVIEW_TEXT']?></div>
                        </div>
                    <?php endforeach; ?>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-md-9 col-lg-9 ">
                <div class="map"><div id="rsGoproShops2"></div></div>
            </div>
        </div>
    </div>
<?php endif; ?>
