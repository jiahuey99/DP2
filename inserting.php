<?php

	include_once 'connection.php';
	
	$table_num = $_POST['table_num'];
	$abc = mysqli_query($conn,"SELECT * FROM tabledb WHERE idtable='$table_num'");
	if($abc->num_rows==0){
		$sql = "INSERT INTO tabledb (idtable) VALUES ('$table_num');";
		mysqli_query($conn,$sql);
	}else{
		die("The table has already exist");
	}
	

	header("Location: table.php?insert=success");

?>