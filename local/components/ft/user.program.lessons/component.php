<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;

$arParams['PROGRAM_CODE'] = htmlspecialchars($arParams['PROGRAM_CODE']);
$arParams['USER_ID'] = intval($arParams['USER_ID']);

$arResult = array();


if ($this->StartResultCache(false, false)) {
	CModule::IncludeModule('iblock');
	
	
	$arResult = ft\CUserPrograms::getProgramLessons($arParams['PROGRAM_CODE'], $arParams['USER_ID']);
	

	$arResult['AUTHOR'] = false;
	if(!empty($arResult['PROGRAM']['PROPERTIES']['AUTHOR_ID']['VALUE'])) {
		$arResult['AUTHOR'] = UserTable::getList(array(
			'select' => array('ID', 'LAST_NAME', 'NAME', 'SECOND_NAME', 'PERSONAL_PHOTO', 'WORK_POSITION', 'WORK_PROFILE', 'UF_VK_LINK', 'UF_FB_LINK'), 
			'filter' => array('=ID' => $arResult['PROGRAM']['PROPERTIES']['AUTHOR_ID']['VALUE'])
		))->fetch();
		$arResult['AUTHOR']['FIO'] = ft\CHelper::getFio($arResult['AUTHOR']);
	}
	
	$this->IncludeComponentTemplate(); 
}


?>
