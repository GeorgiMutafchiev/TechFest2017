<?php 
     session_start();
if(isset($_SESSION['username']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "servcontrol") {
     require 'config.php';
$url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
     $query_select = "SELECT * FROM hotel";
     $rs2 = (mysqli_query($conn, $query_select)) or die(mysqli_error($conn));
     	if(!$rs2){
     		echo mysqli_error();
		} else{
			while($rws = mysqli_fetch_assoc($rs2)){
                $id =  $rws['id']; 
	    $name =  $rws['name']; 
?>
<!doctype html>

<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Service</title>
    <meta name="mobile-web-app-capable" content="yes">
    <link rel="icon" sizes="192x192" href="images/android-desktop.png">
    <meta name="apple-mobile-web-app-capable" content="yes">
    <meta name="apple-mobile-web-app-status-bar-style" content="black">
    <meta name="apple-mobile-web-app-title" content="Material Design Lite">
    <link rel="apple-touch-icon-precomposed" href="images/ios-desktop.png">
    <meta name="msapplication-TileImage" content="images/touch/ms-touch-icon-144x144-precomposed.png">
    <meta name="msapplication-TileColor" content="#3372DF">

    <link rel="shortcut icon" href="images/favicon.png">
      
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto:regular,bold,italic,thin,light,bolditalic,black,medium&amp;lang=en">
    <link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
      <link rel="stylesheet" href="https://code.getmdl.io/1.3.0/material.cyan-light_blue.min.css">
    <link rel="stylesheet" href="css/adminstyle.css">
      
    <style>
    #view-source {
      position: fixed;
      display: block;
      right: 0;
      bottom: 0;
      margin-right: 40px;
      margin-bottom: 40px;
      z-index: 900;
    }
    </style>
  </head>
  <body>
    <div class="demo-layout mdl-layout mdl-js-layout mdl-layout--fixed-drawer mdl-layout--fixed-header">
      <header class="demo-header mdl-layout__header mdl-color--grey-100 mdl-color-text--grey-600">
        <div class="mdl-layout__header-row">
          <span class="mdl-layout-title"><?php echo $name; ?></span>
          <div class="mdl-layout-spacer"></div>
          <button class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon" id="hdrbtn">
            <i class="material-icons">more_vert</i>
          </button>
          <ul class="mdl-menu mdl-js-menu mdl-js-ripple-effect mdl-menu--bottom-right" for="hdrbtn">
            <a href="logout.php?logout-from-admin-panel" style="text-decoration: none;"><li class="mdl-menu__item">Изход</li></a>
          </ul>
        </div>
      </header>
      <div class="demo-drawer mdl-layout__drawer mdl-color--teal-300 mdl-color-text--blue-grey-50">
        <header class="demo-drawer-header">
          <div class="demo-avatar-dropdown">
            <span>  HOTEL UP &copy; 2017</span>
            <div class="mdl-layout-spacer"></div>
            <button id="accbtn" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-button--icon">
            </button>
        </header>
        <nav class="demo-navigation mdl-navigation mdl-color--blue-grey-800">
        <?php if($_SESSION['role'] == "admin") { ?>
          <a class="mdl-navigation__link" href="admin.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Начало</a>

          <a class="mdl-navigation__link" href="adminregister.php"><i class="material-icons" role="presentation">add_box</i>Регистрация</a>
          <a class="mdl-navigation__link" href="adminguests.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Гости</a>
                    <?php } ?>

          <a style="color: white;" class="mdl-navigation__link active" href="adminservices.php"><i style="color: white;" class="mdl-color-text--blue-grey-400 material-icons" role="presentation">room_service</i>Услуги</a>
                    
          <a class="mdl-navigation__link" href="adminchat.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Чат</a>
          <?php if($_SESSION['role'] == "admin") { ?>
          <a class="mdl-navigation__link" href="admindata.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">list</i>Общи данни</a>
          <?php } ?>
        </nav>
      </div>
      <main class="mdl-layout__content mdl-color--grey-100">
        <div class="mdl-grid demo-content">
            
          <div class="demo-charts mdl-color--white mdl-shadow--2dp mdl-cell mdl-cell--12-col mdl-grid mdl-typography--text-center mdl-cell--hide-tablet mdl-cell--hide-phone ">
              <div id="guests" class="mdl-cell mdl-cell--4-col mdl-grid mdl-cell--middle">
                  <i style="font-size: 100px; color: #009688;" class="material-icons">account_box</i><h2 style="font-size: 80px; color: #009688;"><?php 
  $query_Events = "select sum(guestsn) as allg from guests";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$all = $row['allg'];
echo $all;
} } 
 ?></h2>
              </div>
              <div class="mdl-tooltip" data-mdl-for="guests">
                      <h6>Брой гости в хотела</h6>
                </div>
              <div id="rooms" class="mdl-cell mdl-cell--4-col mdl-grid mdl-cell--middle mdl-typography--text-center">
              <i style="font-size: 100px; color: #E91E63;" class="material-icons">local_hotel</i><h2 style="font-size: 80px; color: #E91E63;"><?php
  $query_Events = "select count(*) as rows from guests";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$all = $row['rows'];
echo " " . $all;
} }
              ?></h2>
              </div>
              <div class="mdl-tooltip" data-mdl-for="rooms">
                      <h6>Брой заети стаи</h6>
                </div>
              <div id="servs" class="mdl-cell mdl-cell--4-col mdl-grid mdl-cell--middle mdl-typography--text-center">
              <i style="font-size: 100px; color: #607D8B;" class="material-icons">event</i><h2 style="font-size: 80px; color: #607D8B;">
                 <?php
  $query_Events = "select count(*) as rows from services";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$all = $row['rows'];
