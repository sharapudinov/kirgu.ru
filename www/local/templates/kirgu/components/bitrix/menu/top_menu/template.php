<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

if (empty($arResult))
	return;
?>
<nav>
	<ul >
		<?foreach($arResult as $itemIdex => $arItem):?>
			<?if ($arItem["DEPTH_LEVEL"] == "1"):?>
				<li ><a href="<?=htmlspecialcharsbx($arItem["LINK"])?>"><?=htmlspecialcharsbx($arItem["TEXT"])?></a></li>
			<?endif?>
		<?endforeach;?>
	</ul>
    <li class="open-callback">

        <a href="#" onclick="jQuery(this).next().toggle()">Перезвоните мне</a>

        <div class="callback">

            <input type="tel" placeholder="+7(999)999-99-99">
            <button>Перезвоните мне</button>

        </div>

    </li>
</nav>
