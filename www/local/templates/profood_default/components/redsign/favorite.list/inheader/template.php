<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

?>
<div class="rsfavorite">
	<a id="inheadfavorite" href="<?=SITE_DIR?>personal/favorite/">
		<?php $frame = $this->createFrame('inheadfavorite', false)->begin(); ?>
			<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-favorite-list"></use></svg>
			<div class="title opensansbold"><?=Loc::getMessage('RSGOPRO_TITLE')?></div>
			<div class="descr"><?=Loc::getMessage('RSGOPRO_PRODUCTS')?>&nbsp;(<span id="favorinfo"><?=$arResult['COUNT']?></span>)</div>
		<?php $frame->beginStub(); ?>
			<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-favorite-list"></use></svg>
			<div class="title opensansbold"><?=Loc::getMessage('RSGOPRO_TITLE')?></div>
			<div class="descr"><?=Loc::getMessage('RSGOPRO_PRODUCTS')?>&nbsp;(<span id="favorinfo">0</span>)</div>
		<?php $frame->end(); ?>
	</a>
</div>
