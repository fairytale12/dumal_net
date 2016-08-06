<?
namespace ft;

class CHelper {
	
	const SESSION_CODE = 'FT_DUMAL_NET';
	
	/**
	 * Сохраняет данные в сессию
	 * 
	 * @param array $arFields
	 * @param bool $clear
	 * @return bool
	 */
	public function setSession($arFields, $clear = false) {
		
		if(!is_array($arFields)) {
			return false;
		}
		
		if(empty($_SESSION[self::SESSION_CODE])) {
			$_SESSION[self::SESSION_CODE] = array();
		}
		
		if($clear) {
			$_SESSION[self::SESSION_CODE] = array();
		}
		
		$_SESSION[self::SESSION_CODE] = array_merge($_SESSION[self::SESSION_CODE], $arFields);
		return true;
	}
	
	/**
	 * Берет данные из сессии
	 *
	 * @return bool
	 */
	public function getSession() {
		return $_SESSION[self::SESSION_CODE];
		return true;
	}
	
	/**
	 *  Очистка параметра сессии
	 *
	 * @return bool
	 */
	public function removeSessionParam($paramName) {
		if(!isset($_SESSION[self::SESSION_CODE][$paramName])) {
			return false;
		}
		unset($_SESSION[self::SESSION_CODE][$paramName]);
		return true;
	}
	
	/**
	 * Очистка сессии
	 *
	 * @return bool
	 */
	public function clearSession() {
		unset($_SESSION[self::SESSION_CODE]);
		return true;
	}
	
	/**
 	 * Declination words
	 *
	 * @param int $number
	 * @param string $nominative
	 * @param string $accusative
	 * @param string $genitive
	 * @return string
	 */
	public function wordDeclension($number, $nominative, $accusative, $genitive, $withoutNumber = false) {
		$returnString = NULL;
		$realNumber = $number;
		if($number > 20) {
			$number = $number%10;
		}
		switch($number) {
			case 1: 
			
				$returnString = $nominative;
				break;
				
			case 2:
			case 3:
			case 4:
			
				$returnString = $accusative;
				break;
				
			default:
				$returnString = $genitive;
		}
		
		return (!$withoutNumber ? $realNumber . ' ' : '') . $returnString;
	}
	
	
	public static function prepareFields($arFields = array()) {
		array_walk_recursive($arFields, function(&$value) {$value = htmlspecialchars($value);});
		array_walk_recursive($arFields, function(&$value) {$value = trim($value);});
		/*if(!empty($arFields['fields'])) {
			$arFields['fields'] = json_decode($arFields['fields']);
		}*/
		
		return $arFields;
	}
	
	public static function preparePhone($phone) {
		$phone = preg_replace('/[^0-9]/', '', $phone);
		
		return $phone;
	}
	
	public static function prepareInt($number) {		
		return intval($number);
	}
	
	public static function prepareAge($age) {
		$age = self::prepareInt($age);
		
		if($age == 0) {
			$age = '';
		}
		
		return $age;
	}
	
	public static function prepareFloat($number) {
		return number_format(str_replace(',', '.', $number), 2, '.', '');
	}
	
	public static function getFio($arUser) {
		return trim($arUser['LAST_NAME'] . ' ' . $arUser['NAME'] . ' ' . $arUser['SECOND_NAME']);
	}
	
	public static function getUserAge($arUser, $field = 'PERSONAL_BIRTHDAY', $withText = true) {
		if(empty($arUser[$field])) {
			return false;
		}
		
		$datetime = new \DateTime($arUser[$field]);
        $interval = $datetime->diff(new \DateTime(date('Y-m-d')));
		$age = $interval->format('%Y');
		
		return $withText ? self::wordDeclension($age, 'год', 'года', 'лет') : $age;
	}
	
	public static function getDayCount($dateBegin, $dateEnd) {
		
		$datetime = new \DateTime($dateBegin);
        $interval = $datetime->diff(new \DateTime($dateEnd));
		$daysCount = $interval->format('%a');
		
		return intval($daysCount);
	}
	
	public static function getHourCount($dateBegin, $dateEnd) {
		
		$datetime = new \DateTime($dateBegin);
        $interval = $datetime->diff(new \DateTime($dateEnd));
		$hoursCount = $interval->format('%h');
		
		return intval($hoursCount);
	}
	
	public static function showPrice($price) {
		if(empty($price)) {
			return false;
		}
		
		return $price . ' руб.';
	}
	
	public static function returnJsonAnswer($arReturn) {
		print json_encode($arReturn);
		die();
	}
	
	public static function returnAnswer($code = 0, $text = 'Неизвестная ошибка', $arAdditionalFields = array()) {
		
		if($code !== 0) {
			$result = $code > 0 ? 'SUCCESS' : 'ERROR';
		} else {
			$result = 'WARNING';
		}
		
		$arReturn = array(		
			'RESULT' => $result,
			'CODE' => $code,
			'TEXT' => $text,
		);
		
		return array_merge($arReturn, $arAdditionalFields);
	}
	
	public static function getShortSize($size) {
		
		$stepArray = array(
			'b',
			'Kb',
			'Mb',
			'Gb',
			'Tb'
		);
		$step = 0;
		while($size >= 1024) {
			$size = $size/1024;
			$step++;
		}
		
		return round($size) . ' ' . $stepArray[$step];
	}
	
}

?>