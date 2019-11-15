<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="paymentsy.css?f={random number/string}">
</head>
<header>
	<?php include'navigation.php'?>
	</header>
<body onload="renderTime();">
<div id=title>
    Payment
</div>
<div id=fullbody>

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

<div id="clockDisplay" class="container">
<?php
echo "<br>Date : " . date("Y/m/d") . date(" (l)"). "<br>";
		
		date_default_timezone_set("Asia/Kuala_Lumpur");
		echo "Time : " . date("h:i:sa"). "<br>";
?>

<?php
echo "<br><b>Order ID:  $orderid</b><br>";
				$xx = mysqli_query($conn,"SELECT itemno, idtable, qty FROM orderdb WHERE orderid = $orderid");
				$roww = $xx->fetch_assoc();
				$float_total = 0;
				echo "<b>Table No:  ".$roww['idtable']."</b>";?>
				</br></br>
				</div>
				
<br>
				
				<table>
				
				<th id=qtyitm>Item</th>
				
				<th>Subtotal</th>
				<th> </th>
				<?php
				do{
					$yy = mysqli_query($conn,"SELECT price,name FROM menuitems WHERE itemno = $roww[itemno]");
					
					while($rowww = $yy->fetch_assoc()){
						$float_a = floatval($rowww['price'])*floatval($roww['qty']);
						$float_total = $float_total + $float_a ;
						
						echo "<tr><td id=qtyitm>".$roww['qty']."  x  ".$rowww['name']." </td><td>RM  ".$float_a."</td></tr>";
					}

				} while($roww = $xx->fetch_assoc());
				
				echo "<td class='total'></td><td class='total' id='total2'>TOTAL</td><td class='total' id='total3'>RM  ".$float_total."</td>";
		
		
		echo "</table>";
?>
<br>
Amount Received:  <input id="amountt" type="text" name="amount"placeholder="0.0" size="5">
<button id=btn type="button" onclick="calculate()">Count</button>
</br>
<p id ="balancee">Balance:</p>
</br>
<div id=member>
				<?php echo"<form action = 'totransaction.php?'> <br> 
				<input type='hidden' name='orderid' value='$orderid'><br><br>
				Member Name: <input type = 'text' name ='membername'>
				<input id=btn type='submit' value='Save Record'></form>"
				?>
				</div>


<script>
function calculate(){
	var x = parseFloat(document.getElementById("amountt").value);
	var y = parseFloat(document.getElementById("total3").innerHTML);
	var z = Number(parseFloat(x-y)).toFixed(2);
	document.getElementById("balancee").innerHTML = "Balance: "+ z + "<br>";
	
	
}
</script>
</div>

</body>
</html>