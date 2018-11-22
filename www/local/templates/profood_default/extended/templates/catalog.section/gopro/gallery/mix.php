<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<!-- mix -->
<div class="list-gallery__mix">

	<div class="list-gallery__stickers hidden-xs">
	<?php
	// stickers
	include(EXTENDED_PATH_COMPONENTS.'/stickers.php');
	?>
	</div>

	<div class="list-gallery__name-rating-article">
		<div class="list-gallery__name-rating">
			<span class="list-gallery__name"><?
			?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
				?><a href="<?=$arItem['DETAIL_PAGE_URL']?>"><?
			?><?php else: ?><?
				?><span><?
			?><?php endif; ?><?
			?><?=$arItem['NAME']?><?
			?><?php if ($arParams['DONT_SHOW_LINKS'] != 'Y'): ?><?
				?></a><?
			?><?php else: ?><?
				?></span><?
			?><?php endif; ?><?
			?></span>
			<span class="list-gallery__rating hidden-xs">
			<?php
			// rating
			include(EXTENDED_PATH_COMPONENTS.'/rating.php');
			?>
			</span>
		</div>
		<div class="list-gallery__article hidden-xs hidden-sm">
		<?php
		// article
		include(EXTENDED_PATH_COMPONENTS.'/article.php');
		?>
		</div>
	</div>

	<div class="list-gallery__compare-favorite hidden-xs">
		<?php if ($arParams['DISPLAY_COMPARE'] == 'Y'): ?>
		<span class="list-gallery__compare">
			<a rel="nofollow" class="c-compare js-add2compare" href="<?=$arItem['COMPARE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-compare-small"></use></svg><span class="c-compare__title"><?=Loc::getMessage('ADD2COMPARE')?></span><span class="c-compare__title-in"><?=Loc::getMessage('ADD2COMPARE_IN')?></span></a>
		</span>
		<?php endif; ?>

		<?php if ($arParams['USE_FAVORITE'] == 'Y'): ?>
		<span class="list-gallery__favorite">
			<a rel="nofollow" class="c-favorite js-add2favorite" href="<?=$arItem['DETAIL_PAGE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite-small"></use></svg><span class="c-favorite__title"><?=Loc::getMessage('FAVORITE')?></span><span class="c-favorite__title-in"><?=Loc::getMessage('FAVORITE_IN')?></span></a>
		</span>
		<?php endif; ?>
	</div>

</div>
