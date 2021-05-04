		
	</div>
</div><!-- end .container -->
</div>  

<footer class="col-md-12" style="">
	<div class="container-fluid">
		<div class="row">
			<div class="col-md-6 text-left" style="text-align: left">
				<p class="text-left">Copyright &copy; <?php   echo date("Y"); ?></b></p>
			</div>
			<div class="col-md-6 text-right" style="text-align: right">
				<strong style="text-align: right; font-family:'Comfortaa'; font-size: 15px;">СИСТЕМА ПЛАНИРОВАНИЯ И УЧЁТА ДЕЯТЕЛЬНОСТИ ОРГАНИЗАЦИИ</strong>
			</div>
		</div>
	</div>
</footer>

<audio id="sound-alert" src="/sounds/message-new-instant.mp3"></audio>

<?php
	$u_s = $this->session->userdata['user_status_maj'];
	$u_i = $this->session->userdata['user_id'];
	$u_n = $this->session->userdata['user_name'];
?>

<input type="hidden" name="user_id" value="<?= $u_i ?>">
<input type="hidden" name="user_name" value="<?= $u_n ?>">

</body>
</html>