<?php
	include_once 'connection.php';
	
?>

<!DOCTYPE html>
<html>
<head>
<title>Reservation</title>
<link rel="stylesheet" href="order_page.css?b={random number/string}">
</head>
<body>
<?php include'navigation.php'?>

<div id=title>Reservation</div>
</br>

<?php
		
		$conn=mysqli_connect("localhost","root","","tabletable");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
            }
            echo
            "<table> <tr>
            <th> Table Number </th> <th> Name </th> <th> time </th> </tr>"; 
			$sqltable=mysqli_query($conn, "SELECT idtable FROM tabledb");
					echo "<tr><td>Table No <select name='id'>";
					while($rowtable = $sqltable->fetch_assoc())
					{
						echo 
						" <option value=".$rowtable['idtable'].">".$rowtable['idtable']."</option>";
					}
					echo "</select></td> </tr> </table>" ;
	?>
</body>
</html>