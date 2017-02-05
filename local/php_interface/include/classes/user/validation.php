<?
namespace ft;

use Bitrix\Main\UserTable;

class CUserValidation {
	
	/**
	 * Проверка email
	 *
	 * @param string $email
	 * @param bool $withoutUser - проверять только email, без наличия пользователя
	 * @return array
	 */
	public function checkEmail($email, $active = false, $withoutUser = false, $checkConfirmed = false) {
		
		$arReturn = array(
			'RESULT' => 'ERROR',
			'CODE' => 0,
			'TEXT' => 'Пользователь с таким email не найден.'
		);
		
		$email = trim($email);
		$email = htmlspecialchars($email);
		
		if(empty($email)) {
			
			$arReturn['TEXT'] = 'Не указан e-mail.';
			$arReturn['CODE'] = -1;
			
		} elseif(check_email($email)) {
			
			if($withoutUser) {
				$arReturn = array(
					'RESULT' => 'OK',
					'CODE' => 1,
					'TEXT' => 'Пользователь с таким email не найден.'
				);
			} else {
				
				$arFilter = array(
					array(
						'LOGIC' => 'OR',
						array(
							'=EMAIL' => $email,
						),
						array(
							'=LOGIN' => $email
						)
					)
				);
				
				if($active && !$checkConfirmed) {
					$arFilter['ACTIVE'] = 'Y';
				}
				
				if(!$arUser = UserTable::getList(array('select' => array('ID'), 'filter' => $arFilter))->fetch()) {
					$arReturn = array(
						'RESULT' 	=> 'OK',
						'CODE' 		=> 1,
						'TEXT' 		=> 'Пользователь с таким email не найден.'
					);
				} else {
					
					if($checkConfirmed && $arUser['ACTIVE'] != 'Y') {
						$arReturn['TEXT'] = str_replace(array('#EMAIL#'), array($arUser['EMAIL']), UNCONFIRMED_USER_MESSAGE);
						$arReturn['CODE'] = -4;
					} elseif($arUser['ACTIVE'] == 'Y') {
						$arReturn['TEXT'] = 'Пользователь с таким e-mail зарегистрирован в системе.';
						$arReturn['CODE'] = -3;
					}

					$arReturn['USER_ID'] = $arUser['ID'];
				}
				
				
			}
			
		} else {
			$arReturn['TEXT'] = 'Неверный формат e-mail.';
			$arReturn['CODE'] = -2;
		}
		
		return $arReturn;
	}
	
	
	public function checkPassword($password, $confirmPassword = false, $checkValid = true) {
		
		$arErrors = array();
		
		if(empty($password)) {
			$arErrors['PASSWORD'] = 'Не указан пароль.';
		} elseif($checkValid && strlen($password) < 6) {
			$arErrors['PASSWORD'] = 'Пароль не отвечает требованиям безопасности.';
		}
		
		if($confirmPassword !== false) {
		
			if(empty($confirmPassword)) {
				$arErrors['CONFIRM_PASSWORD'] = 'Введите подтверждение пароля';
			}
			
			if(!empty($password) && !empty($confirmPassword) && $password != $confirmPassword) {
				$arErrors['CONFIRM_PASSWORD'] = 'Пароли не совпадают.';
			}
			
		}
		
		return $arErrors;
	}
	
