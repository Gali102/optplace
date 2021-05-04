<?php //params
$u_s = $this->session->userdata['user_status_maj'];

$dis = true;

?>


<!-- /////////////////////////////////// Администратор /////////////////////////////////// -->
<?php  if ($u_s == 1 or $u_s == 1) { ?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 700px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все файлы</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название</th>
						<th class="col-md-4 text-center">От кого</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events2 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center">
							<?php foreach(explode('|', $items['file']) as $file) : ?>
								<a href="/files/<?= $file ?>" download><?= $file ?></a>
							<?php endforeach ?>
						</td>
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['nach_date']); ?></td>
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




<?php if ($u_s == 3 or $u_s == 4 or $u_s == 5 or $u_s == 6) { ?>
<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">

		<?php  include 'interface/v_menu.php'; ?>
		
		<div class="col-md-12" style="float: right; margin-bottom: 700px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<p style="font-size: 19px; text-align: center;">Все файлы</p>
					
			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название</th>
						<th class="col-md-4 text-center">От кого</th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody>
					<?php $today = mktime(0,0,0); 
					foreach ($events1 as $items) { ?>
					<tr>
						<td class="col-md-4 text-center">
							<?php foreach(explode('|', $items['file']) as $file) : ?>
								<a href="/files/<?= $file ?>" download><?= $file ?></a>
							<?php endforeach ?>
						</td>
						<td class="col-md-4 text-center"><?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y',$items['nach_date']); ?></td>
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

