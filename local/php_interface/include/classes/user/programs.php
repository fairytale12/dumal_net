<?
namespace ft;
use Bitrix\Main\Loader;
use Bitrix\Main\UserTable;

class CUserPrograms {
	
	/**
	 * Получаем купленные программы пользователя
	 */
	public static function get($userId, $programId = false, $allData = false, $isPilot = false) {
		$userId = intval($userId);
		if(empty($userId)) {
			return false;
		}
		
		$arPrograms = array();
		
		$modelObj = model\CUserProgramsModel::getInstance();
		if($allData) {
			$arSelect = array('*');
		} else {
			$arSelect = array('ID');
		}
		
		$arFilter = array('UF_USER_ID' => $userId);
		
		if($programId) {
			$arFilter['UF_PROGRAM'] = $programId;
		}
		
		if($isPilot) {
			$arFilter['UF_IS_PILOT'] = 1;
		}
		
		$rsElement = $modelObj->getList($arSelect, $arFilter, array('UF_DATE_CREATE' => 'DESC'));
		while($arElement = $rsElement->fetch()) {
			if($programId) {
				if($allData) {
					$arPrograms = $arElement;
				} else {
					$arPrograms = true;
				}
			} else {
				if($allData) {
					$arPrograms[$arElement['ID']] = $arElement;
				} else {
					$arPrograms[] = $arElement['ID'];
				}
			}
		}
		
		return $arPrograms;
		
	}
	
	/**
	 * Удаление купленной программы
	 */
	public static function delete($elementId) {
		$modelObj = model\CUserProgramsModel::getInstance();
		return $modelObj->delete($elementId);
	}
	
	/**
	 * Удаление купленных программ пользователя
	 */
	public static function deleteAll($userId) {
		if(!$arElementIds = self::get($userId)) {
			return false;
		}
		
		foreach($arElementIds as $elementId) {
			self::delete($elementId);
		}
		
		return true;
	}
	
	/**
	 * Добавление купленной программы для пользователя
	 */
	public static function add($userId, $programId, $isPilot = false) {
		
		$elementId = null;
		$programId = intval($programId);
		if(empty($programId)) {
			return false;
		}
		
		if($arElement = self::get($userId, $programId)) {
			$elementId = $arElement['ID'];
			if(!$arElement['UF_IS_PILOT']) {
				return false;
			}
		}
		
		
		$modelObj = model\CProgramLessonsModel::getInstance();
		$arFilter = array(
			'=UF_PROGRAM' => $programId,
		);
		
		$dateCreate = \ConvertTimeStamp(time(), 'FULL', 's1');
		if($arLesson = $modelObj->getList(array('*'), $arFilter, array('UF_DATE_UPDATE' => 'DESC'))-> fetch()) {
			// Если покупаем программу и по ней уже есть уроки, то заменяем дату создания на дату изменения последнего урока.
			$dateCreate = $arLesson['UF_DATE_UPDATE'];
		}
		
		$modelObj = model\CUserProgramsModel::getInstance();
		$arFields = array(
			'UF_USER_ID' => $userId,
			'UF_PROGRAM' => $programId,
			'UF_DATE_CREATE' => $dateCreate,
			'UF_IS_PILOT' => ($isPilot ? 1 : 0)
		);
		
		if(is_null($elementId)) {
			return $modelObj->add($arFields);
		} else {
			$modelObj->update($elementId, $arFields);
			return $elementId;
		}
		
	}
	
	/**
	 * Проверяет наличие программы у пользователя
	 */
	public static function hasProgram($userId, $programId) {
		
		$programId = intval($programId);
		if(empty($programId)) {
			return false;
		}
		
		return self::get($userId, $programId);
	}
	
	/**
	 * Получает ID купленных программ
	 */
	public static function getProgramIds($userId, $isPilot = false) {
		if(!$arElements = self::get($userId, false, true, $isPilot)) {
			return false;
		}
		
		$arValues = array();
		foreach($arElements as $arElement) {
			if(empty($arElement['UF_PROGRAM'])) {
				continue;
			}
			$arValues[] = $arElement['UF_PROGRAM'];
		}
		
		$arValues = array_unique($arValues);
		
		return (!empty($arValues) ? $arValues : false);
	}
	
	/**
	 * Формирует ссылку на занятие
	 */
	public static function getLessonLink($programCode, $lessonId) {
		return '/account/programs/' . $programCode . '/' . $lessonId . '/';
	}
	
