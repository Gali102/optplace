<?php //params
$u_s = $this->session->userdata['user_status_maj'];

$dis = true;

$actual_names = [];
foreach($user_names as $user_name) {
	if($user_name['user_status_maj'] >= $this->session->userdata['user_status_maj']) {
		$actual_names[] = $user_name;
	}
}

?>
<?php if($u_s != 6) { ?>
	
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; ">
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
				Успешно добавлено!
			</div>
			<?php } ?>

			<?php if (!validation_errors() && $btn_click) { ?>
				<meta http-equiv="refresh" content="1">
			<?php } ?>
		</div>
		<div class="col-md-12" style="float: right; margin-bottom: 200px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>
			<form action='' method='POST' enctype="multipart/form-data">
				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color' >
						<tr>
							<th class="col-md-2 text-center">Дата начала</th>
							<th class="col-md-3 text-center">Название задачи</th>
							<th class="col-md-2 text-center">Статус</th>
							<th class="col-md-2 text-center">Дата контроля</th>
							<th class="col-md-2 text-center">Ответственный</th>
							<th class="col-md-1 text-center">Кто задаёт</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-2"><?php echo add_form_input('','',date('d.m.Y'),1,100,150,!$dis); ?></td>
							<td class="col-md-3"><?php echo create_input_for_filter('event_name',""); ?></td>
							<td class="col-md-2"><?php echo create_select_for_filter('events_status_id',"","",$events_status,'events_status_id','events_status_name'); ?><br /></td>
							<td class="col-md-2"><?php echo create_input_for_filter('n_date',''); ?></td>
							<td class="col-md-2"><?php 
								if ($u_s < 6) {
									echo create_select_for_filter('events_user_id_isp','','',$actual_names,'user_id','user_name'); 
								}
								else {
									echo $this->session->userdata['user_name'];
									echo "<input type='hidden' name='user_id' value='".$this->session->userdata['user_id']."' />";
								}
								?>
							</td>
							<td class="col-md-1 text-center">
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
							<th class="col-md-7 text-center">Текст задания</th>
							<th class="col-md-4 text-center">Комментарий задания</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-7">
								<textarea name='event_text' id='event_text' class='col-md-12' rows='5' cols="100%"></textarea> 
							</td>
							<td class="col-md-4">
								<textarea name='comments' id='comments' class='col-md-12' rows='5' cols="100%"></textarea> 
							</td>
						</tr>	
					</tbody>
				</table>
				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color'>	
						<tr>
							<th class="col-md-10 text-center">Прикрепленные файлы</th>
							<th class="col-md-2 text-center"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-10">
								<input class="" type="file" name="files[]" id="file" multiple style="display: inline-block; margin-top: 15px; font-size: 1em; "> 
							</td>
							<td class="col-md-2 text-center">
								<button class='btn btn-success' type='submit' name='add_event' value='true'>Добавить</button>
							</td>
						</tr>	
					</tbody>
				</table>
			</form>

			<hr style="width: 90%; margin-left: 5%; margin-top: 41px; margin-bottom: 41px; border-top: 1px solid silver">
					
			<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
				<p class="text-center" style="font-size: 21px;">Фильтр по заданиям</p>
				<form method='get' action=''>
					<div class="col-md-4"><?php echo create_select_for_filter('user_id1','По исполнителю',$user_id1,$user_names,'user_id','user_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('events_status_id1',"По статусу задания",$events_status_id1,$events_status,'events_status_id','events_status_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('finished_id1',"По факту исполнения",$finished_id1,$finished_id,'finished_id','finished_name'); ?></div>

					<div class="col-md-12" style="margin-top: 15px;">
						<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					    <button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
					</div>
				</form>
			</div>


			<p style="font-size: 19px; text-align: center;">Все задачи</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-3 text-center">Название задания</th>
						<th class="col-md-3 text-center">Поставил</th>
						<th class="col-md-3 text-center">Исполнитель</th>
						<th class="col-md-2 text-center">Дата контроля</th>
						<th class="col-md-2 text-center">Статус</th>
						<th class="col-md-2 text-center">Исполнение</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php
					$today = mktime(0,0,0);

					switch($u_s) {
						case '1': { $events = $events1; $pag_links = $pag_links1; break; }
						case '2': { $events = $events2; $pag_links = $pag_links2; break; }
						case '3': { $events = $events3; $pag_links = $pag_links3; break; }
						case '4': { $events = $events4; $pag_links = $pag_links4; break; }
						case '5': { $events = $events5; $pag_links = $pag_links5; break; }
						case '6': { $events = $events6; $pag_links = $pag_links6; break; }
					}

					foreach ($events as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>">
							<?php echo $items['event_name']; ?>
							<?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?>
						</a></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['user_id']]['user_name'] ?></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['events_user_id_isp']]['user_name'] ?></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>


			<?php if (! $events1) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>
			
			<?php echo $pag_links;?>
		</div>
	</div>
</div>

<?php } ?>