<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

use Bitrix\Main\UserTable;

$arParams['USER_ID'] = intval($GLOBALS['USER']->getId());
$arParams['RUBRIC_ID'] = htmlspecialchars($arParams['RUBRIC_ID']);
if(empty($arParams['RUBRIC_ID'])) {
	return;
}

$arResult = array();

if(!empty($arParams['USER_ID'])) {
	$arResult['USER'] = UserTable::getList(array('select' => array('ID', 'EMAIL'), 'filter' => array('ID' => $arParams['USER_ID'])))->fetch();
}

/*
if(empty($arResult['POST']['email']) && !empty($arResult['USER']['ID'])) {
	$arResult['POST']['email'] = $arResult['USER']['EMAIL'];
}
*/

$this->IncludeComponentTemplate();

?>
