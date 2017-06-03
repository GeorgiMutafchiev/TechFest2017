	<nav class="hu-nav" role="navigation">
				<div class="hu-container">
					<div class="row">
						<div class="col-md-12 text-right hu-contact">
							<ul class="">
								<li><a href="#!"><i class="ti-mobile"></i><?php echo $tel; ?></a></li>
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
							<?php if($lng == "en") { ?>
							<ul>
							<?php if(!isset($_SESSION['hotelup'])) { ?>
								<a href="signin.php?lng=en"><li class="nav-login">LOGIN</li></a>
								<?php } ?>
								<a href="indexen.php"><li>Home</li></a>
								<a href="about.php?lng=en"><li>About</li></a>
								<a href="services.php?lng=en"><li>Services</li></a>
								<?php if(!isset($_SESSION['hotelup'])) { ?>
								<a href="https://maps.google.com?daddr=<?php echo $lat; ?>,<?php echo $long; ?>"><li>Map</li></a>
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
								<a href="services.php?lng=bg"><li>Услуги</li></a>
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