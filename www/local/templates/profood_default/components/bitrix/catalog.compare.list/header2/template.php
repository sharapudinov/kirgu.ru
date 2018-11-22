<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$frame = $this->createFrame('compare', false)->begin();
?>

<a class="compare" href="<?=$arParams["COMPARE_URL"]?>"><?
	?><svg class="svg-icon svg-icon-header"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-compare"></use></svg><?
	?><span class="js-compare-prod-count header__circle"><?=$arResult['COMPARE_CNT']?></span><?
?></a>

<?php
$frame->end();
