<?
$arParams['ID'] = intval($arParams['ID']);
?>

<div class="widget widget-border subscribewidget program-pilot-form">
	<h3 class="block-title"><span>Принять участие</span></h3>
	<p>Если вам интересно, то вы можете опробовать программу, для этого отправьте нам свой email:</p>
	<form action="/ajax/get_program.php" method="post" class="form-inline">
		<div class="input-group">
			<input type="hidden" name="id" value="<?=$arParams['ID']?>">
			<input type="text" class="form-control" name="email" value="<?=$GLOBALS['USER']->GetEmail();?>" placeholder="Введите Email">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="return ftUserSubscribe.pilotProgramSubscribe(this);">Отправить</button>
			</span>
		</div>
	</form>
</div>