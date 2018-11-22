<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
?>

<!-- attributes -->
<div class="detail__attributes">
<?php
// attributes
$params = array(
    'VIEW' => $arParams['DETAIL_SKU_VIEW'],
);
if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/attributes.php', $getTemplatePathPartParams))) {
    include($path);
}
?>
</div>
<!-- /attributes -->
