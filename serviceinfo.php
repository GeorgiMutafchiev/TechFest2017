<?php
     session_start();
     require 'config.php';
     $lng = $_GET['lng'];
     $servid = $_GET['id'];
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
<?php
     $query_selectt = "SELECT * FROM services WHERE id='$servid'";
     $rs22 = (mysqli_query($conn, $query_selectt)) or die(mysqli_error($conn));
     	if(!$rs22){
     		echo mysqli_error();
		} else{
			while($rws2 = mysqli_fetch_assoc($rs22)){
			$ids = $rws2['id'];
			$names = $rws2['name'];
			$nameens = $rws2['nameen'];
			$descens = $rws2['descen'];
			$descriptions = $rws2['description'];
	    $prices =  $rws2['price'];
	    $worktime = $rws2['worktime'];
	    $baners =  $rws2['baner'];
	    $shortdescens =  $rws2['shortdescen'];
	    $shortdescs =  $rws2['shortdesc'];
	    $pic1s = $rws2['pic1'];
	    $pic2s = $rws2['pic2'];

?>
	<div class="hu-loader"></div>

	<div id="page">

	<!--Начало на навигационно меню-->

	<nav class="hu-nav" role="navigation">
				<div class="hu-container">
					<div class="row">
						<div class="col-md-12 text-right hu-contact">
							<ul class="">
								<li><a href="#!"><i class="ti-mobile"></i><?php echo $tel; ?></a></li>
							<li><a href="serviceinfo.php?lng=bg&id=<?php echo $servid; ?>">BG</a></li>
							<li><a href="serviceinfo.php?lng=en&id=<?php echo $servid; ?>">EN</a></li>
							</ul>
						</div>
					</div>
					<div class="row">
						<div class="col-sm-4 col-xs-12">
							<div id="hu-logo"><a href="index.html">Hotel UP<em>.</em></a></div>
						</div>
						<div class="col-xs-8 text-right menu-1">
							<?php if($lng == "en") { ?>
							<ul>
							<?php if(!isset($_SESSION['hotelup'])) { ?>
								<a href="signin.php?lng=en"><li class="nav-login">LOGIN</li></a>
								<?php } ?>
								<a href="indexen.php"><li>Home</li></a>
								<a href="about.php?lng=en"><li>About</li></a>
								<a href="services.php?lng=en"><li class="activeNavLink">Services</li></a>
								<?php if(!isset($_SESSION['hotelup'])) { ?>
						<a href="https://maps.google.com?saddr=Current+Location&daddr=<?php echo $lat; ?>,<?php echo $long; ?>&language=bg"><li>Map</li></a>
						<?php } ?>
								<a href="contact.php?lng=en"><li>Contact</li></a>
							</ul>
							<?php } elseif($lng == "bg") { ?>
							<ul>
							<?php if(!isset($_SESSION['hotelup'])) { ?>
								<a href="signin.php?lng=bg"><li class="nav-login">ВХОД</li></a>
								<?php } ?>
								<a href="index.php"><li>Начало</li></a>
								<a href="about.php?lng=bg"><li>За нас</li></a>
								<a href="services.php?lng=bg"><li class="activeNavLink">Услуги</li></a>
								<?php if(!isset($_SESSION['hotelup'])) { ?>
						<a href="https://maps.google.com?daddr=<?php echo $lat; ?>,<?php echo $long; ?>"><li>Карта</li></a>
						<?php } ?>
								<a href="contact.php?lng=bg"><li>За контакти</li></a>
							</ul>
							<?php } ?>
						</div>
					</div>

				</div>
			</nav>

			<!--Край на навигационно меню-->

			<!--Начало на хедър-->

	<header id="hu-header" class="hu-cover hu-cover-xs" role="banner" style="background-image:url(images/<?php echo $baners; ?>);">
		<div class="overlay"></div>
		<div class="hu-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center">
					<div class="display-t">
						<div class="display-tc">
							<h1 class="animate-box" data-animate-effect="fadeInUp"><?php if($lng == "en") { echo $nameens; }elseif($lng == "bg") { echo $names; } ?></h1>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!--Край на хедър-->

	<!--Начало на информация за услуга-->

	<div id="hu-history" class="hu-section border-bottom animate-box">
		<div class="hu-container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading animate-box">
					<h2><?php if($lng == "en") { ?>Service Information<?php }elseif($lng == "bg") { ?>Информация За Услугата<?php } ?></h2>
				</div>
			</div>

			<div class="row row-pb-md">
				<div class="col-md-6 animate-box">
					<h3><?php if($lng == "en") { ?>Service Description<?php }elseif($lng == "bg") { ?>Описание На Услугата<?php } ?></h3>
					<p><?php if($lng == "en") { echo $descens; }elseif($lng == "bg") { echo $descriptions; } ?></p>
				</div>
				<div class="col-md-6 animate-box">
					<div class="table-responsive">
						<table class="table table-striped table-hover">
							<tbody>
								<tr>
									<th><?php if($lng == "en") { ?>Price<?php }elseif($lng == "bg") { ?>Цена<?php } ?></th>
									<td><?php echo $prices . " BGN"; ?></td>
								</tr>
								<tr>
									<th><?php if($lng == "en") { ?>Available Hours<?php }elseif($lng == "bg") { ?>Налични Часове<?php } ?></th>
									<td><?php echo $worktime; ?></td>
								</tr>
							</tbody>
						</table>
					</div>
				</div>
			</div>

			<div class="row">
				<div class="row">
					<div class="col-md-8 col-md-offset-2 text-center hu-heading animate-box">
						<h2><?php if($lng == "en") { ?>Gallery<?php }elseif($lng == "bg") { ?>Галерия<?php } ?></h2>
					</div>
				</div>
				<div class="row">
					<div class="container">
						<div class="col-md-6 col-sm-12 animate-box wrapper">
							<div class="pic-container animate-box" style="background-image:url(images/<?php echo $pic1s; ?>);">
								<div class="pic-overlay">
									<h3><?php if($lng == "en") { echo $shortdescens; }elseif($lng == "bg") { echo $shortdescs; } ?></h3>
								</div>
							</div>
						</div>
						<div class="col-md-6 col-sm-12 animate-box">
							<div class="pic-container animate-box" style="background-image:url(images/<?php echo $pic2s; ?>);">
								<div class="pic-overlay">
									<h3><?php if($lng == "en") { echo $shortdescens; }elseif($lng == "bg") { echo $shortdescs; } ?></h3>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>


		</div>
	</div>

	<!--Край на информация за услуга-->

	<!--Начало на резервация на услуга-->

	<div id="hu-subscribe">
		<div class="hu-container">
			<!-- XXX: Log In -->
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading">
					<?php if($lng == "en" && isset($_SESSION['hotelup'])) { ?>
					<h2>Book the service - <?php echo $nameens; ?></h2>
					<p>Are you convinced you want to book a <?php echo $nameens; ?>? Enter your information here!</p>
					<?php } elseif($lng == "bg" && isset($_SESSION['hotelup'])) { ?>
					<h2>Резервация на услугата - <?php echo $names; ?></h2>
					<p>Ако сте сигурни, че искате да резервирате <?php echo $names; ?>, моля попълнете формуляра!</p>
					<?php } ?>
					<?php if($lng == "en" && !isset($_SESSION['hotelup'])) { ?>
					<h2>Book a room in <?php echo $name; ?></h2>
					<p>Are you convinced you want to stay in our hotel? Enter your information here!</p>
					<?php } elseif($lng == "bg" && !isset($_SESSION['hotelup'])) { ?>
					<h2>Резервация на стая в <?php echo $name; ?></h2>
					<p>Ако сте сигурни, че искате да резервирате стая, моля попълнете формуляра!</p>
					<?php } ?>
				</div>
			</div>
			<div class="row animate-box">

				<?php if($lng == "en" && isset($_SESSION['hotelup'])) { ?>
				<form class="form-inline" method="post" action="serviceinfo.php?lng=en&id=<?php echo $servid; ?>">
					<div class="col-md-12">
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="date">Select Date</label>
								<input name="date" type="date" class="form-control" id="fromDate" placeholder="Select Date" data-toggle="tooltip" data-placement="top" title="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="hour">Select hour</label>
								<select name="hour" class="form-control" id="roomtype">
  <optgroup label="AVAILABLE HOURS" style="color: black;">
  <?php
  $hours1 = explode(" - ", $worktime);
  $start = explode(":", $hours1[0])[0];
  $end = explode(":", $hours1[1])[0];
  for($i=$start;$i<=$end;$i++) {
  $time2 = date('H:i:s', gmdate('U'));
?>
    <option value="<?php echo $i; ?>"><?php echo $i . ":00 - AVAILABLE"; ?></option>
    <?php
    }
    ?>
  </optgroup>
</select>
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<label for="fromDate">Book</label>
							<input name="send" type="submit" class="btn btn-default btn-block" value="BOOK">
						</div>
					</div>
				</form>

				<?php } elseif($lng == "bg" && isset($_SESSION['hotelup'])) { ?>
				<form class="form-inline" method="post" action="serviceinfo.php?lng=bg&id=<?php echo $servid; ?>">
					<div class="col-md-12">
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="fromDate">Дата</label>
								<input name="date" type="date" class="form-control" id="fromDate" placeholder="Изберете дата" data-toggle="tooltip" data-placement="top" title="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="roomtype">Изберете час</label>
								<select name="hour" class="form-control" id="roomtype">
  <optgroup label="НАЛИЧНИ ЧАСОВЕ" style="color: black;">
    <?php
  $hours1 = explode(" - ", $worktime);
  $start = explode(":", $hours1[0])[0];
  $end = explode(":", $hours1[1])[0];
  for($i=$start;$i<=$end;$i++) {
  $time2 = date('H:i:s', gmdate('U'));
?>
    <option value="<?php echo $i; ?>"><?php echo $i . ":00 - НАЛИЧЕН"; ?></option>
    <?php
    }
    ?>
  </optgroup>
</select>
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<label for="fromDate">Резервирай</label>
							<input name="send" type="submit" class="btn btn-default btn-block" value="РЕЗЕРВИРАЙ">
						</div>
					</div>
				</form>
				<?php } ?>
				 <?php
                        if(isset($_POST['send'])){
    $datee = $_POST['date'];
    $houre = $_POST['hour'] . ":00:00";
    $roomn = $_SESSION['hotelup'];
    $mysqli = new mysqli("localhost","kozle1_bebio","bebio123","kozle1_hoteltestbansko");
$result = $mysqli->query("SELECT id FROM servcontrol WHERE time = '$houre' AND date = '$datee'");
if($result->num_rows > 0) {
    echo '<script language="javascript">';
    if($lng=="en") {
echo 'alert("THE HOUR WAS BOOKED BEFORE YOU! PLEASE TRY AGAIN!")';
} elseif($lng=="bg") {
echo 'alert("ЧАСЪТ Е ВЕЧЕ РЕЗЕРВИРАН! МОЛЯ ОПИТАЙТЕ ОТНОВО!")';
}
echo '</script>';
   }
   else {
       $roomnumber = $_SESSION['hotelup'];
       $query_select = "SELECT * FROM guests WHERE roomn='$roomnumber' LIMIT 1";
     $rs2 = (mysqli_query($conn, $query_select)) or die(mysqli_error($conn));
     	if(!$rs2){
     		echo mysqli_error();
		} else{
			while($rws = mysqli_fetch_assoc($rs2)){
	    $enddate =  $rws['ddate'];
	    $startdate = $rws['adate'];
	    if($datee > $enddate) {
	            echo '<script language="javascript">';
    if($lng=="en") {
echo 'alert("THE SELECTED DATE IS AFTER THE END OF YOUR STAY! PLEASE TRY AGAIN!")';
} elseif($lng=="bg") {
echo 'alert("ИЗБРАНАТА ДАТА Е СЛЕД КРАЯ НА ВАШИЯ ПРЕСТОЙ! МОЛЯ ОПИТАЙТЕ ОТНОВО!")';
}
echo '</script>';
	    } elseif($datee < $startdate){
	         echo '<script language="javascript">';
	        if($lng=="en") {
echo 'alert("THE SELECTED DATE IS BEFORE YOUR STAY! PLEASE TRY AGAIN!")';
} elseif($lng=="bg") {
echo 'alert("ИЗБРАНАТА ДАТА Е ПРЕДИ ВАШИЯ ПРЕСТОЙ! МОЛЯ ОПИТАЙТЕ ОТНОВО!")';
}
echo '</script>';
	    } else{
    $sql = "INSERT INTO servcontrol (servicename, nameen, price, roomn, date, time)
VALUES ('$names', '$nameens', '$prices', '$roomn', '$datee', '$houre')";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
    if($lng=="en") {
echo 'alert("THE SERVICE WAS SUCCESSFULLY BOOKED")';
} elseif($lng=="bg") {
echo 'alert("УСЛУГАТА Е РЕЗЕРВИРАНА УСПЕШНО")';
}
echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
} } } 
}
}
?>
<?php if($lng == "en" && !isset($_SESSION['hotelup'])) { include 'book_form_en.php'; } elseif($lng == "bg" && !isset($_SESSION['hotelup'])) { include 'book_form_bg.php'; } ?>
				 <?php
                        if(isset($_POST['submit']))
{
    $namee = mysql_real_escape_string($_POST['fullName']);
    $emaile = mysql_real_escape_string($_POST['email']);
    $roomtype = mysql_real_escape_string($_POST['roomtype']);
    $fromDate = mysql_real_escape_string($_POST['fromDate']);
    $toDate = mysql_real_escape_string($_POST['toDate']);

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
?>		</div>
						</div>
					</div>
				</form>


	<!--Край на резервация на услуга-->

	<!--Начало на футър-->

	<?php include 'footer.php'; ?>

	<!--Край на футър-->

	</div>
 
 <!-- Here begins the footer! -->
  <?php if(isset($_SESSION['hotelup'])) { include 'button.php'; } include 'js.php'; ?>

	</body>
	<?php } } ?>
</html>

<?php } } ?>
