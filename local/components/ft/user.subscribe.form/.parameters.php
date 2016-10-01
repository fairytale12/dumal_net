<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
    'GROUPS' => array(
    ),
    'PARAMETERS' => array(
		'RUBRIC_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'ID рубрики',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
		'TEXT' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Подпись',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
    ),
);
?>
