<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arResult = array();

if($GLOBALS['USER']->IsAuthorized()) {
	LocalRedirect('/account/');
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['change_password']) && !$GLOBALS['USER']->IsAuthorized()) {
	
	
	
	$arReturn = ft\CUserValidation::checkChangePasswordFields($_POST);
	
	$arResult['POST'] = $arReturn['FIELDS'];
	$arResult['ERRORS'] = $arReturn['ERRORS'];
	
	if(empty($arResult['ERRORS'])) {
		$objUser = new ft\CUser;
		$result = $objUser->ChangePassword($arResult['POST']['LOGIN'], $arResult['POST']['USER_CHECKWORD'], $arResult['POST']['PASSWORD'], $arResult['POST']['CONFIRM_PASSWORD']);
		
		if($result['TYPE'] != 'OK') {
			$arResult['ERRORS'][] = $result['MESSAGE'];	
		} else {
			LocalRedirect('/account/');
		}
	}
	
} elseif(empty($_POST['change_password'])) {
	$arResult['POST']['LOGIN'] = $_GET['URL_LOGIN'];
	$arResult['POST']['USER_CHECKWORD'] = $_GET['USER_CHECKWORD'];
}

$this->IncludeComponentTemplate(); 


?>
