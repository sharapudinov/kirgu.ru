<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

$this->setFrameMode(false);

if (is_array($arResult['ITEMS']) && count($arResult['ITEMS']) > 0):
	foreach ($arResult['ITEMS'] as $arItem):
        
		$haveOffers = (is_array($arItem['OFFERS']) && count($arItem['OFFERS'])>0) ? true : false;
		if($haveOffers)
            $product = &$arItem['OFFERS'][0];
        else
            $product = &$arItem;
        
		?>
        <a href="<?=$arItem['DETAIL_PAGE_URL']?>" class="item catitem">
			<div class="inner clearfix">
				<span class="name">
					<?php
					// get _$strAlt_ and _$strTitle_
					include(EXTENDED_PATH.'/img_alt_title.php');
					?>
					<?php if (isset($arItem['FIRST_PIC']['RESIZE']['src'])): ?>
						<span class="pic"><img class="icon" src="<?=$arItem['FIRST_PIC']['RESIZE']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /></span>
					<?php else :?>
						<span class="pic"><img class="icon" src="<?=$arResult['NO_PHOTO']['src']?>" alt="<?=$strAlt?>" title="<?=$strTitle?>" /></span>
					<?php endif; ?>
					<?=$arItem['NAME']?>
				</span>
				<span class="prs nowrap"><?=$product['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span>
			</div>
		</a>
	<?php endforeach; ?>
<?php endif; ?>
