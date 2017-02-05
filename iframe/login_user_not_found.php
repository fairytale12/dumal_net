<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS['APPLICATION']->setTitle('Авторизация');
?>
<div class="row">
	<div class="col-md-12">
		<h1 class="h1--center">Авторизация</h1>
		<p><i>Пользователь с таким профилем не найден на сайте.<br/>Перейти к регистрации?</i></p>
		<div class="inline-btn-block">
			<a href="javascript:void(0);" class="btn btn-danger btn-block" onclick="return parent.ftHelper.showLoginForm();">Отмена</a>
			<a href="javascript:void(0);" class="btn btn-success btn-block" onclick="return parent.ftHelper.showRegistrationForm();">Да</a>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>