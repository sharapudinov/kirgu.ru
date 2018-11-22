<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;

$this->setFrameMode(true);

if (!is_array($arResult['SECTIONS']) || count($arResult['SECTIONS']) < 1)
	return;
?>

<?php $this->SetViewTarget('iblock_description'); ?>
<?php if ($arParams['SHOW_IBLOCK_DESCRIPTION'] == 'Y'): ?>
<div class="b-iblock-description <?=($arParams['SECTIONS_DESCRIPTION_POSITION'] == 'top' ? 'top' : 'bottom')?>">
	<div class="row">
		<?php if (!empty($arResult['IBLOCK_FIELDS']['PICTURE'])): ?>
		<div class="col-xs-12 col-sm-4 col-md-3 col-lg-2"><img src="<?=$arResult['IBLOCK_FIELDS']['PICTURE']?>" alt="" title=""></div>
		<div class="col-xs-12 col-sm-8 col-md-9 col-lg-10"><?=$arResult['IBLOCK_FIELDS']['DESCRIPTION']?></div>
		<?php else: ?>
		<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12"><?=$arResult['IBLOCK_FIELDS']['DESCRIPTION']?></div>
		<?php endif;?>
	</div>
</div>
<?php endif; ?>
<?php $this->EndViewTarget(); ?>

<?php $this->SetViewTarget('catalog_section_list_descr'); ?>
	<?php if ($arResult['SECTION']['DESCRIPTION'] != ''): ?>
		<div class="row">
			<div class="col-xs-12">
				<div class="sectinfo">
					<?php if (isset($arResult['SECTION']['PICTURE']['SRC'])): ?>
						<div class="img clearfix"><img src="<?=$arResult['SECTION']['PICTURE']['SRC']?>" alt="<?=$arResult['SECTION']['PICTURE']['ALT']?>" title="<?=$arResult['SECTION']['PICTURE']['TITLE']?>" /></div>
						<div class="description"><?=$arResult['SECTION']['DESCRIPTION']?></div>
					<?php else: ?>
						<div class="description no_img_descr"><?=$arResult['SECTION']['DESCRIPTION']?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	<?php endif; ?>
<?php $this->EndViewTarget(); ?>

<div class="b-section-list clearfix">
	<?php
	if ($arParams['SECTIONS_DESCRIPTION_POSITION'] == 'top') {
		echo $APPLICATION->GetViewContent('iblock_description');
	}
	?>

	<ul class="row list-unstyled">
		<?php
		foreach ($arResult['SECTIONS'] as $key => $arSection):
			if ($arSection['DEPTH_LEVEL'] > $arResult['LEVELING']['FIRST_LEVEL'])
				continue;

			$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT"));
			$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE"), array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM')));
			?>
			<li class="section col-xs-4 col-md-3 col-lg-5rs" id="<?=$this->GetEditAreaId($arSection['ID']);?>">
				<?php
				$img = $arSection['PICTURE']['SRC'];
				if (empty($arSection['PICTURE']['SRC']))
					$img = $arResult['NO_PHOTO']['src'];
				?>
				<a class="around_image" href="<?=$arSection['SECTION_PAGE_URL']?>"><img src="<?=$img?>" alt="<?=$arSection['PICTURE']['ALT']?>" title="<?=$arSection['PICTURE']['TITLE']?>" /></a>
				<a class="parent" href="<?=$arSection['SECTION_PAGE_URL']?>" title="<?=$arSection['NAME']?>"><?=$arSection['NAME']?></a>
			</li>
		<?php endforeach; ?>
	</ul>
	<?php
	if ($arParams['SECTIONS_DESCRIPTION_POSITION'] == 'bottom') {
		echo $APPLICATION->GetViewContent('iblock_description');
	}
	?>
</div>
