<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);

$i = 0;
if(is_array($arResult['PRICES']) && count($arResult['PRICES'])>0) {
	foreach($arResult['PRICES'] as $PRICE_CODE => $arPrice) {
		if(!$arPrice['CAN_VIEW']) {
			continue;
		}
		$i++;
	}
}
$bMultyPrice = ($i>1 ? true : false);

$this->SetViewTarget('paginator');
if($arParams['IS_AJAXPAGES']!='Y' && $arParams['IS_SORTERCHANGE']!='Y' && $arParams['DISPLAY_TOP_PAGER']=='Y') {
	echo $arResult['NAV_STRING'];
}
$this->EndViewTarget();

if($arParams['IS_SORTERCHANGE']=='Y') {
	$this->SetViewTarget('paginator');
	echo $arResult['NAV_STRING'];
	$this->EndViewTarget();
	$templateData['paginator'] = $APPLICATION->GetViewContent('paginator');
	$this->SetViewTarget('sorterchange');
}

if (is_array($arResult['ITEMS']) && count($arResult['ITEMS'])>0) {
	if ($arParams['IS_AJAXPAGES']!="Y") {
			?><!-- artables --><div class="artables view_gallery clearfix"><?
				?><table class="names"><?
					?><thead><?
						?><tr><?
							?><td class="free"></td><?
							?><td class="nowrap name"><div class="fix"><?=GetMessage('GOPRO_TH_PRODUCT')?></div></td><?
						?></tr><?
					?></thead><?
					?><tbody><?
	}
	if ($arParams['IS_AJAXPAGES']=="Y") {
		$this->SetViewTarget("catalognames");
	}
						$inc = 0;
						foreach ($arResult['ITEMS'] as $key1 => $arItem) {
                            
							$arItem['OFFERS_SELECTED'] = (intval($arItem['OFFERS_SELECTED']) > 0 ? $arItem['OFFERS_SELECTED'] : 0);
							$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) ? true : false;
							if($haveOffers)
                                $product = &$arItem['OFFERS'][$arItem['OFFERS_SELECTED']];
                            else
                                $product = &$arItem;
                            
							?><tr class="js-name<?=$arItem['ID']?><?if( ($inc+1)%2==0 ):?> even<?endif;?>" data-elementid="<?=$arItem['ID']?>"><?
								?><td class="free<?
									if( 
										isset($arItem['DAYSARTICLE2']) ||
										isset($product['DAYSARTICLE2']) ||
										isset($arItem['QUICKBUY']) ||
										isset($product['QUICKBUY'])
									){
										if( isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2']) ) { echo ' da2'; }
										if( isset($arItem['QUICKBUY']) || isset($product['QUICKBUY']) ) { echo ' qb'; }
									}
								?>"><?
									?><span<?
										if( 
											isset($arItem['DAYSARTICLE2']) ||
											isset($product['DAYSARTICLE2']) ||
											isset($arItem['QUICKBUY']) ||
											isset($product['QUICKBUY'])
										){
											echo ' class="';
											if( isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2']) ) { echo ' da2'; }
											if( isset($arItem['QUICKBUY']) || isset($product['QUICKBUY']) ) { echo ' qb'; }
											echo '"';
										}
									?>></span><?
								?></td><?
								?><td class="name"><?
									?><div class="js-position"><?
										?><table class="smpl"><?
											?><tr><?
												?><td class="pic"><?
													if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
														?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
													} else {
														?><span><?
													}

													// get _$strAlt_ and _$strTitle_
													include($_SERVER['DOCUMENT_ROOT'].SITE_TEMPLATE_PATH.'/template_ext/img_alt_title.php');

													if (isset($arItem['FIRST_PIC']['RESIZE']['src']) && $arItem['FIRST_PIC']['RESIZE']['src'] != '') {
														?><img src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
													} else {
														?><img src="<?=$arResult['NO_PHOTO']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /><?
													}
													if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
														?></a><?
													} else {
														?></span><?
													}
													
												?></td><?
												?><td class="nm"><?
													if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
														?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
													} else {
														?><span><?
													}
													?><?=$arItem['NAME']?><?
													if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
														?></a><?
													} else {
														?></span><?
													}
												?></td><?
											?></tr><?
										?></table><?
									?></div><?
								?></td><?
							?></tr><?
							$inc++;
						}
	if($arParams['IS_AJAXPAGES']=="Y") {
		$this->EndViewTarget();
		$templateData['catalognames'] = $APPLICATION->GetViewContent('catalognames');
	}
	if($arParams['IS_AJAXPAGES']!="Y") {
					?></tbody><?
				?></table><?
				?><!-- arproducts --><div class="arproducts"><?
					?><table class="products"><?
						?><thead><?
							?><tr><?
								?><td class="free"></td><?
								?><td class="nowrap name"><div class="name"><?=GetMessage("GOPRO_TH_PRODUCT")?></div></td><?
								if (isset($arParams['PROP_SKU_ARTICLE']) || isset($arParams['PROP_ARTICLE'])) {
									?><td class="nowrap"><?=GetMessage('ARTICLE')?></td><?
								}
								if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y') {
									?><td class="nowrap"><?=GetMessage('GOPRO_TH_QUANTITY')?></td><?
								}
								if(is_array($arResult['PRICES']) && count($arResult['PRICES'])>0) {
									foreach($arResult['PRICES'] as $PRICE_CODE => $arPrice) {
										if(!$arPrice['CAN_VIEW']) {
											continue;
										}
										?><td class="nowrap"><?=$arPrice['TITLE']?></td><?
									}
								}
								?><td class="nowrap"><?=GetMessage('GOPRO_TH_ZAKAZ')?></td><?
							?></tr><?
						?></thead><?
						?><tbody><?
	}
	if($arParams['IS_AJAXPAGES']=="Y") {
		$this->SetViewTarget("catalogproducts");
	}
		$inc = 0;
		foreach($arResult['ITEMS'] as $key1 => $arItem) {
            
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_EDIT'));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arParams['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BCS_ELEMENT_DELETE_CONFIRM')));
            $strMainID = $this->GetEditAreaId($arItem['ID']);
            
			$arItem['OFFERS_SELECTED'] = (intval($arItem['OFFERS_SELECTED']) > 0 ? $arItem['OFFERS_SELECTED'] : 0);
			$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS']) > 0) ? true : false;
			if($haveOffers)
                $product = &$arItem['OFFERS'][$arItem['OFFERS_SELECTED']];
            else
                $product = &$arItem;
            
            if($arItem['CATALOG_SUBSCRIBE'] == 'Y')
                $showSubscribeBtn = true;
            else
                $showSubscribeBtn = false;
            
            $canBuy = $product['CAN_BUY'];
            
			?><tr class="js-element js-elementid<?=$arItem['ID']?> <?if($haveOffers):?>offers<?else:?>simple<?endif;?><?if( ($inc+1)%2==0 ):?> even<?endif;?>" <?
				?>data-elementid="<?=$arItem['ID']?>" <?
				?>data-detail="<?=$arItem['DETAIL_PAGE_URL']?>" <?
				?>data-productid="<?=$product['ID']?>" <?
				?>id="<?=$this->GetEditAreaId($arItem["ID"]);?>"><?
				?><td class="free<?
					if( 
						isset($arItem['DAYSARTICLE2']) ||
						isset($product['DAYSARTICLE2']) ||
						isset($arItem['QUICKBUY']) ||
						isset($product['QUICKBUY'])
					) {
						if( isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2']) ) { echo ' da2'; }
						if( isset($arItem['QUICKBUY']) || isset($product['QUICKBUY']) ) { echo ' qb'; }
					}
				?>"><?
					?><span<?
						if( 
							isset($arItem['DAYSARTICLE2']) ||
							isset($product['DAYSARTICLE2']) ||
							isset($arItem['QUICKBUY']) ||
							isset($product['QUICKBUY'])
						){
							echo ' class="';
							if( isset($arItem['DAYSARTICLE2']) || isset($product['DAYSARTICLE2']) ) { echo 'da2'; }
							if( isset($arItem['QUICKBUY']) || isset($product['QUICKBUY']) ) { echo ' qb'; }
							echo '"';
						}
					?>></span><?
				?></td><?
				?><td class="name"><?
					?><div class="name js-position"><?
						?><table class="smpl"><?
							?><tr><?
								?><td class="pic"><?
									if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
										?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
									} else {
										?><span><?
									}
										if (isset($arItem['FIRST_PIC']['RESIZE']['src']) && $arItem['FIRST_PIC']['RESIZE']['src'] != '') {
											?><img src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" <?
												?>title="<?=$arItem['FIRST_PIC']['TITLE']?>" <?
												?>alt="<?=$arItem['FIRST_PIC']['ALT']?>" /><?
										} else {
											?><img src="<?=$arResult['NO_PHOTO']['src']?>" <?
												?>title="<?=$arItem['NAME']?>" <?
												?>alt="<?=$arItem['NAME']?>" /><?
										}
									if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
										?></a><?
									} else {
										?></span><?
									}
								?></td><?
								?><td class="nm"><?
									if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
										?><a class="js-detaillink" href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
									} else {
										?><span><?
									}
										?><?=$arItem['NAME']?><?
									if ($arParams['DONT_SHOW_LINKS'] != 'Y') {
										?></a><?
									} else {
										?></span><?
									}
								?></td><?
							?></tr><?
						?></table><?
					?></div><?
				?></td><?
				if ($haveOffers) {
					if(isset($arParams['PROP_SKU_ARTICLE']) || isset($arParams['PROP_ARTICLE'])) {
						?><td class="nowrap"><?
						if(isset($arParams['PROP_SKU_ARTICLE']) && isset($arItem['OFFERS'][0]['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]) && $arItem['OFFERS'][0]['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE']!='')
							echo $arItem['OFFERS'][0]['PROPERTIES'][$arParams['PROP_SKU_ARTICLE']]['VALUE'];
						elseif(isset($arParams['PROP_ARTICLE']) && $arItem['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE']!='')
							echo $arItem['PROPERTIES'][$arParams['PROP_ARTICLE']]['VALUE'];
						?></td><?
					}
					$BUY_ID = 0;//$arItem['OFFERS'][0]['ID'];
				} else {
					if(isset($arParams['PROP_SKU_ARTICLE']) || isset($arParams['PROP_ARTICLE'])) {
						?><td class="nowrap"><?=$arItem['DISPLAY_PROPERTIES'][$arParams['PROP_ARTICLE']]['DISPLAY_VALUE']?></td><?
					}
					$BUY_ID = $arItem['ID'];
				}
				if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y') {
					?><td class="nowrap"><?
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
									"MAIN_TITLE" => '',
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
					?></td><?
				}
				if(is_array($arResult["PRICES"]) && count($arResult["PRICES"])>0) {
					foreach($arResult['PRICES'] as $PRICE_CODE => $arResPrice) {
						$arPrice = $product['PRICES'][$PRICE_CODE];
						if(!$arResult['PRICES'][$PRICE_CODE]['CAN_VIEW']) {
							continue;
						}
						?><td class="nowrap"><?=(isset($arPrice["PRINT_DISCOUNT_VALUE"]) ? $arPrice["PRINT_DISCOUNT_VALUE"] : '&mdash;' )?></td><?
					}
				}
				?><td class="nowrap"><?
					?><!--noindex--><?
						?><form class="add2basketform js-add2basketform<?=$arItem['ID']?><?if(!$product['CAN_BUY'] && $BUY_ID>0):?> cantbuy<?endif;?> js-synchro" name="add2basketform"><?
							?><input type="hidden" name="<?=$arParams['ACTION_VARIABLE']?>" value="ADD2BASKET" /><?
							if($arParams['USE_PRODUCT_QUANTITY']) {
								?><span class="quantity"><?
									?><span class="quantity_inner"><?
										?><a class="minus js-minus">-</a><?
										?><input type="text" class="js-quantity" name="<?=$arParams['PRODUCT_QUANTITY_VARIABLE']?>" value="<?=$product['CATALOG_MEASURE_RATIO']?>" data-ratio="<?=$product['CATALOG_MEASURE_RATIO']?>"><?
										if ($arParams['OFF_MEASURE_RATION'] != 'Y') {
											?><span class="js-measurename"><?=$product['CATALOG_MEASURE_NAME']?></span><?
										}
										?><a class="plus js-plus">+</a><?
									?></span><?
								?></span><?
							}
							?><input type="hidden" name="<?=$arParams['PRODUCT_ID_VARIABLE']?>" class="js-add2basketpid" value="<?=$BUY_ID?>" /><?
							?><a rel="nofollow" class="submit js-add2basketlink" href="#" title="<?=GetMessage("ADD2BASKET")?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cart-3"></use></svg></a><?

                            // subscribe
                            if (!$haveOffers && $showSubscribeBtn):
                                $APPLICATION->includeComponent('bitrix:catalog.product.subscribe', 'gopro',
                                    array(
                                        'PRODUCT_ID' => $product['ID'],
                                        'BUTTON_ID' => $strMainID.'_subscribe_link',
                                        'BUTTON_CLASS' => 'add2subscribe btn3 icon js-product-subscribe',
                                        'DEFAULT_DISPLAY' => true,
                                    ),
                                    $component,
                                    array('HIDE_ICONS' => 'Y')
                                );
                            endif;
							?><a class="submit inbasket" href="<?=$arParams['BASKET_URL']?>" title="<?=GetMessage("INBASKET")?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cart-3"></use></svg></a><?
							?><svg class="svg-icon tick"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-check"></use></svg><?
							?><input type="submit" name="submit" class="nonep" value="" /><?
						?></form><?
					?><!--/noindex--><?
				?></td><?
			?></tr><?
			$inc++;
		}
	if($arParams['IS_AJAXPAGES']=="Y") {
		$this->EndViewTarget();
		$templateData['catalogproducts'] = $APPLICATION->GetViewContent('catalogproducts');
	}
	if($arParams['IS_AJAXPAGES']!="Y") {
						?></tbody><?
					?></table><?
				?></div><!-- /arproducts --><?
			?></div><!-- /artables --><?
			?><script>RSGoPro_DetectTable();</script><?
	}
	if($arParams['IS_AJAXPAGES']=="Y") {
		$this->SetViewTarget("catalogajaxpages");
	}
	if(IntVal($arResult['NAV_RESULT']->NavPageNomer)<IntVal($arResult['NAV_RESULT']->NavPageCount)) {
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
	if($arParams['IS_AJAXPAGES']=="Y") {
		$this->EndViewTarget();
		$templateData['catalogajaxpages'] = $APPLICATION->GetViewContent('catalogajaxpages');
	}
	if($arParams['IS_SORTERCHANGE']=='Y') {
		$this->EndViewTarget();
		$templateData[$arParams['AJAXPAGESID']] = $APPLICATION->GetViewContent('sorterchange');
	}
} elseif($arParams['SHOW_ERROR_EMPTY_ITEMS']=='Y') {
	ShowError(GetMessage('ERROR_EMPTY_ITEMS'));
}
