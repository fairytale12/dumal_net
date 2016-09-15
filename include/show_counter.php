<?
$arParams['ID'] = intval($arParams['ID']);
if(!empty($arParams['ID'])):?>
	<?$arElement = $GLOBALS['DB']->query('SELECT `SHOW_COUNTER` COUNTER FROM `b_iblock_element` WHERE `ID` = ' . $arParams['ID'])->fetch();?>
	<span><i class="fa fa-eye"></i> <?=ft\CHelper::wordDeclension(intval($arElement['COUNTER']), 'просмотр', 'просмотра', 'просмотров')?></span>
<?endif;?>