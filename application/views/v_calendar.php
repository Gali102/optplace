<?php //params
$u_s = $this->session->userdata['user_status_maj'];

$dis = true;
?>

<script src="/fullcalendar/lib/moment.min.js"></script>
<script src="/fullcalendar/fullcalendar.min.js"></script>
<script src="/fullcalendar/locale/ru.js"></script>
<link rel="stylesheet" href="/fullcalendar/fullcalendar.min.css">

<div class="container-fluid" style="position: relative; min-height: 100%;">
	<div class="row">
		
		<?php  include 'interface/v_menu.php'; ?>

		<div class="col-md-12" style="float: right; margin-bottom: 1100px;">
			<div class="col-md-12">
				<p class="text-center">
					<ul id='main_navigation1' class="text-center" style="list-style-type: none;">
					</ul>
				</p>
				<hr style="width: 80%; margin-left: 10%; border-top: 1px solid black; ">
			</div>

			<div id="calendar"></div>
		
		</div>
	</div>
</div>


<script>
	$('#calendar').fullCalendar({
		events: <?= json_encode($events); ?>,
		allDayDefault: true
	});
</script>