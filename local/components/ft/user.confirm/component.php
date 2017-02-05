<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
{
	die();
}

/*
Authorization form (for prolog)
Params:
	REGISTER_URL => path to page with authorization script (component?)
	PROFILE_URL => path to page with profile component
*/

/**
 * Bitrix vars
 * @global CMain $APPLICATION
 * @global CUser $USER
 * @var array $arParams
 * @var array $arResult
 */

$arParams['USER_ID'] = trim($arParams['USER_ID']);
if(strlen($arParams['USER_ID']) <= 0)
	$arParams['USER_ID'] = 'confirm_user_id';

$arParams['CONFIRM_CODE'] = trim($arParams['CONFIRM_CODE']);
if(strlen($arParams['CONFIRM_CODE']) <= 0)
	$arParams['CONFIRM_CODE'] = 'confirm_code';

$arParams['LOGIN'] = trim($arParams['LOGIN']);
if(strlen($arParams['LOGIN']) <= 0)
	$arParams['LOGIN'] = 'login';

$arResult['~USER_ID'] = $_REQUEST[$arParams['USER_ID']];
$arResult['USER_ID'] = intval($arResult['~USER_ID']);

$arResult['~CONFIRM_CODE'] = trim($_REQUEST[$arParams['CONFIRM_CODE']]);
$arResult['CONFIRM_CODE'] = htmlspecialcharsbx($arResult['~CONFIRM_CODE']);

$arResult['~LOGIN'] = trim($_REQUEST[$arParams['LOGIN']]);
$arResult['LOGIN'] = htmlspecialcharsbx($arResult['~LOGIN']);

