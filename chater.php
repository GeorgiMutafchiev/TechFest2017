<html>
<head><title>LOGIN</title></head>
<body>
<?php
	require 'config.php';
	session_start();
	
	$adminuser = $_POST['room'];
	
	if($adminuser)
	{
	$roomn = $adminuser;
  $query_Eventss = "select count(*) as rows from messages where username='$roomn' limit 1";
$results = (mysqli_query($conn, $query_Eventss)) or die(mysqli_error($conn));
if(!$results){
echo mysqli_error();
} else{
while($rows = mysqli_fetch_assoc($results)){
$all = $rows['rows'];

				$_SESSION['to'] = $adminuser;
				$sql = "INSERT INTO lastmessages (roomnum, num)
VALUES ('$roomn', '$all')";

if ($conn->query($sql) === TRUE) {
				
                		header("Location: achat.php?lng=bg");
			} } }
	} else
		die("<h2 style='text-align: center;'>Моля въвдете номер на стая и уникален код!</h2>");
?>
</html>