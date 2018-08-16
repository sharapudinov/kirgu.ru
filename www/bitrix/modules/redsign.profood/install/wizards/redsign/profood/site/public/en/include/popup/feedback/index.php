<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');
$APPLICATION->SetTitle("Feedback");
?>

<?$APPLICATION->IncludeComponent("bitrix:main.feedback", "gopro", array(
		"USE_CAPTCHA" => "Y",
		"OK_TEXT" => "Your message is accepted!",
		"EMAIL_TO" => "#SHOP_EMAIL#",
		"REQUIRED_FIELDS" => array(
		),
		"EVENT_MESSAGE_ID" => array(
		),
		"AJAX_MODE" => "Y",
		"AJAX_OPTION_JUMP" => "N",
	),
	false
);
?>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>