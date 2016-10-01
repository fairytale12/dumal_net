<?
use Bitrix\Main\Application;
use Bitrix\Main\Loader;

function p($data) {
	echo '<pre>';
	print_r($data);
	echo '</pre>';
}

function v($data) {
	echo '<pre>';
	var_dump($data);
	echo '</pre>';
}

Loader::includeModule('socialservices');
Loader::includeModule('itconstruct.uncachedarea');
define('FAIRYTALE_TPIC_NO_INIT', 'Y');
Loader::includeModule('fairytale.tpic');

// константы
require_once(Application::getDocumentRoot() . '/local/php_interface/include/define.php');

//phpQuery
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/phpQuery-onefile.php');

// классы сайта
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/pjax.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/youtube.php');
//require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/vkontakte.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/order.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/socialservices/authmanager.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/socialservices/facebook.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/socialservices/vkontakte.php');

require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/main.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/registration.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/validation.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/authorization.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/subscribe.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/programs.php');

require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/helper.php');

// models
$modelsDir = Application::getDocumentRoot() . '/local/php_interface/include/classes/models/';
require_once($modelsDir . 'base.php');
$dir = opendir($modelsDir);
while($fileName = readdir($dir)) {
	
	if($fileName == '.' || $fileName == '..' || $fileName == 'base.php')  {
		continue;
	}

	$fileName = $modelsDir . '/' . $fileName;
	require_once($fileName);
}
closedir($dir);

// свойства
require_once(Application::getDocumentRoot() . '/local/php_interface/include/properties/iblock_element.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/properties/ibprop_elemlistdescr.php');

// события
require_once(Application::getDocumentRoot() . '/local/php_interface/include/module_events/main.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/module_events/iblock.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/module_events/subscribe.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/module_events/highloadblock.php');
?>