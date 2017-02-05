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
	"ft:user.program.lessons",
	"",
	Array(
		'CACHE_TIME' => '3600000',
		'CACHE_TYPE' => 'N',
		'PROGRAM_CODE' => $arResult['VARIABLES']['ELEMENT_CODE'],
		'USER_ID' => $GLOBALS['USER']->getId(),
		'PJAX_LINK' => $arParams['PJAX_LINK']
	),
	$component
);?>