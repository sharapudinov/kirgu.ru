<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);
?>

<?php if (isset($arResult['SECTION']) && $arResult['SECTION']['DESCRIPTION'] != ''): ?>

	<div class="sectinfo">
		<?php if (isset($arResult['SECTION']['PICTURE']['SRC'])): ?>
			<div class="img clearfix"><img src="<?=$arResult['SECTION']['PICTURE']['SRC']?>" alt="<?=$arResult['SECTION']['PICTURE']['ALT']?>" title="<?=$arResult['SECTION']['PICTURE']['TITLE']?>" /></div>
		<?php endif; ?>
		<div class="description"><?=$arResult['SECTION']['DESCRIPTION']?></div>
	</div>
    
<?php endif; ?>
