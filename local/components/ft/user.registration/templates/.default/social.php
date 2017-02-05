<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<?if($arResult['NEED_TO_REDIRECT']):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		parent.window.location.href = '<?=$arResult['NEED_TO_REDIRECT']?>';
	</script>
<?endif;?>
<?if($arResult['NEED_TO_IFRAME']):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		
		<?if($arResult['USER_EXIST'] && $arParams['STEP'] == 2):?>
			parent.ftHelper.showForm('/iframe/social_registartion_user_exist.php', true, {email: '<?=$arResult['SERVICE_USER']['UF_SOC_EMAIL']?>'});
		<?else:?>
			parent.ftHelper.showForm('<?=$arResult['NEED_TO_IFRAME']?>');
		<?endif;?>
	</script>
<?endif;?>

<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning alert-dismissable">
		Осталось чуть-чуть.<br/>
		Чтобы завершить регистрацию, введите данные на форме. Они помогут нам восстановит доступ к аккаунту в случае его утери или блокировки.
		</div>
	</div>
</div>

<?if(!empty($arResult['ERRORS'])):?>
	<script type="text/javascript">
		parent.ftHelper.addNotify('<?=implode("<br/>", $arResult['ERRORS'])?>', 'danger', 6000);
	</script>
<?endif;?>
<form method="post" action="">
	<div class="row">
		<div class="form-group">
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['EMAIL']) ? ' has-error' : '')?>">
				<input type="text" name="EMAIL" class="form-control" value="<?=$arResult['POST']['EMAIL']?>" placeholder="Email">
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="form-group">
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['PASSWORD']) ? ' has-error' : '')?>">
				<input type="password" name="PASSWORD" class="form-control" value="" placeholder="Пароль">
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="form-group">
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['CONFIRM_PASSWORD']) ? ' has-error' : '')?>">
				<input type="password" name="CONFIRM_PASSWORD" class="form-control" value="" placeholder="Подтверждение пароля">
			</div>
		</div>
	</div>
		
	<div class="row">
		<div class="form-group">
			<div class="col-md-12">
				<input type="hidden" name="FORM_CHECK_INPUT" value="<?=$arResult['POST']['FORM_CHECK_INPUT']?>">
				<input type="submit" class="btn btn-block btn-warning" name="social_registration" value="Зарегистрироваться">
			</div>
		</div>
	</div>
		
</form>
