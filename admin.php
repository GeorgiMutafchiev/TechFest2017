<?php 
     session_start();
if(isset($_SESSION['username']) && $_SESSION['role'] == "admin") {
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
          <a style="color: white;" class="mdl-navigation__link active" href="admin.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">home</i>Начало</a>
          <a class="mdl-navigation__link" href="adminregister.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">add_box</i>Регистрация</a>
          <a class="mdl-navigation__link" href="adminguests.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Гости</a>
          <a class="mdl-navigation__link" href="adminservices.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">room_service</i>Услуги</a>
          <a class="mdl-navigation__link" href="adminchat.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Чат</a>
          <a class="mdl-navigation__link" href="admindata.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">list</i>Общи данни</a>
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
          <div class="demo-graphs mdl-shadow--2dp mdl-color--white mdl-cell mdl-cell--8-col">
              <div class="demo-card-wide mdl-card mdl-shadow--2dp mdl-cell--12-col">
  <div class="mdl-card__title">
    <h2 class="mdl-card__title-text">Ресторант</h2>
  </div>
  <div class="mdl-card__supporting-text">
    Проследете какво се случва с резерваците в ресторанта на вашия хотел, като натиснете бутона "научи повече"...
  </div>
  <div class="mdl-card__actions mdl-card--border">
    <a href="adminrestaurant.php" class="mdl-button mdl-button--colored mdl-js-button mdl-js-ripple-effect">
      ВИЖ РЕЗЕРВАЦИИ
    </a>
  </div>
  <div class="mdl-card__menu">
    <button class="mdl-button mdl-button--icon mdl-js-button mdl-js-ripple-effect">
      <i class="material-icons">open_in_new</i>
    </button>
  </div>
</div>
              <br>
              <div class="table-responsive" style="overflow-y: scroll; height: 250px;">
            <table class="mdl-data-table mdl-js-data-table mdl-cell--12-col">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Фамилия</th>
      <th>Стая</th>
      <th>ПИН</th>
        <th>Дата на пристигане</th>
      <th>Дата на напускане</th>
    </tr>
  </thead>
  <tbody>
  <?php
  $query_Events = "select * from guests limit 10";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$id = $row['id'];
$name = $row['lastname'];
$room = $row['roomn'];
$pin = $row['keygen'];
$ardate = $row['adate'];
$dedate = $row['ddate'];
              ?>
    <tr>
      	<td class="mdl-data-table__cell--non-numeric"><?php echo $name; ?></td>
      	<td><?php echo $room; ?></td>
      	<td><?php echo $pin; ?></td>
        <td><time class="text-primary text-uppercase"><?php echo date("d-m-Y", strtotime($ardate));
?></time></td>
      	<td><time class="text-primary text-uppercase"><?php echo date("d-m-Y", strtotime($dedate));
?></time></td>
    </tr>
    <?php } } ?>
  </tbody>
</table>
                  </div>
          </div>
            
          <div class="demo-cards mdl-cell mdl-cell--4-col mdl-cell--8-col-tablet mdl-grid mdl-grid--no-spacing">
            <div class="demo-updates mdl-card mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--4-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__title mdl-card--expand mdl-color--teal-300">
                <h2 class="mdl-card__title-text">Чат</h2>
              </div>
              <div class="mdl-card__supporting-text mdl-color-text--grey-600">
                Следете желанията на вашите гости по всяко време, използвайки чата в реално време...
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="adminchat.php" class="mdl-button mdl-js-button mdl-js-ripple-effect">Започни чат</a>
              </div>
            </div>
            <div class="demo-separator mdl-cell--1-col"></div>
            <div class="demo-options mdl-card mdl-color--deep-purple-500 mdl-shadow--2dp mdl-cell mdl-cell--4-col mdl-cell--3-col-tablet mdl-cell--12-col-desktop">
              <div class="mdl-card__supporting-text mdl-color-text--blue-grey-50">
                <h3>Предлагани услуги</h3>
                  <hr>
                <ul>
                <?php
  $query_Events = "select * from services limit 3";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$name = $row['name'];
              ?>
                  <li>
                      <span class="">
                      	<?php echo $name; ?>
                      </span>
                  </li>
                  <?php } } ?>
                </ul>
              </div>
              <div class="mdl-card__actions mdl-card--border">
                <a href="adminservices.php" class="mdl-button mdl-js-button mdl-js-ripple-effect mdl-color-text--blue-grey-50">Вижте всички</a>
                <div class="mdl-layout-spacer"></div>
                <i class="material-icons">more</i>
              </div>
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