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
	
	return false;
}

ftHelper.closeModal = function() {
	$.fancybox.close();
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

/** @TODO удалить */
$(function() {
	$('#pjax-container').append('!');
})





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
});