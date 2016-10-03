<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
if($_SERVER['REQUEST_METHOD'] == 'POST') {

	$arPost = ft\CHelper::prepareFields($_POST);
	
	$arReturn = ft\CUser::pilotProgram($arPost['id'], $arPost['email']);
	ft\CHelper::returnJsonAnswer($arReturn);
	
}
die();
?>