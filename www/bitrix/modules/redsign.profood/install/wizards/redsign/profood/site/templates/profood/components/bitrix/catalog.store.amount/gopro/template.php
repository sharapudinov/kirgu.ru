<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

if (!function_exists('RSGoPro_GetResult20')) {
	function RSGoPro_GetResult20($amount, $arParams, $postfix) {
		$return = 0;
		if ($arParams['GOPRO_USE_MIN_AMOUNT'] == 'Y') {
			if ($amount < 1) {
				$return = Loc::getMessage('GOPRO.STORES.QUANTITY.EMPTY'.$postfix, array('#ICON#' => $arParams['ICONS']['EMPTY']));
			} elseif ($amount < $arParams['MIN_AMOUNT']) {
				$return = Loc::getMessage('GOPRO.STORES.QUANTITY.LOW'.$postfix, array('#ICON#' => $arParams['ICONS']['LOW']));
			} else {
				$return = Loc::getMessage('GOPRO.STORES.QUANTITY.ISSET'.$postfix, array('#ICON#' => $arParams['ICONS']['ISSET']));
			}
		} else {
			$return = $amount;
		}
		return $return;
	}
}

$svgIsset = '<svg class="svg-icon isset"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-stores-available"></use></svg>';
$svgLow = $svgIsset;
$svgEmpty = '<svg class="svg-icon empty"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-stores-not-available"></use></svg>';

$arParams['ICONS'] = array(
	'EMPTY' => $svgEmpty,
	'LOW' => $svgLow,
	'ISSET' => $svgIsset,
);

$tag = 'span';
if (count($arResult['STORES']) > 0 && $arParams['SHOW_GENERAL_STORE_INFORMATION'] != 'Y' && $arParams['PAGE'] == 'detail') {
	$tag = 'a';
}

$postfix = ($arParams['PAGE'] == 'detail' ? '.DETAIL' : '');
?>

<div class="b-stores js-stores" data-firstElement="<?=$arParams['FIRST_ELEMENT_ID']?>" data-page="<?=$arParams['PAGE']?>">
	<div class="b-stores__inner"><?
		?><?php if (is_array($arResult['JS']['SKU']) && count($arResult['JS']['SKU']) > 1): ?><?
			if ($arParams['PAGE'] == 'detail') {
				if ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < 1): ?><?
					?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
				?><?php elseif ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < $arParams['MIN_AMOUNT']): ?><?
					?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
				?><?php else: ?><?
					?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
				?><?php endif;
			}
			?><<?=$tag?> class="b-stores__genamount<?=($tag == 'a' ? ' js-easy-scroll' : '')?>" href="#stocks" title="" data-es-offset="-135" data-src="#stores_<?=$arParams['~ELEMENT_ID']?>"><?
				?><?php if ($arParams['GOPRO_USE_MIN_AMOUNT'] == 'Y'): ?><?
					?><?php if ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < 1): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.EMPTY'.$postfix, array('#ICON#' => $arParams['ICONS']['EMPTY']))?></span><?
					?><?php elseif ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < $arParams['MIN_AMOUNT']): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.LOW'.$postfix, array('#ICON#' => $arParams['ICONS']['LOW']))?></span><?
					?><?php else: ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.ISSET'.$postfix, array('#ICON#' => $arParams['ICONS']['ISSET']))?></span><?
					?><?php endif; ?><?
				?><?php else: ?><?
					if ($arParams['PAGE'] != 'detail') {
						echo Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix);
					}
					?> - <span class="js-stores__value sub"><?=$arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']]?></span><?
				?><?php endif; ?><?
			?></<?=$tag?>><?
		?><?php else: ?><?
			if ($arParams['PAGE'] == 'detail') {
				if ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < 1): ?><?
					?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
				?><?php elseif ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < $arParams['MIN_AMOUNT']): ?><?
					?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
				?><?php else: ?><?
					?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
				?><?php endif;
			}
			?><<?=$tag?> class="b-stores__genamount<?=($tag == 'a' ? ' js-easy-scroll' : '')?>" href="#stocks" title="" data-es-offset="-135"><?
				?><?php if ($arParams['GOPRO_USE_MIN_AMOUNT'] == 'Y'): ?><?
					?><?php if ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < 1): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.EMPTY'.$postfix, array('#ICON#' => $arParams['ICONS']['EMPTY']))?></span><?
					?><?php elseif ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < $arParams['MIN_AMOUNT']): ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.LOW'.$postfix, array('#ICON#' => $arParams['ICONS']['LOW']))?></span><?
					?><?php else: ?><?
						?><span class="js-stores__value"><?=Loc::getMessage('GOPRO.STORES.QUANTITY.ISSET'.$postfix, array('#ICON#' => $arParams['ICONS']['ISSET']))?></span><?
					?><?php endif; ?><?
				?><?php else: ?><?
					if ($arParams['PAGE'] != 'detail') {
						echo Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix);
					}
					?> - <span class="js-stores__value"><?=$arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']]?></span><?
				?><?php endif; ?><?
			?></<?=$tag?>><?
		?><?php endif; ?><?
	?></div>
</div>

