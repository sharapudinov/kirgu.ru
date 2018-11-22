<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<?php if ($arParams['USE_FAVORITE'] == 'Y'): ?>
<div class="list-showcase__favorite">
	<a rel="nofollow" class="c-favorite js-add2favorite" href="<?=$arItem['DETAIL_PAGE_URL']?>"><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-favorite-small"></use></svg></a>
</div>
<?php endif; ?>
