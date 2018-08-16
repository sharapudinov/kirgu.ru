<?php if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die(); ?>
<?$APPLICATION->IncludeComponent(
	"bitrix:menu", 
	"fly", 
	array(
		"ALLOW_MULTI_SELECT" => "N",
		"CHILD_MENU_TYPE" => "sub",
		"DELAY" => "N",
		"MAX_LEVEL" => "2",
		"MENU_CACHE_GET_VARS" => array(
		),
		"MENU_CACHE_TIME" => "3600",
		"MENU_CACHE_TYPE" => "A",
		"MENU_CACHE_USE_GROUPS" => "N",
		"ROOT_MENU_TYPE" => "fly",
		"USE_EXT" => "Y",
		"COMPONENT_TEMPLATE" => "fly",
		"IBLOCK_ID" => "4"
	),
	false
);?>