	/**
	 * Получает занятия программы
	 */
	public static function getProgramLessons($programCode, $userId = null) {
		
		$programCode = trim(htmlspecialchars($programCode));
		$userId = intval($userId);
		if(empty($userId)) {
			$userId = intval($GLOBALS['USER']->getId());
		}
		if(empty($programCode)) {
			return CHelper::returnAnswer(-1, 'Не указан символьный код программы');
		}
		
		Loader::includeModule('iblock');
		if(!$arPrograms = self::get($userId, false, true)) {
			return CHelper::returnAnswer(-2, 'Не найдены купленные программы');
		}
		
		
		$arProgramIds = array();
		$arPilotProgramIds = array();
		$arTmpPrograms = array();
		foreach($arPrograms as $arElement) {
			if(empty($arElement['UF_PROGRAM'])) {
				continue;
			}
			
			$arProgramIds[] = $arElement['UF_PROGRAM'];
			
			if($arElement['UF_IS_PILOT']) {
				$arPilotProgramIds[] = $arElement['UF_PROGRAM'];
			}
			
			$arTmpPrograms[$arElement['UF_PROGRAM']] = $arElement;
		}
		$arPrograms = $arTmpPrograms;
		unset($arTmpPrograms);
		
		$arSort = array('ID' => 'ASC');
		
		$arFilter = array(
			'IBLOCK_ID' => PROGRAM_IBLOCK_ID,
			'ID' => $arProgramIds,
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
			return CHelper::returnAnswer(-3, 'Программа не доступна');
		}
		$arProgram = $obProgram->getFields();
		$arProgram['PROPERTIES'] = $obProgram->getProperties();
		
		$arProgram['IS_PILOT'] = false;
		
		if(in_array($arProgram['ID'], $arPilotProgramIds)) {
			$arProgram['IS_PILOT'] = true;
		}
		
		$arLessons = array();
		
		$arFilter = array(
			'=UF_PROGRAM' => $arProgram['ID'],
		);
		
		if(!$arProgram['IS_PILOT']) {
		
			if(!$arProgram['PROPERTIES']['IS_CLOSED']['VALUE_ENUM_ID'] && !empty($arPrograms[$arProgram['ID']])) {
				// Если программа не закончена, то вводим фильтр по дате покупки
				$programKey = array_search($arProgram['ID'], $arPrograms[$arProgram['ID']]);
				if(!empty($arPrograms[$arProgram['ID']]['UF_DATE_CREATE'])) {
					// Если удалось найти программу в списке купленных
					$buyDate = trim($arPrograms[$arProgram['ID']]['UF_DATE_CREATE']->toString());
				}
				
				if(strtotime($buyDate)) {
					// Если дата корректна, то подставляем ее в фильтр
					$arFilter['>=UF_DATE_UPDATE'] = $buyDate;
				}
			}
		
		} else {
			$arFilter['UF_IS_PILOT'] = 1;
		}
		
		$arLessonIds = array();
		
		$modelObj = model\CProgramLessonsModel::getInstance();
		$rsLessons = $modelObj->getList(array('*'), $arFilter, array('UF_DATE_UPDATE' => 'DESC', 'UF_NUMBER' => 'DESC'));
		while($arLesson = $rsLessons->fetch()) {
			$arLesson['LINK'] = self::getLessonLink($programCode, $arLesson['ID']);
			$arLesson['IS_COMPLETED'] = false;
			$arLessons[] = $arLesson;
			$arLessonIds[] = $arLesson['ID'];
		}
		
		
		// Выполненные задания уроков
		$arUserTaskIds = array();
		$modelObj = model\CUserLessonTasksModel::getInstance();
		
		$arFilter = array(
			'=UF_PROGRAM' => $arProgram['ID'],
			'=UF_LESSON' => $arLessonIds,
			'=UF_USER_ID' => $userId,
		);
		
		$rsUserTask = $modelObj->getList(array('*'), $arFilter);
		while($arUserTask = $rsUserTask->fetch()) {
			$arUserTaskIds[] = $arUserTask['UF_TASK'];
		}
		
		$modelObj = model\CLessonTasksModel::getInstance();
		$arFilter = array(
			'=UF_PROGRAM' => $arProgram['ID'],
			'=UF_LESSON' => $arLessonIds,
		);
		
		if(!empty($arUserTaskIds)) {
			$arFilter['!ID'] = $arUserTaskIds;
		}
		
		$arNotCompletedLessonsIds = array();
		
		$rsTask = $modelObj->getList(array('*'), $arFilter, array(), array('UF_LESSON'));
		while($arTask = $rsTask->fetch()) {
			$arNotCompletedLessonsIds[] = $arTask['UF_LESSON'];
		}
		
		foreach($arLessons as $key => $arLesson) {
			if(in_array($arLesson['ID'], $arNotCompletedLessonsIds)) {
				continue;
			}
			
			$arLessons[$key]['IS_COMPLETED'] = true;
		}
		
		return CHelper::returnAnswer(1, 'Программа найдена', array(
			'PROGRAM' => $arProgram,
			'LESSONS' => $arLessons,
		));
		
		
	}
	
