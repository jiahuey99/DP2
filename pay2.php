<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pay</title>
</head>

<body>
	<table>
	<tr>
		
			
		</tr>
	<?php

		$conn =mysqli_connect("localhost","root","","tabletable");
		if($conn-> connect_error)
		{
			die("Connection failed:".$conn->error);
		}
		
		
		
		$sql="SELECT sum(subtotal) as'sumsubtotal' from orderdb WHERE orderid=orderid";
	
		$result =$conn->query($sql);
		
		
		if($result-> num_rows >0)
		{
			$float_total = 0;
			while($row =$result-> fetch_assoc())
			{
				
				echo"Total amount : ".$row["sumsubtotal"];
				//$a=$_GET['num'];
				//echo intval("Balance : ".($row["sumsubtotal"]-$a));
				
				
			}

			echo"</table>";
		
		}
		else
		{
			echo"0 result";
		}
		
		$conn->close();
		
	
?>
	
	</table>
	
	
</body>
	
</html>