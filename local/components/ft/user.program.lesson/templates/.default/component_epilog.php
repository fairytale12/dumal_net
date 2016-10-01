<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
$GLOBALS['APPLICATION']->setPageProperty('title', $arResult['LESSON']['UF_NAME']);
//p($arResult);
?>
<?
if(!empty($arResult['AUTHOR'])):
?>
	<?itc\CUncachedArea::startCapture('article-author-block');?>
	<?//$GLOBALS['APPLICATION']->includeFile('/include/author.php', $arResult['AUTHOR']);?>
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
		<div class="lesson-progress-block"<?=(empty($progress) ? ' style="display: none;"' : '')?>>
			<h3>Прогресс урока</h3>
			<div class="progress progress-striped active">
				<div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="<?=$progress?>" aria-valuemin="0" aria-valuemax="100" style="width: <?=$progress?>%;">
					<span class="sr-only"><?=$progress?>%</span>
				</div>
			</div>
		</div>
	<?endif;?>
	
	<div id="vk_comments"></div>
	<script type="text/javascript">
		VK.Widgets.Comments('vk_comments', {limit: 10, attach: false, autoPublish: 0}, 'user-lesson-<?=$arResult['PROGRAM']['ID']?>-<?=$arResult['LESSON']['ID']?>');
	</script>
	
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>