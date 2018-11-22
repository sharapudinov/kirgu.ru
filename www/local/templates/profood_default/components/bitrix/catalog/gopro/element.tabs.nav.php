<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader,
	Bitrix\Main\Application,
	Bitrix\Main\ModuleManager;
?>

<div class="clear"></div>

<!-- tab navs -->
<ul class="nav nav-tabs js-detail-tabs hidden-print" role="tablist">

	<?php $APPLICATION->ShowViewContent('TABS_HTML_HEADERS'); ?>

	<?php if ($arParams['USE_REVIEW'] == 'Y' && IsModuleInstalled('forum')): ?>
	<li role="presentation"><a href="#review" aria-controls="home" role="tab" data-toggle="tab"><?=GetMessage('TABS_REVIEW')?><?=($arParams['DETAIL_REVIEW_SHOW_COUNT'] == 'Y' ? ' (<span class="js-detailelement-review-count">0</span>)' : '')?></a></li>
	<?php endif; ?>

</ul>
<!-- /tab navs -->
