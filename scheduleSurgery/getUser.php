<?php

require_once('../newConnectionDB.php');

// Obtén el valor de userName de los parámetros GET
$userName = $_GET['userName'];

// Consulta SQL para obtener los datos necesarios
$sql = "SELECT login, nombre FROM medicos WHERE login = '$userName'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Procesa los resultados de la consulta
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

