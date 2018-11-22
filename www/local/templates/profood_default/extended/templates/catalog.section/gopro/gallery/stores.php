<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;


if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y'):
	?><div class="list-gallery__stores"><?
	// stores
	if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/stores.php', $getTemplatePathPartParams))) {
		include($path);
	}
	?>
	</div>
<?php endif;
