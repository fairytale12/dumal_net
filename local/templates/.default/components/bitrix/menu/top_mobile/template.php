<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<nav id="mobile-nav" class="mm-menu mm-offcanvas">
	<div>
		<ul>
			<li class="<?=($arItem['SELECTED'] ? 'active' : '')?>">
				<a data-pjax="<?=ft\CHelper::getLinkId('/')?>" href="/">Главная</a>
			</li>
		<?
		$previousLevel = 0;
		foreach($arResult as $arItem):?>
			
			<?if($arItem['PARAMS']['IS_MOBILE'] && $arParams['IS_MOBILE'] != 'Y') {
				continue;
			}?>
			
			<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
				<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
			<?endif?>

			<?if ($arItem["IS_PARENT"]):?>

				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						
					<li class="<?=($arItem['SELECTED'] ? 'active' : '')?><?=(!empty($arItem['PARAMS']['CLASS']) ? trim(' ' . $arItem['PARAMS']['CLASS']) : '')?>">
						<a href="javascript:void(0);"><?=$arItem["TEXT"]?></a>
						<ul>				
						
				<?else:?>
				
					<li class="<?=($arItem['SELECTED'] ? 'active' : '')?>">
						<a<?=(!$arItem['PARAMS']['NOT_PJAX'] ? ' data-pjax="' . ft\CHelper::getLinkId($arItem["LINK"]) . '"' : '')?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
						<ul>
				<?endif?>

			<?else:?>

				<?if ($arItem["PERMISSION"] > "D"):?>

					<?if ($arItem["DEPTH_LEVEL"] == 1):?>
						
						<li class="<?=($arItem['SELECTED'] ? 'active' : '')?>">
							<a<?=(!$arItem['PARAMS']['NOT_PJAX'] ? ' data-pjax="' . ft\CHelper::getLinkId($arItem["LINK"]) . '"' : '')?> href="<?=$arItem["LINK"]?>"
								<?=(!empty($arItem['PARAMS']['ONCLICK']) ? ' onclick="' . $arItem['PARAMS']['ONCLICK'] . '"' : '')?>><?=$arItem["TEXT"]?></a>
						</li>
						
					<?else:?>
					
						<li class="<?=($arItem['SELECTED'] ? 'active' : '')?>">
							<a<?=(!$arItem['PARAMS']['NOT_PJAX'] ? ' data-pjax="' . ft\CHelper::getLinkId($arItem["LINK"]) . '"' : '')?> href="<?=$arItem["LINK"]?>"
								<?=(!empty($arItem['PARAMS']['ONCLICK']) ? ' onclick="' . $arItem['PARAMS']['ONCLICK'] . '"' : '')?>><?=$arItem["TEXT"]?></a>
						</li>
						
					<?endif?>

				<?endif?>

			<?endif?>

			<?$previousLevel = $arItem["DEPTH_LEVEL"];?>

		<?endforeach?>

		<?if ($previousLevel > 1)://close last item tags?>
			<?=str_repeat("</ul></li>", ($previousLevel-1) );?>
		<?endif?>

		</ul>
	</div>
</nav>
<?endif?>