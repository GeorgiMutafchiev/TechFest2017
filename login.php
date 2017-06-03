<html>
<head><title>LOGIN</title></head>
<body>
<?php

	session_start();
	
	$adminuser = $_POST['roomnumber'];
	$adminpass = $_POST['uniquecode'];
	
	if($adminuser&&$adminpass)
	{
		$connect = mysql_connect("localhost", "kozle1_bebio", "bebio123") or die("Проблемна връзка с базата данни!");
			
			mysql_select_db("kozle1_hoteltestbansko")or die("Провалено свързване!");
		
		$query = mysql_query("SELECT * FROM `guests` WHERE `roomn` = '$adminuser'");
		
		$numrows = mysql_num_rows($query);
		
		if($numrows !==0){
			while($row = mysql_fetch_assoc($query)){
				
				$pass = $adminpass;
				$dbusername = $row['roomn'];
				$dbpassword = $row['keygen'];
				$id = $row['id'];
			}
			if($adminuser == $dbusername && ($pass)==$dbpassword){
				$_SESSION['hotelup'] = $adminuser;
				
				
                		header("Location: index.php");
			} else
				echo "<h2 style='text-align: center;'>Въведен е грешен уникален код!</h2>"; ?>
					
				<?php
		} else
			die("<h2 style='text-align: center;'>Въведен е грешен номер на стая!</h2>");
	} else
		die("<h2 style='text-align: center;'>Моля въвдете номер на стая и уникален код!</h2>");
?>
</html>