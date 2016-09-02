<?
namespace ft;

class CSocServVKontakte extends \CSocServVKontakte {
	
	public function Authorize($arParams)
	{
		$GLOBALS["APPLICATION"]->RestartBuffer();
		$bSuccess = SOCSERV_AUTHORISATION_ERROR;

		if((isset($_REQUEST["code"]) && $_REQUEST["code"] <> '') && \CSocServAuthManager::CheckUniqueKey())
		{
			if(IsModuleInstalled('bitrix24') && defined('BX24_HOST_NAME'))
				$redirect_uri = self::CONTROLLER_URL."/redirect.php";
			else
				$redirect_uri = \CHTTP::URN2URI($GLOBALS['APPLICATION']->GetCurPage()).'?auth_service_id='.self::ID;

			$this->entityOAuth = $this->getEntityOAuth($_REQUEST['code']);
			if($this->entityOAuth->GetAccessToken($redirect_uri) !== false)
			{
				$arVkUser = $this->entityOAuth->GetCurrentUser();
				
				if($arUser = CSocServAuthManager::findUser($arVkUser['response']['0']['uid'], self::ID, $arParams['ONLY_ACTIVE'] === true)) {
					CHelper::setSession(array('SOC_USER_ID' => $arUser['ID']));
				} else {
					CHelper::clearSession();
				}
				/*p($arUser);
				p($arParams);
				*/
				/*
				p($arParams);
				p($arUser);
				die();
				*/
				
				if($arParams['CHECK_USER'] && !$arUser['ID']) {
					CSocServAuthManager::sendError();
					
				} elseif($arParams['SEND_REGISTER'] && $arUser['ID']) {
					
					if($arUser['ACTIVE'] == 'N') {
						CSocServAuthManager::sendRegister(2);
					} elseif($arUser['ACTIVE'] == 'Y') {
						CSocServAuthManager::sendAccount($arUser['ID']);
					}
					
					
				} elseif(is_array($arVkUser) && ($arVkUser['response']['0']['uid'] <> '')) {
					//die('arVkUser');
					$arFields = $this->prepareUser($arVkUser);
					//$bSuccess = $this->AuthorizeUser($arFields);
					
					$socServAuthObj = new CSocServAuth();
					$bSuccess = $socServAuthObj->AuthorizeUser($arFields);
				}
			}
		}

		$url = ($GLOBALS["APPLICATION"]->GetCurDir() == "/") ? "" : $GLOBALS["APPLICATION"]->GetCurDir();
		$aRemove = array("logout", "auth_service_error", "auth_service_id", "code", "error_reason", "error", "error_description", "check_key", "current_fieldset");


		if(isset($_REQUEST['backurl']) || isset($_REQUEST['redirect_url']))
		{
			$parseUrl = parse_url(isset($_REQUEST['redirect_url']) ? $_REQUEST['redirect_url'] : $_REQUEST['backurl']);

			$urlPath = $parseUrl["path"];
			$arUrlQuery = explode('&', $parseUrl["query"]);

			foreach($arUrlQuery as $key => $value)
			{
				foreach($aRemove as $param)
				{
					if(strpos($value, $param."=") === 0)
					{
						unset($arUrlQuery[$key]);
						break;
					}
				}
			}
			$url = (!empty($arUrlQuery)) ? $urlPath.'?'.implode("&", $arUrlQuery) : $urlPath;
		}

		if($bSuccess === SOCSERV_REGISTRATION_DENY)
		{
			$url = (preg_match("/\?/", $url)) ? $url.'&' : $url.'?';
			$url .= 'auth_service_id='.self::ID.'&auth_service_error='.$bSuccess;
		}
		elseif($bSuccess !== true)
		{
			$url = (isset($urlPath)) ? $urlPath.'?auth_service_id='.self::ID.'&auth_service_error='.$bSuccess : $GLOBALS['APPLICATION']->GetCurPageParam(('auth_service_id='.self::ID.'&auth_service_error='.$bSuccess), $aRemove);
		}

		if(\CModule::IncludeModule("socialnetwork") && strpos($url, "current_fieldset=") === false)
		{
			$url = (preg_match("/\?/", $url)) ? $url."&current_fieldset=SOCSERV" : $url."?current_fieldset=SOCSERV";
		}

		echo '
<script type="text/javascript">
if(window.opener)
{
	window.opener.location = \''.\CUtil::JSEscape($url).'\';
}
window.close();
</script>
';
		die();
	}

    public function AuthorizeByToken($token, $active = true)
    {
        if($arSocUser = CSocServAuthManager::findUserByToken($token, self::ID)) {
            $arFilter = array(
                '=ID' => $arSocUser['USER_ID']
            );

            if($active) {
                $arFilter['ACTIVE'] = 'Y';
            }

            $rsUser = \Bitrix\Main\UserTable::getList(array('select' => array('ID', 'ACTIVE'), 'filter' => $arFilter));
            if($arUser = $rsUser->fetch()) {
                if($arUser['ACTIVE'] != 'Y') {
                    CSocServAuthManager::sendRegister(2);
                } elseif($arUser['ACTIVE'] == 'Y') {
                    $socServAuthObj = new CSocServAuth();
                    return $socServAuthObj->AuthorizeUser($arSocUser);
                }
            } else {
                return false;
            }
        } else {
            CSocServAuthManager::sendError();
        }
    }

}

?>