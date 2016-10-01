<?if(!empty($arParams['SECTIONS'])):?>
	<div class="widget categorywidget">
		<h3 class="block-title"><span>Разделы</span></h3>
		<ul>
		<?foreach($arParams['SECTIONS'] as $arSection):?>
			<li<?=($arSection['SELECTED'] ? ' class="active"' : '')?>>
				<a data-pjax="" href="<?=$arSection['SECTION_PAGE_URL']?>" title="<?=$arSection['NAME']?>"><?=$arSection['NAME']?></a>
			</li>
		<?endforeach;?>
		</ul>
	</div>
<?endif;?>