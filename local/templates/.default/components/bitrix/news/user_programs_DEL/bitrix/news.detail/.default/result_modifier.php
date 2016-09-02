<?
use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;
$arResult['AUTHOR'] = false;
if(!empty($arResult['PROPERTIES']['AUTHOR_ID']['VALUE'])) {
	$arResult['AUTHOR'] = UserTable::getList(array(
		'select' => array('ID', 'LAST_NAME', 'NAME', 'SECOND_NAME', 'PERSONAL_PHOTO', 'WORK_POSITION', 'WORK_PROFILE', 'UF_VK_LINK', 'UF_FB_LINK'), 
		'filter' => array('=ID' => $arResult['PROPERTIES']['AUTHOR_ID']['VALUE'])
	))->fetch();
	$arResult['AUTHOR']['FIO'] = ft\CHelper::getFio($arResult['AUTHOR']);
}

if(!empty($arResult['ID'])) {
	
	Loader::includeModule('iblock');
	$arSort = array(
		$arParams['SORT_BY1'] => $arParams['SORT_ORDER1'], 
		$arParams['SORT_BY2'] => $arParams['SORT_ORDER2']
	);
	
	$arFilter = array(
		'ACTIVE' => 'Y',
		'IBLOCK_ID' => ARTICLES_IBLOCK_ID,
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
$this->__component->SetResultCacheKeys(array('AUTHOR'));
?>