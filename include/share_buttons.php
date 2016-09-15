<?/*<div id="ya-share-<?=$arParams['ID']?>" class="ya-share2" data-services="vkontakte,facebook" data-counter=""></div>*/?>
<?
//p($arParams);
//p($_SERVER);
?>

<?
if(!empty($arParams['URL'])) {
	$arParams['URL'] = 'http://' . $_SERVER['HTTP_HOST'] . $arParams['URL'];
}
if(!empty($arParams['IMG_PATH'])) {
	$arParams['IMG_PATH'] = 'http://' . $_SERVER['HTTP_HOST'] . $arParams['IMG_PATH'];
}

$arParams['DESC'] = explode("\n", $arParams['DESC']);

if (!is_array($arParams['DESC'])) {
	$arParams['DESC'] = array($arParams['DESC']);
}

foreach ($arParams['DESC'] as $i => $line) {
	$line = str_replace(array("\r", "\n", "'"), array("", "", "\\'"), $line);
	$line = preg_replace("/\t{1,}/", "", $line);
	$line = preg_replace("/\s{1,}/", " ", $line);
	$line = trim($line);
	if (strlen($line)) {
		$arParams['DESC'][$i] = $line;
	} else {
		unset($arParams['DESC'][$i]);
	}
}
$arParams['DESC'] = implode("\\\n", $arParams['DESC']);

?>

<a href="javascript:void(0);" onclick="return ftShare.vkontakte('<?=$arParams['URL']?>','<?=$arParams['TITLE']?>','<?=$arParams['IMG_PATH']?>','<?=$arParams['DESC']?>');" title="Поделиться ссылкой"><i class="fa fa-vk fa-lg"></i></a>
<a href="javascript:void(0);" onclick="return ftShare.facebook('<?=$arParams['URL']?>','<?=$arParams['TITLE']?>','<?=$arParams['IMG_PATH']?>','<?=$arParams['DESC']?>');" title="Поделиться ссылкой"><i class="fa fa-facebook fa-lg"></i></a>