<?if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();
/**
 * @global array $arParams
 * @global CUser $USER
 * @global CMain $APPLICATION
 * @global string $cartId
 */
$compositeStub = (isset($arResult['COMPOSITE_STUB']) && $arResult['COMPOSITE_STUB'] == 'Y');
?>
<?if (!$compositeStub && $arParams['SHOW_AUTHOR'] == 'Y'):?>
   <? ob_start();?>
    <ul class="profile-links">
		<?if ($USER->IsAuthorized()):
			$name = trim($USER->GetFullName());
			if (! $name)
				$name = trim($USER->GetLogin());
			if (strlen($name) > 15)
				$name = substr($name, 0, 12).'...';
			?>
        <li>
			<a href="<?=$arParams['PATH_TO_PROFILE']?>"><?=htmlspecialcharsbx($name)?></a>
        </li>&nbsp;
        <li>
			<a href="?logout=yes"><?=GetMessage('TSB1_LOGOUT')?></a>
        </li>
		<?else:
			$arParamsToDelete = array(
				"login",
				"login_form",
				"logout",
				"register",
				"forgot_password",
				"change_password",
				"confirm_registration",
				"confirm_code",
				"confirm_user_id",
				"logout_butt",
				"auth_service_id",
				"clear_cache"
			);

			$currentUrl = urlencode($APPLICATION->GetCurPageParam("", $arParamsToDelete));
			if ($arParams['AJAX'] == 'N')
			{
				?><script type="text/javascript"><?=$cartId?>.currentUrl = '<?=$currentUrl?>';</script><?
			}
			else
			{
				$currentUrl = '#CURRENT_URL#';
			}
			?>
            <li>
			<a href="<?=$arParams['PATH_TO_AUTHORIZE']?>?login=yes&backurl=<?=$currentUrl; ?>">
				<?=GetMessage('TSB1_LOGIN')?>
			</a>
            </li>
			<?
			if ($arParams['SHOW_REGISTRATION'] === 'Y')
			{
				?>
            <li>
				<a href="<?=$arParams['PATH_TO_REGISTER']?>?register=yes&backurl=<?=$currentUrl; ?>">
					<?=GetMessage('TSB1_REGISTER')?>
				</a>
            </li>
				<?
			}
			?>
		<?endif?>
    </ul>
    <?$APPLICATION->SetPageProperty('profile-links',ob_get_clean())?>
<?endif?>
			<a href="<?= $arParams['PATH_TO_BASKET'] ?>">
            <i class="sprite-common basket"></i>
            <?= GetMessage('TSB1_CART') ?>
            <?

		if (!$compositeStub)
		{
			if ($arParams['SHOW_NUM_PRODUCTS'] == 'Y' && ($arResult['NUM_PRODUCTS'] > 0 || $arParams['SHOW_EMPTY_VALUES'] == 'Y'))
			{
				echo '<b id="korzina_kol">'.$arResult['NUM_PRODUCTS'].' '.$arResult['PRODUCT(S)'].'</b>';
			}
		}
		?>
            </a>
