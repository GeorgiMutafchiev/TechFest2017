<?php 
      session_start();
if(isset($_SESSION['username'])) { 
     require 'config.php'; 
     $url = 'http://'.$_SERVER['HTTP_HOST'].$_SERVER['PHP_SELF'];
     $keyche = $_GET['room'];
     

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
      <script language="javascript">
function printdiv(printpage)
{
var newstr = document.all.item(printpage).innerHTML;
var oldstr = document.body.innerHTML;
document.body.innerHTML = newstr;
window.print();
document.body.innerHTML = oldstr;
return false;
}
</script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="A front-end template that helps you build fast, modern mobile web apps.">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0">
    <title>Admin panel</title>
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
          <?php } ?>
          <a style="color: white;" class="mdl-navigation__link active" href="adminregister.php"><i style="color: white;" class="material-icons" role="presentation">add_box</i>Регистрация</a>
          <a class="mdl-navigation__link" href="adminguests.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Гости</a>
          <?php if($_SESSION['role'] == "admin") { ?>
          <a class="mdl-navigation__link" href="adminservices.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">room_service</i>Услуги</a>
          <?php } ?>
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
             
              <input style="color: white;" name="b_print" type="button" class="ipt mdl-button mdl-js-button mdl-button--raised mdl-button--colored"   onClick="printdiv('div_print');" value=" Натисни, за да принтираш ">
<br>
              <hr>
              <br>

<div id="div_print" class="mdl-color-text--blue-grey-400">
    <?php
  $query_Events = "select * from guests where roomn='$keyche'";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$roomn = $row['roomn'];
$phone = $row['tel'];
$email = $row['email'];
$keygen = $row['keygen'];
$ardate = $row['adate'];
$dedate = $row['ddate'];
$str = strtotime($dedate) - (strtotime($ardate));
$price = $row['price'];
              ?>
    <?php
  $query_Events = "select * from hotel";
$rs = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$rs){
echo mysqli_error();
} else{
while($rws = mysqli_fetch_assoc($rs)){
$nam = $rws['name'];
$name = strtolower(str_replace(' ', '', $nam));
$tel = $rws['tel'];
              ?>
    
    <img src="images/logo.png" width="150px">
<h1><?php echo $firstname . " " . $lastname; ?></h1>
    <hr>
    <h4>Room number: <?php echo $roomn; ?></h4>
    <h5>Room number: <?php echo "Arrival date: " . date("d-m-Y", strtotime($ardate)) ?></h5>
    <h5>Room number: <?php echo "Departure date: " . date("d-m-Y", strtotime($dedate)) ?></h5>
        <hr>
    <h6>Total sum of your services:</h6>
    <hr>
    <table class="mdl-data-table mdl-js-data-table mdl-cell--12-col">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Arrival Date</th>
      <th>Departure Date</th>
      <th>Nights</th>
        <th>Price Per Night</th>
        <th>Total costs</th>
        <th>Addon costs</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td class="mdl-data-table__cell--non-numeric"><?php echo date("d-m-Y", strtotime($ardate)); ?></td>
      <td><?php echo date("d-m-Y", strtotime($dedate)); ?></td>
      <td><?php echo floor($str/3600/24); ?></td>
        <td><?php echo $price . " BGN"; ?></td>
        <td><?php echo ($price * floor($str/3600/24)) . " BGN"; ?></td>
        <td><?php 
  $query = "select sum(price) as finalp from servcontrol where roomn='$keyche'";
$res = (mysqli_query($conn, $query)) or die(mysqli_error($conn));
if(!$res){
echo mysqli_error();
} else{
while($rows = mysqli_fetch_assoc($res)){
$addons = $rows['finalp'];
if($addons == ""){echo "0 BGN";}else{
echo $addons . " BGN";
}
} } 
 ?></td>
    </tr>
  </tbody>
</table>
<hr>
<?php
              $query_Eventss = "select count(*) as rows from servcontrol where roomn = '$keyche'";
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
      <th class="mdl-data-table__cell--non-numeric">Service name</th>
      <th>Room Number</th>
      <th>Price</th>
        <th>Date</th>
    </tr>
  </thead>
  <tbody>
   <?php
  $query_Eventss = "select * from servcontrol where roomn='$keyche'";
$rss = (mysqli_query($conn, $query_Eventss)) or die(mysqli_error($conn));
if(!$rss){
echo mysqli_error();
} else{
while($rww = mysqli_fetch_assoc($rss)){
$servname = $rww['servicename'];
$roomnum = $rww['roomn'];
$servpr = $rww['price'];
$servdate = $rww['date']
              ?>
    <tr>
      <td class="mdl-data-table__cell--non-numeric"><?php echo $servname; ?></td>
      <td><?php echo $roomnum; ?></td>
      <td><?php echo $servpr . " BGN"; ?></td>
        <td><?php echo date("d-m-Y", strtotime($servdate)); ?></td>
    </tr>
    <?php } } ?>
  </tbody>
</table>

<hr>

<?php }else {} } }?>

<h3 style="color: black;">FINAL SUM: <?php 
  $query = "select sum(price) as finalp from servcontrol where roomn='$keyche'";
$res = (mysqli_query($conn, $query)) or die(mysqli_error($conn));
if(!$res){
echo mysqli_error();
} else{
while($rows = mysqli_fetch_assoc($res)){
$addons = $rows['finalp'];
echo $addons + ($price * floor($str/3600/24)) . " BGN";
} } 
 ?></h3
    <br>
    <hr>
    <br>
    <p>You can also read some tipps about the application on http://hotelup.eu</p>
    <h5 class="mdl-color-text--cyan">HOTELUP Ltd. &copy; 2017</h5>
    <?php } } } } ?>
</div>
    <div class="mdl-cell-12 centered">

    <a href="gdel.php?room=<?php echo $keyche; ?>"<button style="color: white;" type="button" class="ipt mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect mdl-button--accent"  href="gedit.php">ПРЕКРАТИ ПРЕСТОЙ</button></a>
        </div>
          </div>
        </div>
      </main>
    </div>
    <script defer src="https://code.getmdl.io/1.3.0/material.min.js"></script>
  </body>
</html>
    <?php } } ?>
    <?php
} else{
echo "<h1 style='margin-top: 20vh; text-align: center; font-family: Century Gothic;'>МОЛЯ ВЛЕЗТЕ В СИСТЕМАТА!</h1><br><h4 style='text-align: center; font-family: Century Gothic;'> HOTELUP &copy; 2017</h5>"; 
}
?>