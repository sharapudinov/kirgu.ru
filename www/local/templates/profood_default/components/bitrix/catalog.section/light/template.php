<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);

$this->SetViewTarget('paginator');
if ($arParams['IS_AJAXPAGES'] != "Y" && $arParams['DISPLAY_TOP_PAGER'] == 'Y') {
	echo $arResult['NAV_STRING'];
}
$this->EndViewTarget();

if (isset($arResult['ITEMS'])) {
	?><div class="light clearfix"><?
		foreach ($arResult['ITEMS'] as $key1 => $arItem) {
            
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            $strMainID = $this->GetEditAreaId($arItem['ID']);
            
			$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) ? true : false;
			if ($haveOffers)
                $product = &$arItem['OFFERS'][0];
            else
                $product = &$arItem;
            
            if($arItem['CATALOG_SUBSCRIBE'] == 'Y')
                $showSubscribeBtn = true;
            else
                $showSubscribeBtn = false;
            
            $canBuy = $product['CAN_BUY'];
            
			?><div class="js-element js-elementid<?=$arItem['ID']?> <?if($haveOffers):?>offers<?else:?>simple<?endif;?>" data-elementid="<?=$arItem['ID']?>" data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" id="<?=$this->GetEditAreaId($arItem["ID"]);?>"><?
				?><div class="name"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a></div><?
				?><div class="pic"><?
					// PICTURE
					?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
						// get _$strAlt_ and _$strTitle_
						include(EXTENDED_PATH.'/img_alt_title.php');
						if (isset($arItem['FIRST_PIC'])) {
							?><img src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
						} else {
							?><img src="<?=$arResult['NO_PHOTO']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
						}
					?></a><?
				?></div><?
				// PRICE
				if (isset($arItem['MIN_PRICE'])) {
					?><div class="prices"><?
                        if ($arParams['USE_PRICE_COUNT']) {
                            foreach ($product['PRICE_MATRIX']['COLS'] as $typeID => $arType) {
                                $arPrice = $product['PRICE_MATRIX']['MATRIX'][$typeID][0];
                                ?><?=$arPrice['PRINT_DISCOUNT_VALUE']?><?
                                break;
                            }
                        } else {
                            ?><?=$product['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?><?
                        }
                    ?></div><?
				}
				// ADD2BASKET
				?>
				<div class="list-light__pay">
				<?php
				$arParams['USE_PRODUCT_QUANTITY'] = 'N';
				// pay
				include(EXTENDED_PATH_BLOCKS.'/pay.php');
				?>
				</div>
				<?
			?></div><?
		}
	?></div><?
}
