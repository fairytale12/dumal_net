<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?if($arResult['LOGIN_SUCCESS'] || $GLOBALS['USER']->IsAuthorized()):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		
		if(parent.window.location.href.match(/\/account/i)) {
			parent.window.location.reload();
		} else {
			parent.window.location.href = '/account/';
		}
	</script>
<?endif;?>
<div class="row">
	<div class="col-md-12">
		<form method="post" action=""  class="reg-form">
			<h1 class="h1--center">Авторизация</h1>
			<div class="row">
				<div class="col-md-12">
					<?if(!empty($arResult['ERRORS'])):?>
						<div class="alert alert-danger">
							<?=implode("<br/>", $arResult['ERRORS'])?>
						</div>
					<?endif;?>
				</div>
			</div>
			<?/*if($_REQUEST['error'] == 'nf'):?>
				<div class="row">
					<div class="col-md-12">
						<p>Пользователь с таким профилем не найден на сайте. Перейти к регистрации?</p>
						<a href="/reg/">Да</a> / <a href="javascript: void(0);" onclick="return ftHelper.closeModal();">Отмена</a>
					</div>
				</div>
			<?endif;*/?>
			
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
				<div class="col-md-12">
					<div class="form-group">
						<?foreach($arResult['FIELDS']['SERVICES'] as $arService):?>
							<div class="soc-icons btn btn-social-icon btn-<?=$arService['ICON']?>" onclick="<?=$arService['ONCLICK']?>">
								<span class="fa fa-lg fa-<?=($arService['ICON'] == 'vkontakte') ? 'vk' : $arService['ICON']?>"></span>
							</div>
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
						<input type="hidden" name="CAPTCHA_CODE" value="">
						<input type="submit" class="btn btn-block btn-warning" name="login" value="Войти">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<a href="javascript:void(0);" onclick="return parent.ftHelper.showIframe('/iframe/forgot.php');">Забыли пароль</a> 
					<a href="javascript:void(0);" class="text-right" onclick="return parent.ftHelper.showRegistration();">Регистрация</a>
				</div>
			</div>

		</form>
	</div>
</div>
<?if($_REQUEST['error'] == 'nf'):?>
	<script type="text/javascript">
		parent.ftHelper.showModal('#login-user-not-found');
	</script>
<?endif;?>