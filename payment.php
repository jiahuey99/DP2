<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Payment</title>
</head>
        
<body onload="renderTime();">
    <div class="text-center">
         <h1>Receipt</h1>
    </div>
	
	<div id="clockDisplay" class="container"></div>
	
</body>
</html>


<?PHP
session_start();
//databae data that need to link
$conn=mysqli_connect("localhost","root","","")

?>
	
<script>
	function renderTime()
		{
			var mydate = newDate();
			var year = mydate.getYear();
			if(year <1000)
				{
					year+=1900
				
				}
			var day=mydate.getDay();
			var month=mydate.getMonth();
			var daym=mydate.getDate();
			var dayarray=new Array("Sunday","Monday","Tuseday","Wednesday","Thursday","Friday","Saturday);
			var montharray=	new Array("January","february","March","April","May","June","July","August","September","October","November","December");
			
			var currentTime = new Date();
			var h = currentTime.getHours();
			var m = currentTime.getMinutes();
			var s = currentTime.getSeconds();
			if(h==24)
			{
				h=0;
				
			}
			else if(h>12)
			{
				h=h-0;
			}
			
			if(h<10)
				{
					h="0"+h;
			
				}
			if(m<10)
				{
					m="0"+m;
				}
			if(s<10)
				{
					s="0"+s;
				}
			var myclock =document.getElementById("clockDisplay");
			myclock.textContent="" +dayarray[day]+ "" +daym+ "" +montharray[month]+ "" +year+ "|" +h+ ":" +m+ ":" +s;
			myclock.innerText ="" +dayarray[day]+ "" +daym+ "" +montharray[month]+ "" +year+ "|" +h+ ":" +m+ ":" +s;
			
			setTimeout("renderTime()",1000);
		}
	renderTime();
	
	
</script>




--------------------------------------------------------------------------------------------------
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Pay</title>
</head>

<body>
	<table width="600" border="1" cellpadding="1" cellspacing="1">
		
		<h1>Recipt</h1>
		
		<tr>
			<th>orderid</th>
			<th>itemno</th>
			<th>qty</th>
			<th>idtable</th>
			<th>total</th>
		</tr>
		<?php

		$conn =mysqli_connect("localhost","root","","tabletable");
		if($conn-> connect_error)
		{
			die("Connection failed:".$conn->error);
		}
		
		echo "Date : " . date("Y/m/d") . date(" (l)"). "<br>";
		
		date_default_timezone_set("Asia/Kuala_Lumpur");
		echo "Time : " . date("h:i:sa"). "<br>";
		
		$sql="SELECT orderid,itemno,qty,idtable,subtotal from orderdb";
	
		$result =$conn->query($sql);
		
		
		if($result-> num_rows >0)
		{
			while($row =$result-> fetch_assoc())
			{
				
				echo"<tr><td>".$row["orderid"]."</td><td>".$row["itemno"]."</td><td>".$row["qty"]."</td><td>".$row["idtable"]."</td><td>".$row["subtotal"]."</td></tr>";
				
				
			}

			echo"</table>";
		
		}
		else
		{
			echo"0 result";
		}
		
		$conn->close();
		
		echo"Balance :".$row['subtotal']. "<br>";
				
	
		//if(isset($_POST['num1'])){ $name = $_POST['num1']; }
	
		//$num2 = $_POST["num1"];
	
		
		echo"--------------------------------------------------"."<br>";
	
	

		
		?>
		
		
	</table>
	
	
</body>
	<form >
		<input type="text" formmethod="post" name="num1">
		<input type="submit" value="Calculate">
			
	</form>
	
</html>


<?php

$conn =mysqli_connect("localhost","root","","tabletable");
		if($conn-> connect_error)
		{
			die("Connection failed:".$conn->error);
		}


	//$sql="SELECT subtotal from orderdb";
	
	$sql="SELECT SUM(subtotal) from orderdb WHERE orderid=orderid";

	$record =$conn->query($sql);

	while($orderdb==mysql_fetch_assoc($record))
	{
		echo"<td>".$orderdb["subtotal"]."</td>";
	}
	
		
	//echo"Balance :".$data['subtotal']. "<br>"
			
			
			
			
			
?>