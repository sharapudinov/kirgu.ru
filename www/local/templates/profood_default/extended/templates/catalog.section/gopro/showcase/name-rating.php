<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__name-rating">

	<div class="list-showcase__name"><?
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
	?></div>

	<div class="list-showcase__rating">
	<?php
	// rating
	include(EXTENDED_PATH_COMPONENTS.'/rating.php');
	?>
	</div>

</div>
