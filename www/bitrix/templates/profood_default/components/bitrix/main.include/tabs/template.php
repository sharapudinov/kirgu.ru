<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Application;
use \Bitrix\Main\Localization\Loc;

$this->setFrameMode(true);

$arParams['AJAX_LOAD'] = 'Y';
$extTabCount = $arParams['TABS_COUNT'];
$uniqPrefix = $this->randString();
$uniqTabPrefix = 'tab'.$uniqPrefix;
?>

<!-- b-tab-component -> <?=$uniqPrefix?> -->
<div class="b-tab-component">

<ul class="nav nav-tabs js-tabs" role="tablist" id="<?=$uniqTabPrefix?>" data-ajax-load="<?=$arParams['AJAX_LOAD']?>">
	<li role="presentation"><a class="js-tab-loaded" href="#<?=$uniqTabPrefix?>__main" role="tab" data-toggle="tab"><?=$arParams['MAIN_TAB_NAME']?></a></li>
	<?php if ($extTabCount > 0): ?>
		<?php for ($i = 0; $i < $extTabCount; $i++): ?>
		<li role="presentation"><a href="#<?=$uniqTabPrefix?>__<?=$i?>" role="tab" data-toggle="tab" data-tab-path="<?=$arParams['TAB_PATH_N'.$i]?>"><?=$arParams['TAB_NAME_N'.$i]?></a></li>
		<?php endfor; ?>
	<?php endif; ?>
</ul>

<div class="tab-content">
	<div role="tabpanel" class="tab-pane" id="<?=$uniqTabPrefix?>__main"><div class="tab-pane-in"><div class="tab-pane-in2"><?php
		if ($arParams['AJAX_LOAD'] != 'Y') {
			include($arResult['FILE']);
		} else {
			include($arResult['FILE']);
		}
	?></div></div></div>
	<?php if ($extTabCount > 0): ?>
		<?php for ($i = 0; $i < $extTabCount; $i++): ?>
		<div role="tabpanel" class="tab-pane" id="<?=$uniqTabPrefix?>__<?=$i?>"><div class="tab-pane-in"><div class="tab-pane-in2 js-tabs__put-content"><?php
		if ($arParams['AJAX_LOAD'] != 'Y') {
			if (file_exists(Application::getDocumentRoot().$arParams['TAB_PATH_N'.$i])) {
				include($arParams['TAB_PATH_N'.$i]);
			} else {
				ShowError('Tab file does not exist');
			}
		} else {
			echo "<div class=\"rs-tabs__preloader\"><div class=\"area2darken\"><i class=\"icon animashka\"></i></div></div>";
		}
		?></div></div></div>
		<?php endfor; ?>
	<?php endif; ?>
</div>

</div>

<script type="text/javascript">
$(document).on('rsGoPro.document.ready', function(){
	$('#<?=$uniqTabPrefix?> a:first').tab('show');
});
</script>
<!-- /b-tab-component -> <?=$uniqPrefix?> -->
