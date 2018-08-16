<?php
global $alfaCTemplate, $alfaCSortType, $alfaCSortToo, $alfaCOutput;
?>

<?$APPLICATION->IncludeComponent('redsign:catalog.sorter', 'gopro', array(
	'ALFA_ACTION_PARAM_NAME' => 'alfaction',
	'ALFA_ACTION_PARAM_VALUE' => 'alfavalue',
	'ALFA_CHOSE_TEMPLATES_SHOW' => 'Y',
	'ALFA_CNT_TEMPLATES' => '3',
	'ALFA_DEFAULT_TEMPLATE' => 'showcase',
	'ALFA_CNT_TEMPLATES_0' => 'Список',
	'ALFA_CNT_TEMPLATES_NAME_0' => 'table',
	'ALFA_CNT_TEMPLATES_1' => 'Галерея',
	'ALFA_CNT_TEMPLATES_NAME_1' => 'gallery',
	'ALFA_CNT_TEMPLATES_2' => 'Витрина',
	'ALFA_CNT_TEMPLATES_NAME_2' => 'showcase',
	'ALFA_SORT_BY_SHOW' => 'N',
	'ALFA_OUTPUT_OF_SHOW' => 'N',
	'AJAXPAGESID' => 'ajaxpages_main',
	),
	false
);
?>
