<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

use Bitrix\Main\Localization\Loc;

$APPLICATION->SetTitle(Loc::getMessage("SPS_TITLE_MAIN"));
// $APPLICATION->AddChainItem(Loc::getMessage("SPS_CHAIN_MAIN"), $arResult['SEF_FOLDER']);

$theme = Bitrix\Main\Config\Option::get("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);

$availablePages = array();

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ORDERS'],
		"name" => Loc::getMessage("SPS_ORDER_PAGE_NAME"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-calculator"></use></svg>'
	);
}

if ($arParams['SHOW_ACCOUNT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ACCOUNT'],
		"name" => Loc::getMessage("SPS_ACCOUNT_PAGE_NAME"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-wallet"></use></svg>'
	);
}

if ($arParams['SHOW_PRIVATE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PRIVATE'],
		"name" => Loc::getMessage("SPS_PERSONAL_PAGE_NAME"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-profil-1"></use></svg>'
	);
}

if ($arParams['SHOW_ORDER_PAGE'] === 'Y')
{

	$delimeter = ($arParams['SEF_MODE'] === 'Y') ? "?" : "&";
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_ORDERS'].$delimeter."filter_history=Y",
		"name" => Loc::getMessage("SPS_ORDER_PAGE_HISTORY"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-history"></use></svg>'
	);
}

if ($arParams['SHOW_PROFILE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_PROFILE'],
		"name" => Loc::getMessage("SPS_PROFILE_PAGE_NAME"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-list"></use></svg>'
	);
}

if ($arParams['SHOW_BASKET_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_BASKET'],
		"name" => Loc::getMessage("SPS_BASKET_PAGE_NAME"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-cart-1"></use></svg>'
	);
}

if ($arParams['SHOW_SUBSCRIBE_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arResult['PATH_TO_SUBSCRIBE'],
		"name" => Loc::getMessage("SPS_SUBSCRIBE_PAGE_NAME"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-envelope"></use></svg>'
	);
}

if ($arParams['SHOW_CONTACT_PAGE'] === 'Y')
{
	$availablePages[] = array(
		"path" => $arParams['PATH_TO_CONTACT'],
		"name" => Loc::getMessage("SPS_CONTACT_PAGE_NAME"),
		"icon" => '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-contacts"></use></svg>'
	);
}

$customPagesList = CUtil::JsObjectToPhp($arParams['~CUSTOM_PAGES']);
if ($customPagesList)
{
	foreach ($customPagesList as $page)
	{
		$availablePages[] = array(
			"path" => $page[0],
			"name" => $page[1],
			"icon" => (strlen($page[2])) ? '<svg class="icon-svg"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-'.htmlspecialcharsbx($page[2]).'"></use></svg>' : ""
		);
	}
}

if (empty($availablePages))
{
	ShowError(Loc::getMessage("SPS_ERROR_NOT_CHOSEN_ELEMENT"));
}
else
{
	?>
	<div class="row">
		<div class="col-md-12 sale-personal-section-index">
			<div class="row sale-personal-section-row-flex">
				<?
				foreach ($availablePages as $blockElement)
				{
					?>
					<div class="col-lg-4 col-md-6 col-sm-12 col-xs-12">
						<div class="sale-personal-section-index-block bx-theme-<?=$theme?>">
							<a class="sale-personal-section-index-block-link" href="<?=htmlspecialcharsbx($blockElement['path'])?>">
								<span class="sale-personal-section-index-block-ico">
									<?=$blockElement['icon']?>
								</span>
								<h2 class="sale-personal-section-index-block-name">
									<?=htmlspecialcharsbx($blockElement['name'])?>
								</h2>
							</a>
						</div>
					</div>
					<?
				}
				?>
			</div>
		</div>
	</div>
	<?
}
?>
