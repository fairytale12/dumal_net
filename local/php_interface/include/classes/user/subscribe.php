<?
namespace ft;

use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;

class CSubscribe {
	
	const SITE_ID = 's1';
	const MAIL_SALT = 'dumal.net';
	
	/**
	 * Получает список рубрик
	 */
	public static function getRubrics($onlyIds = false, $ids = array()) {
		Loader::includeModule('subscribe');
		
		$arRubrics = array();
		
		if(!empty($ids) && !is_array($ids)) {
			$ids = array($ids);
		}
		
		if((!is_array($ids) && empty($ids)) || (is_array($ids) && empty($ids[0]) && count($ids))) {
			return false;
		}
		
		$strQuery = '
			SELECT
				' . ($onlyIds ? '`b_list_rubric`.`ID` ID' : '*') . '
			FROM
				`b_list_rubric`
			WHERE
				`b_list_rubric`.`ACTIVE` = \'Y\'';
		if(!empty($ids)) {
			$strQuery .= ' AND `b_list_rubric`.`ID` IN (' . implode(',', $ids) . ')';
		}
		
		$rsRubric = $GLOBALS['DB']->query($strQuery);
		while($arRubric = $rsRubric->fetch()) {
			if($onlyIds) {
				$arRubrics[] = $arRubric['ID'];
			} else {
				$arRubrics[] = $arRubric;
			}
		}
		
		return $arRubrics;
	}
	
	/**
	 * Подписка на рубрики
	 */
	public static function subscribe($userId = false, $email = '', $arRubricIds = array(), $sendConfirm = true) {
		
		if($userId !== false) {
			$userId = intval($userId);
		}
		if(!empty($userId) && !$arUser = UserTable::getList(array('select' => array('ID', 'EMAIL'), 'filter' => array('ID' => $userId)))->fetch()) {
			$userId = false;
		}
		
		if(!empty($arUser)) {
			$email = $arUser['EMAIL'];
		}
		
		if(!check_email($email)) {
			return CHelper::returnAnswer(-1, 'Неправильный e-mail');
		}
		
		$arRubricFilter = array();
		
		if(!empty($arRubricIds) && !is_array($arRubricIds)) {
			$arRubricIds = array($arRubricIds);
		}
		
		if(!empty($arRubricIds)) {
			$arRubricFilter = $arRubricIds;
		}
		$arRubricIds = self::getRubrics(true, $arRubricFilter);
		
		if(empty($arRubricIds)) {
			return CHelper::returnAnswer(-2, 'Рубрики не найдены');
		}
		
		Loader::includeModule('subscribe');
		
		$arSort = array();
		$arFilter = array();
		if($userId) {
			$arFilter['USER_ID'] = $userId;
		} else {
			$arFilter['EMAIL'] = $email;
		}
		
		$subscribe = new \CSubscription;
		
		$arSubscribeFields = array();
		
		$successText = '';
		if($arSubscribe = \CSubscription::getList($arSort, $arFilter, false)->fetch()) {
			
			$arCurrentRubrics = \CSubscription::GetRubricArray($arSubscribe['ID']);
		
			$arDiff = array_diff($arRubricIds, $arCurrentRubrics);
			
			if(empty($arDiff) && $arSubscribe['CONFIRMED'] == 'Y') {
				return CHelper::returnAnswer(1, 'Вы уже подписаны на эту рассылку');
			}
			
			$successText = 'Вы подписались на рассылку';
			
			if($arSubscribe['CONFIRMED'] != 'Y') {
				if($sendConfirm) {
					
					$arSubscribeFields['SEND_CONFIRM'] = 'Y';
					$successText .= ', на вашу почту отправлено подтверждение';
					
				} else {
					$arSubscribeFields['CONFIRMED'] = 'Y';
				}
			}
			
			if($arSubscribe['ACTIVE'] != 'Y') {
				$arSubscribeFields['ACTIVE'] = 'Y';
			}
			
			$arSubscribeFields['RUB_ID'] = array_unique(array_merge($arCurrentRubrics, $arRubricIds));
			//p($arSubscribeFields['RUB_ID']);die();
			$result = $subscribe->update($arSubscribe['ID'], $arSubscribeFields, self::SITE_ID);
			if($result && !\CSubscription::IsAuthorized($arSubscribe['USER_ID'])) {
				\CSubscription::Authorize($arSubscribe['USER_ID']);
				if($arSubscribe['CONFIRMED'] != 'Y' && $arSubscribeFields['SEND_CONFIRM'] == 'Y') {
					$subscribe->ConfirmEvent($arSubscribe['ID'], self::SITE_ID);
				}
			}
			
		} else {
			//p($arRubricIds);die();
			$successText = 'Вы подписались на рассылку' . ($sendConfirm ? ', на вашу почту отправлено подтверждение' : '');
			$arSubscribeFields = array(
				'USER_ID' 		=> (!empty($userId) ? $userId : false),
				'FORMAT' 		=> 'html',
				'EMAIL' 		=> $email,
				'ACTIVE' 		=> 'Y',
				'RUB_ID' 		=> $arRubricIds,
				'SEND_CONFIRM'  => ($sendConfirm ? 'Y' : 'N'),
				'CONFIRMED' 	=> ($sendConfirm ? 'N' : 'Y')
			);
			
			$result = $subscribe->add($arSubscribeFields, self::SITE_ID);
			if($result && !\CSubscription::IsAuthorized($result)) {
				\CSubscription::Authorize($result);
			}
		}
		
		return CHelper::returnAnswer(
			($result ? 1 : -3), 
			($result ? $successText : 'Не удалось подписаться: ' . $subscribe->LAST_ERROR)
		);
	}
	
