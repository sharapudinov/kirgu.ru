<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;

Loc::loadMessages(__FILE__);

$this->SetViewTarget('autodetect_location_header2');
?>

<span class="location2">
	<?php ShowMessage($arResult['ERROR_MESSAGE']); ?>
	<form class="form" action="<?=$arResult['ACTION_URL']?>" method="POST" id="inheadlocform">
		<?php
		$frame = $this->createFrame('inheadlocform', false)->begin();
		$frame->setBrowserStorage(true);
		?>
			<?=bitrix_sessid_post();?>
			<input type="hidden" name="<?=$arParams['REQUEST_PARAM_NAME']?>" value="Y" />
			<input type="hidden" name="PARAMS_HASH" value="<?=$arParams['PARAMS_HASH']?>" />
			<svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-4x-autodetect"></use></svg>
			<a class="fancyajax fancybox.ajax big" href="<?=SITE_DIR?>include/popup/mycity/" title="<?=Loc::getMessage('RSGOPRO_QUESTION_2')?>"><?
				?><?=$arResult['LOCATION']['CITY_NAME']?><?
			?></a>
		<?php $frame->beginStub(); ?>
			<span><?=Loc::getMessage('RSGOPRO_QUESTION_1')?>: </span>
		<?php $frame->end(); ?>
	</form>
</span>

<?php
$this->EndViewTarget();

$APPLICATION->ShowViewContent('autodetect_location_header2');
