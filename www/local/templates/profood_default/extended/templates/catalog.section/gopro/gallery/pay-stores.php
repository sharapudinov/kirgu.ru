<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<?php if (!$haveOffers): ?>
<div class="list-gallery__pay-stores">

	<?php
	if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/pay.php', $getTemplatePathPartParams))) {
		include($path);
	}

	if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/stores.php', $getTemplatePathPartParams))) {
		include($path);
	}
	?>
</div>
<?php else: ?>
<?php
if (file_exists($path = rsGoProGetTemplatePathPart(__DIR__.'/more.php', $getTemplatePathPartParams))) {
	include($path);
}
?>
<?php endif; ?>
