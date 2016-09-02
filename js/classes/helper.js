var ftHelper = function() {};


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
		width: 400,
		padding: 0,
		scrolling: 'auto',
		iframe: {
			scrolling: 'auto'
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


ftHelper.showLoginForm = function(closeBtn, email) {
	if(email == undefined) {
		email = '';
	} else {
		email = '?email=' + email;
	}
	
	return ftHelper.showIframe('/iframe/login.php' + email, closeBtn);
}

ftHelper.showRegistration = function(closeBtn, step) {
	if(step == undefined) {
		step = 1;
	}
	return ftHelper.showIframe('/iframe/registration.php?step=' + step, closeBtn);
}

ftHelper.ajaxPager = function(_this) {
	
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
			

		}
	});
	
	return false;
	
}



$(document).pjax('a[data-pjax]', '#pjax-container', {
	scrollTo: false
})

$(document).bind('pjax:click', function(options) {
	//console.log(options.target);
	//console.log('click');
	$('.mega-menu li').removeClass('active');
	if($(options.target).closest('.mega-menu')) {
		$(options.target).parents('li').addClass('active');
	}
});
$('#pjax-container').bind('pjax:start', function(xhr, options) {
	ftHelper.showPreloader();
});
$('#pjax-container').bind('pjax:complete', function(xhr, textStatus, options) {
	ftHelper.hidePreloader();
	
	// update yandex share buttons
	var shareBlocks = $('div[id^="ya-share-"]');
	shareBlocks.each(function() {
		Ya.share2($(this).attr('id'));
	});
	
});