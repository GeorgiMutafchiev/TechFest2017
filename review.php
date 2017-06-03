<?php 
     session_start();
     require 'config.php'; 
     $lng = $_GET['lng'];
     $query_select = "SELECT * FROM hotel";
     $rs2 = (mysqli_query($conn, $query_select)) or die(mysqli_error($conn));
     	if(!$rs2){
     		echo mysqli_error();
		} else{
			while($rws = mysqli_fetch_assoc($rs2)){
	    $name =  $rws['name']; 
	    $description =  $rws['description']; 
	    $address =  $rws['address']; 
	    $email =  $rws['email']; 
	    $website =  $rws['website']; 
	    $tel =  $rws['tel']; 
	    $stars =  $rws['stars']; 
	    $rooms =  $rws['rooms']; 
	    $pic1 =  $rws['pic1']; 
	    $pic2 =  $rws['pic2']; 
	    $pic3 =  $rws['pic3']; 
	    $pic4 =  $rws['pic4']; 
	    $baner =  $rws['baner']; 
	    $descen =  $rws['descen']; 
?>
<!DOCTYPE HTML>
<html>
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title><?php if($lng == "en") { ?>REVIEW HOTELUP<?php }elseif($lng == "bg") { ?>НАПИШИ МНЕНИЕ HOTELUP<?php } ?></title>
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
	
	<!--Начало на секция за писане на мнение-->

	<div class="hu-loader"></div>

	<div class="loginBg"></div>

	<div class="form-wrapper col-md-4 col-md-offset-4 col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
		<div class="row animate-box">
			<div class="col-xs-12 text-center hu-heading nomar">
				<h2><?php if($lng == "en") { ?>Write A Review<?php }elseif($lng == "bg") { ?>Напишете Мнение<?php } ?></h2>
				<p><?php if($lng == "en") { ?>Fill the form and click on SEND button.<?php }elseif($lng == "bg") { ?>Попълнете полетата и натиснете бутона ИЗПРАТИ<?php } ?></p>
			</div>
		</div>
		<div class="animate-box col-xs-12">
		<form method="post" action="review.php?lng=bg">
			<div class="col-md-10 col-md-offset-1 col-sm-12 animate-box">
				<input name="name" type="text" class="form-control login-control" placeholder="<?php if($lng == "en") { ?>Name<?php }elseif($lng == "bg") { ?>Име<?php } ?>" required>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-12 animate-box">
				<input name="rating" type="text" class="form-control login-control" placeholder="<?php if($lng == "en") { ?>Rating (1-6)<?php }elseif($lng == "bg") { ?>Оценка (1-6)<?php } ?>" required>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-12 animate-box">
				<textarea rows="4" cols="40" name="comment" type="text" class="form-control login-control" placeholder="<?php if($lng == "en") { ?>Comment<?php }elseif($lng == "bg") { ?>Коментар<?php } ?>" required></textarea>
			</div>
			<div class="col-md-10 col-md-offset-1 col-sm-12 animate-box">
				<button style="z-index: 100;" type="submit" name="login" class="form-control btn-login"><?php if($lng == "en") { ?>SEND<?php }elseif($lng == "bg") { ?>ИЗПРАТИ<?php } ?></button>
			</div>
			</form>
			 <?php
                        if(isset($_POST['login'])){
    $name = $_POST['name'];
    $rating = $_POST['rating'];
    $comment = $_POST['comment'];
    
    $sqlt = "INSERT INTO `reviews` (`desc`, `author`, `stars`) VALUES ('$comment','$name','$rating')";

if ($conn->query($sqlt) === TRUE) {
header("Location: index.php");
    echo '<script language="javascript">';
    if($lng=="en") {
echo 'alert("THE REVIEW WAS SUCCESSFULLY SENT")';
} elseif($lng=="bg") {
echo 'alert("МНЕНИЕТО Е ИЗПРАТЕНО УСПЕШНО")';
}
echo '</script>';
} else {
    echo "Errorche: " . $sqlt . "<br>" . $conn->error;
}
}
?>
		</div>
	</div>
	
	<!--Край на секция за писане на мнение-->

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

<?php } } ?>