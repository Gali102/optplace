jQuery.fn.exists = function() {
   return $(this).length;
}

$(function() {
	$('#edit_summ').on('hide', function () {
		location.reload();
	});
	$('#change_pass').on('hide', function () {
		location.reload();
	});
	$('#delete_user').on('hide', function () {
		location.reload();
	});
	$('#change_mail').on('hide', function () {
		location.reload();
	});
	$('#change_mail1').on('hide', function () {
		location.reload();
	});
	$('#archiv').on('hide', function () {
		location.reload();
	});
	$('#edit_delo').on('hide', function () {
		location.reload();
	});
	$('#edit_user').on('hide', function () {
		location.reload();
	});
	$('#edit_org').on('hide', function () {
		location.reload();
	});
	$('#edit_otchet_date').on('hide', function () {
		location.reload();
	});

	// $('#change_event').on('hide', function () {
	// 	location.reload();
	// });
});

$(function() {
	if (!$('#calendar').length && $('table tbody tr').length > 1) {
		$('table').tablesorter();
	}
	$("#client_id").chosen();
	$("#user_id").chosen();
	$("#user_id1").chosen();
	$("#delo_id").chosen();
	$("#poluchatel_id").chosen();
});

$(function() {
	$.datepicker.setDefaults(
		$.extend($.datepicker.regional["ru"])
	);
	$("#c_date").datepicker();
	$("#c_date_end").datepicker();
	$("#n_date").datepicker();
	$("#n_date_end").datepicker();

	url = window.location.href;
	$('#otchet_date, #otchet_date_end').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: '01.mm.yy',
		onClose: function(dateText, inst) { 
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			$(this).datepicker('setDate', new Date(year, month, 1));
		}
	});

	$('#otchet_date_current').datepicker({
		changeMonth: true,
		changeYear: true,
		showButtonPanel: true,
		dateFormat: '01.mm.yy',
		onClose: function(dateText, inst) { 
			var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
			var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
			$(this).datepicker('setDate', new Date(year, month, 1));
		}
	});
});

$(function() {
	$('.accept_delo').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		indx = splitted_id[2];
		ref = $('#accept_delo_'+indx).attr('ref');
		data = {"ref" : ref, "event_id" : indx };
		ajax_sender(data,'/index.php/events/accept_event','#status_message','reload');
	});
});

$(function() {
	$('.accept_event').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		indx = splitted_id[2];
		ref = $('#accept_event_'+indx).attr('ref');
		data = {"ref" : ref, "event_id" : indx };
		ajax_sender(data,'/index.php/events/accept_event','#status_message','reload');
	});
});

$(function() {
	$('#paument_reason').change(function() {
		if ($(this).val() == 3) {
			$('#n_o_paument_reason').css('display','inline-block');
		}
		else {
			$('#n_o_paument_reason').css('display','none');
		}
	});
});

$(function() {
	$('#').change(function() {
		if ($(this).val() == 3) {
			$('#n_o_paument_reason').css('display','inline-block');
		}
		else {
			$('#n_o_paument_reason').css('display','none');
		}
	});
});


$(function() {
	$('.edit_summ').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		paument_id = splitted_id[2];
		delo_name = $(this).parents('tr').children('td').eq(1).text();
		reason_name = $(this).parents('tr').children('td').eq(2).text();
		summ = $(this).parents('tr').children('td').eq(3).text();
		$('#edit_summ .modal-body p').html('По делу <strong>'+delo_name+'</strong> по основанию <strong>'+reason_name+'</strong>');
		$('#edit_summ .modal-body input').val(summ);
		$('#edit_summ .modal-footer .btn-primary').on('click',function() {
			summ_from_client = $('#edit_summ .modal-body input').val();
			data = {"paument_id" : paument_id, "summ_from_client" : summ_from_client};
			ajax_sender(data,'/index.php/pauments/edit_summ','#edit_summ_message','Платеж успешно внесен!');
		});
	});
	
	$('.archiv').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		paument_id = splitted_id[1];
		$('#archiv .modal-footer .btn-primary').on('click',function() {
			data = {"paument_id" : paument_id};
			ajax_sender(data,'/index.php/pauments/archiv','#archiv_message','Платеж внесен в архив');
		});
	});
});

