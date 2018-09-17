<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("We are always available");
?>

<?php
echo '<link href="'.SITE_DIR.'include/popup/nasvyazi/style.css?'.randString(10, array('1234567890')).'" type="text/css" rel="stylesheet" />';
?>

<div class="nasvyazi">
	<div class="block left">
		<span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">CONVENIENCE CONTACT CENTER</span><br />
		<a href="tel:88005554433">8 800 555 44 33</a><br />
		<span style="color:#666666;">(Free calls to Russia)</span><br />
		<br />
		<span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">MOSCOW RESIDENTS</span><br />
		<a href="tel:84951112211">495 111 22 11</a><br />
		<br />
		<span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">YOU CAN WRITE US A MAIL</span><br />
		<a href="mailto:info@opttorg20.ru">info@opttorg20.ru</a><br />
		or use the form <a href="#">feedback</a><br />
		<br />
		<span style="line-height:25px;font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">JOIN US</span><br />
		<a href="#facebook"><img src="#SITE_DIR#include/icon_fb.png" border="0" alt=""></a> &nbsp; 
		<a href="#vkontakte"><img src="#SITE_DIR#include/icon_vk.png" border="0" alt=""></a> &nbsp; 
		<a href="#twitter"><img src="#SITE_DIR#include/icon_tw.png" border="0" alt=""></a> &nbsp; 
	</div>
	<div class="block center"><?
		$APPLICATION->IncludeComponent(
			"bitrix:catalog.store.list",
			"nasvyazi",
			Array(
				"CACHE_TIME" => $arParams["CACHE_TIME"],
				"PHONE" => $arParams["PHONE"],
				"SCHEDULE" => $arParams["SCHEDULE"],
				"MIN_AMOUNT" => $arParams["MIN_AMOUNT"],
				"TITLE" => $arParams["TITLE"],
				"SET_TITLE" => $arParams["SET_TITLE"],
				"PATH_TO_ELEMENT" => $arResult["PATH_TO_ELEMENT"],
				"PATH_TO_LISTSTORES" => $arResult["PATH_TO_LISTSTORES"],
				"MAP_TYPE" => $arParams["MAP_TYPE"],
			)
		);
	?></div>
	<div class="block right">
		<span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">COMMENTS</span><br />
		<a href="#">Say "Thank you"</a><br />
		<a href="#">Share an idea</a><br />
		<a href="#">Submit a claim</a><br />
		<br />
		<span style="font-weight:bold;font-family:Opensanslight,Arial,Helvetica,sans-serif;">CLIENT SERVICE EXPERIENCE</span><br />
		<a href="#">Quality line</a><br />
		<a href="#">Public standards</a><br />
		<a href="#">Rate the quality of service</a><br />
	</div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>