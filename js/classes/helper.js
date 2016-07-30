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