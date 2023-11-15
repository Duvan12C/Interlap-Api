<?php

require_once('../newConnectionDB.php');

$actionType = $_GET['action'];

$json = file_get_contents('php://input');
file_put_contents('php://stderr', "Body recibido: $json\n");
$dataBody = json_decode($json, true);
$patientId = $dataBody['patientId'];
$userName = $dataBody['doctor'];
$indicationId = $dataBody['extraDetails'];
$surgeryName = $dataBody['surgeryName'];
$room = $dataBody['room'];
$selectedDate = $dataBody['selectedDate'];
$selectedDoctor = $dataBody['selectedDoctor'];

function queryDatabase($conn, $sql) {
    $result = $conn->query($sql);
    return ($result) ? $result->fetch_all(MYSQLI_ASSOC) : [];
}

function getDoctorName($conn, $doctorId) {
    $sql = "SELECT nombre FROM medicos WHERE cat='Enfermera' AND id='$doctorId'";
    $result = queryDatabase($conn, $sql);
    return ($result && count($result) > 0) ? $result[0]['nombre'] : '';
}

function jsonResponse($data) {
    header('Content-Type: application/json');
    echo json_encode($data);
}

if ($actionType == "getList") {
    $sql = "SELECT * FROM indicindex WHERE pid='$patientId' ORDER BY fechacirugia DESC, id DESC";
    $data = queryDatabase($conn, $sql);
    jsonResponse($data);
} elseif ($actionType == "getDetails") {
    $sql = "SELECT * FROM indicaciones WHERE procedimiento='$indicationId' ORDER BY id ASC";
    $data = queryDatabase($conn, $sql);

    foreach ($data as &$row) {
        for ($i = 1; $i <= 4; $i++) {
            $responsibleField = "cumplimiento$i";
            if (!empty($row[$responsibleField])) {
                $row[$responsibleField] = getDoctorName($conn, $row[$responsibleField]);
            }
        }
    }

    jsonResponse($data);
} elseif ($actionType == "findSurgery") {
    $sql = "SELECT tipodecirugia FROM cirugias WHERE pid='$patientId' ORDER BY fechacirugia DESC, id DESC LIMIT 1";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $surgeryDataName = $row['tipodecirugia'];
        echo $surgeryDataName;
    } else {
        http_response_code(400);
    }
} elseif ($actionType == "getDoctors") {
    $sql = "SELECT login, nombre FROM medicos WHERE login NOT IN ('Drortiz', 'jumanzor', 'jportillo') AND cat != 'Enfermera' ORDER BY login ASC";
    $data = queryDatabase($conn, $sql);
    jsonResponse($data);
} elseif ($actionType == "createIndicationGroup") {
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i");
    $sql = "INSERT INTO indicindex (pid, tipodecirugia, cirujanoprincipal, habitacion, fechacirugia, fecha, hora, usuario) VALUES ('$patientId', '$surgeryName', '$selectedDoctor', '$room', '$selectedDate', '$currentDate', '$currentTime', '$userName')";
    $result = $conn->query($sql);

    if ($conn->error) {
        $arr = array('success' => false, 'message' => 'Something went wrong creating group');
    } else {
        $queryToLastGroup = "SELECT MAX(id) FROM indicindex";
        $resultOfLastGroup = $conn->query($queryToLastGroup);

        if ($resultOfLastGroup && $resultOfLastGroup->num_rows > 0) {
            $row = $resultOfLastGroup->fetch_assoc();
            $lastGroupId = $row['MAX(id)'];
        }

        $arr = array('success' => true, 'message' => $lastGroupId);
    }

    jsonResponse($arr);
} elseif ($actionType == "getNurses") {
    $sql = "SELECT id, nombre FROM medicos WHERE cat='Enfermera' ORDER BY nombre ASC";
    $data = queryDatabase($conn, $sql);
    jsonResponse($data);
} elseif ($actionType == "addIndicationToGroup") {
    $currentDate = date("Y-m-d");
    $currentTime = date("H:i");
    $groupId = $indicationBody['groupId'];
    $userName = $indicationBody['userName'];
    $indications = $indicationBody['indications'];
    $hourFields = array();
    $nurseFields = array();

    for ($i = 1; $i <= 4; $i++) {
        $hourField = "hourOne";
        $nurseField = "nurseOne";
        if ($i > 1) {
            $hourField = "hourTwo";
            $nurseField = "nurseTwo";
        }
        // Adjust field names according to the loop counter ($i)
        $hourFields[] = $indicationBody[$hourField];
        $nurseFields[] = getDoctorName($conn, $indicationBody[$nurseField]);
    }

    $sql = "INSERT INTO indicaciones (procedimiento, indicacion, h1, h2, h3, h4, cumplimiento, cumplimiento2, cumplimiento3, cumplimiento4, fecha, hora, usuario) VALUES ('$groupId', '$indications', '{$hourFields[0]}', '{$hourFields[1]}', '{$hourFields[2]}', '{$hourFields[3]}', '{$nurseFields[0]}', '{$nurseFields[1]}', '{$nurseFields[2]}', '{$nurseFields[3]}', '$currentDate', '$currentTime', '$userName')";
    $result = $conn->query($sql);

    if ($conn->error) {
        $arr = array('success' => false, 'message' => 'Something went wrong adding indication to group');
    } else {
        $arr = array('success' => true, 'message' => "Indicacion agregada con exito al grupo $groupId");
    }

    jsonResponse($arr);
} elseif ($actionType == "updateIndicationGroup") {
    $groupId = $indicationBody['groupId'];
    $indicationId = $indicationBody['indicationId'];
    $indications = $indicationBody['indications'];
    $hourFields = array();
    $nurseFields = array();

    for ($i = 1; $i <= 4; $i++) {
        $hourField = "hourOne";
        $nurseField = "nurseOne";
        if ($i > 1) {
            $hourField = "hourTwo";
            $nurseField = "nurseTwo";
        }
        // Adjust field names according to the loop counter ($i)
        $hourFields[] = $indicationBody[$hourField];
        $nurseFields[] = getDoctorName($conn, $indicationBody[$nurseField]);
    }

    $sql = "UPDATE indicaciones SET indicacion='$indications', h1='{$hourFields[0]}', h2='{$hourFields[1]}', h3='{$hourFields[2]}', h4='{$hourFields[3]}', cumplimiento='{$nurseFields[0]}', cumplimiento2='{$nurseFields[1]}', cumplimiento3='{$nurseFields[2]}', cumplimiento4='{$nurseFields[3]}' WHERE procedimiento='$groupId' AND id='$indicationId'";
    $result = $conn->query($sql);

    if ($conn->error) {
        $arr = array('success' => false, 'message' => 'Something went wrong updating indication to group');
    } else {
        $arr = array('success' => true, 'message' => "Indicacion actualizada exitosamente al grupo $groupId");
    }

    jsonResponse($arr);
} else {
    http_response_code(400);
}
?>