$(function() {
	$('.edit_delo').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		event_id = splitted_id[2];
		delo_status = $(this).parents('tr').children('td').eq(2).text();
		comment = $(this).parents('tr').children('td').eq(3).text();
		$('#edit_delo .modal-body p').html('По статусу дела <strong>'+delo_status+'</strong>');
		$('#edit_delo .modal-body textarea').val(comment);
		$('#edit_delo .modal-footer .btn-primary').on('click',function() {
			comments = $('#edit_delo .modal-body textarea').val();
			data = {"event_id" : event_id, "comments" : comments};
			ajax_sender(data,'/index.php/delo/edit_delo','#edit_delo_message','Описание успешно изменено!');
		});
		$('#edit_delo .modal-footer .btn-danger').on('click',function() {
			data = {"event_id" : event_id};
			ajax_sender(data,'/index.php/delo/delete_event','#edit_delo_message','Событие удалено!');
		});
	});
	
	$('.edit_otchet').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		delo_id = splitted_id[2];
		delo_name = $(this).parents('tr').children('td').eq(2).text();
		otchet_date = $(this).parents('tr').children('td').eq(3).text();
		$('#edit_otchet_date .modal-body p').html('<strong>'+delo_name+'</strong>');
		$('#edit_otchet_date .modal-body input').val(otchet_date);
		$('#edit_otchet_date .modal-footer .btn-primary').on('click',function() {
			otchet_date = $('#edit_otchet_date .modal-body input').val();
			data = {"delo_id" : delo_id, "otchet_date" : otchet_date};
			ajax_sender(data,'/index.php/client_dela/update_otchet_date','#otchet_date_status','Дата успешно изменена!');
		});
	});
	
	$('.edit_user').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		event_id = splitted_id[2];
		user_name = $(this).parents('tr').children('td').eq(5).text();
		$('#edit_user .modal-body p').html('Текущий: <strong>'+user_name+'</strong>');
		$('#user_id').clone().appendTo('#edit_user .modal-body span').css('display','inline').attr('id','edit_user_val');
		$('#edit_user .modal-footer .btn-primary').on('click',function() {
			edit_user_val = $('#edit_user .modal-body select').val();
			data = {"event_id" : event_id, "user_id" : edit_user_val};
			ajax_sender(data,'/index.php/delo/edit_user','#edit_user_message','Описание успешно изменено!');
		});
	});
	
	$('.edit_org').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		delo_id = splitted_id[2];
		org_name = $(this).parents('tr').children('td').eq(5).text();
		$('#edit_org .modal-body p').html('Текущий: <strong>'+org_name+'</strong>');
		$('#org_id').clone().appendTo('#edit_org .modal-body span').css('display','inline').attr('id','edit_org_val');
		$('#edit_org .modal-footer .btn-primary').on('click',function() {
			edit_org_val = $('#edit_org .modal-body select').val();
			data = {"delo_id" : delo_id, "org_id" : edit_org_val};
			ajax_sender(data,'/index.php/delo/edit_org','#update_org','Организация успешно изменена!');
		});
	});
	
});

