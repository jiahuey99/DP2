
<!DOCTYPE html>
<html>
	<title>Menu List</title>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="menu1.css?c={random number/string}">
		
		
		
	</head>
	<header>
	<?php include'navigation.php'?>
	</header>
	
	<body>
	<div id=table >
	<?php
		
		$conn=mysqli_connect("localhost","root","","tabletable");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT itemno,name,price,img from menuitems where category='Food'";
			$result = mysqli_query($conn,$sql);
			if($result->num_rows>0){
				
				$sqltable=mysqli_query($conn, "SELECT idtable FROM tabledb");
					echo "Table No <select name='id' onChange='myFunction(event)'>";
					while($rowtable = $sqltable->fetch_assoc())
					{
						echo 
						" <option value=".$rowtable['idtable'].">".$rowtable['idtable']."</option>";
					}
					echo "</select>";
			}
	?>
	</div>
	
		<div class="menuNav">
			<button onclick="categorize('food')">Food</button>
			<button onclick="categorize('beverage')">Beverage</button>
		</div>
		<p></p><br><br>
		<form method="post" action="add_order.php">
		<div id="foodDIV">
			
			<table>
				<tr >
					<th> </th>
					<th>Items</th>
					<th>Unit Price</th>
					<th id=qtyth >Quantity</th>					
					<th id=removeth></th>
				</tr>
			<?php
			$conn=mysqli_connect("localhost","root","","tabletable");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT itemno,name,price,img from menuitems where category='Food'";
			$result =$conn ->query($sql);

			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr>";
					echo "<td>";?> <img id=list src="<?php echo $row["img"];?>" height="80" width="80"><?php echo"</td>";
					echo
						"
	
						<td><input type='hidden' name='order[".$row['itemno']."][itemno]' value='".$row['itemno']."'>".$row["name"]."</td>
						<td>RM    ".$row["price"]."</td>
						<td id=qty><input type='number' min='0' step='1' name='order[".$row['itemno']."][quantity]'></td>
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
					<th> </th>
					<th>Items</th>
					<th>Unit Price</th>
					<th id=qtyth >Quantity</th>
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
					echo "<tr>";
					echo "<td>";?> <img id=list src="<?php echo $row["img"];?>" height="80" width="80"><?php echo"</td>";
					echo
						"
						
						<td><input type='hidden' name='order[".$row['itemno']."][itemno]' value='".$row['itemno']."'>".$row["name"]."</td>
						<td>RM    ".$row["price"]."</td>
						<td id=qty><input type='number' min='0' step='1' name='order[".$row['itemno']."][quantity]'></td>
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
		<h1> TESTING </h1>
		
		<?php echo "<input type='number' id='tableid' name='idtable'>"; ?>


		<button id="btn" type="submit">Add Order</button>
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


	function myFunction(e) {
    document.getElementById('tableid').value = e.target.value
	console.log('yooo')
}
	</script>

	</body>
</html>

