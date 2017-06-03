	<footer id="hu-footer" role="contentinfo">
		<div class="hu-container">
			<div class="row row-p	b-md">

				<div class="col-md-4">
					<div class="hu-widget">
					<?php if($lng == "en") { ?>
						<h3>About Us</h3>
						<p><?php for($i=0;$i<count(explode(" ", $descen)) / 8;$i++) {
					echo explode(" ", $descen)[$i] . " "; } ?></p>
					<?php } elseif($lng == "bg") { ?>
					<h3>За хотела</h3>
						<p><?php for($i=0;$i<count(explode(" ", $description)) / 8;$i++) {
					echo explode(" ", $description)[$i] . " "; } ?></p>
					<?php } ?>
					</div>

				</div>

				<div class="col-md-4 col-md-push-1">
					<div class="hu-widget">
					<?php if($lng == "en") { ?>
						<h3>Links</h3>
						<ul class="hu-footer-links">
							<li><a href="indexen.php">Home</a></li>
							<li><a href="about.php?lng=en">About</a></li>
							<li><a href="services.php?lng=en">Services</a></li>
							<li><a href="contact.php?lng=en">Contact</a></li>
						</ul>
						<?php } elseif($lng == "bg") { ?>
						<h3>Полезни линкове</h3>
						<ul class="hu-footer-links">
							<li><a href="index.php">Начало</a></li>
							<li><a href="about.php?lng=bg">За нас</a></li>
							<li><a href="services.php?lng=bg">Услуги</a></li>
							<li><a href="contact.php?lng=bg">За контакти</a></li>
						</ul>
						<?php } ?>
					</div>
				</div>

				<div class="col-md-4">
					<div class="hu-widget">
					<?php if($lng == "en") { ?>
						<h3>Get In Touch</h3>
						<?php } elseif($lng == "bg") { ?>
						<h3>Свържи се с нас</h3>
						<?php } ?>
						<ul class="hu-quick-contact">
							<li><a href="#"><i class="icon-phone"></i><?php echo $tel; ?></a></li>
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