$(function() {
	$('.change_pass').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		user_id = splitted_id[2];
		user_name = $(this).parents('tr').children('td').eq(1).text();
		$('#change_pass .modal-body p').html('Сменить пароль для: <strong>'+user_name+'</strong>');
		$('#change_pass .modal-footer .btn-primary').on('click',function() {
			user_pass = $('#change_pass .modal-body input').val();
			data = {"user_id" : user_id, "user_pass" : user_pass};
			ajax_sender(data,'/index.php/users/change_pass','#change_pass_message','Пароль успешно изменен!');
		});
	});

	$('.delete_user').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		user_id = splitted_id[2];
		user_name = $(this).parents('tr').children('td').eq(1).text();
		$('#delete_user .modal-body p').html('Удалить: <strong>'+user_name+'</strong>');
		$('#delete_user .modal-footer .btn-primary').on('click',function() {
			//user_pass = $('#delete_user .modal-body input').val();
			data = {"user_id" : user_id};
			ajax_sender(data,'/index.php/users/delete_user','#delete_user_message','Успешно удален!');
		});
	});

	// $('.change_event').click(function() {
	// 	id = $(this).attr('id');
	// 	splitted_id = id.split('_');
	// 	user_id = splitted_id[2];
	// 	user_name = $(this).parents('tr').children('td').eq(1).text();
	// 	$('#change_event .modal-body p').html('Сменить пароль для: <strong>'+user_name+'</strong>');
	// 	$('#change_event .modal-footer .btn-primary').on('click',function() {
	// 		user_pass = $('#change_event .modal-body input').val();
	// 		data = {"user_id" : user_id, "user_pass" : user_pass};
	// 		ajax_sender(data,'/index.php/events/events','#change_event_message','Данные успешно изменены!');
	// 	});
	// });
	
	$('.archiv').click(function() {
		id = $(this).attr('id');
		splitted_id = id.split('_');
		paument_id = splitted_id[1];
		$('#archiv .modal-footer .btn-primary').on('click',function() {
			data = {"paument_id" : paument_id};
			ajax_sender(data,'/index.php/pauments/archiv','#archiv_message','Платеж внесен в архив');
		});
	});
});

// $(function() {
// 	$('.change_mail').click(function() {
// 		id = $(this).attr('id');
// 		splitted_id = id.split('_');
// 		user_id = splitted_id[2];
// 		user_name = $(this).parents('tr').children('td').eq(1).text();
// 		$('#change_mail .modal-body p').html('Сменить пароль для: <strong>'+user_name+'</strong>');
// 		$('#change_mail .modal-footer .btn-primary').on('click',function() {
// 			user_pass = $('#change_mail .modal-body input').val();
// 			data = {"user_id" : user_id, "user_pass" : user_pass};
// 			ajax_sender(data,'/index.php/users/change_mail','#change_mail_message','Пароль успешно изменен!');
// 		});
// 	});
// });

// $(function() {
// 	$('.change_mail1').click(function() {
// 		id = $(this).attr('id');
// 		splitted_id = id.split('_');
// 		user_id = splitted_id[2];
// 		user_name = $(this).parents('tr').children('td').eq(1).text();
// 		text_mail = $(this).parents('tr').children('td').eq(1).text();
// 		events_status = $(this).parents('tr').children('td').eq(1).text();
// 		$('#change_mail1 .modal-body p').html('Сменить пароль для: <strong>'+user_name+'</strong>');
// 		$('#change_mail1 .modal-body p').html( +events_status+ );
// 		$('#change_mail1 .modal-footer .btn-primary').on('click',function() {
// 			user_pass = $('#change_mail1 .modal-body input').val();
// 			data = {"user_id" : user_id, "user_pass" : user_pass};
// 			ajax_sender(data,'/index.php/users/change_mail1','#change_mail1_message','Пароль успешно изменен!');
// 		});
// 	});
// });


function ajax_sender(data,url,message_location,message) {
	$.ajax({
		url: url,
		type: 'post',
		data: data,
		success : function(data) {
			if (data == 1) {
				if (message == 'reload') {
					location.reload();
				}
				else {
					$(message_location).removeClass();
					$(message_location).addClass('alert alert-success');
					$(message_location).html(message);
				}
			}
			else {
				$(message_location).removeClass();
				$(message_location).addClass('alert alert-error');
				$(message_location).html('<strong>Проблемы с сервером.</strong> Пожалуйста, обновите страницу и выполните операцию еще раз.');
			}
		},
		error: function() {
			$(message_location).removeClass();
			$(message_location).addClass('alert alert-error');
			$(message_location).html('<strong>Проблемы с сервером.</strong> Пожалуйста, обновите страницу и выполните операцию еще раз.');
		}
	});
}


