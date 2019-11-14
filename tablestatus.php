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

<div id=title>Table Status</div>

<?php
		$conn=mysqli_connect("localhost","root","","tabletable");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
            }
            $reserved = "Reserved";
            echo"<table> <tr> <th> Table ID </th> <th> Date </th> <th> Time </th> <th> Status </th> </tr>";
            
           $sqlres = mysqli_query($conn,"SELECT idtable,date,time FROM reservation"); 
            while($rowres = $sqlres->fetch_assoc())
            {
                echo "<tr> <td>".$rowres['idtable']."</td> <td>".$rowres['date']."</td><td>".$rowres['time']."</td><td>".$reserved."</td></tr>";
            }
            echo"</table>";

            $occupied = "Occupied";
            echo"</br>

            <table><tr> <th> Table ID </th> <th> Status </th> </tr>";
            
            $sqlocc = mysqli_query($conn,"SELECT DISTINCT idtable FROM orderdb");
            while($rowocc = $sqlocc->fetch_assoc())
            {
                echo "<tr> <td>".$rowocc['idtable']."</td> <td>".$occupied."</td></tr>";
            }

            $sqlfree = mysqli_query($conn,"SELECT idtable FROM tableid WHERE NOT EXISTS(SELECT o.idtable FROM ORDERDB AS o ON o.orderid = r.idTABLE");
?>
</table>
</body>
</html>