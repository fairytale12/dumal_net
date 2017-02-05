<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");
$GLOBALS['APPLICATION']->setTitle('Авторизация');
?>
   
<?$APPLICATION->IncludeComponent(
	"ft:user.authorize",
	"",
	Array()
);?>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>