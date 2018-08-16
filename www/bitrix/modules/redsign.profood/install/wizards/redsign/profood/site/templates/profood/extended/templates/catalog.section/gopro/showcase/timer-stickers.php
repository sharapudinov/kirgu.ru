<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__timer-stickers">
	<div class="list-showcase__timer">
	<?php
	// timer
	include(EXTENDED_PATH_COMPONENTS.'/timer.php');
	?>
	</div>
	<div class="list-showcase__stickers">
	<?php
	// stickers
	include(EXTENDED_PATH_COMPONENTS.'/stickers.php');
	?>
	</div>
</div>
