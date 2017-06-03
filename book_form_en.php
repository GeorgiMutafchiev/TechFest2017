<form class="form-inline" method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
					<div class="col-md-12">
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="fromDate">Starting Date</label>
								<input name="fromDate" type="date" class="form-control" id="fromDate" placeholder="Starting Date" data-toggle="tooltip" data-placement="top" title="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="toDate">End Date</label>
								<input name="toDate" type="date" class="form-control" id="toDate" placeholder="End Date" data-toggle="tooltip" data-placement="top" title="yyyy-mm-dd">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="roomtype">Room type</label>
								<select name="roomtype" class="form-control" id="roomtype">
  <optgroup label="ROOMS" style="color: black;">
    <option value="Single Room">Single room</option>
    <option value="Double Room">Double room</option>
    <option value="Triple Room">Triple room</option>
  </optgroup>
  <optgroup label="APARTMENTS" style="color: black;">
    <option value="Small Apartment">Small apartment</option>
    <option value="Panoramic Apartment">Panoramic apartment</option>
    <option value="Presidental Apartment">Presidental apartment</option>
  </optgroup>
</select>

							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="email">Email</label>
								<input name="email" type="email" class="form-control" id="email" placeholder="Your Email">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<div class="form-group">
								<label for="fullName">Full Name</label>
								<input name="fullName" type="text" class="form-control" id="fullName" placeholder="Your Name">
							</div>
						</div>
						<div class="col-md-4 col-sm-12">
							<label for="fromDate">Book</label>
							<input name="submit" type="submit" class="btn btn-default btn-block" value="BOOK">
						</div>
					</div>
				</form>
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
    $to = "info.hotelup@gmail.com";
    $subject = "РЕЗЕРВАЦИЯ ОТ HOTELUP";   
    $sender = $emaile;
 $mail_from = "From: $sender" .
                    "\r\n" . "Reply-To: $sender" . "\r\n";
                    $mail_from.="Content-type: text/html; charset = utf-8 \r\n";
        
mail($to,$subject,$txt,$mail_from);
    echo '<script language="javascript">';
echo 'alert("THE BOOKING REQUEST WAS SUCCESSFULLY BOOKED")';
echo '</script>';
}
?>