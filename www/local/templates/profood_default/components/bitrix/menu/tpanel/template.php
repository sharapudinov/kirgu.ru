<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);


if(!empty($arResult))
{
	?><div class="tpanel_menu clearfix mobile_hide"><?
		foreach($arResult as $arItem)
		{
			if($arParams["MAX_LEVEL"] == 1 && $arItem["DEPTH_LEVEL"] > 1) 
				continue;
			$selected=$arItem["SELECTED"]?'selected':'';
			$hot=$arItem['PARAMS']['HOT']?'hot':'';

				?><a href="<?=$arItem["LINK"]?>" class="<?=$selected?> <?=$hot?>"><?=$arItem["TEXT"]?></a><?
		}
	?></div><?
}
