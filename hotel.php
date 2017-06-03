<?php
require 'config.php'; 
?>
<!DOCTYPE html>
<html >
<head>
  <meta charset="UTF-8">
  <title>HOTELUP &copy</title>
  <link rel="icon" sizes="192x192" href="images/android-desktop.png">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/5.0.0/normalize.min.css">
<link rel="stylesheet" href="css/loginstyle.css">
  <script src="https://cdnjs.cloudflare.com/ajax/libs/prefixfree/1.0.7/prefixfree.min.js"></script>

</head>

<body>
  <div class="login">
	<h1>HOTELUP &copy; 2017 ADMIN PANEL</h1>
    <form method="post" action="adminlogin.php">
    	<input type="text" name="u" placeholder="Администраторско име:" required="required" />
        <input type="password" name="p" placeholder="Администраторска парола:" required="required" />
        <button type="submit" class="btn btn-primary btn-block btn-large">ВХОД</button>
    </form>
</div>

</body>
</html>
