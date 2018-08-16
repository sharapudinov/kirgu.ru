<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
?>

<!-- changelable props -->
<div class="detail__changelable-props">
<?php
// changelable props
if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/changelable_props.php', $getTemplatePathPartParams))) {
    include($path);
}
?>
</div>
<!-- /changelable props -->
