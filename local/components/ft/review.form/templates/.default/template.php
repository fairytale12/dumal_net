<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?if($_GET['close'] == 'y'):?>
	<script type="text/javascript">
		parent.ftHelper.closeModal();
		parent.ftHelper.addNotify('Спасибо за оставленный отзыв!', 'success', 6000);
	</script>
<?endif;?>
<div>
	<h1 class="h1--center">Отзыв</h1>
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
	
	<div class="row">
		<div class="col-md-12">
			<div class="alert alert-warning alert-dismissable">Опишите, что вам понравилось или не понравилось, чего по вашему мнению не хватает:</div>
		</div>
	</div>
	
	<form method="post" action="">
		<input type="hidden" name="FORM_CHECK_INPUT" value="<?=$arResult['POST']['FORM_CHECK_INPUT']?>">
		<div class="row">
			<div class="col-md-12<?=(!empty($arResult['ERRORS']['UF_TEXT']) ? ' has-error' : '')?>">
				<div class="form-group">
					<textarea class="form-control" name="UF_TEXT" rows="6" placeholder="Отзыв *"><?=$arResult['POST']['UF_TEXT']?></textarea>
				</div>
			</div>
		</div>
		
		
		<div class="row">
			<div class="col-md-12">
				<div class="form-group">
					<input type="submit" class="btn btn-block btn-warning" name="send_review" value="Отправить">
				</div>
			</div>
		</div>
		
		
	</form>
</div>