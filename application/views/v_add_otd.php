<?php //params
	$u_s = $this->session->userdata['user_status_maj'];
?>


<!-- /////////////////////////////////// Администратор /////////////////////////////////// -->
<?php  if ($u_s == 1 or $u_s == 2) { ?>

<div class="container-fluid">
	<div class="row">

		<?php  include 'interface/v_menu.php'; ?>
		
		</div>
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
				<h3 class="text-center">Добавить отдел</h3>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>
			<form action='' method='POST'>
				<table class='div-margin-top table table-condensed table-striped table-hover'>
					<thead class='thead-color' >
						<tr>
							<th class="col-md-9 text-center">Название отдела</th>
							<th class="col-md-3 text-center"></th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-9"><?php echo create_input_for_filter('otdel_name',""); ?></td>
							<td class="col-md-3"><button type='submit' name='add_org' value='true' class='btn btn-success center-block'><i class='icon icon-ok icon-white'></i>Добавить</button></td>
						</tr>
					</tbody>
				</table>
			</form>
			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-6 text-center">Название отдела</th>
					</tr>
				</thead>
				<tbody>
					<?php foreach ($otdel_name as $items) { ?>
					<tr>
						<td class="col-md-12 text-center"><?php echo $items['otdel_name']; ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $otdel_name) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>

		</div>
	</div>
</div>
<?php } ?>


