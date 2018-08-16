<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

// is auth page
$isAuth = 'Y';
if (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'auth/') === false)
	$isAuth = 'N';

// is personal
$isPersonal = 'Y';
if (strpos($APPLICATION->GetCurPage(true), SITE_DIR.'personal/') === false)
	$isPersonal = 'N';

?>

<div class="pcontent<?if($isAuth == 'Y' || $isPersonal == 'Y'):?> thisisauthpage<?endif;?>">

	<div class="someform register clearfix<?if($arResult['SECURE_AUTH']):?> secure<?endif;?>">
		
		<?php ShowMessage($arParams['~AUTH_RESULT']); ?>
		
		<?php if ($arResult['USE_EMAIL_CONFIRMATION'] === 'Y' && is_array($arParams['AUTH_RESULT']) &&  $arParams['AUTH_RESULT']['TYPE'] === 'OK'): ?>
			<?php ShowMessage(GetMessage('AUTH_EMAIL_SENT')); ?>
		<?php endif; ?>
		
		<form method="post" action="<?=$arResult['AUTH_URL']?>" name="bform">
			
			<?php if (strlen($arResult['BACKURL']) > 0): ?>
				<input type="hidden" name="backurl" value="<?=$arResult['BACKURL']?>" />
			<?php endif; ?>
			
			<input type="hidden" name="AUTH_FORM" value="Y" />
			<input type="hidden" name="TYPE" value="REGISTRATION" />
			
			<div class="line clearfix">
				<input type="text" name="USER_NAME" maxlength="50" value="<?=$arResult['USER_NAME']?>" placeholder="<?=GetMessage('AUTH_NAME')?>" />
			</div>
			
			<div class="line clearfix">
				<input type="text" name="USER_LAST_NAME" maxlength="50" value="<?=$arResult['USER_LAST_NAME']?>" placeholder="<?=GetMessage('AUTH_LAST_NAME')?>" />
			</div>
			
			<div class="line clearfix">
				<input type="text" name="USER_LOGIN" maxlength="50" value="<?=$arResult['USER_LOGIN']?>" placeholder="<?=GetMessage('AUTH_LOGIN_MIN')?>*" />
			</div>
			
			<div class="line password clearfix">
				<input class="text" type="password" name="USER_PASSWORD" maxlength="50" value="<?=$arResult['USER_PASSWORD']?>" placeholder="<?=GetMessage('AUTH_PASSWORD_REQ')?>*" />
			</div>
			
			<?php if ($arResult['SECURE_AUTH']): ?>
				<div class="line">
					<noscript><?php ShowError(GetMessage('AUTH_NONSECURE_NOTE')); ?></noscript>
				</div>
			<?php endif; ?>
			
			<div class="line clearfix">
				<input type="password" name="USER_CONFIRM_PASSWORD" maxlength="50" value="<?=$arResult['USER_CONFIRM_PASSWORD']?>" placeholder="<?=GetMessage('AUTH_CONFIRM')?>*" />
			</div>
			
			<div class="line clearfix">
				<input type="text" name="USER_EMAIL" maxlength="255" value="<?=$arResult['USER_EMAIL']?>" placeholder="<?=GetMessage('AUTH_EMAIL')?><?if($arResult['EMAIL_REQUIRED']):?>*<?endif;?>" />
			</div>
			
			<!-- ********************* User properties *************************************************** -->
			<?php if ($arResult['USER_PROPERTIES']['SHOW'] == 'Y'): ?>
				<?php foreach ($arResult['USER_PROPERTIES']['DATA'] as $FIELD_NAME => $arUserField): ?>
					<div class="line clearfix field_<?=$FIELD_NAME?>" title="<?=$arUserField['EDIT_FORM_LABEL']?><?if($arUserField['MANDATORY']=='Y'):?>*<?endif;?>">
						<?$APPLICATION->IncludeComponent(
							'bitrix:system.field.edit',
							$arUserField['USER_TYPE']['USER_TYPE_ID'],
							array(
								'bVarsFromForm' => $arResult['bVarsFromForm'],
								'arUserField' => $arUserField,
								'form_name' => 'bform'
							),
							null,
							array('HIDE_ICONS'=>'Y')
						);?>
						<script>$('.field_<?=$FIELD_NAME?>').find('input,textarea,select').attr('placeholder','<?=CUtil::JSEscape($arUserField['EDIT_FORM_LABEL'])?>:<?if($arUserField['MANDATORY']=='Y'):?>*<?endif;?>');</script>
					</div>
				<?php endforeach; ?>
			<?php endif; ?>
			<!-- // ******************** /User properties *************************************************** -->
			
			<!-- // CAPTCHA -->
			<?php if ($arResult['USE_CAPTCHA'] == 'Y'): ?>
				<div class="line captcha clearfix">
					<input type="hidden" name="captcha_sid" value="<?=$arResult['CAPTCHA_CODE']?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?=$arResult['CAPTCHA_CODE']?>" width="180" height="40" alt="CAPTCHA" />
					<input class="text" type="text" name="captcha_word" maxlength="50" value="" placeholder="<?=GetMessage('CAPTCHA_REGF_PROMT')?>*" />
				</div>
			<?php endif; ?>
			<!-- // /CAPTCHA -->

			<?php
			global $licenseWorkLinkFull;
			echo $licenseWorkLinkFull;
			?>

			<div class="line buttons clearfix">
				<input class="btn btn1" type="submit" name="Register" value="<?=GetMessage('AUTH_REGISTER')?>" />
			</div>
			
			<div class="line notes clearfix">
				<div><?=$arResult['GROUP_POLICY']['PASSWORD_REQUIREMENTS'];?></div>
				<div>* <?=GetMessage('AUTH_REQ')?></div>
				<div><a href="<?=$arResult['AUTH_AUTH_URL']?>" rel="nofollow"><?=GetMessage('AUTH_AUTH')?></a></div>
			</div>
			
		</form>
		
	</div>

</div>

<script type="text/javascript">
document.bform.USER_NAME.focus();
</script>
