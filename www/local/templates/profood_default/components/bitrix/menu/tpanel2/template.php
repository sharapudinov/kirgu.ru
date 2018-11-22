<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<?php if (!empty($arResult)): ?>
<span class="tpanel__menu2 text-right clearfix">
	<?php
	foreach ($arResult as $arItem) {
		if ($arParams['MAX_LEVEL'] == 1 && $arItem['DEPTH_LEVEL'] > 1) 
			continue;
		
		$svgIcon = '';
		if (!empty($arItem['PARAMS']['SVGICON'])) {
			$svgIcon = '<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#'.$arItem['PARAMS']['SVGICON'].'"></use></svg>';
		}
		
		if ($arItem['SELECTED']) {
			?><a href="<?=$arItem['LINK']?>" class="selected"><?=$svgIcon?><?=$arItem['TEXT']?></a><?
		} else {
			?><a href="<?=$arItem['LINK']?>"><?=$svgIcon?><?=$arItem['TEXT']?></a><?
		}
	}
?></span>
<?php endif; ?>
