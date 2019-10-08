<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Login</title>
	<style>
		login
		{
			width:360;
			margin:50px auto;
			font:Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
			borde-radius:10px;
			border=2px solid #ccc;
			padding:10px 40px 25px;
			margin-top:70px;
		}
		
		input[type=text],input[type=password]
		{
			width:30%;
			padding:10px;
			margin-top:8px;
			border:1px solid #ccc;
			padding-left:5px;
			font-size:16px;
			font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
		}
		
		input[type=submit]
		{
			width:10%;
			border:2px solid #06f;
			padding :10px;
			font-size:20px;
			cursor:pointer;
			border-radius:5px;
			margin-bottom: 15px;
			
		}
		
	</style>
</head>

<body>
	<div class="Login">
<h1 align="center">Login</h1>
		<form action="" method="post" style="text-align:center;">
		Username: <input type ="text" placeholder="Username" id="user" name="user"><br/><br/>
		Password: <input type="password" placeholder="Password" id ="password" name="pass"><br/><br/>
		<input type="submit" value="Login" name="submit">
	
		 
	
</body>
</html>
<?php
	$error='';//variable to store error message
	if(isset($_POST['submit']))
	{
		if(empty($_POST['user'])|| empty($_POST['pass']))
		{
			$error="Username" or "Password is Invalid";
			
		}
		
		else
		{
			// Define $user and pass	
			$user=$_POST['user'];
			$pass=$_POST['pass'];

			$conn=mysqli_connect("localhost","root","");
			//connect to database "userlogin"
			$db=mysqli_select_db($conn,"userlogin");
			
			//userpass is table name(from userlogin)
			$query=mysqli_query($conn,"SELECT *FROM userpass Where pass='$pass' AND user='$user'");
			
			$rows=mysqli_num_rows($query);
			if($rows==1)
			{
				//reading to other page
				//link to next page menu
				header("Location:welecom");
				
			}
			else
			{
				
				$error ="Username or Password is Invaild";
			}
			//closing connection
			mysqli_close($conn);
			
		}
		
		
		
	}
	
?>
	