<?use Bitrix\Main\Page\Asset;?>
<!doctype html>
<html style="width: 400px;">
	<head>
		
		<title><?$APPLICATION->ShowTitle();?></title>
		<meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="google-site-verification" content="orTfP-fmP9E8CUpe0vMzVJtOuwuSbnWjaS4ztDRH8YY" />
	
		<?$APPLICATION->ShowHead();?>
		<!-- Google Fonts -->
		<link href="http://fonts.googleapis.com/css?family=Roboto:100,300,300italic,400,400italic,500,700,700italic,900" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Noto+Serif:400,400italic,700,700italic" rel="stylesheet" type="text/css">
		<link href="http://fonts.googleapis.com/css?family=Raleway:900" rel="stylesheet" type="text/css">

		<!-- Icon Font -->
		<?Asset::getInstance()->addCss('/plugins/font-awesome/css/font-awesome.min.css');?>

		<!-- Bootstrap CSS -->
		<?Asset::getInstance()->addCss('/plugins/bootstrap/css/bootstrap.min.css');?>

		<!-- Theme CSS -->
		<?Asset::getInstance()->addCss('/css/style.css');?>
		<?Asset::getInstance()->addCss('/css/fancybox/jquery.fancybox.css');?>
		<?Asset::getInstance()->addCss('/css/dev.css');?>
		
		<?Asset::getInstance()->addJs('/js/jquery-1.11.2.min.js');?>
	</head>
	<body class="iframe-body">