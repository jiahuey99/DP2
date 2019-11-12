
<!DOCTYPE html>
<html>
	<title>Menu List</title>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="edimenu.css?c={random number/string}">
	</head>
	
	
	<body>
	
	<?php include'navigation.php'?>
	
		
		
		
		
		<script>
			function btn(actions) {
				if(actions=='edit'){
				  var x = document.getElementById("editDIV");
				  var y=document.getElementById("removeDIV");
				  if (x.style.display !== "block"){
					  x.style.display = "block";
				  }
				  if (y.style.display !== "none"){
					  y.style.display = "none";
				  }
				}
			else if(actions=='remove'){
				var x = document.getElementById("removeDIV");
				var y=document.getElementById("editDIV");
				if (x.style.display !== "block"){
					  x.style.display = "block";
				}
				  if (y.style.display !== "none"){
					  y.style.display = "none";
				  }
			}
			}
			

	</script>
	<?php		
		if(isset($_POST['delete'])) {
			
			$conn=mysqli_connect("localhost","root","","menu");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
				
            $item_no = $_POST['item_no'];
            
            $sql = "DELETE FROM menuitems WHERE ITEMNO = $item_no" ;
           
            $retval = $conn ->query($sql);
            
            if(! $retval ) {
               die('Could not delete data: ' . mysql_error());
            }
            
            echo "Deleted data successfully\n";
            header("Location: editmenu.php?delete=success");
           
         }
		 else if(isset($_POST['edit'])){
			$conn=mysqli_connect("localhost","root","","menu");
			
			
			
            $item_no = $_POST['item_no'];
            $item_name=$_POST['item_name'];
			$item_price=$_POST['item_price'];
			$item_discount=$_POST['item_discount'];
			$item_category=$_POST['item_category'];
			$itemimg = $_POST['image'];
				
			
			$add = mysqli_query($conn,"SELECT * FROM menuitems WHERE name='$item_name'");
			if($add->num_rows==0){
			$sql = "UPDATE menuitems SET name='$item_name',price='$item_price', discount='$item_discount', category='$item_category',img='$itemimg' WHERE ITEMNO = $item_no" ;
			mysqli_query($conn,$sql);
			
			}else{
				die("The item has already exist");
			}
			header("Location: editmenu.php?edit=success");
			$conn->close();
			#header("Location: editmenu.php?edit=success");
			
          #  $sql = "UPDATE menuitems SET name='$item_name',price='$item_price', discount='$item_discount', category='$item_category',img='$image' WHERE ITEMNO = $item_no" ;
           
           # $retval = $conn ->query($sql);
            
            #if(! $retval ) {
             #  die('Could not delete data: ' . mysql_error());
            #}
            
            #echo "Deleted data successfully\n";
            #header("Location: editmenu.php?delete=success");
			 
		 }
		 
      ?>
		
	<section>
		<div class="editremove">
			<button onclick="btn('edit')">Edit</button>
			<button onclick="btn('remove')">Remove</button>
			</br></br></br></br></br>
		</div>
		<div id="editDIV">
			<form method = "post" >     
                   
				   
                        
                        
					
					<fieldset>
					</br>
					<legend>
					
					Edit Item
					</legend>
						
						<?php						  
						 $conn=mysqli_connect("localhost","root","","menu");
						if($conn->connect_error){
								die("Connection failed:".$conn->connect_error);
						}
				
						$sql= "SELECT ITEMNO FROM menuitems";
						$result =$conn ->query($sql);
						if($result->num_rows>0){
						echo "ITEM No: <select name='item_no'>";
						while($row=$result->fetch_assoc())
						{
							$itm=$row['ITEMNO'];
						echo 
					
							"<option value='$itm'>$itm</option>";
						}
						echo "</select>";
						}
                     $conn->close();
                 ?>
				 </br></br>
						Name
						<input name = "item_name" type = "text" id = "item_name" >
					</br>
					</br>
					Price 
					<input name = "item_price" type = "text" 
                           id = "item_price" placeholder="0.00" size="5">
					</br>
					</br>
					
					Category
					<select name="item_category" id="item_category">
								<option value="Food">Food</option>
								<option value="Beverage">Beverage</option>
							</select>
					</br>
					</br>
					Discount
					<input name = "item_discount" type = "text" 
                           id = "discount" placeholder="0.00" size="5">
                     
                     </br>
                     </br>
					 
					 Image:
						<input type="file" name="image" id="image">
					 </br>
                     </br>
                       <input name = "edit" type = "submit" id = "deletebtn" value = "Save">

                 </fieldset>
               </form>
		
		
		</div>
		<div id="removeDIV">
			<form method = "post" >
			<fieldset id=removefs>			
                     <legend>Remove Item</legend>
					  </br>
					
				<?php						  
						 $conn=mysqli_connect("localhost","root","","menu");
						if($conn->connect_error){
								die("Connection failed:".$conn->connect_error);
						}
				
						$sql= "SELECT ITEMNO FROM menuitems";
						$result =$conn ->query($sql);
						if($result->num_rows>0){
						echo "ITEM No: <select name='item_no'>";
						while($row=$result->fetch_assoc())
						{
							$itm=$row['ITEMNO'];
						echo 
					
							"<option value='$itm'>$itm</option>";
						}
						echo "</select>";
						}
                     $conn->close();
                 ?>
				 
                     </br> </br>
                     <input name = "delete" type = "submit"  id = "deletebtn" value = "Remove">
                     
                     
                 
				  </fieldset>
               </form>
		
		
		</div>
		
		</section>
		<div id="menulist">
			<table>
				<tr>
					<th> No</th>
					<th> Name</th>
					<th> Price</th>
					<th> Category</th>
					<th> Discount</th>
					
					
					
				</tr>
			<?php
			$conn=mysqli_connect("localhost","root","","menu");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT ITEMNO,name,price,category,discount from menuitems ";
			$result =$conn ->query($sql);
			
			if($result->num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr>
					<td class=itemno>".$row["ITEMNO"]."</td>
					<td>".$row["name"]."</td>
					<td>RM  ".$row["price"]."</td>
					<td>".$row["category"]."</td>
					<td id=distd>".$row["discount"]."</td>
					
					</tr>";
					#<td id=removebtn><img src='cross.png' width='20' height='20'></td>
				}
				echo"</table>";
			}
			else{
				echo "0 result ";
			}
				
			?>
			</table>
			</br>
			
		</div>
		

	</body>
</html>

