var ftUserLesson = function() {};

ftUserLesson.isAjaxBusy = false;

ftUserLesson.lessonComplete = function(_this) {
	if(ftUserLesson.isAjaxBusy) {
		return false;
	}
	
	ftUserLesson.isAjaxBusy = true;
	
	var thisCheckbox = $(_this);
	
	//console.log('задание выполнено!');
	
	var ajaxRequestData = {
		url: '/ajax/task_complete.php',
		type: 'POST',
		data: {
			programId: thisCheckbox.data('program'),
			lessonId: thisCheckbox.data('lesson'),
			taskId: thisCheckbox.val()
		},
		dataType: 'json',
		success: function (data) {
			
			if(data != undefined) {
				
				if(data.RESULT == 'SUCCESS') {
				
					thisCheckbox.iCheck('disable');
					thisCheckbox.closest('.panel').find('.panel-title .task-icon').removeClass('glyphicon-edit').addClass('glyphicon-check');
					thisCheckbox.closest('.done-task-block').find('label').html('<span class="success-text">Задание выполнено!</span>');
					
				}
				
				if(data.PROGRESS != undefined && $('.lesson-progress-block').length) {
				
					if($('.lesson-progress-block').is(':hidden')) {
						$('.lesson-progress-block').show();
					}
					$('.lesson-progress-block .progress-bar').css('width', data.PROGRESS + '%').attr('aria-valuenow', data.PROGRESS);
					$('.lesson-progress-block .progress-bar .sr-only').html(data.PROGRESS + '%');
					
				}
				
				ftHelper.addNotify(data.TEXT, (data.RESULT == 'SUCCESS' ? 'success' : 'danger'));
				
			}
		},
		complete: function(xhr, textStatus) {
			
			ftUserLesson.isAjaxBusy = false;
			if(xhr.status == 200) {
				
			}
			
		}
	}
	
	$.ajax(ajaxRequestData);
	
	return false;
	
}