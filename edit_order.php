<?php
    include_once 'connection.php';

    if (!$_POST['order'] || !$_POST['orderID'])
    {  
        header("Location: order_page.php");
    }

    $oid = mysqli_real_escape_string($conn,$_POST['orderID']);     

    // Remove Empty items from the menu
    $orderItems = array_filter($_POST['order'], function($orderItem) {
        return $orderItem['quantity'] != null && $orderItem['quantity'] != 0
			&& $orderItem['discount'] != null	&& $orderItem['discount'] !=0;
    });
    $sql = '';
    foreach ($orderItems as $itemno => $orderItem) {
        $subtotal = $orderItem['price'] * $orderItem['quantity'];
        $sql .= "UPDATE orderdb SET qty = ".$orderItem['quantity'].", subtotal = ".$subtotal." WHERE orderid = ".$oid." AND itemno = ".$itemno.";";
			$sql .="UPDATE orderdb SET discount = ".$orderItem['discount'].",subtotal = ".$subtotal." WHERE orderid = ".$oid." AND itemno = ".$itemno.";";
		$sql .="UPDATE orderdb SET comment = ".$orderItem['comment'].",subtotal = ".$subtotal." WHERE orderid = ".$oid." AND itemno = ".$itemno.";";
    }

    $deletedItems = array_filter($_POST['order'], function($orderItem) {
        return $orderItem['quantity'] == null || $orderItem['quantity'] == 0;
    });

    foreach ($deletedItems as $itemno => $deletedItem) {
        $sql .= "DELETE from orderdb WHERE orderid = ".$oid." AND itemno = ".$itemno.";";
    }

    if ($conn->multi_query($sql) === TRUE) { //Multi query ki jaga khali query and no need for itemnum above
        header("Location: order_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>