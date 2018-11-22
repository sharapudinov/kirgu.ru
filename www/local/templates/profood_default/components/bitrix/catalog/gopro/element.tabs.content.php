<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

use Bitrix\Main\Loader,
	Bitrix\Main\Application,
	Bitrix\Main\ModuleManager;
?>

<!-- tabs content -->
<div class="tab-content detail__tabs-content">

<?php $APPLICATION->ShowViewContent('TABS_HTML_CONTENTS'); ?>

<?php if ($arParams['USE_STORE'] == 'Y' && $arParams['SHOW_GENERAL_STORE_INFORMATION'] != 'Y'): ?>
<div role="tabpanel" class="tab-pane" id="stocks">
	<div class="tab-pane-in">
		<div class="tab-pane-in2" id="stocks_detail_tab">
		<?php $APPLICATION->ShowViewContent('TABS_STOCKS'); ?>
		</div>
	</div>
</div>
<?php endif; ?>

<?php if ($arParams['USE_REVIEW'] == 'Y' && IsModuleInstalled('forum')): ?>
<div role="tabpanel" class="tab-pane" id="review">
	<div class="tab-pane-in">
		<div class="tab-pane-in2">
			<div class="add2review-around clearfix"><a class="add2review js-add2review btn-default" href="#addreview"><?=GetMessage('ADD_REVIEW')?></a></div>
			<?$APPLICATION->IncludeComponent(
				'bitrix:forum.topic.reviews',
				'gopro',
				Array(
					"URL_TEMPLATES_DETAIL" => $arParams["REVIEWS_URL_TEMPLATES_DETAIL"],			
					"SHOW_LINK_TO_FORUM" => $arParams["SHOW_LINK_TO_FORUM"],
					"FORUM_ID" => $arParams["FORUM_ID"],
					'IBLOCK_TYPE' => $arParams['IBLOCK_TYPE'],
					'IBLOCK_ID' => $arParams['IBLOCK_ID'],
					'ELEMENT_ID' => $ElementID,
					"URL_TEMPLATES_READ" => $arParams["URL_TEMPLATES_READ"],
					"MESSAGES_PER_PAGE" => $arParams["MESSAGES_PER_PAGE"],
					"PAGE_NAVIGATION_TEMPLATE" => $arParams["PAGE_NAVIGATION_TEMPLATE"],
					"PATH_TO_SMILE" => $arParams["PATH_TO_SMILE"],
					"USE_CAPTCHA" => $arParams["USE_CAPTCHA"],
					"CACHE_TYPE" => $arParams["CACHE_TYPE"],
					"CACHE_TIME" => $arParams["CACHE_TIME"],
					'AJAX_POST' => 'N',
					'AJAX_MODE' => 'N',
				),
				$component,
				array('HIDE_ICONS' => 'Y')
			);?>
		</div>
	</div>
</div>
<?php endif; ?>

</div>
<!-- /tabs content -->
