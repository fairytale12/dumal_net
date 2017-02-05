<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<article class="post-wrapper clearfix">

	<header class="post-header">
		<h1 class="post-title">
			<?=$arResult['PROGRAM']['NAME']?>
		</h1>
	</header>
	
	<?if($arResult['PROGRAM']['IS_PILOT']):?>
		<div class="alert alert-warning">
			У вас <strong>пробная</strong> версия программы, для нее доступна только часть уроков. Если вам понравилось, то вы можете <a href="javascript:void(0);">приобрести</a> данную программу.
		</div>
	<?endif;?>
	
	<?/*
	<div class="post-content clearfix">
		<?=$arResult['PROGRAM']['DETAIL_TEXT']?>
	</div>
	*/?>
	
	<div class="lessons-list row clearfix">
		<?foreach($arResult['LESSONS'] as $arLesson):?>
			<div class="col-md-12">
				<a data-pjax="<?=ft\CHelper::getLinkId($arParams['PJAX_LINK'])?>" href="<?=$arLesson['LINK']?>" title="<?=$arLesson['UF_NAME']?>">
					<div class="simple-post lesson-block">
						<span class="glyphicon <?=($arLesson['IS_COMPLETED'] ? 'glyphicon-check' : 'glyphicon-edit')?>" aria-hidden="true"></span>
						<h3>
							<?=$arLesson['UF_NAME']?>
						</h3>
						<p><i><?=$arLesson['UF_INFO']?></i></p>
						<?if(!empty($arLesson['UF_PICTURE'])):?>
							<div class="lesson-background" style="background: url(<?=\CFile::getPath($arLesson['UF_PICTURE'])?>) 50% 50% no-repeat;"></div>
						<?endif;?>
						<?/*<a data-pjax="<?=ft\CHelper::getLinkId($arParams['PJAX_LINK'])?>" href="<?=$arLesson['LINK']?>" title="<?=$arLesson['UF_NAME']?>">*/?>
					</div>
				</a>
			</div>
		<?endforeach;?>
	</div>
	

	<footer class="post-meta">
		<?//p($arResult);?>
	</footer>
	
</article>