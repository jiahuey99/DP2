<?php

	$host = "localhost";
	$dbUsername = "root";
	$dbPassword = "";
	$dbname = "tabletable";
	
	$conn = new mysqli($host, $dbUsername, $dbPassword, $dbname);
	
	$itemname = $_POST['itemname'];
	$itemprice = $_POST['itemprice'];
	$itemdiscount = $_POST['itemdiscount'];
	$itemcategory = $_POST['itemcategory'];
	$itemimg = $_POST['image'];
		$image= $_FILES['image']['name'];
	
	$add = mysqli_query($conn,"SELECT * FROM menuitems WHERE name='$itemname'");
	if($add->num_rows==0){
		$sql = "INSERT INTO menuitems (ITEMNO,name,price,discount,category,img) VALUES (NULL,'$itemname','$itemprice','$itemdiscount','$itemcategory','$image')";
		mysqli_query($conn,$sql);
		 
	}else{
		die("The item has already exist");
	}
	
	header("Location: addmenu.php?insert=success");
	
?> 