<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$frame = $this->createFrame('compare', false)->begin();
?>

<a class="favorite" href="<?=SITE_DIR?>personal/favorite/"><?
	?><svg class="svg-icon svg-icon-header"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite"></use></svg><?
	?><span class="js-favorite-prod-count header__circle"><?=$arResult['COUNT']?></span><?
?></a>

<?php
$frame->end();
