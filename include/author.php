<div class="widget author-widget">	
	<?if(!empty($arParams['PERSONAL_PHOTO'])):?>
		<div class="author-thumb">
			<img src="<?=ft\CTPic::resizeImage($arParams['PERSONAL_PHOTO'], 'crop', 141, 141)?>" alt="<?=$arParams['FIO']?>" title="<?=$arParams['FIO']?>">
		</div>
	<?endif;?>
	<div class="author-meta">
		<h3 class="author-title">
			<?=$arParams['FIO']?>
		</h3>
		<p class="author-position"><?=$arParams['WORK_POSITION']?></p>
		<p class="author-bio"><?=htmlspecialcharsBack($arParams['WORK_PROFILE'])?></p>
		<div class="author-page-contact">
			<?if(!empty($arParams['UF_VK_LINK'])):?>
				<a target="_blank" href="<?=$arParams['UF_VK_LINK']?>" title="<?=$arParams['FIO']?> в ВКонтакте">
					<i class="fa fa-vk"></i>
				</a> 
			<?endif;?>
			<?if(!empty($arParams['UF_FB_LINK'])):?>
				<a target="_blank" href="<?=$arParams['UF_FB_LINK']?>" title="<?=$arParams['FIO']?> в Facebook">
					<i class="fa fa-facebook"></i>
				</a>
			<?endif;?>
		</div>
	</div>
</div>