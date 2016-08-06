<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<div class="row">
	<div class="col-md-4">
		<form method="post" action="">
			<h2>Ввод нового пароля</h2>
			<?if(!empty($arResult['ERRORS'])):?>
				<div class="row">
					<div class="col-md-12">
						<div class="alert alert-danger">
							<?=implode("<br/>", $arResult['ERRORS'])?>
						</div>
					</div>
				</div>
			<?endif;?>
			<div class="row">
				<div class="col-md-12<?=(!empty($arResult['ERRORS']['PASSWORD']) ? ' has-error' : '')?>">
					<div class="form-group">
						<input type="password" name="PASSWORD" class="form-control" value="" placeholder="Пароль">
					</div>
				</div>
			</div>

			<div class="row">
				<div class="col-md-12<?=(!empty($arResult['ERRORS']['CONFIRM_PASSWORD']) ? ' has-error' : '')?>">
					<div class="form-group">
						<input type="password" name="CONFIRM_PASSWORD" class="form-control" value="" placeholder="Подтверждение пароля">
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-12">
					<input type="hidden" name="USER_CHECKWORD" value="<?=$arResult['POST']['USER_CHECKWORD']?>">
					<input type="hidden" name="LOGIN" value="<?=$arResult['POST']['LOGIN']?>">
					<input type="hidden" name="CAPTCHA_CODE" value="">
					<input type="submit" class="btn btn-block btn-warning" name="change_password" value="Войти">
				</div>
			</div>
		</form>
	</div>
</div>