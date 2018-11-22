<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$frame = $this->createFrame('compare', false)->begin();
?>

<a class="basketline" href="<?=$arParams["PATH_TO_BASKET"]?>"><svg class="svg-icon svg-icon-header"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-cart"></use></svg><span class="hidden-xs hidden-sm"><?=Loc::getMessage('RSGOPRO.SMALLBASKET_TITLE')?></span> <span class="js-basket-prod-count header__circle"><?=$arResult['NUM_PRODUCTS']?></span></a>

<?php
$frame->end();
