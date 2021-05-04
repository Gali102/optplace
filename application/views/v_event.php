<?php //params
	$u_s = $this->session->userdata['user_status_maj'];
	$u_i = $this->session->userdata['user_id'];

	$dis = true;

	if($event[0]['user_id'] == $u_i || $u_s == 1) {
		$dis = false;
	}

	$otvety_allowed = in_array($u_i, [
		$event[0]['user_id'],
		$event[0]['events_user_id_isp']
	]);
?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>	

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class='col-md-12' style="float: right;">
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
					Данные успешно обновлены!
				</div>
				<?php } ?>

				<?php if (!validation_errors() && $btn_click) { ?>
					<meta http-equiv="refresh" content="1">
				<?php } ?>
			</div>
			<div class="col-md-12">
				<form action='' class='col-md-12' method='POST' enctype="multipart/form-data">
					<?php foreach ($event as $items) { ?>

						<div class="col-md-12" style="margin-top: 21px">
							<p class="text-left" style="font-size: 25px; ">
								<?php echo $items['event_name']; ?>
							</p>
							<p></p>
						</div>

						<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">

						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
								    <th class="col-md-3 text-center">Название задания</th>
									<th class="col-md-2 text-center">Статус</th>
									<th class="col-md-2 text-center">Дата начала</th>
									<th class="col-md-2 text-center">Дата контроля</th>
									<th class="col-md-3 text-center">Ответственный</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-3"><?php echo add_form_input('event_name','',$items['event_name'],1,100,150,$dis); ?></td>
									<td class="col-md-2"><?php echo add_form_select('events_status_id',"",$items['events_status_id'],$events_status_id,'events_status_id','events_status_name',0,$dis); ?></td>
									<td class="col-md-2"><?php echo add_form_input_date('','',date('d.m.Y',$items['nach_date']),1,100,150,$dis) ?></td>
									<td class="col-md-2"><?php echo add_form_input_date('n_date','',date('d.m.Y',$items['n_date']),1,100,150,$dis); ?></td>
									<td class="col-md-3"><?php echo add_form_select('events_user_id_isp',"",$items['events_user_id_isp'],$user_id,'user_id','user_name',0,$dis); ?></td>
								</tr>
							</tbody>
						</table>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
								    <th class="col-md-7 text-center">Текст задания</th>
									<th class="col-md-5 text-center">Комментарий задания</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-7"><?php echo add_form_text('event_text','',$items['event_text'],1,100,5,$dis); ?></td>
									<td class="col-md-5"><?php echo add_form_text('comments','',$items['comments'],1,100,5,$dis); ?></td>
								</tr>
							</tbody>
						</table>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
								    <th class="col-md-5 text-center">Файл</th>
									<th class="col-md-4 text-center">Статус</th>
									<th class="col-md-3 text-center"></th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-5">
										<p><input class="" type="file" name="files[]" id="file" multiple style="display: inline-block; margin-top: 15px; font-size: 1em; "></p>
										<?php if($items['file']) : ?>
											<?php foreach(explode('|', $items['file']) as $file) : ?>
												<a href="/files/<?= $file ?>" download><?= $file ?></a>
											<?php endforeach; ?>
										<?php endif; ?>
									</td>
									<td class="col-md-4">
										<?= add_form_select('finished_id',"",$items['finished_id'],$finished_id,'finished_id','finished_name',0,$dis) ?>
									</td>
									<td class="col-md-3 text-center">
										<?php { ?>
											<button type='submit' class='btn btn-success' name='update_event' value='true'>Сохранить</button>
										<?php } ?>
									</td>
								</tr>
							</tbody>
						</table>

						<hr style="width: 90%; margin-left: 5%; margin-top: 111px; margin-bottom: 11px; border-top: 1px solid silver">
						
					<?php } ?>
				</form>

				<!-- Ответ к заданию -->

				<?php if($otvety_allowed) : ?>

				<div class="col-md-12" style="margin-top: 21px">
					<p class="text-left" style="font-size: 25px;">Ответы к заданию</p>
				</div>

				<form action='/index.php/event/otvet/<?= $event[0]['event_id'] ?>' class='col-md-12' method='POST' enctype="multipart/form-data">
					<table class='div-margin-top table table-condensed table-striped table-hover' style="margin-top: 27px;">
						<thead class='thead-color'>
							<tr>
								<th class="col-md-2 text-center">Дата</th>
								<th class="col-md-2 text-center">Получатель</th>
								<th class="col-md-6 text-center">Текст</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td class="col-md-2">
									<?php echo add_form_input('','',date('d.m.Y H:i'),1,100,150,$dis); ?>
								</td>
								<!--<td class="col-md-2"><?php echo add_form_select('user_poluch',"",$items['events_user_id_isp'],$user_id,'user_id','user_name',0); ?></td>-->
								<td>
								<?php
									$user_poluch = $event[0]['events_user_id_isp'];
									if($u_i == $event[0]['events_user_id_isp']) {
										$user_poluch = $event[0]['user_id'];
									}
								?>
								<input type="text" class="form-text" value="<?= $users_data[$user_poluch]['user_name'] ?>" disabled>
								<input type="hidden" name="user_poluch" value="<?= $user_poluch ?>">
								</td>
								<td class="col-md-8">
									<?php echo add_form_text('otvet_text','','',1,100,5); ?>
									<input class="" type="file" name="files[]" id="file" multiple style="display: inline-block; font-size: 1em; "></p>
									<button class='btn btn-success' type='submit' name='add_event' value='true'>Отправить</button>
								</td>
							</tr>
						</tbody>
					</table>
				</form>
				<div class="col-md-12">
					<table class='div-margin-top table table-condensed table-striped table-hover'>
						<thead class='thead-color'>
							<tr>
								<th class="col-md-2">Отправлено</th>
								<th class="col-md-2">От</th>
								<th class="col-md-2">Для</th>
								<th class="col-md-6">Текст</th>
							</tr>
						</thead>
						<tbody>
							<?php foreach ($events_otvet as $items) { ?>
							<?php
								$class = 'mail-dir-0';
								$before = '';
								if($items['user_id'] == $this->session->userdata['user_id']) {
									$class = '';
									$before = '&larr;';
								}
								if($items['user_poluch'] == $this->session->userdata['user_id']) {
									$class = 'mail-dir-1';
									$before = '&rarr;';
								}	
							?>
							<tr class="<?= $class ?>">
								<td class="col-md-2"><?php echo date('d.m.Y H:i:s',$items['izm_date']); ?></td>
								<td class="col-md-2 nowrap">
									<?= $before ?>
									<?= $items['user_id'] == $event[0]['user_id'] ? '<i class="fa fa-star"></i>' : '' ?>
									<?= $items['user_id'] == $event[0]['events_user_id_isp'] ? '<i class="fa fa-briefcase"></i>' : '' ?>
									<?= $users_data[$items['user_id']]['user_name'] ?>
								</td>
								<td class="col-md-2 nowrap">
									<?= $items['user_poluch'] == $event[0]['user_id'] ? '<i class="fa fa-star"></i>' : '' ?>
									<?= $items['user_poluch'] == $event[0]['events_user_id_isp'] ? '<i class="fa fa-briefcase"></i>' : '' ?>
									<?= $users_data[$items['user_poluch']]['user_name'] ?>
								</td>
								<td class="col-md-6">
									<?php echo nl2br($items['otvet_text']); ?>
									<?php if($items['file']) : ?>
										<?php foreach(explode('|', $items['file']) as $file) : ?>
											<a href="/files/<?= $file ?>" download><?= $file ?></a>
										<?php endforeach; ?>
									<?php endif; ?>
								</td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
					<?= $pag_links ?>
				</div>

				<?php endif; // otvety_allowed ?>

			</div>
		</div>
	</div>
</div>