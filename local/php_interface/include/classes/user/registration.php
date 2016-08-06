<?
namespace ft;

class CUserRegistration {
	
	public static function prepareFields($arFields, $confirm = true) {
		
		$emailRequired = (\COption::GetOptionString('main', 'new_user_email_required', 'Y') <> 'N');
		$useEmailConfirmation = (\COption::GetOptionString('main', 'new_user_registration_email_confirmation', 'N') == 'Y' && $emailRequired? 'Y' : 'N');
		$bConfirmReq = (\COption::GetOptionString('main', 'new_user_registration_email_confirmation', 'N') == 'Y' && $emailRequired && $confirm);
		
		
		$arFields['CHECKWORD'] = md5(\CMain::GetServerUniqID().uniqid());
		$arFields['~CHECKWORD_TIME'] = $GLOBALS['DB']->CurrentTimeFunction();
		$arFields['CONFIRM_CODE'] = $bConfirmReq? randString(8): "";
		$arFields['LID'] = SITE_ID;
		$arFields['ACTIVE'] = $bConfirmReq ? 'N': 'Y';
		$arFields['LOGIN'] = $arFields['EMAIL'];

		$arFields['USER_IP'] = $_SERVER['REMOTE_ADDR'];
		$arFields['USER_HOST'] = @gethostbyaddr($_SERVER['REMOTE_ADDR']);
				
		$defGroup = \COption::GetOptionString('main', 'new_user_registration_def_group', '');
		if($defGroup != '') {
			$arFields['GROUP_ID'] = explode(',', $defGroup);
		}
		
		return $arFields;
	}
	
	public static function sendEmailConfirm($arEventFields) {
		
		$event = new \CEvent;
		$arEventFields['CONFIRM_LINK'] = 'http://' . $_SERVER['HTTP_HOST'] . '/confirm/?confirm_user_id=' . $arEventFields['USER_ID'] . '&confirm_code=' . $arEventFields['CONFIRM_CODE'];
		$arEventFields['CLEAN_UP_DAYS'] = \COption::GetOptionString('main', 'new_user_registration_cleanup_days');
		$arEventFields['CLEAN_UP_DAYS_TEXT'] = CHelper::wordDeclension($arEventFields['CLEAN_UP_DAYS'], 'дня', 'дней', 'дней');
		$event->SendImmediate("NEW_USER_CONFIRM", SITE_ID, $arEventFields);
		
	}
	
}
?>