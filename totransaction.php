<?php

	include_once 'connection.php';
	if(isset($_GET['orderid']))
	{
		$orderid = mysqli_real_escape_string($conn,$_GET['orderid']);	
	}else{
		echo"No Order ID";
	}
	if(isset($_GET['membername']))
	{
		$member = mysqli_real_escape_string($conn,$_GET['membername']);	
		$memberget = mysqli_query($conn,"SELECT * from memberdb WHERE idmember='$member'");
		$mmm = $memberget->fetch_assoc();
		if($memberget->num_rows!=0){
			$xx = mysqli_query($conn,"SELECT itemno,qty FROM orderdb WHERE orderid = '$orderid'");
			$roww = $xx->fetch_assoc();
			$float_total = 0;
			$pointadd = 0;
			do{
				$yy = mysqli_query($conn,"SELECT price,name FROM menuitems WHERE itemno = '$roww[itemno]'");
				while($rowww = $yy->fetch_assoc()){
					$float_a = floatval($rowww['price'])*floatval($roww['qty']);
					$float_total = $float_total + $float_a ;
				}
			} while($roww = $xx->fetch_assoc());
			$pointadd = intval($mmm['memberpoint'])+intval($float_total/10);
			$sql = "UPDATE memberdb SET memberpoint='$pointadd' WHERE idmember='$member'";

			if ($conn->query($sql) === FALSE) {
				echo "Error updating record: " . $conn->error;
			}
		}else{
			echo "Not member.";
		}
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