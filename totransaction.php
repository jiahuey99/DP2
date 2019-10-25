<?php

	include_once 'connection.php';
	if(isset($_GET['orderid']))
	{
		$orderid = mysqli_real_escape_string($conn,$_GET['orderid']);	
	}else{
		echo"No Order ID";
	}
	$food = "";
	$xx = mysqli_query($conn,"SELECT itemno,qty FROM orderdb WHERE orderid = '$orderid'");
	$roww = $xx->fetch_assoc();
	$float_total = 0;
	do{
		$yy = mysqli_query($conn,"SELECT price,name FROM menuitems WHERE itemno = '$roww[itemno]'");
		while($rowww = $yy->fetch_assoc()){
			$food = $food.','.strval($rowww['name']).strval($roww['qty']);
			$float_a = floatval($rowww['price'])*floatval($roww['qty']);
			$float_total = $float_total + $float_a ;
		}
	} while($roww = $xx->fetch_assoc());
	

	$sql = "INSERT INTO transaction (orderid,food,amount) VALUES ('$orderid','$food','$float_total');";
	mysqli_query($conn,$sql);
	$dee = mysqli_query($conn,"SELECT * FROM transaction WHERE orderid='$orderid'");
	if($dee->num_rows!=0){
		mysqli_query($conn,"DELETE FROM orderdb WHERE orderid='$orderid'");
	}else{
	die("The transaction record does not exist.");
	}
	
	header("Location: order_page.php?record=saved");

	

?>