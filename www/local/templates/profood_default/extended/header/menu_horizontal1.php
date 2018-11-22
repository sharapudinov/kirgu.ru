<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();

use \Bitrix\Main\Localization\Loc;
?>

<!-- menu horizontal1 -->
<div id="menu" class="menu js-menu hidden-print">
	<div class="centering">
		<div class="centeringin clearfix">
			<div class="row">
				<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
					<div class="b-mmenu type2 navbar-default">
						<button type="button" class="b-mmenu__toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="full-width-menu"><?=Loc::getMessage('RSGOPRO.MENU')?></span>
							<span class="icon-toggle">
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
								<span class="icon-bar"></span>
							</span>
						</button>
						<div class="collapse navbar-collapse navbar-responsive-collapse">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/menu.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
						</div>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/search_title2.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /menu horizontal1 -->
