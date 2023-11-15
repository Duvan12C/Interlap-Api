<?php

require_once('../newConnectionDB.php');

// Get data from table
$sql = "SELECT * FROM listadocirugias order by nombre asc";
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

