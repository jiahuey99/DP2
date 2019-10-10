
<!DOCTYPE html>
<html>
	<title>Menu List</title>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
		#foodDIV {
		  width: 100%;
		  padding: 50px 0;
		  text-align: center;
		  background-color: lightblue;
		  height:400px;
		  width:500px;
		  display: none;
		}
		#bevDIV2 {
		  width: 100%;
		  padding: 50px 0;
		  text-align: center;
		  background-color: pink;
		  height:400px;
		  width:500px;
		  display:none;
		}

		#menuNav {
		  
		  border: 1px solid #ccc;
		  background-color: #f1f1f1;
		}

		/* Style the buttons inside the tab */
		.menuNav button {
		  background-color: inherit;
		  float: left;
		  border: none;
		  outline: none;
		  
		  padding: 14px 16px;
		  font-weight:bold;
		  font-size: 18px;
		}

		/* Change background color of buttons on hover */
		.menuNav button:hover {
		  background-color: #ddd;
		}
		th {
		  padding-top: 12px;
		  padding-bottom: 12px;
		  width:150px;
		  
		  color: white;
		}



		</style>
	</head>
	
	<body>

		<div class="menuNav">
			<button onclick="categorize('food')">Food</button>
			<button onclick="categorize('beverage')">Beverage</button>
		</div>

		<div id="foodDIV">
			
			<table>
				<tr>
					<th>Items</th>
					<th>Unit Price</th>
				</tr>
			<?php
			$conn=mysqli_connect("localhost","root","","menu");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT name,price from menuitems where category='Food'";
			$result =$conn ->query($sql);
			
			if($result-> num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr><td>".$row["name"]."</td><td>".$row["price"]."</td></tr>";
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
				</tr>
			<?php
			$conn=mysqli_connect("localhost","root","","menu");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT name,price from menuitems where category='Beverage'";
			$result =$conn ->query($sql);
			
			if($result-> num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr><td>".$row["name"]."</td><td>".$row["price"]."</td></tr>";
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

	<script>
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


	</script>

	</body>
</html>

