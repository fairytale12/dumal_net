<?
namespace ft;

use Bitrix\Main\Application;
use Bitrix\Main\EventManager;
use Bitrix\Main\Loader;

$eventManager = EventManager::getInstance();

//$eventManager->addEventHandlerCompatible('main', 'OnAdminContextMenuShow', array('ft\CIBlockHandlers', 'exportToVKbutton'));



class CIBlockHandlers {
	/*
	function exportToVKbutton(&$items) {		
		if($GLOBALS['APPLICATION']->GetCurPage(true) == '/bitrix/admin/iblock_element_edit.php') {
			\CJSCore::init(array('jquery'));
			
				$vkAPI = new \BW\Vkontakte(array(
					//'access_token' => $accessToken
					//'client_id' => 5559024,
					'client_id' => 5633431,
					//'client_secret' => '8HBAWmfbP9NCnwzmyNnt',
					'client_secret' => '41pl9p4Do6WJjIXB2gSt',
					'redirect_uri' => CHelper::getDomain() . '/vk/',
					'scope' => array('wall'),
				));
			
			?>
				<script src="//vk.com/js/api/openapi.js" type="text/javascript"></script>
				<script type="text/javascript">
					VK.init({
						apiId: 5559024
					});
				</script>
				<script type="text/javascript">
					
					var sendToVK = function() { 
						// https://api.vk.com/method/wall.post?owner_id=<id группы>&message=<текст сообщения>&access_token=<ранее полученный токен>
						
						
						window.open('<?=$vkAPI->getLoginUrl()?>');
					}
					
				</script>
			<?
			
			

			$items[] = array(
				'TEXT' 		=> 'Отправить в группу VK', 
				'ICON' 		=> '', 
				'TITLE' 	=> 'Отправить в группу VK', 
				'LINK' 		=> 'javascript:void(0);',
				'ONCLICK' 	=> 'sendToVK(); console.log(\'!!!\')'
			);
		}
	}
	*/
}
?>