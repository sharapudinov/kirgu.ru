<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(true);
?>

<?php if (is_array($arResult['SECTIONS']) && count($arResult['SECTIONS']) > 0): ?>
	<?php $index = 1; ?>
	<div class="brandbig clearfix">
		<?php foreach ($arResult['SECTIONS'] as $arSection): ?>
			<div class="item">
				<a class="img" href="<?=$arSection['SECTION_PAGE_URL']?>">
					<?php if (isset($arSection['PICTURE']['RESIZE']['src'])): ?>
						<img src="<?=$arSection['PICTURE']['RESIZE']['src']?>" alt="" title="" />
					<?php else: ?>
						<img src="<?=$arResult['NO_PHOTO']['src']?>" alt="" title="" />
					<?php endif; ?>
				</a>
				<a class="name" href="<?=$arSection['SECTION_PAGE_URL']?>"><?=$arSection['NAME']?></a>
			</div>
			<div class="separator x<?=$index?>"></div>
            <?php
			$index++;
            if ($index > 4) {
                $index = 1;
            }
            ?>
		<?php endforeach; ?>
	</div>
<?php endif; ?>
