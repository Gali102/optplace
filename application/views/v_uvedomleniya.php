<?php //params
$u_s = $this->session->userdata['user_status_maj'];

$dis = true;

?>


<!-- /////////////////////////////////// Администратор /////////////////////////////////// -->
<?php  if ($u_s == 1) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil() ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			<a href="/index.php/users"><i class="fa fa-users"></i> Добавить пользователя</a>
			<a href="/index.php/add_org"><i class="fa fa-adjust"></i> Добавить отдел</a>
			<a href="/index.php/add_dolzhnost"><i class="fa fa-bullseye"></i> Добавить должность</a>

			<hr>
			
			<a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<!-- <a href="<?php echo url_uvedomleniya() ?>"><i class="fa fa-flag-o"></i> Уведомления</a> -->
			<a href="<?php echo url_chat() ?>"><i class="fa fa-comments"></i> Чат</a>

			<hr>

			<a href="/index.php/info"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<a href="/index.php/vazhnoe"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #B22222;"></i> Важное
			</a>

			<hr>

			<a href="/index.php/auth/user_exit"><i class="fa fa-sign-out"></i> Выход
			</a>
		</div>

		<div class="col-md-10" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все уведомления</p>

			<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">


			<p style="font-size: 19px; text-align: center;">Мне сообщения</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название сообщения</th>
						<th class="col-md-4 text-center">Отправитель</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events11 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center"><a href="<?php echo url_mymail1().$items['mail_id']; ?>"><?php echo $items['name_mail']; ?></a></td>
						<!-- <td class="col-md-4 text-center"><a href='#change_mail1' id='change_mail1_<?php echo $items['mail_id']; ?>' class='change_mail1' data-toggle='modal'><?php echo $items['name_mail']; ?></a></td> -->
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['date_otpr']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events11) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>



			<p style="font-size: 19px; text-align: center; margin-top: 25px;">Мне задания</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-3 text-center">Название задания</th>
						<th class="col-md-2 text-center">Дата контроля</th>
						<th class="col-md-2 text-center">Статус</th>
						<th class="col-md-2 text-center">Исполнение</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events6 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?></a></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events6) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>




<!-- /////////////////////////////////// Директор /////////////////////////////////// -->
<?php if ($u_s == 2) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil() ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>

			<hr>

			<a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<a href="<?php echo url_chat() ?>"><i class="fa fa-comments"></i> Чат</a>

			<hr>

			<a href="/index.php/info"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<a href="/index.php/vazhnoe"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #B22222;"></i> Важное
			</a>

			<hr>

			<a href="/index.php/auth/user_exit"><i class="fa fa-sign-out"></i> Выход
			</a>
		</div>

		<div class="col-md-10" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все уведомления</p>

			<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">


			<p style="font-size: 19px; text-align: center;">Мне сообщения</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название сообщения</th>
						<th class="col-md-4 text-center">Отправитель</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events11 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center"><a href="<?php echo url_mymail1().$items['mail_id']; ?>"><?php echo $items['name_mail']; ?></a></td>
						<!-- <td class="col-md-4 text-center"><a href='#change_mail1' id='change_mail1_<?php echo $items['mail_id']; ?>' class='change_mail1' data-toggle='modal'><?php echo $items['name_mail']; ?></a></td> -->
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['date_otpr']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events11) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>



			<p style="font-size: 19px; text-align: center; margin-top: 25px;">Мне задания</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-3 text-center">Название задания</th>
						<th class="col-md-2 text-center">Дата контроля</th>
						<th class="col-md-2 text-center">Статус</th>
						<th class="col-md-2 text-center">Исполнение</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events6 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?></a></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events6) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>







<!-- /////////////////////////////////// Зам.директора /////////////////////////////////// -->
<?php if ($u_s == 3) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil() ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			
			<hr>

			<a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<a href="<?php echo url_chat() ?>"><i class="fa fa-comments"></i> Чат</a>

			<hr>

			<a href="<?php echo url_infos().$this->session->userdata('user_id') ?>"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<a href="/index.php/vazhnoe"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #B22222;"></i> Важное
			</a>

			<hr>

			<a href="/index.php/auth/user_exit"><i class="fa fa-sign-out"></i> Выход
			</a>
		</div>

		<div class="col-md-10" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все уведомления</p>

			<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">


			<p style="font-size: 19px; text-align: center;">Мне сообщения</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название сообщения</th>
						<th class="col-md-4 text-center">Отправитель</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events11 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center"><a href="<?php echo url_mymail1().$items['mail_id']; ?>"><?php echo $items['name_mail']; ?></a></td>
						<!-- <td class="col-md-4 text-center"><a href='#change_mail1' id='change_mail1_<?php echo $items['mail_id']; ?>' class='change_mail1' data-toggle='modal'><?php echo $items['name_mail']; ?></a></td> -->
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['date_otpr']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events11) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>



			<p style="font-size: 19px; text-align: center; margin-top: 25px;">Мне задания</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-3 text-center">Название задания</th>
						<th class="col-md-2 text-center">Дата контроля</th>
						<th class="col-md-2 text-center">Статус</th>
						<th class="col-md-2 text-center">Исполнение</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events6 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?></a></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events6) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>







