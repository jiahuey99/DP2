<?php
	include_once 'connection.php';
?>
<!DOCTYPE html>
<html>
<head>
<title>Order Details</title>
<link rel="stylesheet" href="salesreportform.css?nn={random number/string}">
</head>
<header>
	<?php include'navigation.php'?>
</header>
<body>
<h1>Enter Date for Sales Report</h1>
<form action = 'salesreport.php' method="POST">
<fieldset>
<legend> Daily Report</legend>
Start Date: <input type="date" name="sdate" value="<?php echo date('Y-m-d'); ?>" />
 Finish Date: <input type="date" name="fdate" value="<?php echo date('Y-m-d'); ?>" />
 
<br><br>
<input type='submit' value='Generate'>
</fieldset>
</form>
<br>
<form action = 'salesreportm.php' method="POST">
<fieldset>
<legend> Monthly Report</legend>
Start Date: <input type="date" name="sdate" value="<?php echo date('Y-m-d'); ?>" />
 Finish Date: <input type="date" name="fdate" value="<?php echo date('Y-m-d'); ?>" />
 
<br><br>
<input type='submit' value='Generate'>
</fieldset>
</form>
<br>
</body>
</html>