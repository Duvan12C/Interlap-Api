<?php

require_once('../newConnectionDB.php');
ini_set('display_errors', 1);
ini_set('log_errors', 1);
ini_set('error_log', 'C:/xampp/htdocs/app/scheduleSurgery/php_error_log');
$json = file_get_contents('php://input');
$dataBody = json_decode($json);

$patientName = $dataBody->patientName;
$scheduleDate = $dataBody->scheduleDate;
$fromTime = $dataBody->fromTime;
$toTime = $dataBody->toTime;
$timestampFrom = $dataBody->timestampFrom;
$timestampTo = $dataBody->timestampTo;
$surgeryName = $dataBody->surgeryName;
$mainSurgeon = $dataBody->mainSurgeon;
$mainSurgeonFullName = $dataBody->mainSurgeonFullName;
$anesthesiologist = $dataBody->anesthesiologist;
$chirophane = $dataBody->chirophane;


$eventName = "Cirugía de $patientName";
$details = "$surgeryName con el Dr. $mainSurgeonFullName en Quirófano: $chirophane";

date_default_timezone_set("America/El_Salvador");
$currentDate = date("Y-m-d");
$currentTime = date("H:i");

// Se crea el script para validar si el médico tiene eventos
$sql = "SELECT event_id FROM events WHERE medico='$mainSurgeon' AND ((tipo='Cita' AND modo='Presencial') OR tipo='Cirugia') AND ((start_date <='$timestampFrom' AND end_date >= '$timestampTo') OR (start_date <= '$timestampFrom' AND end_date > '$timestampFrom') OR (start_date < '$timestampTo' AND end_date >= '$timestampTo') OR (start_date > '$timestampFrom' AND end_date < '$timestampTo'))";
$result = $conn->query($sql);

$doctorEventsFound = $result->num_rows;

if ($doctorEventsFound > 0) {
    $arr = array('success' => false, 'message' => 'Usted ya tiene una cita o cirugía asignada en este período');
    echo json_encode($arr);
} else {
    $sql = "SELECT event_id FROM events WHERE quirofano='$chirophane' AND (tipo='Cirugia') AND ((start_date <='$timestampFrom' AND end_date >= '$timestampTo') OR (start_date <= '$timestampFrom' AND end_date > '$timestampFrom') OR (start_date < '$timestampTo' AND end_date >= '$timestampTo') OR (start_date > '$timestampFrom' AND end_date < '$timestampTo'))";
    $result = $conn->query($sql);

    $chirophaneUsesFound = $result->num_rows;

    if ($chirophaneUsesFound > 0) {
        $arr = array('success' => false, 'message' => 'Ya existe un procedimiento programado para este Quirófano en este período');
        echo json_encode($arr);
    } else {
        $cirugia = 'Cirugia';
        $calendarEvent = "INSERT INTO events (event_name, start_date, end_date, details, realizada, fecha, medico, tipo, quirofano) VALUES (?, ?, ?, ?, '', ?,?, ?, ?)";
        $events = $conn->prepare($calendarEvent);
        $events->bind_param('ssssssss', $eventName, $timestampFrom, $timestampTo, $details, $currentDate, $mainSurgeon, $cirugia, $chirophane);
        if ($events->execute()) {
            $lastEventId = $conn->insert_id;
            $insertScheduleQuery = "INSERT INTO programacion (paciente, fechacirugia, desde, hasta, tipodecirugia, cirujanoprincipal, anestesiologo, fecha, hora, event_id, quirofano, quienagrego) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
            $insertScheduleStmt = $conn->prepare($insertScheduleQuery);
            $insertScheduleStmt->bind_param('ssssssssisss', $patientName, $scheduleDate, $fromTime, $toTime, $surgeryName, $mainSurgeon, $anesthesiologist, $currentDate, $currentTime, $lastEventId, $chirophane, $mainSurgeon);
            
            if ($insertScheduleStmt->execute()) {
                $arr = array('success' => true, 'message' => 'Gracias, su cirugía ha sido programada exitosamente');
                echo json_encode($arr);
            } else {
                $arr = array('success' => false, 'message' => 'Algo salió mal al agregar la programación: ' . $conn->error);
                echo json_encode($arr);
            }
        } else {
            $arr = array('success' => false, 'message' => 'No se encontró ningún evento');
            echo json_encode($arr);
        }
    }
}

$conn->close();