	/**
	 * Получает занятие программы
	 */
	public static function getProgramLesson($programCode, $lessonId, $userId = null) {
		
		$programCode = trim(htmlspecialchars($programCode));
		$lessonId = intval($lessonId);
		$userId = intval($userId);
		if(empty($userId)) {
			$userId = intval($GLOBALS['USER']->getId());
		}
		
		if(empty($programCode)) {
			return CHelper::returnAnswer(-1, 'Не указан символьный код программы');
		}
		
		if(empty($lessonId)) {
			return CHelper::returnAnswer(-2, 'Не указан ID урока');
		}
		
		Loader::includeModule('iblock');
		if(!$arPrograms = self::get($userId, false, true)) {
			return CHelper::returnAnswer(-3, 'Не найдены купленные программы');
		}
		
		$arProgramIds = array();
		$arPilotProgramIds = array();
		foreach($arPrograms as $arElement) {
			if(empty($arElement['UF_PROGRAM'])) {
				continue;
			}
			
			$arProgramIds[] = $arElement['UF_PROGRAM'];
			
			if($arElement['UF_IS_PILOT']) {
				$arPilotProgramIds[] = $arElement['UF_PROGRAM'];
			}
		}
		
		$arSort = array('ID' => 'ASC');
		
		$arFilter = array(
			'IBLOCK_ID' => PROGRAM_IBLOCK_ID,
			'ID' => $arProgramIds,
			'CODE' => $programCode
		);
		
		$arSelect = array(
			'ID',
			'NAME',
			'DETAIL_TEXT',
			'DETAIL_PAGE_URL',
			'PROPERTY_*',
		);
		
		$arProgram = array();
		
		$rsProgram = \CIBlockElement::getList($arSort, $arFilter, false, false, $arSelect);
		$rsProgram->SetUrlTemplates('/account/programs/#ELEMENT_CODE#/', '', '');
		if(!$obProgram = $rsProgram->getNextElement()) {
			return CHelper::returnAnswer(-4, 'Программа не доступна');
		}
		
		$arProgram = $obProgram->getFields();
		$arProgram['PROPERTIES'] = $obProgram->getProperties();
		
		$arProgram['IS_PILOT'] = false;
		
		if(in_array($arProgram['ID'], $arPilotProgramIds)) {
			$arProgram['IS_PILOT'] = true;
		}
		
		$arFilter = array(
			'=UF_PROGRAM' => $arProgram['ID'],
			'=ID' => $lessonId
		);
		
		$modelObj = model\CProgramLessonsModel::getInstance();
		if(!$arLesson = $modelObj->getList(array('*'), $arFilter, array())->fetch()) {
			return CHelper::returnAnswer(-5, 'Урок не найден');
		}
		
		if($arProgram['IS_PILOT'] && !$arLesson['UF_IS_PILOT']) {
			return CHelper::returnAnswer(-5, 'Урок не доступен');
		}
		
		$arTasks = array();
		
		if($arLesson['UF_SHOW_TASKS']) {
		
			$arUserTasks = self::getCompletedTaskIds($arProgram['ID'], $arLesson['ID'], $userId);
			
			$arFilter = array(
				'=UF_PROGRAM' => $arProgram['ID'],
				'=UF_LESSON' => $lessonId,
			);
			
			$modelObj = model\CLessonTasksModel::getInstance();
			$rsTask = $modelObj->getList(array('*'), $arFilter, array('UF_SORT' => 'ASC'));
			while($arTask = $rsTask->fetch()) {
				
				$arTask['IS_COMPLETED'] = false;
				if(in_array($arTask['ID'], $arUserTasks)) {
					$arTask['IS_COMPLETED'] = true;
				}
				
				$arTasks[] = $arTask;
			}
			
		}
		
		return CHelper::returnAnswer(1, 'Урок найден', array(
			'PROGRAM' => $arProgram,
			'LESSON' => $arLesson,
			'TASKS' => $arTasks,
		));
	}
	
