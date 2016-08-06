<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

//ft\CHelper::clearSession();
$arResult = array();

$arSession = ft\CHelper::getSession();
if(!empty($arSession['SOC_USER_ID'])) {
	$arResult['CURRENT_USER_ID'] = $arSession['SOC_USER_ID'];
} elseif($GLOBALS['USER']->getId()) {
	// При регистрации через соц. сервисы, пользователь авторизуется.
	// получаем ID авторизованного пользователя
	$arResult['CURRENT_USER_ID'] = intval($GLOBALS['USER']->getId());
}
$arResult['SERVICE_USER'] = array();
if(!empty($arResult['CURRENT_USER_ID'])) {
	if($arCurrentUser = \CUser::getList(($by = 'ID'), ($order = 'ASC'), 
		array('ID' => $arResult['CURRENT_USER_ID'], '!EXTERNAL_AUTH_ID' => false, 'ACTIVE' => 'N', 'UF_NEED_CONFIRM' => 1), array('SELECT' => array('UF_*')))->fetch()) {
		
		// Если текущий авторизованный пользователь является недавно зарегистрированный через соц. сети, то
		// разлогиниваем его, сохраняем ID в сессии для дальнейшей "регистрации" пользователя.
		
		$arResult['SERVICE_USER'] = $arCurrentUser;
		if($GLOBALS['USER']->isAuthorized() && $arParams['STEP'] < 2) {
			LocalRedirect($GLOBALS['APPLICATION']->getCurPageParam('step=2', array('step')));
		}
		$GLOBALS['USER']->Logout();
		
		ft\CHelper::setSession(array('SOC_USER_ID' => $arCurrentUser['ID']));
		
	}
}


if($GLOBALS['USER']->IsAuthorized()) {
	
	// Авторизованный пользователь
	echo 'Вы уже авторизованы';
	
} elseif(!empty($arResult['SERVICE_USER']) && $arParams['STEP'] >= 2) {
	
	// Пользователь зарегистрировался через соц. сервисы
	
	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['social_registration']) && !$GLOBALS['USER']->IsAuthorized()) {
		
		// Дополнительная "регистрация" пользователя, пришедшего через соц. сервисы
		$arReturn = ft\CUserValidation::checkFields($_POST, true);
		
		$arPost = $arReturn['FIELDS'];
		$arResult['ERRORS'] = $arReturn['ERRORS'];
		
		if(empty($arResult['ERRORS'])) {
			
			// Если ошибок нет, то обновляем данные и отправляем подтверждение email
			
			$user = new \CUser;
			$arUserFields = array(
				'EMAIL' => $arPost['EMAIL'],
				'LOGIN' => $arPost['EMAIL'],
				'PASSWORD' => $arPost['PASSWORD'],
				'CONFIRM_PASSWORD' => $arPost['CONFIRM_PASSWORD'],
				'UF_NEED_CONFIRM' => 0,
			);
			
			$arUserFields = ft\CUserRegistration::prepareFields($arUserFields);

			$user->Update($arResult['SERVICE_USER']['ID'], $arUserFields);
			
			$arUserFields['USER_ID'] = $arResult['SERVICE_USER']['ID'];

			$arEventFields = $arUserFields;
			unset($arEventFields['PASSWORD']);
			unset($arEventFields['CONFIRM_PASSWORD']);

			
			if($arUserFields['ACTIVE'] == 'N') {
				
				ft\CUserRegistration::sendEmailConfirm($arEventFields);
				
			}
			ft\CHelper::clearSession();
			LocalRedirect($GLOBALS['APPLICATION']->GetCurPageParam('result=confirm', array('result')));
			
		}
		
		$arResult['POST'] = $arPost;
	
	}
	
	if(empty($arPost)) {
		$arResult['POST']['EMAIL'] = $arResult['SERVICE_USER']['UF_SOC_EMAIL'];
	}
	
	if(empty($arPost)) {
		
		$arResult['USER_EXIST'] = false;
		
		// Проверяем полученный из соц. сервисов email
		$arEmailValidation = ft\CUserValidation::checkEmail($arResult['SERVICE_USER']['UF_SOC_EMAIL'], true);
		if($arEmailValidation['CODE'] == -3) {
			// Если найден пользователь с таким email -> уведомляем об этом пользователя
			$arResult['USER_EXIST'] = $arEmailValidation['USER_ID'];
		}
	}
	
	$this->IncludeComponentTemplate('social');	
	
} else {

	// Обычная страница регистрации

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
			elseif(!$sebekonOAuthManager->checkUser($_REQUEST["auth_service_id"], array('CHECK_USER' => false, 'SEND_REGISTER' => true)))
			{
				$ex = $APPLICATION->GetException();
				if ($ex) {
					$arResult['ERRORS'][] = $ex->GetString();
				}
			}

		}
	}


	if($_SERVER['REQUEST_METHOD'] == 'POST' && !empty($_POST['registration']) && !$GLOBALS['USER']->IsAuthorized()) {
		
		// Обычная регистрация пользователя
		
		$arReturn = ft\CUserValidation::checkFields($_POST);
		
		$arResult['POST'] = $arReturn['FIELDS'];
		$arResult['ERRORS'] = $arReturn['ERRORS'];
		
		if(empty($arResult['ERRORS'])) {
			
			// Если ошибок нет, то обновляем данные и отправляем подтверждение email
			
			$arResult['VALUES'] = ft\CUserRegistration::prepareFields($arResult['POST']);

			$bOk = true;

			$events = GetModuleEvents("main", "OnBeforeUserRegister", true);
			foreach($events as $arEvent)
			{
				if(ExecuteModuleEventEx($arEvent, array(&$arResult['VALUES'])) === false)
				{
					if($err = $APPLICATION->GetException())
						$arResult['ERRORS'][] = $err->GetString();

					$bOk = false;
					break;
				}
			}

			$ID = 0;
			$user = new \CUser();
			if ($bOk)
			{
				$ID = $user->Add($arResult["VALUES"]);
			}

			if (intval($ID) > 0)
			{
				$register_done = true;

				$arResult['VALUES']["USER_ID"] = $ID;

				$arEventFields = $arResult['VALUES'];
				unset($arEventFields["PASSWORD"]);
				unset($arEventFields["CONFIRM_PASSWORD"]);

				//$event = new CEvent;
				//$event->SendImmediate("NEW_USER", SITE_ID, $arEventFields);
				if($arResult['VALUES']['ACTIVE'] == 'N') {
					
					ft\CUserRegistration::sendEmailConfirm($arEventFields);
					
				}
				LocalRedirect($GLOBALS['APPLICATION']->GetCurPageParam('result=confirm', array('result')));
			}
			else
			{
				$error = $user->LAST_ERROR;			
				//$error = preg_replace('/Пользователь с логином \"([^\"]+)\" уже существует\./iu', '', $error);
				
				$arResult["ERRORS"][] = $error;
			}
			
		}
	}

	$this->IncludeComponentTemplate(); 


}

?>
