<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arResult = array();

if($GLOBALS['USER']->IsAuthorized()) {
	LocalRedirect('/account/');
}

$arResult["CAPTCHA_CODE"] = false;
$arSession = ft\CHelper::getSession();
if($arSession['RECOVER_PASSWORD']['COUNT'] >= 3) {
	$arResult["CAPTCHA_CODE"] = $APPLICATION->CaptchaGetCode();
}

if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['recover']) && !$GLOBALS['USER']->IsAuthorized()) {
	
	
	$arReturn = ft\CUserValidation::checkRecoverFields($_POST, $arResult["CAPTCHA_CODE"]);
	
	$arResult['POST'] = $arReturn['FIELDS'];
	$arResult['ERRORS'] = $arReturn['ERRORS'];
	
	if(empty($arResult['ERRORS'])) {
		$objUser = new ft\CUser;
		$result = $objUser->SendPassword($arResult['POST']['EMAIL']);
		ft\CHelper::setSession(array(
			'RECOVER_PASSWORD' => array(
				'EMAIL' => $arResult['POST']['EMAIL'],
				'COUNT' => ($arSession['RECOVER_PASSWORD']['EMAIL'] == $arResult['POST']['EMAIL'] ? ++$arSession['RECOVER_PASSWORD']['COUNT'] : 1)
			)
		));
		
		if($result['TYPE'] != 'OK') {
			$arResult['ERRORS'][] = $result['MESSAGE'];
		} else {
			LocalRedirect($GLOBALS['APPLICATION']->GetCurPageParam('result=send', array('result')));
		}
	}
	
}

$this->IncludeComponentTemplate(); 

?>
