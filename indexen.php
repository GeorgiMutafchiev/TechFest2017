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
	
	<?php include'en_nav.php'; ?>
	
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
							<!-- <h2 class="animate-box" data-animate-effect="fadeInUp">namira se nqkude blizo da nas, nz eto <a href="#!">map</a></h2> -->
							<p class="animate-box" data-animate-effect="fadeInUp"><a href="#hu-subscribe" class="btn btn-white btn-lg btn-outline">BOOK A ROOM</a></p>
						</div>
					</div>
				</div>
			</div>
		</div>
	</header>

<!--Край на хедър-->

<!--Начало на секция с услуги-->

	<div id="hu-features-3">
		<div class="hu-container">
			<div class="hu-flex">
				<div class="feature feature-1 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-search"></i>
						</span>
						<h3>easy to use</h3>
						<p>the interface of the HOTELUP application for <?php echo $name; ?> is easy to use</p>
					</div>
				</div>
				<div class="feature feature-2 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-announcement"></i>
						</span>
						<h3>recommended hotel</h3>
						<p><?php echo $name; ?> is recommended by the users of the application HOTELUP</p>
					</div>
				</div>
				<div class="feature feature-3 animate-box" data-animate-effect="fadeInUp">
					<div class="feature-inner">
						<span class="icon">
							<i class="ti-timer"></i>
						</span>
						<h3>save time</h3>
						<p>save time with the HOTELUP application for <?php echo $name;?></p>
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
					<h2>Some Features Of Our Hotel</h2>
					<p>Learn more about the services that <?php echo $name; ?> offers for its guests.</p>
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
						<h3><?php echo $nameenf; ?></h3>
						<p><?php echo $descenf; ?></p>
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
					<h2>Check out some of our services</h2>
					<p>Learn about some of the services our hotel can provide in this section.</p>
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
						<?php } } ?>
					</ul>
				</div>
			</div>

			<div class="row">
				<div class="col-md-4 col-md-offset-4 text-center animate-box">
					<a href="services.php?lng=en" class="btn btn-white btn-outline btn-lg btn-block">See All Our Services</a>
				</div>
			</div>


		</div>
	</div>

	<div id="hu-counter" class="hu-section">
		<div class="hu-container">

			<div class="row">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading animate-box">
					<h2>Statistics</h2>
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
						<span class="counter-label">FREE ROOMS</span>

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
						<span class="counter-label">HOTEL GUESTS</span>
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
						<span class="counter-label">available services</span>
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
					<h2>Reviews</h2>
					<p>Check out some the reviews from our satisfied clients.</p>
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
					<a href="review.php?lng=en" class="btn btn-dark btn-outline btn-lg btn-block">Write a review</a>
					<?php } ?>
				</div>
			</div>
		</div>
	</div>

<!--Край на секция с мнения-->

<!--Начало на регистрация на стая-->

	<div id="hu-subscribe">
		<div class="hu-container">
			<!-- XXX: Log In -->
			<div class="row animate-box">
				<div class="col-md-8 col-md-offset-2 text-center hu-heading">
					<h2>Book a room in our hotel?</h2>
					<p>Are you convinced you want to stay in our hotel? Enter your information here!</p>
				</div>
			</div>
			<div class="row animate-box">
					
				<?php
				include 'book_form_en.php';
?>
			</div>

		</div>
	</div>
</div>

<!--Край на регистрация на стая-->

<!--Начало на футър-->

	<footer id="hu-footer" role="contentinfo">
		<div class="hu-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="hu-widget">
						<h3>About Us</h3>
						<p><?php for($i=0;$i<count(explode(" ", $descen)) / 8;$i++) { 
					echo explode(" ", $descen)[$i] . " "; } ?></p>
					</div>
				</div>

				<div class="col-md-4 col-md-push-1">
					<div class="hu-widget">
						<h3>Links</h3>
						<ul class="hu-footer-links">
							<li><a href="indexen.php">Home</a></li>
							<li><a href="about.php?lng=en">About</a></li>
							<li><a href="services.php?lng=en">Services</a></li>
							<li><a href="contact.php?lng=en">Contact</a></li>
						</ul>
					</div>
				</div>

				<div class="col-md-4">
					<div class="hu-widget">
						<h3>Get In Touch</h3>
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
<!-- Here begins the footer! -->
  <?php if(isset($_SESSION['hotelup'])) { include 'button.php'; } include 'js.php'; ?>

<!-- jQuery -->
	</body>
</html>
<?php } } ?>
