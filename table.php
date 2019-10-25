<?php
	include_once 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Manage Table</title>
</head>
<body>
<h1>Manage Table</h1>
<table border="1">
<tr>
	<th>TableID</th>
	<th>Reservation Name</th>
	<th>Reservation Time</th>
</tr>
<?php
	$tablefortable = mysqli_query($conn,"SELECT * FROM tabledb");
	if($tablefortable->num_rows>0){
		while($rowww = $tablefortable-> fetch_assoc()){
			echo "<tr><td>".$rowww['idtable']."</td><td>".$rowww['reservename']."</td><td>".$rowww['reservetime']."</td></tr>";
	}
	}
	echo "</table>";
	
?>

<h2>Add Table:</h2>
<form action="inserting.php" method="POST">
Table Number:
<input type = "text" name="table_num">
<br>
<br>
<input type="submit" value="Submit">
</form>

<br><br>

<h2>Remove Table:</h2>
<form action="removing_table.php" method="POST">
Table Number:
<input type = "text" name="table_num_d">
<br><br>
<input type="submit" value="Submit">
</form>
</body>
</html>