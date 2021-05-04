<?php //params
	$u_s = $this->session->userdata['user_status_maj'];
?>


<!-- /////////////////////////////////// Администратор /////////////////////////////////// -->
<?php  if ($u_s == 1) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			<a href="/index.php/users"><i class="fa fa-users"></i> Добавить пользователя</a>
			<a href="/index.php/add_org"><i class="fa fa-adjust"></i> Добавить отдел</a>
			<a href="/index.php/add_dolzhnost"><i class="fa fa-bullseye"></i> Добавить должность</a>
			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
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
				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-4"><?php echo create_select_for_filter('user_status_id1',"По статусу пользователя","Выберите статус",$user_statuses,'user_status_id','user_status_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('otdel_id1',"По отделу","Выберите статус",$otdel_id,'otdel_id','otdel_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('dolzhnost_id1',"По должности","Выберите статус",$dolzhnost_id,'dolzhnost_id','dolzhnost_name'); ?></div>
						<div class="col-md-12" style="margin-top: 15px;">
							<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
							<button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
						</div>
					</form>
				</div>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>
						<tr>
							<th class="col-md-1 text-center">Номер</th>
							<th class="col-md-2 text-center">ФИО <br> пользователя</th>
							<th class="col-md-2 text-center">Статус <br> пользователя</th>
							<th class="col-md-2 text-center">Отдел</th>
							<th class="col-md-2 text-center">Должность</th>
							<th class="col-md-2 text-center">Логин</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-1"><?php echo ++$i; ?></td>
							<td class="col-md-2"><a href="<?php echo url_infos().$items['user_id']; ?>"><?php echo $items['user_name']; ?></a></td>
							<td class="col-md-2 text-center"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['user_login']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $users) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>




<!-- /////////////////////////////////// Директор /////////////////////////////////// -->

<?php  if ($u_s == 2) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			
			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
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
				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-4"><?php echo create_select_for_filter('user_status_id1',"По статусу пользователя","Выберите статус",$user_statuses,'user_status_id','user_status_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('otdel_id1',"По отделу","Выберите статус",$otdel_id,'otdel_id','otdel_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('dolzhnost_id1',"По должности","Выберите статус",$dolzhnost_id,'dolzhnost_id','dolzhnost_name'); ?></div>
						<div class="col-md-12" style="margin-top: 15px;">
							<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
							<button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
						</div>
					</form>
				</div>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>
						<tr>
							<th class="col-md-1 text-center">Номер</th>
							<th class="col-md-2 text-center">ФИО <br> пользователя</th>
							<th class="col-md-2 text-center">Статус <br> пользователя</th>
							<th class="col-md-2 text-center">Отдел</th>
							<th class="col-md-2 text-center">Должность</th>
							<th class="col-md-2 text-center">Логин</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-1"><?php echo ++$i; ?></td>
							<td class="col-md-2"><a href="<?php echo url_infos().$items['user_id']; ?>"><?php echo $items['user_name']; ?></a></td>
							<td class="col-md-2 text-center"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['user_login']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $users) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>



<!-- /////////////////////////////////// Зам.директора /////////////////////////////////// -->
<?php  if ($u_s == 3) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			
			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<!-- <a href="<?php echo url_uvedomleniya() ?>"><i class="fa fa-flag-o"></i> Уведомления</a> -->
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
				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-4"><?php echo create_select_for_filter('user_status_id1',"По статусу пользователя","Выберите статус",$user_statuses,'user_status_id','user_status_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('otdel_id1',"По отделу","Выберите статус",$otdel_id,'otdel_id','otdel_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('dolzhnost_id1',"По должности","Выберите статус",$dolzhnost_id,'dolzhnost_id','dolzhnost_name'); ?></div>
						<div class="col-md-12" style="margin-top: 15px;">
							<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
							<button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
						</div>
					</form>
				</div>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>
						<tr>
							<th class="col-md-1 text-center">Номер</th>
							<th class="col-md-2 text-center">ФИО <br> пользователя</th>
							<th class="col-md-2 text-center">Статус <br> пользователя</th>
							<th class="col-md-2 text-center">Отдел</th>
							<th class="col-md-2 text-center">Должность</th>
							<th class="col-md-2 text-center">Логин</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-1"><?php echo ++$i; ?></td>
							<td class="col-md-2"><a href="<?php echo url_infos().$items['user_id']; ?>"><?php echo $items['user_name']; ?></a></td>
							<td class="col-md-2 text-center"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['user_login']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $users) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>



