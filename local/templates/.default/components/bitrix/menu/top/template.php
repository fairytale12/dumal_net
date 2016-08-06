<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>
<div class="navbar-collapse collapse">
	<ul class="nav navbar-nav">

	<?
	$previousLevel = 0;
	foreach($arResult as $arItem):?>

		<?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
			<?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
		<?endif?>

		<?if ($arItem["IS_PARENT"]):?>

			<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				<li class="dropdown menu-color1<?=($arItem['SELECTED'] ? ' active' : '')?><?=(!empty($arItem['PARAMS']['CLASS']) ? trim(' ' . $arItem['PARAMS']['CLASS']) : '')?>">
					<a href="javascript:void(0);" <?/*href="<?=$arItem["LINK"]?>"*/?> class="dropdown-toggle" <?/*data-toggle="dropdown" */?>role="button" aria-expanded="false"><?=$arItem["TEXT"]?></a>
					<ul class="dropdown-menu">
			<?else:?>
				<li class="dropdown-submenu<?=($arItem['SELECTED'] ? ' active' : '')?>">
					<a<?=(!$arItem['PARAMS']['NOT_PJAX'] ? ' data-pjax=""' : '')?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					<ul class="dropdown-menu">
			<?endif?>

		<?else:?>

			<?if ($arItem["PERMISSION"] > "D"):?>

				<?if ($arItem["DEPTH_LEVEL"] == 1):?>
				
					<li class="menu-color1<?=($arItem['SELECTED'] ? ' active' : '')?>">
						<a<?=(!$arItem['PARAMS']['NOT_PJAX'] ? ' data-pjax=""' : '')?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
					</li>
					
				<?else:?>
					<li<?=($arItem['SELECTED'] ? ' class="active"' : '')?>>
						<a<?=(!$arItem['PARAMS']['NOT_PJAX'] ? ' data-pjax=""' : '')?> href="<?=$arItem["LINK"]?>"><?=$arItem["TEXT"]?></a>
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
<?endif?>