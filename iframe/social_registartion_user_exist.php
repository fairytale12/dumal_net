<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS['APPLICATION']->setTitle('Регистрация');
?>
<div class="row">
	<div class="col-md-12">
		<h1 class="h1--center">Регистрация</h1>
		<p><i>На сайте уже зарегистрирован пользователь с таким email.<br/>Перейти к авторизации?</i></p>
		<div class="inline-btn-block">
			<a href="javascript:void(0);" class="btn btn-danger btn-block" onclick="return parent.ftHelper.showRegistrationForm(false, {step: 3});">Нет</a>
			<a href="javascript:void(0);" class="btn btn-success btn-block" onclick="return parent.ftHelper.showLoginForm(true, {email: '<?=$_REQUEST['email']?>'})">Да</a>
		</div>
	</div>
</div>
<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>