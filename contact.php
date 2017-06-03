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

<?php include 'head.php'; ?>

	<body>

	<div class="hu-loader"></div>

	<div id="page">

<?php include 'nav.php'; ?>

	<header id="hu-header" class="hu-cover hu-cover-xs" role="banner" style="background-image:url(images/<?php echo $baner; ?>);">
		<div class="overlay"></div>
		<div class="hu-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc">
							<h1 class="animate-box" data-animate-effect="fadeInUp"><?php if($lng=="en") { ?>Get in touch with us<?php } elseif($lng=="bg") {?>Свържете се с нас<?php } ?></h1>
							<h2 class="animate-box" data-animate-effect="fadeInUp"><?php echo $name; ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<div class="hu-section">
		<div class="hu-container">
			<div class="row row-pb-md">
				<div class="col-md-6 animate-box">
					<h3><?php if($lng=="en") { ?>Get in touch<?php } elseif($lng=="bg") {?>Свържете се с нас<?php } ?></h3>
					<?php if($lng=="en") { ?>
					<form action="contact.php?lng=en" method="post">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Name</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Your firstname">
							</div>

						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Email</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Your email address">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="subject">Subject</label>
								<input name="subject" type="text" id="subject" class="form-control" placeholder="Your subject of this message">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Message</label>
								<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Write us something"></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="send" value="Send Message" class="btn btn-primary btn-lg">
						</div>

					</form>
					<?php } elseif($lng=="bg") { ?>
					<form action="contact.php?lng=bg" method="post">
						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="name">Име</label>
								<input type="text" id="name" name="name" class="form-control" placeholder="Вашето име">
							</div>

						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="email">Имейл адрес</label>
								<input type="email" name="email" id="email" class="form-control" placeholder="Вашият имейл адрес">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="subject">Тема</label>
								<input name="subject" type="text" id="subject" class="form-control" placeholder="Тема на съобщението">
							</div>
						</div>

						<div class="row form-group">
							<div class="col-md-12">
								<label class="sr-only" for="message">Съобщение</label>
								<textarea name="message" id="message" cols="30" rows="10" class="form-control" placeholder="Вашето съобщение"></textarea>
							</div>
						</div>
						<div class="form-group">
							<input type="submit" name="send" value="Изпрати съобщение" class="btn btn-primary btn-lg">
						</div>

					</form>
					<?php } ?>
					<?php
                        if(isset($_POST['send']))
{
    $namee = $_POST['name'];
    $emaile = $_POST['email'];
    $subjecte = $_POST['subject'];
    $msge = $_POST['message'];

    $txt = "Съобщение от потребител на HOTELUP<br>
    Име на потребителя: " . $namee . "<br><br>Съобщение :<br>" . $msge;
    $to = $email;
    $subject = $subjecte;
    $sender = $emaile;
 $mail_from = "From: $sender" .
                    "\r\n" . "Reply-To: $sender" . "\r\n";
                    $mail_from.="Content-type: text/html; charset = utf-8 \r\n";

mail($to,$subject,$txt,$mail_from);
    echo '<script language="javascript">';
    if($lng=="en") {
echo 'alert("THE MESSAGE WAS SUCCESSFULLY SENT")';
} elseif($lng=="bg") {
echo 'alert("СЪОБЩЕНИЕТО Е ИЗПРАТЕНО УСПЕШНО")';
}
echo '</script>';
}
?>
				</div>
				<div class="col-md-5 col-md-push-1 animate-box">

					<div class="hu-contact-info">
						<h3><?php if($lng=="en") { ?>Hotel Information<?php }elseif($lng=="bg") {?>Информация За Хотела<?php } ?></h3>
						<ul>
							<li class="address"><?php echo $address; ?></li>
							<li class="phone"><a href="tel://<?php echo $tel; ?>"><?php echo $tel; ?></a></li>
						</ul>
					</div>


				</div>
			</div>
			</div>

		</div>
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
			<?php if($lng == "en") { include 'book_form_en.php'; } elseif($lng == "bg") { include 'book_form_bg.php'; }
			
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
<?php } include 'footer.php'; ?>
	</div>


<!-- Here begins the footer! -->
  <?php if(isset($_SESSION['hotelup'])) { include 'button.php'; } include 'js.php'; ?>

	</body>
</html>

<?php } } ?>
