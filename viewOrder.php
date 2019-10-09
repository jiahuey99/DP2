<!DOCTYPE html>
<html>
<head>
<title>Table with database</title>
<style>
table {
border-collapse: collapse;
width: 100%;
color: #588c7e;
font-family: monospace;
font-size: 25px;
text-align: left;
}
th {
background-color: #588c7e;
color: white;
}
tr:nth-child(even) {background-color: #f2f2f2}
</style>
</head>
	
	
	
<body>
<table>
<tr>
<th>TableID</th>
<th>TeaQty</th>
<th>CoffeeQty</th>
<th>NoodlesQty</th>
<th>RiceQty</th>
<th>EggQty</th>
<th>CakeQty</th>	
<th>MiloQty</th>	
</tr>
	
<?php
$conn = mysqli_connect("localhost", "root", "", "test");
// Check connection
if ($conn->connect_error) {
die("Connection failed: " . $conn->connect_error);
}
$sql = "SELECT * FROM orderdb";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
// output data of each row
while($row = $result->fetch_assoc()) {
echo "<tr><td>" 
	. $row["tableid"]. "</td><td>" 
	.$row["teaqty"]. "</td><td>"
	.$row["coffeeqty"]. "</td><td>"
	.$row["noodlesqty"]. "</td><td>"
	.$row["riceqty"]. "</td><td>"
	.$row["eggqty"]. "</td><td>"
	.$row["cakeqty"]. "</td><td>"
	.$row["miloqty"]. "</td></tr>";	
}
echo "</table>";
} else { echo "0 results"; }
$conn->close();
?>
</table>
</body>
</html>