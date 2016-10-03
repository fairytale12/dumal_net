<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<p><?echo $arResult['MESSAGE_TEXT']?></p>

<script type="text/javascript">
	
	ftHelper.addNotify('<?=$arResult['MESSAGE_TEXT']?>', '<?=($arResult['MESSAGE_CODE'] > 0 ? 'success' : 'danger')?>');
	
	var defaults = {
		url: '/',
		push: false,
		replace: true,
		scrollTo: false
	}
	$.pjax($.extend(defaults, {container: '#pjax-container'}));
</script>