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
$arParams['IS_AJAX'] = $arParams['IS_AJAX'] == 'Y';
if($arParams['IS_AJAX']) {
	$GLOBALS['APPLICATION']->restartBuffer();
}
?>
<h1 class="block-title"><span>Магазин програм</span></h1>
<?if(empty($arResult["ITEMS"])):?>
	<div class="alert alert-warning">
		У вас еще нет купленных программ.
	</div>
<?else:?>
	<div id="ajax-pager-list" class="row">
		<?foreach($arResult["ITEMS"] as $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
			
			<div id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="col-md-6">
				<article class="news-block small-block">
					<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
						<a data-pjax="" href="<?=$arItem['DETAIL_PAGE_URL']?>" class="overlay-link" title="<?=$arItem['NAME']?>">
							<figure class="image-overlay">
								<img src="<?=ft\CTPic::resizeImage($arItem['PREVIEW_PICTURE']['ID'], 'crop', 350, 230)?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>">
							</figure>
						</a>
					<?endif;?>
					<span class="category">
						<?=ft\CHelper::wordDeclension($arItem['PROPERTIES']['MAX_LESSONS']['VALUE'], 'занятие', 'занятия', 'занятий')?>
					</span>
					<header class="news-details">
						<h3 class="news-title">
							<a data-pjax="" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>">
								<?=$arItem['NAME']?>
							</a>
						</h3>
						<p class="simple-share">
							<?if(!empty($arResult['AUTHORS'][$arItem['PROPERTIES']['AUTHOR_ID']['VALUE']])):?>
								<b><?=$arResult['AUTHORS'][$arItem['PROPERTIES']['AUTHOR_ID']['VALUE']]['NAME']?></b> -  
							<?endif;?>
							<span class="article-date"><i class="fa fa-clock-o"></i> <?=strtolower($arItem['DISPLAY_ACTIVE_FROM'])?></span>
						</p>
					</header>
				</article>
			</div>
			
		<?endforeach;?>
	</div>
	<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
		<?=$arResult["NAV_STRING"]?>
	<?endif;?>
	<?
	if($arParams['IS_AJAX']) {
		die();
	}
	?>
<?endif;?>