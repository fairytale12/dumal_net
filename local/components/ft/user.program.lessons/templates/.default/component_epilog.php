<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>
<?
$GLOBALS['APPLICATION']->setPageProperty('title', $arResult['PROGRAM']['NAME']);
?>
<?
if(!empty($arResult['AUTHOR'])):
?>
	<?itc\CUncachedArea::startCapture('article-author-block');?>
	<div class="widget author-widget">
		<?if(!empty($arResult['AUTHOR']['PERSONAL_PHOTO'])):?>
			<div class="author-thumb">
				<img src="<?=ft\CTPic::resizeImage($arResult['AUTHOR']['PERSONAL_PHOTO'], 'crop', 141, 141)?>" alt="<?=$arResult['AUTHOR']['FIO']?>" title="<?=$arResult['AUTHOR']['FIO']?>">
			</div>
		<?endif;?>
		<div class="author-meta">
			<h3 class="author-title">
				<?=$arResult['AUTHOR']['FIO']?>
			</h3>
			<p class="author-position"><?=$arResult['AUTHOR']['WORK_POSITION']?></p>
			<p class="author-bio"><?=htmlspecialcharsBack($arResult['AUTHOR']['WORK_PROFILE'])?></p>
			<div class="author-page-contact">
				<?if(!empty($arResult['AUTHOR']['UF_VK_LINK'])):?>
					<a target="_blank" href="<?=$arResult['AUTHOR']['UF_VK_LINK']?>" title="<?=$arResult['AUTHOR']['FIO']?> в ВКонтакте">
						<i class="fa fa-vk"></i>
					</a> 
				<?endif;?>
				<?if(!empty($arResult['AUTHOR']['UF_FB_LINK'])):?>
					<a target="_blank" href="<?=$arResult['AUTHOR']['UF_FB_LINK']?>" title="<?=$arResult['AUTHOR']['FIO']?> в Facebook">
						<i class="fa fa-facebook"></i>
					</a>
				<?endif;?>
			</div>
		</div>
	</div>
	<?itc\CUncachedArea::endCapture();?>
<?endif;?>