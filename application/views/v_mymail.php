<?php //params
$u_s = $this->session->userdata['user_status_maj'];

$dis = true;
?>

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
				Сообщение успешно отправлено!
			</div>
			<?php } ?>

			<?php if (!validation_errors() && $btn_click) { ?>
				<meta http-equiv="refresh" content="1">
			<?php } ?>
		</div>
		<div class="col-md-12" style="float: right; margin-bottom: 700px;">
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
							<th class="col-md-2 text-center">Дата отправки</th>
							<th class="col-md-4 text-center">Название сообщения</th>
							<th class="col-md-4 text-center">Получатель</th>
							<th class="col-md-2 text-center">Кто отправляет</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td class="col-md-2"><?php echo add_form_input('','',date('d.m.Y'),1,100,150,!$dis); ?></td>
							<td class="col-md-4"><?php echo create_input_for_filter('name_mail',""); ?></td>
							<td class="col-md-4"><?php 
								if ($u_s < 7) {
									echo create_select_for_filter('poluchatel_id','','',$user_names,'user_id','user_name'); 
								}
								else {
									echo $this->session->userdata['user_name'];
									echo "<input type='hidden' name='user_id' value='".$this->session->userdata['user_id']."' />";
								}
								?>
							</td>
							<td class="col-md-2 text-center">
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
							<th class="text-center">Текст сообщения</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>
								<textarea name='text_mail' id='text_mail' class='col-md-12' rows='5' cols="100%"></textarea> 
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
								<button class='btn btn-success' type='submit'>Добавить</button>
								<input type="hidden" name='add_event' value='1'>
							</td>
						</tr>	
					</tbody>
				</table>
			</form>

			<hr style="width: 90%; margin-left: 5%; margin-top: 41px; margin-bottom: 41px; border-top: 1px solid silver">
					
			<p style="font-size: 19px; text-align: center;">Сообщения</p>

			<table class='div-margin-top table table-condensed table-striped table-hover'>
				<thead class='thead-color'>
					<tr>
						<th class="col-md-4 text-center">Название сообщения</th>
						<th class="col-md-4 text-center"></th>
						<th class="col-md-4 text-center">Дата отправки</th>
					</tr>
				</thead>
				<tbody id='t_clients'>
					<?php $today = mktime(0,0,0); 
					foreach ($allmy as $items) { ?>
					<tr>
						<!-- <td class="col-md-4 text-center"><a href='#change_mail1' id='change_mail1_<?php echo $items['mail_id']; ?>' class='change_mail1' data-toggle='modal'><?php echo $items['name_mail']; ?></a></td> -->

						<td class="col-md-4 text-center"><a href="<?php echo url_mymail1().$items['mail_id']; ?>">
							<?php echo $items['name_mail']; ?>
							<?= $items['file'] ? '<i class="fa fa-file"></i>' : '' ?>
						</a></td>
						<td class="col-md-4 text-center mail-dir-<?= $items['dir'] ?>"><?= $items['dir'] ? '&larr;' : '&rarr;' ?> <?php echo $items['user_name']; ?></td>
						<td class="col-md-4 text-center"><?php echo date('d.m.Y H:i:s',$items['date_otpr']); ?></td>
					</tr>
					<?php } ?>
				</tbody>
			</table>
			<?php if (! $allmy) { ?>
			<div id='find_message' class='alert alert-info'>Ничего не найдено</div>
			<?php } ?>
			<?php echo $pag_links;?>		
		</div>
	</div>
</div>