	/**
	 * Отписка от рубрик
	 */
	public static function unsubscribe($subscribeId = false, $emailHash = '', $arRubricIds = array()) {
		
		$subscribeId = intval($subscribeId);
		$emailHash = trim($emailHash);
		
		if(empty($subscribeId)) {
			return CHelper::returnAnswer(-1, 'Не указан ID подписки');
		}
		
		if(empty($emailHash)) {
			return CHelper::returnAnswer(-2, 'Не передана контрольная строка');
		}
		
		
		$arRubricFilter = array();
		
		if(!empty($arRubricIds) && !is_array($arRubricIds)) {
			$arRubricIds = array($arRubricIds);
		}
		
		if(!empty($arRubricIds)) {
			$arRubricFilter = $arRubricIds;
		}
		$arRubricIds = self::getRubrics(true, $arRubricFilter);
		
		if(empty($arRubricIds)) {
			return CHelper::returnAnswer(-3, 'Рубрики не найдены');
		}
		
		Loader::includeModule('subscribe');
		
		$arSort = array();
		$arFilter = array();
		$arFilter['ID'] = $subscribeId;
		
		
		$subscribe = new \CSubscription;
		
		if(!$arSubscribe = $subscribe->getList($arSort, $arFilter, false)->fetch()) {
			return CHelper::returnAnswer(-3, 'Подписка не найдена');
		}
		
		if(self::getMailHash($arSubscribe['EMAIL']) != $emailHash) {
			return CHelper::returnAnswer(-4, 'Неправильная контрольная строка');
		}
		
		if($arSubscribe['ACTIVE'] == 'N') {
			return CHelper::returnAnswer(1, 'Вы уже отписаны от всех рассылок');
		}
		
		$arCurrentRubrics = \CSubscription::GetRubricArray($arSubscribe['ID']);
		
		$arDiff = array_diff($arCurrentRubrics, $arRubricIds);
		$arIntersect = array_intersect($arCurrentRubrics, $arRubricIds);
		
		if(empty($arIntersect)) {
			return CHelper::returnAnswer(1, 'Вы уже отписаны от этой рассылки');
		}
		
		$arSubscribeFields = array();
		
		$arSubscribeFields['RUB_ID'] = $arDiff;
		if(empty($arDiff)) {
			//$arSubscribeFields['ACTIVE'] = 'N';
		}
		
		$result = $subscribe->update($arSubscribe['ID'], $arSubscribeFields, self::SITE_ID);
		return CHelper::returnAnswer(
			($result ? 1 : -5),
			($result ? 'Вы отписались от рассылки' : 'Не удалось отписаться от рассылки: ' . $subscribe->LAST_ERROR) 
		);
	}
	
