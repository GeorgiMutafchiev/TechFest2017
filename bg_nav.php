	<nav class="hu-nav" role="navigation">
		<div class="hu-container">
			<div class="row">
				<div class="col-md-12 text-right hu-contact">
					<ul class="">
						<li><a href="#!"><i class="ti-mobile"> </i><?php echo $tel; ?></a></li>
						<li><a href="index.php">BG</a></li>
						<li><a href="indexen.php">EN</a></li>
					</ul>
				</div>
			</div>
			<div class="row">
				<div class="col-sm-4 col-xs-12">
					<div id="hu-logo"><a href="index.php">Hotel UP<em>.</em></a></div>
				</div>
				<div class="col-xs-8 text-right menu-1">
					<ul>
					<?php if(!isset($_SESSION['hotelup'])) { ?>
						<a href="signin.php?lng=bg"><li class="nav-login">ВХОД</li></a>
						<?php } ?>
						<?php if(isset($_SESSION['hotelup'])) { ?>
						<a href="logouthotelup.php?logout-from-hotelup"><li class="nav-login">ИЗХОД</li></a>
						<?php } ?>
						<a href="index.php"><li>Начало</li></a>
						<a href="about.php?lng=bg"><li>За нас</li></a>
						<a href="services.php?lng=bg"><li>Услуги</li></a>
						<?php if(!isset($_SESSION['hotelup'])) { ?>
						<a href="https://maps.google.com?daddr=<?php echo $lat; ?>,<?php echo $long; ?>"><li>Карта</li></a>
						<?php } ?>
						<a href="contact.php?lng=bg"><li>За контакти</li></a>
					</ul>
				</div>
			</div>

		</div>
	</nav>