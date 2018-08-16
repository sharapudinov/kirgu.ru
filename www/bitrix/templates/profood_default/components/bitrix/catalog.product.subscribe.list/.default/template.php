<?php
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
	die();

/** @var CBitrixComponentTemplate $this */
/** @var array $arParams */
/** @var array $arResult */
/** @global CDatabase $DB */
/** @global CMain $APPLICATION */

use Bitrix\Main\Localization\Loc;

$randomString = $this->randString();

$APPLICATION->setTitle(Loc::getMessage('CPSL_SUBSCRIBE_TITLE_NEW'));
if(!$arResult['USER_ID'] && !isset($arParams['GUEST_ACCESS'])):?>
	<?
	$contactTypeCount = count($arResult['CONTACT_TYPES']);
	$authStyle = 'display: block;';
	$identificationStyle = 'display: none;';
	if(!empty($_GET['result']))
	{
		$authStyle = 'display: none;';
		$identificationStyle = 'display: block;';
	}
	?>
	<div class="row">
		<div class="col-md-8 col-sm-7">
			<p class="alert alert-danger"><?=Loc::getMessage('CPSL_SUBSCRIBE_PAGE_TITLE_AUTHORIZE')?></p>
		</div>
		<? $authListGetParams = array(); ?>
		<div class="col-md-8 col-sm-7" id="catalog-subscriber-auth-form" style="<?=$authStyle?>">
			<?$APPLICATION->authForm('', false, false, 'N', false);?>
		</div>
		<?$APPLICATION->setTitle(Loc::getMessage('CPSL_TITLE_PAGE_WHEN_ACCESSING'));?>
		<div id="catalog-subscriber-identification-form" style="<?=$identificationStyle?>">
		<div class="col-md-8 col-sm-7 catalog-subscriber-identification-form">
			<h3><?=Loc::getMessage('CPSL_HEADLINE_FORM_SEND_CODE')?></h3>
			<form method="post">
				<?=bitrix_sessid_post()?>
				<input type="hidden" name="siteId" value="<?=SITE_ID?>">
				<?if($contactTypeCount > 1):?>
					<div class="form-group">
						<label for="contactType"><?=Loc::getMessage('CPSL_CONTACT_TYPE_SELECTION')?></label>
						<select id="contactType" class="form-control" name="contactType">
							<?foreach($arResult['CONTACT_TYPES'] as $contactTypeData):?>
								<option value="<?=intval($contactTypeData['ID'])?>">
									<?=htmlspecialcharsbx($contactTypeData['NAME'])?></option>
							<?endforeach;?>
						</select>
					</div>
				<?endif;?>
				<div class="form-group">
					<?
						$contactLable = Loc::getMessage('CPSL_CONTACT_TYPE_NAME');
						$contactTypeId = 0;
						if($contactTypeCount == 1)
						{
							$contactType = current($arResult['CONTACT_TYPES']);
							$contactLable = $contactType['NAME'];
							$contactTypeId = $contactType['ID'];
						}
					?>
					<input type="text" class="form-control" name="userContact" id="contactInput" placeholder="<?=htmlspecialcharsbx($contactLable)?>">
					<input type="hidden" name="subscriberIdentification" value="Y">
					<?if($contactTypeId):?>
						<input type="hidden" name="contactType" value="<?=$contactTypeId?>">
					<?endif;?>
				</div>
				<button type="submit" class="btn btn1"><?=Loc::getMessage('CPSL_BUTTON_SUBMIT_CODE')?></button>
			</form>
		</div>
		<div class="col-md-8 col-sm-7">
			<h3><?=Loc::getMessage('CPSL_HEADLINE_FORM_FOR_ACCESSING')?></h3>
			<form method="post">
				<?=bitrix_sessid_post()?>
				<div class="form-group">
					<input type="text" class="form-control" name="userContact" id="contactInput" value=
						"<?=!empty($_GET['contact']) ? htmlspecialcharsbx(urldecode($_GET['contact'])): ''?>" placeholder="<?=htmlspecialcharsbx($contactLable)?>">
				</div>
				<div class="form-group">
					<input type="text" class="form-control" name="subscribeToken" id="token" placeholder="<?=Loc::getMessage('CPSL_CODE_LABLE')?>">
					<input type="hidden" name="accessCodeVerification" value="Y">
				</div>
				<button type="submit" class="btn btn1"><?=Loc::getMessage('CPSL_BUTTON_SUBMIT_ACCESS')?></button>
			</form>
		</div>
		</div>
	</div>
	<script type="text/javascript">
		BX.ready(function() {
			if(BX('cpsl-auth'))
			{
				BX.bind(BX('cpsl-auth'), 'click', BX.delegate(showAuthForm, this));
				BX.bind(BX('cpsl-identification'), 'click', BX.delegate(showAuthForm, this));
			}
			function showAuthForm()
			{
				var formType = BX.proxy_context.id.replace('cpsl-', '');
				var authForm = BX('catalog-subscriber-auth-form'),
					codeForm = BX('catalog-subscriber-identification-form');
				if(!authForm || !codeForm || !BX('catalog-subscriber-'+formType+'-form')) return;

				BX.style(authForm, 'display', 'none');
				BX.style(codeForm, 'display', 'none');
				BX.style(BX('catalog-subscriber-'+formType+'-form'), 'display', '');
			}
		});
	</script>
<?endif;


if (!empty($arResult['ITEMS'])) {
	include(EXTENDED_PATH_TEMPLATES.'/catalog.section/gopro/template.php');
} else {
	if(isset($arParams['GUEST_ACCESS'])):
		echo '<span class="alert alert-danger">'.Loc::getMessage('CPSL_SUBSCRIBE_NOT_FOUND').'</span>';
	endif;
}
