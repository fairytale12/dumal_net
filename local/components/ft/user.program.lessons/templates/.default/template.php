<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<article class="post-wrapper clearfix">

	<header class="post-header">
		<h1 class="post-title">
			<?=$arResult['PROGRAM']['NAME']?>
		</h1>
	</header>
	
	<div class="post-content clearfix">
		<?=$arResult['PROGRAM']['DETAIL_TEXT']?>
	</div>
	
	<div class="lessons-list row clearfix">
		<?foreach($arResult['LESSONS'] as $arLesson):?>
			<div class="col-md-6">
				<div class="simple-post lesson-block">
					<h3>
						<a data-pjax="" href="<?=$arLesson['LINK']?>" title="<?=$arLesson['UF_NAME']?>">
							<?=$arLesson['UF_NAME']?>
						</a>
					</h3>
					<p><i><?=$arLesson['UF_INFO']?></i></p>
				</div>
			</div>
		<?endforeach;?>
	</div>
	

	<footer class="post-meta">
		<?//p($arResult);?>
	</footer>
	
</article>