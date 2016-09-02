<?
namespace ft;
use Bitrix\Main\Loader;

class CUserPrograms {
	
	public static function get($userId, $allData = false) {
		$userId = intval($userId);
		if(empty($userId)) {
			return false;
		}
		
		Loader::includeModule('iblock');
		
		$arSort = array('ID' => 'DESC');
		
		$arFilter= array(
			'IBLOCK_ID' => USER_PROGRAMS_IBLOCK_ID,
			'PROPERTY_USER_ID' => $userId,
		);
		
		$arSelect = array('ID');
		if($allData) {
			$arSelect = array(
				'ID',
				'PROPERTY_USER_ID',
				'PROPERTY_PROGRAMS',
			);
		}

		return \CIBlockElement::getList($arSort, $arFilter, false, false, $arSelect)->fetch();
	}
	
	public static function add($userId) {
		$userId = intval($userId);
		if(empty($userId)) {
			return false;
		}
		
		Loader::includeModule('iblock');
		
		$arFields = array(
			'IBLOCK_ID' => USER_PROGRAMS_IBLOCK_ID,
			'ACTIVE' => 'Y',
			'NAME' => 'Пользователь ' . $userId,
			'PROPERTY_VALUES' => array(
				'USER_ID' => $userId,
			),
		);
		$el = new \CIBlockElement;

		return $el->add($arFields);
	}
	
	public static function delete($userId) {
		if(!$arElement = self::get($userId)) {
			return false;
		}
		
		$el = new \CIBlockElement;
		return $el->delete($arElement['ID']);
	}
	
	
	public static function update($userId, $arFields = array()) {
		if(!$arElement = self::get($userId)) {
			return false;
		}
		
		$el = new \CIBlockElement;
		return $el->update($arElement['ID'], $arFields);
	}
	
	public static function addProgram($userId, $programId) {
		if(!$arElement = self::get($userId, true)) {
			return false;
		}
		
		$programId = intval($programId);
		if(empty($programId)) {
			return false;
		}
		
		$arValues = array();
		foreach($arElement['PROPERTY_PROGRAMS_VALUE'] as $key => $valueId) {
			$arValues[$arElement['PROPERTY_PROGRAMS_PROPERTY_VALUE_ID'][$key]] = array(
				'VALUE' => $valueId, 
				'DESCRIPTION' => $arElement['PROPERTY_PROGRAMS_DESCRIPTION'][$key]
			);
		}
		
		$arValues['n0'] = array(
			'VALUE' => $programId, 
			'DESCRIPTION' => \ConvertTimeStamp(time(), 'FULL', 's1'),
		);

		\CIBlockElement::SetPropertyValueCode($arElement['ID'], 'PROGRAMS', $arValues);
		
		/*
		\CIBlockElement::SetPropertyValuesEx(
			$arElement['ID'], 
			USER_PROGRAMS_IBLOCK_ID, 
			array('PROGRAMS' => $arValues)
		);
		*/
		
		$GLOBALS['CACHE_MANAGER']->ClearByTag('iblock_id_' . USER_PROGRAMS_IBLOCK_ID);
		
		return true;
	}
	
	public static function hasProgram($userId, $programId) {
		if(!$arElement = self::get($userId, true)) {
			return false;
		}
		
		$programId = intval($programId);
		if(empty($programId)) {
			return false;
		}
		
		return in_array($programId, $arElement['PROPERTY_PROGRAMS_VALUE']);
	}
	
	public static function getProgramIds($userId) {
		if(!$arElement = self::get($userId, true)) {
			return false;
		}
		
		$arValues = array();
		foreach($arElement['PROPERTY_PROGRAMS_VALUE'] as $key => $valueId) {
			$arValues[] = $valueId;
		}
		
		$arValues = array_unique($arValues);
		
		return (!empty($arValues) ? $arValues : false);
	}
	
	public static function getLessonLink($programCode, $lessonId) {
		return '/account/programs/' . $programCode . '/' . $lessonId . '/';
	}
	
	public static function getProgramLessons($programCode, $userId) {
		
		$programCode = trim(htmlspecialchars($programCode));
		if(empty($programCode)) {
			return CHelper::returnAnswer(-1, 'Не указан символьный код программы');
		}
		
		Loader::includeModule('iblock');
		if(!$arPrograms = self::get($userId, true)) {
			return CHelper::returnAnswer(-2, 'Не найдено хранилище программ');
		}
		
		if(empty($arPrograms['PROPERTY_PROGRAMS_VALUE'])) {
			return CHelper::returnAnswer(-3, 'Не найдены купленные программы');
		}
		
		$arSort = array('ID' => 'ASC');
		
		$arFilter = array(
			'IBLOCK_ID' => PROGRAM_IBLOCK_ID,
			'ID' => $arPrograms['PROPERTY_PROGRAMS_VALUE'],
			'CODE' => $programCode
		);
		
		$arSelect = array(
			'ID',
			'NAME',
			'DETAIL_TEXT',
			'PROPERTY_*',
		);
		
		$arProgram = array();
		if(!$obProgram = \CIBlockElement::getList($arSort, $arFilter, false, false, $arSelect)->getNextElement()) {
			return CHelper::returnAnswer(-4, 'Программа не доступна');
		}
		$arProgram = $obProgram->getFields();
		$arProgram['PROPERTIES'] = $obProgram->getProperties();
		
		//p($arProgram);
		
		$arLessons = array();
		
		$arFilter = array(
			'UF_PROGRAM' => $arProgram['ID'],
			/** @TODO Дата покукпи программы */
		);
		
		$modelObj = model\CProgramLessonsModel::getInstance();
		$rsLessons = $modelObj->getList(array('*'), $arFilter, array('UF_NUMBER' => 'ASC'));
		while($arLesson = $rsLessons->fetch()) {
			$arLesson['LINK'] = self::getLessonLink($programCode, $arLesson['ID']);
			$arLessons[] = $arLesson;
		}
		
		return CHelper::returnAnswer(1, 'Программа найдена', array(
			'USER_PROGRAMS' => $arPrograms, //
			'PROGRAM' => $arProgram,
			'LESSONS' => $arLessons
		));
		
		
	}
	
}

?>