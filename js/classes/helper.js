var ftHelper = function() {};

ftHelper.isAjaxBusy = false;
ftHelper.pingerTimeout;

ftHelper.showPreloader = function() {
	if(!$('#site-preloader').length) {
		return false;
	}
	
	$('#site-preloader').show();
	return true;
}

ftHelper.hidePreloader = function() {
	if(!$('#site-preloader').length) {
		return false;
	}
	
	$('#site-preloader').hide();
	return true;
}

ftHelper.showButtonPreloader = function(_this) {
	$(_this).addClass('button-loading');
	return false;
}

ftHelper.hideButtonPreloader = function(_this) {
	$(_this).removeClass('button-loading').blur();
	return false;
}

ftHelper.destroy = function() {
	
	// iCheck
	$('input[type="checkbox"]').iCheck('destroy');
	$('.done-task-block input[type="checkbox"]').unbind('ifChecked');
}

ftHelper.init = function() {
	
	// iCheck
	$('input[type="checkbox"]').iCheck({
		checkboxClass: 'icheckbox_minimal',
		radioClass: 'iradio_minimal',
		increaseArea: '20%' // optional
	});
	
	$('.done-task-block input[type="checkbox"]').unbind('ifChecked').bind('ifChecked', function(event){
		// Задание выполнено
		ftUserLesson.lessonComplete(this);
	});
	
	if($('#vk-comments').length) {
		VK.Widgets.Comments('vk-comments', {limit: 10, attach: false, autoPublish: 0}, $('#vk-comments').data('id'));
	}
	
}

ftHelper.showModal = function(id, closeBtn) {
	
	if(closeBtn == undefined) {
		closeBtn = true;
	}
	
	var settings = {
		closeBtn: closeBtn,
		padding: 10,
		helpers : {
			overlay : {
				css : {
					'overflow': 'hidden' 
				},
				closeClick: closeBtn,
				locked: false
			}
		},
		keys: {
			close: []
		}
	}
	
	$.fancybox(id, settings);
	
	return false;
}

ftHelper.showIframe = function(href, closeBtn) {
	
	if(closeBtn == undefined) {
		closeBtn = true;
	}
	
	var settings = {
		closeBtn: closeBtn,
		href: href,
		type: 'iframe',
		//width: 400,
		maxWidth: 280,
		fitToView: false,
		padding: 0,
		scrolling: 'no',
		iframe: {
			scrolling: 'no'
		},
		helpers : {
			overlay : {
				css : {
					'overflow': 'hidden' 
				},
				closeClick: closeBtn,
				locked: false
			}
		},
		keys: {
			close: []
		}
	}
	
	$.fancybox(settings);
	
	
	/*
	$.magnificPopup.open({
		items: {
			src: href
		},
		type: 'iframe',
		modal: !closeBtn,
		preloader: true

		// You may add options here, they're exactly the same as for $.fn.magnificPopup call
		// Note that some settings that rely on click event (like disableOn or midClick) will not work here
	}, 0);
	*/
	return false;
}


ftHelper.closeModal = function() {
	$.fancybox.close();
	// var magnificPopup = $.magnificPopup.instance;
	// magnificPopup.close();
	return false;
}


ftHelper.showLoginForm = function(closeBtn, params) {
	
	var url = '/iframe/login.php';
	
	if(params != undefined && typeof(params) == 'object') {
		url = url + '?' + $.param(params);
	}
	
	return ftHelper.showIframe(url, closeBtn);
}

ftHelper.showRegistrationForm = function(closeBtn, params) {
	
	var url = '/iframe/registration.php';
	
	if(params != undefined && typeof(params) == 'object') {
		url = url + '?' + $.param(params);
	}
	
	return ftHelper.showIframe(url, closeBtn);
}

ftHelper.showForgotForm = function(closeBtn, params) {
	
	var url = '/iframe/forgot.php';
	
	if(params != undefined && typeof(params) == 'object') {
		url = url + '?' + $.param(params);
	}
	
	return ftHelper.showIframe(url, closeBtn);
}

ftHelper.showForm = function(url, closeBtn, params) {
	
	if(url == undefined || url == '') {
		return false;
	}
	
	if(params != undefined && typeof(params) == 'object') {
		url = url + '?' + $.param(params);
	}
	
	return ftHelper.showIframe(url, closeBtn);
}


