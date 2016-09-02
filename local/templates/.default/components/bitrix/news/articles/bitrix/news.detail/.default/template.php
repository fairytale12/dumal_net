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
		<?if(!empty($arResult['DETAIL_PICTURE'])):?>
			<figure class="image-overlay">
				<img src="<?=ft\CTPic::resizeImage($arResult['DETAIL_PICTURE']['ID'], 'crop', 730, 425)?>" alt="<?=$arResult['NAME']?>" title="<?=$arResult['NAME']?>">
			</figure>
		<?endif;?>
	</header>

	<div class="post-content clearfix">
		<?=$arResult['DETAIL_TEXT']?>
	</div>

	<footer class="post-meta">

		<div class="share-wrapper clearfix">

			<div class="share-buttons">
				<?$GLOBALS['APPLICATION']->IncludeFile('/include/share_buttons.php', array('ID' => $arResult['ID']))?>
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
									Предыдущая статья
								</div>
								<a data-pjax="" href="<?=$arResult['NEIGHBORS']['LEFT']['DETAIL_PAGE_URL']?>" class="post-nav-title"><?=$arResult['NEIGHBORS']['LEFT']['NAME']?></a>
							</div>
						</div>
					<?endif;?>
					<?if(!empty($arResult['NEIGHBORS']['RIGHT'])):?>
						<div class="col-md-6 alpha text-right">
							<div class="next-post">
								<div class="post-nav-label">
									Следующая статья
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