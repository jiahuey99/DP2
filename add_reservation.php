<?php
    include_once 'connection.php';
    
    $name = $_POST['name'];
    $idtable = $_POST['tableid'];
    $idtime = $_POST['idtime'];
    $iddate = $_POST['dateee'];
    echo $iddate;

   
    $sql .= "INSERT INTO reservation (idtable, name, time,date) 
    VALUES ('$idtable','$name','$idtime','$iddate');";


    if ($conn->multi_query($sql) === TRUE) {
    header("Location: order_page.php");
    }   else {
    echo "Error: " . $sql . "<br>" . $conn->error;
    }

$conn->close();
?>

