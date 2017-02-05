<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;

$arResult = array();



if ($this->StartResultCache(false, false)) {
	
	$arUserIds = \CGroup::GetGroupUser(LEADING_GROUP_ID);
	
	if(empty($arUserIds) || !is_array($arUserIds)) {
		$this->abortResultCache();
		return false;
	}
	
	$maxRowCount = 3;
	$rowCount = 0;
	$userCount = 0;
	
	$arSort = array(
		'UF_SORT' => 'ASC', 
		'ID' => 'ASC'
	);
	
	$arFilter = array('=ID' => $arUserIds);
	
	$arSelect = array(
		'ID', 
		'LAST_NAME', 
		'NAME', 
		'SECOND_NAME', 
		'PERSONAL_PHOTO', 
		'WORK_POSITION', 
		'WORK_PROFILE', 
		'UF_VK_LINK', 
		'UF_FB_LINK'
	);
	
	$rsUser = UserTable::getList(array(
		'select' => $arSelect, 
		'filter' => $arFilter,
		'order' => $arSort
	));
	while($arUser = $rsUser->fetch()) {
		$arUser['FIO'] = ft\CHelper::getFio($arUser);
		$arResult['USERS'][$rowCount][] = $arUser;
		
		$userCount++;
		if($userCount >= $maxRowCount) {
			$userCount = 0;
			$rowCount++;
		}
	}
	
	$this->IncludeComponentTemplate(); 
}


?>
