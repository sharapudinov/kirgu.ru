<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

?>
<div class="location">
	<?php ShowMessage($arResult['ERROR_MESSAGE']); ?>
	<form action="<?=$arResult['ACTION_URL']?>" method="POST" id="inheadlocform">
		<?php
		$frame = $this->createFrame('inheadlocform',false)->begin();
		$frame->setBrowserStorage(true);
		?>
			<?=bitrix_sessid_post();?>
			<input type="hidden" name="<?=$arParams['REQUEST_PARAM_NAME']?>" value="Y" />
			<input type="hidden" name="PARAMS_HASH" value="<?=$arParams['PARAMS_HASH']?>" />
			<span><?=GetMessage('RSGOPRO_QUESTION_1')?>: </span><?
			?><a class="fancyajax fancybox.ajax big" href="<?=SITE_DIR?>include/popup/mycity/" title="<?=GetMessage('RSGOPRO_QUESTION_2')?>"><?=$arResult['LOCATION']['CITY_NAME']?><?
				?><svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-arrow-filled-down"></use></svg><?
			?></a>
		<?php $frame->beginStub(); ?>
			<span><?=GetMessage('RSGOPRO_QUESTION_1')?>: </span>
		<?php $frame->end(); ?>
	</form>
</div>
