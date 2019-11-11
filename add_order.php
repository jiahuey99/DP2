<?php
    include_once 'connection.php';

    if (!$_POST['order']){
        header("Location: order_page.php");
    }
    // Remove Empty items from the menu
    $idtable = $_POST['idtable'];

    $orderItems = array_filter($_POST['order'], function($orderItem) {
        return $orderItem['quantity'] != null && $orderItem['quantity'] != 0;
    });
    $sql = 'Select max(orderid) as lastId from orderdb';
    $result = $conn->query($sql)->fetch_assoc();
    $sql = '';
    
    $orderId = ++$result['lastId'];
    

    foreach ($orderItems as $itemno => $orderItem) {
        $subtotal = $orderItem['price'] * $orderItem['quantity'];
        $sql .= "INSERT INTO orderdb (orderid, itemno, qty, idtable, subtotal) 
        VALUES ('$orderId','$orderItem[itemno]','$orderItem[quantity]','$idtable','$subtotal');";
    }
    echo $idtable;

    if ($conn->multi_query($sql) === TRUE) {
        header("Location: order_page.php");
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
    
    $conn->close();
?>