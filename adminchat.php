<?php 
     session_start();
if(isset($_SESSION['username']) && $_SESSION['role'] == "admin" || $_SESSION['role'] == "rec") { 
     require 'config.php';
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
    <title>Chat</title>
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
          <a class="mdl-navigation__link" href="adminregister.php"><i class="material-icons" role="presentation">add_box</i>Регистрация</a>
          <a class="mdl-navigation__link" href="adminguests.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">people</i>Гости</a>
          <?php if($_SESSION['role'] == "admin") { ?>
          <a class="mdl-navigation__link" href="adminservices.php"><i class="mdl-color-text--blue-grey-400 material-icons" role="presentation">room_service</i>Услуги</a>
          <?php } ?>
          <a style="color: white;" class="mdl-navigation__link active" href="adminchat.php"><i style="color: white;" class="mdl-color-text--blue-grey-400 material-icons" role="presentation">forum</i>Чат</a>
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
                  <h3 class="mdl-color--teal-300" style="padding: 10px; color: white;">Чат с гости на хотела</h3>
                  <hr>
              </div>
              <div class="table-responsive" style="overflow-y: scroll; height: 440px;">
            <table class="mdl-data-table mdl-js-data-table mdl-cell--12-col">
  <thead>
    <tr>
      <th class="mdl-data-table__cell--non-numeric">Име</th>
      <th>Фамилия</th>
        <th>Непрочетени съобщения</th>
        <th>Телефон</th>
        <th>Стая</th>
      <th>ПИН</th>
        <th>Дата на пристигане</th>
      <th>Дата на напускане</th>
    </tr>
  </thead>
  <tbody>
      <?php
  $query_Events = "select * from guests order by id desc";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$firstname = $row['firstname'];
$lastname = $row['lastname'];
$roomn = $row['roomn'];
$email = $row['email'];
$tel = $row['tel'];
$keygen = $row['keygen'];
$ardate = $row['adate'];
$dedate = $row['ddate'];
              ?>
    <tr>
        <td class="mdl-data-table__cell--non-numeric"><?php echo $firstname; ?></td>
        <td><?php echo $lastname; ?></td>
        <td><?php
  $query_Eventss = "select count(*) as rows from messages where username='$roomn'";
$results = (mysqli_query($conn, $query_Eventss)) or die(mysqli_error($conn));
if(!$results){
echo mysqli_error();
} else{
while($rows = mysqli_fetch_assoc($results)){
$all = $rows['rows'];

 $query_Eventsss = "select * from lastmessages where roomnum='$roomn' order by id desc limit 1";
$resultss = (mysqli_query($conn, $query_Eventsss)) or die(mysqli_error($conn));
if(!$resultss){
echo mysqli_error();
} else{
while($rowss = mysqli_fetch_assoc($resultss)){
$latest = $rowss['num']; 
if(intval($all) - intval($latest) == 0) {
?>
<h6 style="color: green;"><strong>НЯМА</strong></h6>
<?php } else { ?>
<h6 style="color: red;"><strong><?php echo intval($all) - intval($latest); ?></strong></h6>
<?php }
} }
} }
              ?></td>
        <td><?php echo $tel; ?></td>
        <td><?php echo $roomn;?></td>
        <td><?php echo $keygen; ?></td>
        <td><?php echo date("d-m-Y", strtotime($ardate)); ?></td>
        <td><?php echo date("d-m-Y", strtotime($dedate)); ?></td>
    </tr>
      <?php } } ?>
  </tbody>
</table>
                  
            </div>
              <form action="chater.php" method="post">
  <div class="mdl-textfield mdl-js-textfield mdl-textfield--floating-label mdl-cell-12">
    <input class="mdl-textfield__input" name="room" type="text" pattern="-?[0-9]*(\.[0-9]+)?" id="sample4">
    <label class="mdl-textfield__label" for="sample4">Въведете номер на стая:</label>
    <span class="mdl-textfield__error">Несъществуващ номер на стая!</span>
  </div>
      <input type="submit" name="submit" class="mdl-button mdl-js-button mdl-button--primary" value="Намери стая">
</form>
              <?php if(isset($_POST['submit']))
{
    $room = $_POST['room'];
    if($room != ""){
      $query_Events = "select count(*) as rows from guests where roomn = '$room'";
$result = (mysqli_query($conn, $query_Events)) or die(mysqli_error($conn));
if(!$result){
echo mysqli_error();
} else{
while($row = mysqli_fetch_assoc($result)){
$all = $row['rows'];
if($all != 1){
	echo "<h2 class='mdl-color-text--cyan'>Не съществува стая с този номер!</h2>";
} else {
              } }
}
    }
    	}
    	
              ?>
              <div class="mdl-cell--12-col">
                  <h3 class="mdl-color--teal-300" style="padding: 10px; color: white;">Изпращане на масово съобщение:</h3>
                  <hr>
              </div>
              <div class="mdl-cell--12-col">
              <form action="adminchat.php" method="post">
    <input style="width: 100%;" class="mdl-textfield__input" name="massmessage" type="text" placeholder="Въведете текст на масовото съобщение" id="sample4">
    <span class="mdl-textfield__error">Неуспешно изпращане на съобщението!</span><br>
      <input style="color: white;" type="submit" name="submitt" class="mdl-button mdl-js-button mdl-button--raised mdl-button--colored" value="Изпрати масово съобщение">
</form>
<?php
if(isset($_POST['submitt']))
                {
                    $message = $_POST['massmessage'];
                    
                    $sql = "INSERT INTO messages (username, message)
VALUES ('HOTELUP','$message')";

if ($conn->query($sql) === TRUE) {
?>
<script>
	alert('Масовото съобщение е изпратено успешно!');
</script>
<?php } else { ?>
<script>
	alert('Изпращането е неуспешно!');
</script>
<?php } } ?>
              </div>
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