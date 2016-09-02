<?
namespace ft;

use Bitrix\Main\Config\Option;
use Bitrix\Main\Context;
use Bitrix\Socialservices\ContactTable;
use Bitrix\Main\UserTable;
use Bitrix\Socialservices\UserTable as SocialUserTable;

class CSocServAuthManager extends \CSocServAuthManager {
	public function checkUser($service_id, $arParams = array())
    {
        if(isset(self::$arAuthServices[$service_id]))
        {
            $service = self::$arAuthServices[$service_id];

            if(
                (
                    $service["__active"] === true
                    && $service["DISABLED"] !== true
                )
                || (
                    $service_id == \CSocServBitrix24Net::ID
                    && defined('ADMIN_SECTION')
                    && ADMIN_SECTION == true
                )
            )
            {
				$service["CLASS"] = '\\ft\\' . $service["CLASS"];
                $cl = new $service["CLASS"];
                if(is_callable(array($cl, "Authorize")))
                {
                    return call_user_func_array(array($cl, "Authorize"), array
                        ($arParams));
                }
            }
        }

        return false;
    }

	public function AuthorizeByToken($service_id, $token)
	{
		if(isset(self::$arAuthServices[$service_id]))
		{
			$service = self::$arAuthServices[$service_id];

			if(
				(
					$service["__active"] === true
					&& $service["DISABLED"] !== true
				)
				|| (
					$service_id == \CSocServBitrix24Net::ID
					&& defined('ADMIN_SECTION')
					&& ADMIN_SECTION == true
				)
			)
			{
				$service["CLASS"] = '\\ft\\' . $service["CLASS"];
				$cl = new $service["CLASS"];
				if(is_callable(array($cl, "AuthorizeByToken")))
				{
					return call_user_func_array(array($cl, "AuthorizeByToken"), array($token));
				}
			}
		}

		return false;
	}

	public static function findUser($socialUserId, $socialId, $active = false) {
		
		\CModule::IncludeModule('socialservices');
		
		if(!$arSocUser = \CSocServAuthDB::GetList(array(), array('XML_ID' => $socialUserId, 'EXTERNAL_AUTH_ID' => $socialId), false, false, array('ID', 'USER_ID'))->fetch()) {
			return false;
		}	

		$arFilter = array(
			'=ID' => $arSocUser['USER_ID']
		);
		
		if($active) {
			$arFilter['ACTIVE'] = 'Y';
		}
		
		if(!$arUser = UserTable::getList(array('select' => array('ID', 'ACTIVE'), 'filter' => $arFilter))->fetch()) {
			return false;
		}
		
		
		return $arUser;
	}

	public static function findUserByToken($token, $socialId) {
		if(
			\Bitrix\Main\Loader::includeModule('socialservices')
			&& $arSocUser = \CSocServAuthDB::GetList(array(), array('OATOKEN' => $token, 'EXTERNAL_AUTH_ID' => $socialId))->fetch()
		) {
			return $arSocUser;
		} else {
			return false;
		}
	}

	public static function sendError($type = 'nf') {
		//$url = ($GLOBALS["APPLICATION"]->GetCurDir() == "/login/") ? "" : $GLOBALS["APPLICATION"]->GetCurDir();
		$url = $GLOBALS["APPLICATION"]->GetCurPageParam('error=' . $type, array('error'));
		?>
		<script type="text/javascript">
			if(window.opener)
				window.opener.location = '<?=\CUtil::JSEscape($url)?>';
			window.close();
		</script>
		<?
		die();
	}
	
	public static function sendRegister($step = 1) {
		?>
		<script type="text/javascript">
			if(window.opener) {
				window.opener.parent.ftHelper.showRegistration(<?=($step == 2 ? 'false' : 'true')?>, <?=intval($step)?>);
			}
			window.close();
		</script>
		<?
		die();
	}
	
	public static function sendLogin() {
		?>
		<script type="text/javascript">
			if(window.opener) {
				window.opener.parent.ftHelper.showLoginForm();
			}
			window.close();
		</script>
		<?
		die();
	}
	
	public static function sendAccount($userId = null) {
		$userId = intval($userId);
		
		if(empty($userId)) {
			self::sendLogin();
		}
		$GLOBALS['USER']->Authorize($userId);
		$url = '/account/';
		?>
		<script type="text/javascript">
			if(window.opener) {
				window.opener.location = '<?=\CUtil::JSEscape($url)?>';
			}
			window.close();
		</script>
		<?
		die();
	}
	
