<?if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();?>

<?foreach($arResult['USERS'] as $arRow):?>
	<div class="row">
		<?foreach($arRow as $arUser):?>
			<div class="col-md-4">
				<div class="widget author-widget">	
					<?if(!empty($arUser['PERSONAL_PHOTO'])):?>
						<div class="author-thumb">
							<img src="<?=ft\CTPic::resizeImage($arUser['PERSONAL_PHOTO'], 'crop', 141, 141)?>" alt="<?=$arUser['FIO']?>" title="<?=$arUser['FIO']?>">
						</div>
					<?endif;?>
					<div class="author-meta">
						<h3 class="author-title">
							<?=$arUser['FIO']?>
						</h3>
						<p class="author-position"><?=$arUser['WORK_POSITION']?></p>
						<p class="author-bio"><?=htmlspecialcharsBack($arUser['WORK_PROFILE'])?></p>
						<div class="author-page-contact">
							<?if(!empty($arUser['UF_VK_LINK'])):?>
								<a target="_blank" href="<?=$arUser['UF_VK_LINK']?>" title="<?=$arUser['FIO']?> в ВКонтакте">
									<i class="fa fa-vk"></i>
								</a> 
							<?endif;?>
							<?if(!empty($arUser['UF_FB_LINK'])):?>
								<a target="_blank" href="<?=$arUser['UF_FB_LINK']?>" title="<?=$arUser['FIO']?> в Facebook">
									<i class="fa fa-facebook"></i>
								</a>
							<?endif;?>
						</div>
					</div>
				</div>
			</div>
		<?endforeach;?>
	</div>
<?endforeach;?>