<!-- /////////////////////////////////// Начальник отдела /////////////////////////////////// -->
<?php  if ($u_s == 4) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			
			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<!-- <a href="<?php echo url_uvedomleniya() ?>"><i class="fa fa-flag-o"></i> Уведомления</a> -->
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
				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-4"><?php echo create_select_for_filter('user_status_id1',"По статусу пользователя","Выберите статус",$user_statuses,'user_status_id','user_status_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('otdel_id1',"По отделу","Выберите статус",$otdel_id,'otdel_id','otdel_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('dolzhnost_id1',"По должности","Выберите статус",$dolzhnost_id,'dolzhnost_id','dolzhnost_name'); ?></div>
						<div class="col-md-12" style="margin-top: 15px;">
							<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
							<button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
						</div>
					</form>
				</div>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>
						<tr>
							<th class="col-md-1 text-center">Номер</th>
							<th class="col-md-2 text-center">ФИО <br> пользователя</th>
							<th class="col-md-2 text-center">Статус <br> пользователя</th>
							<th class="col-md-2 text-center">Отдел</th>
							<th class="col-md-2 text-center">Должность</th>
							<th class="col-md-2 text-center">Логин</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-1"><?php echo ++$i; ?></td>
							<td class="col-md-2"><a href="<?php echo url_infos().$items['user_id']; ?>"><?php echo $items['user_name']; ?></a></td>
							<td class="col-md-2 text-center"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['user_login']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $users) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>



<!-- /////////////////////////////////// Зам.нач.отдела /////////////////////////////////// -->
<?php  if ($u_s == 5) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			
			<hr> <a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<!-- <a href="<?php echo url_uvedomleniya() ?>"><i class="fa fa-flag-o"></i> Уведомления</a> -->
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
				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-4"><?php echo create_select_for_filter('user_status_id1',"По статусу пользователя","Выберите статус",$user_statuses,'user_status_id','user_status_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('otdel_id1',"По отделу","Выберите статус",$otdel_id,'otdel_id','otdel_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('dolzhnost_id1',"По должности","Выберите статус",$dolzhnost_id,'dolzhnost_id','dolzhnost_name'); ?></div>
						<div class="col-md-12" style="margin-top: 15px;">
							<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
							<button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
						</div>
					</form>
				</div>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>
						<tr>
							<th class="col-md-1 text-center">Номер</th>
							<th class="col-md-2 text-center">ФИО <br> пользователя</th>
							<th class="col-md-2 text-center">Статус <br> пользователя</th>
							<th class="col-md-2 text-center">Отдел</th>
							<th class="col-md-2 text-center">Должность</th>
							<th class="col-md-2 text-center">Логин</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-1"><?php echo ++$i; ?></td>
							<td class="col-md-2"><a href="<?php echo url_infos().$items['user_id']; ?>"><?php echo $items['user_name']; ?></a></td>
							<td class="col-md-2 text-center"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['user_login']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $users) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>



<!-- /////////////////////////////////// Менеджер /////////////////////////////////// -->
<?php  if ($u_s == 6) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><i class="fa fa-user"></i> Профиль</a>

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
				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-4"><?php echo create_select_for_filter('user_status_id1',"По статусу пользователя","Выберите статус",$user_statuses,'user_status_id','user_status_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('otdel_id1',"По отделу","Выберите статус",$otdel_id,'otdel_id','otdel_name'); ?></div>
						<div class="col-md-4"><?php echo create_select_for_filter('dolzhnost_id1',"По должности","Выберите статус",$dolzhnost_id,'dolzhnost_id','dolzhnost_name'); ?></div>
						<div class="col-md-12" style="margin-top: 15px;">
							<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
							<button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
						</div>
					</form>
				</div>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>
						<tr>
							<th class="col-md-1 text-center">Номер</th>
							<th class="col-md-2 text-center">ФИО <br> пользователя</th>
							<th class="col-md-2 text-center">Статус <br> пользователя</th>
							<th class="col-md-2 text-center">Отдел</th>
							<th class="col-md-2 text-center">Должность</th>
							<th class="col-md-2 text-center">Логин</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-1"><?php echo ++$i; ?></td>
							<td class="col-md-2"><a href="<?php echo url_infos().$items['user_id']; ?>"><?php echo $items['user_name']; ?></a></td>
							<td class="col-md-2 text-center"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['user_login']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $users) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>