	/**
	 * Подтверждение подписки
	 */
	public static function confirm($userId = false, $email = '', $confirmCode = '') {
		
		$confirmCode = trim($confirmCode);
		if(empty($confirmCode)) {
			return CHelper::returnAnswer(-1, 'Не указан код подтверждения');
		}
		
		if($userId !== false) {
			$userId = intval($userId);
		}
		if(!empty($userId) && !$arUser = UserTable::getList(array('select' => array('ID', 'EMAIL'), 'filter' => array('ID' => $userId)))->fetch()) {
			$userId = false;
		}
		
		if(!empty($arUser)) {
			$email = $arUser['EMAIL'];
		}
		
		if(!check_email($email)) {
			return CHelper::returnAnswer(-2, 'Неправильный e-mail');
		}
		
		Loader::includeModule('subscribe');
		$arSort = array();
		$arFilter = array();
		if($userId) {
			$arFilter['USER_ID'] = $userId;
		} else {
			$arFilter['EMAIL'] = $email;
		}
		
		$subscribe = new \CSubscription;
		
		if(!$arSubscribe = \CSubscription::getList($arSort, $arFilter, false)->fetch()) {
			return CHelper::returnAnswer(-3, 'Подписка не найдена');
		}
		
		if($arSubscribe['CONFIRMED'] == 'Y') {
			return CHelper::returnAnswer(1, 'Подписка уже подтверждена');
		}
		
		if($arSubscribe['CONFIRM_CODE'] != $confirmCode) {
			return CHelper::returnAnswer(-4, 'Неправильный код подтверждения');
		}
		
		if(!$subscribe->update($arSubscribe['ID'], array('CONFIRMED' => 'Y'))) {
			return CHelper::returnAnswer(-5, 'Не удалось обновить подписку: ' . $subscribe->LAST_ERROR);
		}
		
		return CHelper::returnAnswer(1, 'Подписка подтверждена');
		
	}
	
	/**
	 * Подтверждение подписки по ID
	 */
	public static function confirmById($subscribeId, $confirmCode = '') {
		
		$confirmCode = trim($confirmCode);
		$subscribeId = intval($subscribeId);
		if(empty($confirmCode)) {
			return CHelper::returnAnswer(-1, 'Не указан код подтверждения');
		}
		
		if(empty($subscribeId)) {
			return CHelper::returnAnswer(-2, 'Не указан ID подписки');
		}
		
		Loader::includeModule('subscribe');
		$arSort = array();
		$arFilter = array('ID' => $subscribeId);
		
		$subscribe = new \CSubscription;
		
		if(!$arSubscribe = \CSubscription::getList($arSort, $arFilter, false)->fetch()) {
			return CHelper::returnAnswer(-3, 'Подписка не найдена');
		}
		
		if($arSubscribe['CONFIRMED'] == 'Y') {
			return CHelper::returnAnswer(1, 'Подписка уже подтверждена');
		}
		
		if($arSubscribe['CONFIRM_CODE'] != $confirmCode) {
			return CHelper::returnAnswer(-4, 'Неправильный код подтверждения');
		}
		
		if(!$subscribe->update($arSubscribe['ID'], array('CONFIRMED' => 'Y'))) {
			return CHelper::returnAnswer(-5, 'Не удалось обновить подписку: ' . $subscribe->LAST_ERROR);
		}
		
		return CHelper::returnAnswer(1, 'Подписка подтверждена');
		
	}
	
	/**
	 * Получаем хеш от мыла
	 */
	public static function getMailHash($email) {
        return md5(md5($email) . self::MAIL_SALT);
    }
	
	/**
	 * Поверяет подписан ли пользователь на рубрику
	 */
	public static function checkUserSubscribe($rubricId, $userId = null) {
		
		$rubricId = intval($rubricId);
		
		if(empty($rubricId)) {
			return CHelper::returnAnswer(-1, 'Не указана рубрика');
		}
		
		if(is_null($userId)) {
			$userId = $GLOBALS['USER']->getId();
		}
		
		$userId = intval($userId);
		if(empty($userId)) {
			return CHelper::returnAnswer(-2, 'Вы не авторизованы');
		}
		
		$subscribe = new \CSubscription;
		
	}
	
}

?>