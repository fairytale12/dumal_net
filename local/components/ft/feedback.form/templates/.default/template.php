<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?if($_GET['close'] == 'y'):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		parent.ftHelper.addNotify('Сообщение отправлено!', 'success', 6000);
	</script>
<?endif;?>
<div>
	<h1 class="h1--center">Обратная связь</h1>
	<?if(!empty($arResult['ERRORS'])):?>
		<?/*
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					<?=implode("<br/>", $arResult['ERRORS'])?>
				</div>
			</div>
		</div>
		*/?>
		<script type="text/javascript">
			parent.ftHelper.addNotify('<?=implode("<br/>", $arResult['ERRORS'])?>', 'danger', 6000);
		</script>
	<?endif;?>
	
	<form method="post" action="">
		<input type="hidden" name="FORM_CHECK_INPUT" value="<?=$arResult['POST']['FORM_CHECK_INPUT']?>">
		<div class="row">
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['UF_NAME']) ? ' has-error' : '')?>">
				<div class="form-group">
					<input type="text" class="form-control" name="UF_NAME" value="<?=$arResult['POST']['UF_NAME']?>" placeholder="Имя">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['UF_EMAIL']) ? ' has-error' : '')?>">
				<div class="form-group">
					<input type="text" class="form-control" name="UF_EMAIL" value="<?=$arResult['POST']['UF_EMAIL']?>" placeholder="Email *">
				</div>
			</div>
		</div>
		<div class="row">
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['UF_COMMENT']) ? ' has-error' : '')?>">
				<div class="form-group">
					<textarea class="form-control" name="UF_COMMENT" rows="6" placeholder="Сообщение *"><?=$arResult['POST']['UF_COMMENT']?></textarea>
				</div>
			</div>
		</div>
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<input type="submit" class="btn btn-block btn-warning" name="send_feedback" value="Отправить">
				</div>
			</div>
		</div>
		
	</form>
</div>