	/**
	 * Проверяет выполнено ли задание урока у пользователя
	 */
	public static function taskIsComplete($programId, $lessonId, $taskId, $userId = null) {
		
		$programId = intval($programId);
		$lessonId = intval($lessonId);
		$taskId = intval($taskId);
		$userId = intval($userId);
		if(empty($userId)) {
			$userId = intval($GLOBALS['USER']->getId());
		}
		
		if(empty($programId) || empty($lessonId) || empty($taskId) || empty($userId)) {
			return false;
		}
		
		$modelObj = model\CUserLessonTasksModel::getInstance();
		
		$arFilter = array(
			'=UF_PROGRAM' => $programId,
			'=UF_LESSON' => $lessonId,
			'=UF_TASK' => $taskId,
			'=UF_USER_ID' => $userId,
		);
		
		if(!$arUserCompletedTask = $modelObj->getList(array('*'), $arFilter)->fetch()) {
			return false;
		}
		return $arUserCompletedTask['ID'];
	}
	
	/**
	 * Отмечает задание урока как выполненное
	 */
	public static function completeTask($programId, $lessonId, $taskId, $userId = null) {
		
		$programId = intval($programId);
		$lessonId = intval($lessonId);
		$taskId = intval($taskId);
		$userId = intval($userId);
		if(empty($userId)) {
			$userId = intval($GLOBALS['USER']->getId());
		}
		
		if(empty($programId) || empty($lessonId) || empty($taskId) || empty($userId)) {
			return false;
		}
		
		if($completedTaskId = self::taskIsComplete($programId, $lessonId, $taskId, $userId)) {
			return $completedTaskId;
		}
		
		$modelObj = model\CUserLessonTasksModel::getInstance();
		$arFields = array(
			'UF_PROGRAM' => $programId,
			'UF_LESSON' => $lessonId,
			'UF_TASK' => $taskId,
			'UF_USER_ID' => $userId,
			'UF_DATE_CREATE' => \ConvertTimeStamp(time(), 'FULL', 's1'),
		);
		return $modelObj->add($arFields);
	}
	
	/**
	 * Получает список выполненных заданий программы урока
	 */
	public static function getCompletedTaskIds($programId, $lessonId, $userId = null) {
		$programId = intval($programId);
		$lessonId = intval($lessonId);
		$userId = intval($userId);
		if(empty($userId)) {
			$userId = intval($GLOBALS['USER']->getId());
		}
		
		if(empty($programId) || empty($lessonId) || empty($userId)) {
			return false;
		}
		
		$arUserTaskIds = array();
		
		$modelObj = model\CUserLessonTasksModel::getInstance();
		
		$arFilter = array(
			'=UF_PROGRAM' => $programId,
			'=UF_LESSON' => $lessonId,
			'=UF_USER_ID' => $userId,
		);
		
		$rsUserTask = $modelObj->getList(array('*'), $arFilter);
		while($arUserTask = $rsUserTask->fetch()) {
			$arUserTaskIds[] = $arUserTask['UF_TASK'];
		}
		
		return $arUserTaskIds;
	}
	
	/**
	 * Получает процент пройденных заданий урока
	 */
	public static function getLessonProgress($programId, $lessonId, $userId = null) {
		$programId = intval($programId);
		$lessonId = intval($lessonId);
		$userId = intval($userId);
		if(empty($userId)) {
			$userId = intval($GLOBALS['USER']->getId());
		}
		
		if(empty($programId) || empty($lessonId) || empty($userId)) {
			return 0;
		}
		
		$arUserTasks = self::getCompletedTaskIds($programId, $lessonId, $userId);
		$arTasks = array();
		$completedTasksCount = 0;
		$arFilter = array(
			'=UF_PROGRAM' => $programId,
			'=UF_LESSON' => $lessonId,
		);
		
		$modelObj = model\CLessonTasksModel::getInstance();
		$rsTask = $modelObj->getList(array('*'), $arFilter, array('UF_SORT' => 'ASC'));
		while($arTask = $rsTask->fetch()) {
			
			if(in_array($arTask['ID'], $arUserTasks)) {
				$completedTasksCount++;
			}
			
			$arTasks[] = $arTask;
		}
		
		return CHelper::getProgress($completedTasksCount, count($arTasks));
		
	}
	
