<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

// $this->setFrameMode(true);

$strMainID = $this->GetEditAreaId($arResult['ID']);

$iPriceCount = 0;
if (is_array($arResult['CAT_PRICES']) && count($arResult['CAT_PRICES']) > 0) {
    foreach ($arResult['CAT_PRICES'] as $sPriceCode => $arPrice) {
        if (!$arPrice['CAN_VIEW']) {
            continue;
        }
        $iPriceCount++;
    }
}
$bMultyPrice = ($iPriceCount > 1 ? true : false);

$haveOffers = (is_array($arResult['OFFERS']) && count($arResult['OFFERS'])>0) ? true : false;
if ($haveOffers)
    $product = &$arResult['OFFERS'][0];
else
    $product = &$arResult;

if($arResult['CATALOG_SUBSCRIBE'] == 'Y')
	$showSubscribeBtn = true;
else
	$showSubscribeBtn = false;

$canBuy = $product['CAN_BUY'];

?><div class="js-element js-elementid<?=$arResult['ID']?> <?if($haveOffers):?>offers<?else:?>simple<?endif;?> elementpopup<?
	if( isset($arResult['DAYSARTICLE2']) || isset($product['DAYSARTICLE2']) ) { echo ' da2'; }
	if( isset($arResult['QUICKBUY']) || isset($product['QUICKBUY']) ) { echo ' qb'; }
	?> propvision1" data-elementid="<?=$arResult['ID']?>"<?
	?> data-elementname="<?=CUtil::JSEscape($arResult['NAME'])?>" data-detail="<?=$arResult['DETAIL_PAGE_URL']?>"><?
	?><i class="icon da2qb"></i><?
	?><div class="elementpopupinner clearfix"><?
		?><a href="<?=$arResult['DETAIL_PAGE_URL']?>"><i class="icon da2qb"></i></a><?
		// -- LEFT BLOCK
		?><div class="block left"><?
			?><div class="ppadding"><?
				?><div class="name"><a href="<?=$arResult['DETAIL_PAGE_URL']?>"><?=$arResult['NAME']?></a></div><?
				?><div class="pic"><?
					// PICTURE
					?><a href="<?=$arResult['DETAIL_PAGE_URL']?>"><?
                        if (isset($arResult['FIRST_PIC_DETAIL']['RESIZE']['src'])) {
                            ?><img src="<?=$arResult['FIRST_PIC_DETAIL']['RESIZE']['src']?>" alt="<?=$arResult['IPROPERTY_VALUES']['ELEMENT_PREVIEW_PICTURE_FILE_ALT']?>" title="<?=$arResult['FIRST_PIC_DETAIL']['RESIZE']['TITLE']?>" /><?
                        } else {
                            ?><img src="<?=$arResult['NO_PHOTO']['src']?>" title="<?=$arResult['NAME']?>" alt="<?=$arResult['NAME']?>" /><?
                        }
					?></a><?
					// TIMERS
					// TODO: timers
				?></div><?
			?></div>
			
			<?php // PRICES ?>
			<?php if ($bMultyPrice): ?>
				<div class="prices scrollp vertical">
					<a rel="nofollow" class="scrollbtn prev" href="#"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-up"></use></svg></a>
					<?php if ($arParams['USE_PRICE_COUNT']):?>
						<div class="prices_jscrollpane scroll vertical vertical-only" id="prs_scroll_<?=$arItem['ID']?>" style="height:<?if(count($product['PRICE_MATRIX']['COLS']) > 2):?>102<?else:?>68<?endif;?>px;">
							<table class="pricestable scrollinner">
								<tbody>
								<?
								$iPriceCnt = 0;
								foreach ($product['PRICE_MATRIX']['COLS'] as $typeID => $arType):
									$arPrice = array_shift($product['PRICE_MATRIX']['MATRIX'][$typeID]);
									?>
									<tr class="scrollitem <?if (++$cnt % 2 == 0): ?>even<? else: ?>odd<? endif; ?>">
										<td class="nowrap"><?=$arType['NAME_LANG']?></td>

										<td class="nowrap">
											<span class="price price_pdv_<?=$arType['NAME'];?><? if($arPrice['DISCOUNT_DIFF'] > 0):?> new<?endif;?>">
												<?= isset($arPrice["PRINT_DISCOUNT_VALUE"]) ? $arPrice["PRINT_DISCOUNT_VALUE"] : '&mdash;';?>
											</span>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php else: ?>
						<div class="prices_jscrollpane scroll vertical vertical-only" id="prs_scroll_<?=$arItem['ID']?>" style="height:<?if(count($product['PRICES']) > 2):?>102<?else:?>68<?endif;?>px;">
							<table class="pricestable scrollinner">
								<tbody>
								<?
								$iPriceCnt = 0;
								foreach ($product['PRICES'] as $sPriceCode => $arPrice):
									?>
									<tr class="scrollitem <?if (++$cnt % 2 == 0): ?>even<? else: ?>odd<? endif; ?>">
										<td class="nowrap"><?=$arResult['CAT_PRICES'][$sPriceCode]['TITLE']?></td>

										<td class="nowrap">
											<span class="price price_pdv_<?=$sPriceCode;?><? if($arPrice['DISCOUNT_DIFF'] > 0):?> new<?endif;?>">
												<?=isset($arPrice["PRINT_DISCOUNT_VALUE"]) ? $arPrice["PRINT_DISCOUNT_VALUE"] : '&mdash;';?>
											</span>
										</td>
									</tr>
								<?php endforeach; ?>
								</tbody>
							</table>
						</div>
					<?php endif; ?>
					<a rel="nofollow" class="scrollbtn next" href="#"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-down"></use></svg></a>
				</div>
			<?php else: ?>
				<div class="soloprice">
				<?php if ($arParams['USE_PRICE_COUNT']):?>
					<?php foreach ($product['PRICE_MATRIX']['COLS'] as $typeID => $arType): ?>
						<?php $arPrice = array_shift($product['PRICE_MATRIX']['MATRIX'][$typeID]); ?>
						<span class="price gen price_pdv_<?=$arType['NAME'];?>"><?=$arPrice['PRINT_DISCOUNT_VALUE']?></span>
						<?php if ($arPrice['DISCOUNT_DIFF'] > 0): ?>
							<span class="price old price_pv_<?=$arType['NAME'];?>"><?=$arPrice['PRINT_VALUE']?></span>
							<span class="discount price_pd_<?=$arType['NAME'];?>"><?=$arPrice['PRINT_DISCOUNT_DIFF']?></span>
					<?php endif; ?>
					<?php
						break;
					endforeach;
					?>
				<?php else: ?>
					<?php if (!empty($product['MIN_PRICE'])): ?>
						<?php
						$arPrice = $product['MIN_PRICE'];
						?>
						<span class="price gen price_pdv_<?=$sPriceCode?>"><?=$arPrice['PRINT_DISCOUNT_VALUE']?></span>
						<?php if ($arPrice['DISCOUNT_DIFF'] > 0): ?>
							<span class="price old price_pv_<?=$sPriceCode?>"><?=$arPrice['PRINT_VALUE']?></span>
							<span class="discount price_pd_<?=$sPriceCode?>"><?=$arPrice['PRINT_DISCOUNT_DIFF']?></span>
						<?php endif; ?>
					<?php else: ?>
						<?php foreach ($arResult['PRICES'] as $sPriceCode => $arResPrice):
							if (!$arResult['PRICES'][$sPriceCode]['CAN_VIEW']) {
								continue;
							}
							$arPrice = $product['PRICES'][$sPriceCode];
							?>
							<span class="price gen price_pdv_<?=$sPriceCode?>"><?=$arPrice['PRINT_DISCOUNT_VALUE']?></span>
							<?php if ($arPrice['DISCOUNT_DIFF'] > 0): ?>
								<span class="price old price_pv_<?=$sPriceCode?>"><?=$arPrice['PRINT_VALUE']?></span>
								<span class="discount price_pd_<?=$sPriceCode?>"><?=$arPrice['PRINT_DISCOUNT_DIFF']?></span>
							<?php endif; ?>
						<?php endforeach; ?>
					<?php endif; ?>
				<?php endif; ?>
				</div>
			<?php endif; ?>
		</div>
		
		<?php // -- RIGHT BLOCK ?>
		<div class="block right"><?
			?><div class="ppadding"><?
				?><div class="propanddesc"><?
					// ARTICLE
					if( isset($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE']) || isset($arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE']) )
					{
						?><div class="article"><?=GetMessage('ARTICLE')?>: <span class="offer_article" <?
							?>data-prodarticle="<?=( isset($arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE']) ? $arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] : '' )?>"><?
							?><?=( isset($product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE']) ? $product['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'] : $arResult['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'] )?><?
						?></span></div><?
					} else {
						?><div class="article" style="display:none;"><?=GetMessage('ARTICLE')?>: <span class="offer_article"></span></div><?
					}
					?>

					<?// PROPERTIES
					if ($arParams['HIGHLOAD'] == 'HIGHLOAD_TYPE_LIST') {
						if (is_array($arResult['OFFERS_EXT']['PROPERTIES']) && count($arResult['OFFERS_EXT']['PROPERTIES']) > 0) {
							?><div class="properties properties_list clearfix"><?
							foreach ($arResult['OFFERS_EXT']['PROPERTIES'] as $propCode => $arProperty) {
								$isColor = false;
								?><div class="offer_prop offer_prop_list prop_<?=$propCode?> closed<?
								if (is_array($arParams['PROPS_ATTRIBUTES_COLOR']) && in_array($propCode,$arParams['PROPS_ATTRIBUTES_COLOR'])) {
									$isColor = true;
									?> color<?
								}
								?>" data-code="<?=$propCode?>">
								<div class="offer_prop-name"><?=$arResult['OFFERS_EXT']['PROPS'][$propCode]['NAME']?>: </div><?
								?><div class="div_select"><?
									?><div class="div_options div_options_list"><?
									$firstVal = false;
									foreach ($arProperty as $value => $arValue) {
									?><span class="div_option<?
										if($arValue['FIRST_OFFER'] == 'Y'):?> selected<?
										elseif($arValue['DISABLED_FOR_FIRST'] == 'Y'):?> disabled<?
										endif;?>" data-value="<?=htmlspecialcharsbx($arValue['VALUE'])?>"><?
										if ($isColor) {
										?><span style="background-image:url('<?=$arValue['PICT']['SRC']?>');" title="<?=$arValue['VALUE']?>"></span><?
										} else {
										?><span class="list-item"><?=$arValue['VALUE']?></span><?
										}
									?></span><?
									if ($arValue['FIRST_OFFER'] == 'Y') {
										$firstVal = $arValue;
									}
									}
									?></div><?
									if (is_array($firstVal)) {
									?><div class="div_selected div_selected_list"><?
										if ($isColor) {
										?><span style="background-image:url('<?=$firstVal['PICT']['SRC']?>');" title="<?=$firstVal['VALUE']?>"></span><?
										} else {
										?><span><?=$firstVal['VALUE']?></span><?
										}
										?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg><?
									?></div><?
									}
								?></div><?
								?></div><?
							}
							?></div><?
						}
					} else {
						if (is_array($arResult['OFFERS_EXT']['PROPERTIES']) && count($arResult['OFFERS_EXT']['PROPERTIES'])>0) {
							?><div class="properties clearfix"><?

							foreach ($arResult['OFFERS_EXT']['PROPERTIES'] as $propCode => $arProperty) {
								$isColor = false;
								?><div class="offer_prop prop_<?=$propCode?> closed<?
								if (is_array($arParams['PROPS_ATTRIBUTES_COLOR']) && in_array($propCode,$arParams['PROPS_ATTRIBUTES_COLOR'])) {
									$isColor = true;
									?> color<?
								}
								?>" data-code="<?=$propCode?>">
								<span class="offer_prop-name"><?=$arResult['OFFERS_EXT']['PROPS'][$propCode]['NAME']?>: </span><?
								?><div class="div_select"><?
									?><div class="div_options"><?
									$firstVal = false;
									foreach ($arProperty as $value => $arValue) {
									?><div class="div_option<?
										if($arValue['FIRST_OFFER'] == 'Y'):?> selected<?
										elseif($arValue['DISABLED_FOR_FIRST'] == 'Y'):?> disabled<?
										endif;?>" data-value="<?=htmlspecialcharsbx($arValue['VALUE'])?>"><?
										if ($isColor) {
										?><span style="background-image:url('<?=$arValue['PICT']['SRC']?>');" title="<?=$arValue['VALUE']?>"></span> &nbsp; <?=$arValue['VALUE']?><?
										} else {
										?><span><?=$arValue['VALUE']?></span><?
										}
									?></div><?
									if ($arValue['FIRST_OFFER'] == 'Y') {
										$firstVal = $arValue;
									}
									}
									?></div><?
									if (is_array($firstVal)) {
									?><div class="div_selected"><?
										if ($isColor) {
										?><span style="background-image:url('<?=$firstVal['PICT']['SRC']?>');" title="<?=$firstVal['VALUE']?>"></span><?
										} else {
										?><span><?=$firstVal['VALUE']?></span><?
										}
										?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg><?
									?></div><?
									}
								?></div><?
								?></div><?
							}
							?></div><?
						}
					}
					?>
		
					<?php // DESCRIPTION
					if(isset($arResult['PREVIEW_TEXT']) && $arResult['PREVIEW_TEXT']!='')
					{
						?><div class="description"><div class="text"><?=$arResult['PREVIEW_TEXT']?></div><a class="more" href="<?=$arResult['DETAIL_PAGE_URL']?>" title="<?=$arResult['NAME']?>"><?=GetMessage('GOPRO.MORE')?></a></div><?
					}
				?></div><?
				// ADD2BASKET
				?><noindex><div class="buy"><?
					?><form class="add2basketform js-buyform<?=$arResult['ID']?> js-synchro<?if(!$product['CAN_BUY']):?> cantbuy<?endif;?> clearfix" name="add2basketform"><?
						?><input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="ADD2BASKET"><?
						?><input type="hidden" name="<?=$arParams['PRODUCT_ID_VARIABLE']?>" class="js-add2basketpid" value="<?=$product['ID']?>"><?
						if ($arParams['USE_PRODUCT_QUANTITY']) {
							?><span class="quantity"><?
								?><span class="quantity_inner"><?
									?><a class="minus js-minus">-</a><?
									?><input type="text" class="js-quantity<?php if ($arParams['USE_PRICE_COUNT']):?> js-use_count<?endif;?>" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="<?=$product['CATALOG_MEASURE_RATIO']?>" data-ratio="<?=$product['CATALOG_MEASURE_RATIO']?>"><?
									if ($arParams['OFF_MEASURE_RATION'] != 'Y') {
										?><span class="js-measurename"><?=$product['CATALOG_MEASURE_NAME']?></span><?
									}
									?><a class="plus js-plus">+</a><?
								?></span><?
							?></span><?
						}
						?><a rel="nofollow" class="submit add2basket btn1" href="#" title="<?=GetMessage('ADD2BASKET')?>"><?=GetMessage('CT_BCE_CATALOG_ADD')?></a><?
                        // SUBSCRIBE
                        if ($showSubscribeBtn):
                            $APPLICATION->includeComponent('bitrix:catalog.product.subscribe', 'gopro',
                                array(
                                    'PRODUCT_ID' => $arResult['ID'],
                                    'BUTTON_ID' => $strMainID.'_subscribe_link',
                                    'BUTTON_CLASS' => 'btn3',
                                    'DEFAULT_DISPLAY' => true,
                                ),
                                $component,
                                array('HIDE_ICONS' => 'Y')
                            );
                        endif;
						?><a rel="nofollow" class="inbasket btn2" href="<?=$arParams['BASKET_URL']?>" title="<?=GetMessage('INBASKET_TITLE')?>"><?=GetMessage('INBASKET')?></a><?
						?><input type="submit" name="submit" class="noned" value="" /><?
					?></form><?
				?></div></noindex><?
				// COMPARE
				if ($arParams['USE_COMPARE'] == 'Y') {
					?><div class="compare"><?
						?><a rel="nofollow" class="checkbox add2compare" href="<?=$arResult['COMPARE_URL']?>"><label><?=GetMessage('ADD2COMPARE')?></label></a><?
					?></div><?
				}
				// FAVORITE & SHARE
				?><div class="favorishare clearfix"><?
					if ($arParams['USE_FAVORITE'] == 'Y' || $arParams['USE_SHARE'] == 'Y') {
						// FAVORITE
						if ($arParams['USE_FAVORITE'] == 'Y') {
							?><div class="favorite"><?
								?><a rel="nofollow" class="add2favorite" href="#favorite"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-heart"></use></svg><?=GetMessage('FAVORITE')?></a><?
							?></div><?
						}
						// SHARE
						if ($arParams['USE_SHARE'] == 'Y') {
							?><div class="share"><?
								?><span class="b-share"><a class="fancyajax fancybox.ajax email2friend b-share__handle b-share__link b-share-btn__vkontakte" href="<?=SITE_DIR?>include/popup/email2friend/?link=<?=CUtil::JSUrlEscape('http://'.$_SERVER['HTTP_HOST'].$arResult['DETAIL_PAGE_URL'])?>" title="<?=GetMessage('EMAIL2FRIEND')?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-email"></use></svg></a></span><?
								?><span class="js-yasha2" id="detailYaShare_<?=$arResult['ID']?>"></span><?
								?><script type="text/javascript">
								new Ya.share2('detailYaShare_<?=$arResult['ID']?>', {
									content: {
										<?if(isset($arResult['PREVIEW_TEXT']) && $arResult['PREVIEW_TEXT']!=''):?>description: '<?=CUtil::JSEscape($arItem['PREVIEW_TEXT'])?>',<?endif;?>
										<?if(isset($arResult['FIRST_PIC'])):?>image: '//<?=$_SERVER['HTTP_HOST']?><?=$arResult['FIRST_PIC']['RESIZE']['src']?>',<?endif;?>
										url: '//<?=$_SERVER['HTTP_HOST']?><?=$arResult['DETAIL_PAGE_URL']?>',
										title: '<?=CUtil::JSEscape($arResult['NAME'])?>'
									},
									theme: {
										services: 'vkontakte,facebook,twitter',
										size: 's',
										bare: false
									}
								});
								</script><?
							?></div><?
						}
					}
				?></div><?
			?></div><?
		?></div><?
	?></div><?
?></div>
