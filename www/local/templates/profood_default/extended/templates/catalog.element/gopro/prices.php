<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application,
    \Bitrix\Main\Localization\Loc;

?>

<!-- prices -->
<div class="detail__prices">
    <span class="detail__prices__title"><?=Loc::getMessage('SOLOPRICE_PRICE')?></span>
<?php
// prices
$params = array(
    'PAGE' => 'detail',
    'VIEW' => 'list',
    'SHOW_MORE' => 'N',
    'USE_ALONE' => 'Y',
    'MAX_SHOW' => 15,
    'SHOW_DISCOUNT_NAME' => 'Y',
    'SHOW_DISCOUNT_DIFF' => 'Y',
    'SHOW_OLD_PRICE' => 'Y',
);
if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/prices.php', $getTemplatePathPartParams))) {
    include($path);
}
?>
</div>
<!-- /prices -->