ftHelper.ajaxPager = function(_this) {
	
	if(ftHelper.isAjaxBusy) {
		return false;
	}
	
	ftHelper.isAjaxBusy = true;
	
	var currentLoadButtonBlock = $(_this).closest('.load-more');
	var link = $(_this).data('link');
	
	$(_this).addClass('loading');
	
	$.ajax({
		url: link,
		type: 'GET',
		data: {
			ftAjaxPager: 'Y'
		},
		dataType: 'html',
		success: function (data) {
			
			
			var content = $(data).filter('#ajax-pager-list');
			var loadButton = $(data).filter('.load-more');
			
			if($('#ajax-pager-list').length && content.length) {
				$('#ajax-pager-list').append(content.html());
			}
			
			if(loadButton.length) {
				currentLoadButtonBlock.html(loadButton.html());
			} else {
				currentLoadButtonBlock.remove();
			}
			

		},
		complete: function(xhr, textStatus) {
			
			ftHelper.isAjaxBusy = false;
			if(xhr.status == 200) {
				
			}
			
		}
		
	});
	
	return false;
	
}

ftHelper.addNotify = function(text, type, duration) {
	
	
	if(type == undefined) {
		type = 'warning';
	}
	
	if(duration == undefined) {
		duration = 4000;
	}
	
	if($('#notifies-block').length) {
		
		/*
		types:
			alert-warning
			alert-danger
			alert-success
		*/
		
		var block = '<div class="alert alert-' + type + '">' +
					'<button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>' + text + '</div>';

		//$('#notifies-block').prepend(block);
		$('#notifies-block').append(block);
		
		//var thisBlock = $('#notifies-block .alert:first');
		var thisBlock = $('#notifies-block .alert:last');
		
		setTimeout(
			function() {
				thisBlock.fadeOut(
					500, 
					function() {
						$(this).remove();
					}
				);
			}, 
			duration
		);
	}
}

ftHelper.pinger = function() {
	console.log('pinger');
	clearTimeout(ftHelper.pingerTimeout);
	ftHelper.pingerTimeout = setTimeout(
		function() {
			$.post('/ajax/pinger.php', function(data) {
				console.log('ajax pinger');
			});
			ftHelper.pinger();
		},
		840000 // every 14 minutes
	);
}

$(document).pjax('a[data-pjax]', '#pjax-container', {
	scrollTo: false,
	timeout: 0
})

$(document).bind('pjax:click', function(options) {
	
	if(ftHelper.isAjaxBusy) {
		return false;
	}
	
	ftHelper.isAjaxBusy = true;
	
	//console.log(options.target);
	//console.log('click');
	$('.mega-menu li').removeClass('active');
	/*
	if($(options.target).closest('.mega-menu')) {
		$(options.target).parents('li').addClass('active');
	}
	*/
	
	if($(options.target).data('pjax')) {
		$('.mega-menu').find('a[data-pjax="' + $(options.target).data('pjax') + '"]').parents('li').addClass('active');
	}
	
	//console.log($(options.target));
	
	if($(options.target).closest('#mobile-nav')) {
		$('#mobile-nav').data('mmenu').close();
	}
});

$('#pjax-container').bind('pjax:start', function(xhr, options) {
	//ftHelper.showPreloader();
	Pace.start();
	ftHelper.pinger();
	$('html, body').animate({scrollTop : 0}, 500, 'linear');
});

$('#pjax-container').bind('pjax:beforeReplace', function(contents, options) {
	console.log('ftHelper.destroy');
	ftHelper.destroy();
});


$('#pjax-container').bind('pjax:complete', function(xhr, textStatus, options) {
	
	console.log('ftHelper.init');
	ftHelper.init();
	
	// update yandex share buttons
	/*
	var shareBlocks = $('div[id^="ya-share-"]');
	shareBlocks.each(function() {
		Ya.share2($(this).attr('id'));
	});
	*/
});

$('#pjax-container').bind('pjax:end', function(xhr, options) {
	//ftHelper.hidePreloader();
	
	ftHelper.isAjaxBusy = false;
});