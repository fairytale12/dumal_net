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

<article class="programm-detail post-wrapper clearfix">

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
		<?if(!empty($arResult['DETAIL_PICTURE'])):?>
			<figure class="image-overlay">
				<img src="<?=ft\CTPic::resizeImage($arResult['DETAIL_PICTURE']['ID'], 'crop', 730, 480)?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>">
				<div class="category">
					<?=ft\CHelper::wordDeclension($arResult['PROPERTIES']['MAX_LESSONS']['VALUE'], 'занятие', 'занятия', 'занятий')?>
				</div>
			</figure>
			
			
		<?endif;?>
	</header>

	<div class="post-content clearfix">
		<?=$arResult['DETAIL_TEXT']?>
	</div>

	<footer class="post-meta">
	
		<div class="program-buy-block">	
			<div class="program-price-block inline-block">
				<?=ft\CHelper::showPrice($arResult['PROPERTIES']['PRICE']['VALUE'])?>
			</div>

			<div class="inline-block">
				<button type="button" class="btn btn-success">Принять участие</button>
			</div>
		</div>

		<div class="share-wrapper clearfix">

			<div class="share-buttons">
				<?$GLOBALS['APPLICATION']->IncludeFile('/include/share_buttons.php', array(
					'URL' => $GLOBALS['APPLICATION']->getCurPage(false),
					'TITLE' => $arResult['NAME'],
					'IMG_PATH' => ft\CTPic::resizeImage($arResult['DETAIL_PICTURE']['ID'], 'crop', 730, 480),
					'DESC' => $arResult['PREVIEW_TEXT'],
				));?>
			</div>
		</div>                              
		<?if(!empty($arResult['NEIGHBORS'])):?>
			<div class="row">
				
				<div class="post-nav-wrapper clearfix">
					<?if(!empty($arResult['NEIGHBORS']['LEFT'])):?>
						<div class="col-md-6 omega">
							<div class="previous-post">
								<div class="post-nav-label">
									<i class="fa fa-angle-left"></i>
									Предыдущая программа
								</div>
								<a data-pjax="" href="<?=$arResult['NEIGHBORS']['LEFT']['DETAIL_PAGE_URL']?>" class="post-nav-title"><?=$arResult['NEIGHBORS']['LEFT']['NAME']?></a>
							</div>
						</div>
					<?endif;?>
					<?if(!empty($arResult['NEIGHBORS']['RIGHT'])):?>
						<div class="col-md-6 alpha text-right">
							<div class="next-post">
								<div class="post-nav-label">
									Следующая программа
									<i class="fa fa-angle-right"></i>
								</div>
								<a data-pjax="" href="<?=$arResult['NEIGHBORS']['RIGHT']['DETAIL_PAGE_URL']?>" class="post-nav-title"><?=$arResult['NEIGHBORS']['RIGHT']['NAME']?></a>
							</div>
						</div>
					<?endif;?>
				</div>
			</div>
		<?endif;?>

	</footer>

</article>