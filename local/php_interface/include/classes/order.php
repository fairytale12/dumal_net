<?
namespace ft;

class COrder {
	
	/**
	 * Получает заказ
	 */
	public static function get($orderId, $userId = null) {
		$orderId = intval($orderId);
		
		if(empty($orderId)) {
			return false;
		}
		
		if(!is_null($userId)) {
			$userId = intval($userId);
			if(empty($userId)) {
				return false;
			}
		}
		
		$arFilter = array('=ID' => $orderId);
		if(!empty($userId)) {
			$arFilter['UF_USER_ID'] = $userId;
		}
		
		$modelObj = model\COrderModel::getInstance();
		if(!$arOrder = $modelObj->getList(array('*'), $arFilter)->fetch()) {
			return false;
		}
		
		return $arOrder;
	}
	
	/**
	 * Создает заказ
	 */
	public static function create($itemId, $userId = null) {
		
		$itemId = intval($itemId);
		$userId = intval($userId);
		
		if(empty($itemId)) {
			return false;
		}
		
		if(empty($userId)) {
			$userId = intval($GLOBALS['USER']->getId());
		}
		
		if(empty($userId)) {
			return false;
		}
		
		$arFields = array(
			'UF_DATE_CREATE' => \ConvertTimeStamp(time(), 'FULL', 's1'),
			'UF_ITEM' => $itemId,
			'UF_USER_ID' => $userId
		);
		
		$modelObj = model\COrderModel::getInstance();
		return $modelObj->add($arFields);
	}
	
	/**
	 * Оплачивает заказ
	 */
	public static function pay($orderId, $userId, $sum, $comment = '') {
		
		$orderId = intval($orderId);
		$userId = intval($userId);
		
		if(!$arOrder = self::get($orderId, $userId)) {
			return false;
		}
		
		$arFields = array(
			'UF_DATE_ORDER' => \ConvertTimeStamp(time(), 'FULL', 's1'),
			'UF_PRICE' => CHelper::prepareFloat($sum),
			'UF_COMMENT' => $comment
		);
		
		$modelObj = model\COrderModel::getInstance();
		if(!$modelObj->update($orderId, $arFields)) {
			return false;
		}
		
		return CUserPrograms::add($userId, $arOrder['UF_ITEM']);
	}
	
}
?>