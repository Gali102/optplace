
<div class="row">
	<div class="col-md-4"></div>
	<div class="col-md-4 text-center" style="margin-bottom: 11%; margin-top: 110px; background-color: rgba(255, 255, 255,0.85); padding-top: 30px; padding-bottom: 30px; border-radius: 7px;" >
		<h2 style="margin-bottom: 25px;" class="h2_auth">Авторизация</h2>
			<?php echo validation_errors(); ?>
			<?php if ($auth_error) {
				echo "<h3>$auth_error</h3>";
			}
			?>
		<form action='' method='POST'>
			<div id="auth" class="col-md-12">
				<div class="row">
				<div id="auth_login_label" class="col-md-2"><p style="margin-top: 12px; font-size: 17px; font-family:'Comfortaa';font-weight: bold;">Логин</p></div>
				<div id="auth_login_td" class="col-md-10" style="margin-bottom: 9px">
					<input type='text' id='auth_login' name='auth_login' style="padding: 10px; width: 100%; font-size: 17px; font-family:'Comfortaa'; border: 1px solid #3c8dbc; border-radius: 7px; ">
				</div>

				<div id="auth_pass_label" class="col-md-2" style="margin-top: 12px; font-size: 17px; font-family:'Comfortaa'; font-weight: bold;"><p>Пароль</p></div>
				<div id="auth_pass_td" class="col-md-10" style="margin-bottom: 25px">
					<input type='password' id='auth_pass' name='auth_pass' style="padding: 10px; width: 100%; font-size: 17px; font-family:'Comfortaa'; border: 1px solid #3c8dbc; border-radius: 7px; ">
				</div>
				</div>
			</div>
			<button type="submit" class='btn btn-lg btn-success' id='next_step'>Войти в систему</button>
		</form>
	</div>
	<div class="col-md-4"></div>
</div>


<div class="navbar-fixed-bottom row-fluid">
	<footer class="col-md-12 " style="">
		<div class="col-md-6 text-left" style="text-align: left">
			<p class="text-left">Copyright &copy; <?php   echo date("Y"); ?></b></p>
		</div>
		<div class="col-md-6 text-right" style="text-align: right">
			<strong style="text-align: right; font-size: 15px;">СИСТЕМА ПЛАНИРОВАНИЯ И УЧЁТА ДЕЯТЕЛЬНОСТИ ОРГАНИЗАЦИИ</strong>
		</div>
	</footer>
</div>

