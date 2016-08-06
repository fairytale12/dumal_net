<?
namespace ft;

class CSocServFacebook extends \CSocServFacebook {

	public function Authorize($arParams)
	{
		global $APPLICATION;
		$APPLICATION->RestartBuffer();

		$authError = SOCSERV_AUTHORISATION_ERROR;

		if(
			isset($_REQUEST["code"]) && $_REQUEST["code"] <> ''
			&& \CSocServAuthManager::CheckUniqueKey()
		)
		{
			if(IsModuleInstalled('bitrix24') && defined('BX24_HOST_NAME'))
			{
				$redirect_uri = self::CONTROLLER_URL."/redirect.php?redirect_to=".urlencode(\CSocServUtil::GetCurUrl('auth_service_id='.self::ID, array("code")));
			}
			else
			{
				if(isset($_SESSION["FACEBOOK_OAUTH_LAST_REDIRECT_URI"]))
				{
					$redirect_uri = $_SESSION["FACEBOOK_OAUTH_LAST_REDIRECT_URI"];
					unset($_SESSION["FACEBOOK_OAUTH_LAST_REDIRECT_URI"]);
				}
				else
				{
					$redirect_uri = \CSocServUtil::GetCurUrl('auth_service_id=' . self::ID, array("code"));
				}
			}

			$this->entityOAuth = $this->getEntityOAuth($_REQUEST['code']);
			if($this->entityOAuth->GetAccessToken($redirect_uri) !== false)
			{
				$arFBUser = $this->entityOAuth->GetCurrentUser();

				if($arUser = CSocServAuthManager::findUser($arFBUser["id"], self::ID, $arParams['ONLY_ACTIVE'] === true)) {
					CHelper::setSession(array('SOC_USER_ID' => $arUser['ID']));
				} else {
					CHelper::clearSession();
				}

				if($arParams['CHECK_USER'] && !$arUser['ID']) {

					CSocServAuthManager::sendError();

				} elseif($arParams['SEND_REGISTER'] && $arUser['ID']) {
					if($arUser['ACTIVE'] == 'N') {
						CSocServAuthManager::sendRegister();
					} elseif($arUser['ACTIVE'] == 'Y') {
						CSocServAuthManager::sendLogin();
					}

				} elseif(is_array($arFBUser) && isset($arFBUser["id"]))
				{
					$arFields = self::prepareUser($arFBUser);
					//$authError = $this->AuthorizeUser($arFields);
					$socServAuthObj = new CSocServAuth();
					$authError = $socServAuthObj->AuthorizeUser($arFields);
				}
			}
		}

		$bSuccess = $authError === true;

		$aRemove = array("logout", "auth_service_error", "auth_service_id", "code", "error_reason", "error", "error_description", "check_key", "current_fieldset");

		if($bSuccess)
		{
			\CSocServUtil::checkOAuthProxyParams();

			$url = ($GLOBALS["APPLICATION"]->GetCurDir() == "/") ? "" : $GLOBALS["APPLICATION"]->GetCurDir();

			if(isset($_REQUEST['backurl']))
			{
				$parseUrl = parse_url($_REQUEST['backurl']);

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
		}



		if($authError === SOCSERV_REGISTRATION_DENY)
		{
			$url = (preg_match("/\?/", $url)) ? $url.'&' : $url.'?';
			$url .= 'auth_service_id='.self::ID.'&auth_service_error='.$authError;
		}
		elseif($bSuccess !== true)
		{
			$url = (isset($urlPath)) ? $urlPath.'?auth_service_id='.self::ID.'&auth_service_error='.$authError : $GLOBALS['APPLICATION']->GetCurPageParam(('auth_service_id='.self::ID.'&auth_service_error='.$authError), $aRemove);
		}

		if(\CModule::IncludeModule("socialnetwork") && strpos($url, "current_fieldset=") === false)
		{
			$url .= ((strpos($url, "?") === false) ? '?' : '&')."current_fieldset=SOCSERV";
		}
?>
<script type="text/javascript">
if(window.opener)
	window.opener.location = '<?=\CUtil::JSEscape($url)?>';
window.close();
</script>
<?
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
					CSocServAuthManager::sendRegister();
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