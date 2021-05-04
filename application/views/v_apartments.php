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
					Квартира успешно добавлена!
				</div>
				<?php } ?>

				<?php if (!validation_errors() && $btn_click) { ?>
				<meta http-equiv="refresh" content="1">
				<?php } ?>
			</div>

			<div class="col-md-12">
				<div class="col-md-12">
					<h3 class="text-center">Добавить Квартиру</h3>
					<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
				</div>
				<form action='' method='POST'>
					<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color' >
							<tr>
								<th class="col-md-6 text-center">Название квартиры</th>
								<th class="col-md-3 text-center">Застройщик</th>
								<th class="col-md-3 text-center">Кто добавил</th>
								<!-- <th class="text-center"></th> -->
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-6 text-center"><?php echo create_input_for_filter('apartment_name',""); ?></td>
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('developers_id',"","",$developers_id,'developers_id','developers_name'); ?><br />
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
								<th class="col-md-3 text-center">Площадь</th>
								<th class="col-md-3 text-center">Год сдачи</th>
								<th class="col-md-3 text-center">Цена за квартиру</th>
								<th class="col-md-3 text-center">Цена за кв.сетр</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-3 text-center">
									<?php echo create_input_for_filter('apartment_ploshad',""); ?>
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('finish_year_id',"","",$finish_year_id,'finish_year_id','finish_year_name'); ?><br /></td>
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('price_id',"","",$price_id,'price_id','price_name'); ?><br />
								</td> 
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('price_metr_id',"","",$price_metr_id,'price_metr_id','price_metr_name'); ?><br />
								</td>
							</tr>	
						</tbody>
					</table>
					<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color'>	
							<tr>
								<th class="col-md-3 text-center">Адрес</th>
								<th class="col-md-3 text-center">Регион</th>
								<th class="col-md-2 text-center">Отделка</th>
								<th class="col-md-2 text-center">Кол-во комнат</th>
								<th class="col-md-2 text-center"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-3 text-center"><?php echo create_input_for_filter('apartment_adress',""); ?></td>
								<td class="col-md-3 text-center">
									<?php echo create_select_for_filter('city_id',"","",$city_id,'city_id','city_name'); ?><br /></td>
								<td class="col-md-2 text-center">
									<?php echo create_select_for_filter('otdelka_id',"","",$otdelka_id,'otdelka_id','otdelka_name'); ?><br />
								</td>
								<td class="col-md-2 text-center">
									<?php $otdel_id ?>
									<?php echo create_select_for_filter('quantity_rooms_id',"","",$quantity_rooms_id,'quantity_rooms_id','quantity_rooms_name'); ?><br />
								</td> 
								<td class="col-md-2 text-center"><button type='submit' name='add_apartment' value='true' class='btn btn-success center-block'><i class='icon icon-ok icon-white'></i>Добавить</button></td>
							</tr>	
						</tbody>
					</table>
				</form>

				<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
					<p class="text-center" style="font-size: 21px;">Фильтр по пользователям</p>
					<form method='get' action=''>
						<div class="col-md-3"><?php echo create_select_for_filter('city_id1',"По городу","Выберите город",$city_id,'city_id','city_name'); ?></div>
						<div class="col-md-3"><?php echo create_select_for_filter('developers_id1',"По застройщику","Выберите застройщика",$developers_id,'developers_id','developers_name'); ?></div>
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
							<th class="col-md-2">Цена</th>
							<th class="col-md-2">Город</th>
							<th class="col-md-2">Кл-во кв.метров</th>
							<th class="col-md-2">Застройщик</th>
							<th class="col-md-2">Кто добавил</th>
						</tr>
					</thead>
					<tbody>
						<?php $i = 0; foreach ($apartments as $items) { ?>
						<tr>
							<td class="col-md-2"><a href="<?php echo url_apartment().$items['apartment_id']; ?>"><?php echo $items['apartment_name']; ?></a></td>
							<td class="col-md-2"><?php echo $items['price_name']; ?></td>
							<td class="col-md-2"><?php echo $items['city_name']; ?></td>
							<td class="col-md-2"><?php echo $items['apartment_ploshad']; ?></td>
							<td class="col-md-2"><?php echo $items['developers_name']; ?></td>
							<td class="col-md-2"><?php echo $items['user_name']; ?></td>
						</tr>
						<?php } ?>
					</tbody>
				</table>
				<?php if (! $apartments) { ?>
				<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
				<?php } ?>

			</div>
		</div>
	</div>
</div>

<?php } ?>
