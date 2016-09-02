<?
namespace sebekon\handlers;

use Bitrix\Main;
use Bitrix\Main\Entity;

$eventManager = Main\EventManager::getInstance();

$arHLBlocks = array(
    'ProgramLessons',
);

foreach($arHLBlocks as $hlBlock) {
	//$eventManager->addEventHandler('', $hlBlock . 'OnBeforeAdd', array('\sebekon\handlers\CHLBlock', 'prepareName'));
	$eventManager->addEventHandler('', $hlBlock . 'OnAfterAdd', array('\sebekon\handlers\CHLBlock', 'addXmlId'));
	$eventManager->addEventHandler('', $hlBlock . 'OnBeforeUpdate', array('\sebekon\handlers\CHLBlock', 'checkXmlId'));
	$eventManager->addEventHandler('', $hlBlock . 'OnBeforeAdd', array('\sebekon\handlers\CHLBlock', 'setLessonNumber'));
	//$eventManager->addEventHandler('', $hlBlock . 'OnAfterUpdate', array('\sebekon\handlers\CHLBlock', 'updateCache'));
}

class CHLBlock {

	public static function prepareName(Entity\Event $event) {
		$fields = $event->getParameter('fields');
		
		$name = trim($fields['UF_NAME']);
		
		$result = new Entity\EventResult;
		$result->modifyFields(array('UF_NAME' => $name));
		
		$class = $event->getEntity()->getDataClass();
		if($arElement = $class::getList(array('filter' => array('=UF_NAME' => $name), 'select' => array('ID')))->fetch()) {
			$result->addError(new Entity\FieldError(
				$event->getEntity()->getField('UF_NAME'),
				'Элемент с таким названием уже существует'
			));
		}
		
		return $result;
	}
	
	public static function setLessonNumber(Entity\Event $event) {
		$fields = $event->getParameter('fields');
		
		$programId = intval($fields['UF_PROGRAM']);
		$name = trim($fields['UF_NAME']);
		
		$result = new Entity\EventResult;
		$result->modifyFields(array('UF_NAME' => $name));
		if(!empty($programId)) {
			
			$class = $event->getEntity()->getDataClass();
			
			$arElement = $class::getList(
				array(
					'filter' => array('=UF_PROGRAM' => $programId), 
					'select' => array(new Entity\ExpressionField('CNT', 'COUNT(%s)', array('ID'))), 
				)
			)->fetch();

			$result->modifyFields(array('UF_NUMBER' => ++$arElement['CNT']));
			
		}
		
		return $result;
	}

	public static function addXmlId(Entity\Event $event) {

		$id = $event->getParameter('id');
		$fields = $event->getParameter('fields');
		$name = trim($fields['UF_NAME']);
		
		if(key_exists('UF_XML_ID', $fields)) {

			if(is_array($id)) {
				$id = $id['ID'];
			}
			
			$class = $event->getEntity()->getDataClass();
			$class::update($id, array('UF_XML_ID' => $id, 'UF_NAME' => $name));
		}
	}

	public static function checkXmlId(Entity\Event $event) {
		$id = $event->getParameter('id');
		if(is_array($id)) {
			$id = $id['ID'];
		}
		
		$fields = $event->getParameter('fields');
		
		if(key_exists('UF_XML_ID', $fields)) {
		
			$name = trim($fields['UF_NAME']);
			
			$result = new Entity\EventResult;
			$result->modifyFields(array('UF_NAME' => $name));
			
			if ($fields['UF_XML_ID'] != $id)
			{
				//$result = new Entity\EventResult;
				$result->addError(new Entity\FieldError(
					$event->getEntity()->getField('UF_XML_ID'),
					'XML_ID должен быть равен ID записи'
				));
			}
			
			return $result;
		}
	}
	
}


?>