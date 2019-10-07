<?php
$servername="localhost";
$username="root";
$password="";
$dbname="login";

	$conn = new MYSQLi($servername,$username,$password,$dbname);
	


//check the connection of database
if($conn->connect_error)
{
	die("connection failed".$conn->connect_error);
}
if(isset($_POST['User']))
{
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$sql = "SELECT * FROM loginuser WHERE username='".$user."' AND password='".$pass."' LIMIT 1";
	$result=$conn->query(sql);
	
	if($result->num_rows>0)
	{
		echo("you have login success");
		exit();
	}
	else
	{
		echo("go to previsous page");
		exit();
	}
	
	
}
	
?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Login</title>
</head>

<body>
	<form action ="login" method="post">
		Username: <input type="text" name="username"><br><br>
		Password: <input type="password" name="password"><br><br>
		<input type="submit" name="submit" value="Login">
		<input type="submit" name ="submit" value="register"<a href="#"> register.php</a>>
	
		
	</form>
</body>
</html>