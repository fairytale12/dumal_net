<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<div class="widget widget-border subscribewidget">
	<h3 class="block-title"><span>Подписка</span></h3>
	<p><?=$arParams['TEXT']?></p>
	<form action="<?=$GLOBALS['APPLICATION']->getCurPage()?>" method="post" class="form-inline">
		<div class="input-group">
			<input type="hidden" name="subscribe" value="1">
			<input type="hidden" name="rubric" value="<?=$arParams['RUBRIC_ID']?>">
			<input type="text" class="form-control" name="email" value="<?=$arResult['USER']['EMAIL']?>" placeholder="Введите Email">
			<span class="input-group-btn">
				<button class="btn btn-default" type="button" onclick="return ftUserSubscribe.subscribe(this);">Подписаться</button>
			</span>
		</div>
	</form>
</div>