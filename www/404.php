<?include_once($_SERVER['DOCUMENT_ROOT'].'/bitrix/modules/main/include/urlrewrite.php');

CHTTP::SetStatus('404 Not Found');
@define('ERROR_404','Y');

require($_SERVER['DOCUMENT_ROOT'].'/bitrix/header.php');?>

<div class="erorpage">
	<div class="errorpagein">
		<div class="num-404-error">404</div>
		<div class="text-404-error">Страница не найдена</div>
		<div class="errorbutton"><a class="btn btn-primary" href="/">Вернуться на главную</a></div>
	</div>
</div>

<?require($_SERVER['DOCUMENT_ROOT'].'/bitrix/footer.php');?>