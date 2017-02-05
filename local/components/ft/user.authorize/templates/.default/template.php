<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?if($arResult['LOGIN_SUCCESS'] || $GLOBALS['USER']->IsAuthorized()):?>
	<script type="text/javascript">
		<?/*if($arResult['LOGIN_SUCCESS']):?>
			parent.ftHelper.addNotify('Доброго времени суток!', 'success', 6000);
		<?endif;*/?>
		
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
<?if($_REQUEST['error'] == 'nf'):?>
	<script type="text/javascript">
		parent.ftHelper.showForm('/iframe/login_user_not_found.php');
	</script>
<?endif;?>

<div class="row">
	<div class="col-md-12">
		<form method="post" action=""  class="reg-form">
			<h1 class="h1--center">Авторизация</h1>
			<div class="row">
				<div class="col-md-12">
					<?if(!empty($arResult['ERRORS'])):?>
						<script type="text/javascript">
							parent.ftHelper.addNotify('<?=implode("<br/>", $arResult['ERRORS'])?>', 'danger', 6000);
						</script>
					<?endif;?>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12<?=(!empty($arResult['ERRORS']['EMAIL']) ? ' has-error' : '')?>">
					<div class="form-group">
						<input type="text" class="form-control" name="EMAIL" value="<?=$arResult['POST']['EMAIL']?>" placeholder="Email">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12<?=(!empty($arResult['ERRORS']['PASSWORD']) ? ' has-error' : '')?>">
					<div class="form-group">
						<input type="password" class="form-control" name="PASSWORD" value="" placeholder="Пароль">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12 social-icons">
					<div class="form-group">
						<?foreach($arResult['FIELDS']['SERVICES'] as $arService):?>
							<a class="btn-<?=$arService['ICON']?>" href="javascript:void(0);" onclick="<?=$arService['ONCLICK']?>">
								<span class="fa fa-lg fa-<?=($arService['ICON'] == 'vkontakte') ? 'vk' : $arService['ICON']?>"></span>
							</a>
						<?endforeach;?>
					</div>
				</div>
			</div>
			
			<?if($arResult["CAPTCHA_CODE"]):?>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<input type="hidden" class="form-control" name="captcha_sid" value="<?echo $arResult["CAPTCHA_CODE"]?>" />
							<img src="/bitrix/tools/captcha.php?captcha_sid=<?echo $arResult["CAPTCHA_CODE"]?>" width="200" height="40" alt="CAPTCHA" />
						</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-12">
						<div class="form-group">
							<div>Введите код с картинки:</div>
							<input class="form-control" type="text" name="captcha_word" maxlength="50" value="" size="15" />
						</div>
					</div>
				</div>
			<?endif;?>
			<div class="row">
				<div class="col-md-12">
					<div class="form-group">
						<input type="hidden" name="FORM_CHECK_INPUT" value="<?=$arResult['POST']['FORM_CHECK_INPUT']?>">
						<input type="submit" class="btn btn-block btn-warning" name="login" value="Войти">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="javascript:void(0);" onclick="return parent.ftHelper.showForgotForm();">Забыли пароль</a> 
					<a href="javascript:void(0);" class="text-right" onclick="return parent.ftHelper.showRegistrationForm();">Регистрация</a>
				</div>
			</div>

		</form>
	</div>
</div>
