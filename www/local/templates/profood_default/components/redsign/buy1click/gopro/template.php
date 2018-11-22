<?php
if (!defined("B_PROLOG_INCLUDED")||B_PROLOG_INCLUDED !== true)
	die();
?>

<?php if ($arResult['LAST_ERROR'] != ''): ?>
	<?php ShowError($arResult["LAST_ERROR"]); ?>
<?php endif; ?>

<?php if ($arResult['GOOD_SEND'] == 'Y'): ?>
	<?php ShowMessage(array('MESSAGE' => $arResult['GOOD_ORDER_TEXT'], 'TYPE' => 'OK')); ?>
	<script type="text/javascript">
		setTimeout(function(){
			$.fancybox.close();
		}, 2500);
	</script>
<?php endif; ?>

<div class="someform clearfix">
	<form action="<?=$arResult['ACTION_URL']?>" method="POST">
		
		<?=bitrix_sessid_post()?>
		<input type="hidden" name="<?=$arParams['REQUEST_PARAM_NAME']?>" value="Y" />
		<input type="hidden" name="PARAMS_HASH" value="<?=$arResult['PARAMS_HASH']?>">

		<?php foreach ($arResult['SYSTEM_FIELDS'] as $arField): ?>
			<input type="hidden" name="<?=$arField['CODE']?>" value="<?=$arField['HTML_VALUE']?>">
		<?php endforeach; ?>
		
		<?php foreach ($arResult['SHOW_FIELDS'] as $arField): ?>
			<div class="line clearfix">
				<input class="b1c-field<?=(strpos($arField['CODE'], 'PHONE') !== false ? ' maskPhone' : '')?>" type="text" name="<?=$arField['CODE']?>" value="<?=$arField['HTML_VALUE']?>" placeholder="<?=$arField['NAME']?><?if($arField['REQUIRED_FIELDS'] == 'Y'):?>*<?endif;?>" />
			</div>
		<?php endforeach; ?>
		
		<?php if ($arParams['ALFA_USE_CAPTCHA'] == 'Y'): ?>
			<div class="line captcha clearfix">
				<input type="hidden" name="captcha_sid" value="<?=$arResult['CATPCHA_CODE']?>">
				<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CATPCHA_CODE']?>" width="180" height="40" alt="CAPTCHA">
				<input type="text" name="captcha_word" size="30" maxlength="50" value="" placeholder="<?=GetMessage('MSG_CAPTHA')?>*" />
			</div>
		<?php endif; ?>

		<?php
		global $licenseWorkLinkFull;
		echo $licenseWorkLinkFull;
		?>
		
		<div class="line buttons clearfix">
			<input class="btn btn1" type="submit" name="submit" value="<?=GetMessage('MSG_SUBMIT')?>">
		</div>
		
	</form>
	
</div>
