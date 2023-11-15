<?php

require_once('../newConnectionDB.php');

$actionType = $_GET['action'];

$json = file_get_contents('php://input');

$dataBody = json_decode($json);

$doctor = $dataBody->username;
date_default_timezone_set("America/El_Salvador");

$currentDate = date("Y-m-d");
$currentTime = date("H:i");

if($actionType == "getLastSurgeries") {
    $sql = "(select pid, fechacirugia, tipodecirugia, cirujanoprincipal, primerayudante, segundoayudante, anestesiologo from cirugias where fechacirugia < '$currentDate' AND (cirujanoprincipal = '$doctor' OR primerayudante = '$doctor' OR segundoayudante = '$doctor' OR anestesiologo = '$doctor')) order by fechacirugia desc limit 10";

    // Get data from table
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        // Output data of each row
        while($row = $result->fetch_assoc()) {

            // Complete patient info
            $patientId = $row['pid'];

            $queryPatient = "select nombre1, apellido1 from pacientes where pid='$patientId'";
            $resultPatient = $conn->query($queryPatient);
            while ($rowPatient = $resultPatient->fetch_assoc()) {
                $patientName = $rowPatient['nombre1'];
                $patientLastName = $rowPatient['apellido1'];
                
                $patientFullName = "$patientName $patientLastName";
            }
            $row['pid'] = "$patientId-$patientFullName";

            // Complete suergeon info
            $mainSurgeon = $row['cirujanoprincipal'];

            $querySurgeon = "select nombre from medicos where login='$mainSurgeon'";
            $resultSurgeon = $conn->query($querySurgeon);
            while ($rowSurgeon = $resultSurgeon->fetch_assoc()) {
                $surgeonName = $rowSurgeon['nombre'];
            }
            $row['cirujanoprincipal'] = "$mainSurgeon-$surgeonName";

            $data[] = $row;
        }
        ob_clean(); 
        echo json_encode($data);
        exit; 
    } else {
        $emptyArray = array();
        ob_clean(); 
        echo json_encode($emptyArray);
        exit; 
    }

    $conn->close();

} else if ($actionType == "getLastPatients") {

    $sql = "select a.pid, a.nombre1, a.nombre2, a.apellido1, a.apellido2 from pacientes AS a INNER JOIN ingresoegreso AS b on a.pid = b.pid WHERE b.medico = '$doctor' ORDER BY b.fecha DESC LIMIT 5";

    // Get data from table
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = array();
        // Output data of each row
        while($row = $result->fetch_assoc()) {

            $data[] = $row;
        }
        ob_clean(); 
        echo json_encode($data);
        exit; 
    } else {
        $emptyArray = array();
        ob_clean(); 
        echo json_encode($emptyArray);
        exit; 
    }

    $conn->close();

} else {
    
    http_response_code(400);
}


?>