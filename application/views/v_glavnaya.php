<?php //params
$u_s = $this->session->userdata['user_status_maj'];

$dis = true;
?>

<!-- /////////////////////////////////// Администратор /////////////////////////////////// -->


<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">

		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style=" margin-bottom: 500px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>
			
			<?php  if ($u_s == 1) { ?>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_events() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #dd4b39 !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Добавить задачу</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="/index.php/users" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #00c0ef !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Добавить пользователя</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="/index.php/add_org" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #00a65a !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Добавить отдел</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<?php } ?>

			<div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_event_today() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #f39c12 !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Задачи на сегодня</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_event_vazhnoe() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #dd4b39 !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Важные задачи</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_events_all() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #00c0ef !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Все задачи</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_files() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #00a65a !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Файлы</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_calendar() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #f39c12 !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Календарь</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_mymail() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #dd4b39 !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Моя почта</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div>
			<!-- <div class="col-lg-4" style="margin-top: 45px">
				<a href="<?php echo url_uvedomleniya() ?>" class="a text-center" style="color: #fff; text-align: center;">
					<div style="padding: 10px; background-color: #00c0ef !important;">
						<div style="margin-bottom: 31px; margin-top: 31px;">
							<p class="text-center" style="color: #fff; font-size: 1.5em;">Уведомления</p>
						</div>
						<div style="border-top: 1px solid #fff; padding-top: 15px;">
							<p class="text-center" style="font-size: 1.2em;">Перейти <i class="fa fa-arrow-circle-right"></i></p>
						</div>
					</div>
				</a>
			</div> -->
			
		</div>
	</div>
</div>

