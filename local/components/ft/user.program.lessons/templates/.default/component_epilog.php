<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
$GLOBALS['APPLICATION']->setPageProperty('title', $arResult['PROGRAM']['NAME']);
?>

<?if(!empty($arResult['LESSONS'])):?>
	<?itc\CUncachedArea::startCapture('progress-block');?>
	<?
	$completedLessonCount = 0;
	foreach($arResult['LESSONS'] as $arLesson) {
		if(!$arLesson['IS_COMPLETED']) {
			continue;
		}
		
		$completedLessonCount++;
	}
	
	$progress = ft\CHelper::getProgress($completedLessonCount, $arResult['PROGRAM']['PROPERTIES']['MAX_LESSONS']['VALUE']);
	?>
	<div class="lesson-progress-block"<?=(empty($progress) ? ' style="display: none;"' : '')?>>
		<h3>Прогресс программы</h3>
		<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;">
				<span class="sr-only"><?=$progress?>%</span>
			</div>
		</div>
	</div>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?
if(!empty($arResult['AUTHOR'])):
?>
	<?itc\CUncachedArea::startCapture('article-author-block');?>
	<?$GLOBALS['APPLICATION']->includeFile('/include/author.php', $arResult['AUTHOR']);?>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?itc\CUncachedArea::startCapture('review-block');?>
	<?$GLOBALS['APPLICATION']->includeFile('/include/review_block.php', array('PROGRAM_ID' => $arResult['PROGRAM']['ID']));?>
<?itc\CUncachedArea::endCapture();?>