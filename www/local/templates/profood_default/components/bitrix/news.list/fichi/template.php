<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->setFrameMode(true);

$i = 1;
$maxCount = ($arParams['NEWS_COUNT'] > 5) ? 5 : $arParams['NEWS_COUNT'];
?>

<?php if (!empty($arResult['ITEMS'])): ?>
	<div class="fichi">
		<div class="fichi__inner">
			<div class="row">
				<?php foreach($arResult['ITEMS'] as $arItem): ?>
					<?php
					
					if ($i > $maxCount) {
						break;
					}
					
					$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
					$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => Loc::getMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
					
					switch ($maxCount) {
						case 5:
							?><div class="<?=($i == 5 ? 'col-xs-12' : 'col-xs-6')?> <?=($i == 4 || $i == 5 ? 'col-sm-6' : 'col-sm-4')?> col-md-5rs"><?
							break;
						case 4:
							?><div class="col-xs-6 col-sm-3"><?
							break;
						case 3:
							?><div class="<?=($i == 3 ? 'col-xs-12' : 'col-xs-6')?> col-sm-4"><?
							break;
						case 2:
							?><div class="col-xs-6"><?
							break;
						case 1:
							?><div class="col-xs-12"><?
							break;
					}
					?>
						<?php if ($arItem['PROPERTIES'][$arParams['RSGOPRO_LINK']]['VALUE'] != ''): ?>
							<a <?
								?>class="fichi__link" <?
								?>id="<?=$this->GetEditAreaId($arItem['ID']);?>" <?
								if ($arItem['PROPERTIES'][$arParams['RSGOPRO_BLANK']]['VALUE'] != ''):
									?>target="_blank" <?
								endif;
								?>href="<?=$arItem['PROPERTIES'][$arParams['RSGOPRO_LINK']]['VALUE']?>">
						<?php else: ?>
							<div class="fichi__link">
						<?php endif; ?>
							<span class="fichi__img"><img src="<?=$arItem['PREVIEW_PICTURE']['SRC']?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>"></span>
							<span class="fichi__name"><?=$arItem['NAME']?></span>
						<?php if ($arItem['PROPERTIES'][$arParams['RSGOPRO_LINK']]['VALUE'] != ''): ?>
							</a>
						<?php else: ?>
							</div>
						<?php endif; ?>
					</div>
					<?php
					$i++;
					?>
				<?php endforeach;?>
			</div>
		</div>
	</div>
<?php endif; ?>
