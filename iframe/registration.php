<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS['APPLICATION']->setTitle('Регистрация');
?>

<?
$step = intval($_REQUEST['step']);
if(empty($step)) {
	$step = 1;
} elseif($step != 1 && $step != 3) {
	$step = 2;
}
?>

<?$APPLICATION->IncludeComponent(
	"ft:user.registration",
	"",
	Array(
		'STEP' => $step
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>