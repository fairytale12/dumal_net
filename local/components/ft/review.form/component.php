<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arParams['PROGRAM_ID'] = intval($arParams['PROGRAM_ID']);
$arParams['USER_ID'] = intval($GLOBALS['USER']->getId());

$arResult = array();

if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['send_review']) {
	$arPost = ft\CHelper::prepareFields($_POST);
	
	$arResult['POST'] = $arPost;
	
	if(empty($arPost['UF_TEXT'])) {
		$arResult['ERRORS']['UF_TEXT'] = 'Введите отзыв';
	} elseif(strlen($arPost['UF_TEXT']) < 50) {
		$arResult['ERRORS']['UF_TEXT'] = 'Отзыв должен состоять не менее чем из 50-ти символов';
	}
	
	if(empty($arPost['FORM_CHECK_INPUT'])) {
		$arResult['ERRORS']['FORM_CHECK_INPUT'] = 'Вы робот?';
	}
	
	if(empty($arParams['USER_ID'])) {
		$arResult['ERRORS'][] = 'Вы не авторизованы';
	}
	
	if(empty($arResult['ERRORS'])) {
		$modelObj = ft\model\CReviewsModel::getInstance();
		$modelObj->add(array(
			'UF_DATE' => \ConvertTimeStamp(time(), 'FULL', 's1'),
			'UF_USER_ID' => $arParams['USER_ID'],
			'UF_PROGRAM' => $arParams['PROGRAM_ID'],
			'UF_TEXT' => $arPost['UF_TEXT'],
		));
		
		LocalRedirect($GLOBALS['APPLICATION']->getCurPage() . '?close=y');
	}
}

$this->IncludeComponentTemplate(); 

?>
