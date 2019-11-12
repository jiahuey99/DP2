<?php
	include_once 'connection.php';
	
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="order_page.css?b={random number/string}">
</head>
<body>
<?php include'navigation.php'?>
<script type="text/javascript">
function confirm_click()
{
return confirm("Are you sure you want to delete order?");
}
</script>
<div id=title>Order Details</div>
</br>
<div id=fulltable>
<table>
<tr>
	<th id=smallth>Order ID</th>
	<th id=smallth>Table</th>
	<th id=bigth>Food Name</th>
	<th id=smallth>Quantity</th>
	<th id=smallth>Subtotal</th>
	
</tr>
<?php
	$extract = mysqli_query($conn,"SELECT DISTINCT orderid FROM orderdb");
	if($extract->num_rows>0){

		while($row = $extract-> fetch_assoc()){
				echo "<tr><td class='top'>".$row['orderid']."</td>";
				$xx = mysqli_query($conn,"SELECT itemno, idtable, qty FROM orderdb WHERE orderid = $row[orderid]");
				$roww = $xx->fetch_assoc();
				$float_total = 0;
				echo "<td class='top'>".$roww['idtable']."</td>";
				do{
					$yy = mysqli_query($conn,"SELECT price,name FROM menuitems WHERE itemno = $roww[itemno]");
					
					while($rowww = $yy->fetch_assoc()){
						$float_a = floatval($rowww['price'])*floatval($roww['qty']);
						$float_total = $float_total + $float_a ;
						echo "<td>".$rowww['name']."</td><td>".$roww['qty']."</td><td>".$float_a."</td></tr><td></td><td></td>";
					}

				} while($roww = $xx->fetch_assoc());
				
			echo "<td class='total'></td><td class='total' id='total2'>TOTAL:</td>
				<td class='total' id='total2'>".$float_total."</td>
				<td id=icon> <a href='edit.php?orderid=$row[orderid]'><img src='edit.png' width='30' height='30'></a></td>
				<td id=icon><a href='delete_order.php?orderid=$row[orderid]' onclick='return confirm_click();'><img src='cross.png' width='28' height='28'></a></td>
				<td id=icon><a href='paymentsy.php?orderid=$row[orderid]'><img src='pay.png' width='30' height='30'></a></td>";
			}
		
		echo "</table>";
	}else{
		echo "no result.";
	}
	$conn->close()
?>
</table>
	</div>
</body>
</html>