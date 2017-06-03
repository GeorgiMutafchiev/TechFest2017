  <div class="fab">
    <a href="#!" class="floating-fab" style="background: #f39c12;"><i class="fa fa-bars" aria-hidden="true"></i></a>
    <ul>
      <li><a href="#"><button type="button" class="floating-fab small" data-toggle="modal" data-target="#myModal" style="background: #2980b9;"><i class="fa fa-bed" aria-hidden="true"></i></button></a></li>
      <li><a href="taxi.php?lng=bg" class="floating-fab small" style="background: #16a085;"><i class="fa fa-taxi" aria-hidden="true"></i></a></li>
      <li><a href="https://maps.google.com?saddr=Current+Location&daddr=<?php echo $lat; ?>,<?php echo $long; ?>&language=bg" class="floating-fab small" style="background: #c0392b;"><i class="fa fa-map" aria-hidden="true"></i></a></li>
      <li><a href="chat.php?lng=bg" class="floating-fab small" style="background: #e67e22;"><i class="fa fa-comments" aria-hidden="true"></i></a></li>
    </ul>
  </div>
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title"><?php if($lng == "bg") { ?>Почистване на стая: <?php }elseif($lng="en"){?>Room Cleaning Service: <?php } ?></h4>
        </div>
        <div class="modal-body">
          <p><?php if($lng == "bg") { ?>Ако желаете вашата стая да бъде почистена, при първа възможност, моля натиснете бутона "Потвърждавам".<?php }elseif($lng="en"){?>If you want to use Room Cleaning Service, please click on the "Confirm" button.<?php } ?></p>
        </div>
        <div class="modal-footer">
          <form method="post" action="<?php echo $_SERVER['REQUEST_URI']; ?>">
          <input type="submit" name="roomclean" class="btn btn-default" value="<?php if($lng=='bg'){?>Потвърждавам<?php }elseif($lng=='en'){?>Confirm<?php } ?>">
          </form>
          <?php if(isset($_POST['roomclean'])) {
             $roomn = $_SESSION['hotelup'];
                    $sql = "INSERT INTO roomclean (roomn)
VALUES ('$roomn')";

if ($conn->query($sql) === TRUE) {

    ?>
    <script>
    alert("Заявката е изпратена успешно! | Your query was successfully sent!");
    </script>
    <?php
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
          } ?>
        </div>
      </div>
    </div>
  </div>