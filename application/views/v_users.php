<?php //params
	$u_s = $this->session->userdata['user_status_maj'];
?>


<!-- /////////////////////////////////// Администратор /////////////////////////////////// -->
<?php  if ($u_s == 1 or $u_s == 2) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<?php if (validation_errors()) { ?>
				<div class='alert alert-error'>
					<?php echo validation_errors(); ?>
				</div>
				<?php } ?>
				<?php if ((!validation_errors()) && (!$status) && ($btn_click)) { ?>
				<div class='alert alert-error'>
					Проблемы на стороне сервера. Пожалуйста, обновите страницу!
				</div>
				<?php } ?>
				<?php if ((!validation_errors()) && ($status) && ($btn_click)) { ?>
				<div class='alert alert-success'>
					Пользователь успешно добавлен!
				</div>
				<?php } ?>

				<?php if (!validation_errors() && $btn_click) { ?>
				<meta http-equiv="refresh" content="1">
				<?php } ?>
			</div>

			<div class="col-md-12">
				<div class="col-md-12">
					<h3 class="text-center">Добавить пользователя</h3>
					<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
				</div>
				<form action='' method='POST'>
					<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color' >
							<tr>
								<th class="col-md-6 text-center">ФИО пользователя</th>
								<th class="col-md-3 text-center">Статус пользователя</th>
								<th class="col-md-3 text-center">Отдел</th>
								<!-- <th class="text-center"></th> -->
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-6 text-center"><?php echo create_input_for_filter('user_name',""); ?></td>
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('user_status_id',"","",$user_statuses,'user_status_id','user_status_name'); ?><br />
								</td>
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('otdel_id',"","",$otdel_id,'otdel_id','otdel_name'); ?><br />
								</td>
							</tr>
						</tbody>
					</table>
					<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color'>	
							<tr>
								<th class="col-md-4 text-center">Логин</th>
								<th class="col-md-4 text-center">Пароль</th>
								<th class="col-md-3 text-center">Должность</th>
								<th class="col-md-1 text-center"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-4 text-center"><?php echo create_input_for_filter('user_login',""); ?></td>
								<td class="col-md-4 text-center"><?php echo create_input_for_filter('user_pass',""); ?></td>
								<td class="col-md-3 text-center">
									<?php $otdel_id ?>
									<?php echo create_select_for_filter('dolzhnost_id',"","",$dolzhnost_id,'dolzhnost_id','dolzhnost_name'); ?><br />
								</td> 
								<td class="col-md-1 text-center"><button type='submit' name='add_user' value='true' class='btn btn-success center-block'><i class='icon icon-ok icon-white'></i>Добавить</button></td>
							</tr>	
						</tbody>
					</table>
				</form>

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
							<th class="col-md-1">Номер</th>
							<th class="col-md-2">ФИО <br> пользователя</th>
							<th class="col-md-2">Статус <br> пользователя</th>
							<th class="col-md-2">Отдел</th>
							<th class="col-md-2">Должность</th>
							<th class="col-md-2">Логин</th>
							<th class="col-md-1">Пароль</th>
							<th class="col-md-1"></th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($users as $items) { ?>
						<tr>
							<td class="col-md-1"><?php echo ++$i; ?></td>
							<td class="col-md-2"><a href="<?php echo url_profil().$items['user_id']; ?>"><?php echo $items['user_name']; ?></a></td>
							<td class="col-md-2"><?php echo $items['user_status_name']; ?></td>
							<td class="col-md-2"><?php echo $items['otdel_name']; ?></td>
							<td class="col-md-2"><?php echo $items['dolzhnost_name']; ?></td>
							<td class="col-md-2"><?php echo $items['user_login']; ?></td>
							<td class="col-md-1"><a href='#change_pass' id='change_pass_<?php echo $items['user_id']; ?>' class='change_pass' data-toggle='modal'>Сменить пароль</a></td>
							<!-- <form  action='/delete_user'> -->
							<td class="col-md-1"><a type='submit' href='/index.php/users/delete_user' id='delete_user_<?php echo $items['user_id']; ?>' class='delete_user'>Удалить</a>
							</td>
							<!-- </form>							 -->
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $users) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

				<!-- Смена пароля -->
				<div id="change_pass" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- Заголовок модального окна -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h4 class="modal-title">Сменить пароль пользователя</h4>
							</div>
							<!-- Основное содержимое модального окна -->
							<div class="modal-body">
								<div id='change_pass_message'></div>
								<p></p>
								<div style="margin-top: 50px; margin-bottom: 50px;">
									<p class="text-center" style="font-size: 19px; font-family: 'Oswald';">Новый пароль: </p>
									<input type='text' style="margin-left: 25%; width: 50% ; height: 35px;" id='change_pass_val' />
								</div>
							</div>
							<!-- Футер модального окна -->
							<div class="modal-footer">
								<button id="change_pass_apply" class="btn btn-primary">Выполнить</button>
								<button class="btn" data-dismiss="modal" type="button">Закрыть</button>
							</div>
						</div>
					</div>
				</div>

				<!-- Удаление -->
				<div id="delete_user" class="modal fade">
					<div class="modal-dialog">
						<div class="modal-content">
							<!-- Заголовок модального окна -->
							<div class="modal-header">
								<button type="button" class="close" data-dismiss="modal">×</button>
								<h4 class="modal-title">Удалить пользователя</h4>
							</div>
							<!-- Основное содержимое модального окна -->
							<div class="modal-body">
								<div id='delete_user_message'></div>
								<p></p>
								<div style="margin-top: 50px; margin-bottom: 50px;">
									<button id="change_pass_apply" class="btn btn-primary">Удалить?</button>
								</div>
							</div>
							<!-- Футер модального окна -->
							<div class="modal-footer">
								<button class="btn" data-dismiss="modal" type="button">Закрыть</button>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
	</div>
</div>

<?php } ?>
