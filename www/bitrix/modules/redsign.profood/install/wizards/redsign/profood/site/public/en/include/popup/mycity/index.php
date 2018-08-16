<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("My city");
?>
<? $APPLICATION->IncludeComponent(
	"redsign:location.top", 
	"gopro", 
	array(
		"COMPONENT_TEMPLATE" => "gopro",
		"COUNT_ITEMS" => "46"
	),
	false
);?>
<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>