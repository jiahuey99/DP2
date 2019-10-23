<?php
    include_once 'connection.php';
/*
    if (!$_POST['order'] || !$_POST['orderID'])
    {  
        header("Location: order_page.php");
    }
*/
    if(isset($_GET['orderid']))
    {
        $oid = mysqli_real_escape_string($conn,$_GET['orderid']);	
        echo $oid;
    }
    else
    {
        echo"No Order ID";
    }

    //$oid = mysqli_real_escape_string($conn,$_POST['orderID']);     

    // Remove Empty items from the menu
   
        $sql .= "DELETE from orderdb WHERE orderid = ".$oid.";";
    

    if ($conn->query($sql) === TRUE) { //Multi query ki jaga khali query and no need for itemnum above
        header("Location: order_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>