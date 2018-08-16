<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-gallery__prices">
<?php
// prices
$params = array(
	'VIEW' => 'list',
	'SHOW_MORE' => 'Y',
	'MAX_SHOW' => 3,
);
if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/prices.php', $getTemplatePathPartParams))) {
	include($path);
}
?>
</div>
