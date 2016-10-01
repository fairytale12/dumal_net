<?if(!empty($arResult['SECTIONS'])):?>
	<?itc\CUncachedArea::startCapture('categories-block');?>
	<?$GLOBALS['APPLICATION']->includeFile('/include/sections.php', array('SECTIONS' => $arResult['SECTIONS']));?>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?itc\CUncachedArea::startCapture('subscribe-form-block');?>
	<?$APPLICATION->IncludeComponent(
		"ft:user.subscribe.form",
		"",
		Array(
			"RUBRIC_ID" => ARTICLES_AND_VIDEO_RUBRIC_ID,
			"TEXT" => 'Интересно? Подпишитесь и мы будем присылать вам новинки на почту!',
		)
	);?>
<?itc\CUncachedArea::endCapture();?>