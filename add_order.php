<?php
    include_once 'connection.php';

    if (!$_POST['order']){
        header("Location: order_page.php");
    }
    // Remove Empty items from the menu
    $orderItems = array_filter($_POST['order'], function($orderItem) {
        return $orderItem['quantity'] != null && $orderItem['quantity'] != 0 
			 && $orderItem['discount'] != null	&& $orderItem['discount'] !=null 
	
		
			;
		
	
		
	
    });
    $sql = 'Select max(orderid) as lastId from orderdb';
    $result = $conn->query($sql)->fetch_assoc();
    $sql = '';
    
    $orderId = ++$result['lastId'];
    

    foreach ($orderItems as $itemno => $orderItem) {
		//discount
		
		$disamount = ($orderItem['price'] * $orderItem['quantity'])*($orderItem['discount']/100);
        $subtotal = $orderItem['price'] * $orderItem['quantity']-$disamount;
        $sql .= "INSERT INTO orderdb (orderid, itemno, qty, idtable, subtotal, discount, comment) 
        VALUES ('$orderId','$orderItem[itemno]','$orderItem[quantity]',0,'$subtotal','$orderItem[discount]','$orderItem[comment]');";
    }

	

    if ($conn->multi_query($sql) === TRUE) {
        header("Location: order_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>