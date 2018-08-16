<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use \Bitrix\Main\Application;
?>

<!-- prices note -->
<div class="detail__prices-note">
<?php
// price note
if (file_exists($path = rsGoProGetTemplatePathPart(EXTENDED_PATH_COMPONENTS.'/prices-note.php', $getTemplatePathPartParams))) {
    include($path);
}
?>
</div>
<!-- /prices note -->
