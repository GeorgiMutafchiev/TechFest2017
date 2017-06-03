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

	<!--Начало на навигационно меню-->

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
							<h1 class="animate-box" data-animate-effect="fadeInUp"><?php if($lng == "en") { ?>Our Sevices<?php }elseif($lng == "bg") { ?>Нашите услуги<?php } ?></h1>
							<h2 class="animate-box" data-animate-effect="fadeInUp"><?php echo $name; ?></h2>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

	<!--Край на хедър-->

	<!--Начало на таблица с резервирани услуги-->

	<div class="hu-section">
		<div class="hu-container">
		<?php if(isset($_SESSION['hotelup'])) { ?>
		<?php
		date_default_timezone_set("Europe/Helsinki");
					$time2 = time();
					$roomnum = $_SESSION['hotelup'];
					$query_Eventss = "select count(*) as rows from servcontrol where roomn = '$roomnum' and time > '$time2'";
$results = (mysqli_query($conn, $query_Eventss)) or die(mysqli_error($conn));
if(!$results){
echo mysqli_error();
} else{
while($rows = mysqli_fetch_assoc($results)){
$all = $rows['rows'];
if($all != 0){ ?>
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading">
					<h2><?php if($lng == "en") { ?>Table with full shedule<?php }elseif($lng == "bg") { ?>Таблица с резервирани услуги<?php } ?></h2>
				</div>
				<div class="col-md-12 animate-box" style="margin-bottom: 4rem;">
					<div class="table-responsive">

						<table class="table table-striped table-hover">
							<thead>
					      <tr>
					        <th><?php if($lng == "en") { ?>Date<?php }elseif($lng == "bg") { ?>Дата<?php } ?></th>
					        <th><?php if($lng == "en") { ?>Sevice<?php }elseif($lng == "bg") { ?>Услуга<?php } ?></th>
					        <th><?php if($lng == "en") { ?>Booked hour<?php }elseif($lng == "bg") { ?>Запазен час<?php } ?></th>
					      </tr>
					    </thead>
							<tbody>
							<?php

  $query_Events = "select * from servcontrol where roomn = '$roomnum' order by date asc";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$servicename = $row['servicename'];
$servicenameen = $row['nameen'];
$servdate = $row['date'];
$servtime = $row['time'];
$date = new DateTime();
$Date2 = $date->format('Y-m-d');
$servprice = $row['price'];
$localtime = localtime();
$localtime_assoc = localtime(time(), true);
if($servdate >= $Date2) {
              ?>
								<tr>
									<td><?php echo date("d-m-Y", strtotime($servdate)) ?></td>
									<td><?php if($lng == "en") { echo $servicenameen; }elseif($lng == "bg") { echo $servicename; } ?></td>
									<td><?php echo $servtime; ?></td>
								</tr>
								<?php } } } ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<?php } } } ?>

			<?php } ?>

			<!--Край на таблица с резервирани услуги-->

			<!--Начало на секция с услуги-->

			<div class="row row-pb-md">
				<div class="col-md-12">
					<ul id="hu-portfolio-list">
					<?php if($lng=="bg") { ?>
					<?php
     $query_selectt = "SELECT * FROM services";
     $rs22 = (mysqli_query($conn, $query_selectt)) or die(mysqli_error($conn));
     	if(!$rs22){
     		echo mysqli_error();
		} else{
			while($rws2 = mysqli_fetch_assoc($rs22)){
			$ids = $rws2['id'];
			$names = $rws2['name'];
			$nameens = $rws2['nameen'];
	    $prices =  $rws2['price'];
	    $baners =  $rws2['baner'];
	    $shortdescens =  $rws2['shortdescen'];
	    $shortdescs =  $rws2['shortdesc'];

?>
						<li class="one-half animate-box" data-animate-effect="fadeIn" style="background-image: url(images/<?php echo $baners; ?>); ">
							<a class="service">
								<div class="service-order">
									<button onclick="location.href='serviceinfo.php?lng=bg&id=<?php echo $ids; ?>';"><?php if(isset($_SESSION['hotelup'])) { ?>РЕЗЕРВИРАЙ ТУК<?php } else { ?>НАУЧИ ПОВЕЧЕ<?PHP } ?></button>
								</div>
								<div class="case-studies-summary">
									<span><?php echo $names; ?></span>
									<h2><?php echo $shortdescs; ?></h2>
								</div>
								<div class="service-price">
									<p><?php echo $prices; ?> BGN</p>
								</div>
							</a>
						</li>
						<?php } } } elseif($lng=="en") { ?>
						<?php
     $query_selectt = "SELECT * FROM services";
     $rs22 = (mysqli_query($conn, $query_selectt)) or die(mysqli_error($conn));
     	if(!$rs22){
     		echo mysqli_error();
		} else{
			while($rws2 = mysqli_fetch_assoc($rs22)){
			$ids = $rws2['id'];
			$names = $rws2['name'];
			$nameens = $rws2['nameen'];
	    $prices =  $rws2['price'];
	    $baners =  $rws2['baner'];
	    $shortdescens =  $rws2['shortdescen'];
	    $shortdescs =  $rws2['shortdesc'];

?>
						<li class="one-half animate-box" data-animate-effect="fadeIn" style="background-image: url(images/<?php echo $baners; ?>); ">
							<a class="service">
								<div class="service-order">
									<button onclick="location.href='serviceinfo.php?lng=en&id=<?php echo $ids; ?>';"><?php if(isset($_SESSION['hotelup'])) { ?>ORDER HERE<?php } else { ?>READ MORE<?PHP } ?></button>
								</div>
								<div class="case-studies-summary">
									<span><?php echo $nameens; ?></span>
									<h2><?php echo $shortdescens; ?></h2>
								</div>
								<div class="service-price">
									<p><?php echo $prices; ?> BGN</p>
								</div>
							</a>
						</li>

						<?php } } } ?>
					</ul>
				</div>
			</div>

		</div>
	</div>

	<div id="hu-subscribe">
		<div class="hu-container">
			<!-- XXX: Log In -->
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading">
					<?php if($lng == "en" && isset($_SESSION['hotelup'])) { ?>
					<h2>Book a table in our restaurant</h2>
					<p>Are you convinced you want to book a table? Enter your information here!</p>
					<?php } elseif($lng == "bg" && isset($_SESSION['hotelup'])) { ?>
					<h2>Резервация на маса в нашия ресторант</h2>
					<p>Ако сте сигурни, че искате да резервирате маса, моля попълнете формуляра!</p>
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
				<form class="form-inline" method="post" action="services.php?lng=en">
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
  <?php for($i=8;$i<22;$i++) {
    $time2 = date('H:i:s', gmdate('U'));
  $currentTime = $i . ":00:00";
?>
    <option value="<?php echo $i; ?>"><?php echo $i . ":00"; ?></option>
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
				<form class="form-inline" method="post" action="services.php?lng=bg">
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
    <?php for($i=8;$i<22;$i++) {
  $time2 = date('H:i:s', gmdate('U'));
  $currentTime = $i . ":00:00";
?>
    <option value="<?php echo $i; ?>"><?php echo $i . ":00"; ?></option>
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
                        if(isset($_POST['send']))
{
    $datee = $_POST['date'];
    $houre = $_POST['hour'] . ":00:00";
    $roomn = $_SESSION['hotelup'];
    $sql = "INSERT INTO restaurant (servicename, price, roomn, date, time)
VALUES ('Маса В Ресторант', '0', '$roomn', '$datee', '$houre')";

if ($conn->query($sql) === TRUE) {
    echo '<script language="javascript">';
    if($lng=="en") {
echo 'alert("THE TABLE WAS SUCCESSFULLY BOOKED")';
} elseif($lng=="bg") {
echo 'alert("МАСАТА Е РЕЗЕРВИРАНА УСПЕШНО")';
}
echo '</script>';
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}


}
?>
<?php if($lng == "en" && !isset($_SESSION['hotelup'])) { include 'book_form_en.php'; ?>
			
				<?php } elseif($lng == "bg" && !isset($_SESSION['hotelup'])) { include 'book_form_bg.php'; } 
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

<!--Край на секция с услуги-->

<!--Начало на футър-->

<?php include 'footer.php'; ?>

	<!--Край на футър-->

	</div>

 <!-- Here begins the footer! -->
  <?php if(isset($_SESSION['hotelup'])) { 
      include 'button.php'; 
} include 'js.php'; ?>

	</body>
</html>
<?php } } ?>