echo " " . $all;
} }
              ?>
                  </h2>
              </div>
            <div class="mdl-tooltip" data-mdl-for="servs">
                      <h6>Брой услуги</h6>
                </div>
          </div>
          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col">
              <div class="mdl-cell--12-col">
                  <h3 class="mdl-color--teal-300" style="padding: 10px; color: white;">Резервирани маси в ресторант:</h3>
                  <hr>
              </div>
              <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--12-col">
                  <?php for($i=0;$i<1;$i++) { ?>
              <div class="mdl-cell--12-col">
                  <h3 class="mdl-color--teal-300" style="padding: 10px; color: white;"><?php 
                  ini_set('date.timezone', 'Europe/Sofia');
$time2 = date('H:i:s', gmdate('U')); // 12:50:29
                  $date = new DateTime();
$date->add(new DateInterval('P' . $i . 'D')); // P1D means a period of 1 day
$Date2 = $date->format('Y-m-d');
$Date3 = $date->format('d-m-Y');
echo "Дата: " . $Date3; ?></h3>
                  <hr>
              </div>
              <div class="table-responsive" style="overflow-y: scroll; height: 300px;">
              <?php
              $query_Eventss = "select count(*) as rows from servcontrol where date = '$Date2' and time >= '$time2'";
$results = (mysqli_query($conn, $query_Eventss)) or die(mysqli_error($conn));
if(!$results){
echo mysqli_error();
} else{
while($rows = mysqli_fetch_assoc($results)){
$all = $rows['rows'];
if($all != 0){ ?>
            <table class="mdl-data-table mdl-js-data-table mdl-cell--12-col">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Име на услуга:</th>
      <th>Номер на стая:</th>
        <th>Дата на изпълнение:</th>
        <th>Час на изпълнение:</th>
    </tr>
  </thead>
  <tbody>
      <?php
$sql = "DELETE FROM restaurant WHERE date < '$Date2'";
if ($conn->query($sql) === TRUE) {
} else {
    echo "Error deleting record: " . $conn->error;
}
  $query_Events = "select * from restaurant where date = '$Date2' and time >= '$time2' order by time asc";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$roomn = $row['roomn'];
$servicename = $row['servicename'];
$date = $row['date'];
$time = $row['time'];
$price = $row['price'];
              ?>
    <tr>
        <td class="mdl-data-table__cell--non-numeric"><?php echo $servicename; ?></td>
        <td><?php echo $roomn; ?></td>
        <td><?php echo $date; ?></td>
        <td><?php echo $time . " часа"; ?></td>
    </tr>
      <?php } } ?>
  </tbody>
</table>
<?php }else { echo "<h3 class='mdl-color-text--teal-300'>НЯМА ЗАПАЗЕНИ УСЛУГИ ЗА ТАЗИ ДАТА</h3>"; } } } ?>
                  
            </div>
                  <?php } ?>
                                     </div>
                                     <div class="mdl-cell--12-col">
                  <h5 class="mdl-color--teal-300" style="text-align: center; padding: 10px; color: white;">HOTEL UP &copy; 2017 All rights are reserved - <?php echo $name; ?><h5>
                  <hr>
              </div>
        </div>
      </main>
    </div>
        <script>
  $(document).ready(function() {
    // add click event to link
    $("#refresh").click(function() {
    // pass the value of the new password
      $("#Container").load("10digpassgen.php");
      return false;
    });
  });
 </script>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
    <?php } } ?>
    <?php
} else{
echo "<h1 style='margin-top: 20vh; text-align: center; font-family: Century Gothic;'>МОЛЯ ВЛЕЗТЕ В СИСТЕМАТА!</h1><br><h4 style='text-align: center; font-family: Century Gothic;'> HOTELUP &copy; 2017</h5>"; 
}
?>