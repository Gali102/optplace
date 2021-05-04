function built_menu(vvv,u) {
	//if (vvv == 1) {
		$('#main_navigation').append('<li id="select_all_tab"><a href="#select_all" data-toggle="tab">Главная</a></li>');
		$('#main_navigation').append('<li id="client_tab"><a href="#client" data-toggle="tab">Клиент</a></li>');
		if (vvv == 1 || vvv == 2 || vvv == 5) {
			$('#main_navigation').append('<li id="admin_tab"><a href="#admin" data-toggle="tab">Администрирование</a></li>');
		}	
		
		$('#main_navigation').append('<li class="pull-right" id="admin_tab"><a href="/index.php/auth/user_exit">Выход</a></li>');
		$('#main_navigation').append('<li class="pull-right"><a>'+u+'</a></li>');

		$('#main_navigation1').append('<li class="" style="text-align: center; font-size: 27px;">'+u+'</li>');

		$('#main_navigation_content').append('<div class="tab-pane" id="client">');
		$('#main_navigation_content').append('<div class="tab-pane" id="select_all">');
		if (vvv == 1 || vvv == 2 || vvv == 5) {
			$('#main_navigation_content').append('<div class="tab-pane" id="admin">');
		}
		if (vvv == 1 || vvv == 2 || vvv >= 6) {
		$('#client').append('<a href="/index.php/add_client">Добавить</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
		if (vvv < 6) {
				$('#client').append('<a href="/index.php/clients">Все клиенты</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
			}	
		if (vvv == 6) {
				$('#client').append('<a href="/index.php/clients?client_fio=тест&grz_car=&phone_m=&client_status_id=6">Все клиенты</a>&nbsp&nbsp&nbsp&nbsp&nbsp'); // Для Менеджера КБМ
			}
		if (vvv == 7) {
				$('#client').append('<a href="/index.php/clients?client_fio=тест&grz_car=&phone_m=&client_status_id=7">Все клиенты</a>&nbsp&nbsp&nbsp&nbsp&nbsp'); // Для Менеджера КБМ
			}
			
		$('#select_all').append('<a href="/index.php/events/">Все записи</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		if (vvv != 6) {
		$('#select_all').append('<a href="/index.php/dela">Все дела</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
		if (vvv == 1) {
			$('#admin').append('<a href="/index.php/users">Добавить пользователя</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
		if (vvv == 1) {
			$('#admin').append('<a href="/index.php/avarcom">Добавить аваркома</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
				if (vvv == 1) {
			$('#admin').append('<a href="/index.php/assistant">Добавить ассистента</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
		if (vvv == 1 || vvv == 2 || vvv == 5) {
			$('#admin').append('<a href="/index.php/balance">Баланс клиентов</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}	
		if (vvv == 1) {
			$('#admin').append('<a href="/index.php/archiv">Архив платежей</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
		if (vvv == 1) {		
			$('#admin').append('<a href="/index.php/proeb">Просроченные дела</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
	//	if (vvv == 1 || vvv == 5) {		
	//		$('#admin').append('<a href="/index.php/otchet_users">Отчет по сотрудникам</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
	//	}
	//	if (vvv == 1 || vvv == 5) {		
	//		$('#admin').append('<br /><a href="/index.php/otchet_clients">Отчет по клиентам</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
	//	}
		if (vvv == 1 || vvv == 2 || vvv == 5) {		
			$('#admin').append('<br /><a href="/index.php/otchet_buh">Фин. отчет (оплачено)</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
		if (vvv == 1 || vvv == 2 || vvv == 5) {		
			$('#admin').append('<a href="/index.php/otchet_buh2">Фин. отчет (выставлено)</a>&nbsp&nbsp&nbsp&nbsp&nbsp');
		}
		url = window.location.href;
		if (url.indexOf('/events')+1 || url.indexOf('/dela')+1) {
			$('#select_all_tab').addClass('active');
			$('#select_all').addClass('active');
		}
		if (url.indexOf('/add_client')+1 || url.indexOf('/client')+1 || url.indexOf('/client_car')+1 
		|| url.indexOf('/delo')+1 || url.indexOf('/pauments')+1 || url.indexOf('/talks')+1) {
			$('#client_tab').addClass('active');
			$('#client').addClass('active');
		}
		
		if (url.indexOf('users')+1 || url.indexOf('balance')+1 || url.indexOf('archiv')+1 
		|| url.indexOf('proeb')+1 || url.indexOf('otchet_clients')+1 || url.indexOf('otchet_users')+1) {
			$('#admin_tab').addClass('active');
			$('#admin').addClass('active');
		}
	/*	if (url.indexOf('c_client_book/select_all')+1) {
			$('#select_all_tab').addClass('active');
			$('#select_all').addClass('active');
		}*/
	
		

}


$(function() {
	$('#myTab a').click(function(e) {
    	e.preventDefault();
        $(this).tab('show');
    });
});


$(function() {
	var currentTallest = 0,
     currentRowStart = 0,
     rowDivs = new Array(),
     $el,
     topPosition = 0;

	$('.blocks').each(function() {

		$el = $(this);
		topPostion = $el.position().top;
   
		if (currentRowStart != topPostion) {

     // we just came to a new row.  Set all the heights on the completed row
			for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
				rowDivs[currentDiv].height(currentTallest);
			}

     // set the variables for the new row
			rowDivs.length = 0; // empty the array
			currentRowStart = topPostion;
			currentTallest = $el.height();
			rowDivs.push($el);

		} else {

     // another div on the current row.  Add it to the list and check if it's taller
			rowDivs.push($el);
			currentTallest = (currentTallest < $el.height()) ? ($el.height()) : (currentTallest);

		}
   
  // do the last row
		for (currentDiv = 0 ; currentDiv < rowDivs.length ; currentDiv++) {
			rowDivs[currentDiv].height(currentTallest);
		}
   
	})
}); 