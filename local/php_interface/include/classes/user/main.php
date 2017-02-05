<?
namespace ft;

use Bitrix\Main;
use Bitrix\Main\Authentication\ApplicationPasswordTable;
use Bitrix\Main\UserTable;

class CUser extends \CUser {
	
	public function Login($login, $password, $remember="N", $password_original="Y")
	{
		/** @global CMain $APPLICATION */
		global $DB, $APPLICATION;

		$result_message = true;
		$user_id = 0;
		$applicationId = null;
		$applicationPassId = null;

		$arParams = array(
			"LOGIN" => &$login,
			"PASSWORD" => &$password,
			"REMEMBER" => &$remember,
			"PASSWORD_ORIGINAL" => &$password_original,
		);

		unset($_SESSION["SESS_OPERATIONS"]);
		unset($_SESSION["MODULE_PERMISSIONS"]);
		$_SESSION["BX_LOGIN_NEED_CAPTCHA"] = false;

		$bOk = true;
		$APPLICATION->ResetException();
		foreach(GetModuleEvents("main", "OnBeforeUserLogin", true) as $arEvent)
		{
			if(ExecuteModuleEventEx($arEvent, array(&$arParams))===false)
			{
				if($err = $APPLICATION->GetException())
				{
					$result_message = array("MESSAGE"=>$err->GetString()."<br>", "TYPE"=>"ERROR");
				}
				else
				{
					$APPLICATION->ThrowException("Unknown login error");
					$result_message = array("MESSAGE"=>"Unknown login error"."<br>", "TYPE"=>"ERROR");
				}

				$bOk = false;
				break;
			}
		}

		if($bOk)
		{
			//external authentication
			foreach(GetModuleEvents("main", "OnUserLoginExternal", true) as $arEvent)
			{
				$user_id = ExecuteModuleEventEx($arEvent, array(&$arParams));
				if($user_id > 0)
				{
					break;
				}
			}

			if($user_id <= 0)
			{
				//internal authentication OR application password for external user

				$foundUser = false;

				$strSql =
					"SELECT U.ID, U.LOGIN, U.ACTIVE, U.PASSWORD, U.LOGIN_ATTEMPTS, U.CONFIRM_CODE, U.EMAIL ".
					"FROM b_user U  ".
					"WHERE U.LOGIN='".$DB->ForSQL($arParams["LOGIN"])."';";

				$result = $DB->Query($strSql);

				if(($arUser = $result->Fetch()))
				{
					//internal authentication by login and password

					$foundUser = true;

					if(strlen($arUser["PASSWORD"]) > 32)
					{
						$salt = substr($arUser["PASSWORD"], 0, strlen($arUser["PASSWORD"]) - 32);
						$db_password = substr($arUser["PASSWORD"], -32);
					}
					else
					{
						$salt = "";
						$db_password = $arUser["PASSWORD"];
					}

					$user_password_no_otp = "";
					if($arParams["PASSWORD_ORIGINAL"] == "Y")
					{
						$user_password =  md5($salt.$arParams["PASSWORD"]);
						if($arParams["OTP"] <> '')
						{
							$user_password_no_otp =  md5($salt.substr($arParams["PASSWORD"], 0, -6));
						}
					}
					else
					{
						if(strlen($arParams["PASSWORD"]) > 32)
							$user_password = substr($arParams["PASSWORD"], -32);
						else
							$user_password = $arParams["PASSWORD"];
					}

					$passwordCorrect = ($db_password === $user_password || ($arParams["OTP"] <> '' && $db_password === $user_password_no_otp));

					if($db_password === $user_password)
					{
						//this password has no added otp for sure
						$arParams["OTP"] = '';
					}

					if(!$passwordCorrect)
					{
						//let's try to find application password
						if(($appPassword = ApplicationPasswordTable::findPassword($arUser["ID"], $arParams["PASSWORD"], ($arParams["PASSWORD_ORIGINAL"] == "Y"))) !== false)
						{
							$passwordCorrect = true;
							$applicationId = $appPassword["APPLICATION_ID"];
							$applicationPassId = $appPassword["ID"];
						}
					}

					$arPolicy = CUser::GetGroupPolicy($arUser["ID"]);
					$pol_login_attempts = intval($arPolicy["LOGIN_ATTEMPTS"]);
					$usr_login_attempts = intval($arUser["LOGIN_ATTEMPTS"])+1;
					if($pol_login_attempts > 0 && $usr_login_attempts > $pol_login_attempts)
					{
						$_SESSION["BX_LOGIN_NEED_CAPTCHA"] = true;
						if(!$APPLICATION->CaptchaCheckCode($_REQUEST["captcha_word"], $_REQUEST["captcha_sid"]))
						{
							$passwordCorrect = false;
						}
					}

					if($passwordCorrect)
					{
						if($salt == '' && $arParams["PASSWORD_ORIGINAL"] == "Y" && $applicationId === null)
						{
							$salt = randString(8, array(
								"abcdefghijklnmopqrstuvwxyz",
								"ABCDEFGHIJKLNMOPQRSTUVWXYZ",
								"0123456789",
								",.<>/?;:[]{}\\|~!@#\$%^&*()-_+=",
							));
							$new_password = $salt.md5($salt.$arParams["PASSWORD"]);
							$DB->Query("UPDATE b_user SET PASSWORD='".$DB->ForSQL($new_password)."', TIMESTAMP_X = TIMESTAMP_X WHERE ID = ".intval($arUser["ID"]));
						}

						if($arUser["ACTIVE"] == "Y")
						{
							$user_id = $arUser["ID"];

							//update digest hash for http digest authorization
							if($arParams["PASSWORD_ORIGINAL"] == "Y" && $applicationId === null && \COption::GetOptionString('main', 'use_digest_auth', 'N') == 'Y')
							{
								CUser::UpdateDigest($arUser["ID"], $arParams["PASSWORD"]);
							}
						}
						elseif($arUser["CONFIRM_CODE"] <> '')
						{
							//unconfirmed registration
							
							
							//$message = GetMessage("MAIN_LOGIN_EMAIL_CONFIRM", array("#EMAIL#" => $arUser["EMAIL"]));
							$message = str_replace(array("#EMAIL#"), array($arUser["EMAIL"]), UNCONFIRMED_USER_MESSAGE);
							$APPLICATION->ThrowException($message);
							$result_message = array("MESSAGE"=>$message."<br>", "TYPE"=>"ERROR");
						}
						else
						{
							$APPLICATION->ThrowException(GetMessage("LOGIN_BLOCK"));
							$result_message = array("MESSAGE"=>GetMessage("LOGIN_BLOCK")."<br>", "TYPE"=>"ERROR");
						}
					}
					else
					{
						$DB->Query("UPDATE b_user SET LOGIN_ATTEMPTS = ".$usr_login_attempts.", TIMESTAMP_X = TIMESTAMP_X WHERE ID = ".intval($arUser["ID"]));
						$APPLICATION->ThrowException(GetMessage("WRONG_LOGIN"));
						$result_message = array("MESSAGE"=>GetMessage("WRONG_LOGIN")."<br>", "TYPE"=>"ERROR", "ERROR_TYPE" => "LOGIN");
					}
				}
				else
				{
					//no user found by login - try to find an external user
					foreach(GetModuleEvents("main", "OnFindExternalUser", true) as $arEvent)
					{
						if(($external_user_id = intval(ExecuteModuleEventEx($arEvent, array($arParams["LOGIN"])))) > 0)
						{
							//external user authentication
							//let's try to find application password for the external user
							if(($appPassword = ApplicationPasswordTable::findPassword($external_user_id, $arParams["PASSWORD"], ($arParams["PASSWORD_ORIGINAL"] == "Y"))) !== false)
							{
								//bingo, the user has the application password
								$foundUser = true;
								$user_id = $external_user_id;
								$applicationId = $appPassword["APPLICATION_ID"];
								$applicationPassId = $appPassword["ID"];
							}
							break;
						}
					}
				}

				if(!$foundUser)
				{
					$APPLICATION->ThrowException(GetMessage("WRONG_LOGIN"));
					$result_message = array("MESSAGE"=>GetMessage("WRONG_LOGIN")."<br>", "TYPE"=>"ERROR", "ERROR_TYPE" => "LOGIN");
				}
			}
		}

		// All except Admin
		if ($user_id > 1 && $arParams["CONTROLLER_ADMIN"] !== "Y")
		{
			$limitUsersCount = intval(\COption::GetOptionInt("main", "PARAM_MAX_USERS", 0));
			if ($limitUsersCount > 0)
			{
				$by = "ID";
				$order = "ASC";
				$arFilter = array(
					"LAST_LOGIN_1" => ConvertTimeStamp(),
				);
				//Intranet users only
				if (IsModuleInstalled("intranet"))
					$arFilter["!=UF_DEPARTMENT"] = false;

				$rsUsers = CUser::GetList($by, $order, $arFilter, array(
					"FIELDS" => array("ID", "LOGIN"),
				));

				while ( $user = $rsUsers->fetch())
				{
					if ($user["ID"] == $user_id)
					{
						$limitUsersCount = 1;
						break;
					}
					$limitUsersCount--;
				}

				if ($limitUsersCount < 0)
				{
					$user_id = 0;
					$APPLICATION->ThrowException(GetMessage("LIMIT_USERS_COUNT"));
					$result_message = array(
						"MESSAGE" => GetMessage("LIMIT_USERS_COUNT")."<br>",
						"TYPE" => "ERROR",
					);
				}
			}
		}

		$arParams["USER_ID"] = $user_id;

		$doAuthorize = true;

		if($user_id > 0)
		{
			if($applicationId === null && \CModule::IncludeModule("security"))
			{
				/*
				MFA can allow or disallow authorization.
				Allowed if:
				- OTP is not active for the user;
				- correct "OTP" in the $arParams (filled by the OnBeforeUserLogin event handler).
				Disallowed if:
				- OTP is not provided;
				- OTP is not correct.
				When authorization is disallowed the OTP form will be shown on the next hit.
				Note: there is no MFA check for an application password.
				*/

				$arParams["CAPTCHA_WORD"] = $_REQUEST["captcha_word"];
				$arParams["CAPTCHA_SID"] = $_REQUEST["captcha_sid"];

				$doAuthorize = \Bitrix\Security\Mfa\Otp::verifyUser($arParams);
			}

			if($doAuthorize)
			{
				$this->Authorize($user_id, ($arParams["REMEMBER"] == "Y"), true, $applicationId);

				if($applicationPassId !== null)
				{
					//update usage statistics for the application
					Main\Authentication\ApplicationPasswordTable::update($applicationPassId, array(
						'DATE_LOGIN' => new Main\Type\DateTime(),
						'LAST_IP' => $_SERVER["REMOTE_ADDR"],
					));
				}
			}
			else
			{
				$result_message = false;
			}

			if($applicationId === null && $arParams["LOGIN"] <> '')
			{
				//the cookie is for authentication forms mostly, does not make sense for applications
				$APPLICATION->set_cookie("LOGIN", $arParams["LOGIN"], time()+60*60*24*30*60, '/', false, false, \COption::GetOptionString("main", "auth_multisite", "N")=="Y");
			}
		}

		$arParams["RESULT_MESSAGE"] = $result_message;

		$APPLICATION->ResetException();
		foreach(GetModuleEvents("main", "OnAfterUserLogin", true) as $arEvent)
			ExecuteModuleEventEx($arEvent, array(&$arParams));

		if($doAuthorize == true && $result_message !== true && (\COption::GetOptionString("main", "event_log_login_fail", "N") === "Y"))
			\CEventLog::Log("SECURITY", "USER_LOGIN", "main", $login, $result_message["MESSAGE"]);

		return $arParams["RESULT_MESSAGE"];
	}
	
	
	public static function SendUserInfo($ID, $SITE_ID, $MSG, $bImmediate=false, $eventName="USER_INFO")
	{
		global $DB;

		// change CHECKWORD
		$ID = intval($ID);
		$salt = randString(8);
		$checkword = md5(\CMain::GetServerUniqID().uniqid());
		$strSql = "UPDATE b_user SET ".
			"	CHECKWORD = '".$salt.md5($salt.$checkword)."', ".
			"	CHECKWORD_TIME = ".$DB->CurrentTimeFunction().", ".
			"	LID = '".$DB->ForSql($SITE_ID, 2)."', ".
			"   TIMESTAMP_X = TIMESTAMP_X ".
			"WHERE ID = '".$ID."';";

		$DB->Query($strSql, false, "FILE: ".__FILE__."<br> LINE: ".__LINE__);

		$res = $DB->Query(
			"SELECT u.* ".
			"FROM b_user u ".
			"WHERE ID='".$ID."';"
		);

		if($res_array = $res->Fetch())
		{
			
			$arPolicy = CUser::GetGroupPolicy($res_array["ID"]);

			$event = new \CEvent;
			$arFields = array(
				"USER_ID"=>$res_array["ID"],
				"STATUS"=>($res_array["ACTIVE"]=="Y"?GetMessage("STATUS_ACTIVE"):GetMessage("STATUS_BLOCKED")),
				"MESSAGE"=>$MSG,
				"LOGIN"=>$res_array["LOGIN"],
				"URL_LOGIN"=>urlencode($res_array["LOGIN"]),
				"CHECKWORD"=>$checkword,
				"NAME"=>$res_array["NAME"],
				"LAST_NAME"=>$res_array["LAST_NAME"],
				"EMAIL"=>$res_array["EMAIL"],
				'LINK' => 'http://' . $_SERVER['HTTP_HOST'] . '/change-password/index.php?lang=ru&USER_CHECKWORD=' . $checkword . '&URL_LOGIN=' . urlencode($res_array["LOGIN"]),
				'CHECKWORD_TIMEOUT' => $arPolicy['CHECKWORD_TIMEOUT'],
				'CHECKWORD_TIMEOUT_TEXT' => CHelper::wordDeclension($arPolicy['CHECKWORD_TIMEOUT'], 'минуты', 'минут', 'минут'),
			);

			$arParams = array(
				"FIELDS" => &$arFields,
				"USER_FIELDS" => $res_array,
				"SITE_ID" => &$SITE_ID,
				"EVENT_NAME" => &$eventName,
			);

			foreach (GetModuleEvents("main", "OnSendUserInfo", true) as $arEvent)
				ExecuteModuleEventEx($arEvent, array(&$arParams));

			if (!$bImmediate)
				$event->Send($eventName, $SITE_ID, $arFields);
			else
				$event->SendImmediate($eventName, $SITE_ID, $arFields);
		}
	}
	
