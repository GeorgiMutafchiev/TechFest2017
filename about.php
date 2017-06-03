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
	    $lat = $rws['lat'];
	    $long = $rws['long'];
?>
<!DOCTYPE HTML>
<html>
	
	<?php include 'head.php'; ?>
	
	<body>

	<div class="hu-loader"></div>

	<div id="page">

	<!--Навигационно меню-->

	<?php include 'nav.php'; ?>

			<!--Край на навигационно меню-->

<!--Начало на хедър-->

	<header id="hu-header" class="hu-cover hu-cover-xs" role="banner" style="background-image:url(images/<?php echo $baner; ?>);">
		<div class="overlay"></div>
		<div class="hu-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc">
						<?php if($lng == "en") { ?>
							<h1 class="animate-box" data-animate-effect="fadeInUp">About the hotel</h1>
							<h2 class="animate-box" data-animate-effect="fadeInUp"><?php echo $name; ?></a></h2>
						<?php } elseif($lng == "bg") { ?>
							<h1 class="animate-box" data-animate-effect="fadeInUp">За хотела</h1>
							<h2 class="animate-box" data-animate-effect="fadeInUp"><?php echo $name; ?></a></h2>
						<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

<!--Край на хедър-->

<!--Начало на история на хотела-->

	<div id="hu-history" class="hu-section border-bottom animate-box">
		<div class="hu-container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading">
					<?php if($lng == "en") { ?>
							<h2>HOTEL HISTORY</h2>
							<p>Read the history and find interesting facts about the history of <?php echo $name; ?></p>
						<?php } elseif($lng == "bg") { ?>
							<h2>ИСТОРИЯ НА ХОТЕЛА</h2>
							<p>Прочетете историята и намерете интересни факти за <?php echo $name; ?></p>
						<?php } ?>
				</div>
			</div>

			<div class="row row-pb-md">
			<?php if($lng == "en") { ?>
				<div class="col-md-6">
					<p><?php for($i=0;$i<count(explode(" ", $descen)) / 2;$i++) {
					echo explode(" ", $descen)[$i] . " "; } ?></p>
				</div>
				<div class="col-md-6">
					<p><?php for($i=count(explode(" ", $descen)) / 2;$i<count(explode(" ", $descen));$i++) {
					echo explode(" ", $descen)[$i] . " "; } ?></p>
				</div>
				<?php } elseif($lng == "bg") { ?>
				<div class="col-md-6">
					<p><?php for($i=0;$i<count(explode(" ", $descen)) / 2;$i++) {
					echo explode(" ", $description)[$i] . " "; } ?></p>
				</div>
				<div class="col-md-6">
					<p><?php for($i=count(explode(" ", $descen)) / 2;$i<count(explode(" ", $descen));$i++) {
					echo explode(" ", $description)[$i] . " "; } ?></p>
				</div>
				<?php } ?>
			</div>

<!--Край на история на хотела-->

<!--Начало на галрия-->

			<div class="row">
				<div class="col-md-8 col-md-offset-2 col-sm-12">
				<?php if($lng == "en") { ?>
					<h3>See The Photos</h3>
					<?php } elseif($lng == "bg") { ?>
					<h3>Виж снимки</h3>
					<?php } ?>

				</div>
				<div class="col-md-8 col-md-offset-2 col-sm-12">
					<div class="owl-carousel owl-carousel-fullwidth">
						<div class="item">
							<img src="images/<?php echo $pic1; ?>">
						</div>
						<div class="item">
							<img src="images/<?php echo $pic2; ?>">
						</div>
						<div class="item">
							<img src="images/<?php echo $pic3; ?>">
						</div>
						<div class="item">
							<img src="images/<?php echo $pic4; ?>">
						</div>
					</div>
				</div>
			</div>


		</div>

<!--Край на галрия-->

	</div>

	<!--Начало на резервация на стая-->

<?php if(!isset($_SESSION['hotelup'])) { ?>
	<div id="hu-subscribe">
		<div class="hu-container">
			<!-- XXX: Log In -->
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading">
				<?php if($lng == "en") { ?>
					<h2>Book a room in <?php echo $name; ?></h2>
					<p>Are you convinced you want to stay in our hotel? Enter your information here!</p>
					<?php } elseif($lng == "bg") { ?>
					<h2>Резервация на стая в <?php echo $name; ?></h2>
					<p>Ако сте сигурни, че искате да резервирате стая, моля попълнете формуляра!</p>
					<?php } ?>
				</div>
			</div>
			<div class="row animate-box">
			<?php if($lng == "en") { include 'book_form_en.php'; } elseif($lng == "bg") { include 'book_form_bg.php';  } ?>
				 <?php
                        if(isset($_POST['submit']))
{
    $namee = $_POST['fullName'];
    $emaile = $_POST['email'];
    $roomtype = $_POST['roomtype'];
    $fromDate = $_POST['fromDate'];
    $toDate = $_POST['toDate'];

    $txt = "Резервация от HOTELUP<br>
    Име на потребителя: " . $namee . "<br>
    Тип стая: " . $roomtype . "<br>
    Дата на настаняване: " . $fromDate . "<br>
    Дата на напускане: " . $toDate . "<br><br>
    Молим Ви да потвърдите регистрацията като изпратите имейл за потвърждение до: " . $emaile;
    $to = $email;
    $subject = "РЕЗЕРВАЦИЯ ОТ HOTELUP";
    $sender = $emaile;
 $mail_from = "From: $sender" .
                    "\r\n" . "Reply-To: $sender" . "\r\n";
                    $mail_from.="Content-type: text/html; charset = utf-8 \r\n";

mail($to,$subject,$txt,$mail_from);
    echo '<script language="javascript">';
    if($lng=="en") {
echo 'alert("THE ROOM WAS SUCCESSFULLY BOOKED")';
} elseif($lng=="bg") {
echo 'alert("СТАЯТА Е РЕЗЕРВИРАНА УСПЕШНО")';
}
echo '</script>';
}
?>
			</div>

		</div>
	</div>
<?php } ?>

<!--Край на резервация на стая-->

<!--Начало на футър-->

	<?php include 'footer.php'; ?>

	<!--Край на футър-->

	</div>

  
<!-- Here begins the footer! -->
  <?php if(isset($_SESSION['hotelup'])) { include 'button.php'; } include 'js.php'; ?>


	</body>
</html>
<?php } } ?>
