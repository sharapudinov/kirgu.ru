<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;

$this->setFrameMode(true);

$iPriceCount = 0;
if (is_array($arResult['PRICES']) && count($arResult['PRICES']) > 0) {
	foreach ($arResult['PRICES'] as $sPriceCode => $arPrice) {
		if (!$arPrice['CAN_VIEW']) {
			continue;
		}
		$iPriceCount++;
	}
}
$bMultyPrice = ($iPriceCount > 1 ? true : false);

$this->SetViewTarget('paginator');
if ($arParams['IS_AJAXPAGES'] != 'Y' && $arParams['IS_SORTERCHANGE'] != 'Y' && $arParams['DISPLAY_BOTTOM_PAGER'] == 'Y') {
	echo $arResult['NAV_STRING'];
}
$this->EndViewTarget();

if ($arParams['IS_SORTERCHANGE'] == 'Y') {
	$this->SetViewTarget('paginator');
	echo $arResult['NAV_STRING'];
	$this->EndViewTarget();
	$templateData['paginator'] = $APPLICATION->GetViewContent('paginator');
	$this->SetViewTarget('sorterchange');
}

if(is_array($arResult['ITEMS']) && count($arResult['ITEMS'])>0) {
	if($arParams['IS_AJAXPAGES']!='Y') {
		?><!-- showcase --><div class="view_showcase clearfix<?
			if($bMultyPrice):?> big<?endif;?><?
			if($arParams['COLUMNS5']=='Y'):?> columns5<?endif;
			?>" id="showcaseview"><?
	}
	if($arParams['IS_AJAXPAGES']=="Y") {
		$this->SetViewTarget("showcaseview");
	}
	foreach($arResult['ITEMS'] as $key1 => $arItem) {
        
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
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
        
		?><div class="js-element js-elementid<?=$arItem['ID']?> <?if($haveOffers):?>offers<?else:?>simple<?endif;?><?
			if( isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2']) ) { echo ' da2'; }
			if( isset($arItem['QUICKBUY']) || isset($product['QUICKBUY']) ) { echo ' qb'; }
            if ($arParams['USE_SHADOW_ON_HOVER'] == 'Y') echo ' shadow';
			?> propvision1" <?
			?>data-elementid="<?=$arItem['ID']?>" <?
			?>id="<?=$this->GetEditAreaId($arItem["ID"]);?>" <?
			?>data-productid="<?=$product['ID']?>" <?
			?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>"><?
			?><div class="inner"><?
				?><div class="padd"><?
					if( $arParams['DONT_SHOW_LINKS']!='Y' ) {
						?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
					} else {
						?><span><?
					}
					?><i class="icon da2qb"></i><?
					if( $arParams['DONT_SHOW_LINKS']!='Y' ) {
						?></a><?
					} else {
						?></span><?
					}
					// -- FIRST PART
					?><div class="name"><?
						if( $arParams['DONT_SHOW_LINKS']!='Y' ) {
							?><a href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><?
						} else {
							?><span><?
						}
						?><?=$arItem['NAME']?><?
						if( $arParams['DONT_SHOW_LINKS']!='Y' ) {
							?></a><?
						} else {
							?></span><?
						}
					?></div><?
					?><div class="pic"><?

						// stickers
						include(Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/template_ext/stickers.php');

						// PICTURE
						if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
							?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
						} else {
							?><span class="pic"><?
						}

						// get _$strAlt_ and _$strTitle_
						include(Application::getDocumentRoot().SITE_TEMPLATE_PATH.'/template_ext/img_alt_title.php');
						
						if (isset($arItem['FIRST_PIC']['RESIZE']['src']) && trim($arItem['FIRST_PIC']['RESIZE']['src']) != '') {
							?><img src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
						} else {
							?><img src="<?=$arResult['NO_PHOTO']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
						}
						if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
							?></a><?
						} else {
							?></span><?
						}

						// TIMERS
						$arTimers = array();
						if( $arItem['HAVE_DA2']=='Y' ) {
							if( isset($arItem['DAYSARTICLE2']) )
							{
								$arTimers[] = $arItem['DAYSARTICLE2'];
							} elseif($haveOffers) {
								foreach($arItem['OFFERS'] as $arOffer)
								{
									if( isset($arOffer['DAYSARTICLE2']) )
									{
										$arTimers[] = $arOffer['DAYSARTICLE2'];
									}
								}
							}
						} elseif( $arItem['HAVE_QB']=='Y' ) {
							if( isset($arItem['QUICKBUY']) )
							{
								$arTimers[] = $arItem['QUICKBUY'];
							} elseif($haveOffers) {
								foreach($arItem['OFFERS'] as $arOffer)
								{
									if( isset($arOffer['QUICKBUY']) )
									{
										$arTimers[] = $arOffer['QUICKBUY'];
									}
								}
							}
						}
						if( is_array($arTimers) && count($arTimers)>0 )
						{
							?><div class="timers"><?
								$haveVision = false;
								foreach($arTimers as $arTimer) {
									$KY = 'TIMER';
									if(isset($arTimer['DINAMICA_EX'])) {
										$KY = 'DINAMICA_EX';
									}
                                    $jsTimer = array(
                                        'DATE_FROM' => $arTimer[$KY]['DATE_FROM'],
                                        'DATE_TO' => $arTimer[$KY]['DATE_TO'],
                                        'AUTO_RENEWAL' => $arTimer['AUTO_RENEWAL'],
                                    );
                                    if (isset($arTimer['DINAMICA'])) {
                                        $jsTimer['DINAMICA_DATA'] = $arTimer['DINAMICA'] == 'custom' ? array_flip(unserialize($arTimer['DINAMICA_DATA'])) : $arTimer['DINAMICA'];
                                    }
                                    
									?><div class="timer <?if(isset($arTimer['DINAMICA_EX'])):?>da2<?else:?>qb<?endif;?> js-timer_id<?=$arTimer['ELEMENT_ID']?> clearfix" style="display:<?
										if (($arItem['ID'] == $arTimer['ELEMENT_ID'] || $product['ID'] == $arTimer['ELEMENT_ID']) && !$haveVision) {
											?>inline-block<?
											$haveVision = true;
										} else {
											?>none<?
										}
										?>;" data-timer='<?=json_encode($jsTimer)?>'><?
										?><div class="clock"><i class="icon"></i></div><?
										?><div class="intimer clearfix"  data-dateto="<?=$arTimer[$KY]['DATE_TO']?>" data-autoreuse="<?=$arTimer['AUTO_RENEWAL'];?>"><?
											?><div class="val"<?=($arTimer[$KY]['DAYS'] < 1 ? ' style="display: none;"' : '');?>><div class="value result-day"><?
												echo($arTimer[$KY]['DAYS']>9?$arTimer[$KY]['DAYS']:'0'.$arTimer[$KY]['DAYS'] )
												?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_DAY')?></div></div><?
											?><div class="val"><div class="value result-hour"><?
												echo($arTimer[$KY]['HOUR']>9?$arTimer[$KY]['HOUR']:'0'.$arTimer[$KY]['HOUR'] )
												?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_HOUR')?></div></div><?
											?><div class="val"><div class="value result-minute"><?
												echo($arTimer[$KY]['MINUTE']>9?$arTimer[$KY]['MINUTE']:'0'.$arTimer[$KY]['MINUTE'] )
												?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_MIN')?></div></div><?
												?><div class="val" <?=($arTimer[$KY]['DAYS'] > 0 ? 'style="display: none;"' : '');?>><div class="value result-second"><?
													echo($arTimer[$KY]['SECOND']>9?$arTimer[$KY]['SECOND']:'0'.$arTimer[$KY]['SECOND'] )
													?></div><div class="podpis"><?=GetMessage('QB_AND_DA2_SEC')?></div></div><?
											if (isset($arTimer['DINAMICA_EX']) || isset($arTimer['TIMER'])) {
												?><div class="val ml"><div class="value"><span class="num_percent">0</span>%</div><div class="podpis"><?=GetMessage('QB_AND_DA2_PRODANO')?></div></div><?
											}
										?></div><?
										if (isset($arTimer['DINAMICA_EX']) || isset($arTimer['TIMER'])) {
											?><div class="clear"></div><div class="progressbar"><div class="progress" style="width:0%;"></div></div><?
										}
									?></div><?
								}
							?></div><?
						}
					?></div><?
				?></div>

				<?php // prices ?>
				<?php if ($bMultyPrice): ?>
					<div class="prices scrollp vertical">
						<a rel="nofollow" class="scrollbtn prev" href="#"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-up"></use></svg></a>
						<?php if ($arParams['USE_PRICE_COUNT'] && !empty($product['PRICE_MATRIX']['COLS'])):?>
							<div class="prices_jscrollpane scroll vertical vertical-only" id="prs_scroll_<?=$arItem['ID']?>" style="height:<?if(count($product['PRICE_MATRIX']['COLS']) > 2):?>102<?else:?>68<?endif;?>px;">
								<table class="pricestable scrollinner">
									<tbody>
									<?
									$iPriceCnt = 0;
									foreach ($product['PRICE_MATRIX']['COLS'] as $typeID => $arType):
										$arPrice = reset($product['PRICE_MATRIX']['MATRIX'][$typeID]);
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
											<td class="nowrap"><?=$arResult['PRICES'][$sPriceCode]['TITLE']?></td>

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
					<?php if ($arParams['USE_PRICE_COUNT'] && !empty($product['PRICE_MATRIX']['COLS'])):?>
						<?php foreach ($product['PRICE_MATRIX']['COLS'] as $typeID => $arType): ?>
							<?php $arPrice = reset($product['PRICE_MATRIX']['MATRIX'][$typeID]); ?>
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

				<? // unsubscrive ?>
				<?php if ($this->__component->getName() == 'bitrix:catalog.product.subscribe.list'): ?>
					<div class="padd" style="text-align: center;">
						<a class="catalog_item__detail btn1" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=GetMessage('CPSL_TPL_MESS_BTN_DETAIL')?></a>
						<a class="catalog_item__unsubscribe js-product__unsubscribe  btn2" data-subscribe-id="<?=CUtil::PhpToJSObject($arParams['LIST_SUBSCRIPTIONS'][$arItem['ID']], false, true)?>"><?=GetMessage('CPSL_TPL_MESS_BTN_UNSUBSCRIBE');?></a>
					</div>
				<?php endif; ?>

                <? // -- SECOND PART ?>
				<?php if ($arParams['OFF_SMALLPOPUP'] != 'Y'): ?>
					<div class="popup padd">
						<?php // PROPERTIES ?>
						<?php if (is_array($arItem['OFFERS_EXT']['PROPERTIES']) && count($arItem['OFFERS_EXT']['PROPERTIES']) > 0): ?>
							<div class="properties">
								<?php foreach ($arItem['OFFERS_EXT']['PROPERTIES'] as $propCode => $arProperty): ?>
									<?php
                                    $isColor = false;
                                    if (is_array($arParams['PROPS_ATTRIBUTES_COLOR']) && in_array($propCode, $arParams['PROPS_ATTRIBUTES_COLOR']))
                                        $isColor = true;
                                    ?>
									<div class="offer_prop prop_<?=$propCode?> closed<?php if ($isColor): ?> color<?php endif;?>" data-code="<?=$propCode?>">
										<span class="offer_prop-name"><?=$arItem['OFFERS_EXT']['PROPS'][$propCode]['NAME']?>: </span>
										<div class="div_select">
											<div class="div_options">
                                            <?php
											$firstVal = false;
                                            ?>
											<?php foreach ($arProperty as $value => $arValue): ?>
												<div class="div_option<?
													if ($arValue['FIRST_OFFER'] == 'Y'):?> selected<?
													elseif ($arValue['DISABLED_FOR_FIRST'] == 'Y'):?> disabled<?
													endif;?>" data-value="<?=htmlspecialcharsbx($arValue['VALUE'])?>">
													<?php if ($isColor): ?>
														<span style="background-image:url('<?=$arValue['PICT']['SRC']?>');" title="<?=$arValue['VALUE']?>"></span> &nbsp; <?=$arValue['VALUE']?>
													<?php else: ?>
														<span><?=$arValue['VALUE']?></span>
													<?php endif; ?>
												</div>
												<?php
                                                if ($arValue['FIRST_OFFER'] == 'Y')
													$firstVal = $arValue;
                                                ?>
											<?php endforeach; ?>
											</div>
											<?php if (is_array($firstVal)): ?>
												<div class="div_selected">
													<?php if ($isColor): ?>
														<span style="background-image:url('<?=$firstVal['PICT']['SRC']?>');" title="<?=$firstVal['VALUE']?>"></span>
													<?php else: ?>
														<span><?=$firstVal['VALUE']?></span>
													<?php endif; ?>
													<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg>
												</div>
											<?php endif; ?>
										</div>
									</div>
								<?php endforeach; ?>
							</div>
						<?php endif; ?>
						<?php // ADD2BASKET ?>
						<!--noindex--><div class="buy"><?
							?><form class="add2basketform js-buyform<?=$arItem['ID']?> js-synchro<?if(!$product['CAN_BUY']):?> cantbuy<?endif;?> clearfix" name="add2basketform"><?
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

                                // subscribe
                                if ($showSubscribeBtn):
                                    $APPLICATION->includeComponent('bitrix:catalog.product.subscribe', 'gopro',
                                        array(
                                            'PRODUCT_ID' => $product['ID'],
                                            'BUTTON_ID' => $strMainID.'_subscribe_link',
                                            'BUTTON_CLASS' => 'btn3 js-product-subscribe',
                                            'DEFAULT_DISPLAY' => true,
                                        ),
                                        $component,
                                        array('HIDE_ICONS' => 'Y')
                                    );
                                endif;

								?><a rel="nofollow" class="inbasket btn2" href="<?=$arParams['BASKET_URL']?>" title="<?=GetMessage('INBASKET_TITLE')?>"><?=GetMessage('INBASKET')?></a><?
								?><input type="submit" name="submit" class="nonep" value="" /><?
							?></form><?
						?></div><!--/noindex--><?
                        
						// COMPARE
						if ($arParams['DISPLAY_COMPARE'] == 'Y' || $arParams['USE_STORE'] == 'Y') {
							?><div class="compare_and_stores clearfix"><?
                                if ($arParams['DISPLAY_COMPARE'] == 'Y') {
                                    ?><div class="compare"><?
                                        ?><a rel="nofollow" class="checkbox add2compare" href="<?=$arItem['COMPARE_URL']?>"><span class="label js-label"><?=GetMessage('ADD2COMPARE')?></span></a><?
                                    ?></div><?
                                }
                                if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y') {
									if (!empty($arParams['PROP_STORE_REPLACE_SECTION']) && $arItem['DISPLAY_PROPERTIES'][$arParams['PROP_STORE_REPLACE_SECTION']]['DISPLAY_VALUE'] != '') {
										?><div class="stores"><span><?
											?><?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_STORE_REPLACE_SECTION']]['DISPLAY_VALUE']?><?
										?></span></div><?
									} else {
										?><?$APPLICATION->IncludeComponent(
											'bitrix:catalog.store.amount',
											'gopro',
											array(
												"ELEMENT_ID" => $arItem['ID'],
												"STORE_PATH" => $arParams['STORE_PATH'],
												"CACHE_TYPE" => "A",
												"CACHE_TIME" => "36000",
												"MAIN_TITLE" => GetMessage('GOPRO_TH_QUANTITY'),
												"USE_STORE_PHONE" => $arParams['USE_STORE_PHONE'],
												"SCHEDULE" => $arParams['USE_STORE_SCHEDULE'],
												"USE_MIN_AMOUNT" => "Y",
												"GOPRO_USE_MIN_AMOUNT" => $arParams['USE_MIN_AMOUNT'],
												"MIN_AMOUNT" => $arParams['MIN_AMOUNT'],
												"SHOW_EMPTY_STORE" => $arParams['SHOW_EMPTY_STORE'],
												"SHOW_GENERAL_STORE_INFORMATION" => $arParams['SHOW_GENERAL_STORE_INFORMATION'],
												"USER_FIELDS" => $arParams['USER_FIELDS'],
												"FIELDS" => $arParams['FIELDS'],
												// gopro
												'DATA_QUANTITY' => $arItem['DATA_QUANTITY'],
												'FIRST_ELEMENT_ID' => $product['ID'],
												'SHOW_GENERAL_STORE_INFORMATION' => 'Y',
											),
											$component,
											array('HIDE_ICONS'=>'Y')
										);?><?
									}
                                }
							?></div><?
						}
                        
						// DESCRIPTION
						if (isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_TEXT'] != '') {
							?><div class="description"><div class="text"><?=$arItem['PREVIEW_TEXT']?></div><a class="more" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><?=GetMessage('GOPRO.MORE')?></a></div><?
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
								if ($arParams['USE_SHARE'] == 'Y' && $arParams['GOPRO']['OFF_YANDEX'] != 'Y') {
									?><div class="share"><?
										?><span class="b-share"><a class="fancyajax fancybox.ajax email2friend b-share__handle b-share__link b-share-btn__vkontakte" href="<?=SITE_DIR?>include/popup/email2friend/?link=<?=CUtil::JSUrlEscape('http://'.$_SERVER['HTTP_HOST'].$arItem['DETAIL_PAGE_URL'])?>" title="<?=GetMessage('EMAIL2FRIEND')?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-email"></use></svg></a></span><?
										?><span class="js-yasha2" id="detailYaShare_<?=$arItem['ID']?>"></span><?
										?><script type="text/javascript">
										$(window).on('load', function(){
											new Ya.share2('detailYaShare_<?=$arItem['ID']?>', {
												content: {
													<?if(isset($arItem['PREVIEW_TEXT']) && $arItem['PREVIEW_TEXT']!=''):?>description: '<?=CUtil::JSEscape($arItem['PREVIEW_TEXT'])?>',<?endif;?>
													<?if(isset($arItem['FIRST_PIC'])):?>image: '//<?=$_SERVER['HTTP_HOST']?><?=$arItem['FIRST_PIC']['RESIZE']['src']?>',<?endif;?>
													url: '//<?=$_SERVER['HTTP_HOST']?><?=$arItem['DETAIL_PAGE_URL']?>',
													title: '<?=CUtil::JSEscape($arItem['NAME'])?>'
												},
												theme: {
													services: 'vkontakte,facebook,twitter',
													size: 's',
													bare: false
												}
											});
										});
										</script><?
									?></div><?
								}
							}
						?></div>
					</div>
				<?php endif; ?>
				<?php // -- /SECOND PART ?>
			</div><?
		?></div><?
	}
	if($arParams['IS_AJAXPAGES']=='Y')
	{
		?><script>RSGoPro_JSPReinit('.prices_jscrollpane',1)</script><?
		$this->EndViewTarget();
		$templateData['showcaseview'] = $APPLICATION->GetViewContent('showcaseview');
	}
	if($arParams['IS_AJAXPAGES']!='Y')
	{
		?></div><!-- showcase --><?
	}
	if($arParams['IS_AJAXPAGES']=='Y')
	{
		$this->SetViewTarget("catalogajaxpages");
	}
	if(IntVal($arResult['NAV_RESULT']->NavPageNomer)<IntVal($arResult['NAV_RESULT']->NavPageCount))
	{
		?><div class="ajaxpages<?if($arParams['USE_AUTO_AJAXPAGES']=='Y'):?> auto<?endif;?>"><?
			?><a rel="nofollow" href="#" <?
				?>data-ajaxurl="<?=str_replace("+", "%2B", $arResult['AJAXPAGE_URL'])?>" <?
				?>data-ajaxpagesid="<?=$arParams['AJAXPAGESID']?>" <?
				?>data-navpagenomer="<?=($arResult['NAV_RESULT']->NavPageNomer)?>" <?
				?>data-navpagecount="<?=($arResult['NAV_RESULT']->NavPageCount)?>" <?
				?>data-navnum="<?=($arResult['NAV_RESULT']->NavNum)?>"<?
			?>><i class="animashka"></i><span><?=GetMessage('AJAXPAGES_LOAD_MORE')?></span></a><?
		?></div><?
	}
	if($arParams['IS_AJAXPAGES']=='Y')
	{
		$this->EndViewTarget();
		$templateData['catalogajaxpages'] = $APPLICATION->GetViewContent('catalogajaxpages');
	}
	if($arParams['IS_SORTERCHANGE']=='Y')
	{
		$this->EndViewTarget();
		$templateData[$arParams['AJAXPAGESID']] = $APPLICATION->GetViewContent('sorterchange');
	}
} elseif($arParams['SHOW_ERROR_EMPTY_ITEMS']=='Y'){
	ShowError(GetMessage('ERROR_EMPTY_ITEMS'));
}
