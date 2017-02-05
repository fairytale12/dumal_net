<?
use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;
Loader::includeModule('iblock');
$arResult['AUTHOR'] = false;
if(!empty($arResult['PROPERTIES']['AUTHOR_ID']['VALUE'])) {
	$arResult['AUTHOR'] = UserTable::getList(array(
		'select' => array('ID', 'LAST_NAME', 'NAME', 'SECOND_NAME', 'PERSONAL_PHOTO', 'WORK_POSITION', 'WORK_PROFILE', 'UF_VK_LINK', 'UF_FB_LINK'), 
		'filter' => array('=ID' => $arResult['PROPERTIES']['AUTHOR_ID']['VALUE'])
	))->fetch();
	$arResult['AUTHOR']['FIO'] = ft\CHelper::getFio($arResult['AUTHOR']);
}

$arResult['PROGRAM'] = false;
if(!empty($arResult['PROPERTIES']['PROGRAM']['VALUE'])) {
	
	$arSort = array();
	
	$arFilter = array(
		'IBLOCK_ID' => PROGRAM_IBLOCK_ID, 
		'ACTIVE' => 'Y', 
		'ID' => $arResult['PROPERTIES']['PROGRAM']['VALUE']
	);
	
	$arSelect = array(
		'ID',
		'NAME',
		'DETAIL_PAGE_URL',
	);
	
	$arResult['PROGRAM'] = \CIBlockElement::getList($arSort, $arFilter, false, false, $arSelect)->getNext();
}

if(!empty($arResult['ID'])) {
	
	$arSort = array(
		$arParams['SORT_BY1'] => $arParams['SORT_ORDER1'], 
		$arParams['SORT_BY2'] => $arParams['SORT_ORDER2']
	);
	
	$arFilter = array(
		'ACTIVE' => 'Y',
		'IBLOCK_ID' => VIDEO_IBLOCK_ID,
	);
	
	$arNav = array(
		'nElementID' => $arResult['ID'], 
		'nPageSize' => 1
	);
	
	$arSelect = array(
		'ID',
		'NAME',
		'DETAIL_PAGE_URL',
	);
	
	$rsElement = \CIBlockElement::getList($arSort, $arFilter, false, $arNav, $arSelect);
	$type = 'LEFT';
	while($arElement = $rsElement->getNext()) {
		if($arElement['ID'] == $arResult['ID']) {
			$type = 'RIGHT';
			continue;
		}
		$arResult['NEIGHBORS'][$type] = $arElement;
	}

}

$arResult['ADD_CHAT'] = $arResult['PROPERTIES']['ADD_CHAT']['VALUE'];
$this->__component->SetResultCacheKeys(array('AUTHOR', 'ADD_CHAT'));
?>