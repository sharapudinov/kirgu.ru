<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<?php if ($arParams['USE_STORE'] == 'Y' && $arParams['HIDE_IN_LIST'] != 'Y'): ?>
<div class="list-showcase__stores">
<?php
// stores
include(EXTENDED_PATH_BLOCKS.'/stores.php');
?>
</div>
<?php endif; ?>
