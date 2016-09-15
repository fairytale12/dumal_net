<?
namespace ft\model;
use Bitrix\Highloadblock as HL;
use Bitrix\Main\Entity;

/**
 *	Класс для работы с HL блоком Задачи занятия
 *
 *	реализует паттерн Singleton
 *
 */
class CLessonTasksModel extends CBaseModel {
	
	static $instance;
	protected $entity;
	protected $hlblock;
	
	function __construct() {
		\CModule::IncludeModule('highloadblock');
		\CModule::IncludeModule('iblock');
		
		$this->hlblock = HL\HighloadBlockTable::getById('2')->fetch();
		$this->entity = HL\HighloadBlockTable::compileEntity($this->hlblock);		
		
		$this->actions = array();
	}
	
}


?>