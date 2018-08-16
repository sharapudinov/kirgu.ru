<?$APPLICATION->IncludeComponent(
	"redsign:catalog.sorter", 
	"gopro", 
	array(
		"ALFA_ACTION_PARAM_NAME" => "alfaction",
		"ALFA_ACTION_PARAM_VALUE" => "alfavalue",
		"ALFA_CHOSE_TEMPLATES_SHOW" => "Y",
		"ALFA_CNT_TEMPLATES" => 3,
		"ALFA_DEFAULT_TEMPLATE" => "showcase",
		"ALFA_CNT_TEMPLATES_0" => "Список",
		"ALFA_CNT_TEMPLATES_NAME_0" => "table",
		"ALFA_CNT_TEMPLATES_1" => "Галерея",
		"ALFA_CNT_TEMPLATES_NAME_1" => "gallery",
		"ALFA_CNT_TEMPLATES_2" => "Витрина",
		"ALFA_CNT_TEMPLATES_NAME_2" => "showcase",
		"ALFA_SORT_BY_SHOW" => "Y",
		"ALFA_SHORT_SORTER" => "Y",
		"ALFA_SORT_BY_NAME" => array(
			0 => "sort",
			1 => "name",
			2 => "PROPERTY_PROD_PRICE_FALSE",
			3 => "",
		),
		"ALFA_SORT_BY_DEFAULT" => "name_asc",
		"ALFA_OUTPUT_OF_SHOW" => "Y",
		"ALFA_OUTPUT_OF" => array(
            0 => "10",
            1 => "15",
            2 => "20"
        ),
		"ALFA_OUTPUT_OF_DEFAULT" => "15",
		"ALFA_OUTPUT_OF_SHOW_ALL" => "N",
		"ALFA_DONT_REDIRECT" => "Y",
		"AJAXPAGESID" => "ajaxpages_brandprods",
		"COMPONENT_TEMPLATE" => "gopro"
	),
	false
);
?>
