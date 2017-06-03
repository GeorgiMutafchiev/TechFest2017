<?php 
     session_start();
     require 'config.php'; 
     $lng = $_GET['lng'];
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php if($lng == "en") { ?>SIGN IN HOTELUP<?php }elseif($lng == "bg") { ?>ВХОД HOTELUP<?php } ?></title>
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="" />
	<meta name="keywords" content="hotelup, hotel, travel, stay, money" />
	<meta name="author" content="hotelup" />

	<!-- <link href="https://fonts.googleapis.com/css?family=Droid+Sans" rel="stylesheet"> -->

	<!-- Animate.css -->
	<link rel="stylesheet" href="css/animate.css">
	<!-- Icomoon Icon Fonts-->
	<link rel="stylesheet" href="css/icomoon.css">
	<!-- Themify Icons-->
	<link rel="stylesheet" href="css/themify-icons.css">
	<!-- Bootstrap  -->
	<link rel="stylesheet" href="css/bootstrap.css">

	<!-- Magnific Popup -->
	<link rel="stylesheet" href="css/magnific-popup.css">

	<!-- Owl Carousel  -->
	<link rel="stylesheet" href="css/owl.carousel.min.css">
	<link rel="stylesheet" href="css/owl.theme.default.min.css">

	<!-- Theme style  -->
	<link rel="stylesheet" href="css/style.css">

	<!-- Modernizr JS -->
	<script src="js/modernizr-2.6.2.min.js"></script>
	<!-- FOR IE9 below -->
	<!--[if lt IE 9]>
	<script src="js/respond.min.js"></script>
	<![endif]-->

	</head>
	<body>
	
	<!--Начало на секция за влизане в системата-->

	<div class="hu-loader"></div>

	<div class="loginBg"></div>

	<div class="form-wrapper col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
		<div class="row animate-box">
			<div class="col-xs-12 text-center hu-heading nomar">
				<h2><?php if($lng == "en") { ?>SIGN IN<?php }elseif($lng == "bg") { ?>ВХОД<?php } ?></h2>
				<p><?php if($lng == "en") { ?>Enter your room number and the UNIQUE CODE.<?php }elseif($lng == "bg") { ?>Въведете номер на стаята и УНИКАЛЕН КОД<?php } ?></p>
			</div>
		</div>
		<div class="animate-box col-xs-12">
		<form method="post" action="login.php">
			<div class="col-md-10 col-md-offset-1 col-sm-12 animate-box">
				<input name="roomnumber" type="text" class="form-control login-control" placeholder="<?php if($lng == "en") { ?>Room Number<?php }elseif($lng == "bg") { ?>Номер На Стая<?php } ?>" required>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-12 animate-box">
				<input name="uniquecode" type="text" class="form-control login-control" placeholder="<?php if($lng == "en") { ?>Unique Code<?php }elseif($lng == "bg") { ?>Уникален Код<?php } ?>" required>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-12 animate-box">
				<button type="submit" name="login" class="btn-login"><?php if($lng == "en") { ?>LOGIN<?php }elseif($lng == "bg") { ?>ВХОД<?php } ?></button>
			</div>
			</form>
		</div>
	</div>
	
	<!--Край на секция за влизане в системата-->

	<!-- jQuery -->
	<script src="js/jquery.min.js"></script>
	<!-- jQuery Easing -->
	<script src="js/jquery.easing.1.3.js"></script>
	<!-- Bootstrap -->
	<script src="js/bootstrap.min.js"></script>
	<!-- Waypoints -->
	<script src="js/jquery.waypoints.min.js"></script>
	<!-- Carousel -->
	<script src="js/owl.carousel.min.js"></script>
	<!-- countTo -->
	<script src="js/jquery.countTo.js"></script>
	<!-- Magnific Popup -->
	<script src="js/jquery.magnific-popup.min.js"></script>
	<script src="js/magnific-popup-options.js"></script>
	<!-- Main -->
	<script src="js/main.js"></script>

	</body>
</html>
