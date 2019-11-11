<?php
	include_once 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="order_css.css">
</head>
<body>
<h1>Enter Date for Sales Report</h1>
<form action = 'salesreport.php' method="POST">
Start Date: <input type="date" name="sdate" value="<?php echo date('Y-m-d'); ?>" />
 Finish Date: <input type="date" name="fdate" value="<?php echo date('Y-m-d'); ?>" />
 
<br><br>
<input type='submit' value='Generate'>
</form>
<br>
<form action = 'salesreportm.php' method="POST">
Start Date: <input type="date" name="sdate" value="<?php echo date('Y-m-d'); ?>" />
 Finish Date: <input type="date" name="fdate" value="<?php echo date('Y-m-d'); ?>" />
 
<br><br>
<input type='submit' value='Generate'>
</form>
<br>
<form action = 'salesreportall.php'>
<input type='submit' value='Generate All'>
</form>
</body>
</html>