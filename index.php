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

<?php include 'bg_nav.php'; ?>

<!--Край на навигационно меню-->

<!--Начало на хедър-->

	<header id="hu-header" class="hu-cover" role="banner" style="background-image:url(images/<?php echo $baner; ?>);">
		<div class="overlay"></div>
		<div class="hu-container">
			<div class="row">
				<div class="col-md-12 col-md-offset-0 text-left">
					<div class="display-t">
						<div class="display-tc text-center">
							<h1 class="animate-box" data-animate-effect="fadeInUp"><?php echo $name; ?></h1>
							<h1 class="animate-box stars" data-animate-effect="fadeInUp">
							<?php for($I=0;$i<$stars;$i++) { ?>
								<i class="fa fa-star" aria-hidden="true"></i>
								<?php } ?>
							</h1>

							<p class="animate-box" data-animate-effect="fadeInUp"><a href="#hu-subscribe" class="btn btn-white btn-lg btn-outline">РЕЗЕРВИРАЙ СТАЯ</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

<!--Край на хедър-->

<!--Начало на екция с услуги-->

	<div id="hu-features-3">
		<div class="hu-container">
			<div class="hu-flex">
				<div class="feature feature-1 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-search"></i>
						</span>
						<h3>лесно за работа</h3>
						<p>интерфейсът на прилоежнието HOTELUP е лесен за ползване</p>
					</div>
				</div>
				<div class="feature feature-2 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-announcement"></i>
						</span>
						<h3>препоръчан хотел</h3>
						<p><?php echo $name; ?> е препоръчан от потребителите на приложението HOTELUP</p>
					</div>
				</div>
				<div class="feature feature-3 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-timer"></i>
						</span>
						<h3>спести време</h3>
						<p>спести време с приложението HOTELUP за <?php echo $name;?></p>
					</div>
				</div>
			</div>
		</div>
	</div>

	<!-- TODO: Icons to change-->
	<div id="hu-features">
		<div class="hu-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading animate-box">
					<h2>Какво предлага нашият хотел?</h2>
					<p>Запознай се с удобствата, които <?php echo $name; ?> предлага на своите гости.</p>
				</div>
			</div>
			<div class="row">
			<?php
     $query_selectt = "SELECT * FROM features";
     $rs22 = (mysqli_query($conn, $query_selectt)) or die(mysqli_error($conn));
     	if(!$rs22){
     		echo mysqli_error();
		} else{
			while($rws2 = mysqli_fetch_assoc($rs22)){
	    $namef =  $rws2['name'];
	    $nameenf =  $rws2['nameen'];
	    $iconf =  $rws2['icon'];
	    $descf =  $rws2['desc'];
	    $descenf =  $rws2['descen'];

?>
				<div class="col-md-3 col-sm-6">
					<div class="feature-center animate-box" data-animate-effect="fadeIn">
						<span class="icon">
							<i class="fa fa-<?php echo $iconf; ?>" aria-hidden="true"></i>
						</span>
						<h3><?php echo $namef; ?></h3>
						<p><?php echo $descf; ?></p>
					</div>
				</div>
				<?php } } ?>
			</div>
		</div>
	</div>

	<div id="hu-portfolio" class="hu-section">
		<div class="hu-container">
			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading animate-box">
					<h2>Разгледай някои от нашите услуги</h2>
					<p>В тази секция имате възможност да разгледате най-популярните услуги, които хотелът предлага.</p>
				</div>
			</div>

			<div class="row row-pb-md">
				<div class="col-md-12">
					<ul id="hu-portfolio-list">
								<?php
     $query_selectt = "SELECT * FROM services LIMIT 4";
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
						<?php } } ?>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 col-md-offset-4 text-center animate-box">
					<a href="services.php?lng=bg" class="btn btn-white btn-outline btn-lg btn-block">Виж всички наши услуги</a>
				</div>
			</div>


		</div>
	</div>

	<div id="hu-counter" class="hu-section">
		<div class="hu-container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading animate-box">
					<h2>Статистика</h2>
				</div>
			</div>

			<div class="row">

				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInLeft">
					<div class="feature-center">
						<span class="icon">
							<i class="ti-briefcase"></i>
						</span>
						<span class="counter js-counter" data-from="0" data-to="<?php
  $query_Events = "select count(*) as rows from guests";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$all = $row['rows'];
echo intval($rooms) - intval($all);
} }
              ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">СВОБОДНИ СТАИ</span>

					</div>
				</div>
				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInLeft">
					<div class="feature-center">
						<span class="icon">
							<i class="ti-face-smile"></i>
						</span>
						<span class="counter js-counter" data-from="0" data-to="<?php
  $query_Events = "select sum(guestsn) as allg from guests";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$all = $row['allg'];
