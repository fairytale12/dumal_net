<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['subscribe']) {

	$arPost = ft\CHelper::prepareFields($_POST);
	
	$arReturn = ft\CSubscribe::subscribe(intval($GLOBALS['USER']->getId()), $arPost['email'], array(), true);
	ft\CHelper::returnJsonAnswer($arReturn);
	
}
die();
?>