	public function GetError($service_id, $error_code)
	{
		if(isset(self::$arAuthServices[$service_id])) {
			return 'В данный момент авторизация с помощью этой соцсети не возможна. Выберите другой способ авторизации или обратитесь в техническую поддержку';
		}
		return '';
	}
}

class CSocServAuth extends \CSocServAuth {
	
	public function AuthorizeUser($socservUserFields)
	{
		global $USER, $APPLICATION;

		if(!isset($socservUserFields['EXTERNAL_AUTH_ID']) || $socservUserFields['EXTERNAL_AUTH_ID'] == '')
		{
			return false;
		}
		
		$oauthKeys = array();
		if(isset($socservUserFields["OATOKEN"]))
		{
			$oauthKeys["OATOKEN"] = $socservUserFields["OATOKEN"];
		}
		if(isset($socservUserFields["REFRESH_TOKEN"]) && $socservUserFields["REFRESH_TOKEN"] !== '')
		{
			$oauthKeys["REFRESH_TOKEN"] = $socservUserFields["REFRESH_TOKEN"];
		}
		if(isset($socservUserFields["OATOKEN_EXPIRES"]))
		{
			$oauthKeys["OATOKEN_EXPIRES"] = $socservUserFields["OATOKEN_EXPIRES"];
		}

		$errorCode = SOCSERV_AUTHORISATION_ERROR;

		$dbSocUser = SocialUserTable::getList(array(
			'filter' => array(
				'=XML_ID'=>$socservUserFields['XML_ID'],
				'=EXTERNAL_AUTH_ID'=>$socservUserFields['EXTERNAL_AUTH_ID']
			),
			'select' => array("ID", "USER_ID", "ACTIVE" => "USER.ACTIVE"),
		));
		$socservUser = $dbSocUser->fetch();

		if($USER->IsAuthorized())
		{
			
			if(!$this->checkRestrictions || !self::isSplitDenied())
			{
				if(!$socservUser)
				{
					$socservUserFields["USER_ID"] = $USER->GetID();
					//$result = SocialUserTable::add(SocialUserTable::filterFields($socservUserFields));
					//$id = $result->getId();
					$socServAuthObj = new \CSocServAuthDB;
					$id = $socServAuthObj->add($socservUserFields);
				}
				else
				{
					$id = $socservUser['ID'];

					// socservice link split
					if($socservUser['USER_ID'] != $USER->GetID())
					{
						if($this->allowChangeOwner)
						{
							$dbSocUser = SocialUserTable::getList(array(
									'filter' => array(
											'=USER_ID' => $USER->GetID(),
											'=EXTERNAL_AUTH_ID' => $socservUserFields['EXTERNAL_AUTH_ID']
									),
									'select' => array("ID")
							));
							if($dbSocUser->fetch())
							{
								return SOCSERV_AUTHORISATION_ERROR;
							}
							else
							{
								$oauthKeys['USER_ID'] = $USER->GetID();
								$oauthKeys['CAN_DELETE'] = 'Y';
							}
						}
						else
						{
							return SOCSERV_AUTHORISATION_ERROR;
						}
					}
				}

				if($_SESSION["OAUTH_DATA"] && is_array($_SESSION["OAUTH_DATA"]))
				{
					$oauthKeys = array_merge($oauthKeys, $_SESSION['OAUTH_DATA']);
					unset($_SESSION["OAUTH_DATA"]);
				}

				//SocialUserTable::update($id, $oauthKeys);
				$socServAuthObj = new \CSocServAuthDB;
				$socServAuthObj->update($id, $oauthKeys);
			}
			else
			{
				return SOCSERV_REGISTRATION_DENY;
			}
		}
		else
		{
			$entryId = 0;
			$USER_ID = 0;

			if($socservUser)
			{
				$entryId = $socservUser['ID'];
				// TODO откуда тут поле ACTIVE?
				if($socservUser["ACTIVE"] === 'Y')
				{
					$USER_ID = $socservUser["USER_ID"];
				}
			}
			else
			{
				// check for user with old socialservices linking system (socservice ID in user's EXTERNAL_AUTH_ID)
				$dbUsersOld = \CUser::GetList($by='ID', $ord='ASC', array('XML_ID'=>$socservUserFields['XML_ID'], 'EXTERNAL_AUTH_ID'=>$socservUserFields['EXTERNAL_AUTH_ID'], 'ACTIVE'=>'Y'), array('NAV_PARAMS'=>array("nTopCount"=>"1")));
				$socservUser = $dbUsersOld->Fetch();
				if($socservUser)
				{
					$USER_ID = $socservUser["ID"];
				}
				else
				{
					// theoretically possible situation with abandoned external user w/o b_socialservices_user entry
					$dbUsersNew = \CUser::GetList($by='ID', $ord='ASC', array('XML_ID'=>$socservUserFields['XML_ID'], 'EXTERNAL_AUTH_ID'=>'socservices', 'ACTIVE'=>'Y'),  array('NAV_PARAMS'=>array("nTopCount"=>"1")));
					$socservUser = $dbUsersNew->Fetch();

					if($socservUser)
					{
						$USER_ID = $socservUser["ID"];
					}
					elseif
					(
						\COption::GetOptionString("main", "new_user_registration", "N") == "Y"
						&& \COption::GetOptionString("socialservices", "allow_registration", "Y") == "Y"
					)
					{
						//$socservUserFields['PASSWORD'] = randString(30); //not necessary but...
						$socservUserFields['PASSWORD'] = 'Sebekon12.'; //not necessary but...
						$socservUserFields['LID'] = SITE_ID;

						$def_group = Option::get('main', 'new_user_registration_def_group', '');
						if($def_group <> '')
						{
							$socservUserFields['GROUP_ID'] = explode(',', $def_group);
						}


						if(
							$this->checkRestrictions
							&& !empty($socservUserFields['GROUP_ID'])
							&& self::isAuthDenied($socservUserFields['GROUP_ID'])
						)
						{
							$errorCode = SOCSERV_REGISTRATION_DENY;
						}
						else
						{
							$userFields = $socservUserFields;
							$userFields["EXTERNAL_AUTH_ID"] = "socservices";
							$userFields["CONFIRM_CODE"] = randString(8);

							if(isset($userFields['PERSONAL_PHOTO']) && is_array($userFields['PERSONAL_PHOTO']))
							{
								$res = \CFile::CheckImageFile($userFields["PERSONAL_PHOTO"]);
								if($res <> '')
								{
									unset($userFields['PERSONAL_PHOTO']);
								}
							}
							unset($userFields['XML_ID']);
							$USER_ID = $USER->Add($userFields);
							if($USER_ID <= 0)
							{
								$errorCode = SOCSERV_AUTHORISATION_ERROR;
							}
						}
					}
					elseif(Option::get("main", "new_user_registration", "N") == "N")
					{
						$errorCode = SOCSERV_REGISTRATION_DENY;
					}

					$socservUserFields['CAN_DELETE'] = 'N';
				}
			}

			if(isset($_SESSION["OAUTH_DATA"]) && is_array($_SESSION["OAUTH_DATA"]))
			{
				foreach ($_SESSION['OAUTH_DATA'] as $key => $value)
				{
					$socservUserFields[$key] = $value;
				}
				unset($_SESSION["OAUTH_DATA"]);
			}

			if($USER_ID > 0)
			{
				$arGroups = $USER->GetUserGroup($USER_ID);
				if($this->checkRestrictions && self::isAuthDenied($arGroups))
				{
					return SOCSERV_AUTHORISATION_ERROR;
				}

				if($entryId > 0)
				{
					//SocialUserTable::update($entryId, SocialUserTable::filterFields($socservUserFields));
					$socServAuthObj = new \CSocServAuthDB;
					$socServAuthObj->update($entryId, $socservUserFields);
				}
				else
				{
					$socservUserFields['USER_ID'] = $USER_ID;
					//SocialUserTable::add(SocialUserTable::filterFields($socservUserFields));
					$socServAuthObj = new \CSocServAuthDB;
					$socServAuthObj->add($socservUserFields);
				}

				if(isset($socservUserFields["TIME_ZONE_OFFSET"]) && $socservUserFields["TIME_ZONE_OFFSET"] !== null)
				{
					\CTimeZone::SetCookieValue($socservUserFields["TIME_ZONE_OFFSET"]);
				}

				if($socservUser['ACTIVE'] == 'Y') {
				
					$USER->AuthorizeWithOtp($USER_ID);
					
				} else {

					CHelper::setSession(array('SOC_USER_ID' => $USER_ID, 'REGISTRATION_STEP' => 2));
					
				}
				
				if($USER->IsJustAuthorized())
				{
					ContactTable::onUserLoginSocserv($socservUserFields);
					foreach(GetModuleEvents("socialservices", "OnUserLoginSocserv", true) as $arEvent)
					{
						ExecuteModuleEventEx($arEvent, array($socservUserFields));
					}
				}
			}
			else
			{
				return $errorCode;
			}

			// possible redirect after authorization, so no spreading. Store cookies in the session for next hit
			$APPLICATION->StoreCookies();
		}

		return true;
	}
	
}

?>