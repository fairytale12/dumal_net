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
<h1 class="block-title"><span>Статьи</span></h1>
<div id="ajax-pager-list">
	<?foreach($arResult["ITEMS"] as $arItem):?>
		<?
		$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
		$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
		?>
		
		
		<article id="<?=$this->GetEditAreaId($arItem['ID']);?>" class="simple-post simple-big clearfix">
			<?if(!empty($arItem['PREVIEW_PICTURE'])):?>
				<div class="simple-thumb">
					<a data-pjax="" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>">
						<img alt="<?=$arItem['NAME']?>" title="<?=$arItem['NAME']?>" src="<?=ft\CTPic::resizeImage($arItem['PREVIEW_PICTURE']['ID'], 'crop', 255, 180)?>">
					</a>
				</div>
			<?endif;?>
			<header>
				<p class="simple-share">
					<?if(!empty($arResult['AUTHORS'][$arItem['PROPERTIES']['AUTHOR_ID']['VALUE']])):?>
						<b><?=$arResult['AUTHORS'][$arItem['PROPERTIES']['AUTHOR_ID']['VALUE']]['NAME']?></b> -  
					<?endif;?>
					<span><i class="fa fa-clock-o"></i> <?=strtolower($arItem['DISPLAY_ACTIVE_FROM'])?></span>
				</p>

				<h3>
					<a data-pjax="" href="<?=$arItem['DETAIL_PAGE_URL']?>" title="<?=$arItem['NAME']?>"><?=$arItem['NAME']?></a>
				</h3>

				<p class="excerpt">
					<?=$arItem['PREVIEW_TEXT']?>
				</p>
			</header>
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