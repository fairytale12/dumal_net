var ftUserSubscribe = function() {};

ftUserSubscribe.isAjaxBusy = false;

ftUserSubscribe.subscribe = function(_this) {
	if(ftUserSubscribe.isAjaxBusy) {
		return false;
	}
	
	ftUserSubscribe.isAjaxBusy = true;
	//ftHelper.showPreloader();
	ftHelper.showButtonPreloader(_this);
	
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
			//ftHelper.hidePreloader();
			ftHelper.hideButtonPreloader(_this);
			if(xhr.status == 200) {
				
			}
			
		}
	}
	
	$.ajax(ajaxRequestData);
	
	return false;
	
}

ftUserSubscribe.pilotProgramSubscribe = function(_this) {
	if(ftUserSubscribe.isAjaxBusy) {
		return false;
	}
	
	ftUserSubscribe.isAjaxBusy = true;
	//ftHelper.showPreloader();
	ftHelper.showButtonPreloader(_this);
	
	var thisForm = $(_this).closest('form');
	
	
	var ajaxRequestData = {
		url: '/ajax/pilot_program.php',
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
			//ftHelper.hidePreloader();
			ftHelper.hideButtonPreloader(_this);
			if(xhr.status == 200) {
				
			}
			
		}
	}
	
	$.ajax(ajaxRequestData);
	
	return false;
	
}