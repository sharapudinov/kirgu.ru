<?php
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>

<div class="tline"></div>

<div id="tpanel" class="tpanel">
    <div class="centering">
        <div class="centeringin clearfix">
            <div class="authandlocation nowrap">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/location.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/auth.php",
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
		"PATH" => SITE_DIR."include/header/topline_menu.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
        </div>
    </div>
</div>

<div id="header" class="header">
    <div class="centering">
        <div class="centeringin clearfix">
            <div class="logo column1">
                <div class="column1inner">
                    <a href="<?=SITE_DIR?>">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/company_logo.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
                    </a>
                </div>
            </div>
            <div class="phone column1 nowrap">
                <div class="column1inner">
                    <svg class="svg-icon"><use xmlns:xlink="http://www.w3.org/1999/xlink" xlink:href="#svg-handphone"></use></svg>
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/phone.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
                </div>
            </div>
            <div class="callback column1 nowrap">
                <div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/nasvyazi.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
                </div>
            </div>
            <div class="favorite column1 nowrap">
                <div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/favorite.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
                </div>
            </div>
            <div class="basket column1 nowrap">
                <div class="column1inner">
<?$APPLICATION->IncludeComponent(
	"bitrix:main.include",
	"",
	array(
		"AREA_FILE_SHOW" => "file",
		"PATH" => SITE_DIR."include/header/basket_small.php",
		"EDIT_TEMPLATE" => ""
	),
	false
);?>
                </div>
            </div>
        </div>
    </div>
    <div class="centering">
        <div class="centeringin clearfix">
			<div class="row">
				<div class="col-lg-12">
					<div class="b-mmenu type2 navbar-default">
						<button type="button" class="b-mmenu__toggle navbar-toggle" data-toggle="collapse" data-target=".navbar-responsive-collapse">
							<span class="full-width-menu">Меню</span>
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
