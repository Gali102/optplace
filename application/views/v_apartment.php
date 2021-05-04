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
					Данные о квартире успешно обновлены!
				</div>
				<?php } ?>

				<?php if (!validation_errors() && $btn_click) { ?>
					<meta http-equiv="refresh" content="1">
				<?php } ?>
			</div>
			<div class="col-md-12 row">
				<div class="col-md-12">
					<h3 class="text-center">Редактирования квартиры</h3>
					<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
				</div>
				<form action='' class='col-md-12' method='POST' enctype="multipart/form-data">
					<?php foreach ($apartments as $items) { ?>
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
								<td class="col-md-6 text-center">
									<?php echo add_form_input('apartment_name','',$items['apartment_name'],0,100,150,$dis); ?></td>
								<td class="col-md-3 text-center">
									<?php echo add_form_select('developers_id',"",$items['developers_id'],$developers_id,'developers_id','developers_name',0,$dis1); ?>
								</td>
								<td class="col-md-3 text-center">
									<?php echo add_form_select('user_id',"",$items['user_id'],$user_id,'user_id','user_name',0,$dis1); ?>
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
									<?php echo add_form_input('apartment_ploshad','',$items['apartment_ploshad'],0,100,150,$dis); ?>
								<td class="col-md-3 text-center">
									<?php echo add_form_select('finish_year_id',"",$items['finish_year_id'],$finish_year_id,'finish_year_id','finish_year_name',0,$dis1); ?>
								</td>
								<td class="col-md-3 text-center">
									<?php echo add_form_select('price_id',"",$items['price_id'],$price_id,'price_id','price_name',0,$dis1); ?>
								</td> 
								<td class="col-md-3 text-center">
									<?php echo add_form_select('price_metr_id',"",$items['price_metr_id'],$price_metr_id,'price_metr_id','price_metr_name',0,$dis1); ?>
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
								<td class="col-md-3 text-center">
									<?php echo add_form_input('apartment_adress','',$items['apartment_adress'],0,100,150,$dis); ?>
								</td>
								<td class="col-md-3 text-center">
									<?php echo add_form_select('city_id',"",$items['city_id'],$city_id,'city_id','city_name',0,$dis1); ?></td>
								<td class="col-md-2 text-center">
									<?php echo add_form_select('otdelka_id',"",$items['otdelka_id'],$otdelka_id,'otdelka_id','otdelka_name',0,$dis1); ?>
								</td>
								<td class="col-md-2 text-center">
									<?php echo add_form_select('quantity_rooms_id',"",$items['quantity_rooms_id'],$quantity_rooms_id,'quantity_rooms_id','quantity_rooms_name',0,$dis1); ?>
								</td> 
								<td class="col-md-2 text-center">
									<?php if (! $dis) { ?>
										<button type='submit' style="margin-top: 1px;" class='btn btn-success'
											name='update_apartment' value='true'>Обновить</button>
									<?php } ?>
								</td>
							</tr>	
						</tbody>
						</table>
					<?php } ?>					
				</form>
			</div>

		</div>
	</div>
</div>


