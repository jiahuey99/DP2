<?php
	include_once 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="order_css.css">
</head>
<body>
<h1>Order Details</h1>
<table>
<tr>
	<th>Order ID</th>
	<th>Table ID</th>
	<th>Food</th>
	<th>Quantity</th>
	<th>Subtotal</th>
</tr>
<?php
	$extract = mysqli_query($conn,"SELECT DISTINCT orderid FROM orderdb");
	if($extract->num_rows>0){
		$float_total = 0;
		while($row = $extract-> fetch_assoc()){
				echo "<tr><td class='top'>".$row['orderid']."</td>";
				$xx = mysqli_query($conn,"SELECT itemno, idtable, qty FROM orderdb WHERE orderid = $row[orderid]");
				$roww = $xx->fetch_assoc();
				echo "<td class='top'>".$roww['idtable']."</td>";
				while($roww = $xx->fetch_assoc()){
					$yy = mysqli_query($conn,"SELECT price FROM menuitems WHERE itemno = $roww[itemno]");
					
					while($rowww = $yy->fetch_assoc()){
						$float_a = floatval($rowww['price'])*floatval($roww['qty']);
						$float_total = $float_total + $float_a ;
						echo "<td>".$roww['itemno']."</td><td>".$roww['qty']."</td><td>".$float_a."</td></tr><td></td><td></td>";
					}
				}
			echo "<td class='total'></td><td class='total' id='total2'>TOTAL:</td><td class='total' id='total2'>".$float_total."</td>";
		}
		
		echo "</table>";
	}else{
		echo "no result.";
	}
	$conn->close()
?>
</table>
	
</body>
</html>