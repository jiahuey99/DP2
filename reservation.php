<?php
	include_once 'connection.php';
	
?>

<!DOCTYPE html>
<html>
<head>
<title>Reservation</title>
<link rel="stylesheet" href="order_page.css?b={random number/string}">
<link rel="stylesheet" href="menu1.css?c={random number/string}">
<meta name="viewport" content="width=device-width, initial-scale=1">

</head>
<body>

<?php include'navigation.php'?>

<div id=title>Reservation</div>
</br>
<form method="post" action="add_reservation.php">

<?php
		$conn=mysqli_connect("localhost","root","","tabletable");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
            }
            echo
            "<table> <tr>
			<th> Table Number </th> <th> Name </th> <th> Time </th> <th> Date </th></tr>"; 
			$sqltime = mysqli_query($conn,"SELECT timedescr FROM timetable");
			$sqltable=mysqli_query($conn, "SELECT idtable FROM tabledb");
					echo "<tr><td>Table No <select name='id' onChange='myFunctionTable(event)'>";
					while($rowtable = $sqltable->fetch_assoc())
					{
						echo"<option value=".$rowtable['idtable'].">".$rowtable['idtable']."</option>";
					}
					echo"</select> <input type='hidden' name='tableid' id='tableid'></td> 
					<td><input type='text' name='name'> </td></td>" ;

					echo"<td>Time <select name='time' onChange='myFunctionTime(event)'>";
					
					while($rowtime = $sqltime->fetch_assoc())
					{
					echo "<option value =".$rowtime['timedescr'].">".$rowtime['timedescr']."</option>";
					}
						echo "</select> <input type='hidden' name='idtime' id='timeid'> </td> 
						<td> <input type='date' name='dateee'> </td></tr> </table>";
	?>

			<button id="btn" type="submit">Reserve</button>
			</form>

<script>
function myFunctionTime(e) {
document.getElementById('timeid').value = e.target.value;
}
function myFunctionTable(e) {
	document.getElementById('tableid').value = e.target.value
}
</script>
</body>
</html>