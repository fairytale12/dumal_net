<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS['APPLICATION']->setTitle('Оставить отзыв');
?>

<?$APPLICATION->IncludeComponent(
	"ft:review.form",
	"",
	Array(
		'PROGRAM_ID' => $_GET['program']
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>