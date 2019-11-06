<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>User Login</title>
	<style>
		
			#frm
		{
			border:solid gray 10px;
			width:30%;
			border-radius:10px;
			margin:100px auto;
			background:white;
			
		}
		
		
		input[type=text],input[type=password]
		{
			width:40%;
			padding:10px;
			margin-top:8px;
			border:1px solid #ccc;
			padding-left:5px;
			font-size:16px;
			font-family: Cambria, "Hoefler Text", "Liberation Serif", Times, "Times New Roman", "serif";
		}
		
		input[type=submit]
		{
			width:20%;
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
	<div class="Login" id="frm">
<h1 align="center">Login</h1>
		
		<form action="" method="post" style="text-align:center;">
		Username: <input type ="text" placeholder="Username" id="user" name="user"><br/><br/>
		Password: <input type="password" placeholder="Password" id ="password" name="pass"><br/><br/>
		User type: <select name="type"><option value="-1">Select user type</option>
			<option value="Admin">Admin</option>
			<option value="User">User</option>
			</select><br/><br/>
		<input type="submit" value="Login" name="submit">
	
		 
	
</body>
</html>
<?php
	$error='';//variable to store error message
	if(isset($_POST['submit']))
	{
		if(empty($_POST['user'])|| empty($_POST['pass']) || empty($_POST['type']))
		{
			$error="Username" or "Password is Invalid" or "user type error";
			
		}
		
		else
		{
			// Define $user and pass	
			$user=$_POST['user'];
			$pass=$_POST['pass'];
			$type=$_POST['type'];

			$conn=mysqli_connect("localhost","root","");
			//connect to database "userlogin"
			$db=mysqli_select_db($conn,"userlogin");
			
			//userpass is table name(from userlogin)
			$query=mysqli_query($conn,"SELECT *FROM userpass Where pass='$pass' AND user='$user' AND type='$type'");
			
			$row=mysqli_fetch_array($query);
			
				if($row['user']==$user && $row['pass']==$pass && $row['type']=='Admin')
			{
				//reading to other page
				//link to next page menu
				header("Location:staff.php");
				
				
			}
			else if($row['user']==$user && $row['pass']==$pass && $row['type']=='User')
			{
				//reading to other page
				//link to next page menu
				header("Location:menu.php");
				
				
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
	