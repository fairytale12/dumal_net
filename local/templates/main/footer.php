				</div><!-- .main-content -->
			</div><!-- .main-wrapper -->

			<!-- Footer -->
			<footer class="footer source-org vcard copyright clearfix" id="footer" role="contentinfo">
				
				<div class="footer-bottom clearfix">
					<div class="fixed-main">
						<div class="container">
							<div class="mag-content">
								<div class="row">
									<div class="col-md-6">
										<p>Dumal.net © <?=date('Y')?>. Все права защищены.</p>
									</div>

									<div class="col-md-6">
										<div class="social-icons pull-right">
											<a href="#"><i class="fa fa-facebook"></i></a>
											<a href="#"><i class="fa fa-twitter"></i></a>
											<a href="#"><i class="fa fa-rss"></i></a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</footer>
			<!-- End Footer -->

		</div><!-- End Main -->
		
		
		<?$APPLICATION->IncludeComponent(
			"bitrix:menu",
			"top_mobile",
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
				"USE_EXT" => "Y",
				'IS_MOBILE' => 'Y'
			)
		);?>
		
		<div id="go-top-button" class="fa fa-angle-up" title="Scroll To Top"></div>
		<div class="mobile-overlay" id="mobile-overlay"></div>
		<?/*
		<!-- Jquery js -->
		<script src="js/jquery-1.11.2.min.js"></script>

		<!-- Modernizr -->
		<script src="js/modernizr.min.js"></script>

		<!-- Bootstrap js -->
		<script src="plugins/bootstrap/js/bootstrap.js"></script>

		<!-- Google map api -->
		<script src="https://maps.googleapis.com/maps/api/js?v=3.exp"></script>

		<!-- Plugins js -->
		<script src="js/plugins.js"></script>

		<!-- Theme js -->
		<script src="js/script.js"></script>
		*/?>
		
		<div id="notifies-block"></div>
		
		<script src="//yastatic.net/es5-shims/0.0.2/es5-shims.min.js"></script>
		<script src="//yastatic.net/share2/share.js"></script>
		
		<div style="display: none;">
			<div id="login-user-not-found">
				<p>Пользователь с таким профилем не найден на сайте. Перейти к регистрации?</p>
				<a href="javascript:void(0);" onclick="return ftHelper.showRegistration();">Да</a> / 
				<a href="javascript: void(0);" onclick="return ftHelper.showLoginForm();">Отмена</a>
			</div>
			
			<div id="registration-user-confirm">
				На вашу почту отправлено письмо, пожалуйста, подтвердите свой e-mail.
			</div>
			
			<div id="social-registartion-user-exist">
				<p>На сайте уже зарегистрирован пользователь с таким email. Перейти к авторизации?</p>
				<a class="agree-link" href="javascript:void(0);" onclick="return ftHelper.showLoginForm(true, '#EMAIL#')">Да</a> / 
				<a href="javascript:void(0);" onclick="return ftHelper.showRegistration(false, 3);">Нет</a>
			</div>
			
			<div id="forgot-password-user-send">
				На вашу почту отправлено письмо, пожалуйста, следуйте приведенным в нем инструкциям.
			</div>
			
		</div>
		
		<?$APPLICATION->IncludeComponent(
			"bitrix:main.include",
			"",
			Array(
				"AREA_FILE_SHOW" => "file",
				"PATH" => "/include/counters.php",
				"EDIT_TEMPLATE" => ""
			)
		);?>

	</body>
</html>