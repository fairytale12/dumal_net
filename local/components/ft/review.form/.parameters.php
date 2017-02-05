<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('iblock'))
    return;

$arComponentParameters = array(
    'GROUPS' => array(
    ),
    'PARAMETERS' => array(
		'PROGRAM_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'ID программы',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
    ),
);
?>