if($USER->IsAuthorized() && strlen($arResult['CONFIRM_CODE']) <= 0) {
	$arResult['MESSAGE_TEXT'] = 'Вы авторизованы';
	$arResult['MESSAGE_CODE'] = -1;
} elseif(strlen($arResult['CONFIRM_CODE']) <= 0) {
	$arResult['MESSAGE_TEXT'] = 'Укажите код подтверждения';
	$arResult['MESSAGE_CODE'] = -2;
} elseif($arResult['USER_ID'] <= 0 && strlen($arResult['~LOGIN']) <= 0) {
	$arResult['MESSAGE_TEXT'] = 'Укажите ID пользователя или Логин';
	$arResult['MESSAGE_CODE'] = -3;
} else {


	if($arResult['USER_ID'] <= 0 && strlen($arResult['~LOGIN']) > 0) {
		$rsUser = CUser::GetByLogin($arResult['~LOGIN']);
	} else {
		$rsUser = CUser::GetByID($arResult['USER_ID']);
	}

	if($arResult['USER'] = $rsUser->GetNext()) {
		// Пользователь нашелся
		
		if($arResult['USER']['ACTIVE'] === 'Y' && (empty($_GET['pilot']) && empty($_GET['program']))) {
			// Пользователь уже активен и доп. параметров нет
			
			$arResult['MESSAGE_TEXT'] = 'Ваш пользователь уже подтвержден';
			$arResult['MESSAGE_CODE'] = 1;
			
		} elseif($arResult['USER']['ACTIVE'] === 'Y' && (!empty($_GET['pilot']) && !empty($_GET['program']))) {
			// Пользователь уже активен и доп. параметры есть
			
			if($arResult['~CONFIRM_CODE'] !== $arResult['USER']['~CONFIRM_CODE']) {
				// Неправильный код подтверждения
				$arResult['MESSAGE_TEXT'] = 'Неправильный код подтверждения';
				$arResult['MESSAGE_CODE'] = -4;
			} else {
				// Верный код подтверждения
				if(!ft\CUserPrograms::addPilotProgramToUser($_GET['program'], $arResult['USER']['ID'])) {
					// Не удалось добавить пробную программу
					$arResult['MESSAGE_TEXT'] = 'Не удалось добавить пробную программу, попробуйте позже';
					$arResult['MESSAGE_CODE'] = -5;
				} else {
					// Добавлена пробная программа
					
					// Все ок - удаляем код подтверждения
					$obUser = new CUser;
					if(!$obUser->Update($arResult['USER']['ID'], array('CONFIRM_CODE' => ''))) {
						$arResult['MESSAGE_TEXT'] = 'Ошибка при обновлении пользователя, попробуйте чуть позже';
						$arResult['MESSAGE_CODE'] = -6;
					} else {
						$arResult['MESSAGE_TEXT'] = 'Пробная программа добавлена!';
						$arResult['MESSAGE_CODE'] = 1;
					}
				}
			}
			
		} elseif($arResult['USER']['ACTIVE'] !== 'Y') {
			// Пользователь не активен

			if($arResult['~CONFIRM_CODE'] !== $arResult['USER']['~CONFIRM_CODE']) {
				// Неправильный код подтверждения
				$arResult['MESSAGE_TEXT'] = 'Неправильный код подтверждения';
				$arResult['MESSAGE_CODE'] = -4;
				
			} else {
				
				// Правильный код подтверждения
				
				if(!empty($_GET['pilot']) && !empty($_GET['program'])) {
					// Доп. параметры
					
					if(!ft\CUserPrograms::addPilotProgramToUser($_GET['program'], $arResult['USER']['ID'])) {
						// Не удалось добавить пробную программу
						$arResult['MESSAGE_TEXT'] = 'Не удалось добавить пробную программу, попробуйте позже';
						$arResult['MESSAGE_CODE'] = -5;
						
					} else {
						// Добавлена пробная программа
						$password = randString(8);
						
						// Все ок - удаляем код подтверждения, активируем пользователя и устанавливаем ему пароль
						$obUser = new CUser;
						if(!$obUser->Update($arResult['USER']['ID'], array('ACTIVE' => 'Y', 'CONFIRM_CODE' => '', 'PASSWORD' => $password))) {
							$arResult['MESSAGE_TEXT'] = 'Ошибка при активации пользователя, попробуйте чуть позже';
							$arResult['MESSAGE_CODE'] = -6;
						} else {

							$arEventFields = $arResult['USER'];
							$arEventFields['PASSWORD'] = $password;
							
							// Подписка
							ft\CSubscribe::confirm($arResult['USER']['ID'], '', array(), false);
							
							// Отсылаем доступы от пользователя на почту
							\CEvent::Send('FT_NEW_USER_ACCESS', array('s1'), $arEventFields);
							
							$arResult['MESSAGE_TEXT'] = 'Пользователь подтвержден, пробная программа добавлена. Вам на почту высланы доступы!';
							$arResult['MESSAGE_CODE'] = 1;
							
							$GLOBALS['USER']->Authorize($arResult['USER']['ID']);
							LocalRedirect('/account/');
						}
					}

				} else {
					// Без доп. параметров
					$obUser = new CUser;
					if(!$obUser->Update($arResult['USER']['ID'], array('ACTIVE' => 'Y', 'CONFIRM_CODE' => ''))) {
						$arResult['MESSAGE_TEXT'] = 'Ошибка при активации пользователя, попробуйте чуть позже';
						$arResult['MESSAGE_CODE'] = -6;
					} else {
				
						// Подписка
						ft\CSubscribe::confirm($arResult['USER']['ID'], '', array(), false);
						
						$arResult['MESSAGE_TEXT'] = 'Пользователь подтвержден!';
						$arResult['MESSAGE_CODE'] = 1;
						
						$GLOBALS['USER']->Authorize($arResult['USER']['ID']);
						LocalRedirect('/account/');
					}
				}
			}
		}
		
	} else {
		$arResult['MESSAGE_TEXT'] = 'Пользователь не найден';
		$arResult['MESSAGE_CODE'] = -2;
	}
}

$this->IncludeComponentTemplate();
?>