echo $all;
} }
 ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">ГОСТИ В ХОТЕЛА</span>
					</div>
				</div>
				<div class="col-md-4 col-sm-6 animate-box" data-animate-effect="fadeInLeft">
					<div class="feature-center">
						<span class="icon">
							<i class="ti-settings"></i>
						</span>
						<span class="counter js-counter" data-from="0" data-to="<?php
  $query_Events = "select count(*) as rows from services";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$all = $row['rows'];
echo " " . $all;
} }
              ?>" data-speed="5000" data-refresh-interval="50">1</span>
						<span class="counter-label">НАЛИЧНИ УСЛУГИ</span>
					</div>
				</div>
		</div>
	</div>

<!--Край на секция с услуги-->

<!--Начало на секция с мнения-->

	<div id="hu-products">
		<div class="hu-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading animate-box">
					<h2>Мнения</h2>
					<p>Прочетете мненията на доволни наши клиенти.</p>
				</div>
			</div>
			<div class="row animate-box">
				<div class="owl-carousel owl-carousel-carousel">
				<?php
     $query_selectt = "SELECT * FROM reviews";
     $rs22 = (mysqli_query($conn, $query_selectt)) or die(mysqli_error($conn));
     	if(!$rs22){
     		echo mysqli_error();
		} else{
			while($rws2 = mysqli_fetch_assoc($rs22)){
			$ids = $rws['id'];
			$authors = $rws2['author'];
			$descs = $rws2['desc'];
	    $starss =  $rws2['stars'];

?>
					<div class="item reviewItem reviewItem-1">
						<h3><?php echo $authors; ?></h3>
						<p><?php echo $descs; ?></p>
						<?php for($i=0;$i<$starss;$i++) { ?>
						<i class="fa fa-star" aria-hidden="true"></i>
						<?php } ?>
					</div>
					<?php } } ?>
				</div>
			</div>
			<br>
			<div class="row">
				<div class="col-md-4 col-md-offset-4 text-center animate-box">
				<?php if(isset($_SESSION['hotelup'])) { ?>
					<a href="review.php?lng=bg" class="btn btn-dark btn-outline btn-lg btn-block">Оставете ни Вашето мнение</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

<!--Край на секция с мнения-->

<!--Начало на резервация на стая-->

	<div id="hu-subscribe">
		<div class="hu-container">
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading">
					<h2>Резервация на стая в <?php echo $name; ?></h2>
					<p>Ако сте сигурни, че искате да резервирате стая, моля попълнете формуляра!</p>
				</div>
			</div>
			<div class="row animate-box">
				
				<?php
				include 'book_form_bg.php'; 
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
echo 'alert("ЗАЯВКАТА ЗА РЕЗЕРВАЦИЯ Е ИЗПРАТЕНА УСПЕШНО!")';
echo '</script>';
}
?>
			</div>

		</div>
	</div>
</div>

<!--Край на резервация на стая-->

<!--Начало на футър-->

	<footer id="hu-footer" role="contentinfo">
		<div class="hu-container">
			<div class="row row-pb-md">
				<div class="col-md-4">
					<div class="hu-widget">
						<h3>За нас</h3>
						<p><?php for($i=0;$i<count(explode(" ", $description)) / 8;$i++) {
					echo explode(" ", $description)[$i] . " "; } ?></p>
					</div>
				</div>

				<div class="col-md-4 col-md-push-1">
					<div class="hu-widget">
						<h3>Полезни линкове</h3>
						<ul class="hu-footer-links">
							<li><a href="index.php">Начало</a></li>
							<li><a href="about.php?lng=bg">За нас</a></li>
							<li><a href="services.php?lng=bg">Услуги</a></li>
							<li><a href="contact.php?lng=bg">За контакти</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-4">
					<div class="hu-widget">
						<h3>Свържи се с нас</h3>
						<ul class="hu-quick-contact">
							<li><a href="#"><i class="icon-phone"></i><?php echo $tel;?></a></li>
							<li><a href="#"><i class="icon-mail2"></i><?php echo $email; ?></a></li>
						</ul>
					</div>
				</div>

			</div>

			<div class="row copyright">
				<div class="col-md-12">
					<p class="pull-left">
						<small class="block">&copy; 2017 <a href="http://hotelup.eu">HotelUP</a>. All Rights Reserved.</small>
					</p>
				</div>
			</div>

		</div>
	</footer>

	<!--Край на футър-->

</div>

  <!-- Here begins the footer! -->
  <?php if(isset($_SESSION['hotelup'])) { include 'button.php'; } include 'js.php'; ?>

<!-- jQuery -->
	</body>
</html>
<?php } } ?>
