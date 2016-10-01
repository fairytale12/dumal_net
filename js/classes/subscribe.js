var ftUserSubscribe = function() {};

ftUserSubscribe.isAjaxBusy = false;

ftUserSubscribe.subscribe = function(_this) {
	if(ftUserSubscribe.isAjaxBusy) {
		return false;
	}
	
	ftUserSubscribe.isAjaxBusy = true;
	
	var thisForm = $(_this).closest('form');
	
	
	var ajaxRequestData = {
		url: '/ajax/subscribe.php',
		type: 'POST',
		data: thisForm.serializeArray(),
		dataType: 'json',
		success: function (data) {
			
			if(data != undefined) {
				
				ftHelper.addNotify(data.TEXT, (data.RESULT == 'SUCCESS' ? 'success' : 'danger'));
				
			}
		},
		complete: function(xhr, textStatus) {
			
			ftUserSubscribe.isAjaxBusy = false;
			if(xhr.status == 200) {
				
			}
			
		}
	}
	
	$.ajax(ajaxRequestData);
	
	return false;
	
}