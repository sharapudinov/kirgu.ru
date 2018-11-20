<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

global $compareName, $compareIblockId;

$compareName = $arParams['COMPARE_NAME'];
$compareIblockId = $arParams['COMPARE_IBLOCK_ID'];

?><div id="rs_easycart" class="rs_easycart <?=$arParams['TEMPLATE_THEME']?><?if($arParams['ADD_BODY_PADDING']=='Y'):?> addbodypadding<?endif;?> hidden-print" <?
	?>style='z-index:<?=$arParams['Z_INDEX']?>;' <?
	?>data-serviceurl="<?=$arParams['SERVICE_URL']?>"><?
	if ($_REQUEST['rsec_ajax_post'] != 'Y') {
		$frame = $this->createFrame('rs_easycart',false)->begin('');
	}
	
	?><div class="rsec rsec_content" <?if(IntVal($arParams['MAX_WIDTH'])>1):?>style="max-width:<?=IntVal($arParams['MAX_WIDTH'])?>px;"<?endif;?>><?
		?><div class="rsec_in"><?
			?><div class="rsec_body"><?
				?><div class="rsec_tyanya"><?
					?><span><?
						?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-view-table"></use></svg><?
						?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-view-table"></use></svg><?
						?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-view-table"></use></svg><?
						?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-view-table"></use></svg><?
					?></span><?
					?><a class="rsec_close" href="#close"><?=GetMessage('CLOSE_EASYCART')?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-close-button"></use></svg></a><?
				?></div><?
				?><div class="rsec_tabs"><?
					if ($arParams['USE_VIEWED'] == 'Y') {
						?><div id="rsec_viewed" class="rsec_tab"><?
							include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/viewed_products.php");
						?></div><?
					}
					if ($arParams['USE_COMPARE'] == 'Y' && IntVal($arParams['COMPARE_IBLOCK_ID']) > 0) {
						?><div id="rsec_compare" class="rsec_tab<?if($arParams['ON_UNIVERSAL_AJAX_HANDLER']=='Y'):?> rsec_universalhandler<?endif;?>" <?
							if ($arParams['ON_UNIVERSAL_AJAX_HANDLER'] == 'Y' && $arParams['UNIVERSAL_AJAX_FINDER_COMPARE_ADD'] != '') {
								?>data-ajaxfinder_add="<?=$arParams['UNIVERSAL_AJAX_FINDER_COMPARE_ADD']?>" <?
							}
							if ($arParams['ON_UNIVERSAL_AJAX_HANDLER'] == 'Y' && $arParams['UNIVERSAL_AJAX_FINDER_COMPARE_REMOVE'] != '') {
								?>data-ajaxfinder_remove="<?=$arParams['UNIVERSAL_AJAX_FINDER_COMPARE_REMOVE']?>" <?
							}
							?>><?
							include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/compare.php");
						?></div><?
					}
					if ($arParams['USE_FAVORITE'] == 'Y') {
						?><div id="rsec_favorite" class="rsec_tab<?if($arParams['ON_UNIVERSAL_AJAX_HANDLER']=='Y'):?> rsec_universalhandler<?endif;?>" <?
							if ($arParams['ON_UNIVERSAL_AJAX_HANDLER'] == 'Y' && $arParams['UNIVERSAL_AJAX_FINDER_FAVORITE'] != '') {
								?>data-ajaxfinder="<?=$arParams['UNIVERSAL_AJAX_FINDER_FAVORITE']?>" <?
							}
							?>><?
							include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/favorite.php");
						?></div><?
					}
					if ($arParams['USE_BASKET'] == 'Y') {
						?><div id="rsec_basket" class="rsec_tab<?if($arParams['ON_UNIVERSAL_AJAX_HANDLER']=='Y'):?> rsec_universalhandler<?endif;?>" <?
							if ($arParams['ON_UNIVERSAL_AJAX_HANDLER'] == 'Y' && $arParams['UNIVERSAL_AJAX_FINDER_BASKET'] != '') {
								?>data-ajaxfinder="<?=$arParams['UNIVERSAL_AJAX_FINDER_BASKET']?>" <?
							}
							?>><?
							include($_SERVER["DOCUMENT_ROOT"].$templateFolder."/basket.php");
						?></div><?
					}
				?></div><?
			?></div><?
		?></div><?
	?></div><?
	
	?><div class="rsec rsec_headers"><?
		?><div class="rsec_in" <?if(IntVal($arParams['MAX_WIDTH'])>1):?>style="max-width:<?=IntVal($arParams['MAX_WIDTH'])?>px;"<?endif;?>><?
			?><div class="rsec_body"><?
				if ($arParams['USE_ONLINE_CONSUL'] == 'Y') {
					?><a class="rsec_online" href="<?=($arParams['ONLINE_CONSUL_LINK']!=''?$arParams['ONLINE_CONSUL_LINK']:"#")?>"><?
						?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-question"></use></svg><?
						?><span class="rsec_name"><?=GetMessage('ONLINE_CONSULTANT')?></span><?
					?></a><?
				}
				if ($arParams['USE_VIEWED'] == 'Y') {
					?><div class="rsec_orlink"><?
						?><a class="rsec_viewed rsec_changer js-unload" href="<?=SITE_DIR?>include/easycart/viewed_products.php#rsec_viewed" data-tabid="#rsec_viewed"><?
							?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-viewed"></use></svg><?
							?><span class="rsec_name"><?=GetMessage('TAB_NAME_rsec_thistab_viewed')?></span>&nbsp;<?
							?><span class="rsec_color rsec_cnt js-viewed-prod-count">0</span><?
						?></a><?
					?></div><?
				}
				if ($arParams['USE_COMPARE'] == 'Y' && IntVal($arParams['COMPARE_IBLOCK_ID']) > 0) {
					?><div class="rsec_orlink"><?
						?><a class="rsec_compare rsec_changer js-unload" href="<?=SITE_DIR?>include/easycart/compare.php#rsec_compare" data-tabid="#rsec_compare"><?
							?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-compare"></use></svg><?
							?><span class="rsec_name"><?=GetMessage('TAB_NAME_rsec_thistab_compare')?></span>&nbsp;<?
							?><span class="rsec_color rsec_cnt js-compare-prod-count">0</span><?
						?></a><?
					?></div><?
				}
				if ($arParams['USE_FAVORITE'] == 'Y') {
					?><div class="rsec_orlink"><?
						?><a class="rsec_favorite rsec_changer js-unload" href="<?=SITE_DIR?>include/easycart/favorite.php#rsec_favorite" data-tabid="#rsec_favorite"><?
							?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-heart-2"></use></svg><?
							?><span class="rsec_name"><?=GetMessage('TAB_NAME_rsec_thistab_favorite')?></span>&nbsp;<?
							?><span class="rsec_color rsec_cnt js-favorite-prod-count">0</span><?
						?></a><?
					?></div><?
				}
				if ($arParams['USE_BASKET'] == 'Y') {
					?><div class="rsec_orlink"><?
						?><a class="rsec_basket rsec_changer js-unload" href="<?=SITE_DIR?>include/easycart/basket.php#rsec_basket" data-tabid="#rsec_basket"><?
							?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cart-2"></use></svg><?
							?><span class="rsec_name"><?=GetMessage('SALE_EC_HEADER_LINK_PRODS')?></span><?
							?><span class="rsec_color">&nbsp;<span class="rsec_normalCount js-basket-prod-count">0</span></span> &nbsp;<?
							?><span class="rsec_name"><?=GetMessage('SALE_SUM')?></span><?
							?><span class="rsec_color rsec_sum">&nbsp;<?
								?><span class="rsec_allSum_FORMATED js-basket-allsum-formated">0</span><?
							?></span><?
						?></a><?
					?></div><?
				}
			?></div><?
		?></div><?
	?></div><?
	
	if ($_REQUEST['rsec_ajax_post'] != 'Y') {
		$frame->end();
	}
?></div>
