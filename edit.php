<?php
function getQty($results, $itemno) {
	$qty = NULL;
	foreach ($results as $result) {
		if ($result['itemno'] == $itemno) {
			$qty = $result['qty'];
			break;
		}
	}
	return $qty;
	
	
}

function getDis($results, $itemno) {
	$discount = NULL;
	foreach ($results as $result) {
		if ($result['itemno'] == $itemno) {
			$discount = $result['discount'];
			break;
		}
	}
	return $discount;
	
	
}

function getMemo($results, $itemno) {
	$comment = NULL;
	foreach ($results as $result) {
		if ($result['itemno'] == $itemno) {
			$comment = $result['comment'];
			break;
		}
	}
	return $comment;
	
	
}
	
	
	


?>
<!DOCTYPE html>
<html>
	<title>Edit Order</title>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="edit.css?d={random number/string}">
	</head>
	<header>
	<?php include'navigation.php'?>
	</header>
	<body>
	
		<?php
			require('connection.php');
			if(isset($_GET['orderid']))
			{
			$oid = mysqli_real_escape_string($conn,$_GET['orderid']);	
			}
			else
			{
				echo"No Order ID";
			}

			
		?>



		<div class="menuNav">
			<button onclick="categorize('food')">Food</button>
			<button onclick="categorize('beverage')">Beverage</button>
		</div>
		<p></p><br><br>
		<form method="post" action="edit_order.php">
		<?php
			echo "<input type='hidden' name='orderID' value='".$oid."'>";
			
			//
			$sqledit = "SELECT itemno,qty,discount,comment FROM orderdb where orderid = $oid";
			$resultedit = $conn->query($sqledit);
			$resultedit = $resultedit->fetch_all(MYSQLI_ASSOC);
			
		?>
		<div id="foodDIV">
			
			<table>
				<tr>
					
					<th>Items</th>
					<th>Unit Price</th>
					<th id=qtyth >Quantity</th>	
					<th>Discount</th>
					<th>Comment</th>
					<th id=removeth></th>
				</tr>
				
			<?php
			$conn=mysqli_connect("localhost","root","","tabletable");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT itemno,name,price from menuitems where category='Food'";
			$result =$conn ->query($sql);

			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr>
						<td><input type='hidden' name='order[".$row['itemno']."][itemno]' value='".$row['itemno']."'>".$row["name"]."</td>
						<td >RM  <input id=price type='number' readonly name='order[".$row['itemno']."][price]' value='".$row['price']."'></td>
						<td id=qty ><input type='number' min='0' step='1' name='order[".$row['itemno']."][quantity]' value='".getQty($resultedit,$row['itemno'])."'></td>
						<td><input type='number' min='0' step='1' name='order[".$row['itemno']."][discount]' value='".getDis($resultedit,$row['itemno'])."'></td>
						
						<td><input type='text' rows='1' cols='50' name='order[".$row['itemno']."][comment]' value='".getMemo($resultedit,$row['itemno'] )."' ></td>
						
						<td id=removebtn><img src='cross.png' width='20' height='20' onclick='removeItem(".$row['itemno'].")'></td>
					</tr>";
				} 
				echo"</table>";
			}
			else{
				echo "0 result ";
			}
			$conn->close();
			?>
			</table>
			
		</div>
		<div id="bevDIV2">
			
			<table>
				<tr>
					
					<th>Items</th>
					<th>Unit Price</th>
					<th id=qtyth >Quantity</th>
					<th>Discount</th>
					<th>Comment</th>
					<th id=removeth></th>
				</tr>
			<?php
			$conn=mysqli_connect("localhost","root","","tabletable");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT itemno,name,price,img from menuitems where category='Beverage'";
			$result =$conn ->query($sql);
			
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr>
						<td><input type='hidden' name='order[".$row['itemno']."][itemno]' value='".$row['itemno']."'>".$row["name"]."</td>
						<td>RM  <input id=price type='number' readonly name='order[".$row['itemno']."][price]' value='".$row['price']."'></td>
						<td id=qty><input  type='number' min='0' step='1' name='order[".$row['itemno']."][quantity]' value='".getQty($resultedit,$row['itemno'])."'></td>
						<td><input type='number' min='0' step='1' name='order[".$row['itemno']."][discount]' value='".getDis($resultedit,$row['itemno'])."'></td>
						
						<td><input type='text' rows='1' cols='50' name='order[".$row['itemno']."][comment]' value='".getMemo($resultedit,$row['itemno'] )."' ></td>
						
						<td id=removebtn><img src='cross.png' width='20' height='20' onclick='removeItem(".$row['itemno'].")'></td>
					</tr>";
				}
				echo"</table>";
			}
			else{
				echo "0 result ";
			}
			$conn->close();
			?>
			</table>
			
		</div>
		<button id=btn type="submit">Update Order</button>
		</form>

	<script>
	categorize('food');

	function categorize(ctg) {
		if(ctg=='food'){
		  var x = document.getElementById("foodDIV");
		  var y=document.getElementById("bevDIV2");
		  if (x.style.display !== "block"){
			  x.style.display = "block";
		  }
		  if (y.style.display !== "none"){
			  y.style.display = "none";
		  }
		}
	else if(ctg=='beverage'){
		var x = document.getElementById("bevDIV2");
		var y=document.getElementById("foodDIV");
		if (x.style.display !== "block"){
			  x.style.display = "block";
		}
		  if (y.style.display !== "none"){
			  y.style.display = "none";
		  }
	}
	}

	function removeItem(item){
		document.getElementsByName('order['+item+'][quantity]')[0].value = '';	
	}

	</script>

	</body>
</html>

