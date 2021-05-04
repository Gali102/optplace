<!DOCTYPE html>
<html>
<head>
	<meta name="viewport" content="width=device-width, initial-scale=1.0"/>
	<meta http-equiv="content-type" content="text/html; charset=utf-8" />
	
	<title>СИСТЕМА ПЛАНИРОВАНИЯ И УЧЁТА ДЕЯТЕЛЬНОСТИ ОРГАНИЗАЦИИ</title>
	
	<link href="/css/bootstrap-responsive.css" rel="stylesheet"/>
	<link href="/css/bootstrap.css" rel="stylesheet"/>
	<link href="/css/chosen.css" rel="stylesheet"/>
	<link href="/css/style.css?v=4" rel="stylesheet"/>
	<link href="/css/bootstrap-personal.css" rel="stylesheet"/>
	<link href="/css/ui-lightness/jquery-ui-1.10.4.custom.css" rel="stylesheet"/>
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.5.0/css/font-awesome.min.css">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link href="https://fonts.googleapis.com/css?family=Comfortaa" rel="stylesheet">

	<script src="/js/jquery.min.js"></script>
	<script src="/js/main.js?v=4"></script>
	<script src="/js/bootstrap.js"></script>
	<script src="/js/customtabs.js"></script>
	<script src="/js/functions.js"></script>
	<script src="/js/jquery-ui-1.10.4.custom.js"></script>
	<script src="/js/jquery.ui.datepicker-ru.js"></script>
	<script src="/js/jquery.tablesorter.js"></script>
	<script src="/js/chosen.jquery.js"></script>
	<script>
		var USERID = <?= $this->session->userdata('user_id') ?>;
		$(function() {
			built_menu(<?php echo $this->session->userdata('user_status') ?>,'<?php echo $this->session->userdata('user_name') ?>'); 
		});
	</script>
</head>
<body>
	<div class="alert-stack"></div>
	<div id="content">
		<!-- <div class="container-fluid top-header">
			<div class="col-md-12 text-center" style="font-family:'Comfortaa';">СИСТЕМА ПЛАНИРОВАНИЯ И УЧЁТА ДЕЯТЕЛЬНОСТИ ОРГАНИЗАЦИИ</div>
		</div> -->

		<div class="container-fluid">
			<div class="row">