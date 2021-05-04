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
					<?php foreach ($zayavka as $items) { ?>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color' >
							<tr>
								<th class="col-md-4 text-center">Дата добавления</th>
								<th class="col-md-4 text-center">Регион</th>
								<th class="col-md-4 text-center">Кто добавил</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-4 text-center">
									<?php echo add_form_input_date('n_date','', $items['n_date'],1,100,150,$dis) ?>	
								</td>
								<td class="col-md-4 text-center">
									<?php echo add_form_select('city_id',"",$items['city_id'],$city_id,'city_id','city_name',0,$dis1); ?>
								</td>
								<td class="col-md-4 text-center">
									<?php echo add_form_select('user_id',"",$items['user_id'],$user_id,'user_id','user_name',0,$dis1); ?>
								</td>
							</tr>
						</tbody>
						</table>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color'>	
							<tr>
								<th class="col-md-4 text-center">Квартира</th>
								<th class="col-md-4 text-center">Статус</th>
								<th class="col-md-4 text-center"></th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-3 text-center">
									<?php echo add_form_select('apartment_id',"",$items['apartment_id'],$apartment_id,'apartment_id','apartment_name',0,$dis1); ?>
								</td>
								<td class="col-md-3 text-center">
									<?php echo add_form_select('status_zayavki_id',"",$items['status_zayavki_id'],$status_zayavki_id,'status_zayavki_id','status_zayavki_name',0,$dis1); ?>
								</td> 
								<td class="col-md-3 text-center">
									<?php if (! $dis) { ?>
										<button type='submit' style="margin-top: 1px;" class='btn btn-success'
											name='update_zayavka' value='true'>Обновить</button>
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


