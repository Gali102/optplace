<?php //params
$u_s = $this->session->userdata['user_status_maj'];

$dis = true;

?>


<!-- /////////////////////////////////// Администратор /////////////////////////////////// -->
<?php  if ($u_s == 1) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">

		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все важные задачи</p>
					
			<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
				<p class="text-center" style="font-size: 21px;">Фильтр по важным заданиям</p>
				<form method='get' action=''>
					<div class="col-md-4"><?php echo create_select_for_filter('user_id1','По исполнителю',$user_id1,$user_names,'user_id','user_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('finished_id1',"По факту исполнения",$finished_id1,$finished_id,'finished_id','finished_name'); ?></div>
					<div class="col-md-4" style="margin-top: 33px;">
						<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					    <button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
					</div>
				</form>
			</div>

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
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events1 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?> <?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?></a></td>
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
			<?php echo $pag_links1;?>

		</div>
	</div>
</div>
<?php } ?>



<!-- /////////////////////////////////// Директор /////////////////////////////////// -->
<?php if ($u_s == 2) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все важные задачи</p>
					
			<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
				<p class="text-center" style="font-size: 21px;">Фильтр по важным заданиям</p>
				<form method='get' action=''>
					<div class="col-md-4"><?php echo create_select_for_filter('user_id1','По исполнителю',$user_id1,$user_names,'user_id','user_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('finished_id1',"По факту исполнения",$finished_id1,$finished_id,'finished_id','finished_name'); ?></div>
					<div class="col-md-4" style="margin-top: 33px;">
						<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					    <button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
					</div>
				</form>
			</div>

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
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events2 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?> <?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?></a></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['user_id']]['user_name'] ?></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['events_user_id_isp']]['user_name'] ?></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events2) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>
			<?php echo $pag_links2;?>
			
		</div>
	</div>
</div>
<?php } ?>





<!-- /////////////////////////////////// Зам.директора /////////////////////////////////// -->
<?php if ($u_s == 3) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все важные задачи</p>
					
			<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
				<p class="text-center" style="font-size: 21px;">Фильтр по важным заданиям</p>
				<form method='get' action=''>
					<div class="col-md-4"><?php echo create_select_for_filter('user_id1','По исполнителю',$user_id1,$user_names,'user_id','user_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('finished_id1',"По факту исполнения",$finished_id1,$finished_id,'finished_id','finished_name'); ?></div>
					<div class="col-md-4" style="margin-top: 33px;">
						<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					    <button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
					</div>
				</form>
			</div>

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
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events3 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?> <?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?></a></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['user_id']]['user_name'] ?></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['events_user_id_isp']]['user_name'] ?></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events3) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>
			<?php echo $pag_links3;?>

		</div>
	</div>
</div>
<?php } ?>







<!-- /////////////////////////////////// Нач.отдела /////////////////////////////////// -->
<?php if ($u_s == 4) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все важные задачи</p>
					
			<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
				<p class="text-center" style="font-size: 21px;">Фильтр по важным заданиям</p>
				<form method='get' action=''>
					<div class="col-md-4"><?php echo create_select_for_filter('user_id1','По исполнителю',$user_id1,$user_names,'user_id','user_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('finished_id1',"По факту исполнения",$finished_id1,$finished_id,'finished_id','finished_name'); ?></div>
					<div class="col-md-4" style="margin-top: 33px;">
						<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					    <button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
					</div>
				</form>
			</div>

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
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events4 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?> <?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?></a></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['user_id']]['user_name'] ?></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['events_user_id_isp']]['user_name'] ?></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events4) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>
			<?php echo $pag_links4;?>

		</div>
	</div>
</div>
<?php } ?>




<!-- /////////////////////////////////// Зам.Нач.отдела /////////////////////////////////// -->
<?php if ($u_s == 5) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все важные задачи</p>
					
			<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
				<p class="text-center" style="font-size: 21px;">Фильтр по важным заданиям</p>
				<form method='get' action=''>
					<div class="col-md-4"><?php echo create_select_for_filter('user_id1','По исполнителю',$user_id1,$user_names,'user_id','user_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('finished_id1',"По факту исполнения",$finished_id1,$finished_id,'finished_id','finished_name'); ?></div>
					<div class="col-md-4" style="margin-top: 33px;">
						<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					    <button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
					</div>
				</form>
			</div>

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
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events5 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?> <?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?></a></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['user_id']]['user_name'] ?></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['events_user_id_isp']]['user_name'] ?></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events5) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>
			<?php echo $pag_links5;?>

		</div>
	</div>
</div>
<?php } ?>





<!-- /////////////////////////////////// Менеджер /////////////////////////////////// -->
<?php if ($u_s == 6) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все важные задачи</p>
					
			<div class='col-md-12' style="border: 1px solid silver; background-color: silver; margin-top: 25px; margin-bottom: 25px; padding-top: 25px; padding-bottom: 25px; ">
				<p class="text-center" style="font-size: 21px;">Фильтр по важным заданиям</p>
				<form method='get' action=''>
					<div class="col-md-4"><?php echo create_select_for_filter('user_id1','По исполнителю',$user_id1,$user_names,'user_id','user_name'); ?></div>
					<div class="col-md-4"><?php echo create_select_for_filter('finished_id1',"По факту исполнения",$finished_id1,$finished_id,'finished_id','finished_name'); ?></div>
					<div class="col-md-4" style="margin-top: 33px;">
						<button style="float: right;" type='submit' id='submit_filter' class='btn btn-success' value='true'>Применить фильтр</button>
					    <button style="float: right;  margin-right: 11px;" type='submit' id='cancel_filter' class='btn' value='true'>Убрать фильтр</button> 
					</div>
				</form>
			</div>

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
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events6 as $items) { ?>
					<tr>
						<td class="col-md-3 text-center"><a href="<?php echo url_event().$items['event_id']; ?>"><?php echo $items['event_name']; ?> <?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?></a></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['user_id']]['user_name'] ?></td>
						<td class="col-md-3 text-center"><?= $users_data[$items['events_user_id_isp']]['user_name'] ?></td>
						<td class="col-md-2 text-center"><?php echo date('d.m.Y',$items['n_date']); ?></td>
						<td class="col-md-2 text-center"><?php echo $items['events_status_name']; ?></td>
						<td class="col-md-2 text-center"><?php echo $items['finished_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $events6) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>
			<?php echo $pag_links6;?>

		</div>
	</div>
</div>
<?php } ?>