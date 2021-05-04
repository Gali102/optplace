<?php //params
	$u_s = $this->session->userdata['user_status_maj'];

	$dis = $this->session->userdata['user_status_maj'] >= 7; // разрешено для всех
	$dis1 = $this->session->userdata['user_status_maj'] != 1;
?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>
		
		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class='col-md-12'>
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
					Данные о клиенте успешно обновлены!
				</div>
				<?php } ?>

				<?php if (!validation_errors() && $btn_click) { ?>
					<meta http-equiv="refresh" content="1">
				<?php } ?>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12">
					<h3 class="text-center">Редактирования профиля</h3>
					<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
				</div>
				<form action='' class='col-md-12' method='POST' enctype="multipart/form-data">
					<?php foreach ($users as $items) { ?>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
									<th class="col-md-7 text-center">ФИО пользователя</th>
									<th class="col-md-5 text-center">Статус пользователя</th>
									
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-7"><?php echo add_form_input('user_name','',$items['user_name'],1,100,150,$dis1); ?></td>
									<td class="col-md-5"><?php echo add_form_select('user_status_id',"",$items['user_status_id'],$user_status_id,'user_status_id','user_status_name',0,$dis1); ?></td>
								</tr>
							</tbody>
						</table>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
									<th class="col-md-4 text-center">Логин пользователя</th>
									<th class="col-md-4 text-center">Email</th>
									<th class="col-md-4 text-center">Телефон</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-4"><?php echo add_form_input('user_login','',$items['user_login'],1,100,150,$dis1); ?></td>
									<td class="col-md-4"><?php echo add_form_input('user_email','',$items['user_email'],0,100,150,$dis); ?></td>
									<td class="col-md-4"><?php echo add_form_input('user_telephon','',$items['user_telephon'],0,100,150,$dis); ?></td>
								</tr>
							</tbody>
						</table>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
									<th class="col-md-6 text-center">Организация</th>
									<th class="col-md-6 text-center">Должность</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-6"><?php echo add_form_select('otdel_id','',$items['otdel_id'],$otdel_id,'otdel_id','otdel_name',0,$dis1); ?></td>
									<td class="col-md-6"><?php echo add_form_select('dolzhnost_id','',$items['dolzhnost_id'],$dolzhnost_id,'dolzhnost_id','dolzhnost_name',0,$dis1); ?></td>
								</tr>
							</tbody>
						</table>
						<tr>
							<td>
								<?php if (! $dis) { ?>
									<button type='submit' style="margin-top: 1px;" class='btn btn-success' name='update_user' value='true'>Сохранить</button>
								<?php } ?>
							</td>
							<br>
						</tr> 

					<?php } ?>
				</form>
			</div>

		</div>
	</div>
</div>


