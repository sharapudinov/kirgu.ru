<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-gallery__pay">
<?php
$arParams['USE_PRODUCT_QUANTITY'] = 'N';
// pay
if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_BLOCKS.'/pay.php', $getTemplatePathPartParams))) {
	include($path);
}
?><?
?></div><?
