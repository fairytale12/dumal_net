<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Подтверждение пароля");
?>

<?$APPLICATION->IncludeComponent(
	"ft:user.confirm",
	"",
	Array(
	)
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>