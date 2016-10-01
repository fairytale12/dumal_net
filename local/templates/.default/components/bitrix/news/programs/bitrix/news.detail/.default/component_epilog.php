<?
if(!empty($arResult['AUTHOR'])):
?>
	<?itc\CUncachedArea::startCapture('article-author-block');?>
	<?$GLOBALS['APPLICATION']->includeFile('/include/author.php', $arResult['AUTHOR']);?>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?if(!empty($arResult['ID'])):?>
	<?itc\CUncachedArea::startCapture('article-counter-block');?>
	<?$GLOBALS['APPLICATION']->includeFile('/include/show_counter.php', array('ID' => $arResult['ID']));?>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?itc\CUncachedArea::startCapture('subscribe-form-block');?>
	<?$APPLICATION->IncludeComponent(
		"ft:user.subscribe.form",
		"",
		Array(
			"RUBRIC_ID" => PROGRAMS_RUBRIC_ID,
			"TEXT" => 'Интересно? Подпишитесь и мы будем присылать вам новинки на почту!',
		)
	);?>
<?itc\CUncachedArea::endCapture();?>