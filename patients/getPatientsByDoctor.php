<?php

require_once('../newConnectionDB.php');
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/htdocs/app/patients/php_error_log');
date_default_timezone_set("America/El_Salvador");
$json = file_get_contents('php://input');
$dataBody = json_decode($json);

$userName = $dataBody->userName;

error_log('queryValue: ' . $userName);

$sql =  "SELECT a.pid , a.nombre1, a.nombre2, a.apellido1, a.apellido2, a.expediente, a.fechanac
         FROM pacientes a INNER JOIN cirugias c on a.pid = c.pid 
         WHERE c.cirujanoprincipal = '$userName' OR c.primerayudante = '$userName' or c.segundoayudante = '$userName' or c.anestesiologo = '$userName' 
         UNION SELECT a.pid, a.nombre1, a.nombre2, a.apellido1, a.apellido2, a.expediente, a.fechanac
         FROM pacientes a INNER JOIN events e on a.pid = e.pid 
         WHERE e.medico = '$userName' UNION SELECT a.pid, a.nombre1, a.nombre2, a.apellido1, a.apellido2, a.expediente, a.fechanac
         FROM pacientes a INNER JOIN ingresoegreso f on a.pid = f.pid WHERE f.medico = '$userName'";

// Obtener datos de la tabla
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $data = array();
    // Obtener datos de cada fila
    while ($row = $result->fetch_assoc()) {
        $data[] = $row;
    }
    echo json_encode($data);
} else {
    $emptyArray = array();
    echo json_encode($emptyArray);
}

$conn->close();
