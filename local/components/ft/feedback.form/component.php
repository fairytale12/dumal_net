<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arParams['LINK'] = htmlspecialchars($arParams['LINK']);
$arParams['USER_ID'] = intval($GLOBALS['USER']->getId());

$arResult = array();

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['send_feedback']) {
	$arPost = ft\CHelper::prepareFields($_POST);
	
	$arResult['POST'] = $arPost;
	
	if(empty($arPost['UF_EMAIL'])) {
		$arResult['ERRORS']['UF_EMAIL'] = 'Введите email';
	} elseif(!check_email($arPost['UF_EMAIL'])) {
		$arResult['ERRORS']['UF_EMAIL'] = 'Неправильный email';
	}
	
	if(empty($arPost['UF_COMMENT'])) {
		$arResult['ERRORS']['UF_COMMENT'] = 'Введите сообщение';
	}
	
	if(empty($arPost['FORM_CHECK_INPUT'])) {
		$arResult['ERRORS']['FORM_CHECK_INPUT'] = 'Вы робот?';
	}
	
	if(empty($arResult['ERRORS'])) {
		$modelObj = ft\model\CFeedbackModel::getInstance();
		$modelObj->add(array(
			'UF_DATE' => \ConvertTimeStamp(time(), 'FULL', 's1'),
			'UF_USER_ID' => $arParams['USER_ID'],
			'UF_LINK' => $arParams['LINK'],
			'UF_NAME' => $arPost['UF_NAME'],
			'UF_EMAIL' => $arPost['UF_EMAIL'],
			'UF_COMMENT' => $arPost['UF_COMMENT'],
		));
		
		LocalRedirect($GLOBALS['APPLICATION']->getCurPage() . '?close=y');
	}
}

$this->IncludeComponentTemplate(); 

?>
