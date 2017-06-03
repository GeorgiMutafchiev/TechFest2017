<html>
<head><title>LOGIN</title></head>
<body>
<?php

	session_start();
	
	$adminuser = $_POST['u'];
	$adminpass = $_POST['p'];
	
	if($adminuser&&$adminpass)
	{
		$connect = mysql_connect("localhost", "kozle1_bebio", "bebio123") or die("Проблемна връзка с базата данни!");
			
			mysql_select_db("kozle1_hotelup")or die("Провалено свързване!");
		
		$query = mysql_query("SELECT * FROM `roles` WHERE `adminuser` = '$adminuser'");
		
		$numrows = mysql_num_rows($query);
		
		if($numrows !==0){
			while($row = mysql_fetch_assoc($query)){
				
				$pass = $adminpass;
				$dbusername = $row['adminuser'];
				$dbpassword = $row['adminpass'];
				$role = $row['role'];
				$id = $row['id'];
			}
			if($adminuser == $dbusername && ($pass)==$dbpassword){
				$_SESSION['username'] = $adminuser;
				$_SESSION['id'] = $id;
				$_SESSION['role'] = $role;
				
				if($role == "admin") {
				header("Location: admin.php");
                	} else if($role == "servcontrol") {
                		header("Location: adminservices.php");
                	} else if($role == "rec") {
                		header("Location: adminregister.php");
                	}
			} else
				echo "<h2 style='text-align: center;'>Въведена е грешна администраторска парола!</h2>"; ?>
					
				<?php
		} else
			die("<h2 style='text-align: center;'>Въведено е грешно администраторско име!</h2>");
	} else
		die("<h2 style='text-align: center;'>Моля въвдете администраторско име и администраторска парола!</h2>");
?>
</html>