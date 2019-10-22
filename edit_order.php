<?php
    include_once 'connection.php';

    if (!$_POST['order'])
    {  
        echo "Nothing sent";
        //header("Location: order_page.php");
        
    }
    else{
        if(isset($_GET['orderid']))
        {
        $oid = mysqli_real_escape_string($conn,$_GET['orderid']);	
        echo $oid;
        }
        else
        {
            echo"No ID";
        }        
    }
   
/*

    // Remove Empty items from the menu
    $orderItems = array_filter($_POST['order'], function($orderItem) {
        return $orderItem['quantity'] != null && $orderItem['quantity'] != 0;
    });
    // $sql = 'Select max(orderid) as lastId from orderdb';
    // $result = $conn->query($sql)->fetch_assoc();
    // $sql = ''; 
    // $orderId = ++$result['lastId'];
 
    foreach ($orderItems as $itemno => $orderItem) {
        $subtotal = $orderItem['price'] * $orderItem['quantity'];
        $sql .= "UPDATE orderdb SET qty AS $orderItem['quantity] WHERE $orderItem['orderid'] = $oid";
        }

    if ($conn->multi_query($sql) === TRUE) {
        header("Location: order_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    */
   // $conn->close();
?>