<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$svgBack = '<svg class="svg-icon back"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-arrow-back"></use></svg>';
$linkBack = '<li class="fly-menu__li visible-xs js-fly-menu__back"><a href="#">'.$svgBack.Loc::getMessage('MENU.FLY.BACK').'</a></li>';
?>

<?php if (!empty($arResult)):?>
<ul class="fly-menu fly-menu__ul dropdown-menu list-unstyled js-fly-menu__parent-ul">
<?php
$previousLevel = 0;
foreach ($arResult as $key => $arItem):
	$md5 = md5($key);

	$picture = '';
	if (!empty($arItem['DETAIL_PICTURE'])) {
		$picture ='<img class="fly-menu__picture" src="'.$arItem['DETAIL_PICTURE'].'" alt="" title="">';
	}
	?>
	<?php if ($previousLevel && $arItem['DEPTH_LEVEL'] < $previousLevel): ?>
		<?=str_repeat('</ul></li>', ($previousLevel - $arItem['DEPTH_LEVEL']));?>
	<?php endif; ?>

	<?php if ($arItem['IS_PARENT']): ?>
		<?php if ($arItem["DEPTH_LEVEL"] == 1): ?>
			<li class="fly-menu__li js-fly-menu__parent-li"><a href="<?=$arItem["LINK"]?>" class="js-fly-menu__open-sub <?if ($arItem["SELECTED"]):?>selected<?else:?>root-item<?endif?>"><?=$picture?><span><?=$arItem["TEXT"]?></span><?
				?><svg class="svg-icon arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-right"></use></svg><?
				?></a>
				<ul class="fly-menu__ul fly-menu__sub-menu js-fly-menu__parent-ul dropdown-menu list-unstyled"><?
					?><?=$linkBack?><?
					?><li class="fly-menu__li visible-xs fly-menu__duplication-name"><a href="<?=$arItem["LINK"]?>" class="js-fly-menu__parent-back"><?=$picture?><span><?=$arItem["TEXT"]?></span></a></li>
		<?php else: ?>
			<li class="fly-menu__li js-fly-menu__parent-li"><a href="<?=$arItem["LINK"]?>" class="js-fly-menu__open-sub <?if ($arItem["SELECTED"]):?> selected<?endif?>"><?=$picture?><span><?=$arItem["TEXT"]?></span><?
				?><svg class="svg-icon arrow"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-linear-right"></use></svg><?
				?></a>
				<ul class="fly-menu__ul fly-menu__sub-menu js-fly-menu__parent-ul dropdown-menu list-unstyled"><?
					?><?=$linkBack?><?
					?><li class="fly-menu__li visible-xs fly-menu__duplication-name"><a href="<?=$arItem["LINK"]?>"><?=$picture?><span><?=$arItem["TEXT"]?></span></a></li>
		<?php endif; ?>
	<?php else: ?>
		<?if ($arItem["DEPTH_LEVEL"] == 1):?>
			<li class="fly-menu__li"><a href="<?=$arItem["LINK"]?>" class="<?if ($arItem["SELECTED"]):?>selected<?else:?>root-item<?endif?>"><?=$picture?><span><?=$arItem["TEXT"]?></span></a></li>
		<?else:?>
			<li class="fly-menu__li"><a href="<?=$arItem["LINK"]?>" <?if ($arItem["SELECTED"]):?> class="selected"<?endif?>><?=$picture?><span><?=$arItem["TEXT"]?></span></a></li>
		<?endif?>
	<?php
	endif;

	$previousLevel = $arItem["DEPTH_LEVEL"];

endforeach;


if ($previousLevel > 1): ?>
	<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
<?php endif; ?>

</ul>
<?php endif; ?>
