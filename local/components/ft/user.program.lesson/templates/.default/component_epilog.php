<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
$GLOBALS['APPLICATION']->setPageProperty('title', $arResult['LESSON']['UF_NAME']);
?>
<?if(!empty($arResult['TASKS'])):?>
	<?
	$completedTasksCount = 0;
	foreach($arResult['TASKS'] as $arTask) {
		if(!$arTask['IS_COMPLETED']) {
			continue;
		}
		
		$completedTasksCount++;
	}
	
	$progress = ft\CHelper::getProgress($completedTasksCount, count($arResult['TASKS']));
	?>
	<?itc\CUncachedArea::startCapture('progress-block');?>
	<div class="lesson-progress-block"<?=(empty($progress) ? ' style="display: none;"' : '')?>>
		<h3>Прогресс урока</h3>
		<div class="progress progress-striped active">
			<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;">
				<span class="sr-only"><?=$progress?>%</span>
			</div>
		</div>
	</div>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?itc\CUncachedArea::startCapture('vk-comments-block');?>
	<div id="vk-comments" data-id="user-lesson-<?=$arResult['PROGRAM']['ID']?>-<?=$arResult['LESSON']['ID']?>"></div>
<?itc\CUncachedArea::endCapture();?>

<?
if(!empty($arResult['AUTHOR'])):
?>
	<?itc\CUncachedArea::startCapture('article-author-block');?>
	<?//$GLOBALS['APPLICATION']->includeFile('/include/author.php', $arResult['AUTHOR']);?>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>

<?itc\CUncachedArea::startCapture('review-block');?>
	<?$GLOBALS['APPLICATION']->includeFile('/include/review_block.php', array('PROGRAM_ID' => $arResult['PROGRAM']['ID']));?>
<?itc\CUncachedArea::endCapture();?>