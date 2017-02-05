<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS['APPLICATION']->setTitle('Обратная связь');
?>

<?$APPLICATION->IncludeComponent(
	"ft:feedback.form",
	"",
	Array(
		'LINK' => $_GET['link']
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>