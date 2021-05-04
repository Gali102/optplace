<?php //params
	$u_s = $this->session->userdata['user_status_maj'];

	$dis = true;
?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>
		
		<div class="col-md-12" style="float: right; margin-bottom: 500px;">
			<div class="col-md-12">
				<form action='' class='col-md-12' method='POST'>
					<?php foreach ($mymail1 as $items) { ?>
						<div class="col-md-12" style="margin-top: 21px">
							<p class="text-left" style="font-size: 25px; ">
								<?php echo $items['name_mail']; ?>
							</p>
							<p></p>
						</div>

						<hr class="col-md-12" style="width: 100%; border-top: 1px solid black; ">

						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
								    <th class="col-md-4 text-center">Название сообщения</th>
									<th class="col-md-4 text-center">Дата отправки</th>
									<th class="col-md-4 text-center">Отправитель</th>
								</tr>
							</thead>
							<tbody>
								<tr>
									<td class="col-md-4"><?php echo add_form_input('name_mail','',$items['name_mail'],1,100,150,$dis); ?></td>
									<td class="col-md-4"><?php echo add_form_input_date('','',date('d.m.Y',$items['date_otpr']),1,100,150,$dis) ?></td>
									<td class="col-md-4"><?php echo add_form_input('user_name','',$items['user_name'],1,100,150,$dis); ?></td>
								</tr>
							</tbody>
						</table>
						<table class='div-margin-top table table-condensed table-striped table-hover'>
							<thead class='thead-color' >
								<tr>
									<?php if($items['file']) : ?>
										<th class="col-md-8 text-center">Текст сообщения</th>
										<th class="col-md-4 text-center">Прикреплённые файлы</th>
									<?php else : ?>
										<th class="col-md-12 text-center">Текст сообщения</th>
									<?php endif; ?>
								</tr>
							</thead>
							<tbody>
								<tr>
									<?php if($items['file']) : ?>
										<td class="col-md-8"><?php echo add_form_text('text_mail','',$items['text_mail'],1,100,5,$dis); ?></td>
										<td class="col-md-4">
										<?php foreach(explode('|', $items['file']) as $file) : ?>
											<a href="/files/<?= $file ?>" download><?= $file ?></a>
										<?php endforeach; ?>
									<? else : ?>
										<td class="col-md-12"><?php echo add_form_text('text_mail','',$items['text_mail'],1,100,5,$dis); ?></td>
									<?php endif; ?>
								</tr>
							</tbody>
						</table>
						<?php //print_r($items); ?>
					<?php } ?>
				</form>

				<hr class="col-md-12" style="margin-top: 30px; margin-bottom: 30px; border-top: 1px solid silver">

				<form class="col-md-12" action='/index.php/mymail/index/<?= $items['poluchatel_id'] ?>' method='POST' enctype="multipart/form-data">
					<h2>Ответить</h2>
					
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
								<td class="col-md-2"><?php echo add_form_input('','',date('d.m.Y'),1,100,150,$dis); ?></td>
								<td class="col-md-4"><?php echo create_input_for_filter('name_mail',""); ?></td>
								<td class="col-md-4"><?php 
									if ($u_s < 7) {
										echo add_form_select('poluchatel_id','',$items['user_id'],$user_names,'user_id','user_name',0,0); 
										//$id,$name,$val,$data,$val_id,$val_name,$required,$dis = 0
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
									<button class='btn btn-success' type='submit' name='add_event' value='true'>Добавить</button>
									<input type="hidden" name="back_to" value="<?= $_SERVER['REQUEST_URI'] ?>">
								</td>
							</tr>	
						</tbody>
					</table>
				</form>
			</div>
		</div>
	</div>
</div>