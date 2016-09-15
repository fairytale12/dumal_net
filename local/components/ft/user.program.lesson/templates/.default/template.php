<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<article class="post-wrapper clearfix">

	<header class="post-header">
		<h1 class="post-title">
			<?=$arResult['LESSON']['UF_NAME']?>
		</h1>
	</header>
	
	<?if(!empty($arResult['LESSON']['UF_VIDEO'])):?>
		<?=ft\CYouTube::insertHTMLVideo($arResult['LESSON']['UF_VIDEO'], 730, 425)?>
	<?endif;?>
	<?if(!empty($arResult['TASKS'])):?>
		<h4>Задания</h4>
		<div class="row clearfix">
			<div class="col-md-12">
				<div class="panel-group lesson-tasks" id="accordion-<?=$arResult['LESSON']['ID']?>">
				<?foreach($arResult['TASKS'] as $key => $arTask):?>
				
					<div class="panel">
						<div class="panel-heading">
							<h4 class="panel-title">
								<a data-toggle="collapse" data-parent="#accordion-<?=$arResult['LESSON']['ID']?>" href="#task-<?=$arTask['ID']?>" aria-expanded="false" class="collapsed">
									<?=($key + 1)?>. <?=$arTask['UF_NAME']?>
									<span class="task-icon glyphicon <?=($arTask['IS_COMPLETED'] ? 'glyphicon-check' : 'glyphicon-edit')?>"></span>
								</a>
							</h4>
						</div>
						<div id="task-<?=$arTask['ID']?>" class="panel-collapse collapse" aria-expanded="false">
							<div class="panel-body">
							
								<p><?=$arTask['UF_DESCRIPTION']?></p>
								
								<?if(!empty($arTask['UF_FILES'])):?>
									<div class="row">
										<?foreach($arTask['UF_FILES'] as $fileId):?>
											<div class="col-md-2">
												<a href="<?=CFile::getPath($fileId)?>" title="Скачать файл для занятия">
													<span class="glyphicon glyphicon-save-file"></span>
													скачать
												</a>
											</div>
										<?endforeach;?>
									</div>
								<?endif;?>
								
								<div class="done-task-block">
									<input id="done-task-<?=$arTask['ID']?>" type="checkbox" name="done"<?=($arTask['IS_COMPLETED'] ? ' checked disabled' : '')?>
										data-program="<?=$arResult['PROGRAM']['ID']?>" data-lesson="<?=$arResult['LESSON']['ID']?>" value="<?=$arTask['ID']?>">
									<label for="done-task-<?=$arTask['ID']?>"><?=($arTask['IS_COMPLETED'] ? '<span class="success-text">Задание выполнено!</span>' : 'Отметить как выполнено')?></label>
								</div>
								
							</div>
						</div>
					</div>
				<?endforeach;?>
				</div>
			</div>
		</div>
	<?endif;?>
	
	<a href="<?=$arResult['PROGRAM']['DETAIL_PAGE_URL']?>" data-pjax="">Вернуться к программе &laquo;<?=$arResult['PROGRAM']['NAME']?>&raquo;</a>
	
</article>