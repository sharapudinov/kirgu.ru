<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

$this->setFrameMode(true);
?>

<?php if (count($arResult['ITEMS']) > 0): ?>

	<?php if ($arParams['DISPLAY_TOP_PAGER']): ?>
		<?=$arResult['NAV_STRING']?>
	<?php endif; ?>
	
	<div class="container1">
		<div class="brandslist clearfix<?if($arParams['ADD_STYLES_FOR_MAIN']=='Y'):?> mainstyles<?endif;?>">
			<?php
			$index = 1;
			$maxSepNum = 7;
			?>
			<?php if ($arParams['ADD_STYLES_FOR_MAIN'] == 'Y'): ?>
				<div class="title"><h3><a href="<?=$arParams['BRAND_PAGE']?>"><?=GetMessage('BRAND_TITLE')?></a></h3></div>
			<?php endif; ?>
			
			<div class="row">
				<?php foreach ($arResult['DIGITAL'] as $BUKVA => $arData): ?>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 bukva">
						<span class="h2"><?=$BUKVA?></span>
						<?php
						foreach ($arData['ITEMS'] as $key => $arItem): ?>
							<?php
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="subitem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
				
				<?php foreach ($arResult['ENG_LETTER'] as $BUKVA => $arData): ?>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 bukva">
						<span class="h2"><?=$BUKVA?></span>
						<?php
						$count = 0;
						foreach ($arData['ITEMS'] as $key => $arItem): ?>
							<?php
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="subitem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
							</div>
						<?php endforeach; ?>
					</div>
				<?php endforeach; ?>
				
				<?php foreach ($arResult['RUS_LETTER'] as $BUKVA => $arData): ?>
					<div class="col-lg-2 col-md-2 col-sm-3 col-xs-6 bukva">
						<span class="h2"><?=$BUKVA?></span>
						<?php
						$count = 0;
						foreach ($arData['ITEMS'] as $key => $arItem): ?>
							<?php
							$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_EDIT'));
							$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem['IBLOCK_ID'], 'ELEMENT_DELETE'), array('CONFIRM' => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
							?>
							<div class="subitem" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
								<a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?=$arItem['NAME']?></a>
							</div>
							<?php
							$count++;
							if (IntVal($arParams['COUNT_ITEMS']) > 0 && ($count + 1) > IntVal($arParams['COUNT_ITEMS'])):
								$count=0;
								break;
							endif;
						endforeach; ?>
					</div>
				<?php endforeach; ?>
			</div>
			
		</div>
	</div>
	
	<?php if ($arParams['DISPLAY_BOTTOM_PAGER']): ?>
		<?=$arResult['NAV_STRING']?>
	<?php endif; ?>
<?php endif; ?>
