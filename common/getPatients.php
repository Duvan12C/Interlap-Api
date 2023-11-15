<?php

require_once('../newConnectionDB.php');

$rangeFrom = $_GET['from'];
$rangeFrom = (int)($rangeFrom);

$rangeTo = $_GET['to'];
$rangeTo = (int)($rangeTo);


// Get data from table
$sql = "SELECT * FROM pacientes LIMIT $rangeFrom,$rangeTo";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    ob_clean(); 
    echo json_encode($data);
} else {
    $emptyArray = array();
    ob_clean(); 
    echo json_encode($emptyArray);
}

$conn->close();

?>