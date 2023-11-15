<?php

require_once('../newConnectionDB.php');


$json = file_get_contents('php://input');
$dataBody = json_decode($json);

$patientId = $dataBody->patientId;

$sql = "select * from operatorio where pid='$patientId' order by fecha desc,id desc LIMIT 5";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Output data of each row
    while($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    $emptyArray = array();
    echo json_encode($emptyArray);
}

$conn->close();


?>