<?php if ($arParams['PAGE'] == 'detail' && $arParams['SHOW_GENERAL_STORE_INFORMATION'] != 'Y'): ?>
<?php
// $this->SetViewTarget('TABS_STOCKS'); // because nelzya
$stock = array();
ob_start();
?>
<div class="b-stores-list">
	<div id="popupstores_<?=$arParams['~ELEMENT_ID']?>"><?
		?><?php foreach ($arResult['STORES'] as $key1 => $arStore): ?><?
		?><div class="b-stores-list__row js-stores__store<?=$arStore['ID']?>" style="display:<?=($arParams['SHOW_EMPTY_STORE'] == 'N' && ($arResult['JS']['SKU'][$arParams['FIRST_ELEMENT_ID']][$arStore['ID']] > 0 || $arStore['REAL_AMOUNT'] > 0) == false ? 'none' : '')?>;"><?
				$emptyVal = '';
				if (in_array('TITLE', $arParams['FIELDS'])) {
					?><div class="b-stores-list__col title"><?=($arStore['TITLE'] ?: $emptyVal)?></div><?
				}
				if (in_array('PHONE', $arParams['FIELDS'])) {
					?><div class="b-stores-list__col"><span class="nowrap"><?=($arStore['PHONE'] ?: $emptyVal)?></span></div><?
				}
				if (in_array('SCHEDULE', $arParams['FIELDS'])) {
					?><div class="b-stores-list__col"><?=($arStore['SCHEDULE'] ?: $emptyVal)?></div><?
				}
				if (in_array('EMAIL', $arParams['FIELDS'])) {
					?><div class="b-stores-list__col"><?=($arStore['EMAIL'] ?: $emptyVal)?></div><?
				}
				if (in_array('COORDINATES', $arParams['FIELDS'])) {
					?><div class="b-stores-list__col"><?
					$val = (is_array($arStore['COORDINATES']) ? implode(' / ', $arStore['COORDINATES']) : $arStore['COORDINATES']);
					echo ($val ?: $emptyVal);
					?></div><?
				}
				if (in_array('DESCRIPTION', $arParams['FIELDS'])) {
					?><div class="b-stores-list__col"><?=($arStore['DESCRIPTION'] ?: $emptyVal)?></div><?
				}
				?><div class="b-stores-list__col b-stores-list__amount"><?
					?><span class="nowrap"><?
						if ($arParams['PAGE'] == 'detail') {
							if ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < 1): ?><?
								?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
							?><?php elseif ($arParams['DATA_QUANTITY'][$arParams['FIRST_ELEMENT_ID']] < $arParams['MIN_AMOUNT']): ?><?
								?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
							?><?php else: ?><?
								?><span class="js-stores__title"><?=Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix)?></span><?
							?><?php endif;
						}
						if ($arParams['GOPRO_USE_MIN_AMOUNT'] != 'Y') {
							if ($arParams['PAGE'] != 'detail') {
								echo Loc::getMessage('GOPRO.STORES.QUANTITY'.$postfix);
							}
							echo ' - ';
						}
						?><span class="js-stores__value"><?=RSGoPro_GetResult20($arStore['REAL_AMOUNT'], $arParams, $postfix)?></span><?
					?></span><?
				?></div><?
			?></div><?
		?><?php endforeach; ?><?
	?></div>
</div>
<?php
// $this->EndViewTarget();
$stocks['DATA'] = ob_get_clean();
?>
<?php endif; ?>

<script>
if (RSGoPro_STOCK == 'undefined')
    RSGoPro_STOCK = {};

RSGoPro_STOCK[<?=$arParams['~ELEMENT_ID']?>] = {
    'QUANTITY' : <?=json_encode($arParams['DATA_QUANTITY'])?>,
    'JS' : <?=CUtil::PhpToJSObject($arResult['JS'])?>,
    'USE_MIN_AMOUNT' : <?=($arParams['GOPRO_USE_MIN_AMOUNT'] == 'Y' ? 'true' : 'false')?>,
    'MIN_AMOUNT' : <?=(IntVal($arParams['MIN_AMOUNT']) > 0 ? $arParams['MIN_AMOUNT'] : 0)?>,
    'MESSAGE_ISSET' : <?=CUtil::PhpToJSObject(Loc::getMessage('GOPRO.STORES.QUANTITY.ISSET'.$postfix, array('#ICON#' => $arParams['ICONS']['ISSET'])))?>,
    'MESSAGE_LOW' : <?=CUtil::PhpToJSObject(Loc::getMessage('GOPRO.STORES.QUANTITY.LOW'.$postfix, array('#ICON#' => $arParams['ICONS']['LOW'])))?>,
    'MESSAGE_EMPTY' : <?=CUtil::PhpToJSObject(Loc::getMessage('GOPRO.STORES.QUANTITY.EMPTY'.$postfix, array('#ICON#' => $arParams['ICONS']['EMPTY'])))?>,
    'SHOW_EMPTY_STORE' : <?=($arParams['SHOW_EMPTY_STORE']=='Y' ? 'true' : 'false')?>
};

$(document).on('rsGoPro.document.ready', function(){
	var html = <?=CUtil::PhpToJSObject($stocks)?>;
	$('#stocks_detail_tab').html(html.DATA);
});
</script>
