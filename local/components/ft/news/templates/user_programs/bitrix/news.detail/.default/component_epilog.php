<?
if(!empty($arResult['AUTHOR'])):
?>
	<?itc\CUncachedArea::startCapture('article-author-block');?>
	<?//$GLOBALS['APPLICATION']->includeFile('/include/author.php', $arResult['AUTHOR']);?>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?if(!empty($arResult['ID'])):?>
	<?itc\CUncachedArea::startCapture('article-counter-block');?>
	<?$GLOBALS['APPLICATION']->includeFile('/include/show_counter.php', array('ID' => $arResult['ID']));?>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>