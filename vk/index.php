<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
if(!$GLOBALS['USER']->isAdmin()) {
	die('not permission');
}

//$accessToken = 'ace37adfcbe1e3198e9f7ab28947137f1fadef32481c473d9bac85d6131cc4bff8ab9eec83c6427116de7';
$vkAPI = new \BW\Vkontakte(array(
	//'access_token' => $accessToken
	//'client_id' => 5559024,
	'client_id' => 5633431,
	//'client_secret' => '8HBAWmfbP9NCnwzmyNnt',
	'client_secret' => '41pl9p4Do6WJjIXB2gSt',
	'redirect_uri' => ft\CHelper::getDomain() . '/vk/',
	'scope' => array('wall'),
));



$result = $vkAPI->authenticate();
p($result);/*
$result = $result->api('wall.post', array(
	'friends_only' => 0,
	'from_group' => 1,
	'mark_as_ads' => 0,
	'message' => 'hello!',
	'owner_id' => -125564371,
));
v($result);*/


?>