<?php //params
	$u_s = $this->session->userdata['user_status_maj'];

	$dis = $this->session->userdata['user_status_maj'] >= 7; // разрешено для всех
	$dis1 = $this->session->userdata['user_status_maj'] != 1;
?>


<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-2 menu" style="position: absolute; height: 100%; top: 0; left: 0;">
			<a href="/index.php/glavnaya"><i class="fa fa-home"></i> Главная</a>
			<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><i class="fa fa-user"></i> Профиль</a>

			<hr>

			<?php if($u_s < 6) : ?>
				<a href="<?php echo url_events() ?>"><i class="fa fa-certificate"></i> Добавить задачу</a>
			<?php endif; ?>
			<?php if($u_s == 1) : ?>
			<a href="/index.php/users"><i class="fa fa-users"></i> Добавить пользователя</a>
			<a href="/index.php/add_org"><i class="fa fa-adjust"></i> Добавить отдел</a>
			<a href="/index.php/add_dolzhnost"><i class="fa fa-bullseye"></i> Добавить должность</a>
			<?php endif; ?>
			<?php if($u_s < 6) : ?>
			<hr>
			<?php endif; ?> 
			<a href="<?php echo url_event_today() ?>"><i class="fa fa-bell"></i> Задачи на сегодня</a>
			<a href="<?php echo url_event_vazhnoe() ?>"><i class="fa fa-fire"></i> Важные задачи</a>
			<a href="<?php echo url_events_all() ?>"><i class="fa fa-history"></i> Все задачи</a>
			<a href="<?php echo url_files() ?>"><i class="fa fa-file"></i> Файлы</a>
			<a href="<?php echo url_calendar() ?>"><i class="fa fa-calendar"></i> Календарь</a>
			<a href="<?php echo url_mymail() ?>"><i class="fa fa-envelope"></i> Моя почта</a>
			<a href="<?php echo url_chat() ?>"><i class="fa fa-comments"></i> Чат</a>

			<hr>

			<?php if($u_s < 3) : ?>
			<a href="/index.php/info"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<?php endif; ?>

			<?php if($u_s > 2) : ?>
			<a href="<?php echo url_infos().$this->session->userdata('user_id') ?>"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #00CED1;"></i> Информация
			</a>
			<?php endif; ?> 

			<a href="/index.php/vazhnoe"><i class="fa fa-circle-o" style="font-size: 1.2em; color: #B22222;"></i> Важное
			</a>

			<hr>

			<a href="/index.php/auth/user_exit"><i class="fa fa-sign-out"></i> Выход
			</a>
		</div>

		<div class="col-md-10" style="float: right; margin-bottom: 500px;">
			
			<div class="col-md-12 row">
				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color' >
						<tr>
							<th class="col-md-3 text-center">ФИО <br> пользователя</th>
							<th class="col-md-3 text-center">Статус <br> пользователя</th>
							<th class="col-md-2 text-center">Отдел</th>
							<th class="col-md-2 text-center">Должность</th>
							<th class="col-md-2 text-center">Логин</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-3 text-center"><?php echo $items['user_name']; ?></td>
							<td class="col-md-3 text-center"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2 text-center"><?php echo $items['user_login']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color' >
						<tr>
							<th class="col-md-3 text-center">Не выполнено</th>
							<th class="col-md-3 text-center">Выполнено</th>
							<th class="col-md-2 text-center">Выполнено с опозданием</th>
							<th class="col-md-2 text-center">Отменено</th>
							<th class="col-md-2 text-center">Просрочено</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-3 text-center"><?php echo $infos[1] ?></td>
							<td class="col-md-3 text-center"><?php echo $infos[2] ?></td>
							<td class="col-md-2 text-center"><?php echo $infos[3] ?></td>
							<td class="col-md-2 text-center"><?php echo $infos[4] ?></td>
							<td class="col-md-2 text-center"><?php echo $infos[5] ?></td>
						</tr>
					</tbody>
				</table>
				
			</div>
		</div>
	</div>
</div>