<!-- /////////////////////////////////// Нач.отдела /////////////////////////////////// -->
<?php if ($u_s == 4) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil() ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<a href="<?php echo url_chat() ?>"><i class="fa fa-comments"></i> Чат</a>

			<hr>

			<a href="<?php echo url_infos().$this->session->userdata('user_id') ?>"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<a href="/index.php/vazhnoe"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #B22222;"></i> Важное
			</a>

			<hr>

			<a href="/index.php/auth/user_exit"><i class="fa fa-sign-out"></i> Выход
			</a>
		</div>

		<div class="col-md-10" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все уведомления</p>

			<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">


			<p style="font-size: 19px; text-align: center;">Мне сообщения</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название сообщения</th>
						<th class="col-md-4 text-center">Отправитель</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events11 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center"><a href="<?php echo url_mymail1().$items['mail_id']; ?>"><?php echo $items['name_mail']; ?></a></td>
						<!-- <td class="col-md-4 text-center"><a href='#change_mail1' id='change_mail1_<?php echo $items['mail_id']; ?>' class='change_mail1' data-toggle='modal'><?php echo $items['name_mail']; ?></a></td> -->
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['date_otpr']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events11) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>



			<p style="font-size: 19px; text-align: center; margin-top: 25px;">Мне задания</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-3 text-center">Название задания</th>
						<th class="col-md-2 text-center">Дата контроля</th>
						<th class="col-md-2 text-center">Статус</th>
						<th class="col-md-2 text-center">Исполнение</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events6 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?></a></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events6) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>







<!-- /////////////////////////////////// Зам.нач.отдела /////////////////////////////////// -->
<?php if ($u_s == 5) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil() ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<a href="<?php echo url_chat() ?>"><i class="fa fa-comments"></i> Чат</a>

			<hr>

			<a href="<?php echo url_infos().$this->session->userdata('user_id') ?>"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<a href="/index.php/vazhnoe"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #B22222;"></i> Важное
			</a>

			<hr>

			<a href="/index.php/auth/user_exit"><i class="fa fa-sign-out"></i> Выход
			</a>
		</div>

		<div class="col-md-10" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все уведомления</p>

			<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">


			<p style="font-size: 19px; text-align: center;">Мне сообщения</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название сообщения</th>
						<th class="col-md-4 text-center">Отправитель</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events11 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center"><a href="<?php echo url_mymail1().$items['mail_id']; ?>"><?php echo $items['name_mail']; ?></a></td>
						<!-- <td class="col-md-4 text-center"><a href='#change_mail1' id='change_mail1_<?php echo $items['mail_id']; ?>' class='change_mail1' data-toggle='modal'><?php echo $items['name_mail']; ?></a></td> -->
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['date_otpr']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events11) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>



			<p style="font-size: 19px; text-align: center; margin-top: 25px;">Мне задания</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-3 text-center">Название задания</th>
						<th class="col-md-2 text-center">Дата контроля</th>
						<th class="col-md-2 text-center">Статус</th>
						<th class="col-md-2 text-center">Исполнение</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events6 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?></a></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events6) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>







<!-- /////////////////////////////////// Менеджер /////////////////////////////////// -->
<?php if ($u_s == 6) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil() ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<a href="<?php echo url_chat() ?>"><i class="fa fa-comments"></i> Чат</a>

			<hr>

			<a href="<?php echo url_infos().$this->session->userdata('user_id') ?>"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<a href="/index.php/vazhnoe"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #B22222;"></i> Важное
			</a>

			<hr>

			<a href="/index.php/auth/user_exit"><i class="fa fa-sign-out"></i> Выход
			</a>
		</div>

		<div class="col-md-10" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все уведомления</p>

			<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">


			<p style="font-size: 19px; text-align: center;">Мне сообщения</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название сообщения</th>
						<th class="col-md-4 text-center">Отправитель</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events11 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center"><a href="<?php echo url_mymail1().$items['mail_id']; ?>"><?php echo $items['name_mail']; ?></a></td>
						<!-- <td class="col-md-4 text-center"><a href='#change_mail1' id='change_mail1_<?php echo $items['mail_id']; ?>' class='change_mail1' data-toggle='modal'><?php echo $items['name_mail']; ?></a></td> -->
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['date_otpr']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events11) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>



			<p style="font-size: 19px; text-align: center; margin-top: 25px;">Мне задания</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-3 text-center">Название задания</th>
						<th class="col-md-2 text-center">Дата контроля</th>
						<th class="col-md-2 text-center">Статус</th>
						<th class="col-md-2 text-center">Исполнение</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($events6 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?></a></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events6) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>