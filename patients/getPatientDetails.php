<?php

require_once('../newConnectionDB.php');

$json = file_get_contents('php://input');

$dataBody = json_decode($json);
$patient = $dataBody->patientId;


$sql = "select pid, nombre1,nombre2,apellido1,apellido2,sexo,sistemanum,estaturacm0,pesoactuallbs0,estaturapies,estaturapulgadas,pesoactuallbs,estaturacm,pesoactualkg,fechanac,causaprimeravisita,pesoideal,porcentajedegrasa from pacientes where pid='$patient'";
$result = $conn->query($sql);

if($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    echo json_encode($row);
} else {
    
    $arr = array('success' => false, 'message' => 'Patient details not found');

    http_response_code(400);
    echo json_encode($arr);
}


$conn->close();

?>