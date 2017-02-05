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
<h1 class="block-title"><span>Программы</span></h1>
<div id="ajax-pager-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		
		
		<article id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="news-block big-block">
			<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
				<a data-pjax="<?=ft\CHelper::getLinkId($arParams['PJAX_LINK'])?>" href="<?=$arItem['DETAIL_PAGE_URL']?>" class="overlay-link" title="<?=$arItem['NAME']?>">
					<figure class="image-overlay">
						<img src="<?=ft\CTPic::resizeImage($arItem['PREVIEW_PICTURE']['ID'], 'crop', 730, 480)?>" alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>">
					</figure>
				</a>
				<div class="category">
					<?=ft\CHelper::wordDeclension($arItem['PROPERTIES']['MAX_LESSONS']['VALUE'], 'занятие', 'занятия', 'занятий')?>
				</div>
			<?endif;?>
			<div class="news-details">
				<h3 class="news-title">
					<a data-pjax="<?=ft\CHelper::getLinkId($arParams['PJAX_LINK'])?>" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>">
						<?=$arItem['NAME']?>
					</a>
				</h3>
				<div class="row">
					<div class="col-md-12">
						<p class="program-preview-text-block">
						<?=ft\CHelper::textCut($arItem['PREVIEW_TEXT'], 230)?>
						</p>
					</div>
				</div>
				<p class="simple-share">
					<?if(!empty($arResult['AUTHORS'][$arItem['PROPERTIES']['AUTHOR_ID']['VALUE']])):?>
						<b><?=$arResult['AUTHORS'][$arItem['PROPERTIES']['AUTHOR_ID']['VALUE']]['NAME']?></b> -  
					<?endif;?>
					<span class="article-date"><i class="fa fa-clock-o"></i> <?=strtolower($arItem['DISPLAY_ACTIVE_FROM'])?></span>
				</p>
			</div>
		</article>

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