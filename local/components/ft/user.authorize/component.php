<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arResult = array();

$arResult["~LAST_LOGIN"] = $_COOKIE[\COption::GetOptionString("main", "cookie_name", "BITRIX_SM")."_LOGIN"];
$arResult["LAST_LOGIN"] = htmlspecialcharsbx($arResult["~LAST_LOGIN"]);

$arResult['NEED_TO_REDIRECT'] = false;
$arResult['NEED_TO_IFRAME'] = false;

$rsUserTypes = \CUserFieldEnum::GetList(array('SORT' => 'ASC'), array('USER_FIELD_NAME' => 'UF_TYPE'));
while($arUserType = $rsUserTypes->Fetch()) {
	$arResult['FIELDS']['UF_TYPE'][] = $arUserType;
}

if(\CModule::IncludeModule('socialservices')) {
	
	//$oAuthManager = new \CSocServAuthManager();
	$sebekonOAuthManager = new ft\CSocServAuthManager();
	$arResult['FIELDS']['CURRENT_SERVICE'] = false;
	$arSocServices = array(
		'AUTH_SERVICES' => false,
		'CURRENT_SERVICE' => false
	);
	$arResult['FIELDS']['SERVICES'] = $sebekonOAuthManager->GetActiveAuthServices($arSocServices);
}

$arResult['ERRORS'] = array();


if(!empty($arResult['FIELDS']['SERVICES']))
{
	
	if(isset($_REQUEST["auth_service_id"]) && $_REQUEST["auth_service_id"] <> '' && isset($arResult['FIELDS']['SERVICES'][$_REQUEST["auth_service_id"]]))
	{
		$arResult['FIELDS']['CURRENT_SERVICE'] = $_REQUEST["auth_service_id"];
		if(isset($_REQUEST["auth_service_error"]) && $_REQUEST["auth_service_error"] <> '')
		{
			$arResult['ERRORS'][] = $sebekonOAuthManager->GetError($arResult['FIELDS']['CURRENT_SERVICE'], $_REQUEST["auth_service_error"]);
		}
		elseif(!$sebekonOAuthManager->checkUser($_REQUEST["auth_service_id"], array('CHECK_USER' => true, 'SEND_REGISTER' => false, 'ONLY_ACTIVE' => true)))
		{
			$ex = $APPLICATION->GetException();
			if ($ex) {
				$arResult['ERRORS'][] = $ex->GetString();
			}
		}

	}
}

$arResult["CAPTCHA_CODE"] = false;
if($APPLICATION->NeedCAPTHAForLogin($arResult["LAST_LOGIN"])) {
	$arResult["CAPTCHA_CODE"] = $APPLICATION->CaptchaGetCode();
}


if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['login']) && !$GLOBALS['USER']->IsAuthorized()) {
	
	// Обычная авторизация
	
	$arReturn = ft\CUserValidation::checkLoginFields($_POST);
	
	$arResult['POST'] = $arReturn['FIELDS'];
	$arResult['ERRORS'] = $arReturn['ERRORS'];
	
	if(empty($arResult['ERRORS'])) {
		
		// Если ошибок нет, то пытаемся авторизоваться
		
		$objUser = new ft\CUser;
		
		$result = $objUser->Login($arResult['POST']['EMAIL'], $arResult['POST']['PASSWORD'], 'Y');
		if($result !== true) {
			
			$arResult['ERRORS'][] = $result['MESSAGE'];
			
		} else {
			$arResult['LOGIN_SUCCESS'] = true;
		}
		
	}
} elseif(!empty($_GET['email']) && empty($_POST['login'])) {
	$arResult['POST']['EMAIL'] = htmlspecialchars($_GET['email']);
}
    
$this->IncludeComponentTemplate(); 


?>