	/**
	 * Проверка полей при регистрации
	 */
	public static function checkFields($arFields, $social = false) {
		
		$arReturn = array();
		$arReturn['FIELDS'] = CHelper::prepareFields($arFields);
		$arReturn['ERRORS'] = array();
		
		/*
		if(!$social && empty($arReturn['FIELDS']['UF_TYPE'])) {
			$arReturn['ERRORS']['UF_TYPE'] = 'Выберите тип пользователя';
		}
		*/
		
		$arEmailValidation = self::checkEmail($arReturn['FIELDS']['EMAIL'], false, false, true);
		if($arEmailValidation['CODE'] <= 0) {
			$arReturn['ERRORS']['EMAIL'] = $arEmailValidation['TEXT'];
		}
		
		$arPasswordErrors = self::checkPassword($arReturn['FIELDS']['PASSWORD'], $arReturn['FIELDS']['CONFIRM_PASSWORD']);
		if(!empty($arPasswordErrors)) {
			$arReturn['ERRORS'] = array_merge($arReturn['ERRORS'], $arPasswordErrors);
		}
		
		if(empty($arReturn['FIELDS']['FORM_CHECK_INPUT'])) {
			$arReturn['ERRORS']['FORM_CHECK_INPUT'] = 'Вы робот?';
		}
		
		/*
		if(!$social && $arReturn['FIELDS']['AGREE'] != 'Y') {
			$arReturn['ERRORS']['AGREE'] = 'Подтвердите согласие с условиями сайта';
		}
		*/
		
		return $arReturn;
	}
	
	
	public static function checkLoginFields($arFields) {
		$arReturn = array();
		$arReturn['FIELDS'] = CHelper::prepareFields($arFields);
		$arReturn['ERRORS'] = array();
				
		$arPasswordErrors = self::checkPassword($arReturn['FIELDS']['PASSWORD'], false, false);
		if(!empty($arPasswordErrors)) {
			$arReturn['ERRORS'] = array_merge($arReturn['ERRORS'], $arPasswordErrors);
		}
		
		$arEmailValidation = self::checkEmail($arReturn['FIELDS']['EMAIL'], false, false, true);
		if($arEmailValidation['CODE'] <= 0 && $arEmailValidation['CODE'] != -3) {
			$arReturn['ERRORS']['EMAIL'] = $arEmailValidation['TEXT'];
		}
		
		if(empty($arReturn['FIELDS']['FORM_CHECK_INPUT'])) {
			$arReturn['ERRORS']['FORM_CHECK_INPUT'] = 'Вы робот?';
		}
		
		return $arReturn;
	}
	
	public static function checkRecoverFields($arFields, $captchaCode = false) {
		$arReturn = array();
		$arReturn['FIELDS'] = CHelper::prepareFields($arFields);
		$arReturn['ERRORS'] = array();
		
		$arEmailValidation = self::checkEmail($arReturn['FIELDS']['EMAIL'], true, false, true);
		if($arEmailValidation['CODE'] != -3) {
			// Если пользователь не найден, или email некорректен
			$arReturn['ERRORS']['EMAIL'] = $arEmailValidation['TEXT'];
		}
		
		if(empty($arReturn['FIELDS']['FORM_CHECK_INPUT'])) {
			$arReturn['ERRORS']['FORM_CHECK_INPUT'] = 'Вы робот?';
		}
		
		if($captchaCode) {
			if(!$GLOBALS['APPLICATION']->CaptchaCheckCode($arReturn['FIELDS']["captcha_word"], $arReturn['FIELDS']["captcha_sid"])) {
				$arReturn['ERRORS']['CAPTCHA'] = 'Код с картинки указан не верно.';
			}
		}
		
		return $arReturn;
	}
	
	public static function checkChangePasswordFields($arFields) {
		
		$arReturn = array();
		$arReturn['FIELDS'] = CHelper::prepareFields($arFields);
		$arReturn['ERRORS'] = array();
		
		$arPasswordErrors = self::checkPassword($arReturn['FIELDS']['PASSWORD'], $arReturn['FIELDS']['CONFIRM_PASSWORD']);
		if(!empty($arPasswordErrors)) {
			$arReturn['ERRORS'] = array_merge($arReturn['ERRORS'], $arPasswordErrors);
		}
				
		if(empty($arReturn['FIELDS']['FORM_CHECK_INPUT'])) {
			$arReturn['ERRORS']['FORM_CHECK_INPUT'] = 'Вы робот?';
		}
		
		return $arReturn;
	}
	
	
}
?>