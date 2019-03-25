<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Контакты");

?><div style="line-height:18px;">
<div>
Адрес: 367033, Дагестан респ., г. Махачкала, пос. Ленинкент, ул. Павших Земляков<br />
Телефон: 8-800-770-30-03<br />
E-mail: info@kirgu.ru<br />
График работы:  с 9:00 до 20:00<br /><br /><br />
<p><b>Схема проезда:</b></p><?
$APPLICATION->IncludeComponent(
	"bitrix:map.yandex.view", 
	".default", 
	array(
		"INIT_MAP_TYPE" => "MAP",
		"MAP_DATA" => "a:4:{s:10:\"yandex_lat\";d:42.96512925069062;s:10:\"yandex_lon\";d:47.39826909270096;s:12:\"yandex_scale\";i:16;s:10:\"PLACEMARKS\";a:1:{i:0;a:3:{s:3:\"LON\";d:47.39775410857009;s:3:\"LAT\";d:42.965825782034514;s:4:\"TEXT\";s:15:\"ТД Киргу\";}}}",
		"MAP_WIDTH" => "100%",
		"MAP_HEIGHT" => "500",
		"CONTROLS" => array(
			0 => "ZOOM",
			1 => "SMALLZOOM",
			2 => "MINIMAP",
			3 => "TYPECONTROL",
			4 => "SCALELINE",
		),
		"OPTIONS" => array(
			0 => "ENABLE_DBLCLICK_ZOOM",
			1 => "ENABLE_DRAGGING",
		),
		"MAP_ID" => "contacts",
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
?></div>
</div><?
require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>