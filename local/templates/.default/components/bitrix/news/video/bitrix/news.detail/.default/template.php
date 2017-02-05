<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<article class="post-wrapper clearfix">

	<header class="post-header">

		<h1 class="post-title">
			<?=$arResult['NAME']?>
		</h1>

		<p class="simple-share">
			<?if(!empty($arResult['AUTHOR'])):?>
				<span><b><?=$arResult['AUTHOR']['FIO']?></b></span>
			<?endif;?>
			<span><span class="article-date"><i class="fa fa-clock-o"></i> <?=strtolower($arResult['DISPLAY_ACTIVE_FROM'])?></span></span>
			<?itc\CUncachedArea::show('article-counter-block')?>
		</p>
		<?if(!empty($arResult['PROPERTIES']['YOUTUBE']['VALUE'])):?>
			<figure class="image-overlay">
				<?=ft\CYouTube::insertHTMLVideo($arResult['PROPERTIES']['YOUTUBE']['VALUE'], 730, 425)?>
			</figure>
		<?endif;?>
	</header>
	
	<?if(!empty($arResult['PROGRAM'])):?>
		<p>Интересно? Тогда обязательно поучаствуйте в программе &laquo;<a data-pjax="<?=ft\CHelper::getLinkId('/programs/')?>" href="<?=$arResult['PROGRAM']['DETAIL_PAGE_URL']?>"><?=$arResult['PROGRAM']['NAME']?></a>&raquo;!</p>
	<?endif;?>
	
	<div class="post-content clearfix">
		<?=$arResult['DETAIL_TEXT']?>
	</div>

	<footer class="post-meta">

		<div class="share-wrapper clearfix">

			<div class="share-buttons">
				<?$GLOBALS['APPLICATION']->IncludeFile('/include/share_buttons.php', array(
					'URL' => $GLOBALS['APPLICATION']->getCurPage(false),
					'TITLE' => $arResult['NAME'],
					'IMG_PATH' => ft\CTPic::resizeImage($arResult['DETAIL_PICTURE']['ID'], 'crop', 730, 425),
					'DESC' => $arResult['PREVIEW_TEXT'],
				));?>
			</div>
		</div>                              
		<?if(!empty($arResult['NEIGHBORS'])):?>
			<div class="row">
				
				<div class="post-nav-wrapper clearfix">
					
					<div class="col-md-6 omega">
						<?if(!empty($arResult['NEIGHBORS']['LEFT'])):?>
							<div class="previous-post">
								<div class="post-nav-label">
									<i class="fa fa-angle-left"></i>
									Предыдущее видео
								</div>
								<a data-pjax="<?=ft\CHelper::getLinkId($arParams['PJAX_LINK'])?>" href="<?=$arResult['NEIGHBORS']['LEFT']['DETAIL_PAGE_URL']?>" class="post-nav-title"><?=$arResult['NEIGHBORS']['LEFT']['NAME']?></a>
							</div>
						<?endif;?>
					</div>
					
					<div class="col-md-6 alpha">
						<?if(!empty($arResult['NEIGHBORS']['RIGHT'])):?>
							<div class="next-post">
								<div class="post-nav-label">
									Следующее видео
									<i class="fa fa-angle-right"></i>
								</div>
								<a data-pjax="<?=ft\CHelper::getLinkId($arParams['PJAX_LINK'])?>" href="<?=$arResult['NEIGHBORS']['RIGHT']['DETAIL_PAGE_URL']?>" class="post-nav-title"><?=$arResult['NEIGHBORS']['RIGHT']['NAME']?></a>
							</div>
						<?endif;?>
					</div>
					
				</div>
			</div>
		<?endif;?>

	</footer>

</article>