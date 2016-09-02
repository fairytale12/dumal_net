<?
use Bitrix\Main\UserTable;
$arAuthorIds = array();
foreach($arResult["ITEMS"] as $arItem) {
	if($arItem['PROPERTIES']['AUTHOR_ID']['VALUE']) {
		$arAuthorIds[] = $arItem['PROPERTIES']['AUTHOR_ID']['VALUE'];
	}
}

if(!empty($arAuthorIds)) {
	$arAuthorIds = array_unique($arAuthorIds);
	$rsAuthor = UserTable::getList(array('select' => array('ID', 'LAST_NAME', 'NAME', 'SECOND_NAME'), 'filter' => array('=ID' => $arAuthorIds)));
	while($arAuthor = $rsAuthor->fetch()) {
		$arResult['AUTHORS'][$arAuthor['ID']] = array(
			'NAME' => ft\CHelper::getFio($arAuthor),
		);
	}
}
?>