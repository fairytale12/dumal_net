<?
$aMenuLinks = Array(
	Array(
		"Магазин программ", 
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
);
?>