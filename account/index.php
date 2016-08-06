<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Личный кабинет");

$hasAccess = ft\CUserAuthorization::checkAuthorization();
v($hasAccess);
?>

Личный кабинет

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>