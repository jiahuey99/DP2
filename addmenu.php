<!DOCTYPE html>
<html>
<head>
<title>Manage Table</title>

</head>
<body>
<h1>Manage Menu</h1>
<h2>Add Menu Items:</h2>
<form action="additem.php" method="POST"  enctype="multipart/form-data">
Name:
<input type = "text" name="itemname" required><br>
Price:
<input type = "text" name="itemprice" required><br>
Discount:
<input type = "text" name="itemdiscount"><br>
Category:
  <select name="itemcategory">
    <option value="Food">Food</option>
    <option value="Beverage">Beverage</option>
  </select>
<br>
Image:
	<input type="file" name="image">

<br>
<br>
<input type="submit" value="Submit">
</form>
</body>
</html>