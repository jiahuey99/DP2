
<!DOCTYPE html>
<html>
	<title>Menu List</title>
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<style>
		#editDIV {
		  
		  display: none;
		}
		#removeDIV {
		 
		  display:none;
		}
		</style>
	</head>
	
	<body>

		<div id="menulist">
			
			<table>
				<tr>
					<th> No</th>
					<th> Name</th>
					<th> price</th>
					<th> category</th>
					<th> Discount</th>
					<th></th>
					
				</tr>
			<?php
			$conn=mysqli_connect("localhost","root","","menu");
			if($conn->connect_error){
				die("Connection failed:".$conn->connect_error);
			}
			$sql= "SELECT ITEMNO,name,price,category,discount from menuitems ";
			$result =$conn ->query($sql);
			
			if($result-> num_rows>0){
				while($row=$result->fetch_assoc()){
					echo "<tr>
					<td>".$row["ITEMNO"]."</td>
					<td>".$row["name"]."</td>
					<td>".$row["price"]."</td>
					<td>".$row["category"]."</td>
					<td>" .$row["discount"]."</td>
					</tr>";
				}
				echo"</table>";
			}
			else{
				echo "0 result ";
			}
			
			
				$conn->close();
			?>
			</table>
			</br>
			
		</div>
		
		<div class="edit">
			<button onclick="btn('edit')">Edit</button>
			<button onclick="btn('remove')">Remove</button>
		</div>
		
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
				$image= $_FILES['image']['name'];
			
			$add = mysqli_query($conn,"SELECT * FROM menuitems WHERE name='$itemname'");
			if($add->num_rows==0){
			$sql = "UPDATE menuitems SET name='$item_name',price='$item_price', discount='$item_discount', category='$item_category',img='$image' WHERE ITEMNO = $item_no" ;
			mysqli_query($conn,$sql);
		 
			}else{
				die("The item has already exist");
			}
	
			header("Location: editmenu.php?edit=success");
          #  $sql = "UPDATE menuitems SET name='$item_name',price='$item_price', discount='$item_discount', category='$item_category',img='$image' WHERE ITEMNO = $item_no" ;
           
           # $retval = $conn ->query($sql);
            
            #if(! $retval ) {
             #  die('Could not delete data: ' . mysql_error());
            #}
            
            #echo "Deleted data successfully\n";
            #header("Location: editmenu.php?delete=success");
			 
		 }
		 else {
		?>
		<div id="editDIV">
			<form method = "post" >     
                   </br>
				   
                        item no
                        <input name = "item_no" type = "text" 
                           id = "item_no">
					</br>
					</br>
					<b>Edit :</b>
						</br>
						</br>
						Name
						<input name = "item_name" type = "text" 
                           id = "item_name">
					</br>
					</br>
					Price 
					<input name = "item_price" type = "text" 
                           id = "item_price">
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
                           id = "discount">
                     
                     </br>
                     </br>
					 
					 Image:
						<input type="file" name="image" id="image">
					 </br>
                     </br>
                       <input name = "edit" type = "submit" id = "edit" value = "Submit">

                  </table>
               </form>
		
		
		</div>
		<div id="removeDIV">
			<form method = "post" >     
                     <tr>
					 <b>Removing Item:</b></br></br>
                        <td width = "100">Item No: </td>
                        <td><input name = "item_no" type = "text" 
                           id = "item_no"></td>
                     </tr>
                     
                     <tr>
                        <td width = "100"> </td>
                        <td> </td>
                     </tr>
                     
                     <tr>
                        <td width = "100"> </td>
                        <td>
                           <input name = "delete" type = "submit"  id = "delete" value = "Confirm">
                        </td>
                     </tr>
                     
                  </table>
               </form>
		
		
		</div>
		
			<?php
			
         }
      ?>
		
	
		

	</body>
</html>

