<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
	\Bitrix\Main\Localization\Loc;

?>

<div class="list-showcase__pay<?=($haveOffers ? ' hidden-xs hidden-sm' : '')?> hidden-print">
<?php
$arParams['USE_PRODUCT_QUANTITY'] = 'N';
// pay
include(EXTENDED_PATH_BLOCKS.'/pay.php');
?>
</div>
