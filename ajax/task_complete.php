<?
require_once($_SERVER['DOCUMENT_ROOT'] . '/bitrix/modules/main/include/prolog_before.php');
if($_SERVER['REQUEST_METHOD'] == 'POST' && $_POST['taskId']) {
	
	$arPost = ft\CHelper::prepareFields($_POST);
	
	$completedTaskId = ft\CUserPrograms::completeTask($arPost['programId'], $arPost['lessonId'], $arPost['taskId']);
	$arReturn = ft\CHelper::returnAnswer(
		($completedTaskId ? 1 : -1),
		($completedTaskId ? 'Задание выполнено!' : 'Не удалось выполнить задание.'),
		array(
			'PROGRESS' => ft\CUserPrograms::getLessonProgress($arPost['programId'], $arPost['lessonId'])
		)
	);
	ft\CHelper::returnJsonAnswer($arReturn);
	
}
die();
?>