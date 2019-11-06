<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="order_css.css">
</head>
<body onload="renderTime();">
<div class="text-center">
    <h1>Payment</h1>
</div>
	
<div id="clockDisplay" class="container"></div>
<?php
echo "Date : " . date("Y/m/d") . date(" (l)"). "<br>";
		
		date_default_timezone_set("Asia/Kuala_Lumpur");
		echo "Time : " . date("h:i:sa"). "<br>";
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
<?php
	require('connection.php');
	if(isset($_GET['orderid']))
	{
		$orderid = mysqli_real_escape_string($conn,$_GET['orderid']);	
	}else{
		echo"No Order ID";
	}
?>
</body>
<table border="1">
<th>order id</th>
<th>table id</th>
<th>food</th>
<th>Quantity</th>
<th>Subtotal</th>
<?php
echo "<tr><td class='top'>".$orderid."</td>";
				$xx = mysqli_query($conn,"SELECT itemno, idtable, qty FROM orderdb WHERE orderid = $orderid");
				$roww = $xx->fetch_assoc();
				$float_total = 0;
				echo "<td class='top'>".$roww['idtable']."</td>";
				do{
					$yy = mysqli_query($conn,"SELECT price,name FROM menuitems WHERE itemno = $roww[itemno]");
					
					while($rowww = $yy->fetch_assoc()){
						$float_a = floatval($rowww['price'])*floatval($roww['qty']);
						$float_total = $float_total + $float_a ;
						echo "<td>".$rowww['name']."</td><td>".$roww['qty']."</td><td>".$float_a."</td></tr><td></td><td></td>";
					}

				} while($roww = $xx->fetch_assoc());
				
				echo "<td class='total'></td><td class='total' id='total2'>TOTAL:</td><td class='total' id='total3'>".$float_total."</td>";
		
		
		echo "</table>";
?>
<br>

Amount Receive:  <input type="text" name="amount" id = "amountt">
<button type="button" onclick="calculate()">Count</button>
<p id ="balancee">Balance:</p>
<?php echo"<form action = 'totransaction.php?'> Order Id: <input type='text' name='orderid' value='$orderid'>Member Name: <input type = 'text' name ='membername'><br><br><input type='submit' value='Save Record'></form>"?>
<br>
<script>
function calculate(){
	var x = parseFloat(document.getElementById("amountt").value);
	var y = parseFloat(document.getElementById("total3").innerHTML);
	var z = Number(parseFloat(x-y)).toFixed(2);
	document.getElementById("balancee").innerHTML = "Balance: "+ z + "<br>";
	
	
}
</script>
</html>