	/**
	 * Получаем список пользователей, купивших программу
	 */
	public static function getProgramUsers($programId) {
		$programId = intval($programId);
		if(empty($programId)) {
			return false;
		}
		
		$arUsers = array();
		$arUserIds = array();
		
		$arFilter = array(
			'UF_PROGRAM' => $programId
		);
		
		$modelObj = model\CUserProgramsModel::getInstance();
		$rsUserPrograms = $modelObj->getList(array('UF_USER_ID'), $arFilter);
		while($arUserProgram = $rsUserPrograms->fetch()) {
			$arUserIds[] = $arUserProgram['UF_USER_ID'];
		}
		
		$arUserIds = array_unique($arUserIds);
		if(!empty($arUserIds)) {
			
			$arSelect = array(
				'ID',
				//'LAST_NAME',
				//'NAME',
				//'SECOND_NAME',
				'EMAIL'
			);
			
			$arFilter = array(
				'=ID' => $arUserIds
			);
			
			$rsUsers = UserTable::getList(array('select' => $arSelect, 'filter' => $arFilter));
			while($arUser = $rsUsers ->fetch()) {
				$arUsers[] = $arUser;
			}
		}
		
		return $arUsers;
	}
	
	/**
	 * Добавление бесплатной программы
	 */
	public static function addPilotProgramToUser($programId, $userId) {
		
		$programId = intval($programId);
		$userId = intval($userId);
		
		if(empty($programId) || empty($userId)) {
			return false;
		}
		
		if(!self::get($userId, $programId)) {
			// Проверяет есть ли программа, если нет - добавляет
			self::add($userId, $programId, true);
		}
		
		$modelObj = model\CPilotProgramsModel::getInstance();
		
		if($modelObj->getList(array('*'), array('=UF_PROGRAM' => $programId, '=UF_USER_ID' => $userId))->fetch()) {
			// Проверяет, добавлена ли запись о пробной программе
			return true;
		}
		
		// Если нет - создает
		$modelObj->add(array(
			'UF_PROGRAM' 		=> $programId,
			'UF_USER_ID' 		=> $userId,
			'UF_DATE_CREATE' 	=> \ConvertTimeStamp(time(), 'FULL', 's1')
		));
		
		return true;
	}
	
	
	
	
	/** Агенты */
	
	/**
	 * Уведомление о новом занятии
	 */ 
	public static function newLessonSendInfoAgent() {
		
		Loader::includeModule('iblock');
		
		$arPrograms = array();
		$arProgramIds = array();
		$arLessons = array();
		
		// Получаем все занятия, для которых не отправлены уведомления
		$modelObj = model\CProgramLessonsModel::getInstance();
		$arFilter = array(
			'UF_NOTIFY_COMPLETE' => 0
		);
		$rsLessons = $modelObj->getList(array('ID', 'UF_PROGRAM'), $arFilter, array('ID' => 'ASC'));
		while($arLesson = $rsLessons->fetch()) {
			
			if(empty($arLesson['UF_PROGRAM'])) {
				continue;
			}
			
			$arLessons[] = $arLesson;
			$arProgramIds[] = $arLesson['UF_PROGRAM'];
		}
		
		if(!empty($arProgramIds)) {
			// Если программы есть, то получаем их и пользователей, у которых куплена эта программа
			$arProgramIds = array_unique($arProgramIds);
			$rsProgram = \CIBlockElement::getList(
				array(), 
				array(
					'=IBLOCK_ID' => PROGRAM_IBLOCK_ID, 
					'=ID' => $arProgramIds
				), 
				false, 
				false, 
				array(
					'ID', 
					'NAME', 
					'DETAIL_PAGE_URL'
				)
			);
			$rsProgram->SetUrlTemplates('/account/programs/#ELEMENT_CODE#/', '', '');
			while($arProgram = $rsProgram->getNext()) {
				$arProgram['USERS'] = \ft\CUserPrograms::getProgramUsers($arProgram['ID']);
				$arPrograms[$arProgram['ID']] = $arProgram;
			}
			
			foreach($arLessons as $arLesson) {
				// Отсылаем уведомления по каждому занятию для каждого пользователя
				$arProgram = $arPrograms[$arLesson['UF_PROGRAM']];
				if(empty($arProgram)) {
					continue;
				}
			
				if(!empty($arProgram['USERS']) && is_array($arProgram['USERS'])) {
					foreach($arProgram['USERS'] as $arUser) {
					
						if(empty($arUser['EMAIL'])) {
							continue;
						}
						
						$arEventFields = array(
							'PROGRAM_NAME' 	=> $arProgram['NAME'],
							'PROGRAM_LINK' 	=> CHelper::getDomain() . $arProgram['DETAIL_PAGE_URL'],
							'EMAIL' 		=> $arUser['EMAIL']
						);
						
						\CEvent::send('FT_ADDED_NEW_LESSON', 's1', $arEventFields);
					}
				}
				
				$modelObj->update($arLesson['ID'], array('UF_NOTIFY_COMPLETE' => 1));
			}
		}
		
		return 'ft\CUserPrograms::newLessonSendInfoAgent();';
		
	}
	
