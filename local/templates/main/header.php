<?use Bitrix\Main\Page\Asset;?>
<!doctype html>
<html>
	<head>
	
		<title><?$APPLICATION->ShowTitle();?></title>
		<meta class="viewport" name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="google-site-verification" content="orTfP-fmP9E8CUpe0vMzVJtOuwuSbnWjaS4ztDRH8YY" />
		
		<!--<script src="https://apis.google.com/js/platform.js"></script>-->
		<?/*<script src="//plus.google.com/hangouts/_/api/v1/hangout.js"></script>*/?>
		
		<!--<meta http-equiv="X-UA-Compatible" content="IE=edge">-->
		
		<script type="text/javascript">
			paceOptions = {
				ajax: true,
				document: true,
				eventLag: true,
				startOnPageLoad: true,
				restartOnPushState: false,
				restartOnRequestAfter: true
			};
		</script>
		
		<?$APPLICATION->ShowHead();?>
		<!-- Favicon -->
		<?/*
		<link rel="shortcut icon" href="img/favicon/favicon.ico" type="image/x-icon" />
		<link rel="apple-touch-icon" sizes="57x57" href="img/favicon/apple-touch-icon-57x57.png">
		<link rel="apple-touch-icon" sizes="60x60" href="img/favicon/apple-touch-icon-60x60.png">
		<link rel="apple-touch-icon" sizes="72x72" href="img/favicon/apple-touch-icon-72x72.png">
		<link rel="apple-touch-icon" sizes="76x76" href="img/favicon/apple-touch-icon-76x76.png">
		<link rel="apple-touch-icon" sizes="114x114" href="img/favicon/apple-touch-icon-114x114.png">
		<link rel="apple-touch-icon" sizes="120x120" href="img/favicon/apple-touch-icon-120x120.png">
		<link rel="apple-touch-icon" sizes="144x144" href="img/favicon/apple-touch-icon-144x144.png">
		<link rel="apple-touch-icon" sizes="152x152" href="img/favicon/apple-touch-icon-152x152.png">
		<link rel="apple-touch-icon" sizes="180x180" href="img/favicon/apple-touch-icon-180x180.png">
		<link rel="icon" type="image/png" href="img/favicon/favicon-16x16.png" sizes="16x16">
		<link rel="icon" type="image/png" href="img/favicon/favicon-32x32.png" sizes="32x32">
		<link rel="icon" type="image/png" href="img/favicon/favicon-96x96.png" sizes="96x96">
		<link rel="icon" type="image/png" href="img/favicon/android-chrome-192x192.png" sizes="192x192">
		*/?>
		
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
		<?Asset::getInstance()->addCss('/css/icheck/minimal/minimal.css');?>
		<?Asset::getInstance()->addCss('/css/pace.css');?>
		<?Asset::getInstance()->addCss('/css/dev.css');?>
		
		<?Asset::getInstance()->addJs('/js/jquery-1.11.2.min.js');?>
		<?Asset::getInstance()->addJs('/js/modernizr.min.js');?>
		<?Asset::getInstance()->addJs('/plugins/bootstrap/js/bootstrap.js');?>
		<?Asset::getInstance()->addJs('/js/jquery.pjax.js');?>
		<?Asset::getInstance()->addJs('/js/jquery.fancybox.pack.js');?>
		<?Asset::getInstance()->addJs('/js/icheck.min.js');?>
		<?Asset::getInstance()->addJs('/js/plugins.js');?>
		<?Asset::getInstance()->addJs('/js/pace.min.js');?>
		<?Asset::getInstance()->addJs('/js/script.js');?>
		
		<?Asset::getInstance()->addJs('/js/classes/helper.js');?>
		<?Asset::getInstance()->addJs('/js/classes/share.js');?>
		<?Asset::getInstance()->addJs('/js/classes/subscribe.js');?>
		<?Asset::getInstance()->addJs('/js/classes/user_lesson.js');?>
		
		<script type="text/javascript" src="//vk.com/js/api/openapi.js?128"></script>
		
		<script type="text/javascript">
			VK.init({apiId: <?=VK_APPLICATION_ID?>, onlyWidgets: true});
		</script>
		
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>
		<?$APPLICATION->ShowPanel();?>
		<div id="site-preloader"></div>
		<div id="main" class="header-style1">
  
			<header class="header-wrapper clearfix">

				<div class="header" id="header">
					<div class="container">
						<div class="mag-content">
							<div class="row">
								<div class="col-md-12">
									<!-- Mobile Menu Button -->
									<a class="navbar-toggle collapsed" id="nav-button" href="#mobile-nav">
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
										<span class="icon-bar"></span>
									</a><!-- .navbar-toggle -->

									<!-- Main Nav Wrapper -->
									<nav class="navbar mega-menu">
										<a class="logo" href="/" title="Думал, нет?" rel="home" data-pjax="<?=ft\CHelper::getLinkId('/')?>">
											Думал, <span>Нет?</span>
										</a><!-- .logo -->
										
										<?$APPLICATION->IncludeComponent(
											"bitrix:menu",
											"top",
											Array(
												"ALLOW_MULTI_SELECT" => "Y",
												"CHILD_MENU_TYPE" => "left",
												"DELAY" => "N",
												"MAX_LEVEL" => "2",
												"MENU_CACHE_GET_VARS" => array(""),
												"MENU_CACHE_TIME" => "3600",
												"MENU_CACHE_TYPE" => "N",
												"MENU_CACHE_USE_GROUPS" => "Y",
												"ROOT_MENU_TYPE" => "top",
												"USE_EXT" => "Y"
											)
										);?>
										
										<div class="header-right">
											<div class="header-phone-block">
												<span class="glyphicon glyphicon-phone"></span>
												<?$APPLICATION->IncludeComponent(
													"bitrix:main.include",
													"",
													Array(
														"AREA_FILE_RECURSIVE" => "Y",
														"AREA_FILE_SHOW" => "file",
														"AREA_FILE_SUFFIX" => "sidebar",
														"EDIT_TEMPLATE" => "",
														"PATH" => "/include/header_phone.php"
													)
												);?>
											</div>
											<div class="social-icons">
												
												<?if(!$GLOBALS['USER']->isAuthorized()):?>
												
													<a href="javascript:void(0);" onclick="return ftHelper.showLoginForm();">Войти</a>
													<a href="javascript:void(0);" onclick="return ftHelper.showRegistrationForm();">Регистрация</a>
													
												<?endif;?>
												<?/*
												<a href="#" data-toggle="tooltip" data-placement="bottom" title="ВКонтакте"><i class="fa fa-vk fa-lg"></i></a>
												<a href="#" data-toggle="tooltip" data-placement="bottom" title="Facebook"><i class="fa fa-facebook fa-lg"></i></a>
												<!--
												<a href="#" data-toggle="tooltip" data-placement="bottom" title="Twitter"><i class="fa fa-twitter fa-lg"></i></a>
												<a href="#" data-toggle="tooltip" data-placement="bottom" title="Google+"><i class="fa fa-google-plus fa-lg"></i></a>
												-->
												*/?>
												
												<!-- Only for Fixed Sidebar Layout -->
												<a href="#" class="fixed-button navbar-toggle" id="fixed-button">
													<i></i>
													<i></i>
													<i></i>
													<i></i>
												</a><!-- .fixed-button -->
											</div><!-- .social-icons -->
											
										</div><!-- .header-right -->

									</nav><!-- .navbar -->
									<?/*
									<div id="sb-search" class="sb-search">
										<form>
											<input class="sb-search-input" placeholder="Enter your search text..." type="text" value="" name="search" id="search">
											<input class="sb-search-submit" type="submit" value="">
											<span class="sb-icon-search fa fa-search" data-toggle="tooltip" data-placement="bottom" title="Search"></span>
										</form>
									</div><!-- .sb-search -->
									*/?>
								</div>
							</div>
						</div><!-- .mag-content -->
					</div><!-- .container -->
				</div><!-- .header -->
    
			</header><!-- .header-wrapper -->
			<!-- Begin Main Wrapper -->
			<div class="container main-wrapper">
				<?/*
				<!-- End Main Banner -->
				<div class="mag-content clearfix">
					<div class="row">
						<div class="col-md-12">
							<div class="ad728-wrapper">
								<a href="#">
									<img src="http://placehold.it/728x90" alt=""/>
								</a>
							</div>
						</div>
					</div>
				</div>
				<!-- End Main Banner -->
				*/?>
				<div id="pjax-container" class="main-content mag-content clearfix">