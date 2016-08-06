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

<div  class="reg-form">
	<h1 class="h1--center">Регистрация</h1>
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
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['CONFIRM_PASSWORD']) ? ' has-error' : '')?>">
				<div class="form-group">
					<input type="password" class="form-control" name="CONFIRM_PASSWORD" value="" placeholder="Подтверждение пароля">
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
			
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<input type="hidden" name="CAPTCHA_CODE" value="">
					<input type="submit" class="btn btn-block btn-warning" name="registration" value="Зарегистрироваться">
				</div>
			</div>
		</div>
	</form>
	
	<div class="row">
		<div class="col-md-12">
			<a href="javascript:void(0);" onclick="return parent.ftHelper.showLoginForm();">Авторизация</a>
		</div>
	</div>
</div>

<?if($_REQUEST['result'] == 'confirm'):?>
	<script type="text/javascript">
		parent.ftHelper.showModal('#registration-user-confirm');
	</script>
<?endif;?>