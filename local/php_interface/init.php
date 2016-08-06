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

//phpQuery
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/phpQuery-onefile.php');

// классы сайта
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/pjax.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/socialservices/authmanager.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/socialservices/facebook.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/socialservices/vkontakte.php');

require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/main.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/registration.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/validation.php');
require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/user/authorization.php');

require_once(Application::getDocumentRoot() . '/local/php_interface/include/classes/helper.php');

// константы
require_once(Application::getDocumentRoot() . '/local/php_interface/include/define.php');

// события
require_once(Application::getDocumentRoot() . '/local/php_interface/include/module_events/main.php');
?>