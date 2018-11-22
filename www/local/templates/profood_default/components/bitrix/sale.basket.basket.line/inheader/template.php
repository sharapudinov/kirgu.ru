<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);
?>

<div class="header-basket">
	<a class="header-basket__link" href="<?=$arParams['PATH_TO_BASKET']?>">
		<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cart-3"></use></svg>
		<div class="header-basket__info">
			<div class="header-basket__title opensansbold"><?=Loc::getMessage('RSGOPRO.SMALLBASKET_TITLE')?></div>
			<div id="basketinfo" class="header-basket__descr"><?
				?><?php $frame = $this->createFrame('basketinfo', false)->begin(); ?><?
					?><?php if ($arResult['NUM_PRODUCTS'] > 0): ?><?
						?><?=$arResult["NUM_PRODUCTS"]?> <?=$arResult['PRODUCT(S)']?> <?=Loc::getMessage('RSGOPRO.SMALLBASKET_NA')?> <?=$arResult['TOTAL_PRICE']?><?
					?><?php else: ?><?
						?><?=Loc::getMessage('RSGOPRO.SMALLBASKET_PUSTO'); ?><?
					?><?php endif; ?><?
				?><?php $frame->beginStub(); ?><?
					?><?=Loc::getMessage('RSGOPRO.SMALLBASKET_PUSTO'); ?><?
				?><?php $frame->end(); ?><?
			?></div>
		</div>
	</a>
</div>
