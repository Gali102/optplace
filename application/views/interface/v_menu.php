<?php //params
	$u_s = $this->session->userdata['user_status_maj'];

	$dis = $this->session->userdata['user_status_maj'] >= 7; // разрешено для всех
	$dis1 = $this->session->userdata['user_status_maj'] != 1;
?>

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		<div class="col-md-12" style="border-bottom: 1px solid silver; background-color: #3c8dbc;">
			<a href="/index.php/glavnaya">
				<p style="text-align: center; margin: 1rem auto; color: #fff;">
					СИСТЕМА ПЛАНИРОВАНИЯ И УЧЁТА ДЕЯТЕЛЬНОСТИ ОРГАНИЗАЦИИ
				</p>
			</a>
		</div> 
		<div class="col-md-12" style="border-bottom: 1px solid silver;">
			<div class="row" style="">
				<div class="col-md-12" >
					<div class="col-md-2"> 
						<ul class="center-block text-center" style="list-style-type: none;">	
							<li style="margin-top: 5px;">
								<a href="/index.php/zayavki"><button type="button" class="btn btn-info btn-block">Заявки</button></a>
							</li>
							<li style="margin-top: 3px;">
								<a href="/index.php/developers"><button type="button" class="btn btn-info btn-block">Застройщики</button></a>
							</li>
							<li style="margin-top: 3px;">
								<a href="/index.php/apartments"><button type="button" class="btn btn-info btn-block">Квартиры</button></a>
							</li>
							<!-- <li style="margin-top: 3px;">
								<a href="<?php echo url_event_vazhnoe() ?>"><button type="button" class="btn btn-info btn-block">Отчеты</button></a>
							</li> -->
						</ul>
					</div>					
					<div class="col-md-3">
						<ul class="center-block text-center" style="list-style-type: none;">	
							<?php  if ($u_s != 6) { ?>
							<li style="margin-top: 5px;">
								<a href="<?php echo url_events() ?>"><button type="button" class="btn btn-info btn-block">Задачи</button></a>
							</li>
							<?php } ?>
							<li style="margin-top: 3px;">
								<a href="<?php echo url_events_all() ?>"><button type="button" class="btn btn-info btn-block">Все задачи</button></a>
							</li>
							<li style="margin-top: 3px;">
								<a href="<?php echo url_event_today() ?>"><button type="button" class="btn btn-info btn-block">Задачи на сегодня</button></a>
							</li>
							<li style="margin-top: 3px;">
								<a href="<?php echo url_event_vazhnoe() ?>"><button type="button" class="btn btn-info btn-block">Важные задачи</button></a>
							</li>
						</ul>
					</div>
					<?php  if ($u_s == 1 or $u_s == 2) { ?>
					<div class="col-md-3">
						<ul class="center-block text-center" style="list-style-type: none;">	
							<li style="margin-top: 5px;">
								<a href="/index.php/users"><button type="button" class="btn btn-info btn-block">Пользователи</button> </a>
							</li>
							<li style="margin-top: 3px;">
								<a href="/index.php/add_otd"><button type="button" class="btn btn-info btn-block">Отделы</button> </a>
							</li>
							<li style="margin-top: 3px;">
								<a href="/index.php/add_dolzhnost"><button type="button" class="btn btn-info btn-block">Должности</button> </a>
							</li>
						</ul>
					</div>
					<?php } ?>
					<div class="col-md-2">
						<ul class="center-block text-center" style="list-style-type: none;">	
							<li style="margin-top: 5px;">
								<a href="<?php echo url_files() ?>"><button type="button" class="btn btn-info btn-block">Файлы</button></a>
							</li>
							<li style="margin-top: 3px;">
								<a href="<?php echo url_calendar() ?>"><button type="button" class="btn btn-info btn-block">Календарь</button> </a>
							</li>
							<li style="margin-top: 3px;">
								<a href="<?php echo url_mymail() ?>"><button type="button" class="btn btn-info btn-block">Почта</button> </a>
							</li>
							<li style="margin-top: 3px;">
								<a href="<?php echo url_chat() ?>"><button type="button" class="btn btn-info btn-block">Чат</button> </a>
							</li>
						</ul>
					</div>
					<div class="col-md-2">
						<ul class="center-block text-center" style="list-style-type: none;">	
							<li style="margin-top: 5px;">
								<a href="<?php echo url_profil().$this->session->userdata('user_id') ?>"><button type="button" class="btn btn-success btn-block">Профиль</button></a>
							</li>
							<li style="margin-top: 3px;">
								<a href="/index.php/auth/user_exit"><button type="button" class="btn btn-danger btn-block">Выход</button></a>
							</li>
						</ul>
					</div>
				</div>
			</div>

		</div>
		
	</div>
</div>


