<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?if($GLOBALS['USER']->IsAuthorized()):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		
		if(parent.window.location.href.match(/\/account/i)) {
			parent.window.location.reload();
		} else {
			parent.window.location.href = '/account/';
		}
	</script>
<?endif;?>
<?if($arResult['NEED_TO_REDIRECT']):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		parent.window.location.href = '<?=$arResult['NEED_TO_REDIRECT']?>';
	</script>
<?endif;?>
<?if($arResult['NEED_TO_IFRAME']):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		parent.ftHelper.showForm('<?=$arResult['NEED_TO_IFRAME']?>');
	</script>
<?endif;?>

<form method="post" action="" class="reg-form">
	<h1 class="h1--center">Восстановление пароля</h1>
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissable">Введите E-mail, который вы указали при регистрации, мы вышлем на него инструкиции по восстановлению пароля:</div>
		</div>
	</div>
	<?if(!empty($arResult['ERRORS'])):?>
		<script type="text/javascript">
			parent.ftHelper.addNotify('<?=implode("<br/>", $arResult['ERRORS'])?>', 'danger', 6000);
		</script>
	<?endif;?>
	<div class="row">
		<div class="col-md-12<?=(!empty($arResult['ERRORS']['EMAIL']) ? ' has-error' : '')?>">
			<div class="form-group">
				<input type="text" name="EMAIL" class="form-control" value="<?=$arResult['POST']['EMAIL']?>" placeholder="Email">
			</div>
		</div>
	</div>
	<?if($arResult["CAPTCHA_CODE"]):?>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<input type="hidden" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
					<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="200" height="40" alt="CAPTCHA" />
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<div>Введите код с картинки:</div>
					<input type="text" class="form-control" name="captcha_word" maxlength="50" value="" size="15" />
				</div>
			</div>
		</div>
	<?endif;?>
	<div class="row">
		<div class="col-md-12">
			<div class="form-group">
				<input type="hidden" name="FORM_CHECK_INPUT" value="<?=$arResult['POST']['FORM_CHECK_INPUT']?>">
				<input type="submit" class="btn btn-block btn-warning" name="recover" value="Восстановить пароль">
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-md-12">
			<a href="javascript:void(0);" onclick="return parent.ftHelper.showLoginForm();">Авторизация</a>
			<a href="javascript:void(0);" class="text-right" onclick="return parent.ftHelper.showRegistrationForm();">Регистрация</a>
		</div>
	</div>
		
</form>