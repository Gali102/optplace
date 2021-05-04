<div class='row'>
	<?php error_reporting(0); ?>
	
	<div class="well pull-left padding-min span12">
		<ul class="nav nav-pills no-margin">
			<li <?php echo ($active===1) ? "class='active'" : '' ?>><a href="<?php echo url_client().$client_id ?>">Личная карта</a></li>
			<li <?php echo ($active===2) ? "class='active'" : '' ?>><a href="<?php echo url_car().$client_id ?>">Транспортное средство</a></li>
			<li <?php echo ($active===3) ? "class='active'" : '' ?>><a href="<?php echo url_c_dela().$client_id ?>">Все дела</a></li>
			
			<?php if ($delo_id) { ?>
				<li <?php echo ($active===5) ? "class='active'" : '' ?>><a href="<?php echo url_delo().$delo_id.'/'.$client_id; ?>">Дело № <?php echo $delo_name; ?></a></li>
				<li <?php echo ($active===6) ? "class='active'" : '' ?>><a href="<?php echo url_c_talks().$delo_id.'/'.$client_id; ?>">Переговоры</a></li>
			<?php } ?>
			<?php if ($this->session->userdata('user_status') == 1 || $this->session->userdata('user_status') == 2 || $this->session->userdata('user_status') == 5){ ?> 
			<li <?php echo ($active===4) ? "class='active'" : '' ?>><a href="<?php echo url_pauments().$client_id ?>">Платежи</a></li>
			<?php } ?>
		</ul>
	</div>
	<?php error_reporting(E_ALL); ?> 
</div>




