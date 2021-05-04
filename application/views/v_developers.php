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
					Застройщик успешно добавлен!
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
				<form action='' method='POST' enctype="multipart/form-data">
					<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color' >
							<tr>
								<th class="col-md-6 text-center">Название застройщика</th>
								<th class="col-md-3 text-center">Регион</th>
								<th class="col-md-3 text-center">Кто добавил</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-6 text-center">
									<?php echo create_input_for_filter('developers_name',""); ?>
								</td>
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('city_id',"","",$city_id,'city_id','city_name'); ?><br />
								</td>
								<td class="col-md-3 text-center">
									<?php 
									echo $this->session->userdata['user_name'];
									echo "<input type='hidden' name='user_id' value='".$this->session->userdata['user_id']."' />";
									?>
								</td>
							</tr>
						</tbody>
					</table>
					<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color'>	
							<tr>
								<th class="col-md-3 text-center">Номер телефона</th>
								<th class="col-md-3 text-center">Почта</th>
								<th class="col-md-3 text-center">Адрес</th>
								<th class="col-md-3 text-center"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-3 text-center">
									<?php echo create_input_for_filter('developers_phone',""); ?>
								</td>
								<td class="col-md-3 text-center">
									<?php echo create_input_for_filter('developers_email',""); ?>
								</td> 
								<td class="col-md-3 text-center">
									<?php echo create_input_for_filter('developers_adress',""); ?>
								</td>
								<td class="col-md-3 text-center">
									<button class='btn btn-success' type='submit'>Добавить</button>
									<input type="hidden" name='add_developers' value='1'>
								</td>
							</tr>	
						</tbody>
					</table>
				</form>

				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-6"><?php echo create_select_for_filter('city_id1',"По городу застройщика","Выберите город",$city_id,'city_id','city_name'); ?></div>
						<div class="col-md-6" style="margin-top: 15px;">
							<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
							<button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
						</div>
					</form>
				</div>

				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>
						<tr>
							<th class="col-md-2">Название</th>
							<th class="col-md-2">Город</th>
							<th class="col-md-2">Телефон</th>
							<th class="col-md-2">Почта</th>
							<th class="col-md-2">Адрес</th>
							<th class="col-md-2">Кто добавил</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($developers as $items) { ?>
						<tr>
							<td class="col-md-2">
								<a href="<?php echo url_developer().$items['developers_id']; ?>"><?php echo $items['developers_name']; ?></a>
							</td>
							<td class="col-md-2">
								<?php echo $items['city_name']; ?>
							</td>
							<td class="col-md-2">
								<?php echo $items['developers_phone']; ?>
							</td>
							<td class="col-md-2">
								<?php echo $items['developers_email']; ?>
							</td>
							<td class="col-md-2">
								<?php echo $items['developers_adress']; ?>
							</td>
							<td class="col-md-2">
								<?php echo $items['user_name']; ?>
							</td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $developers) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>