	/**
	 * Уведомление о дате начала занятия
	 */ 
	public static function lessonSoonBeginAgent() {
		
		// раз в 5 минут
		
		Loader::includeModule('iblock');
		
		$arPrograms = array();
		$arProgramIds = array();
		$arLessons = array();
		
		// Получаем все занятия, которые начнутся через час
		$modelObj = model\CProgramLessonsModel::getInstance();
		$arFilter = array(
			'UF_NOTIFY_SOON_BEGIN' => 0,
			'!UF_DATE_BEGIN' => false,
			'<=UF_DATE_BEGIN' => \ConvertTimeStamp(time() + 3600, 'FULL', 's1'),
		);
		$rsLessons = $modelObj->getList(array('ID', 'UF_PROGRAM', 'UF_NAME'), $arFilter, array('ID' => 'ASC'));
		while($arLesson = $rsLessons->fetch()) {
			
			if(empty($arLesson['UF_PROGRAM'])) {
				continue;
			}
			
			$arLessons[] = $arLesson;
			$arProgramIds[] = $arLesson['UF_PROGRAM'];
		}
		
		if(!empty($arProgramIds)) {
			// Если программы есть, то получаем их и пользователей, у которых куплена эта программа
			$arProgramIds = array_unique($arProgramIds);
			$rsProgram = \CIBlockElement::getList(
				array(), 
				array(
					'=IBLOCK_ID' => PROGRAM_IBLOCK_ID, 
					'=ID' => $arProgramIds
				), 
				false, 
				false, 
				array(
					'ID', 
					'NAME', 
					'CODE', 
				)
			);
			while($arProgram = $rsProgram->getNext()) {
				$arProgram['USERS'] = \ft\CUserPrograms::getProgramUsers($arProgram['ID']);
				$arPrograms[$arProgram['ID']] = $arProgram;
			}
			
			foreach($arLessons as $arLesson) {
				// Отсылаем уведомления по каждому занятию для каждого пользователя
				$arProgram = $arPrograms[$arLesson['UF_PROGRAM']];
				if(empty($arProgram)) {
					continue;
				}
			
				if(!empty($arProgram['USERS']) && is_array($arProgram['USERS'])) {
					foreach($arProgram['USERS'] as $arUser) {
					
						if(empty($arUser['EMAIL'])) {
							continue;
						}
						
						$arEventFields = array(
							'PROGRAM_NAME' 	=> $arProgram['NAME'],
							'LESSON_NAME' 	=> $arLesson['UF_NAME'],
							'PROGRAM_LINK' 	=> CHelper::getDomain() . self::getLessonLink($arProgram['CODE'], $arLesson['ID']),
							'EMAIL' 		=> $arUser['EMAIL']
						);
						
						\CEvent::send('FT_ADDED_LESSON_SOON_BEGIN', 's1', $arEventFields);
					}
				}
				
				$modelObj->update($arLesson['ID'], array('UF_NOTIFY_SOON_BEGIN' => 1));
			}
		}
		
		return 'ft\CUserPrograms::lessonSoonBeginAgent();';
		
	}
	
	
}

?>