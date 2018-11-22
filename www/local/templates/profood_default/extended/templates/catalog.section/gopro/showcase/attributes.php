<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__attributes">
<?php
// attributes
$params = array(
	'VIEW' => $arParams['LIST_SKU_VIEW'],
);
include(EXTENDED_PATH_COMPONENTS.'/attributes.php');
?>
</div>
