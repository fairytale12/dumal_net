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
		return trim(
			(!empty($arUser['LAST_NAME']) ? self::upperFirstSymbol($arUser['LAST_NAME']) : '') . ' ' . 
			(!empty($arUser['NAME']) ? strtoupper(mb_substr($arUser['NAME'], 0, 1)) . '.' : '') . ' ' . 
			(!empty($arUser['SECOND_NAME']) ? strtoupper(mb_substr($arUser['SECOND_NAME'], 0, 1)) . '.' : ''));
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
	
	public static function textCut($text, $length) {
		$obParser = new \CTextParser;
		return $obParser->html_cut($text, $length);
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
	
	/**
	 * Преобразует первый символ в верхний регистр
	 *
	 * @param string $str
	 * @param string $encoding
	 * @return string
	 */
	public static function upperFirstSymbol($str, $encoding = 'UTF-8') {
		$str = mb_ereg_replace('^[\ ]+', '', $str);
		$str = mb_strtoupper(mb_substr($str, 0, 1, $encoding), $encoding). mb_substr($str, 1, mb_strlen($str), $encoding);
		return $str;
	}
	
	public static function showError($text) {
		?>
		<div class="row">
			<div class="col-md-12">
				<div class="alert alert-danger">
					<?=$text?>
				</div>
			</div>
		</div>
		<?
	}
	
	public static function getProgress($currentValue, $maxVaue) {
		$progress = ceil($currentValue / $maxVaue * 100);
		if($progress > 100) {
			$progress = 100;
		}
		
		return $progress;
	}
	
	public static function getHostname($siteID = false) {
        $serverName = '';
        if ($siteID && 0 < strlen($siteID) && $arSite = \CSite::GetArrayByID($siteID)) {
            $serverName = $arSite['SERVER_NAME'];
        }
        if (0 >= strlen(trim($serverName))) {
            if (array_key_exists('HTTP_HOST', $_SERVER) && 0 < strlen(trim($_SERVER['HTTP_HOST']))) {
                $serverName = $_SERVER['HTTP_HOST'];
            //} elseif ('development' == getenv('APPLICATION_ENV')) {
            //    $serverName = 'dev.rentride.ru';
            } elseif (defined("SITE_SERVER_NAME") && 0 < strlen(trim(SITE_SERVER_NAME))) {
                $serverName = SITE_SERVER_NAME;
            } else {
                $serverName = \COption::GetOptionString('main', 'server_name');
            }
        }
        return trim($serverName);
    }
	
	public static function getDomain($siteID = false) {
		return 'http://' . self::getHostname($siteID);
	}
}

?>