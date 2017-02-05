<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS['APPLICATION']->setTitle('Восстановление пароля');
?>

<?$APPLICATION->IncludeComponent(
	"ft:user.forgotpassword",
	"",
	Array()
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>