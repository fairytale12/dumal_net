<?
namespace ft;

use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

$eventManager = EventManager::getInstance();
$eventManager->addEventHandlerCompatible('subscribe', 'BeforePostingSendMail', array('ft\CSubscribeHandlers', 'beforePostingSendMailHandler'));

class CSubscribeHandlers {
    
	function beforePostingSendMailHandler($arFields) {
		
		$unsubscribeLink = '';
		
		if($arSub = \CSubscription::GetByEmail($arFields['EMAIL'])->fetch()) {
			$arRubricIds = array();
			
			if(!empty($arFields['EMAIL_EX']['POSTING_ID'])) {
				
				$arFilter = array(
					'ID' => $arFields['EMAIL_EX']['POSTING_ID'],
				);
				$cPosting = new \CPosting;
				$rsRubric = $cPosting->GetRubricList($arFields['EMAIL_EX']['POSTING_ID']);
				while($arRubric = $rsRubric->fetch()) {
					$arRubricIds[] = $arRubric['ID'];
				}
				
			}
			
			$unsubscribeLink = '<a href="' . CHelper::getDomain() . '/subscribe.php?id=' . $arSub['ID'] . '&hash=' . CSubscribe::getMailHash($arFields['EMAIL']) . '&action=unsubscribe&rubric=' . implode(',', $arRubricIds) . '">отписаться от рассылки</a>';
		}
		
		$arFields['BODY'] = str_replace('#UNSUBSCRIBE_LINK#', $unsubscribeLink, $arFields['BODY']);
		
		// EMAIL_EX SUBSCRIPTION_ID
		// EMAIL_EX POSTING_ID
		
		return $arFields;
    }

   
}
?>