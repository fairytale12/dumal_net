<?
$aMenuLinks = Array(
	Array(
		"Программы", 
		"/programs/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Статьи", 
		"/articles/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Видео", 
		"/video/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"О нас", 
		"/about/", 
		Array(), 
		Array(), 
		"" 
	),
	Array(
		"Личный кабинет", 
		"/account/", 
		Array(), 
		Array(
			'CLASS' => 'user-menu-account'
		), 
		'$GLOBALS[\'USER\']->isAuthorized()'
	),
	Array(
		"Войти", 
		"javascript:void(0);", 
		Array(), 
		Array(
			'ONCLICK' => '$(\'#mobile-nav\').data(\'mmenu\').close(); return ftHelper.showLoginForm();',
			'IS_MOBILE' => true,
			'NOT_PJAX' => true
		), 
		'!$GLOBALS[\'USER\']->isAuthorized()'
	),
);
?>