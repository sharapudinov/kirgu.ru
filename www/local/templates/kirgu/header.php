<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die();
IncludeTemplateLangFile($_SERVER["DOCUMENT_ROOT"] . "/bitrix/templates/" . SITE_TEMPLATE_ID . "/header.php");
CJSCore::Init(array("fx"));
$curPage = $APPLICATION->GetCurPage(true);
$theme = COption::GetOptionString("main", "wizard_eshop_bootstrap_theme_id", "blue", SITE_ID);
?>
<!DOCTYPE html>
<html xml:lang="<?= LANGUAGE_ID ?>" lang="<?= LANGUAGE_ID ?>">
<head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge"/>
    <meta name="viewport" content="user-scalable=no, initial-scale=1.0, maximum-scale=1.0, width=device-width">
    <link rel="shortcut icon" type="image/x-icon" href="<?= htmlspecialcharsbx(SITE_DIR) ?>favicon.ico"/>
    <? $APPLICATION->ShowHead(); ?>
    <title><? $APPLICATION->ShowTitle() ?></title>
</head>
<body class="cms-index-index cms-home">
<div id="panel"><? $APPLICATION->ShowPanel(); ?></div>

<div class="wrapper">
    <div class="page">
        <a class="page-up-button" href="#" style="display: block;">
            <i class="sprite-common page-up"></i>
        </a>
        <header id="header" class="page-header">
            <div class="top-line">
                <div class="container">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:menu",
                        "top_menu",
                        array(
                            "ROOT_MENU_TYPE" => "top",
                            "MENU_CACHE_TYPE" => "A",
                            "MENU_CACHE_TIME" => "36000000",
                            "MENU_CACHE_USE_GROUPS" => "Y",
                            "MENU_THEME" => "site",
                            "CACHE_SELECTED_ITEMS" => "N",
                            "MENU_CACHE_GET_VARS" => array(),
                            "MAX_LEVEL" => "3",
                            "CHILD_MENU_TYPE" => "left",
                            "USE_EXT" => "Y",
                            "DELAY" => "N",
                            "ALLOW_MULTI_SELECT" => "N",
                            "COMPONENT_TEMPLATE" => "top_menu"
                        ),
                        false
                    ); ?>
                    <ul class="top_phone_time">
                        <li class="phone">
                            <? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/telephone.php"), false); ?>
                        </li>
                        <li class="work_time"><? $APPLICATION->IncludeComponent("bitrix:main.include", "", array("AREA_FILE_SHOW" => "file", "PATH" => SITE_DIR . "include/schedule.php"), false); ?>
                        </li>
                    </ul>
                    <? $APPLICATION->ShowProperty('profile-links') ?>

                    <ul class="our-mag">
                        <li onclick="jQuery(this).find('ul').toggle()"><a>Адреса магазинов</a>
                            <ul>
                                <li><a href="/karabudahkentskoe_d_1">г. Махачкала, ш. Карабудахкентское д. 1</a></li>
                                <li><a href="/karabudahkentskoe_d_11">г. Махачкала, ш. Карабудахкентское д. 11</a></li>
                                <li><a href="/engelsa-1-b">г.Махачкала, ул. Энгельса, 1 "Б"</a></li>
                                <li><a href="/reduktorniy-td-apelsin">г.Махачкала, пос. Редукторный, ТД АПЕЛЬСИН</a>
                                </li>
                                <li><a href="/khasavurt-makhachkalinskoe-shosse">г.Хасавюрт, Махачкалинское шоссе</a>
                                </li>
                                <li><a href="/khasavurt-naberejnaya">г.Хасавюрт, ул.Набережная, 20</a></li>
                                <li><a href="/derbent">г.Дербент, трасса Ростов-Баку, 938 км</a></li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="main-line">
                <a href="/" class="mobile-nav-toggle"><b></b></a>
                <a href="/">
                    <span class="logo"></span>
                </a>
                <? $APPLICATION->IncludeComponent("bitrix:search.title", "kirgu", array(
                                    "NUM_CATEGORIES" => "1",
                                    "TOP_COUNT" => "5",
                                    "CHECK_DATES" => "N",
                                    "SHOW_OTHERS" => "N",
                                    "PAGE" => SITE_DIR . "catalog/",
                                    "CATEGORY_0_TITLE" => GetMessage("SEARCH_GOODS"),
                                    "CATEGORY_0" => array(
                                        0 => "iblock_catalog",
                                    ),
                                    "CATEGORY_0_iblock_catalog" => array(
                                        0 => "all",
                                    ),
                                    "CATEGORY_OTHERS_TITLE" => GetMessage("SEARCH_OTHER"),
                                    "SHOW_INPUT" => "Y",
                                    "INPUT_ID" => "title-search-input",
                                    "CONTAINER_ID" => "search",
                                    "PRICE_CODE" => array(
                                        0 => "BASE",
                                    ),
                                    "SHOW_PREVIEW" => "Y",
                                    "PREVIEW_WIDTH" => "75",
                                    "PREVIEW_HEIGHT" => "75",
                                    "CONVERT_CURRENCY" => "Y"
                                )
                );?>

                <div class="cart-wrappaer">
                    <? $APPLICATION->IncludeComponent(
                        "bitrix:sale.basket.basket.line",
                        "kirgu",
                        array(
                            "PATH_TO_BASKET" => SITE_DIR . "personal/cart/",
                            "PATH_TO_PERSONAL" => SITE_DIR . "personal/",
                            "SHOW_PERSONAL_LINK" => "N",
                            "SHOW_NUM_PRODUCTS" => "Y",
                            "SHOW_TOTAL_PRICE" => "Y",
                            "SHOW_PRODUCTS" => "Y",
                            "POSITION_FIXED" => "N",
                            "SHOW_AUTHOR" => "Y",
                            "PATH_TO_REGISTER" => SITE_DIR . "login/",
                            "PATH_TO_PROFILE" => SITE_DIR . "personal/",
                            "COMPONENT_TEMPLATE" => "kirgu",
                            "PATH_TO_ORDER" => SITE_DIR . "personal/order/make/",
                            "SHOW_EMPTY_VALUES" => "Y",
                            "PATH_TO_AUTHORIZE" => "",
                            "SHOW_REGISTRATION" => "Y",
                            "HIDE_ON_BASKET_PAGES" => "Y",
                            "SHOW_DELAY" => "N",
                            "SHOW_NOTAVAIL" => "N",
                            "SHOW_IMAGE" => "Y",
                            "SHOW_PRICE" => "Y",
                            "SHOW_SUMMARY" => "Y"
                        ),
                        false
                    ); ?>
                    <div class="stock-link stock-header hidden-mobile hidden-tablet">
                        <a href="/stocks">Акции</a>
                    </div>
                    <div class="compare-header stock-link hidden-mobile hidden-tablet">
                        <a href="/catalog/compare">Сравнение<i class="strelka none"></i></a>
                    </div>
                </div>

                <!-- -->
            </div>
            <div class="menu-container">
                <nav>
                    <ul>
                        <li class=" ">
                            <a href="http://kirgu.ru/jelektronika.html">
                                <span class="menu-title">Электроника</span>
                            </a>
                            <div class="dropdown-menu submenu level1">
                                <div class="content-container">
                                    <div class="menus-wrapper">
                                        <ul>
                                            <li class=" ">
                                                <a href="http://kirgu.ru/jelektronika/televizory-audio-video.html">
                                                    <span class="menu-title">Телевизоры, аудио, видео</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="165"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/lcd-i-led-televizory.html">
                                                    <span class="menu-title">Телевизоры</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="587"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/kronshtejny-dlja-televizorov.html">
                                                    <span class="menu-title">Кронштейны для телевизоров</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="1570"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/podstavki-pod-tva.html">
                                                    <span class="menu-title">Подставки для ТВ</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="582"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/smart-pristavki.html">
                                                    <span class="menu-title">Смарт приставки</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="710"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/priemnik-cifrovogo-tv.html">
                                                    <span class="menu-title">Приемник цифрового ТВ</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="579"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/proektory.html">
                                                    <span class="menu-title">Проекторы</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="580"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/jekrany-dlja-proektorov.html">
                                                    <span class="menu-title">Экраны для проекторов</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="604"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/videokamery.html">
                                                    <span class="menu-title">Видеокамеры</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="603"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/jekshn-kamery.html">
                                                    <span class="menu-title">Экшн камеры</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="612"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/pristavki-32-bit.html">
                                                    <span class="menu-title">Игровые приставки</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="614"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/igry.html">
                                                    <span class="menu-title">Игры</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="597"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/audiopleery.html">
                                                    <span class="menu-title">Аудиоплееры</span>
                                                </a></li>
                                            <li class=" ">
                                                <a data-id="600"
                                                   href="http://kirgu.ru/jelektronika/televizory-audio-video/dvd-pleery.html">
                                                    <span class="menu-title">DVD-плееры</span>
                                                </a></li>
                                        </ul>
                    </ul>
                    <section
                            class="banners-container with-margin">
                        <div
                                class="banner"></div>
                    </section>


                </nav>
            </div>
        </header>

                  <?  if ($curPage != SITE_DIR . "index.php") {
                        ?>
                        <div class="row">
                            <div class="col-lg-12" id="navigation">
                                <?
                                $APPLICATION->IncludeComponent("bitrix:breadcrumb", "", array(
                                    "START_FROM" => "0",
                                    "PATH" => "",
                                    "SITE_ID" => "-"
                                ),
                                    false,
                                    Array('HIDE_ICONS' => 'Y')
                                ); ?>
                            </div>
                        </div>
                        <h1 class="bx-title dbg_title" id="pagetitle"><?= $APPLICATION->ShowTitle(false); ?></h1>
                        <?
                    } else {
                        ?>
                        <h1 style="display: none"><?
                            $APPLICATION->ShowTitle() ?></h1>
                        <?
                    }
                    ?>


