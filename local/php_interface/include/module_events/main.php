<?
namespace ft;

use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

$eventManager = EventManager::getInstance();

$eventManager->addEventHandlerCompatible('main', 'OnEndBufferContent', array('ft\CMainHandlers', 'endBufferContent'));
$eventManager->addEventHandlerCompatible('main', 'OnBeforeUserAdd', array('ft\CMainHandlers', 'OnBeforeUserAdd'));
$eventManager->addEventHandlerCompatible('main', 'OnBeforeUserUpdate', array('ft\CMainHandlers', 'OnBeforeUserUpdate'));

$eventManager->addEventHandlerCompatible('main', 'OnAfterUserAdd', array('ft\CMainHandlers', 'OnAfterUserAdd'));
$eventManager->addEventHandlerCompatible('main', 'OnUserDelete', array('ft\CMainHandlers', 'OnUserDelete'));


class CMainHandlers {
	
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
	
	public static function OnBeforeUserAdd(&$arFields) {
		
		if($arFields['EXTERNAL_AUTH_ID'] == 'socservices') {
			
			
			if(!empty($arFields['EMAIL'])) {
				
				$arFields['UF_SOC_EMAIL'] = $arFields['EMAIL'];				
				
			}
			
			$arFields['EMAIL'] = 'temp_' . randString(7) . '_' . time() . '@temp.ru';
			$arFields['LOGIN'] = $arFields['EMAIL'];
			$arFields['ACTIVE'] = 'N';
			$arFields['UF_NEED_CONFIRM'] = 1;
		}
		
	}
	
	public static function OnBeforeUserUpdate(&$arFields) {
		$arFields['LOGIN'] = $arFields['EMAIL'];
	}
	
	public static function OnAfterUserAdd(&$arFields) {
		CUserPrograms::add($arFields['ID']);
	}
	
	public static function OnUserDelete($userId) {
		CUserPrograms::delete($userId);
	}
	
}
?>