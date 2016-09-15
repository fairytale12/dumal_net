<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>

<?$APPLICATION->IncludeComponent(
	"ft:user.program.lesson",
	"",
	Array(
		"CACHE_TIME" => "3600",
		"CACHE_TYPE" => "A",
		"LESSON_ID" => $arResult['VARIABLES']['LESSON_ID'],
		"PROGRAM_CODE" => $arResult['VARIABLES']['ELEMENT_CODE'],
		"USER_ID" => $GLOBALS['USER']->getId(),
	)
);?>