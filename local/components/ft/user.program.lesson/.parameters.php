<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED!==true) die();

if(!CModule::IncludeModule('iblock'))
    return;

$arComponentParameters = array(
    'GROUPS' => array(
    ),
    'PARAMETERS' => array(
        
		'PROGRAM_CODE' => array(
            'PARENT' => 'BASE',
            'NAME' => 'Символьный код программы',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
		'LESSON_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'ID урока',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
		'USER_ID' => array(
            'PARENT' => 'BASE',
            'NAME' => 'ID пользователя',
            'TYPE' => 'STRING',
            'DEFAULT' => '',
        ),
       
        'CACHE_TIME' => Array('DEFAULT'=>3600),
    ),
);
?>
