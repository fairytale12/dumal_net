<?
require($_SERVER["DOCUMENT_ROOT"]."/bitrix/header.php");

switch($_GET['action']) {
	case 'confirm':
		$arResult = ft\CSubscribe::confirmById($_GET['ID'], $_GET['CONFIRM_CODE']);
		break;
	
	case 'unsubscribe':
		$arResult = ft\CSubscribe::unsubscribe($_GET['id'], $_GET['hash'], explode(',', $_GET['rubric']));
		break;
	
	default:
		LocalRedirect('/');
}

?>

<script type="text/javascript">
	
	ftHelper.addNotify('<?=$arResult['TEXT']?>', '<?=($arResult['RESULT'] == 'SUCCESS' ? 'success' : 'danger')?>');
	
	var defaults = {
		url: '/',
		push: false,
		replace: true,
		scrollTo: false
	}
	$.pjax($.extend(defaults, {container: '#pjax-container'}));
</script>

<?require($_SERVER["DOCUMENT_ROOT"]."/bitrix/footer.php");?>