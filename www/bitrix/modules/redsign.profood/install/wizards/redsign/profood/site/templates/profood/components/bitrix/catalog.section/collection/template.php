<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();

include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.php');

if ($arParams['IS_SORTERCHANGE'] != "Y"):
    $this->SetViewTarget('collection_sections');

    if (!function_exists('showCollectionItem')) {
        function showCollectionItem($arItem, $product, &$arResult, &$arParams) {

            $name = !empty($product['NAME']) ? $product['NAME'] : $arItem['NAME'];
            
            // get _$strAlt_ and _$strTitle_
            include(EXTENDED_PATH.'/img_alt_title.php');
            ?>
            <div class="item js-element js-elementid<?=$arItem['ID']?> simple" data-elementid="<?=$arItem['ID']?>" data-detail="<?=$arItem['DETAIL_PAGE_URL']?>">
                <div class="name"><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$name?></a></div>
                <div class="pic">
                    <a href="<?=$arItem['DETAIL_PAGE_URL']?>">
                        <?php if (isset($arItem['FIRST_PIC'])): ?>
                            <img src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" />
                        <?php else: ?>
                            <img src="<?=$arResult['NO_PHOTO']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" />
                        <?php endif; ?>
                    </a>
                </div>
                <?php if (isset($product['MIN_PRICE'])): ?>
        				      <div class="prices"><?=$product['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></div>
        				<?php endif; ?>
                <noindex><div class="buy clearfix">
                    <form class="add2basketform js-buyform<?=$arItem['ID']?> js-synchro<?if (!$product['CAN_BUY']):?> cantbuy<?endif; ?> clearfix" name="add2basketform">
                       <input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="ADD2BASKET">
                       <input type="hidden" name="<?=$arParams['PRODUCT_ID_VARIABLE']?>" class="js-add2basketpid" value="<?=$product['ID']?>">
                       <a rel="nofollow" class="submit add2basket" href="#" title="<?=GetMessage('ADD2BASKET')?>"><?=GetMessage('CT_BCE_CATALOG_ADD')?></a>
                       <a rel="nofollow" class="inbasket" href="<?=$arParams['BASKET_URL']?>" title="<?=GetMessage('INBASKET_TITLE')?>"><?=GetMessage('INBASKET')?></a>
                       <input type="submit" name="submit" class="noned" value="" />
                    </form>
                </div></noindex>
            </div>
            <?php

        }
    }
?>
<div class="detailtabs tabs">
    <div class="headers clearfix">
        <?php $activeSection = null; ?>
        <?php
        foreach ($arResult['SECTIONS'] as $id => $arSection):
            if (!$arSection || count($arSection['ITEMS']) < 1) {
                continue;
            }
        ?>
            <a class="switcher <?=!(!$activeSection && ($activeSection=$id)) ?:  'selected'?>" href="#section_<?=$id?>"> <?=$arSection['NAME']; ?></a>
        <?php endforeach; ?>
    </div>
    <div class="contents">
        <?php
        foreach ($arResult['SECTIONS'] as $id => $arSection):
            if (!$arSection || count($arSection['ITEMS']) < 1) {
                continue;
            }
        ?>
        <div class="content section_<?=$id?><?=$activeSection == $id ? ' selected' : ''?>" id="section_<?=$id;?>">
            <div class="contentbody clearfix">
                <div class="contentinner">
                    <div class="light clearfix">
                        <?php
                        foreach ($arSection['ITEMS']  as $arItem) {
                            if (!empty($arItem['OFFERS']) && is_array($arItem['OFFERS'])) {
                                foreach ($arItem['OFFERS'] as $product) {
                                    showCollectionItem($arItem, $product, $arResult, $arParams);
                                }
                            } else {
                                showCollectionItem($arItem, $arItem, $arResult, $arParams);
                            }
                        }
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<?php
endif;
$this->EndViewTarget();