	public static function SendPassword($LOGIN, $EMAIL = false, $SITE_ID = false)
	{
		/** @global CMain $APPLICATION */
		global $DB, $APPLICATION;
		
		if(!$EMAIL) {
			$EMAIL = $LOGIN;
		}
		
		$arParams = array(
			"LOGIN" => $LOGIN,
			"EMAIL" => $EMAIL,
			"SITE_ID" => $SITE_ID
		);

		$result_message = array("MESSAGE"=>GetMessage('ACCOUNT_INFO_SENT')."<br>", "TYPE"=>"OK");
		$APPLICATION->ResetException();
		$bOk = true;
		foreach(GetModuleEvents("main", "OnBeforeUserSendPassword", true) as $arEvent)
		{
			if(ExecuteModuleEventEx($arEvent, array(&$arParams))===false)
			{
				if($err = $APPLICATION->GetException())
					$result_message = array("MESSAGE"=>$err->GetString()."<br>", "TYPE"=>"ERROR");

				$bOk = false;
				break;
			}
		}

		if($bOk)
		{
			$f = false;
			if($arParams["LOGIN"] <> '' || $arParams["EMAIL"] <> '')
			{
				$confirmation = (\COption::GetOptionString("main", "new_user_registration_email_confirmation", "N") == "Y");

				$strSql = "";
				if($arParams["LOGIN"] <> '')
				{
					$strSql =
						"SELECT ID, LID, ACTIVE, CONFIRM_CODE, LOGIN, EMAIL, NAME, LAST_NAME ".
						"FROM b_user u ".
						"WHERE LOGIN='".$DB->ForSQL($arParams["LOGIN"])."' ".
						"	AND (ACTIVE='Y' OR NOT(CONFIRM_CODE IS NULL OR CONFIRM_CODE=''))";
				}
				if($arParams["EMAIL"] <> '')
				{
					if($strSql <> '')
					{
						$strSql .= "\nUNION\n";
					}
					$strSql .=
						"SELECT ID, LID, ACTIVE, CONFIRM_CODE, LOGIN, EMAIL, NAME, LAST_NAME ".
						"FROM b_user u ".
						"WHERE EMAIL='".$DB->ForSQL($arParams["EMAIL"])."' ".
						"	AND (ACTIVE='Y' OR NOT(CONFIRM_CODE IS NULL OR CONFIRM_CODE=''))";
				}
				$res = $DB->Query($strSql);

				while($arUser = $res->Fetch())
				{
					if($arParams["SITE_ID"]===false)
					{
						if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
							$arParams["SITE_ID"] = CSite::GetDefSite($arUser["LID"]);
						else
							$arParams["SITE_ID"] = SITE_ID;
					}

					if($arUser["ACTIVE"] == "Y")
					{
						CUser::SendUserInfo($arUser["ID"], $arParams["SITE_ID"], GetMessage("INFO_REQ"), true, 'USER_PASS_REQUEST');
						$f = true;
					}
					elseif($confirmation)
					{
						
						//$arPolicy = CUser::GetGroupPolicy($res_array["ID"]);
						
						//unconfirmed registration - resend confirmation email
						$arFields = array(
							"USER_ID" => $arUser["ID"],
							"LOGIN" => $arUser["LOGIN"],
							"EMAIL" => $arUser["EMAIL"],
							"NAME" => $arUser["NAME"],
							"LAST_NAME" => $arUser["LAST_NAME"],
							"CONFIRM_CODE" => $arUser["CONFIRM_CODE"],
							"USER_IP" => $_SERVER["REMOTE_ADDR"],
							"USER_HOST" => @gethostbyaddr($_SERVER["REMOTE_ADDR"]),
						);

						$event = new CEvent;
						$event->SendImmediate("NEW_USER_CONFIRM", $arParams["SITE_ID"], $arFields);

						$result_message = array("MESSAGE"=>GetMessage("MAIN_SEND_PASS_CONFIRM")."<br>", "TYPE"=>"OK");
						$f = true;
					}

					if(\COption::GetOptionString("main", "event_log_password_request", "N") === "Y")
					{
						\CEventLog::Log("SECURITY", "USER_INFO", "main", $arUser["ID"]);
					}
				}
			}
			if(!$f)
			{
				return array("MESSAGE"=>GetMessage('DATA_NOT_FOUND')."<br>", "TYPE"=>"ERROR");
			}
		}
		return $result_message;
	}
	
	
	public function ChangePassword($LOGIN, $CHECKWORD, $PASSWORD, $CONFIRM_PASSWORD, $SITE_ID=false)
	{
		/** @global CMain $APPLICATION */
		global $DB, $APPLICATION;

		$result_message = array("MESSAGE"=>GetMessage('PASSWORD_CHANGE_OK')."<br>", "TYPE"=>"OK");

		$arParams = array(
			"LOGIN"			=>	&$LOGIN,
			"CHECKWORD"			=>	&$CHECKWORD,
			"PASSWORD" 		=>	&$PASSWORD,
			"CONFIRM_PASSWORD" =>	&$CONFIRM_PASSWORD,
			"SITE_ID"		=>	&$SITE_ID
			);

		$APPLICATION->ResetException();
		$bOk = true;
		foreach(GetModuleEvents("main", "OnBeforeUserChangePassword", true) as $arEvent)
		{
			if(ExecuteModuleEventEx($arEvent, array(&$arParams))===false)
			{
				if($err = $APPLICATION->GetException())
					$result_message = array("MESSAGE"=>$err->GetString()."<br>", "TYPE"=>"ERROR");

				$bOk = false;
				break;
			}
		}

		if($bOk)
		{
			$strAuthError = "";
			if(strlen($arParams["LOGIN"])<3)
				$strAuthError .= GetMessage('MIN_LOGIN')."<br>";
			if($arParams["PASSWORD"]<>$arParams["CONFIRM_PASSWORD"])
				$strAuthError .= GetMessage('WRONG_CONFIRMATION')."<br>";

			if($strAuthError <> '')
				return array("MESSAGE"=>$strAuthError, "TYPE"=>"ERROR");

			\CTimeZone::Disable();
			$db_check = $DB->Query(
				"SELECT ID, LID, CHECKWORD, ".$DB->DateToCharFunction("CHECKWORD_TIME", "FULL")." as CHECKWORD_TIME ".
				"FROM b_user ".
				"WHERE LOGIN='".$DB->ForSql($arParams["LOGIN"], 0)."'");
			\CTimeZone::Enable();

			if(!($res = $db_check->Fetch()))
				return array("MESSAGE"=>preg_replace("/#LOGIN#/i", htmlspecialcharsbx($arParams["LOGIN"]), GetMessage('LOGIN_NOT_FOUND')), "TYPE"=>"ERROR", "FIELD" => "LOGIN");

			$salt = substr($res["CHECKWORD"], 0, 8);
			if($res["CHECKWORD"] == '' || $res["CHECKWORD"] != $salt.md5($salt.$arParams["CHECKWORD"]))
				return array("MESSAGE"=>preg_replace("/#LOGIN#/i", htmlspecialcharsbx($arParams["LOGIN"]), GetMessage("CHECKWORD_INCORRECT"))."<br>", "TYPE"=>"ERROR", "FIELD"=>"CHECKWORD");

			$arPolicy = CUser::GetGroupPolicy($res["ID"]);

			$passwordErrors = $this->CheckPasswordAgainstPolicy($arParams["PASSWORD"], $arPolicy);
			if (!empty($passwordErrors))
			{
				return array(
					"MESSAGE" => implode("<br>", $passwordErrors)."<br>",
					"TYPE" => "ERROR"
				);
			}

			$site_format = \CSite::GetDateFormat();
			if(mktime()-$arPolicy["CHECKWORD_TIMEOUT"]*60 > MakeTimeStamp($res["CHECKWORD_TIME"], $site_format))
				return array("MESSAGE" => 'Истек срок действия ссылки для восстановления пароля.', "TYPE"=>"ERROR", "FIELD"=>"CHECKWORD_EXPIRE");

			if($arParams["SITE_ID"] === false)
			{
				if(defined("ADMIN_SECTION") && ADMIN_SECTION===true)
					$arParams["SITE_ID"] = \CSite::GetDefSite($res["LID"]);
				else
					$arParams["SITE_ID"] = SITE_ID;
			}

			// change the password
			$ID = $res["ID"];
			$obUser = new CUser;
			$res = $obUser->Update($ID, array("PASSWORD"=>$arParams["PASSWORD"]));
			if(!$res && $obUser->LAST_ERROR <> '')
				return array("MESSAGE"=>$obUser->LAST_ERROR."<br>", "TYPE"=>"ERROR");
			//CUser::SendUserInfo($ID, $arParams["SITE_ID"], GetMessage('CHANGE_PASS_SUCC'), true, 'USER_PASS_CHANGED');
			
			if($ID) {
				$obUser->Authorize($ID);
				$result_message['USER_ID'] = $ID;
			}
			
		}

		return $result_message;
	}
	
	
	public static function getUser($userId = null) {
		if(is_null($userId)) {
			$userId = $GLOBALS['USER']->getId();
		}
		
		$userId = intval($userId);
		if(empty($userId)) {
			return false;
		}
		
		if(!$arUser = \CUser::getList($by = 'personal_country', $order = 'asc', array('ID' => $userId), array('SELECT' => array('UF_*')))->fetch()) {
			return false;
		}
		
		return $arUser;
	}
	
	
	public static function changeConfirmCode($userId) {
		
		$userId = intval($userId);
		if(empty($userId)) {
			return false;
		}
		
		$confirmCode = randString(8);
		
		$user = new \CUser();
		
		if(!$user->update($userId, array(
			'CONFIRM_CODE' => $confirmCode
		))) {
			return false;
		}
		
		return $confirmCode;
	}
	
	
	public static function pilotProgram($programId, $email) {
		$programId = intval($programId);
		$email = trim($email);
		
		if(empty($programId)) {
			return CHelper::returnAnswer(-1, 'Не передан ID программы');
		}
		
		if(empty($email)) {
			return CHelper::returnAnswer(-2, 'Укажите email');
		}
		
		if(!check_email($email)) {
			return CHelper::returnAnswer(-3, 'Неправильный e-mail');
		}
		
		$arResult = CUserValidation::checkEmail($email, true, false, true);
		if($arResult['CODE'] <= 0 && $arResult['CODE'] != -3) {
			return CHelper::returnAnswer(-4, $arResult['TEXT']);
		}
		//return CHelper::returnAnswer($arResult['CODE'], $arResult['TEXT']);
		if($arResult['CODE'] == -3) {
			// Пользователь с таким email найден
			
			// Проверяем наличие программы
			if($arProgram = CUserPrograms::get($arResult['USER_ID'], $programId, true)) {
				if($arProgram['UF_IS_PILOT']) {
					// Программа есть у пользователя в пробном режиме
					return CHelper::returnAnswer(1, 'Вы уже преобрели пробную версию программы');
				} else {
					// Программа уже куплена пользователем
					return CHelper::returnAnswer(1, 'Вы уже купили данную программу');
				}
			}
			
			// Если пользователь найден и него нет данной программы
			// то отсылаем ему код подтверждения
			$confirmCode = self::changeConfirmCode($arResult['USER_ID']);
			$arUser = self::getUser($arResult['USER_ID']);
			$arUser['USER_ID'] = $arResult['USER_ID'];
			//CUserRegistration::sendEmailConfirm($arUser, '&pilot=1&program=' . $programId);
			
			// Письмо для привязки пробной программы
			$event = new \CEvent;
			$arEventFields = array(
				'TITLE' => 'Получение пробной программы',
				'EVENT_TEXT' => 'Для получения пробной программы',
				'CONFIRM_LINK' => 'http://' . $_SERVER['HTTP_HOST'] . '/confirm/?confirm_user_id=' . $arUser['USER_ID'] . '&confirm_code=' . $arUser['CONFIRM_CODE'] . '&pilot=1&program=' . $programId
			);
			
			$event->SendImmediate('FT_CONFIRM_CODE', SITE_ID, array_merge($arUser, $arEventFields));
			
			return CHelper::returnAnswer(1, 'Вам на почту отправлена ссылка для подтвеждения');
			
		} else {
			// Пользователь не найден
			
			$arFields = array(
				'EMAIL' => $email,
				'PASSWORD' => randString(8)
			);
			
			$arFields = CUserRegistration::prepareFields($arFields, true);
			$user = new \CUser();
			if(!$userId = $user->add($arFields)) {
				return CHelper::returnAnswer(-5, 'Возникла ошибка при добавлении пользователя, повторите чуть позже.');
			}
			$arFields['USER_ID'] = $userId;
			
			// Письмо для подтверждения регистрации
			CUserRegistration::sendEmailConfirm($arFields, '&pilot=1&program=' . $programId);
			return CHelper::returnAnswer(1, 'Вам на почту отправлена ссылка для подтвеждения');
		}
		
	}
	
}
?>