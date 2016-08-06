<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<div class="row">
	<div class="col-md-12">
		<div class="alert alert-warning alert-dismissable">
		Осталось чуть-чуть.<br/>
		Чтобы завершить регистрацию, введите данные на форме. Они помогут нам восстановит доступ к аккаунту в случае его утери или блокировки.
		</div>
	</div>
</div>

<?if(!empty($arResult['ERRORS'])):?>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-danger">
				<?=implode("<br/>", $arResult['ERRORS'])?>
			</div>
		</div>
	</div>
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
				<input type="hidden" name="CAPTCHA_CODE" value="">
				<input type="submit" class="btn btn-block btn-warning" name="social_registration" value="Зарегистрироваться">
			</div>
		</div>
	</div>
		
</form>
<?if($_REQUEST['result'] == 'confirm'):?>
	<script type="text/javascript">
		parent.ftHelper.showModal('#registration-user-confirm');
	</script>
<?endif;?>
<?if($arResult['USER_EXIST'] && $arParams['STEP'] == 2):?>
	<script type="text/javascript">
		var agreeLink = parent.$('#social-registartion-user-exist').find('a.agree-link');
		if(agreeLink.length) {
			var newOnClickEvent = agreeLink.attr('onclick').replace(/#EMAIL#/, '<?=$arResult['SERVICE_USER']['UF_SOC_EMAIL']?>');
			agreeLink.attr('onclick', newOnClickEvent);
		}
		parent.ftHelper.showModal('#social-registartion-user-exist');
	</script>
<?endif;?>