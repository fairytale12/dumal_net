<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мои программы");

$hasAccess = ft\CUserAuthorization::checkAuthorization();
v($hasAccess);
?>

Личный кабинет - программы

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>