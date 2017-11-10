<!DOCTYPE html>
<?php
	include "fungsi_kakatu.php";
?>
<html>
	<head>
	  <meta charset="utf-8">
	  <meta http-equiv="X-UA-Compatible" content="IE=edge,initial-scale=1.0, user-scalable=no">
	  <title> Kinest Kreatif Ideata </title>
	  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
	  <link rel="stylesheet" href="bower_components/bootstrap/dist/css/bootstrap.min.css">
	  <style>
		.switch {
		  position: relative;
		  display: inline-block;
		  width: 60px;
		  height: 34px;
		}

		.switch input {display:none;}

		.slider {
		  position: absolute;
		  cursor: pointer;
		  top: 0;
		  left: 0;
		  right: 0;
		  bottom: 0;
		  background-color: #ccc;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		.slider:before {
		  position: absolute;
		  content: "";
		  height: 26px;
		  width: 26px;
		  left: 4px;
		  bottom: 4px;
		  background-color: white;
		  -webkit-transition: .4s;
		  transition: .4s;
		}

		input:checked + .slider {
		  background-color: #2196F3;
		}

		input:focus + .slider {
		  box-shadow: 0 0 1px #2196F3;
		}

		input:checked + .slider:before {
		  -webkit-transform: translateX(26px);
		  -ms-transform: translateX(26px);
		  transform: translateX(26px);
		}

		/* Rounded sliders */
		.slider.round {
		  border-radius: 34px;
		}

		.slider.round:before {
		  border-radius: 50%;
		}
	  </style>
	<head>
	<body>
								<ul class="list-inline">
									<li ><span class="list-inline-item"><label class="switch"><input type="checkbox" checked="checked"><span class="slider round"></span></label></span></li>
									<li><span class="list-inline-item">Izinkan Lokasi</span></li>
								</ul>
	</body>
	<!-- jQuery 3 -->
	<script type="text/javascript" src="bower_components/jquery/dist/jquery.min.js"></script>  
	<!-- Bootstrap 3.3.7 -->
	<script type="text/javascript" src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
</html>
