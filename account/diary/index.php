<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$APPLICATION->SetTitle("Мой дневник");

$hasAccess = ft\CUserAuthorization::checkAuthorization();
v($hasAccess);
?>

Личный кабинет - мой дневник

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>