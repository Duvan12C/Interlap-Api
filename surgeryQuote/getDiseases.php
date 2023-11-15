<?php

require_once('../newConnectionDB.php');

// Get data from table
$sql = "SELECT * FROM cotizar_enfermedades";
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
    echo "0 results";
}

$conn->close();

?>

