<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-table__name-article">
	<div class="list-table__name"><?
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
	<div class="list-table__article hidden-xs hidden-sm">
	<?php
	// article
	if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/article.php', $getTemplatePathPartParams))) {
		include($path);
	}
	?>
	</div>
</div>
