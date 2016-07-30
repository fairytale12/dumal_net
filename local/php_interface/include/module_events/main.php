<?
namespace ft;

use Bitrix\Main\Application;

$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandlerCompatible('main', 'OnEndBufferContent', array('ft\CMain', 'endBufferContent'));

class CMain {
	
	public static function endBufferContent(&$buffer) {
        $app = Application::getInstance();
        $pjax = new pjax($app);

        if ($pjax->isPjaxRequest() && ($content = $pjax->getResponseContent($buffer)) !== false) {
            // Updating address bar with the last URL in case there were redirects
            $pjax->setHeaderPjaxUrl();
            // Set new content with pjax container
            $buffer = $content;
        }

        return $buffer;
    }
	
}
?>