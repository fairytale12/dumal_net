<?
use Bitrix\Main\UserTable;
$arAuthorIds = array();
foreach($arResult["ITEMS"] as $arItem) {
	if($arItem['PROPERTIES']['AUTHOR_ID']['VALUE']) {
		$arAuthorIds[] = $arItem['PROPERTIES']['AUTHOR_ID']['VALUE'];
	}
}

if(!empty($arAuthorIds)) {
	$arAuthorIds = array_unique($arAuthorIds);
	$rsAuthor = UserTable::getList(array('select' => array('ID', 'LAST_NAME', 'NAME', 'SECOND_NAME'), 'filter' => array('=ID' => $arAuthorIds)));
	while($arAuthor = $rsAuthor->fetch()) {
		$arResult['AUTHORS'][$arAuthor['ID']] = array(
			'NAME' => ft\CHelper::getFio($arAuthor),
		);
	}
}

$arResult['SECTIONS'] = array();

if(!empty($arParams['IBLOCK_ID'])) {
	
	$currentSectionId = intval($arResult['SECTION']['PATH'][0]['ID']);
	
	$arSort = array('SORT' => 'ASC');
	$arFilter = array(
		'IBLOCK_ID' 	=> $arParams['IBLOCK_ID'],
		'GLOBAL_ACTIVE' => 'Y',
		'ACTIVE' 		=> 'Y',
		'DEPTH_LEVEL' 	=> 1
	);
	$arSelect = array(
		'ID',
		'NAME',
		'SECTION_PAGE_URL'
	);

	$rsSections = \CIBlockSection::getList($arSort, $arFilter, false, $arSelect);
	while($arSection = $rsSections->getNext()) {
		$arSection['SELECTED'] = ($currentSectionId == $arSection['ID']);
		$arResult['SECTIONS'][] = $arSection;
	}
	
	if(!empty($arResult['SECTIONS'])) {
		
		array_unshift($arResult['SECTIONS'], array(
			'ID' 				=> 0,
			'NAME' 				=> 'Все видео',
			'SECTION_PAGE_URL' 	=> $arParams['IBLOCK_URL'],
			'SELECTED' 			=> ($currentSectionId == 0)
		));
	}

}

$this->__component->SetResultCacheKeys(array('SECTIONS'));
?>